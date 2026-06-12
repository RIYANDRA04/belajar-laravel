@extends('layouts.app')
@section('title', 'Keranjang Belanja — ShoesAsia')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-12">

    <div class="flex items-center gap-3 mb-8" data-aos="fade-right">
        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
            <i data-lucide="shopping-bag" class="w-5 h-5 text-white"></i>
        </div>
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800">Keranjang Belanja</h1>
            <p class="text-gray-500 text-sm">{{ count($cart) }} item dalam keranjangmu</p>
        </div>
    </div>

    @if(empty($cart))
        <!-- Empty State -->
        <div class="text-center py-24" data-aos="zoom-in">
            <div class="inline-flex items-center justify-center w-24 h-24 rounded-3xl mx-auto mb-6 bg-indigo-100 text-indigo-600">
                <i data-lucide="shopping-cart" class="w-12 h-12"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-3">Keranjangmu kosong!</h2>
            <p class="text-gray-500 mb-8">Yuk, mulai belanja sepatu impianmu.</p>
            <a href="{{ route('shop') }}" class="btn text-white border-none px-8 rounded-2xl font-bold" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                <i data-lucide="shopping-bag" class="w-4 h-4 mr-2"></i> Mulai Belanja
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Cart Items --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $key => $item)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-4 flex gap-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                    <!-- Image -->
                    <div class="w-24 h-24 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                        <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}"
                             class="w-full h-full object-cover"
                             style="{{ !empty($item['image_filter']) ? 'filter:' . $item['image_filter'] . ';' : '' }}"
                             onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=70'">
                    </div>

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="font-bold text-gray-800 text-sm leading-tight">{{ $item['name'] }}</p>
                                <div class="flex items-center gap-2 mt-1 flex-wrap">
                                    <span class="text-xs bg-indigo-50 text-indigo-600 font-bold px-2 py-0.5 rounded-md">{{ $item['category'] }}</span>
                                    <span class="text-xs bg-slate-100 text-gray-600 font-medium px-2 py-0.5 rounded-md">Size: {{ $item['size'] }}</span>
                                    @if(!empty($item['selected_color']))
                                    <span class="text-xs bg-purple-50 text-purple-600 font-medium px-2 py-0.5 rounded-md">{{ $item['selected_color'] }}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- Remove -->
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="cart_key" value="{{ $key }}">
                                <button type="submit" class="btn btn-ghost btn-xs btn-circle text-red-400 hover:text-red-600 hover:bg-red-50">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <!-- Qty control -->
                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="hidden" name="cart_key" value="{{ $key }}">
                                <button type="submit" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}"
                                        class="w-8 h-8 rounded-lg border-2 border-slate-200 flex items-center justify-center font-bold text-gray-600 hover:border-indigo-400 transition-all text-sm">
                                    −
                                </button>
                                <span class="w-8 text-center font-bold text-gray-800">{{ $item['quantity'] }}</span>
                                <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}"
                                        class="w-8 h-8 rounded-lg border-2 border-slate-200 flex items-center justify-center font-bold text-gray-600 hover:border-indigo-400 transition-all text-sm">
                                    +
                                </button>
                            </form>
                            <!-- Subtotal -->
                            <p class="font-extrabold text-indigo-600 text-base">
                                Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Order Summary --}}
            <div data-aos="fade-left">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 sticky top-24">
                    <h3 class="font-bold text-gray-800 text-lg mb-4">Ringkasan Pesanan</h3>

                    <div class="space-y-3 mb-4">
                        @foreach($cart as $item)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">{{ Str::limit($item['name'], 22) }} ({{ $item['quantity'] }}x)</span>
                            <span class="font-semibold text-gray-700">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>

                    <hr class="border-slate-200 my-4">

                    <div class="flex justify-between items-center mb-6">
                        <span class="font-bold text-gray-700">Total</span>
                        <span class="font-extrabold text-xl text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn w-full border-0 text-white font-bold rounded-2xl" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                        <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i> Checkout Sekarang
                    </a>
                    <a href="{{ route('shop') }}" class="btn btn-ghost w-full mt-2 text-gray-500 text-sm font-medium rounded-2xl">
                        ← Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
