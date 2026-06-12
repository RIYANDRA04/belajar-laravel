@extends('layouts.app')
@section('title', 'Dashboard — ShoesAsia')

@section('content')
<div class="bg-slate-50 min-h-screen text-slate-800 relative overflow-hidden pb-24">
    <!-- Neon Background Aura -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] rounded-full bg-indigo-600/10 blur-[120px]"></div>
        <div class="absolute bottom-10 left-10 w-[400px] h-[400px] rounded-full bg-pink-600/5 blur-[100px]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-8 pt-8 relative z-10">
        
        <!-- Welcome Greeting & Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12" data-aos="fade-down">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="px-3 py-1 rounded-full text-xs font-extrabold uppercase bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 tracking-wider">
                        Premium Member
                    </span>
                    <span class="text-slate-500 text-xs font-medium">Gabung {{ Auth::user()->created_at->format('M Y') }}</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black tracking-tight text-slate-900">
                    Halo, <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500">{{ Auth::user()->name }}</span>!
                </h1>
                <p class="text-slate-500 text-sm mt-1 leading-relaxed">
                    Selamat datang kembali di ShoesAsia. Temukan sneaker impian dan pantau aktivitas belanjamu.
                </p>
            </div>
            
            <a href="{{ route('shop') }}" class="btn border-0 text-white font-bold px-6 py-3 rounded-2xl hover:scale-[1.03] transition-transform shadow-lg shadow-indigo-500/20" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                <i data-lucide="shopping-bag" class="w-4 h-4 mr-2"></i> Belanja Sneaker Baru
            </a>
        </div>

        <!-- 3D Sneaker Rotator & Brand Banner Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12">
            
            <!-- Left Side: Brand Banner & Fast Actions (5 Columns) -->
            <div class="lg:col-span-5 flex flex-col justify-between gap-8" data-aos="fade-right" data-aos-delay="100">
                <!-- Glowing Hologram Card -->
                <div class="relative bg-white/80 backdrop-blur-xl border border-slate-200/80 rounded-3xl p-8 overflow-hidden h-full flex flex-col justify-between group shadow-[0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-lg transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/5 rounded-full blur-3xl group-hover:bg-indigo-500/10 transition-all"></div>
                    
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 mb-6 shadow-sm">
                            <i data-lucide="sparkles" class="w-6 h-6 animate-pulse"></i>
                        </div>
                        <h2 class="text-2xl font-extrabold text-slate-800 mb-3">Teknologi Sneaker Terkini</h2>
                        <p class="text-slate-500 text-sm leading-relaxed mb-6">
                            Flagship sneaker kami didesain menggunakan bahan daur ulang berkualitas tinggi, sol empuk bersirkulasi udara, serta cengkeraman outsole maksimal untuk mendukung setiap langkah aktifmu.
                        </p>
                        
                        <!-- Mini Highlights Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100">
                                <p class="text-xs font-bold text-slate-700 mb-1">Material Premium</p>
                                <p class="text-[11px] text-slate-500 leading-tight">Serat elastis adaptif tinggi</p>
                            </div>
                            <div class="p-3 bg-slate-50 rounded-2xl border border-slate-100">
                                <p class="text-xs font-bold text-slate-700 mb-1">Cushioning Sol</p>
                                <p class="text-[11px] text-slate-500 leading-tight">Bantalan kenyamanan 24/7</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footnote / Action Link -->
                    <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-400">Putar sepatu di panel kanan untuk detail 360°</span>
                        <span class="text-indigo-600 font-bold group-hover:translate-x-1.5 transition-transform flex items-center gap-1">
                            Explore <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Right Side: 3D Sneaker Sequence Viewer (7 Columns) -->
            <div class="lg:col-span-7" data-aos="fade-left" data-aos-delay="200">
                <div class="relative bg-white/80 backdrop-blur-xl border border-slate-200/80 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] overflow-hidden flex flex-col items-center">
                    
                    <!-- Top header info -->
                    <div class="w-full flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Holographic 3D View</span>
                        </div>
                        <div class="px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-600 border border-indigo-100/80 text-[10px] font-bold uppercase tracking-wider flex items-center gap-1.5 shadow-sm">
                            <i data-lucide="move-horizontal" class="w-3.5 h-3.5"></i> Drag to Spin
                        </div>
                    </div>

                    <!-- The 3D Canvas / Sequence Wrapper -->
                    <div id="3d-viewer-container" class="relative w-full aspect-[4/3] max-h-[380px] bg-slate-50 rounded-3xl border border-slate-100 overflow-hidden flex items-center justify-center cursor-ew-resize group select-none shadow-[0_15px_30px_rgba(99,102,241,0.12)]">
                        <!-- Hologram Background Grid Effect -->
                        <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:32px_32px] opacity-40"></div>
                        <!-- Concentric Circles Radar -->
                        <div class="absolute w-[280px] h-[280px] rounded-full border border-indigo-500/10 flex items-center justify-center animate-[spin_40s_linear_infinite]">
                            <div class="w-[200px] h-[200px] rounded-full border border-indigo-500/20 border-dashed"></div>
                        </div>

                        <!-- Main Canvas Element -->
                        <canvas 
                            id="3d-shoe-canvas" 
                            class="relative w-[96%] h-[96%] rounded-3xl overflow-hidden object-contain transition-all duration-100 z-10 cursor-ew-resize"
                        ></canvas>

                        <!-- Preloader Overlay -->
                        <div id="rotation-loader" class="absolute inset-0 bg-slate-50/90 z-20 flex flex-col items-center justify-center transition-opacity duration-300">
                            <div class="w-12 h-12 rounded-full border-4 border-indigo-500/20 border-t-indigo-600 animate-spin mb-3"></div>
                            <p class="text-xs font-bold text-indigo-500">Loading 3D Sneaker...</p>
                            <!-- Progress Bar -->
                            <div class="w-48 h-1 bg-slate-200 rounded-full mt-2 overflow-hidden border border-slate-300/50">
                                <div id="rotation-loader-progress" class="w-0 h-full bg-gradient-to-r from-indigo-500 to-pink-500 transition-all duration-100"></div>
                            </div>
                        </div>

                        <!-- 3D Callout Floating Node 1 -->
                        <div class="absolute top-[28%] left-[22%] z-20 group/node cursor-pointer pointer-events-auto">
                            <span class="flex h-3 w-3 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-pink-500"></span>
                            </span>
                            <!-- Tooltip Card -->
                            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 w-48 p-3 rounded-xl bg-white border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.08)] opacity-0 scale-95 group-hover/node:opacity-100 group-hover/node:scale-100 transition-all duration-300 pointer-events-none text-left z-30">
                                <p class="text-xs font-bold text-pink-600 mb-0.5">Prime-Breathable Knit</p>
                                <p class="text-[10px] text-slate-500 leading-tight">Teknologi rajutan sirkulasi udara optimal menjaga kaki tetap sejuk.</p>
                            </div>
                        </div>

                        <!-- 3D Callout Floating Node 2 -->
                        <div class="absolute bottom-[24%] right-[28%] z-20 group/node cursor-pointer pointer-events-auto">
                            <span class="flex h-3 w-3 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
                            </span>
                            <!-- Tooltip Card -->
                            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 w-48 p-3 rounded-xl bg-white border border-slate-100 shadow-[0_10px_30px_rgba(0,0,0,0.08)] opacity-0 scale-95 group-hover/node:opacity-100 group-hover/node:scale-100 transition-all duration-300 pointer-events-none text-left z-30">
                                <p class="text-xs font-bold text-indigo-600 mb-0.5">Dual-Core Grip Outsole</p>
                                <p class="text-[10px] text-slate-500 leading-tight">Karet vulkanisasi bermotif traksi tinggi untuk pijakan kokoh.</p>
                            </div>
                        </div>

                    </div>

                    <!-- Bottom Controls Info -->
                    <div class="w-full flex items-center justify-between mt-4 text-xs text-slate-400">
                        <span>← Drag horizontal untuk putar →</span>
                        <span id="frame-display" class="font-mono text-[10px]">Frame: 1 / 240</span>
                    </div>

                </div>
            </div>

        </div>

        <!-- Metric Stat Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12" data-aos="fade-up">
            
            <!-- Active Orders Card -->
            <a href="{{ route('orders.index') }}" class="relative bg-white border border-slate-200/80 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-md hover:border-indigo-500/30 hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-purple-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center shadow-sm">
                        <i data-lucide="package" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pesanan Aktif</p>
                        <p class="text-3xl font-black text-slate-850 mt-1">{{ $stats['active_orders'] }} <span class="text-xs font-medium text-slate-500 ml-1">pesanan</span></p>
                    </div>
                </div>
                
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:text-indigo-600 border border-slate-100 transition-colors relative z-10">
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </div>
            </a>

            <!-- Cart Items Card -->
            <a href="{{ route('cart.index') }}" class="relative bg-white border border-slate-200/80 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] hover:shadow-md hover:border-pink-500/30 hover:-translate-y-1 transition-all duration-300 flex items-center justify-between group overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-pink-500/5 to-rose-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-pink-50 border border-pink-100 text-pink-600 flex items-center justify-center shadow-sm">
                        <i data-lucide="shopping-cart" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Keranjang Belanja</p>
                        <p class="text-3xl font-black text-slate-850 mt-1">{{ $stats['cart_count'] }} <span class="text-xs font-medium text-slate-500 ml-1">item</span></p>
                    </div>
                </div>
                
                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:text-pink-600 border border-slate-100 transition-colors relative z-10">
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </div>
            </a>

            <!-- Total Spent Card -->
            <div class="relative bg-white border border-slate-200/80 rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.02)] flex items-center justify-between overflow-hidden">
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center shadow-sm">
                        <i data-lucide="wallet" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Belanja (VIP)</p>
                        <p class="text-2xl font-black text-slate-850 mt-1">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-100/50 flex items-center justify-center relative z-10 animate-pulse">
                    <i data-lucide="award" class="w-5 h-5"></i>
                </div>
            </div>

        </div>

        <!-- Recent Orders Progress Timeline -->
        <div class="bg-white border border-slate-200/80 rounded-3xl p-8 mb-12 shadow-[0_8px_30px_rgb(0,0,0,0.02)]" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-xl font-extrabold text-slate-850 mb-6 flex items-center gap-2">
                <i data-lucide="truck" class="w-5 h-5 text-indigo-600"></i> Lacak Pengiriman Terbaru
            </h3>

            @if($recent_orders->isEmpty())
                <div class="text-center py-10 flex flex-col items-center justify-center">
                    <div class="w-16 h-16 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 mb-4 border border-slate-100">
                        <i data-lucide="package-search" class="w-8 h-8"></i>
                    </div>
                    <p class="text-slate-500 text-sm font-semibold">Belum ada aktivitas pesanan aktif saat ini.</p>
                    <p class="text-slate-400 text-xs mt-1">Daftar pesanan baru Anda akan dilacak di panel ini.</p>
                    <a href="{{ route('shop') }}" class="btn btn-sm btn-ghost text-indigo-600 hover:bg-indigo-50 border border-indigo-100 rounded-xl font-bold mt-4 px-6">
                        Mulai Belanja
                    </a>
                </div>
            @else
                <div class="flex flex-col gap-8">
                    @foreach($recent_orders as $order)
                        <div class="p-6 bg-slate-50/50 border border-slate-100 rounded-2xl flex flex-col lg:flex-row lg:items-center justify-between gap-6 transition-all hover:bg-slate-50/90 shadow-sm">
                            <!-- Left: Order Info -->
                            <div>
                                <div class="flex items-center gap-3 flex-wrap mb-2">
                                    <span class="text-xs font-mono font-bold text-slate-400">Invoice: #SA-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $order->status_color }}">
                                        <i data-lucide="{{ $order->status_icon }}" class="w-3 h-3 inline mr-1"></i>{{ $order->status }}
                                    </span>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800 mb-1">
                                    @php $itemNames = $order->items->map(fn($item) => $item->product->name)->toArray(); @endphp
                                    {{ implode(', ', array_slice($itemNames, 0, 2)) }} 
                                    @if(count($itemNames) > 2)
                                        <span class="text-xs text-indigo-600 font-medium">+{{ count($itemNames) - 2 }} item lainnya</span>
                                    @endif
                                </h4>
                                <p class="text-xs text-slate-400">Tanggal Transaksi: {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                            </div>

                            <!-- Middle: Status Timeline -->
                            <div class="flex items-center gap-3 w-full lg:max-w-md">
                                @php 
                                    $statuses = ['Pending', 'Diproses', 'Dikirim', 'Selesai']; 
                                    $currentIndex = array_search($order->status, $statuses);
                                    if ($currentIndex === false) $currentIndex = 0;
                                @endphp
                                @foreach($statuses as $i => $st)
                                    <div class="flex-1 flex flex-col items-center relative">
                                        <!-- Line Connector -->
                                        @if($i < 3)
                                            <div class="absolute top-3.5 left-1/2 w-full h-[2px] {{ $i < $currentIndex ? 'bg-indigo-500' : 'bg-slate-200' }} z-0"></div>
                                        @endif
                                        <!-- Step Icon/Node -->
                                        <div class="w-7 h-7 rounded-full flex items-center justify-center border-2 {{ $i <= $currentIndex ? 'bg-indigo-600 border-indigo-500 text-white shadow-[0_0_10px_rgba(99,102,241,0.2)]' : 'bg-white border-slate-200 text-slate-400' }} text-[10px] font-bold z-10 transition-all duration-300">
                                            @if($i < $currentIndex)
                                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                            @else
                                                {{ $i + 1 }}
                                            @endif
                                        </div>
                                        <span class="text-[9px] font-bold mt-2 {{ $i <= $currentIndex ? 'text-indigo-600' : 'text-slate-400' }}">{{ $st }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Right: Action Button -->
                            <div class="flex items-center justify-between lg:justify-end gap-4 border-t border-slate-100 pt-4 lg:border-none lg:pt-0">
                                <div>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider text-right lg:text-right text-left">Total Pembayaran</p>
                                    <p class="text-sm font-extrabold text-slate-800">{{ $order->formatted_total }}</p>
                                </div>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm bg-white hover:bg-slate-50 text-indigo-600 hover:text-indigo-700 border border-slate-200 hover:border-indigo-400 rounded-xl font-bold px-4 shadow-sm">
                                    Detail <i data-lucide="eye" class="w-3.5 h-3.5 ml-1"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Premium Product Suggestions -->
        <div data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-2xl font-extrabold text-slate-900">Rekomendasi Sneaker Terlaris</h3>
                    <p class="text-slate-500 text-sm mt-0.5">Koleksi kurasi terbaik disesuaikan khusus untuk Anda.</p>
                </div>
                <a href="{{ route('shop') }}" class="text-sm text-indigo-600 font-bold hover:text-indigo-500 flex items-center gap-1 hover:underline transition-all">
                    Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($recommended_products as $product)
                    <a href="{{ route('shoe.show', $product->id) }}" class="block bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.02)] group hover:shadow-md hover:border-indigo-500/30 hover:-translate-y-1 transition-all duration-300">
                        <!-- Image Panel -->
                        <div class="relative overflow-hidden bg-slate-50 h-48 flex items-center justify-center border-b border-slate-100">
                            <img 
                                src="{{ $product->image_url }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                loading="lazy"
                                onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80'"
                            >
                            <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-wider badge-{{ strtolower($product->category) }} shadow-sm">
                                {{ $product->category }}
                            </span>
                        </div>
                        <!-- Info Panel -->
                        <div class="p-5">
                            <h4 class="font-bold text-slate-800 text-sm mb-1 leading-tight group-hover:text-indigo-600 transition-colors line-clamp-1">
                                {{ $product->name }}
                            </h4>
                            <p class="text-slate-400 text-xs mb-3 font-medium">{{ $product->material }}</p>
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-indigo-600 font-black text-sm">{{ $product->formatted_price }}</p>
                                <div class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white border border-indigo-100 group-hover:border-transparent flex items-center justify-center transition-all">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 3D SNEAKER CANVAS SEQUENTIAL ROTATOR LOGIC
    const totalFrames = 240;
    const frames = [];
    let loadedCount = 0;
    let currentFrame = 0;
    let targetFrame = 0; // For physics-based easing interpolation
    let isDragging = false;
    let isHovered = false; // Smart hover tracking
    let startX = 0;
    let startFrame = 0;
    const dragSensitivity = 1.8; // Controls how fast it rotates on drag (was 2.8)

    // Time-delta and inertia velocity variables (millisecond-based calculations)
    let lastTime = performance.now();
    let dragVelocity = 0; // Frames per millisecond
    const defaultSpinSpeed = 0.024; // Smooth ~24 FPS constant auto-spin (was 0.008)
    let activeVelocity = defaultSpinSpeed; 
    let lastMoveTime = performance.now();

    const viewerContainer = document.getElementById('3d-viewer-container');
    const canvas = document.getElementById('3d-shoe-canvas');
    const ctx = canvas.getContext('2d');
    
    const loaderProgress = document.getElementById('rotation-loader-progress');
    const loaderEl = document.getElementById('rotation-loader');
    const displayEl = document.getElementById('frame-display');

    // Preload Sequence Frames in memory as Image objects
    for (let i = 1; i <= totalFrames; i++) {
        const frameNum = String(i).padStart(3, '0');
        const img = new Image();
        img.src = `{{ asset('sequence/ezgif-frame-') }}${frameNum}.jpg`;
        
        const checkCompletion = () => {
            loadedCount++;
            const percent = Math.round((loadedCount / totalFrames) * 100);
            if (loaderProgress) loaderProgress.style.width = percent + '%';
            
            // Match canvas layout dimensions with the raw image's actual resolution
            if (loadedCount === 1) {
                canvas.width = img.naturalWidth || 800;
                canvas.height = img.naturalHeight || 600;
            }

            // Once all frames are completely cached
            if (loadedCount === totalFrames) {
                if (loaderEl) {
                    loaderEl.style.opacity = '0';
                    setTimeout(() => loaderEl.remove(), 350);
                }
                initRotationController();
            }
        };

        img.onload = checkCompletion;
        img.onerror = checkCompletion; // Prevent preloader freeze in case of file missing/network glitch
        frames.push(img); // Store raw HTMLImageElement objects
    }

    let lastRenderedFrame = -1;

    // High performance render loop using requestAnimationFrame
    function render(currentTime) {
        // Calculate dynamic delta time in milliseconds
        const delta = currentTime - lastTime;
        lastTime = currentTime;

        // Cap maximum delta value to prevent huge frame jumps if browser tab loses focus
        const dt = Math.min(delta, 100);

        if (!isDragging) {
            if (isHovered) {
                // Gently decelerate velocity to 0 when hovered so user can inspect the shoe
                const friction = Math.exp(-0.015 * dt);
                activeVelocity = activeVelocity * friction;
            } else {
                // Smoothly accelerate/decelerate back to defaultSpinSpeed
                const friction = Math.exp(-0.003 * dt);
                activeVelocity = defaultSpinSpeed + (activeVelocity - defaultSpinSpeed) * friction;
            }
            
            // Constantly auto-spin targetFrame forward based on elapsed time delta
            targetFrame = (targetFrame + activeVelocity * dt + totalFrames) % totalFrames;
        }

        // Easing interpolation: make currentFrame catch up smoothly to targetFrame
        let diff = targetFrame - currentFrame;
        
        // Handle circular wrapping (shortest path rotation)
        if (diff > totalFrames / 2) diff -= totalFrames;
        if (diff < -totalFrames / 2) diff += totalFrames;

        // Snappy exponential decay based easing factor (was -0.0125, now -0.035)
        const easingFactor = 1 - Math.exp(-0.035 * dt);

        if (Math.abs(diff) > 0.02) {
            currentFrame = (currentFrame + diff * easingFactor + totalFrames) % totalFrames;
        } else {
            currentFrame = (targetFrame + totalFrames) % totalFrames;
        }

        const frameIndex = Math.round(currentFrame) % totalFrames;
        
        // Render current image frame onto canvas ONLY if the frame index has changed
        if (frameIndex !== lastRenderedFrame) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (frames[frameIndex] && frames[frameIndex].complete) {
                ctx.drawImage(frames[frameIndex], 0, 0, canvas.width, canvas.height);
            }
            lastRenderedFrame = frameIndex;
            displayEl.textContent = `Frame: ${frameIndex + 1} / ${totalFrames}`;
        }

        requestAnimationFrame(render);
    }

    function updateTargetFrame(frameIndex) {
        targetFrame = (frameIndex + totalFrames) % totalFrames;
    }

    function initRotationController() {
        // Initialize lastTime timestamp
        lastTime = performance.now();
        // Start the physics rendering loop
        requestAnimationFrame(render);

        // Smart hover events for auto-spin control
        viewerContainer.addEventListener('mouseenter', () => {
            isHovered = true;
        });
        
        viewerContainer.addEventListener('mouseleave', () => {
            isHovered = false;
        });

        // Mouse events
        viewerContainer.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.clientX;
            startFrame = targetFrame;
            lastMoveTime = performance.now();
            activeVelocity = 0; // Freeze auto-spin velocity immediately
            viewerContainer.classList.add('active');
        });

        window.addEventListener('mouseup', () => {
            if (!isDragging) return;
            isDragging = false;
            viewerContainer.classList.remove('active');

            // Apply inertia momentum if let go during active motion
            const timeSinceLastMove = performance.now() - lastMoveTime;
            if (timeSinceLastMove < 80) {
                // Prevent extreme rotation speeds by capping dragVelocity boundaries
                const maxSpeed = 0.22; // frames per millisecond
                activeVelocity = Math.max(-maxSpeed, Math.min(dragVelocity, maxSpeed));
            } else {
                activeVelocity = defaultSpinSpeed; // static release, reset to standard spin
            }
            dragVelocity = 0;
        });

        window.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            const diffX = e.clientX - startX;
            const frameOffset = Math.round(-diffX / dragSensitivity);
            const prevTargetFrame = targetFrame;
            updateTargetFrame(startFrame + frameOffset);

            // Compute instantaneous drag velocity
            const now = performance.now();
            const timeElapsed = now - lastMoveTime;
            if (timeElapsed > 0) {
                let wrappedChange = targetFrame - prevTargetFrame;
                if (wrappedChange > totalFrames / 2) wrappedChange -= totalFrames;
                if (wrappedChange < -totalFrames / 2) wrappedChange += totalFrames;
                
                // Smooth drag velocity with low-pass filter
                dragVelocity = dragVelocity * 0.45 + (wrappedChange / timeElapsed) * 0.55;
            }
            lastMoveTime = now;
        });

        // Touch support for smartphones/tablets
        viewerContainer.addEventListener('touchstart', (e) => {
            isDragging = true;
            startX = e.touches[0].clientX;
            startFrame = targetFrame;
            lastMoveTime = performance.now();
            activeVelocity = 0;
        }, { passive: true });

        window.addEventListener('touchend', () => {
            if (!isDragging) return;
            isDragging = false;

            const timeSinceLastMove = performance.now() - lastMoveTime;
            if (timeSinceLastMove < 80) {
                const maxSpeed = 0.22;
                activeVelocity = Math.max(-maxSpeed, Math.min(dragVelocity, maxSpeed));
            } else {
                activeVelocity = defaultSpinSpeed;
            }
            dragVelocity = 0;
        });

        window.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            const diffX = e.touches[0].clientX - startX;
            const frameOffset = Math.round(-diffX / dragSensitivity);
            const prevTargetFrame = targetFrame;
            updateTargetFrame(startFrame + frameOffset);

            const now = performance.now();
            const timeElapsed = now - lastMoveTime;
            if (timeElapsed > 0) {
                let wrappedChange = targetFrame - prevTargetFrame;
                if (wrappedChange > totalFrames / 2) wrappedChange -= totalFrames;
                if (wrappedChange < -totalFrames / 2) wrappedChange += totalFrames;
                dragVelocity = dragVelocity * 0.45 + (wrappedChange / timeElapsed) * 0.55;
            }
            lastMoveTime = now;
        }, { passive: true });
    }
});
</script>
@endpush

@endsection
