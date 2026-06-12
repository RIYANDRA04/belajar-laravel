<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — ShoesAsia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        card: '#151722',
                        input: '#1d202e',
                        bodybg: '#0c0d14'
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { 
            background-color: #0c0d14; 
            color: #ffffff; 
            position: relative;
            overflow-x: hidden;
        }

        /* Floating background ambient glow */
        @keyframes float-glow {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.3; }
            50% { transform: translate(30px, -40px) scale(1.15); opacity: 0.45; }
        }

        .ambient-glow-1 {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.22) 0%, rgba(139,92,246,0.06) 50%, transparent 100%);
            top: -15%;
            left: -10%;
            z-index: 1;
            filter: blur(80px);
            animation: float-glow 10s ease-in-out infinite;
            pointer-events: none;
        }

        .ambient-glow-2 {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(236,72,153,0.18) 0%, rgba(244,63,94,0.04) 50%, transparent 100%);
            bottom: -20%;
            right: -10%;
            z-index: 1;
            filter: blur(100px);
            animation: float-glow 14s ease-in-out infinite reverse;
            pointer-events: none;
        }

        /* Premium Shimmer Button effect */
        .btn-premium-shimmer {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-premium-shimmer::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -70%;
            width: 40%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.35) 30%,
                rgba(255, 255, 255, 0.8) 50%,
                rgba(255, 255, 255, 0.35) 70%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(25deg);
            opacity: 0;
            transition: none;
        }

        .btn-premium-shimmer:hover::after {
            opacity: 1;
            left: 130%;
            transition: left 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-premium-shimmer:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 30px -5px rgba(99,102,241,0.5), 0 10px 25px -6px rgba(236,72,153,0.4);
            filter: brightness(1.1);
        }

        .btn-premium-shimmer:active {
            transform: translateY(1px) scale(0.98);
        }

        /* Secondary Button (Glassmorphism) */
        .btn-premium-secondary {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(12px);
        }

        .btn-premium-secondary:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px) scale(1.02);
            color: #ffffff;
            box-shadow: 0 15px 30px -10px rgba(255, 255, 255, 0.15);
        }

        .btn-premium-secondary:active {
            transform: translateY(1px) scale(0.98);
        }

        /* Custom Input Styling */
        .premium-input-wrapper {
            background: rgba(15, 17, 26, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .premium-input-wrapper:focus-within {
            border-color: rgba(99, 102, 241, 0.6);
            background: rgba(15, 17, 26, 0.85);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.15), inset 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .premium-input-wrapper:focus-within svg {
            color: #818cf8 !important;
            filter: drop-shadow(0 0 6px rgba(129, 140, 248, 0.6));
            transition: all 0.3s ease;
        }

        /* Premium Link with Animated Gradient Underline */
        .premium-link {
            position: relative;
            background: linear-gradient(135deg, #a5b4fc, #f472b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            display: inline-block;
        }

        .premium-link::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #6366f1, #ec4899);
            transform: scaleX(0);
            transform-origin: bottom center;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .premium-link:hover::after {
            transform: scaleX(1);
        }

        /* Custom Checkbox Toggle */
        .checkbox-container input {
            display: none;
        }

        .checkbox-custom {
            width: 22px;
            height: 22px;
            border: 2px solid rgba(255, 255, 255, 0.18);
            border-radius: 6px;
            position: relative;
            background: rgba(0,0,0,0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .checkbox-container input:checked + .checkbox-custom {
            background: linear-gradient(135deg, #6366f1, #ec4899);
            border-color: transparent;
            box-shadow: 0 0 12px rgba(99,102,241,0.5);
        }

        .checkbox-custom::after {
            content: '';
            position: absolute;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            top: 2px;
            left: 6px;
            transform: rotate(45deg) scale(0);
            transition: transform 0.25s cubic-bezier(0.4, 2, 0.2, 1);
        }

        .checkbox-container input:checked + .checkbox-custom::after {
            transform: rotate(45deg) scale(1);
        }

        /* Fix browser autofill white/grey/yellow background styling completely */
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active,
        input:-internal-autofill-selected,
        input:autofill,
        input:autofill:hover,
        input:autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #151722 inset !important;
            -webkit-text-fill-color: #ffffff !important;
            caret-color: #ffffff !important;
            background-color: transparent !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 lg:p-10 relative">

    <!-- Glowing Abstract Background Orbs -->
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="bg-card w-full max-w-6xl flex flex-col lg:flex-row rounded-[2.5rem] overflow-hidden shadow-[0_30px_100px_rgba(99,102,241,0.15),0_10px_50px_rgba(0,0,0,0.6)] border border-white/[0.06] relative min-h-[700px] z-10 backdrop-blur-3xl">

        <!-- Left Side (Form) -->
        <div class="w-full lg:w-[55%] p-8 lg:p-16 flex flex-col relative z-10 bg-card">

            <!-- Navigation -->
            <nav class="flex items-center justify-between mb-12">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl overflow-hidden shadow-[0_0_15px_rgba(99,102,241,0.3)] border border-indigo-500/20">
                        <img src="{{ asset('images/logo.png') }}" alt="ShoesAsia" class="w-full h-full object-cover" onerror="this.parentElement.style.background='linear-gradient(135deg,#6366f1,#8b5cf6)'">
                    </div>
                    <span class="font-black text-xl tracking-wide bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400">ShoesAsia</span>
                </div>
                <div class="hidden sm:flex gap-8 text-sm font-semibold items-center">
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400 border-b-2 border-indigo-500/80 pb-0.5 select-none">Masuk</span>
                    <a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors duration-200">Daftar</a>
                </div>
            </nav>

            <div class="max-w-md w-full mx-auto flex-1 flex flex-col justify-center">
                <p class="text-xs font-extrabold text-indigo-400 tracking-widest uppercase mb-3">SELAMAT DATANG KEMBALI</p>
                <h1 class="text-4xl lg:text-5xl font-black mb-3 tracking-tight bg-clip-text text-transparent bg-gradient-to-br from-white via-slate-100 to-slate-400">Masuk ke akun<span class="text-indigo-500">.</span></h1>
                <p class="text-gray-400 font-medium mb-10 text-sm">
                    Belum punya akun? <a href="{{ route('register') }}" class="premium-link">Daftar Sekarang</a>
                </p>

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                        <div class="flex items-start gap-3">
                            <i data-lucide="alert-circle" class="w-5 h-5 flex-shrink-0 mt-0.5"></i>
                            <ul class="list-disc pl-4 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                	@endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email address wrapper -->
                    <div class="premium-input-wrapper rounded-2xl p-1 flex items-center relative overflow-hidden">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email address" class="w-full bg-transparent text-white px-4 py-3.5 outline-none text-sm font-medium placeholder-gray-500" required>
                        <i data-lucide="mail" class="w-5 h-5 text-gray-500 mr-4 transition-all duration-300"></i>
                    </div>

                    <!-- Password wrapper -->
                    <div class="premium-input-wrapper rounded-2xl p-1 flex items-center relative overflow-hidden">
                        <input type="password" name="password" placeholder="Password" class="w-full bg-transparent text-white px-4 py-3.5 outline-none text-sm font-medium tracking-wide placeholder-gray-500" required>
                        <i data-lucide="lock" class="w-5 h-5 text-gray-500 mr-4 transition-all duration-300"></i>
                    </div>

                    <!-- Remember me logic -->
                    <div class="flex items-center gap-3 px-1 mt-2 mb-4">
                        <label class="checkbox-container flex items-center gap-3 px-4 py-3.5 rounded-2xl border border-white/5 bg-white/[0.02] text-sm text-gray-300 cursor-pointer transition hover:border-indigo-500/50 hover:bg-white/[0.04]">
                            <input type="checkbox" name="remember" />
                            <div class="checkbox-custom"></div>
                            <span class="font-bold tracking-wide text-xs">Remember me</span>
                        </label>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('register') }}" class="btn-premium-secondary rounded-full py-4 px-8 text-xs font-extrabold text-center sm:flex-1 text-gray-300">Belum punya akun?</a>
                        <button type="submit" class="btn-premium-shimmer rounded-full py-4 px-8 text-xs font-extrabold text-center sm:flex-1 text-white">Masuk</button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Right Side (Image & Mask) -->
        <div class="hidden lg:block w-[45%] relative overflow-hidden">
            <!-- Background Image: Premium sneaker display -->
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=1200&q=85'); filter: brightness(0.55) contrast(1.1);"></div>

            <!-- Subtle gradient overlay for blending -->
            <div class="absolute inset-0 bg-gradient-to-r from-card/85 via-transparent to-transparent"></div>
            <div class="absolute inset-0 bg-[#0c0d14]/40 mix-blend-multiply"></div>

            <!-- Custom curved SVG Mask for the left edge -->
            <svg class="absolute left-0 top-0 h-full w-[250px] text-card -translate-x-[1px] pointer-events-none" preserveAspectRatio="none" viewBox="0 0 100 1024" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M0,0 C30,150 70,250 50,500 C30,750 80,850 60,1024 L0,1024 Z"></path>
            </svg>

            <!-- Dashed line decoration -->
            <svg class="absolute left-0 top-0 h-full w-[270px] -translate-x-[1px] opacity-25 pointer-events-none" preserveAspectRatio="none" viewBox="0 0 100 1024" fill="none" stroke="white" stroke-width="1" stroke-dasharray="4 6" xmlns="http://www.w3.org/2000/svg">
                <path d="M5,0 C35,150 75,250 55,500 C35,750 85,850 65,1024"></path>
            </svg>

            <!-- Bottom right abstract logo (aw.) -->
            <div class="absolute bottom-12 right-12 flex items-end gap-1.5 opacity-90">
                <div class="w-2.5 h-2.5 bg-white rounded-full mb-1"></div>
                <div class="flex items-end h-8">
                    <!-- A -->
                    <div class="w-1.5 h-8 bg-white transform -skew-x-[20deg] rounded-sm"></div>
                    <div class="w-1.5 h-8 bg-white transform skew-x-[20deg] -ml-0.5 rounded-sm"></div>
                </div>
                <div class="flex items-end h-8 ml-1">
                    <!-- W -->
                    <div class="w-1.5 h-8 bg-white transform -skew-x-[15deg] rounded-sm"></div>
                    <div class="w-1.5 h-6 bg-white transform skew-x-[15deg] -ml-0.5 rounded-sm"></div>
                    <div class="w-1.5 h-6 bg-white transform -skew-x-[15deg] -ml-0.5 rounded-sm"></div>
                    <div class="w-1.5 h-8 bg-white transform skew-x-[15deg] -ml-0.5 rounded-sm"></div>
                </div>
            </div>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
