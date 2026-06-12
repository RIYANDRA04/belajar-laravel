<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$products = Product::all();
foreach ($products as $p) {
    echo "ID:{$p->id} | {$p->name}\n";
    echo "  image: {$p->image}\n";
    if (is_array($p->color_images)) {
        foreach ($p->color_images as $color => $url) {
            echo "  [{$color}] => {$url}\n";
        }
    }
    echo "\n";
}
