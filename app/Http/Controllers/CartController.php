<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['subtotal']);
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id'            => 'required|exists:products,id',
            'size'                  => 'required|string',
            'quantity'              => 'required|integer|min:1',
            'selected_color'        => 'nullable|string|max:100',
            'selected_image_url'    => 'nullable|string',
            'selected_image_filter' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        $selectedColor = $request->input('selected_color', 'default') ?: 'default';
        $sanitizedColor = preg_replace('/[^A-Za-z0-9_-]+/', '_', strtolower($selectedColor));
        $cart    = session()->get('cart', []);
        $cartKey = $product->id . '_' . $request->size . '_' . $sanitizedColor;

        // ── Cek stok REAL-TIME dari database ──
        // Stock di DB sudah terpotong saat user lain menambah ke keranjang
        if ($request->quantity > $product->stock) {
            return redirect()->back()->with('error',
                'Stok tidak mencukupi. Sisa stok: ' . $product->stock);
        }

        // Kurangi stok di database secara langsung
        DB::transaction(function () use ($product, $request, $selectedColor, &$cart, $cartKey) {
            // Re-check dengan lock untuk mencegah race condition
            $freshProduct = Product::lockForUpdate()->find($product->id);
            if ($request->quantity > $freshProduct->stock) {
                throw new \Exception('Stok habis');
            }

            // Kurangi stok DB
            $freshProduct->decrement('stock', $request->quantity);

            // Tambah ke keranjang session
            if (isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $request->quantity;
                $cart[$cartKey]['subtotal']  = $cart[$cartKey]['price'] * $cart[$cartKey]['quantity'];
            } else {
                $cart[$cartKey] = [
                    'product_id'     => $freshProduct->id,
                    'name'           => $freshProduct->name,
                    'image_url'      => $request->selected_image_url ?: $freshProduct->image_url,
                    'image_filter'   => $request->selected_image_filter ?: null,
                    'selected_color' => $selectedColor !== 'default' ? $selectedColor : null,
                    'category'       => $freshProduct->category,
                    'size'           => $request->size,
                    'price'          => $freshProduct->price,
                    'quantity'       => $request->quantity,
                    'subtotal'       => $freshProduct->price * $request->quantity,
                ];
            }
        });

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', '"' . $product->name . '" berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_key' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $key  = $request->cart_key;

        if (!isset($cart[$key])) {
            return redirect()->route('cart.index');
        }

        $product    = Product::find($cart[$key]['product_id']);
        $oldQty     = $cart[$key]['quantity'];
        $newQty     = $request->quantity;
        $difference = $newQty - $oldQty; // positif = tambah, negatif = kurang

        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'Produk tidak ditemukan.');
        }

        try {
            DB::transaction(function () use ($product, $difference, $newQty, $key, &$cart) {
                $freshProduct = Product::lockForUpdate()->find($product->id);

                if ($difference > 0 && $difference > $freshProduct->stock) {
                    throw new \Exception('Stok tidak cukup untuk penambahan. Tersedia: ' . $freshProduct->stock);
                }

                // Sesuaikan stok: jika tambah qty, kurangi DB; jika kurangi qty, kembalikan DB
                if ($difference > 0) {
                    $freshProduct->decrement('stock', $difference);
                } elseif ($difference < 0) {
                    $freshProduct->increment('stock', abs($difference));
                }

                $cart[$key]['quantity'] = $newQty;
                $cart[$key]['subtotal'] = $cart[$key]['price'] * $newQty;
            });

            session()->put('cart', $cart);
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang diperbarui.');
    }

    public function remove(Request $request)
    {
        $request->validate(['cart_key' => 'required|string']);

        $cart = session()->get('cart', []);
        $key  = $request->cart_key;

        if (isset($cart[$key])) {
            $productId = $cart[$key]['product_id'];
            $qty       = $cart[$key]['quantity'];

            // Kembalikan stok ke database saat item dihapus dari keranjang
            $product = Product::find($productId);
            if ($product) {
                $product->increment('stock', $qty);
            }

            unset($cart[$key]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus. Stok dikembalikan.');
    }
}
