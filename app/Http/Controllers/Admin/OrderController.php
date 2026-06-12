<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status  = $request->get('status', 'all');
        $query   = Order::where('status', '!=', 'Draft')->latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $orders   = $query->get();
        $statuses = ['Pending', 'Diproses', 'Dikirim', 'Selesai'];

        return view('admin.orders.index', compact('orders', 'statuses', 'status'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        $statuses = ['Pending', 'Diproses', 'Dikirim', 'Selesai'];
        return view('admin.orders.show', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status'         => 'required|in:Pending,Diproses,Dikirim,Selesai',
            'payment_status' => 'required|in:pending,paid,failed,expired',
        ]);

        $order->update([
            'status'         => $request->status,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Status pesanan & pembayaran berhasil diperbarui!');
    }
}
