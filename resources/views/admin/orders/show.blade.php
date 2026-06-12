@extends('layouts.admin')
@section('page-title', 'Detail Pesanan')
@section('page-subtitle', 'Order #' . str_pad($order->id, 6, '0', STR_PAD_LEFT))

@section('content')
<div class="flex flex-col lg:flex-row gap-6">

    <!-- LEFT: Order Detail -->
    <div class="flex-1 space-y-6" data-aos="fade-right">

        <!-- Header Info -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-bold text-gray-800 text-xl mb-1">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h3>
                <p class="text-sm text-gray-500 flex items-center gap-1.5">
                    <i data-lucide="calendar" class="w-4 h-4"></i> {{ $order->created_at->format('d M Y, H:i') }}
                </p>
            </div>
            <div class="text-right">
                <span class="px-4 py-1.5 rounded-full text-sm font-bold tracking-wider uppercase badge-status-{{ strtolower($order->status) }}">
                    {{ $order->status }}
                </span>
            </div>
        </div>

        <!-- Items -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50">
                <h4 class="font-bold text-gray-700">Item Pesanan ({{ $order->items->sum('quantity') }})</h4>
            </div>
            <div class="p-0">
                <table class="table w-full">
                    <thead class="bg-white">
                        <tr>
                            <th class="px-6 text-gray-500">Produk</th>
                            <th class="text-center text-gray-500">Qty</th>
                            <th class="text-right px-6 text-gray-500">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr class="border-t border-slate-100">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                        <img src="{{ $item->image_url ?? $item->product?->image_url ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=100&q=70' }}" 
                                             alt="" 
                                             class="w-full h-full object-cover"
                                             style="{{ !empty($item->image_filter) ? 'filter:' . $item->image_filter . ';' : '' }}">
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm leading-tight max-w-[250px] truncate">
                                            {{ $item->product?->name ?? 'Produk Dihapus' }}
                                        </p>
                                        <div class="flex gap-2 mt-1">
                                            <span class="text-xs bg-slate-100 text-gray-600 px-2 py-0.5 rounded font-medium">Size: {{ $item->size }}</span>
                                            @if($item->color)
                                            <span class="text-xs bg-indigo-50 text-indigo-600 px-2 py-0.5 rounded font-medium">{{ $item->color }}</span>
                                            @endif
                                            <span class="text-xs text-gray-400">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center font-bold text-gray-700">x{{ $item->quantity }}</td>
                            <td class="text-right px-6 font-bold text-indigo-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-6 bg-slate-50 border-t border-slate-100">
                <div class="flex justify-between items-center">
                    <span class="font-bold text-gray-600">Total Pembayaran</span>
                    <span class="text-2xl font-extrabold text-indigo-600">{{ $order->formatted_total }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: Customer & Status Update -->
    <div class="w-full lg:w-80 space-y-6" data-aos="fade-left">

        <!-- Status Update -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="refresh-cw" class="w-4 h-4 text-indigo-500"></i> Update Status
            </h4>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Status Pesanan</label>
                    <div class="relative custom-dropdown" id="dropdown-status">
                        <input type="hidden" name="status" id="input-status" value="{{ $order->status }}">
                        <button type="button" class="w-full bg-white border border-slate-200 text-gray-700 rounded-xl px-4 py-3 flex items-center justify-between text-sm font-semibold transition-all hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 shadow-sm dropdown-btn">
                            <span class="dropdown-label">{{ $order->status }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-indigo-500 transition-transform duration-200 dropdown-icon"></i>
                        </button>
                        <div class="absolute z-50 left-0 right-0 mt-2 bg-white border border-slate-150 rounded-xl shadow-xl py-1.5 hidden opacity-0 translate-y-[-10px] transition-all duration-200 dropdown-menu">
                            @foreach($statuses as $stat)
                            <button type="button" data-value="{{ $stat }}" class="w-full px-4 py-2.5 text-left text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 flex items-center justify-between transition-colors dropdown-item">
                                <span>{{ $stat }}</span>
                                @if($order->status === $stat)
                                <i data-lucide="check" class="w-4 h-4 text-indigo-600 check-icon"></i>
                                @endif
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Status Pembayaran</label>
                    <div class="relative custom-dropdown" id="dropdown-payment">
                        <input type="hidden" name="payment_status" id="input-payment" value="{{ $order->payment_status }}">
                        <button type="button" class="w-full bg-white border border-slate-200 text-gray-700 rounded-xl px-4 py-3 flex items-center justify-between text-sm font-semibold transition-all hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 shadow-sm dropdown-btn">
                            <span class="dropdown-label">{{ $order->formatted_payment_status }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-indigo-500 transition-transform duration-200 dropdown-icon"></i>
                        </button>
                        <div class="absolute z-50 left-0 right-0 mt-2 bg-white border border-slate-150 rounded-xl shadow-xl py-1.5 hidden opacity-0 translate-y-[-10px] transition-all duration-200 dropdown-menu">
                            @php
                                $pm_statuses = [
                                    'pending' => 'Belum Bayar',
                                    'paid' => 'Lunas',
                                    'failed' => 'Gagal',
                                    'expired' => 'Kedaluwarsa'
                                ];
                            @endphp
                            @foreach($pm_statuses as $val => $label)
                            <button type="button" data-value="{{ $val }}" class="w-full px-4 py-2.5 text-left text-sm font-semibold text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 flex items-center justify-between transition-colors dropdown-item">
                                <span>{{ $label }}</span>
                                @if($order->payment_status === $val)
                                <i data-lucide="check" class="w-4 h-4 text-indigo-600 check-icon"></i>
                                @endif
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn w-full text-white border-0 rounded-xl" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Payment Info -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i data-lucide="credit-card" class="w-4 h-4 text-indigo-500"></i> Informasi Pembayaran
            </h4>
            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Metode Pembayaran</p>
                    <p class="font-bold text-gray-800 text-sm">{{ $order->formatted_payment_method }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Status Pembayaran</p>
                    <span class="px-2.5 py-0.5 rounded text-[11px] font-bold inline-block border {{ $order->payment_status_color }}">
                        {{ $order->formatted_payment_status }}
                    </span>
                </div>
                @if($order->payment_method === 'midtrans' && $order->snap_token)
                <div>
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Snap Token</p>
                    <code class="text-[11px] bg-slate-50 text-slate-600 px-2 py-1 rounded border border-slate-200 font-mono block break-all leading-tight">
                        {{ $order->snap_token }}
                    </code>
                </div>
                @endif
            </div>
        </div>

        <!-- Customer Info -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h4 class="font-bold text-gray-800 mb-5 flex items-center gap-2">
                <i data-lucide="user" class="w-4 h-4 text-indigo-500"></i> Data Pelanggan
            </h4>

            <div class="space-y-4">
                <div>
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Nama</p>
                    <p class="font-bold text-gray-800 text-sm">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">WhatsApp</p>
                    <div class="flex items-center gap-2">
                        <p class="font-bold text-gray-800 text-sm">{{ $order->customer_phone }}</p>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->customer_phone) }}" target="_blank" class="btn btn-xs btn-outline border-green-500 text-green-600 hover:bg-green-50 hover:border-green-600 gap-1 rounded-md">
                            <i data-lucide="message-circle" class="w-3 h-3"></i> Chat
                        </a>
                    </div>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider mb-1">Alamat Pengiriman</p>
                    <p class="font-medium text-gray-700 text-sm leading-relaxed">{{ $order->customer_address }}</p>
                </div>
                @if($order->note)
                <div class="p-3 bg-amber-50 border border-amber-100 rounded-xl">
                    <p class="text-xs text-amber-600 font-bold uppercase tracking-wider mb-1 flex items-center gap-1">
                        <i data-lucide="info" class="w-3 h-3"></i> Catatan
                    </p>
                    <p class="text-sm text-amber-900 italic font-medium">"{{ $order->note }}"</p>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Custom Dropdown logic
    const dropdowns = document.querySelectorAll('.custom-dropdown');
    
    dropdowns.forEach(dropdown => {
        const btn = dropdown.querySelector('.dropdown-btn');
        const menu = dropdown.querySelector('.dropdown-menu');
        const label = dropdown.querySelector('.dropdown-label');
        const input = dropdown.querySelector('input[type="hidden"]');
        const icon = dropdown.querySelector('.dropdown-icon');
        const items = dropdown.querySelectorAll('.dropdown-item');

        // Toggle dropdown open/close
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Close other dropdowns
            dropdowns.forEach(other => {
                if (other !== dropdown) {
                    const otherMenu = other.querySelector('.dropdown-menu');
                    const otherIcon = other.querySelector('.dropdown-icon');
                    otherMenu.classList.add('hidden');
                    otherMenu.classList.remove('opacity-100', 'translate-y-0');
                    otherMenu.classList.add('opacity-0', 'translate-y-[-10px]');
                    if (otherIcon) otherIcon.classList.remove('rotate-180');
                }
            });

            const isOpen = !menu.classList.contains('hidden');
            if (isOpen) {
                menu.classList.add('hidden');
                menu.classList.remove('opacity-100', 'translate-y-0');
                menu.classList.add('opacity-0', 'translate-y-[-10px]');
                icon.classList.remove('rotate-180');
            } else {
                menu.classList.remove('hidden');
                setTimeout(() => {
                    menu.classList.remove('opacity-0', 'translate-y-[-10px]');
                    menu.classList.add('opacity-100', 'translate-y-0');
                }, 10);
                icon.classList.add('rotate-180');
            }
        });

        // Item select
        items.forEach(item => {
            item.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                const text = this.querySelector('span').textContent;
                
                // Update label & hidden input
                label.textContent = text;
                input.value = value;

                // Update active checkmarks
                items.forEach(i => {
                    const check = i.querySelector('.check-icon');
                    if (check) check.remove();
                });
                
                const checkIcon = document.createElement('i');
                checkIcon.setAttribute('data-lucide', 'check');
                checkIcon.className = 'w-4 h-4 text-indigo-600 check-icon';
                this.appendChild(checkIcon);
                if (window.lucide) {
                    window.lucide.createIcons();
                }

                // Close menu
                menu.classList.add('hidden');
                menu.classList.remove('opacity-100', 'translate-y-0');
                menu.classList.add('opacity-0', 'translate-y-[-10px]');
                icon.classList.remove('rotate-180');
            });
        });
    });

    // Close dropdowns on clicking outside
    document.addEventListener('click', function() {
        dropdowns.forEach(dropdown => {
            const menu = dropdown.querySelector('.dropdown-menu');
            const icon = dropdown.querySelector('.dropdown-icon');
            menu.classList.add('hidden');
            menu.classList.remove('opacity-100', 'translate-y-0');
            menu.classList.add('opacity-0', 'translate-y-[-10px]');
            if (icon) icon.classList.remove('rotate-180');
        });
    });
});
</script>
@endsection

