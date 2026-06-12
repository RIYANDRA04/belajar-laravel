<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

foreach (App\Models\Order::latest()->take(5)->get() as $order) {
    echo "ID: " . $order->id . " | Name: " . $order->customer_name . " | Total: " . $order->total_amount . " | Method: " . $order->payment_method . " | Created: " . $order->created_at . "\n";
}
