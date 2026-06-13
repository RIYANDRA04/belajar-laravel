@extends('layouts.admin')
@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Masukkan detail produk sepatu baru.')

@section('content')
<div class="max-w-4xl" data-aos="fade-up">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h3 class="font-bold text-gray-800 text-lg">Form Produk Baru</h3>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Sepatu <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input input-bordered w-full rounded-xl focus:border-indigo-500" required>
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                    <select name="category" class="select select-bordered w-full rounded-xl focus:border-indigo-500" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" value="{{ old('price') }}" class="input input-bordered w-full rounded-xl focus:border-indigo-500" required min="0">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Stok <span class="text-red-500">*</span></label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" class="input input-bordered w-full rounded-xl focus:border-indigo-500" required min="0">
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ukuran Tersedia <span class="text-red-500">*</span></label>
                <div class="flex flex-wrap gap-3">
                    @php $availableSizes = ['36','37','38','39','40','41','42','43','44','45']; @endphp
                    @foreach($availableSizes as $size)
                    <label class="cursor-pointer">
                        <input type="checkbox" name="sizes[]" value="{{ $size }}" class="hidden peer" {{ in_array($size, old('sizes', [])) ? 'checked' : '' }}>
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
                    {{-- Diisi oleh JS --}}
                </div>

                <p class="text-xs text-gray-400 mt-2">
                    Foto warna pertama akan jadi foto utama produk. Jika tidak ada foto per warna, placeholder akan digunakan.
                </p>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Material <span class="text-gray-400 font-normal">(opsional)</span></label>
                <input type="text" name="material" value="{{ old('material') }}" placeholder="Contoh: Premium Leather" class="input input-bordered w-full rounded-xl focus:border-indigo-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Lengkap</label>
                <textarea name="description" rows="4" class="textarea textarea-bordered w-full rounded-xl focus:border-indigo-500 resize-none text-base">{{ old('description') }}</textarea>
            </div>

            <hr class="border-slate-100 mb-6">
            <div class="flex gap-3 justify-end">
                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost rounded-xl">Batal</a>
                <button type="submit" id="submit-btn"
                        class="btn text-white border-0 px-8 rounded-xl"
                        style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const CSRF = "{{ csrf_token() }}";
    const CLOUDINARY_SIG_URL = "{{ route('admin.products.cloudinary-signature') }}";

    // ============================
    //   DYNAMIC COLOR ROWS
    // ============================
    let colorRowCount = 0;

    function resolveImgSrc(path) {
        if (!path) return '';
        if (path.startsWith('http')) return path;
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
                        class="px-3 py-1.5 rounded-xl text-xs font-bold bg-indigo-500 text-white hover:bg-indigo-600 transition-all"
                        id="upload-btn-${idx}">
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

            <input type="file" id="color-file-${idx}" accept="image/jpeg,image/png,image/jpg,image/webp" class="hidden"
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

    async function handleColorFile(idx, file) {
        if (!file) return;
        if (file.size > 10 * 1024 * 1024) { alert('File terlalu besar! Maks 10MB.'); return; }
        if (!file.type.match(/image\/(jpeg|jpg|png|webp)/)) { alert('Format tidak didukung.'); return; }

        const statusEl  = document.getElementById(`color-status-${idx}`);
        const thumbEl   = document.getElementById(`color-thumb-${idx}`);
        const uploadBtn = document.getElementById(`upload-btn-${idx}`);

        // Show loading
        statusEl.textContent = 'Mengupload...';
        uploadBtn.disabled = true;
        uploadBtn.textContent = '...';

        // Show local preview immediately
        thumbEl.innerHTML = `<img src="${URL.createObjectURL(file)}" class="w-full h-full object-cover">`;

        try {
            // Step 1: Get signed token from our backend
            const sigRes = await fetch(CLOUDINARY_SIG_URL);
            const { signature, timestamp, api_key, cloud_name, folder } = await sigRes.json();

            // Step 2: Upload directly from browser to Cloudinary
            const formData = new FormData();
            formData.append('file', file);
            formData.append('signature', signature);
            formData.append('timestamp', timestamp);
            formData.append('api_key', api_key);
            formData.append('folder', folder);

            const uploadRes = await fetch(
                `https://api.cloudinary.com/v1_1/${cloud_name}/image/upload`,
                { method: 'POST', body: formData }
            );
            const result = await uploadRes.json();

            if (result.secure_url) {
                // Step 3: Save the Cloudinary URL to the hidden field
                document.getElementById(`color-img-path-${idx}`).value = result.secure_url;
                // Update thumb with the final Cloudinary URL
                thumbEl.innerHTML = `<img src="${result.secure_url}" class="w-full h-full object-cover">`;
                statusEl.innerHTML = '<i data-lucide="check-circle" class="w-4 h-4 text-emerald-500"></i>';
                statusEl.style.color = '#10b981';
                lucide.createIcons();
            } else {
                throw new Error(result.error?.message || 'Upload gagal.');
            }
        } catch (err) {
            statusEl.textContent = '⚠ Gagal';
            statusEl.style.color = '#ef4444';
            alert('Upload foto gagal: ' + err.message);
        } finally {
            uploadBtn.disabled = false;
            uploadBtn.textContent = 'Upload';
            // Clear file input — foto sudah di Cloudinary, tidak perlu kirim file lagi
            document.getElementById(`color-file-${idx}`).value = '';
        }
    }

    function normalizeArrayInput(value) {
        if (Array.isArray(value)) return value;
        if (value && typeof value === 'object') return Object.values(value);
        return [];
    }

    const oldColorsRaw      = @json(old('color_names', []));
    const oldColorImagesRaw = @json(old('color_image_paths', []));
    const oldColors         = normalizeArrayInput(oldColorsRaw);
    const oldColorImages    = Array.isArray(oldColorImagesRaw) ? oldColorImagesRaw : (oldColorImagesRaw || {});

    document.addEventListener('DOMContentLoaded', () => {
        if (oldColors.length > 0) {
            oldColors.forEach((color, idx) => {
                addColorRow(color, oldColorImages[idx] || '');
            });
        } else {
            addColorRow();
        }
    });
</script>
@endpush
