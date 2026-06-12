@extends('layouts.admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan aktivitas toko kamu hari ini.')

@section('content')
<div class="space-y-6">

    <!-- Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5" data-aos="fade-up">
        <!-- Total Produk -->
        <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-indigo-50 text-indigo-600">
                <i data-lucide="package" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-0.5">Total Produk</p>
                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['total_products'] }}</p>
            </div>
        </div>

        <!-- Total Pesanan -->
        <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-blue-50 text-blue-600">
                <i data-lucide="shopping-cart" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-0.5">Total Pesanan</p>
                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['total_orders'] }}</p>
            </div>
        </div>

        <!-- Pending -->
        <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-amber-50 text-amber-600">
                <i data-lucide="clock" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-0.5">Pesanan Pending</p>
                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['pending_orders'] }}</p>
            </div>
        </div>

        <!-- Selesai -->
        <div class="stat-card bg-white rounded-2xl p-5 border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-emerald-50 text-emerald-600">
                <i data-lucide="check-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-500 mb-0.5">Pesanan Selesai</p>
                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['done_orders'] }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden" data-aos="fade-up" data-aos-delay="100">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 text-lg">Pesanan Terbaru</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold flex items-center gap-1">
                Lihat Semua <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="table w-full admin-table">
                <thead>
                    <tr>
                        <th class="px-6 py-4">ID Order</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-right px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recent_orders as $order)
                    <tr class="hover:bg-slate-50 border-b border-slate-100 transition-colors">
                        <td class="px-6 py-4 font-bold text-gray-700">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <p class="font-semibold text-gray-800 text-sm">{{ $order->customer_name }}</p>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $order->customer_phone }}</p>
                        </td>
                        <td class="font-bold text-indigo-600">{{ $order->formatted_total }}</td>
                        <td>
                            <span class="px-3 py-1 rounded-full text-xs font-bold badge-status-{{ strtolower($order->status) }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="text-sm text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="text-right px-6">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-ghost text-indigo-600 hover:bg-indigo-50 rounded-lg">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-3 opacity-20"></i>
                            <p>Belum ada pesanan masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
