@extends('layouts.app')
@section('title', 'Detail Pesanan #' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . ' — ShoesAsia')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm mb-8 text-gray-400">
        <a href="{{ route('orders.index') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-1">
            <i data-lucide="package" class="w-3.5 h-3.5"></i> Pesanan Saya
        </a>
        <i data-lucide="chevron-right" class="w-3 h-3"></i>
        <span class="text-gray-600 font-medium"># {{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
    </nav>

    @php
        $colors = [
            'Pending'  => ['bg'=>'bg-amber-100','text'=>'text-amber-700','icon'=>'clock','dot'=>'bg-amber-400','border'=>'border-amber-200'],
            'Diproses' => ['bg'=>'bg-blue-100','text'=>'text-blue-700','icon'=>'package','dot'=>'bg-blue-400','border'=>'border-blue-200'],
            'Dikirim'  => ['bg'=>'bg-indigo-100','text'=>'text-indigo-700','icon'=>'truck','dot'=>'bg-indigo-400','border'=>'border-indigo-200'],
            'Selesai'  => ['bg'=>'bg-green-100','text'=>'text-green-700','icon'=>'check-circle','dot'=>'bg-green-400','border'=>'border-green-200'],
        ];
        $c = $colors[$order->status] ?? ['bg'=>'bg-gray-100','text'=>'text-gray-700','icon'=>'circle','dot'=>'bg-gray-400','border'=>'border-gray-200'];
        $steps = ['Pending','Diproses','Dikirim','Selesai'];
        $currentStep = array_search($order->status, $steps);
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT: Main Info --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Status Card --}}
            <div class="bg-white rounded-3xl shadow-md border border-slate-100 p-6" data-aos="fade-up">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-xs text-gray-400 font-medium uppercase tracking-widest mb-1">Status Pesanan</p>
                        <div class="flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold border w-fit {{ $c['bg'] }} {{ $c['text'] }} {{ $c['border'] }}">
                            <span class="w-2 h-2 rounded-full animate-pulse {{ $c['dot'] }}"></span>
                            <i data-lucide="{{ $c['icon'] }}" class="w-4 h-4"></i>
                            {{ $order->status }}
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 mb-1">Dipesan pada</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $order->created_at->format('d M Y, H:i') }} WIB</p>
                    </div>
                </div>

                {{-- Progress Steps --}}
                <div class="flex items-center gap-0">
                    @foreach($steps as $si => $step)
                    <div class="flex items-center {{ $si < count($steps)-1 ? 'flex-1' : '' }}">
                        <div class="flex flex-col items-center">
                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-all shadow-sm
                                {{ $si <= $currentStep ? 'text-white shadow-indigo-200' : 'bg-slate-100 text-slate-400 border-2 border-slate-200' }}"
                                style="{{ $si <= $currentStep ? 'background:linear-gradient(135deg,#6366f1,#8b5cf6)' : '' }}">
                                @if($si < $currentStep)
                                    <i data-lucide="check" class="w-4 h-4"></i>
                                @else
                                    <i data-lucide="{{ ['clock','package','truck','check-circle'][$si] }}" class="w-4 h-4"></i>
                                @endif
                            </div>
                            <span class="text-[11px] mt-2 font-semibold {{ $si <= $currentStep ? 'text-indigo-600' : 'text-gray-400' }}">{{ $step }}</span>
                            @if($si === $currentStep)
                            <span class="text-[10px] text-indigo-400">Saat ini</span>
                            @endif
                        </div>
                        @if($si < count($steps)-1)
                        <div class="flex-1 h-1 mx-2 mb-6 rounded-full transition-all {{ $si < $currentStep ? '' : 'bg-slate-200' }}"
                            style="{{ $si < $currentStep ? 'background:linear-gradient(90deg,#6366f1,#8b5cf6)' : '' }}">
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Order Items --}}
            <div class="bg-white rounded-3xl shadow-md border border-slate-100 p-6" data-aos="fade-up" data-aos-delay="100">
                <h2 class="font-extrabold text-gray-800 mb-5 flex items-center gap-2">
                    <i data-lucide="shopping-bag" class="w-5 h-5 text-indigo-500"></i> Item Pesanan
                </h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                    <div class="flex items-center gap-4 p-3 rounded-2xl hover:bg-slate-50 transition-colors">
                        <div class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-50 flex-shrink-0 border border-slate-100">
                            <img
                                src="{{ $item->image_url ?? $item->product?->image_url ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=70' }}"
                                alt="{{ $item->product?->name }}"
                                class="w-full h-full object-cover"
                                style="{{ !empty($item->image_filter) ? 'filter:' . $item->image_filter . ';' : '' }}"
                                onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=70'"
                            >
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-gray-800 text-sm truncate">{{ $item->product?->name ?? 'Produk tidak tersedia' }}</p>
                            <div class="flex items-center gap-2 mt-0.5">
                                <p class="text-xs text-gray-400">Ukuran: {{ $item->size }}</p>
                                @if($item->color)
                                <span class="text-xs bg-indigo-50 text-indigo-600 px-2 py-0.5 rounded font-medium">{{ $item->color }}</span>
                                @endif
                                <p class="text-xs text-gray-400">· Qty: {{ $item->quantity }}</p>
                            </div>
                            <p class="text-xs text-indigo-500 font-semibold mt-1">Rp {{ number_format($item->price, 0, ',', '.') }} / item</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <p class="font-extrabold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @if(!$loop->last)<hr class="border-slate-100">@endif
                    @endforeach
                </div>

                {{-- Total --}}
                <div class="mt-5 pt-5 border-t border-slate-100 flex justify-between items-center">
                    <span class="font-bold text-gray-600">Total Pembayaran</span>
                    <span class="text-2xl font-extrabold text-indigo-600">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>

        {{-- RIGHT: Shipping Info + Note --}}
        <div class="space-y-5">
            {{-- Info Pembayaran Card --}}
            <div class="bg-white rounded-3xl shadow-md border border-slate-100 p-6" data-aos="fade-up" data-aos-delay="120">
                <h2 class="font-extrabold text-gray-800 mb-4 flex items-center gap-2">
                    <i data-lucide="credit-card" class="w-4 h-4 text-indigo-500"></i> Info Pembayaran
                </h2>
                <div class="space-y-3.5 text-sm">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-0.5">Metode</p>
                        <p class="font-bold text-gray-800">{{ $order->formatted_payment_method }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Status</p>
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold border {{ $order->payment_status_color }}">
                            {{ $order->formatted_payment_status }}
                        </span>
                    </div>

                    @if($order->payment_method === 'midtrans' && $order->payment_status === 'pending')
                    <div class="pt-2">
                        <button id="pay-button" class="btn w-full border-0 text-white font-extrabold rounded-2xl text-xs py-3 shadow-lg hover:shadow-indigo-500/20 transition-all duration-300 scale-102 hover:scale-105 active:scale-98" style="background:linear-gradient(135deg,#6366f1,#ec4899)">
                            <i data-lucide="credit-card" class="w-4 h-4 mr-1.5"></i> Bayar Sekarang
                        </button>
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-md border border-slate-100 p-6" data-aos="fade-up" data-aos-delay="150">
                <h2 class="font-extrabold text-gray-800 mb-4 flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-indigo-500"></i> Info Pengiriman
                </h2>
                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Nama</p>
                        <p class="font-semibold text-gray-800">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Telepon</p>
                        <p class="font-semibold text-gray-800">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Alamat</p>
                        <p class="font-semibold text-gray-800 leading-relaxed">{{ $order->customer_address }}</p>
                    </div>
                    @if($order->note)
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Catatan</p>
                        <p class="text-gray-600 italic text-sm bg-slate-50 rounded-xl p-3">{{ $order->note }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Order Number Card --}}
            <div class="rounded-3xl p-6 text-white" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)" data-aos="fade-up" data-aos-delay="200">
                <p class="text-indigo-200 text-xs font-semibold uppercase tracking-widest mb-1">Nomor Pesanan</p>
                <p class="text-3xl font-extrabold tracking-wider"># {{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p class="text-indigo-200 text-xs mt-3">{{ $order->created_at->diffForHumans() }}</p>
            </div>

            <a href="{{ route('orders.index') }}" class="flex items-center justify-center gap-2 w-full border-2 border-slate-200 text-gray-600 font-bold rounded-2xl py-3 text-sm hover:border-indigo-400 hover:text-indigo-600 transition-all">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Pesanan
            </a>

            @if($order->status !== 'Selesai')
            <div class="p-4 bg-indigo-50 rounded-2xl border border-indigo-100">
                <p class="text-xs text-indigo-600 font-medium flex items-start gap-2">
                    <i data-lucide="info" class="w-4 h-4 flex-shrink-0 mt-0.5"></i>
                    Status pesanan diperbarui secara real-time oleh tim ShoesAsia. Refresh halaman untuk melihat update terbaru.
                </p>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection

@push('scripts')
@if($order->payment_method === 'midtrans' && $order->payment_status === 'pending')
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    const payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        snap.pay('{{ $order->snap_token }}', {
            onSuccess: function(result) {
                window.location.reload();
            },
            onPending: function(result) {
                window.location.reload();
            },
            onError: function(result) {
                alert("Pembayaran gagal, silakan coba lagi!");
            },
            onClose: function() {
                // User menutup popup
            }
        });
    });
</script>
@endif
@endpush
