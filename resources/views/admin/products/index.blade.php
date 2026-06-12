@extends('layouts.admin')
@section('page-title', 'Produk Sepatu')
@section('page-subtitle', 'Kelola daftar sepatu di toko kamu.')

@section('content')
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden" data-aos="fade-up">
    <!-- Header -->
    <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="font-bold text-gray-800 text-lg">Daftar Produk</h3>
            <p class="text-sm text-gray-500">Total {{ $products->count() }} sepatu</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn text-white border-0" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Produk
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="table w-full admin-table">
            <thead>
                <tr>
                    <th class="px-6 py-4">Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th class="text-right px-6">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="hover:bg-slate-50 border-b border-slate-100">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-sm leading-tight max-w-[200px] truncate" title="{{ $product->name }}">
                                    {{ $product->name }}
                                </p>
                                <div class="flex gap-1 mt-1">
                                    @foreach(array_slice($product->sizes, 0, 3) as $size)
                                        <span class="text-[10px] bg-slate-200 text-slate-600 px-1.5 py-0.5 rounded">{{ $size }}</span>
                                    @endforeach
                                    @if(count($product->sizes) > 3)
                                        <span class="text-[10px] text-slate-400">+{{ count($product->sizes) - 3 }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold tracking-wider uppercase badge-{{ strtolower($product->category) }}">
                            {{ $product->category }}
                        </span>
                    </td>
                    <td class="font-bold text-gray-700">{{ $product->formatted_price }}</td>
                    <td>
                        @if($product->stock > 10)
                            <span class="text-emerald-600 font-bold bg-emerald-50 px-2 py-1 rounded-md text-xs">{{ $product->stock }}</span>
                        @elseif($product->stock > 0)
                            <span class="text-amber-600 font-bold bg-amber-50 px-2 py-1 rounded-md text-xs">{{ $product->stock }}</span>
                        @else
                            <span class="text-red-600 font-bold bg-red-50 px-2 py-1 rounded-md text-xs">Habis</span>
                        @endif
                    </td>
                    <td class="text-right px-6">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-ghost btn-circle text-blue-600 hover:bg-blue-50">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-ghost btn-circle text-red-500 hover:bg-red-50">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        <i data-lucide="box" class="w-12 h-12 mx-auto mb-3 opacity-20"></i>
                        <p>Belum ada produk sepatu. Yuk tambah produk baru!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
