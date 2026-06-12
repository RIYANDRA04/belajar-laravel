<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Calculate statistics for the logged-in customer
        $stats = [
            'active_orders' => Order::where('user_id', $userId)
                ->whereIn('status', ['Pending', 'Diproses', 'Dikirim'])
                ->count(),
            'cart_count' => count(session('cart', [])),
            'total_spent' => Order::where('user_id', $userId)
                ->where('status', 'Selesai')
                ->sum('total_amount'),
        ];

        // Fetch recent 3 orders for the tracking timeline
        $recent_orders = Order::with('items.product')
            ->where('user_id', $userId)
            ->where('status', '!=', 'Draft')
            ->latest()
            ->take(3)
            ->get();

        // Fetch 4 top/latest products for shopping suggestions
        $recommended_products = Product::latest()->take(4)->get();

        return view('dashboard', compact('stats', 'recent_orders', 'recommended_products'));
    }
}
