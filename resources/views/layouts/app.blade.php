<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ShoesAsia — Toko Sepatu Online Terbaik. Temukan koleksi Running, Lifestyle, Basket, dan Training.">
    <title>@yield('title', 'ShoesAsia — Toko Sepatu Modern')</title>

    <!-- DaisyUI + Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- FontAwesome for brand-specific icons (TikTok, WhatsApp) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
            --card-shadow: 0 4px 24px rgba(99,102,241,0.10);
            --card-hover-shadow: 0 12px 40px rgba(99,102,241,0.22);
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
        }

        .product-card {
            transition: transform 0.35s cubic-bezier(.4,2,.6,1), box-shadow 0.35s ease;
        }
        .product-card:hover {
            transform: translateY(-8px) scale(1.025);
            box-shadow: var(--card-hover-shadow);
        }

        .btn-cart-bounce:active {
            transform: scale(0.92);
        }

        .navbar-glass {
            backdrop-filter: blur(16px);
            background: rgba(255,255,255,0.85);
            border-bottom: 1px solid rgba(99,102,241,0.08);
        }

        .category-pill {
            transition: all 0.25s ease;
        }
        .category-pill:hover, .category-pill.active {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99,102,241,0.35);
        }

        .badge-running   { background: linear-gradient(135deg,#6366f1,#818cf8); color:#fff; }
        .badge-lifestyle { background: linear-gradient(135deg,#ec4899,#f472b6); color:#fff; }
        .badge-basket    { background: linear-gradient(135deg,#f59e0b,#fbbf24); color:#fff; }
        .badge-training  { background: linear-gradient(135deg,#10b981,#34d399); color:#fff; }

        .cart-badge-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-10px); }
        }
        .float-anim { animation: float 3s ease-in-out infinite; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #6366f1; border-radius: 3px; }

        /* Fix browser autofill white/grey/yellow background styling completely */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active,
        input:-internal-autofill-selected,
        input:autofill,
        input:autofill:hover,
        input:autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #ffffff inset !important;
            -webkit-text-fill-color: #374151 !important;
            caret-color: #374151 !important;
            background-color: transparent !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        /* Premium Glassmorphic Dropdowns & Selects styling globally */
        .custom-dropdown .dropdown-btn {
            background: #ffffff !important;
            border: 1px solid rgba(99, 102, 241, 0.15) !important;
            color: #374151 !important;
            border-radius: 1rem !important;
            padding: 0.75rem 1.25rem !important;
            font-weight: 700 !important;
            font-size: 0.875rem !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .custom-dropdown .dropdown-btn:hover {
            background: #f8fafc !important;
            border-color: rgba(99, 102, 241, 0.3) !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 25px rgba(99, 102, 241, 0.08) !important;
        }

        .custom-dropdown .dropdown-btn:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15) !important;
        }

        .custom-dropdown .dropdown-menu {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(16px) !important;
            border: 1px solid rgba(99, 102, 241, 0.1) !important;
            border-radius: 1.25rem !important;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12) !important;
            padding: 0.5rem !important;
            transition: all 0.2s ease-in-out !important;
        }

        .custom-dropdown .dropdown-item {
            border-radius: 0.75rem !important;
            padding: 0.75rem 1rem !important;
            color: #4b5563 !important;
            font-weight: 700 !important;
            font-size: 0.875rem !important;
            transition: all 0.2s ease !important;
        }

        .custom-dropdown .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.08), rgba(139, 92, 246, 0.08)) !important;
            color: #6366f1 !important;
            padding-left: 1.25rem !important;
        }

        .custom-dropdown .dropdown-item .check-icon {
            color: #6366f1 !important;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-base-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="navbar-glass sticky top-0 z-50 px-4 md:px-8 shadow-sm">
        <div class="max-w-7xl mx-auto w-full flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ Auth::check() ? route('dashboard') : route('shop') }}" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-white overflow-hidden shadow-sm">
                    <img src="{{ asset('images/logo.png') }}" alt="ShoesAsia" class="w-full h-full object-cover">
                </div>
                <span class="text-xl font-extrabold bg-clip-text text-transparent" style="background-image:linear-gradient(135deg,#6366f1,#8b5cf6);-webkit-background-clip:text;">ShoesAsia</span>
            </a>

            <!-- Nav links -->
            <div class="hidden md:flex items-center gap-6">
                @auth
                <a href="{{ route('dashboard') }}" class="font-semibold {{ Route::currentRouteName() === 'dashboard' ? 'text-indigo-600' : 'text-gray-600' }} hover:text-indigo-600 transition-colors">Dashboard</a>
                @endauth
                <a href="{{ route('shop') }}" class="font-semibold {{ Route::currentRouteName() === 'shop' ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600 transition-colors">Shop</a>
                @auth
                <a href="{{ route('orders.index') }}" class="font-medium {{ Route::currentRouteName() === 'orders.index' ? 'text-indigo-600' : 'text-gray-500' }} hover:text-indigo-600 transition-colors flex items-center gap-1">
                    <i data-lucide="package" class="w-4 h-4"></i> Pesanan
                </a>
                @endauth
            </div>

            <!-- Right actions -->
            <div class="flex items-center gap-3">
                <a href="{{ route('cart.index') }}" class="btn btn-ghost btn-circle relative">
                    <i data-lucide="shopping-bag" class="w-5 h-5 text-gray-600"></i>
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 rounded-full text-white text-xs flex items-center justify-center font-bold cart-badge-pulse" style="background:#6366f1">{{ $cartCount }}</span>
                    @endif
                </a>
                @auth
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm font-semibold hidden md:flex gap-1" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;border:none">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Admin
                        </a>
                    @endif
                    <button onclick="confirmLogout()" class="btn btn-sm font-semibold hidden md:flex gap-1 bg-red-50 text-red-600 hover:bg-red-100 border-none">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                    </button>
                @endauth
                <!-- Mobile menu -->
                <div class="dropdown dropdown-end md:hidden">
                    <label tabindex="0" class="btn btn-ghost btn-circle">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-base-100 rounded-2xl w-52 mt-2 border border-base-200">
                        @auth
                            <li><a href="{{ route('dashboard') }}"><i data-lucide="layout-dashboard" class="w-4 h-4 inline mr-2"></i> Dashboard</a></li>
                        @endauth
                        <li><a href="{{ route('shop') }}"><i data-lucide="home" class="w-4 h-4 inline mr-2"></i> Shop</a></li>
                        <li><a href="{{ route('cart.index') }}"><i data-lucide="shopping-cart" class="w-4 h-4 inline mr-2"></i> Keranjang</a></li>
                        @auth
                            @if(Auth::user()->is_admin)
                                <li><a href="{{ route('admin.dashboard') }}"><i data-lucide="settings" class="w-4 h-4 inline mr-2"></i> Admin Panel</a></li>
                            @endif
                            <li><a href="{{ route('orders.index') }}"><i data-lucide="package" class="w-4 h-4 inline mr-2"></i> Pesanan Saya</a></li>
                            <li><a href="#" onclick="event.preventDefault(); confirmLogout();"><i data-lucide="log-out" class="w-4 h-4 inline mr-2"></i> Logout</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="fixed top-20 right-4 z-50 max-w-sm" id="flash-success">
            <div class="alert shadow-lg rounded-2xl border-0 text-white" style="background:linear-gradient(135deg,#10b981,#34d399)">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button onclick="document.getElementById('flash-success').remove()" class="btn btn-ghost btn-xs btn-circle"><i data-lucide="x" class="w-3 h-3"></i></button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="fixed top-20 right-4 z-50 max-w-sm" id="flash-error">
            <div class="alert shadow-lg rounded-2xl border-0 text-white" style="background:linear-gradient(135deg,#ef4444,#f87171)">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
                <button onclick="document.getElementById('flash-error').remove()" class="btn btn-ghost btn-xs btn-circle"><i data-lucide="x" class="w-3 h-3"></i></button>
            </div>
        </div>
    @endif

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="mt-32 border-t border-slate-800 bg-slate-950 text-slate-200" style="background: linear-gradient(to bottom, #0f172a, #020617);">
        <div class="max-w-7xl mx-auto px-6 pt-16 pb-8">
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Column 1: Brand Profile & Social Media -->
                <div class="flex flex-col gap-6" data-aos="fade-up" data-aos-delay="100">
                    <!-- Brand Logo -->
                    <a href="{{ Auth::check() ? route('dashboard') : route('shop') }}" class="flex items-center gap-3 group w-max">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-white overflow-hidden shadow-lg ring-2 ring-indigo-500/20 group-hover:ring-indigo-500 transition-all duration-300">
                            <img src="{{ asset('images/logo.png') }}" alt="ShoesAsia Logo" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <span class="text-2xl font-black bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 tracking-wider">ShoesAsia</span>
                    </a>
                    
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm">
                        ShoesAsia adalah destinasi terpercaya untuk sneaker premium. Kami menghadirkan koleksi sepatu terbaik yang dirancang untuk performa optimal, kenyamanan harian, dan gaya hidup modern Anda.
                    </p>

                    <!-- Social Media Links -->
                    <div class="flex items-center gap-3 mt-2">
                        <!-- Instagram -->
                        <a href="https://www.instagram.com/ryannndrraa_?igsh=MTNwYjY1d3RudHpqYg%3D%3D&utm_source=qr" target="_blank" title="Instagram" 
                           class="w-10 h-10 rounded-xl flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-white hover:border-pink-500 hover:bg-gradient-to-tr hover:from-yellow-600 hover:via-red-500 hover:to-purple-600 shadow-md hover:shadow-pink-500/20 transform hover:-translate-y-1 transition-all duration-300">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>
                        <!-- TikTok -->
                        <a href="https://www.tiktok.com/@riiaaannnnn_" target="_blank" title="TikTok" 
                           class="w-10 h-10 rounded-xl flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-white hover:border-cyan-400 hover:bg-black shadow-md hover:shadow-cyan-400/20 transform hover:-translate-y-1 transition-all duration-300">
                            <i class="fa-brands fa-tiktok text-lg"></i>
                        </a>
                        <!-- WhatsApp -->
                        <a href="https://wa.me/6285823192432" target="_blank" title="WhatsApp" 
                           class="w-10 h-10 rounded-xl flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-white hover:border-emerald-500 hover:bg-emerald-600 shadow-md hover:shadow-emerald-500/20 transform hover:-translate-y-1 transition-all duration-300">
                            <i class="fa-brands fa-whatsapp text-xl"></i>
                        </a>
                        <!-- Twitter -->
                        <a href="https://twitter.com" target="_blank" title="Twitter" 
                           class="w-10 h-10 rounded-xl flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-white hover:border-sky-400 hover:bg-sky-500 shadow-md hover:shadow-sky-400/20 transform hover:-translate-y-1 transition-all duration-300">
                            <i class="fa-brands fa-twitter text-xl"></i>
                        </a>
                        <!-- GitHub -->
                        <a href="https://github.com/RIYANDRA04" target="_blank" title="GitHub" 
                           class="w-10 h-10 rounded-xl flex items-center justify-center bg-slate-900 border border-slate-800 text-slate-400 hover:text-white hover:border-slate-100 hover:bg-slate-800 shadow-md hover:shadow-white/10 transform hover:-translate-y-1 transition-all duration-300">
                            <i class="fa-brands fa-github text-xl"></i>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Products Categories -->
                <div class="flex flex-col gap-4" data-aos="fade-up" data-aos-delay="200">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-slate-100 border-l-4 border-indigo-500 pl-3">Kategori Produk</h4>
                    <ul class="flex flex-col gap-3 text-sm text-slate-400">
                        <li>
                            <a href="{{ route('shop') }}?category=Running" class="hover:text-indigo-400 hover:underline transition-colors duration-200 flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-indigo-400 transition-colors"></span>
                                Sepatu Running
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shop') }}?category=Lifestyle" class="hover:text-indigo-400 hover:underline transition-colors duration-200 flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-indigo-400 transition-colors"></span>
                                Sepatu Lifestyle
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shop') }}?category=Basket" class="hover:text-indigo-400 hover:underline transition-colors duration-200 flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-indigo-400 transition-colors"></span>
                                Sepatu Basket
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shop') }}?category=Training" class="hover:text-indigo-400 hover:underline transition-colors duration-200 flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-indigo-400 transition-colors"></span>
                                Sepatu Training
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Quick Navigation -->
                <div class="flex flex-col gap-4" data-aos="fade-up" data-aos-delay="300">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-slate-100 border-l-4 border-indigo-500 pl-3">Navigasi Toko</h4>
                    <ul class="flex flex-col gap-3 text-sm text-slate-400">
                        <li>
                            <a href="{{ route('shop') }}" class="hover:text-indigo-400 hover:underline transition-colors duration-200 flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-indigo-400 transition-colors"></span>
                                Belanja Sekarang
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart.index') }}" class="hover:text-indigo-400 hover:underline transition-colors duration-200 flex items-center gap-2 group">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-indigo-400 transition-colors"></span>
                                Keranjang Belanja
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="{{ route('orders.index') }}" class="hover:text-indigo-400 hover:underline transition-colors duration-200 flex items-center gap-2 group">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-indigo-400 transition-colors"></span>
                                    Pesanan Saya
                                </a>
                            </li>
                            @if(Auth::user()->is_admin)
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-400 hover:underline transition-colors duration-200 flex items-center gap-2 group">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-indigo-400 transition-colors"></span>
                                        Admin Dashboard
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="#" onclick="event.preventDefault(); confirmLogout();" class="hover:text-red-400 hover:underline transition-colors duration-200 flex items-center gap-2 group">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-700 group-hover:bg-red-400 transition-colors"></span>
                                    Logout Sesi
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>

                <!-- Column 4: Customer Care & Services -->
                <div class="flex flex-col gap-4" data-aos="fade-up" data-aos-delay="400">
                    <h4 class="text-sm font-bold uppercase tracking-wider text-slate-100 border-l-4 border-indigo-500 pl-3">Layanan & Keamanan</h4>
                    <div class="flex flex-col gap-4 text-xs text-slate-400">
                        <div class="flex items-start gap-3">
                            <div class="p-2 rounded-lg bg-slate-900 border border-slate-800 text-indigo-400 mt-0.5">
                                <i data-lucide="shield" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-slate-200 mb-0.5">100% Produk Original</h5>
                                <p class="leading-relaxed">Garansi uang kembali jika produk terbukti tidak asli.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="p-2 rounded-lg bg-slate-900 border border-slate-800 text-indigo-400 mt-0.5">
                                <i data-lucide="truck" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h5 class="font-semibold text-slate-200 mb-0.5">Pengiriman Cepat & Aman</h5>
                                <p class="leading-relaxed">Bekerja sama dengan ekspedisi terpercaya di seluruh Indonesia.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider Line -->
            <div class="border-t border-slate-900 my-8"></div>

            <!-- Bottom Foot Row -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 text-sm text-slate-500">
                <!-- Copyright with user name and dynamic year -->
                <div class="flex items-center gap-1.5 flex-wrap justify-center md:justify-start">
                    <span>©</span>
                    <span id="year">{{ date('Y') }}</span>
                    <span class="font-medium text-slate-400">ShoesAsia</span>
                    <span class="text-slate-600">|</span>
                    <a href="https://github.com/RIYANDRA04" target="_blank" class="hover:text-indigo-400 transition-colors">Muh. Riyandra</a>
                </div>

                <!-- Payment Methods Grid -->
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <span class="text-xs text-slate-600 uppercase tracking-widest mr-2">Metode Pembayaran</span>
                    <span class="px-2 py-1 rounded bg-slate-900 border border-slate-800 text-slate-400 text-xs font-bold font-mono tracking-wider shadow-sm">VISA</span>
                    <span class="px-2 py-1 rounded bg-slate-900 border border-slate-800 text-slate-400 text-xs font-bold font-mono tracking-wider shadow-sm">MASTERCARD</span>
                    <span class="px-2 py-1 rounded bg-slate-900 border border-slate-800 text-slate-400 text-xs font-bold font-mono tracking-wider shadow-sm">BANK TRANSFER</span>
                    <span class="px-2 py-1 rounded bg-slate-900 border border-slate-800 text-slate-400 text-xs font-bold font-mono tracking-wider shadow-sm">E-WALLET</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 700, once: true, easing: 'ease-out-cubic' });
        lucide.createIcons();

        // Auto-Upgrade Standard Select Elements to Premium Custom Dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('select.select');
            selects.forEach(select => {
                if (select.multiple || select.classList.contains('custom-dropdown-processed')) return;
                select.classList.add('custom-dropdown-processed');
                select.style.display = 'none';
                
                const wrapper = document.createElement('div');
                wrapper.className = 'relative custom-dropdown w-full';
                
                const options = Array.from(select.options);
                const selectedOption = select.options[select.selectedIndex] || select.options[0];
                
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'w-full bg-white border border-slate-200 text-gray-700 rounded-xl px-4 py-3 flex items-center justify-between text-sm font-semibold transition-all hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 shadow-sm dropdown-btn';
                
                const label = document.createElement('span');
                label.className = 'dropdown-label';
                label.textContent = selectedOption ? selectedOption.textContent : 'Pilih opsi';
                btn.appendChild(label);
                
                const icon = document.createElement('i');
                icon.setAttribute('data-lucide', 'chevron-down');
                icon.className = 'w-4 h-4 text-indigo-500 transition-transform duration-200 dropdown-icon';
                btn.appendChild(icon);
                
                wrapper.appendChild(btn);
                
                const menu = document.createElement('div');
                menu.className = 'absolute z-50 left-0 right-0 mt-2 bg-white border border-slate-150 rounded-xl shadow-xl py-1.5 hidden opacity-0 translate-y-[-10px] transition-all duration-200 dropdown-menu';
                
                options.forEach(opt => {
                    const item = document.createElement('button');
                    item.type = 'button';
                    item.className = 'w-full px-4 py-2.5 text-left text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 flex items-center justify-between transition-colors dropdown-item';
                    item.setAttribute('data-value', opt.value);
                    
                    const itemText = document.createElement('span');
                    itemText.textContent = opt.textContent;
                    item.appendChild(itemText);
                    
                    if (opt.selected) {
                        const checkIcon = document.createElement('i');
                        checkIcon.setAttribute('data-lucide', 'check');
                        checkIcon.className = 'w-4 h-4 text-indigo-600 check-icon';
                        item.appendChild(checkIcon);
                    }
                    
                    item.addEventListener('click', function(e) {
                        e.stopPropagation();
                        select.value = opt.value;
                        
                        const event = new Event('change', { bubbles: true });
                        select.dispatchEvent(event);
                        
                        label.textContent = opt.textContent;
                        
                        menu.querySelectorAll('.check-icon').forEach(c => c.remove());
                        const check = document.createElement('i');
                        check.setAttribute('data-lucide', 'check');
                        check.className = 'w-4 h-4 text-indigo-600 check-icon';
                        item.appendChild(check);
                        
                        if (window.lucide) window.lucide.createIcons();
                        closeMenu();
                    });
                    
                    menu.appendChild(item);
                });
                
                wrapper.appendChild(menu);
                select.parentNode.insertBefore(wrapper, select);
                
                function openMenu() {
                    document.querySelectorAll('.custom-dropdown .dropdown-menu').forEach(m => {
                        if (m !== menu) {
                            m.classList.add('hidden');
                            m.classList.remove('opacity-100', 'translate-y-0');
                            m.classList.add('opacity-0', 'translate-y-[-10px]');
                            const otherIcon = m.parentNode.querySelector('.dropdown-icon');
                            if (otherIcon) otherIcon.classList.remove('rotate-180');
                        }
                    });
                    
                    menu.classList.remove('hidden');
                    setTimeout(() => {
                        menu.classList.remove('opacity-0', 'translate-y-[-10px]');
                        menu.classList.add('opacity-100', 'translate-y-0');
                    }, 10);
                    icon.classList.add('rotate-180');
                }
                
                function closeMenu() {
                    menu.classList.add('hidden');
                    menu.classList.remove('opacity-100', 'translate-y-0');
                    menu.classList.add('opacity-0', 'translate-y-[-10px]');
                    icon.classList.remove('rotate-180');
                }
                
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isOpen = !menu.classList.contains('hidden');
                    if (isOpen) {
                        closeMenu();
                    } else {
                        openMenu();
                    }
                });
                
                document.addEventListener('click', closeMenu);
            });
            
            if (window.lucide) window.lucide.createIcons();
        });
        // Auto-dismiss flash
        setTimeout(() => {
            ['flash-success','flash-error'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.opacity = '0', setTimeout(() => el.remove(), 400);
            });
            document.getElementById('flash-success') && (document.getElementById('flash-success').style.transition = 'opacity .4s');
            document.getElementById('flash-error')   && (document.getElementById('flash-error').style.transition   = 'opacity .4s');
        }, 4000);

        function confirmLogout() {
            const modal = document.getElementById('logout-modal');
            modal.style.display = 'flex';
            setTimeout(() => {
                document.getElementById('logout-modal-box').style.opacity = '1';
                document.getElementById('logout-modal-box').style.transform = 'scale(1)';
            }, 10);
        }
        function closeLogoutModal() {
            document.getElementById('logout-modal-box').style.opacity = '0';
            document.getElementById('logout-modal-box').style.transform = 'scale(0.95)';
            setTimeout(() => {
                document.getElementById('logout-modal').style.display = 'none';
            }, 200);
        }
        function doLogout() {
            document.getElementById('logout-form').submit();
        }
    </script>

    <!-- Logout Confirmation Modal -->
    <div id="logout-modal" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;padding:1rem;background:rgba(15,12,41,0.65);backdrop-filter:blur(6px)">
        <div id="logout-modal-box" style="background:#fff;border-radius:1.5rem;box-shadow:0 25px 60px rgba(0,0,0,0.3);width:100%;max-width:380px;padding:2rem;transform:scale(0.95);opacity:0;transition:transform 0.2s ease,opacity 0.2s ease">
            <!-- Text -->
            <div style="text-align:center;margin-bottom:1.75rem">
                <h3 style="font-size:1.25rem;font-weight:800;color:#111827;margin-bottom:.5rem">Keluar dari ShoesAsia?</h3>
                <p style="font-size:.875rem;color:#6b7280;line-height:1.6">Kamu akan keluar dari sesi ini. Pastikan semua aktivitas sudah selesai sebelum logout.</p>
            </div>
            <!-- Buttons -->
            <div style="display:flex;gap:.75rem">
                <button onclick="closeLogoutModal()" style="flex:1;padding:.75rem;border-radius:1rem;font-weight:700;font-size:.875rem;color:#4b5563;border:2px solid #e2e8f0;background:#fff;cursor:pointer;transition:all .2s" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                    Batal
                </button>
                <button onclick="doLogout()" style="flex:1;padding:.75rem;border-radius:1rem;font-weight:700;font-size:.875rem;color:#fff;border:none;background:linear-gradient(135deg,#6366f1,#8b5cf6);box-shadow:0 4px 15px rgba(99,102,241,0.4);cursor:pointer;transition:opacity .2s" onmouseover="this.style.opacity='.9'" onmouseout="this.style.opacity='1'">
                    Ya, Logout
                </button>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @stack('scripts')
</body>
</html>
