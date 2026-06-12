<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders'   => Order::where('status', '!=', 'Draft')->count(),
            'pending_orders' => Order::where('status', 'Pending')->count(),
            'done_orders'    => Order::where('status', 'Selesai')->count(),
        ];

        $recent_orders = Order::where('status', '!=', 'Draft')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders'));
    }
}
