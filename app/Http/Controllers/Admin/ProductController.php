<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ['Running', 'Lifestyle', 'Basket', 'Training'];
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Receive a single 64 KB binary chunk.
     * Each request body is tiny → no PHP-CGI buffer issues.
     * Headers: X-Upload-Id, X-Chunk-Index, X-Total-Chunks, X-File-Type
     */
    public function uploadChunk(Request $request)
    {
        $uploadId    = preg_replace('/[^a-z0-9_\-]/', '', $request->header('X-Upload-Id', ''));
        $chunkIndex  = (int) $request->header('X-Chunk-Index', 0);

        if (!$uploadId) {
            return response()->json(['success' => false, 'error' => 'Missing upload ID.'], 422);
        }

        // Read the raw chunk body — each chunk is ≤ 64KB, well within any limit
        $raw = file_get_contents('php://input');
        if ($raw === false || strlen($raw) === 0) {
            return response()->json(['success' => false, 'error' => 'Empty chunk body.'], 422);
        }

        // Store chunk in storage/app/chunks/{uploadId}/ (always writable in the project)
        $tmpDir = storage_path('app/chunks/' . $uploadId);
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0755, true);
        }

        file_put_contents($tmpDir . '/chunk_' . $chunkIndex, $raw);

        return response()->json(['success' => true, 'chunk' => $chunkIndex]);
    }

    /**
     * Assemble all stored chunks into the final image file in public/shoes/.
     * Body: JSON { upload_id, file_type, total_chunks }
     */
    public function finalizeUpload(Request $request)
    {
        $uploadId   = preg_replace('/[^a-z0-9_\-]/', '', $request->input('upload_id', ''));
        $fileType   = $request->input('file_type', 'image/jpeg');
        $totalChunks = (int) $request->input('total_chunks', 0);

        if (!$uploadId || $totalChunks < 1) {
            return response()->json(['success' => false, 'error' => 'Missing upload_id or total_chunks.'], 422);
        }

        $tmpDir = storage_path('app/chunks/' . $uploadId);

        // Verify all chunks exist
        for ($i = 0; $i < $totalChunks; $i++) {
            if (!file_exists($tmpDir . '/chunk_' . $i)) {
                return response()->json(['success' => false, 'error' => "Missing chunk $i."], 422);
            }
        }

        // Extension from MIME type
        $ext = 'jpg';
        if (str_contains($fileType, 'png'))  $ext = 'png';
        if (str_contains($fileType, 'webp')) $ext = 'webp';
        if (str_contains($fileType, 'gif'))  $ext = 'gif';

        // Ensure target directory exists
        $shoesDir = public_path('shoes');
        if (!is_dir($shoesDir)) mkdir($shoesDir, 0755, true);

        $filename = 'shoe_' . uniqid('', true) . '.' . $ext;
        $dest     = $shoesDir . DIRECTORY_SEPARATOR . $filename;

        // Assemble chunks sequentially
        $fp = fopen($dest, 'wb');
        for ($i = 0; $i < $totalChunks; $i++) {
            fwrite($fp, file_get_contents($tmpDir . '/chunk_' . $i));
        }
        fclose($fp);

        // Cleanup chunks
        for ($i = 0; $i < $totalChunks; $i++) {
            @unlink($tmpDir . '/chunk_' . $i);
        }
        @rmdir($tmpDir);

        return response()->json([
            'success' => true,
            'path'    => 'shoes/' . $filename,
            'url'     => asset('shoes/' . $filename),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'price'              => 'required|numeric|min:0',
            'category'           => 'required|in:Running,Lifestyle,Basket,Training',
            'description'        => 'nullable|string',
            'sizes'              => 'required|array|min:1',
            'sizes.*'            => 'string',
            'color_names'        => 'nullable|array',
            'color_names.*'      => 'nullable|string|max:100',
            'color_image_paths'  => 'nullable|array',
            'color_image_paths.*'=> 'nullable|string',
            'color_files'        => 'nullable|array',
            'color_files.*'      => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'material'           => 'nullable|string',
            'stock'              => 'required|integer|min:0',
        ]);

        // Raw arrays from the form (indices stay aligned)
        $rawNames      = $request->input('color_names', []);
        $rawPaths      = $request->input('color_image_paths', []);
        $uploadedFiles = $request->file('color_files', []);

        $colors      = [];
        $colorImages = [];
        $imagePath   = null;

        foreach ($rawNames as $rowIndex => $rawName) {
            $name = trim($rawName ?? '');
            if ($name === '') continue;

            $path = null;
            $file = $uploadedFiles[$rowIndex] ?? null;
            if ($file && $file->isValid()) {
                $path = $this->storeUploadedColorFile($file);
            } elseif (!empty($rawPaths[$rowIndex])) {
                $path = $rawPaths[$rowIndex];
            }

            $colors[]           = $name;
            $colorImages[$name] = $path;

            if (!$imagePath && $path) {
                $imagePath = $path;
            }
        }

        Product::create([
            'name'         => $request->name,
            'price'        => $request->price,
            'category'     => $request->category,
            'description'  => $request->description,
            'sizes'        => $request->sizes,
            'colors'       => !empty($colors) ? $colors : null,
            'color_images' => !empty($colorImages) ? $colorImages : null,
            'material'     => $request->material,
            'stock'        => $request->stock,
            'image'        => $imagePath,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = ['Running', 'Lifestyle', 'Basket', 'Training'];
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'price'              => 'required|numeric|min:0',
            'category'           => 'required|in:Running,Lifestyle,Basket,Training',
            'description'        => 'nullable|string',
            'sizes'              => 'required|array|min:1',
            'sizes.*'            => 'string',
            'color_names'        => 'nullable|array',
            'color_names.*'      => 'nullable|string|max:100',
            'color_image_paths'  => 'nullable|array',
            'color_image_paths.*'=> 'nullable|string',
            'color_files'        => 'nullable|array',
            'color_files.*'      => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'material'           => 'nullable|string',
            'stock'              => 'required|integer|min:0',
        ]);

        // Raw arrays from the form (indices stay aligned)
        $rawNames      = $request->input('color_names', []);
        $rawPaths      = $request->input('color_image_paths', []);
        $uploadedFiles = $request->file('color_files', []);

        $oldColorImages = $product->color_images ?? [];
        $newColors      = [];
        $newColorImages = [];

        foreach ($rawNames as $rowIndex => $rawName) {
            $name = trim($rawName ?? '');
            if ($name === '') continue;

            $newPath = null;
            $file = $uploadedFiles[$rowIndex] ?? null;
            if ($file && $file->isValid()) {
                $newPath = $this->storeUploadedColorFile($file);
                if (isset($oldColorImages[$name]) && $oldColorImages[$name]
                    && $oldColorImages[$name] !== $newPath
                    && !str_starts_with($oldColorImages[$name], 'http')) {
                    $oldFile = public_path($oldColorImages[$name]);
                    if (file_exists($oldFile)) {
                        @unlink($oldFile);
                    }
                }
            } elseif (!empty($rawPaths[$rowIndex])) {
                $newPath = $rawPaths[$rowIndex];
            } else {
                $newPath = $oldColorImages[$name] ?? null;
            }

            $newColorImages[$name] = $newPath;
            $newColors[] = $name;
        }

        // Main product image = first color that has an image, or keep existing
        $imagePath = $product->image;
        foreach ($newColors as $c) {
            if (!empty($newColorImages[$c])) {
                $imagePath = $newColorImages[$c];
                break;
            }
        }

        $product->update([
            'name'         => $request->name,
            'price'        => $request->price,
            'category'     => $request->category,
            'description'  => $request->description,
            'sizes'        => $request->sizes,
            'colors'       => !empty($newColors) ? $newColors : null,
            'color_images' => !empty($newColorImages) ? $newColorImages : null,
            'material'     => $request->material,
            'stock'        => $request->stock,
            'image'        => $imagePath,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image && !str_starts_with($product->image, 'http')) {
            $file = public_path($product->image);
            if (file_exists($file)) {
                @unlink($file);
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }

    private function storeUploadedColorFile($file)
    {
        $shoesDir = public_path('shoes');
        if (!is_dir($shoesDir)) {
            mkdir($shoesDir, 0755, true);
        }

        $filename = 'shoe_' . uniqid('', true) . '.' . $file->extension();
        $file->move($shoesDir, $filename);

        return 'shoes/' . $filename;
    }
}
