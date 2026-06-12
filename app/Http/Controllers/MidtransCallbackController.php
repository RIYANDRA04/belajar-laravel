<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        
        // Re-generate signature key
        $signatureKey = hash('sha512', 
            $request->order_id . 
            $request->status_code . 
            $request->gross_amount . 
            $serverKey
        );

        // Validasi signature
        if ($signatureKey !== $request->signature_key) {
            Log::error('Midtrans Webhook: Invalid signature key.', [
                'order_id' => $request->order_id,
                'received_signature' => $request->signature_key,
                'calculated_signature' => $signatureKey
            ]);
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Ekstrak ID pesanan riil dari order_id Midtrans (format: SA-orderId-timestamp)
        $orderIdParts = explode('-', $request->order_id);
        $realOrderId = $orderIdParts[1] ?? $request->order_id;

        $order = Order::find($realOrderId);
        if (!$order) {
            Log::error('Midtrans Webhook: Order not found.', ['real_order_id' => $realOrderId]);
            return response()->json(['message' => 'Order not found'], 404);
        }

        $transactionStatus = $request->transaction_status;
        $type = $request->payment_type;

        Log::info("Midtrans Webhook Received: Order ID #{$realOrderId}, Status: {$transactionStatus}");

        if ($transactionStatus == 'capture') {
            if ($type == 'credit_card') {
                if ($request->fraud_status == 'challenge') {
                    $order->payment_status = 'pending';
                } else {
                    $order->payment_status = 'paid';
                    $order->status = 'Diproses'; // Langsung di proses
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->payment_status = 'paid';
            $order->status = 'Diproses'; // Langsung di proses
        } elseif ($transactionStatus == 'pending') {
            $order->payment_status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $order->payment_status = 'expired';
        }

        $order->save();

        return response()->json(['status' => 'success']);
    }
}
