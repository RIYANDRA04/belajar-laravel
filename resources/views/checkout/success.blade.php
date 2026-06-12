@extends('layouts.app')
@section('title', 'Pesanan Berhasil — ShoesAsia')

@section('content')
<div class="min-h-screen flex items-center justify-center px-6 py-16 relative overflow-hidden">
    <!-- Background gradient -->
    <div class="absolute inset-0" style="background:linear-gradient(135deg,#f0f4ff,#faf0ff,#fff0f9)"></div>
    <!-- Decorative circles -->
    <div class="absolute top-20 left-20 w-64 h-64 rounded-full opacity-30" style="background:radial-gradient(circle,#6366f1,transparent);filter:blur(40px)"></div>
    <div class="absolute bottom-20 right-20 w-80 h-80 rounded-full opacity-20" style="background:radial-gradient(circle,#ec4899,transparent);filter:blur(50px)"></div>

    <div class="relative z-10 max-w-lg w-full">
        <!-- Success Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden" data-aos="zoom-in">
            <!-- Top gradient bar -->
            <div class="h-2" style="background:linear-gradient(135deg,#6366f1,#8b5cf6,#ec4899)"></div>

            <div class="p-8 text-center">
                <!-- Icon -->
                <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6 shadow-xl" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)" id="success-icon">
                    <i data-lucide="package-check" class="w-12 h-12 text-white"></i>
                </div>

                <div class="inline-flex items-center gap-3 mb-4">
                    <i data-lucide="check-circle" class="w-8 h-8 text-indigo-600"></i>
                    <h1 class="text-3xl font-extrabold text-gray-800">Pesanan Berhasil</h1>
                </div>
                <p class="text-gray-500 mb-2">Terima kasih, <strong class="text-gray-700">{{ $order->customer_name }}</strong>!</p>
                @if($order->payment_method === 'midtrans' && $order->payment_status === 'paid')
                <p class="text-gray-400 text-sm mb-6">Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }} berhasil dibuat dan pembayaran telah kami terima. Pesananmu sedang diproses untuk segera dikirimkan!</p>
                @elseif($order->payment_method === 'midtrans')
                <p class="text-gray-400 text-sm mb-6">Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }} berhasil dibuat. Silakan selesaikan pembayaran agar kami dapat langsung memproses pengiriman sepatu impianmu!</p>
                @else
                <p class="text-gray-400 text-sm mb-6">Pesanan #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }} berhasil dibuat. Siapkan pembayaran tunai saat kurir tiba mengantarkan pesananmu!</p>
                @endif

                <!-- Order Number Badge -->
                <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full mb-8 text-sm font-bold" style="background:linear-gradient(135deg,rgba(99,102,241,0.1),rgba(139,92,246,0.1));border:2px solid rgba(99,102,241,0.2);color:#6366f1">
                    <i data-lucide="hash" class="w-4 h-4"></i>
                    Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                </div>

                <!-- Order Details -->
                <div class="bg-slate-50 rounded-2xl p-5 text-left mb-6">
                    <h3 class="font-bold text-gray-700 mb-3 text-sm uppercase tracking-wide">Detail Pesanan</h3>

                    <!-- Items -->
                    <div class="space-y-2 mb-4">
                        @foreach($order->items as $item)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <img src="{{ $item->image_url ?? $item->product?->image_url ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=60&q=70' }}"
                                     alt="" class="w-10 h-10 rounded-lg object-cover bg-slate-200"
                                     style="{{ !empty($item->image_filter) ? 'filter:' . $item->image_filter . ';' : '' }}"
                                     onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=60&q=70'">
                                <div>
                                    <p class="text-xs font-semibold text-gray-700 leading-none">{{ $item->product?->name ?? 'Produk' }}</p>
                                    <p class="text-xs text-gray-400">Size {{ $item->size }} × {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <p class="text-xs font-bold text-indigo-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                        @endforeach
                    </div>

                    <hr class="border-slate-200 mb-3">

                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div>
                            <p class="text-gray-400 mb-0.5">Penerima</p>
                            <p class="font-semibold text-gray-700">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 mb-0.5">WhatsApp</p>
                            <p class="font-semibold text-gray-700">{{ $order->customer_phone }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="text-gray-400 mb-0.5">Alamat</p>
                            <p class="font-semibold text-gray-700">{{ $order->customer_address }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 mb-0.5">Metode Pembayaran</p>
                            <p class="font-bold text-gray-700">{{ $order->formatted_payment_method }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 mb-0.5">Status Pembayaran</p>
                            <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold border {{ $order->payment_status_color }}">
                                {{ $order->formatted_payment_status }}
                            </span>
                        </div>
                        @if($order->note)
                        <div class="col-span-2">
                            <p class="text-gray-400 mb-0.5">Catatan</p>
                            <p class="font-semibold text-gray-700 italic">"{{ $order->note }}"</p>
                        </div>
                        @endif
                    </div>

                    <hr class="border-slate-200 my-3">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-gray-700">Total Pembayaran</span>
                        <span class="font-extrabold text-lg text-indigo-600">{{ $order->formatted_total }}</span>
                    </div>
                </div>

                <!-- Info Pembayaran Midtrans SUDAH DIBAYAR -->
                @if($order->payment_method === 'midtrans' && $order->payment_status === 'paid')
                <div class="mb-6 p-5 rounded-2xl text-left border border-emerald-200 bg-emerald-50/50">
                    <div class="flex items-center gap-2.5 mb-2">
                        <div class="w-6 h-6 rounded-full bg-emerald-500 flex items-center justify-center">
                            <i data-lucide="check" class="w-3.5 h-3.5 text-white"></i>
                        </div>
                        <p class="text-xs font-bold text-emerald-900 uppercase tracking-wider">Pembayaran Berhasil Diterima</p>
                    </div>
                    <p class="text-[11px] text-gray-500 leading-relaxed">
                        Pembayaran sebesar <strong class="text-emerald-700">{{ $order->formatted_total }}</strong> telah berhasil dikonfirmasi. Pesananmu sedang kami proses dan akan segera dikirimkan. Terima kasih! 🎉
                    </p>
                </div>
                @endif

                <!-- Info Pembayaran Midtrans Pending -->
                @if($order->payment_method === 'midtrans' && $order->payment_status === 'pending')
                <div class="mb-6 p-5 rounded-2xl text-left border border-indigo-100 bg-indigo-50/30">
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex h-2.5 w-2.5 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-600"></span>
                        </span>
                        <p class="text-xs font-bold text-indigo-900 uppercase tracking-wider">Menunggu Pembayaran Instan</p>
                    </div>
                    <p class="text-[11px] text-gray-500 leading-relaxed">
                        Silakan selesaikan pembayaran Anda menggunakan Virtual Account, QRIS (GoPay/ShopeePay), atau mini market. Pembayaran akan terverifikasi secara otomatis oleh sistem kami.
                    </p>
                </div>

                <button id="pay-button" class="btn w-full border-0 text-white font-extrabold rounded-2xl text-base py-4 mb-4 shadow-xl hover:shadow-indigo-500/30 transition-all duration-300 scale-102 hover:scale-[1.03] active:scale-98 flex items-center justify-center gap-2" style="background:linear-gradient(135deg,#6366f1,#8b5cf6,#ec4899);background-size:200% 200%;animation:gradient-pulse 4s ease infinite">
                    <i data-lucide="wallet" class="w-5 h-5"></i> Bayar Sekarang via Midtrans
                </button>
                
                <style>
                @keyframes gradient-pulse {
                    0% { background-position: 0% 50%; }
                    50% { background-position: 100% 50%; }
                    100% { background-position: 0% 50%; }
                }
                </style>
                @endif

                <!-- Info Pembayaran COD -->
                @if($order->payment_method === 'cod')
                <div class="mb-6 p-5 rounded-2xl text-left border border-emerald-100 bg-emerald-50/30">
                    <div class="flex items-center gap-2.5 mb-2">
                        <span class="flex h-2.5 w-2.5 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-600"></span>
                        </span>
                        <p class="text-xs font-bold text-emerald-950 uppercase tracking-wider">Cash On Delivery (COD)</p>
                    </div>
                    <p class="text-[11px] text-gray-500 leading-relaxed">
                        Sepatu impianmu akan segera dikemas dan dikirimkan oleh kurir kami. Siapkan uang tunai sebesar <strong class="text-emerald-700">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong> saat paket tiba di rumahmu!
                    </p>
                </div>
                @endif

                <!-- Status Timeline -->
                <div class="flex items-center justify-center gap-0 mb-8">
                    @php
                        $steps = [
                            ['label' => 'Pending', 'icon' => 'clock'],
                            ['label' => 'Diproses', 'icon' => 'package'],
                            ['label' => 'Dikirim', 'icon' => 'truck'],
                            ['label' => 'Selesai', 'icon' => 'check-circle'],
                        ];
                        $statusMap = [
                            'Pending' => 0,
                            'Diproses' => 1,
                            'Dikirim' => 2,
                            'Selesai' => 3
                        ];
                        $currentIdx = $statusMap[$order->status] ?? 0;
                    @endphp
                    @foreach($steps as $i => $step)
                        <div class="flex flex-col items-center">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-sm
                                {{ $i <= $currentIdx ? '' : 'opacity-30' }}"
                                 style="{{ $i <= $currentIdx ? 'background:linear-gradient(135deg,#6366f1,#8b5cf6)' : 'background:#e2e8f0' }}">
                                <i data-lucide="{{ $step['icon'] }}" class="w-4 h-4 {{ $i > $currentIdx ? 'text-gray-400' : '' }}"></i>
                            </div>
                            <p class="text-xs mt-1 font-medium {{ $i <= $currentIdx ? 'text-indigo-600' : 'text-gray-300' }}">{{ $step['label'] }}</p>
                        </div>
                        @if(!$loop->last)
                        <div class="h-0.5 w-12 mb-4 {{ $i < $currentIdx ? 'bg-indigo-200' : 'bg-slate-200' }}"></div>
                        @endif
                    @endforeach
                </div>

                <!-- CTA Buttons -->
                <div class="flex gap-3">
                    <a href="{{ route('shop') }}" class="flex-1 btn border-0 text-white font-bold rounded-2xl" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                        <i data-lucide="shopping-bag" class="w-4 h-4 mr-1"></i> Belanja Lagi
                    </a>
                    <a href="{{ route('orders.show', $order->id) }}" class="flex-1 btn btn-outline border-2 border-slate-200 text-slate-600 hover:bg-slate-50 rounded-2xl font-bold">
                        <i data-lucide="package" class="w-4 h-4 mr-1"></i> Detail Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Canvas Confetti -->
<canvas id="confetti-canvas" class="fixed inset-0 pointer-events-none z-50" style="width:100%;height:100%"></canvas>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
@if($order->payment_method === 'midtrans' && $order->payment_status === 'pending')
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    function triggerSnapPayment() {
        if (typeof snap !== 'undefined') {
            snap.pay('{{ $order->snap_token }}', {
                onSuccess: function(result) {
                    window.location.href = window.location.pathname + '?transaction_status=settlement&status_code=200';
                },
                onPending: function(result) {
                    window.location.reload();
                },
                onError: function(result) {
                    alert("Pembayaran gagal, silakan coba lagi!");
                },
                onClose: function() {
                    // User menutup popup — do nothing, stay on the page
                }
            });
        }
    }

    const payButton = document.getElementById('pay-button');
    if (payButton) {
        payButton.addEventListener('click', triggerSnapPayment);
    }

    // Auto-launch after 1.2 seconds to allow the page load animations and confetti to run first
    window.addEventListener('load', () => {
        setTimeout(triggerSnapPayment, 1200);
    });
</script>
@endif
<script>
    // Burst confetti on load
    window.addEventListener('load', () => {
        const canvas = document.getElementById('confetti-canvas');
        const myConfetti = confetti.create(canvas, { resize: true, useWorker: true });

        // Initial burst
        myConfetti({ particleCount: 120, spread: 80, origin: { y: 0.5 }, colors: ['#6366f1','#8b5cf6','#ec4899','#f59e0b','#10b981'] });

        // Side bursts
        setTimeout(() => {
            myConfetti({ particleCount: 60, angle: 60,  spread: 55, origin: { x: 0 }, colors: ['#6366f1','#8b5cf6','#ec4899'] });
        }, 400);
        setTimeout(() => {
            myConfetti({ particleCount: 60, angle: 120, spread: 55, origin: { x: 1 }, colors: ['#f59e0b','#10b981','#6366f1'] });
        }, 600);

        // Gentle shower after 1.5s
        setTimeout(() => {
            let count = 0;
            const interval = setInterval(() => {
                myConfetti({ particleCount: 5, angle: 90, spread: 120, origin: { x: Math.random(), y: 0 }, gravity: 0.8, scalar: 0.8 });
                count++;
                if (count > 25) clearInterval(interval);
            }, 100);
        }, 1500);
    });

    // Icon pulse
    setTimeout(() => {
        const icon = document.getElementById('success-icon');
        if (icon) {
            icon.style.transform = 'scale(1.15)';
            icon.style.transition = 'transform 0.3s cubic-bezier(.4,2,.6,1)';
            setTimeout(() => icon.style.transform = 'scale(1)', 300);
        }
    }, 300);
</script>
@endpush
