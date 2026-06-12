@extends('layouts.app')
@section('title', 'Pesanan Saya — ShoesAsia')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">

    {{-- Header --}}
    <div class="mb-10" data-aos="fade-up">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-2xl flex items-center justify-center" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                <i data-lucide="package" class="w-5 h-5 text-white"></i>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">Pesanan Saya</h1>
                <p class="text-sm text-gray-400">Lacak status semua pesanan kamu</p>
            </div>
        </div>
    </div>

    @if($orders->isEmpty())
    {{-- Empty State --}}
    <div class="text-center py-24" data-aos="fade-up">
        <div class="w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6" style="background:linear-gradient(135deg,#f1f5f9,#e2e8f0)">
            <i data-lucide="shopping-bag" class="w-10 h-10 text-gray-400"></i>
        </div>
        <h2 class="text-xl font-bold text-gray-700 mb-2">Belum ada pesanan</h2>
        <p class="text-gray-400 text-sm mb-8">Yuk mulai belanja dan temukan sepatu favoritmu!</p>
        <a href="{{ route('shop') }}" class="btn text-white font-bold px-8 py-3 rounded-2xl" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);border:none">
            Mulai Belanja
        </a>
    </div>
    @else

    {{-- Orders List --}}
    <div class="space-y-5">
        @foreach($orders as $order)
        @php
            $colors = [
                'Pending'  => ['bg'=>'bg-amber-100','text'=>'text-amber-700','icon'=>'clock','dot'=>'bg-amber-400','border'=>'border-amber-200'],
                'Diproses' => ['bg'=>'bg-blue-100','text'=>'text-blue-700','icon'=>'package','dot'=>'bg-blue-400','border'=>'border-blue-200'],
                'Dikirim'  => ['bg'=>'bg-indigo-100','text'=>'text-indigo-700','icon'=>'truck','dot'=>'bg-indigo-400','border'=>'border-indigo-200'],
                'Selesai'  => ['bg'=>'bg-green-100','text'=>'text-green-700','icon'=>'check-circle','dot'=>'bg-green-400','border'=>'border-green-200'],
            ];
            $c = $colors[$order->status] ?? ['bg'=>'bg-gray-100','text'=>'text-gray-700','icon'=>'circle','dot'=>'bg-gray-400','border'=>'border-gray-200'];
        @endphp
        <div class="bg-white rounded-3xl shadow-md border border-slate-100 overflow-hidden hover:shadow-lg transition-all duration-300 group" data-aos="fade-up">
            {{-- Top Bar: Order ID + Status --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold text-gray-800"># {{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span class="text-xs text-gray-400">{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-bold border {{ $c['bg'] }} {{ $c['text'] }} {{ $c['border'] }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $c['dot'] }}"></span>
                    <i data-lucide="{{ $c['icon'] }}" class="w-3.5 h-3.5"></i>
                    {{ $order->status }}
                </div>
            </div>

            {{-- Product Thumbnails + Total --}}
            <div class="px-6 py-4 flex items-center justify-between gap-4 flex-wrap">
                <div class="flex items-center gap-3 flex-wrap">
                    @foreach($order->items->take(4) as $i => $item)
                    <div class="relative">
                        <div class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-50 border-2 border-white shadow-sm">
                            <img
                                src="{{ $item->image_url ?? $item->product?->image_url ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=70' }}"
                                alt="{{ $item->product?->name }}"
                                class="w-full h-full object-cover"
                                style="{{ !empty($item->image_filter) ? 'filter:' . $item->image_filter . ';' : '' }}"
                                onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=70'"
                            >
                        </div>
                        @if($i === 3 && $order->items->count() > 4)
                        <div class="absolute inset-0 rounded-2xl bg-black/50 flex items-center justify-center">
                            <span class="text-white text-xs font-bold">+{{ $order->items->count() - 4 }}</span>
                        </div>
                        @endif
                    </div>
                    @endforeach
                    <div class="ml-2">
                        <p class="text-sm font-semibold text-gray-800">{{ $order->items->count() }} item{{ $order->items->count() > 1 ? 's' : '' }}</p>
                        <p class="text-xs text-gray-400">{{ $order->items->pluck('product.name')->filter()->take(2)->join(', ') }}{{ $order->items->count() > 2 ? '...' : '' }}</p>
                    </div>
                </div>
                <div class="text-right flex flex-col items-end">
                    <p class="text-xs text-gray-400 mb-0.5">Total Pembayaran</p>
                    <p class="text-lg font-extrabold text-indigo-600 leading-tight mb-1">{{ $order->formatted_total }}</p>
                    <span class="inline-flex px-2 py-0.5 rounded text-[10px] font-bold border {{ $order->payment_status_color }}">
                        {{ $order->formatted_payment_status }}
                    </span>
                </div>
            </div>

            {{-- Timeline Progress Bar --}}
            @php
                $steps = ['Pending','Diproses','Dikirim','Selesai'];
                $currentStep = array_search($order->status, $steps);
            @endphp
            <div class="px-6 pb-4">
                <div class="flex items-center gap-0">
                    @foreach($steps as $si => $step)
                    <div class="flex items-center {{ $si < count($steps)-1 ? 'flex-1' : '' }}">
                        <div class="flex flex-col items-center">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold transition-all
                                {{ $si <= $currentStep ? 'text-white' : 'bg-slate-100 text-slate-400 border-2 border-slate-200' }}"
                                style="{{ $si <= $currentStep ? 'background:linear-gradient(135deg,#6366f1,#8b5cf6)' : '' }}">
                                @if($si < $currentStep)
                                    <i data-lucide="check" class="w-3 h-3"></i>
                                @else
                                    {{ $si + 1 }}
                                @endif
                            </div>
                            <span class="text-[10px] mt-1 font-medium {{ $si <= $currentStep ? 'text-indigo-600' : 'text-gray-400' }}">{{ $step }}</span>
                        </div>
                        @if($si < count($steps)-1)
                        <div class="flex-1 h-0.5 mx-1 mb-4 {{ $si < $currentStep ? 'bg-indigo-400' : 'bg-slate-200' }}"></div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Footer: Action --}}
            <div class="px-6 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                <p class="text-xs text-gray-400">
                    {{ $order->customer_name }} · {{ $order->customer_phone }}
                </p>
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm text-white font-bold rounded-xl px-5 text-xs" style="background:linear-gradient(135deg,#6366f1,#8b5cf6);border:none">
                    Lihat Detail →
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
