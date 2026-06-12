@extends('layouts.admin')
@section('page-title', 'Daftar Pesanan')
@section('page-subtitle', 'Kelola semua pesanan pelanggan.')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden" data-aos="fade-up">
    <!-- Header & Filter -->
    <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="font-bold text-gray-800 text-lg">Semua Pesanan</h3>
            <p class="text-sm text-gray-500">Total {{ $orders->count() }} pesanan</p>
        </div>

        <!-- Filter Status -->
        <div class="flex gap-2 bg-slate-100 p-1 rounded-xl w-full sm:w-auto overflow-x-auto">
            <a href="{{ route('admin.orders.index') }}" class="px-4 py-1.5 rounded-lg text-sm font-semibold whitespace-nowrap transition-colors {{ $status === 'all' ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-slate-200' }}">
                Semua
            </a>
            @foreach($statuses as $stat)
            <a href="{{ route('admin.orders.index', ['status' => $stat]) }}" class="px-4 py-1.5 rounded-lg text-sm font-semibold whitespace-nowrap transition-colors {{ $status === $stat ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-slate-200' }}">
                {{ $stat }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="table w-full admin-table">
            <thead>
                <tr>
                    <th class="px-6 py-4">ID Order</th>
                    <th>Pelanggan</th>
                    <th>Total Pembelian</th>
                    <th>Pembayaran</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-right px-6">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="hover:bg-slate-50 border-b border-slate-100 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-700">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                    </td>
                    <td>
                        <p class="font-bold text-gray-800 text-sm">{{ $order->customer_name }}</p>
                        <p class="text-xs text-gray-500 mt-0.5"><i data-lucide="phone" class="w-3 h-3 inline"></i> {{ $order->customer_phone }}</p>
                    </td>
                    <td class="font-bold text-indigo-600">{{ $order->formatted_total }}</td>
                    <td>
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-semibold text-gray-600">
                                {{ $order->formatted_payment_method }}
                            </span>
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold w-fit border {{ $order->payment_status_color }}">
                                {{ $order->formatted_payment_status }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase badge-status-{{ strtolower($order->status) }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="text-sm text-gray-500">
                        {{ $order->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="text-right px-6">
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-ghost text-indigo-600 hover:bg-indigo-50 rounded-lg">
                            Detail <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-16 text-center text-gray-400">
                        <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="inbox" class="w-8 h-8 opacity-40"></i>
                        </div>
                        <p class="font-medium text-gray-500">Belum ada data pesanan.</p>
                        @if($status !== 'all')
                            <p class="text-sm mt-1">Tidak ada pesanan dengan status '{{ $status }}'.</p>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
