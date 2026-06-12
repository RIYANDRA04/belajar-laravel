<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong!');
        }
        $total = collect($cart)->sum(fn($item) => $item['subtotal']);
        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'required|string',
            'note'             => 'nullable|string',
            'payment_method'   => 'required|string|in:cod,midtrans',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kamu kosong!');
        }

        $total = collect($cart)->sum(fn($item) => $item['subtotal']);
        $order = null;

        try {
            // Delete any existing Draft orders for this user to keep the database clean
            Order::where('user_id', Auth::id())->where('status', 'Draft')->delete();

            DB::transaction(function () use ($request, $cart, $total, &$order) {
                $order = Order::create([
                    'user_id'          => Auth::id(),
                    'customer_name'    => $request->customer_name,
                    'customer_phone'   => $request->customer_phone,
                    'customer_address' => $request->customer_address,
                    'note'             => $request->note,
                    'total_amount'     => $total,
                    'status'           => 'Pending',
                    'payment_method'   => $request->payment_method,
                    'payment_status'   => 'pending',
                ]);

                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id'      => $order->id,
                        'product_id'    => $item['product_id'],
                        'size'          => $item['size'],
                        'quantity'      => $item['quantity'],
                        'price'         => $item['price'],
                        'subtotal'      => $item['subtotal'],
                        'color'         => $item['selected_color'] ?? null,
                        'image_url'     => $item['image_url'] ?? null,
                        'image_filter'  => $item['image_filter'] ?? null,
                    ]);
                }
            });

            // Jika memilih Midtrans, buat snap token
            if ($request->payment_method === 'midtrans') {
                Config::$serverKey = config('midtrans.server_key');
                Config::$isProduction = config('midtrans.is_production');
                Config::$isSanitized = config('midtrans.is_sanitized');
                Config::$is3ds = config('midtrans.is_3ds');

                $params = [
                    'transaction_details' => [
                        'order_id'     => 'SA-' . $order->id . '-' . time(),
                        'gross_amount' => (int) $total,
                    ],
                    'customer_details' => [
                        'first_name' => $order->customer_name,
                        'phone'      => $order->customer_phone,
                        'email'      => Auth::user()->email ?? 'customer@example.com',
                    ],
                    'callbacks' => [
                        'finish' => route('checkout.success', $order->id),
                    ],
                ];

                $snapToken = Snap::getSnapToken($params);
                $order->update(['snap_token' => $snapToken]);
            }

            // Clear cart
            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id);

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memproses checkout: ' . $e->getMessage());
        }
    }

    public function initiateMidtrans(Request $request)
    {
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'customer_address' => 'required|string',
            'note'             => 'nullable|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['error' => 'Keranjang kamu kosong!'], 400);
        }

        $total = collect($cart)->sum(fn($item) => $item['subtotal']);
        $order = null;

        try {
            // Delete any existing Draft orders for this user to keep the database clean
            Order::where('user_id', Auth::id())->where('status', 'Draft')->delete();

            DB::transaction(function () use ($request, $cart, $total, &$order) {
                $order = Order::create([
                    'user_id'          => Auth::id(),
                    'customer_name'    => $request->customer_name,
                    'customer_phone'   => $request->customer_phone,
                    'customer_address' => $request->customer_address,
                    'note'             => $request->note,
                    'total_amount'     => $total,
                    'status'           => 'Draft', // Set status as Draft until payment or confirmation
                    'payment_method'   => 'midtrans',
                    'payment_status'   => 'pending',
                ]);

                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id'      => $order->id,
                        'product_id'    => $item['product_id'],
                        'size'          => $item['size'],
                        'quantity'      => $item['quantity'],
                        'price'         => $item['price'],
                        'subtotal'      => $item['subtotal'],
                        'color'         => $item['selected_color'] ?? null,
                        'image_url'     => $item['image_url'] ?? null,
                        'image_filter'  => $item['image_filter'] ?? null,
                    ]);
                }
            });

            // Buat snap token
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            $finishUrl = route('checkout.success', $order->id);

            $params = [
                'transaction_details' => [
                    'order_id'     => 'SA-' . $order->id . '-' . time(),
                    'gross_amount' => (int) $total,
                ],
                'customer_details' => [
                    'first_name' => $order->customer_name,
                    'phone'      => $order->customer_phone,
                    'email'      => Auth::user()->email ?? 'customer@example.com',
                ],
                'callbacks' => [
                    'finish' => $finishUrl,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            $order->update(['snap_token' => $snapToken]);

            // We do NOT clear the cart session here anymore so the user can re-initiate or modify
            // their shipping data on checkout without receiving the 'Keranjang kamu kosong' error.
            // The cart will be cleared when they are successfully redirected to the success page!

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'redirect_url' => $finishUrl
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memproses pembayaran: ' . $e->getMessage()], 500);
        }
    }

    public function success(Request $request, $id)
    {
        // Clear cart session now that order checkout is fully finalized
        session()->forget('cart');

        $order = Order::with('items.product')->findOrFail($id);
        
        // Upgrade Draft status to Pending if user completed checkout successfully
        if ($order->status === 'Draft') {
            $order->update(['status' => 'Pending']);
        }

        // Check Midtrans redirect query params to update payment status immediately
        // (webhook may arrive later, but we can update early based on redirect params)
        if ($order->payment_method === 'midtrans' && $order->payment_status === 'pending') {
            $transactionStatus = $request->query('transaction_status');
            $statusCode = $request->query('status_code');

            if (in_array($transactionStatus, ['settlement', 'capture']) || $statusCode === '200') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'Diproses',
                ]);
                $order->refresh();
            }
        }
        
        return view('checkout.success', compact('order'));
    }
}
