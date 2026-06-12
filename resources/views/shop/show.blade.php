@extends('layouts.app')
@section('title', $product->name . ' — ShoesAsia')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm mb-8 text-gray-400">
        <a href="{{ route('shop') }}" class="hover:text-indigo-600 transition-colors">Shop</a>
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <a href="{{ route('shop') }}?category={{ $product->category }}" class="hover:text-indigo-600 transition-colors">{{ $product->category }}</a>
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <span class="text-gray-600 font-medium">{{ Str::limit($product->name, 40) }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-start">

        {{-- LEFT: Image Gallery --}}
        <div data-aos="fade-right">
            <!-- Main Image -->
            @php
                $defaultColor = $product->colors[0] ?? null;
                $defaultRaw = $defaultColor ? ($product->color_images[$defaultColor] ?? null) : null;
                $defaultIsFile = $defaultRaw && !str_contains($defaultRaw, '(') && (str_starts_with($defaultRaw, 'shoes/') || str_starts_with($defaultRaw, 'http'));
                $defaultImageUrl = $defaultIsFile ? (str_starts_with($defaultRaw, 'http') ? $defaultRaw : asset($defaultRaw)) : '';
                $defaultFilter = $defaultIsFile ? '' : ($defaultRaw ?? '');
                $initialImageUrl = $defaultImageUrl ?: $product->image_url;
            @endphp
            <div class="relative bg-gradient-to-br from-slate-50 to-slate-100 rounded-3xl overflow-hidden shadow-xl mb-4 h-[420px]">
                <img
                    id="main-img"
                    src="{{ $initialImageUrl }}"
                    alt="{{ $product->name }}"
                    class="w-full h-full object-cover transition-all duration-500"
                    @if($defaultFilter) style="filter: {{ $defaultFilter }}" @endif
                    onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80'"
                >
                <!-- Category badge -->
                <span class="absolute top-4 left-4 px-4 py-1.5 rounded-full text-sm font-bold text-white" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                    {{ $product->category }}
                </span>
                <!-- Stock badge -->
                @if($product->stock <= 5)
                <span class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold bg-red-500 text-white animate-pulse">
                    Stok Terbatas!
                </span>
                @endif
            </div>

            <!-- Thumbnail Row -->
            <div class="flex gap-3 overflow-x-auto pb-2 custom-scrollbar mt-4">
                @php
                    $thumbImages = [];
                    // Masukkan foto utama sebagai thumb pertama jika belum ada
                    if ($product->image_url) {
                        $thumbImages[] = $product->image_url;
                    }
                    // Tambahkan foto-foto per warna (kecuali yang sama dengan foto utama)
                    if (is_array($product->color_images)) {
                        foreach ($product->color_images as $color => $imgPath) {
                            if ($imgPath) {
                                $isFilePath = !str_contains($imgPath, '(') && (str_starts_with($imgPath, 'shoes/') || str_starts_with($imgPath, 'http'));
                                $url = $isFilePath ? (str_starts_with($imgPath, 'http') ? $imgPath : asset($imgPath)) : '';
                                if ($url && !in_array($url, $thumbImages)) {
                                    $thumbImages[] = $url;
                                }
                            }
                        }
                    }
                @endphp

                @foreach($thumbImages as $ti => $thumb)
                <button
                    type="button"
                    onclick="document.getElementById('main-img').src='{{ $thumb }}'; document.querySelectorAll('.gallery-thumb').forEach(el => el.classList.remove('border-indigo-500')); this.classList.add('border-indigo-500');"
                    class="gallery-thumb w-20 h-20 rounded-xl overflow-hidden border-2 transition-all hover:border-indigo-400 focus:outline-none {{ $ti === 0 ? 'border-indigo-500' : 'border-transparent' }} flex-shrink-0"
                >
                    <img src="{{ $thumb }}" alt="thumb {{ $ti+1 }}" class="w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=70'">
                </button>
                @endforeach
            </div>
        </div>

        {{-- RIGHT: Product Details --}}
        <div data-aos="fade-left">
            <!-- Name & Price -->
            <div class="mb-6">
                <p class="text-indigo-600 text-sm font-semibold uppercase tracking-widest mb-2">{{ $product->category }}</p>
                <h1 class="text-3xl font-extrabold text-gray-900 leading-tight mb-4">{{ $product->name }}</h1>
                <div class="flex items-center gap-3 mb-4">
                    <p class="text-3xl font-extrabold text-indigo-600">{{ $product->formatted_price }}</p>
                    <span class="badge badge-success text-xs font-bold">Tersedia</span>
                </div>

                <!-- Rating mock -->
                <div class="flex items-center gap-2">
                    <div class="flex">
                        @for($s = 0; $s < 5; $s++)
                        <i data-lucide="star" class="w-4 h-4 fill-amber-400 text-amber-400"></i>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-500 font-medium">4.9 (128 ulasan)</span>
                </div>
            </div>

            <!-- Divider -->
            <hr class="border-slate-200 mb-6">

            <!-- Description -->
            <div class="mb-6">
                <h3 class="font-bold text-gray-700 mb-2 flex items-center gap-2">
                    <i data-lucide="file-text" class="w-4 h-4 text-indigo-500"></i> Deskripsi
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $product->description }}</p>
            </div>

            <!-- Material -->
            @if($product->material)
            <div class="mb-6 flex items-start gap-3 p-4 bg-slate-50 rounded-2xl">
                <i data-lucide="layers" class="w-5 h-5 text-indigo-500 mt-0.5 flex-shrink-0"></i>
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-0.5">Material</p>
                    <p class="text-gray-700 font-semibold text-sm">{{ $product->material }}</p>
                </div>
            </div>
            @endif

            <!-- Colors -->
            @if($product->colors && count($product->colors) > 0)
            <div class="mb-6">
                <h3 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                    <i data-lucide="palette" class="w-4 h-4 text-indigo-500"></i> Warna Tersedia
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($product->colors as $color)
                    @php
                        $cRaw = $product->color_images[$color] ?? null;
                        // Detect if value is an uploaded file path or a CSS filter string
                        $isFilePath = $cRaw && !str_contains($cRaw, '(') && (str_starts_with($cRaw, 'shoes/') || str_starts_with($cRaw, 'http'));
                        $dataImage = $isFilePath ? ($cRaw && str_starts_with($cRaw,'http') ? $cRaw : asset($cRaw)) : ($cRaw ?? '');
                        $dataFilter = $isFilePath ? '' : ($cRaw ?? '');
                    @endphp
                    <label class="cursor-pointer">
                        <input type="radio" name="color" value="{{ $color }}" class="hidden color-radio"
                               data-image="{{ $dataImage }}"
                               data-filter="{{ $dataFilter }}"
                               {{ $loop->first ? 'checked' : '' }}>
                        <span class="color-btn px-4 py-1.5 bg-white border-2 rounded-full text-sm font-medium transition-colors block
                                {{ $loop->first ? 'border-indigo-500 text-indigo-700' : 'border-slate-200 text-gray-700 hover:border-indigo-400' }}">
                            {{ $color }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- ADD TO CART FORM -->
            @php
                // Stock sudah terpotong di DB saat user lain menambah ke keranjang
                // Tidak perlu hitung session — langsung dari database
                $totalStock = $product->stock;
                $cartBySize = []; // kosong — stok sudah real-time dari DB
            @endphp
            <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="selected_color" id="selected-color" value="{{ $product->colors[0] ?? '' }}">
                <input type="hidden" name="selected_image_url" id="selected-image-url" value="{{ $defaultImageUrl }}">
                <input type="hidden" name="selected_image_filter" id="selected-image-filter" value="{{ $defaultFilter }}">

                <!-- Size Selector -->
                <div>
                    <h3 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <i data-lucide="ruler" class="w-4 h-4 text-indigo-500"></i> Pilih Ukuran
                    </h3>
                    <div class="flex flex-wrap gap-2" id="size-selector">
                        @foreach($product->sizes as $size)
                        <label class="cursor-pointer">
                            <input type="radio" name="size" value="{{ $size }}" class="hidden size-radio" {{ $loop->first ? 'checked' : '' }}>
                            <span class="size-btn px-4 py-2 rounded-xl border-2 font-bold text-sm transition-all duration-200 block
                                {{ $loop->first ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-slate-200 text-gray-700 hover:border-indigo-300' }}">
                                {{ $size }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Quantity -->
                <div>
                    <h3 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
                        <i data-lucide="hash" class="w-4 h-4 text-indigo-500"></i> Jumlah
                    </h3>
                    <div class="flex items-center gap-3">
                        <button type="button" id="qty-minus" class="w-10 h-10 rounded-xl border-2 border-slate-200 flex items-center justify-center font-bold text-gray-600 hover:border-indigo-400 transition-all">
                            <i data-lucide="minus" class="w-4 h-4"></i>
                        </button>
                        <input type="number" name="quantity" id="qty-input" value="1" min="1" max="{{ $totalStock }}"
                            class="w-16 text-center border-2 border-slate-200 rounded-xl py-2 font-bold text-gray-800 focus:border-indigo-400 focus:outline-none">
                        <button type="button" id="qty-plus" class="w-10 h-10 rounded-xl border-2 border-slate-200 flex items-center justify-center font-bold text-gray-600 hover:border-indigo-400 transition-all">
                            <i data-lucide="plus" class="w-4 h-4"></i>
                        </button>
                        <!-- Live stock display -->
                        <div class="flex flex-col leading-tight">
                            <span id="stock-display" class="text-xs font-semibold">
                                @if($totalStock > 0)
                                    <span class="text-gray-500">Stok: <span class="font-bold text-indigo-600">{{ $totalStock }}</span></span>
                                @else
                                    <span class="text-red-500 font-bold">Stok Habis</span>
                                @endif
                            </span>
                            <span id="cart-info" class="text-xs text-gray-400"></span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex gap-3 pt-2">
                    <button type="submit" id="btn-add-cart"
                        class="flex-1 btn border-0 text-white font-bold py-4 rounded-2xl text-base transition-all hover:shadow-xl"
                        style="background:linear-gradient(135deg,#6366f1,#8b5cf6)"
                        {{ $totalStock <= 0 ? 'disabled' : '' }}>
                        <i data-lucide="shopping-bag" class="w-5 h-5 mr-2"></i>
                        {{ $totalStock <= 0 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
                    </button>
                    <a href="{{ route('cart.index') }}" class="btn btn-outline border-2 border-slate-200 rounded-2xl px-5 hover:border-indigo-400">
                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    </a>
                </div>
            </form>

            <!-- Stock info -->
            <p class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                <i data-lucide="info" class="w-3 h-3"></i>
                {{ $product->stock > 0 ? 'Produk tersedia dan siap dikirim.' : 'Stok habis.' }}
            </p>
        </div>
    </div>

    {{-- RELATED PRODUCTS --}}
    @if($related->count() > 0)
    <div class="mt-20">
        <h2 class="text-2xl font-extrabold text-gray-800 mb-6" data-aos="fade-up">
            Produk {{ $product->category }} Lainnya
        </h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($related as $i => $rel)
            <div data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <a href="{{ route('shoe.show', $rel->id) }}" class="block product-card bg-white rounded-2xl overflow-hidden shadow-md group">
                    <div class="h-40 bg-slate-50 overflow-hidden">
                        <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&q=70'">
                    </div>
                    <div class="p-3">
                        <p class="text-xs font-semibold text-gray-600 line-clamp-2 mb-1">{{ $rel->name }}</p>
                        <p class="text-indigo-600 font-extrabold text-sm">{{ $rel->formatted_price }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // ── Stock langsung dari DB (sudah dipotong saat user lain add to cart) ──
    const totalStock  = {{ $totalStock }};

    // ── DOM refs ──
    const qtyInput    = document.getElementById('qty-input');
    const qtyMinus    = document.getElementById('qty-minus');
    const qtyPlus     = document.getElementById('qty-plus');
    const btnAddCart  = document.getElementById('btn-add-cart');
    const stockDisplay= document.getElementById('stock-display');
    const cartInfo    = document.getElementById('cart-info');

    function getSelectedSize() {
        const checked = document.querySelector('.size-radio:checked');
        return checked ? checked.value : null;
    }

    function getAvailableStock() {
        // Stok sudah real-time dari DB, tidak perlu dikurangi session
        return totalStock;
    }

    function updateStockUI() {
        const available  = getAvailableStock();
        const currentQty = parseInt(qtyInput.value) || 1;

        // Clamp
        qtyInput.max = available > 0 ? available : 0;
        if (currentQty > available) qtyInput.value = Math.max(1, available);

        // Stock display
        if (available > 0) {
            const remaining = available - parseInt(qtyInput.value);
            let html = `<span class="text-gray-500">Stok: <span class="font-bold text-indigo-600">${available}</span></span>`;
            if (remaining >= 0 && remaining < available) {
                html += ` <span class="text-gray-400">→ sisa ${remaining} setelah checkout</span>`;
            }
            stockDisplay.innerHTML = html;
        } else {
            stockDisplay.innerHTML = '<span class="text-red-500 font-bold">Stok Habis</span>';
        }

        cartInfo.textContent = '';

        // Button states
        qtyPlus.disabled    = parseInt(qtyInput.value) >= available;
        qtyMinus.disabled   = parseInt(qtyInput.value) <= 1;
        btnAddCart.disabled = available <= 0;

        if (available <= 0) {
            btnAddCart.style.background = 'linear-gradient(135deg,#9ca3af,#6b7280)';
            btnAddCart.style.cursor     = 'not-allowed';
            btnAddCart.style.boxShadow  = 'none';
            btnAddCart.innerHTML        = '<i data-lucide="x-circle" class="w-5 h-5 mr-2"></i> Stok Habis';
        } else {
            btnAddCart.style.background = 'linear-gradient(135deg,#6366f1,#8b5cf6)';
            btnAddCart.style.cursor     = 'pointer';
            btnAddCart.style.boxShadow  = '';
            btnAddCart.innerHTML        = '<i data-lucide="shopping-bag" class="w-5 h-5 mr-2"></i> Tambah ke Keranjang';
        }
        lucide.createIcons();
    }

    // Size selector
    document.querySelectorAll('.size-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.size-btn').forEach(btn => {
                btn.classList.remove('border-indigo-500','bg-indigo-50','text-indigo-700');
                btn.classList.add('border-slate-200','text-gray-700');
            });
            this.nextElementSibling.classList.add('border-indigo-500','bg-indigo-50','text-indigo-700');
            this.nextElementSibling.classList.remove('border-slate-200','text-gray-700');
            qtyInput.value = 1;
            updateStockUI();
        });
    });

    // Quantity buttons
    qtyMinus.addEventListener('click', () => {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
            updateStockUI();
        }
    });
    qtyPlus.addEventListener('click', () => {
        const available = getAvailableStock();
        if (parseInt(qtyInput.value) < available) {
            qtyInput.value = parseInt(qtyInput.value) + 1;
            updateStockUI();
        }
    });
    qtyInput.addEventListener('input', updateStockUI);

    // Color selector & Image Switcher
    document.querySelectorAll('.color-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            // Update button styles
            document.querySelectorAll('.color-btn').forEach(btn => {
                btn.classList.remove('border-indigo-500', 'text-indigo-700');
                btn.classList.add('border-slate-200', 'text-gray-700');
            });
            this.nextElementSibling.classList.add('border-indigo-500', 'text-indigo-700');
            this.nextElementSibling.classList.remove('border-slate-200', 'text-gray-700');

            // Get elements
            const mainImg = document.getElementById('main-img');
            const selectedColorInput = document.getElementById('selected-color');
            const selectedImageUrlInput = document.getElementById('selected-image-url');
            const selectedImageFilterInput = document.getElementById('selected-image-filter');
            
            // Get data from radio button
            const newImage = this.getAttribute('data-image');
            const newFilter = this.getAttribute('data-filter');

            // Update hidden inputs
            selectedColorInput.value = this.value;
            selectedImageUrlInput.value = newImage || '';
            selectedImageFilterInput.value = newFilter || '';

            // Update main image
            if (newImage) {
                // If there's a specific image URL for this color
                mainImg.src = newImage;
                mainImg.style.filter = '';
            } else if (newFilter) {
                // If there's a CSS filter for this color
                mainImg.style.filter = newFilter;
            } else {
                // Fallback to default image
                mainImg.style.filter = '';
            }

            // Update gallery thumbnail borders
            document.querySelectorAll('.gallery-thumb').forEach(thumb => {
                const thumbImg = thumb.querySelector('img');
                if (thumbImg && newImage && thumbImg.src === newImage) {
                    thumb.classList.add('border-indigo-500');
                } else {
                    thumb.classList.remove('border-indigo-500');
                }
            });
        });
    });

    // Add to cart bounce
    btnAddCart.addEventListener('click', function() {
        if (!this.disabled) {
            this.style.transform = 'scale(0.94)';
            setTimeout(() => { this.style.transform = 'scale(1)'; }, 150);
        }
    });

    // Init
    updateStockUI();
</script>
@endpush
