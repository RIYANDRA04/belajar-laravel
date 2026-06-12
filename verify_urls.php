<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$context = stream_context_create([
    'http' => [
        'method'  => 'HEAD',
        'timeout' => 5,
        'header'  => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n",
    ]
]);

$broken = [];
$ok     = 0;

$products = Product::all();
foreach ($products as $p) {
    $toCheck = array_merge(
        [$p->image],
        is_array($p->color_images) ? array_values($p->color_images) : []
    );

    foreach (array_unique($toCheck) as $url) {
        if (!$url || !str_starts_with($url, 'http')) continue;

        $headers = @get_headers($url, 1, $context);
        $status  = $headers ? $headers[0] : 'NO RESPONSE';

        if (!$headers || (!str_contains($status, '200') && !str_contains($status, '301') && !str_contains($status, '302'))) {
            echo "BROKEN [{$p->id}] {$p->name} => $url\n   Status: $status\n";
            $broken[] = ['id' => $p->id, 'name' => $p->name, 'url' => $url];
        } else {
            $ok++;
        }
    }
}

echo "\nOK: $ok | Broken: " . count($broken) . "\n";
