@extends('layouts.admin')
@section('page-title', 'Edit Produk')
@section('page-subtitle', 'Ubah detail produk sepatu.')

@section('content')
<div class="max-w-4xl" data-aos="fade-up">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 text-lg">Edit: {{ $product->name }}</h3>
            <span class="badge badge-primary">{{ $product->category }}</span>
        </div>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="product-form" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Sepatu <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" class="input input-bordered w-full rounded-xl focus:border-indigo-500" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" class="select select-bordered w-full rounded-xl focus:border-indigo-500" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" class="input input-bordered w-full rounded-xl focus:border-indigo-500" required min="0">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Stok <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="input input-bordered w-full rounded-xl focus:border-indigo-500" required min="0">
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ukuran Tersedia <span class="text-red-500">*</span></label>
                <div class="flex flex-wrap gap-3">
                    @php $availableSizes = ['36','37','38','39','40','41','42','43','44','45']; $oldSizes = old('sizes', $product->sizes ?? []); @endphp
                    @foreach($availableSizes as $size)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="sizes[]" value="{{ $size }}" class="hidden peer" {{ in_array($size, $oldSizes) ? 'checked' : '' }}>
                        <div class="w-12 h-12 rounded-xl border-2 flex items-center justify-center font-bold text-gray-600 border-slate-200 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:text-indigo-600 transition-all hover:border-indigo-300">{{ $size }}</div>
                    </label>
                    @endforeach
                </div>
                @error('sizes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- ===== WARNA & FOTO PER WARNA ===== --}}
            <div class="mb-6">
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-sm font-semibold text-gray-700">
                        Warna &amp; Foto Produk
                        <span class="text-gray-400 font-normal ml-1">(opsional)</span>
                    </label>
                    <button type="button" onclick="addColorRow()"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold border-2 border-indigo-500 bg-indigo-50 text-indigo-600 hover:bg-indigo-500 hover:text-white transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Warna
                    </button>
                </div>

                <div id="colors-wrapper" class="space-y-3">
                    {{-- Diisi oleh JS dari data produk yang sudah ada --}}
                </div>

                <p class="text-xs text-gray-400 mt-2">
                    Foto warna pertama akan jadi foto utama produk. Jika tidak ada foto per warna, foto yang sudah tersimpan tetap digunakan.
                </p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Material</label>
                <input type="text" name="material" value="{{ old('material', $product->material) }}" class="input input-bordered w-full rounded-xl focus:border-indigo-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Lengkap</label>
                <textarea name="description" rows="4" class="textarea textarea-bordered w-full rounded-xl focus:border-indigo-500 resize-none text-base">{{ old('description', $product->description) }}</textarea>
            </div>

            <hr class="border-slate-100 mb-6">
            <div class="flex gap-3 justify-end">
                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost rounded-xl">Batal</a>
                <button type="submit" id="submit-btn"
                        class="btn text-white border-0 px-8 rounded-xl"
                        style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const CSRF = "{{ csrf_token() }}";

    // ============================
    //   DYNAMIC COLOR ROWS
    // ============================
    let colorRowCount = 0;

    // Resolve a stored image path/URL into a usable <img> src
    function resolveImgSrc(path) {
        if (!path) return '';
        if (path.startsWith('http')) return path;
        // local path stored like "shoes/shoe_xxx.jpg"
        return '/' + path;
    }

    function addColorRow(name = '', imagePath = '') {
        const wrapper  = document.getElementById('colors-wrapper');
        const idx      = colorRowCount++;
        const imgSrc   = resolveImgSrc(imagePath);

        const thumbInner = imgSrc
            ? `<img src="${imgSrc}" class="w-full h-full object-cover" onerror="this.style.display='none'">`
            : `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                   d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01
                      M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
               </svg>`;

        const row = document.createElement('div');
        row.className = 'color-row flex flex-col sm:flex-row items-start sm:items-center gap-3 bg-slate-50 border border-slate-200 rounded-xl p-3 transition-all';
        row.dataset.idx = idx;
        row.innerHTML = `
            <input type="hidden" name="color_names[${idx}]"       id="color-name-${idx}"     value="${name}">
            <input type="hidden" name="color_image_paths[${idx}]" id="color-img-path-${idx}" value="${imagePath}">

            <input type="text" id="color-text-${idx}" value="${name}" placeholder="Nama warna, mis: Hitam"
                   class="input input-bordered flex-1 rounded-xl focus:border-indigo-500 text-sm min-w-0"
                   oninput="document.getElementById('color-name-${idx}').value = this.value" required>

            <div class="flex items-center gap-2 flex-shrink-0">
                <div id="color-thumb-${idx}"
                     class="w-10 h-10 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden bg-white cursor-pointer hover:border-indigo-400 transition-all"
                     onclick="triggerColorFile(${idx})" title="Upload foto warna ini">
                    ${thumbInner}
                </div>

                <button type="button" onclick="triggerColorFile(${idx})"
                        class="px-3 py-1.5 rounded-xl text-xs font-bold bg-indigo-500 text-white hover:bg-indigo-600 transition-all">
                    Upload
                </button>

                <span id="color-status-${idx}" class="text-xs text-gray-400 truncate" style="max-width:6rem;">
                    ${imagePath ? '<i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>' : ''}
                </span>

                <button type="button" onclick="removeColorRow(this)"
                        class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600 transition-all"
                        title="Hapus warna ini">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <input type="file" name="color_files[${idx}]" id="color-file-${idx}" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden"
                   onchange="handleColorFile(${idx}, this.files[0])">
        `;
        wrapper.appendChild(row);
    }

    function removeColorRow(btn) {
        btn.closest('.color-row').remove();
    }

    function triggerColorFile(idx) {
        document.getElementById(`color-file-${idx}`).click();
    }

    function handleColorFile(idx, file) {
        if (!file) return;
        if (file.size > 10 * 1024 * 1024) { alert('File terlalu besar! Maks 10MB.'); return; }
        if (!file.type.match(/image\/(jpeg|jpg|png|webp)/)) { alert('Format tidak didukung.'); return; }

        const statusEl = document.getElementById(`color-status-${idx}`);
        const thumbEl  = document.getElementById(`color-thumb-${idx}`);

        thumbEl.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;
        statusEl.innerHTML = '<i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>';
        statusEl.style.color  = '#10b981';
        statusEl.title = 'Gambar siap di-upload saat form dikirim.';
        lucide.createIcons();
    }

    // ── Pre-populate dari data produk atau old input jika ada ──
    function normalizeArrayInput(value) {
        if (Array.isArray(value)) {
            return value;
        }
        if (value && typeof value === 'object') {
            return Object.values(value);
        }
        return [];
    }

    const existingColorsRaw      = @json(old('color_names', $product->colors ?? []));
    const existingColorImagesRaw = @json(old('color_image_paths', $product->color_images ?? []));
    const existingColors         = normalizeArrayInput(existingColorsRaw);
    const existingColorImages    = Array.isArray(existingColorImagesRaw) ? existingColorImagesRaw : (existingColorImagesRaw || {});

    document.addEventListener('DOMContentLoaded', () => {
        if (existingColors.length > 0) {
            existingColors.forEach((color, idx) => {
                const img = existingColorImages[color] ?? existingColorImages[idx] ?? '';
                addColorRow(color, img);
            });
        } else {
            addColorRow(); // satu baris kosong
        }
    });
</script>
@endpush
