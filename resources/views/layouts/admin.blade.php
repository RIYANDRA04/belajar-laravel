<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — ShoesAsia Panel</title>

    <!-- DaisyUI + Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    <!-- Lucide -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }

        .admin-sidebar {
            background: linear-gradient(180deg, #1e1b4b 0%, #312e81 50%, #1e1b4b 100%);
            min-height: 100vh;
            width: 260px;
            flex-shrink: 0;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 10px;
            color: rgba(255,255,255,0.65);
            font-weight: 500;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            margin-bottom: 2px;
        }
        .sidebar-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(3px);
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(99,102,241,0.6), rgba(139,92,246,0.6));
            color: white;
            box-shadow: 0 4px 12px rgba(99,102,241,0.3);
        }

        .admin-topbar {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0;
            height: 64px;
        }

        .stat-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(99,102,241,0.15);
        }

        .admin-table th {
            background: #f8faff;
            font-weight: 600;
            font-size: 0.8rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .badge-status-pending  { background:#fef3c7; color:#92400e; border:1px solid #fde68a; }
        .badge-status-diproses { background:#dbeafe; color:#1e40af; border:1px solid #bfdbfe; }
        .badge-status-dikirim  { background:#ede9fe; color:#5b21b6; border:1px solid #c4b5fd; }
        .badge-status-selesai  { background:#d1fae5; color:#065f46; border:1px solid #6ee7b7; }

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
<body class="bg-slate-50">
<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="admin-sidebar hidden md:flex flex-col p-5">
        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 mb-8 mt-1 px-2">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-white overflow-hidden">
                <img src="{{ asset('images/logo.png') }}" alt="ShoesAsia" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="text-white font-extrabold text-base leading-none">ShoesAsia</div>
                <div class="text-indigo-300 text-xs">Admin Panel</div>
            </div>
        </a>

        <!-- Navigation -->
        <nav class="flex-1 space-y-1">
            <p class="text-indigo-400 text-xs font-semibold uppercase tracking-widest mb-3 px-2">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
                <i data-lucide="package" class="w-4 h-4"></i> Produk Sepatu
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <i data-lucide="shopping-cart" class="w-4 h-4"></i> Pesanan
                @php $pendingCount = \App\Models\Order::where('status','Pending')->count(); @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto bg-amber-400 text-amber-900 text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                @endif
            </a>

            <div class="my-4 border-t border-indigo-800"></div>
            <p class="text-indigo-400 text-xs font-semibold uppercase tracking-widest mb-3 px-2">Toko</p>

            <a href="{{ route('shop') }}" target="_blank" class="sidebar-link">
                <i data-lucide="store" class="w-4 h-4"></i> Lihat Toko
            </a>
        </nav>

        <!-- User Info & Logout -->
        <div class="mt-4 p-3 rounded-xl bg-white/10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold text-sm">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-white text-sm font-semibold leading-none">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-indigo-300 text-xs">{{ auth()->user()->email ?? '' }}</p>
                </div>
            </div>
            <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>
            <button type="button" onclick="confirmAdminLogout()" class="w-full flex items-center justify-center gap-2 text-red-300 hover:text-red-100 text-sm font-medium py-1.5 rounded-lg hover:bg-red-500/20 transition-all">
                <i data-lucide="log-out" class="w-4 h-4"></i> Logout
            </button>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- TOPBAR -->
        <header class="admin-topbar sticky top-0 z-40 flex items-center justify-between px-6">
            <div>
                <h1 class="font-bold text-gray-800 text-base leading-none">@yield('page-title', 'Dashboard')</h1>
                <p class="text-gray-400 text-xs mt-0.5">@yield('page-subtitle', 'Selamat datang di admin panel ShoesAsia')</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Mobile sidebar toggle -->
                <label for="sidebar-mobile" class="btn btn-ghost btn-circle md:hidden">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </label>
                <a href="{{ route('shop') }}" target="_blank" class="btn btn-sm btn-ghost gap-1 hidden md:flex">
                    <i data-lucide="external-link" class="w-4 h-4"></i> Lihat Toko
                </a>
                <div class="flex items-center gap-2 bg-slate-100 rounded-full px-3 py-1.5">
                    <div class="w-6 h-6 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xs font-bold">
                        {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                    </div>
                    <span class="text-sm font-medium text-gray-700 hidden sm:block">{{ auth()->user()->name ?? 'Admin' }}</span>
                </div>
            </div>
        </header>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="mx-6 mt-4 alert text-white rounded-xl border-0 shadow-sm" style="background:linear-gradient(135deg,#10b981,#34d399)" data-aos="fade-down">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mx-6 mt-4 alert text-white rounded-xl border-0 shadow-sm" style="background:linear-gradient(135deg,#ef4444,#f87171)" data-aos="fade-down">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</div>

<!-- AOS + Lucide -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 600, once: true, easing: 'ease-out-cubic' });
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

    function confirmAdminLogout() {
        document.getElementById('admin-logout-modal').style.display = 'flex';
        setTimeout(() => {
            document.getElementById('admin-logout-modal-box').style.opacity = '1';
            document.getElementById('admin-logout-modal-box').style.transform = 'scale(1)';
        }, 10);
    }
    function closeAdminLogoutModal() {
        document.getElementById('admin-logout-modal-box').style.opacity = '0';
        document.getElementById('admin-logout-modal-box').style.transform = 'scale(0.95)';
        setTimeout(() => {
            document.getElementById('admin-logout-modal').style.display = 'none';
        }, 200);
    }
    function doAdminLogout() {
        document.getElementById('admin-logout-form').submit();
    }
</script>

<!-- Admin Logout Confirmation Modal -->
<div id="admin-logout-modal" style="display:none;position:fixed;inset:0;z-index:9999;align-items:center;justify-content:center;padding:1rem;background:rgba(15,12,41,0.75);backdrop-filter:blur(8px)">
    <div id="admin-logout-modal-box" style="background:#fff;border-radius:1.5rem;box-shadow:0 25px 60px rgba(0,0,0,0.3);width:100%;max-width:380px;padding:2rem;transform:scale(0.95);opacity:0;transition:transform 0.2s ease,opacity 0.2s ease">
        <!-- Text -->
        <div style="text-align:center;margin-bottom:1.75rem">
            <h3 style="font-size:1.25rem;font-weight:800;color:#111827;margin-bottom:.5rem">Keluar dari Admin Panel?</h3>
            <p style="font-size:.875rem;color:#6b7280;line-height:1.6">Sesi admin kamu akan diakhiri. Kamu perlu login kembali untuk mengakses panel ini.</p>
        </div>
        <!-- Buttons -->
        <div style="display:flex;gap:.75rem">
            <button onclick="closeAdminLogoutModal()" style="flex:1;padding:.75rem;border-radius:1rem;font-weight:700;font-size:.875rem;color:#4b5563;border:2px solid #e2e8f0;background:#fff;cursor:pointer" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
                Batal
            </button>
            <button onclick="doAdminLogout()" style="flex:1;padding:.75rem;border-radius:1rem;font-weight:700;font-size:.875rem;color:#fff;border:none;background:linear-gradient(135deg,#6366f1,#8b5cf6);box-shadow:0 4px 15px rgba(99,102,241,0.4);cursor:pointer" onmouseover="this.style.opacity='.9'" onmouseout="this.style.opacity='1'">
                Ya, Logout
            </button>
        </div>
    </div>
</div>


@stack('scripts')
</body>
</html>
