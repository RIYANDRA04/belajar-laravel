@extends('layouts.app')
@section('title', 'Shop — ShoesAsia')

@section('content')

{{-- ════════════════════════════════════════
     HERO SECTION
════════════════════════════════════════ --}}
<section class="hero-gradient relative overflow-hidden min-h-[560px] flex items-center">
    <!-- Animated background shapes -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-20 -right-20 w-96 h-96 rounded-full opacity-10 bg-indigo-400" style="filter:blur(60px)"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 rounded-full opacity-10 bg-purple-400" style="filter:blur(60px)"></div>
        <div class="absolute top-1/2 left-1/3 w-64 h-64 rounded-full opacity-5 bg-pink-400" style="filter:blur(80px)"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center w-full relative z-10">
        <!-- Text -->
        <div data-aos="fade-right" data-aos-duration="800">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full mb-6 text-xs font-bold uppercase tracking-wider" style="background:rgba(99,102,241,0.25);color:#a5b4fc;border:1px solid rgba(99,102,241,0.3)">
                <i data-lucide="zap" class="w-3 h-3"></i> Koleksi Terbaru 2025
            </div>
            <h1 class="text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Step Into
                <span class="bg-clip-text text-transparent" style="background-image:linear-gradient(135deg,#a5b4fc,#f472b6);-webkit-background-clip:text;">Style</span>
            </h1>
            <p class="text-gray-300 text-lg leading-relaxed mb-8 max-w-md">
                Temukan sepatu impianmu dari koleksi Running, Lifestyle, Basket, hingga Training. Kualitas premium, harga terjangkau.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="#products" class="btn border-0 text-white font-bold px-8 py-3 rounded-2xl" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                    Belanja Sekarang <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                </a>
                <a href="{{ route('shop') }}?category=Running" class="btn btn-ghost border-2 border-white/20 text-white font-semibold px-6 py-3 rounded-2xl hover:bg-white/10">
                    Lihat Running
                </a>
            </div>

            <!-- Stats -->
            <div class="flex gap-8 mt-10">
                <div>
                    <p class="text-2xl font-extrabold text-white">{{ \App\Models\Product::count() }}+</p>
                    <p class="text-gray-400 text-xs">Produk</p>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-white">4</p>
                    <p class="text-gray-400 text-xs">Kategori</p>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-white">{{ \App\Models\Order::where('status','Selesai')->count() }}+</p>
                    <p class="text-gray-400 text-xs">Pesanan Selesai</p>
                </div>
            </div>
        </div>

        <!-- Hero Image Dynamic Carousel for Adidas Samba -->
        <div class="flex justify-center relative" data-aos="fade-left" data-aos-duration="1000">
            <div class="relative group">
                <!-- Glowing Aura -->
                <div class="absolute inset-0 rounded-full bg-indigo-500 opacity-25" style="filter:blur(50px);transform:scale(1.05)"></div>
                
                <!-- Main Container -->
                <div class="relative w-[440px] h-[310px] bg-slate-900/40 backdrop-blur-md border border-white/10 rounded-3xl shadow-2xl overflow-hidden float-anim">
                    <!-- Slides Container -->
                    <div id="hero-slides" class="relative w-full h-full">
                        <!-- Slide 1: White Black Gum -->
                        <div class="hero-slide absolute inset-0 opacity-100 transition-opacity duration-700 ease-in-out" data-color="White Black Gum" style="z-index: 10;">
                            <img src="{{ asset('shoes/shoe_6a0fa23020c058.61351003.webp') }}" alt="Adidas Samba White Black Gum" class="w-full h-full object-cover">
                            <!-- Color Badge Label Overlay -->
                            <div class="absolute bottom-4 left-4 px-3 py-1 rounded-xl bg-slate-900/80 backdrop-blur-sm border border-white/10 text-xs font-bold text-white flex items-center gap-1.5 shadow-md">
                                <span class="w-2.5 h-2.5 rounded-full bg-slate-100 border border-slate-400 animate-pulse"></span>
                                Adidas Samba (White Black Gum)
                            </div>
                        </div>

                        <!-- Slide 2: Black Gum -->
                        <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-in-out" data-color="Black Gum">
                            <img src="{{ asset('shoes/shoe_6a0fa23021b741.55714145.webp') }}" alt="Adidas Samba Black Gum" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 left-4 px-3 py-1 rounded-xl bg-slate-900/80 backdrop-blur-sm border border-white/10 text-xs font-bold text-white flex items-center gap-1.5 shadow-md">
                                <span class="w-2.5 h-2.5 rounded-full bg-slate-800 border border-slate-600 animate-pulse"></span>
                                Adidas Samba (Black Gum)
                            </div>
                        </div>

                        <!-- Slide 3: Reflective Nylon Pack - Oat -->
                        <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-in-out" data-color="Reflective Nylon Pack - Oat">
                            <img src="{{ asset('shoes/shoe_6a0fa230224c98.55065837.webp') }}" alt="Adidas Samba Reflective Nylon Pack - Oat" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 left-4 px-3 py-1 rounded-xl bg-slate-900/80 backdrop-blur-sm border border-white/10 text-xs font-bold text-white flex items-center gap-1.5 shadow-md">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-600 animate-pulse"></span>
                                Adidas Samba (Reflective Oat)
                            </div>
                        </div>

                        <!-- Slide 4: Royal Blue Gum -->
                        <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-in-out" data-color="Royal Blue Gum">
                            <img src="{{ asset('shoes/shoe_6a0fa23022e4d4.59761305.webp') }}" alt="Adidas Samba Royal Blue Gum" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 left-4 px-3 py-1 rounded-xl bg-slate-900/80 backdrop-blur-sm border border-white/10 text-xs font-bold text-white flex items-center gap-1.5 shadow-md">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-600 animate-pulse"></span>
                                Adidas Samba (Royal Blue)
                            </div>
                        </div>

                        <!-- Slide 5: Wonder Clay Royal Blue -->
                        <div class="hero-slide absolute inset-0 opacity-0 transition-opacity duration-700 ease-in-out" data-color="Wonder Clay Royal Blue">
                            <img src="{{ asset('shoes/shoe_6a0fa23023a106.68738940.webp') }}" alt="Adidas Samba Wonder Clay Royal Blue" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 left-4 px-3 py-1 rounded-xl bg-slate-900/80 backdrop-blur-sm border border-white/10 text-xs font-bold text-white flex items-center gap-1.5 shadow-md">
                                <span class="w-2.5 h-2.5 rounded-full bg-orange-400 animate-pulse"></span>
                                Adidas Samba (Wonder Clay)
                            </div>
                        </div>
                    </div>

                    <!-- Slide Navigation Dots / Indicators -->
                    <div class="absolute bottom-4 right-4 flex items-center gap-1.5 z-20">
                        <button onclick="setHeroSlide(0)" class="hero-dot w-2 h-2 rounded-full bg-white opacity-100 transition-all duration-300"></button>
                        <button onclick="setHeroSlide(1)" class="hero-dot w-2 h-2 rounded-full bg-white/40 hover:bg-white/80 transition-all duration-300"></button>
                        <button onclick="setHeroSlide(2)" class="hero-dot w-2 h-2 rounded-full bg-white/40 hover:bg-white/80 transition-all duration-300"></button>
                        <button onclick="setHeroSlide(3)" class="hero-dot w-2 h-2 rounded-full bg-white/40 hover:bg-white/80 transition-all duration-300"></button>
                        <button onclick="setHeroSlide(4)" class="hero-dot w-2 h-2 rounded-full bg-white/40 hover:bg-white/80 transition-all duration-300"></button>
                    </div>

                    <!-- Left / Right Interactive Chevrons (visible on hover) -->
                    <button onclick="prevHeroSlide()" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-slate-900/60 backdrop-blur-sm text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 border border-white/10 hover:bg-indigo-600 shadow-md z-20">
                        <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    </button>
                    <button onclick="nextHeroSlide()" class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-slate-900/60 backdrop-blur-sm text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 border border-white/10 hover:bg-indigo-600 shadow-md z-20">
                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </button>
                </div>

                <!-- Floating badges -->
                <div class="absolute -top-4 -left-4 bg-white rounded-2xl shadow-xl p-3 flex items-center gap-2 border border-slate-100 z-30 transition-transform duration-300 hover:scale-105" data-aos="zoom-in" data-aos-delay="400">
                    <div class="w-7 h-7 rounded-lg bg-yellow-50 flex items-center justify-center">
                        <i data-lucide="star" class="w-4 h-4 text-yellow-500 fill-yellow-500"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Rating</p>
                        <p class="text-indigo-600 font-extrabold text-sm leading-tight">4.9 / 5.0</p>
                    </div>
                </div>
                <div class="absolute -bottom-4 -right-4 bg-white rounded-2xl shadow-xl p-3 flex items-center gap-2 border border-slate-100 z-30 transition-transform duration-300 hover:scale-105" data-aos="zoom-in" data-aos-delay="600">
                    <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center">
                        <i data-lucide="truck" class="w-4 h-4 text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pengiriman</p>
                        <p class="text-indigo-600 font-extrabold text-sm leading-tight">Cepat & Aman</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════
     CATEGORY FILTER
════════════════════════════════════════ --}}
<section id="products" class="max-w-7xl mx-auto px-6 pt-14 pb-4">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div data-aos="fade-right">
            <h2 class="text-3xl font-extrabold text-gray-800">Koleksi Sepatu</h2>
            <p class="text-gray-500 text-sm mt-1">{{ $products->count() }} produk tersedia</p>
        </div>
        <!-- Filter Pills -->
        <div class="flex flex-wrap gap-2" data-aos="fade-left">
            <a href="{{ route('shop') }}"
               class="category-pill px-5 py-2 rounded-full font-semibold text-sm border-2 border-gray-200 text-gray-600 {{ $activeCategory === 'all' ? 'active' : '' }}">
                Semua
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('shop') }}?category={{ $cat }}"
               class="category-pill px-5 py-2 rounded-full font-semibold text-sm border-2 border-gray-200 text-gray-600 {{ $activeCategory === $cat ? 'active' : '' }}">
                @switch($cat)
                    @case('Running')   <i data-lucide="activity" class="w-4 h-4 inline"></i> @break
                    @case('Lifestyle') <i data-lucide="sparkles" class="w-4 h-4 inline"></i> @break
                    @case('Basket')    <i data-lucide="shopping-bag" class="w-4 h-4 inline"></i> @break
                    @case('Training')  <i data-lucide="dumbbell" class="w-4 h-4 inline"></i> @break
                @endswitch
                {{ $cat }}
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════
     PRODUCT GRID
════════════════════════════════════════ --}}
<section class="max-w-7xl mx-auto px-6 pb-20">
    @if($products->isEmpty())
        <div class="text-center py-24" data-aos="fade-up">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl bg-slate-100 text-indigo-600 mb-4">
                <i data-lucide="shoe" class="w-10 h-10"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Tidak ada produk ditemukan</h3>
            <p class="text-gray-400 mb-6">Coba kategori lain atau tampilkan semua produk.</p>
            <a href="{{ route('shop') }}" class="btn text-white border-none" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">Lihat Semua Produk</a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $i => $product)
            <div data-aos="fade-up" data-aos-delay="{{ min(($i % 4) * 80, 250) }}">
                <a href="{{ route('shoe.show', $product->id) }}" class="block product-card bg-white rounded-3xl overflow-hidden shadow-md group">
                    <!-- Image -->
                    <div class="relative overflow-hidden bg-gradient-to-br from-slate-50 to-slate-100 h-52">
                        <img
                            src="{{ $product->image_url }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            loading="lazy"
                            onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80'"
                        >
                        <!-- Category badge -->
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold badge-{{ strtolower($product->category) }}">
                            {{ $product->category }}
                        </span>
                        <!-- Stock warning -->
                        @if($product->stock <= 5)
                        <span class="absolute top-3 right-3 px-2 py-1 rounded-full text-xs font-bold bg-red-500 text-white">
                            Stok {{ $product->stock }}
                        </span>
                        @endif
                        <!-- Hover overlay -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background:rgba(99,102,241,0.6)">
                            <span class="bg-white text-indigo-600 font-bold px-5 py-2 rounded-xl text-sm shadow-lg transform group-hover:scale-100 scale-90 transition-transform duration-300">
                                Lihat Detail →
                            </span>
                        </div>
                    </div>
                    <!-- Info -->
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 text-sm mb-1 leading-tight group-hover:text-indigo-600 transition-colors line-clamp-2">{{ $product->name }}</h3>
                        <div class="flex items-center gap-1 mb-3">
                            @php $sizesPreview = array_slice($product->sizes, 0, 3); @endphp
                            @foreach($sizesPreview as $size)
                                <span class="text-xs bg-slate-100 text-gray-600 px-2 py-0.5 rounded-md font-medium">{{ $size }}</span>
                            @endforeach
                            @if(count($product->sizes) > 3)
                                <span class="text-xs text-gray-400 font-medium">+{{ count($product->sizes) - 3 }}</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-indigo-600 font-extrabold text-base">{{ $product->formatted_price }}</p>
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    @endif
</section>

{{-- ════════════════════════════════════════
     WHY CHOOSE US SECTION
════════════════════════════════════════ --}}
<section class="bg-gradient-to-br from-indigo-50 to-purple-50 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-3">Mengapa Pilih ShoesAsia?</h2>
            <p class="text-gray-500 max-w-lg mx-auto">Kami menghadirkan pengalaman belanja sepatu yang mudah, terpercaya, dan memuaskan.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach([
                ['icon' => 'shield-check', 'title' => '100% Ori', 'desc' => 'Semua produk terjamin original dari brand resmi.', 'color' => '#6366f1'],
                ['icon' => 'truck', 'title' => 'Pengiriman Cepat', 'desc' => 'Order hari ini, terima besok ke seluruh Indonesia.', 'color' => '#8b5cf6'],
                ['icon' => 'rotate-ccw', 'title' => 'Easy Return', 'desc' => 'Tidak puas? Return mudah dalam 7 hari.', 'color' => '#ec4899'],
                ['icon' => 'headphones', 'title' => 'CS 24/7', 'desc' => 'Tim kami siap membantu kapan saja via WhatsApp.', 'color' => '#10b981'],
            ] as $i => $feature)
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:{{ $feature['color'] }}20">
                    <i data-lucide="{{ $feature['icon'] }}" class="w-6 h-6" style="color:{{ $feature['color'] }}"></i>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">{{ $feature['title'] }}</h3>
                <p class="text-gray-500 text-xs leading-relaxed">{{ $feature['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.hero-dot');
        const totalSlides = slides.length;
        let slideInterval;

        window.setHeroSlide = (index) => {
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            
            // Update slides opacity & z-index
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0');
                    slide.classList.add('opacity-100');
                    slide.style.zIndex = '10';
                } else {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0');
                    slide.style.zIndex = '0';
                }
            });

            // Update active dot indicators
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('bg-white/40');
                    dot.classList.add('bg-white');
                } else {
                    dot.classList.remove('bg-white');
                    dot.classList.add('bg-white/40');
                }
            });

            currentSlideIndex = index;
            resetInterval();
        };

        window.nextHeroSlide = () => {
            setHeroSlide(currentSlideIndex + 1);
        };

        window.prevHeroSlide = () => {
            setHeroSlide(currentSlideIndex - 1);
        };

        function startInterval() {
            slideInterval = setInterval(window.nextHeroSlide, 3500); // changes every 3.5 seconds
        }

        function resetInterval() {
            clearInterval(slideInterval);
            startInterval();
        }

        startInterval();
    });
</script>

@endsection
