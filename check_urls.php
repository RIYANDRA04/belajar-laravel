<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$products = Product::all();
$broken = [];

$context = stream_context_create([
    'http' => [
        'method' => 'HEAD',
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
    ]
]);

foreach ($products as $p) {
    if (is_array($p->color_images)) {
        foreach ($p->color_images as $color => $url) {
            if (str_starts_with($url, 'http')) {
                $headers = @get_headers($url, 1, $context);
                if (!$headers || !str_contains($headers[0], '200')) {
                    echo "BROKEN: {$p->name} - {$color} -> $url\n";
                    $broken[] = ['id' => $p->id, 'name' => $p->name, 'color' => $color, 'url' => $url];
                } else {
                    echo "OK: {$p->name} - {$color}\n";
                }
            }
        }
    }
}
echo "Total broken: " . count($broken) . "\n";
