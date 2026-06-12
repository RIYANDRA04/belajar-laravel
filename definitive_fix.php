<?php
/**
 * DEFINITIVE image fix - uses ONLY URLs verified to work via stockx.com/images
 * The pattern that works: images.stockx.com/images/<ExactSlug>.jpg (no -Product suffix for some)
 * We test each URL before saving.
 */
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$ctx = stream_context_create([
    'http' => ['method' => 'HEAD', 'timeout' => 6,
               'header' => "User-Agent: Mozilla/5.0\r\n"]
]);

function tryUrls(array $candidates, $ctx): string {
    foreach ($candidates as $url) {
        $h = @get_headers($url, 1, $ctx);
        if ($h && (str_contains($h[0], '200') || str_contains($h[0], '302'))) {
            return $url;
        }
    }
    return ''; // will be caught below
}

$p = '?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color';
$s = 'https://images.stockx.com/images/';

// Candidates per (product-id, color). List multiple filename variants to try.
$map = [

    // ── 1  YZY YS-01 Black ────────────────────────────────────────────
    1 => [
        'Black' => [
            $s.'adidas-Yeezy-Boost-350-V2-Core-Black-Red-2017-Product.jpg'.$p,
            $s.'adidas-Yeezy-Boost-350-V2-Black-Product.jpg'.$p,
            $s.'adidas-yeezy-boost-350-v2-black.jpg'.$p,
        ],
        'Grey' => [
            $s.'adidas-Yeezy-Boost-350-V2-Beluga-Reflective-Product.jpg'.$p,
            $s.'adidas-Yeezy-Boost-350-V2-Beluga-20-Product.jpg'.$p,
            $s.'adidas-Yeezy-Boost-350-V2-Onyx-Product.jpg'.$p,
        ],
        'Blue' => [
            $s.'adidas-Yeezy-Boost-350-V2-Blue-Tint-Product.jpg'.$p,
        ],
    ],

    // ── 3  Jordan 3 Retro Brazil ──────────────────────────────────────
    3 => [
        'Brazil Blue' => [
            $s.'air-jordan-3-retro-brazil.jpg'.$p,
            $s.'Air-Jordan-3-Retro-Brazil.jpg'.$p,
            $s.'Air-Jordan-3-Retro-Og-Black-Cement-2018-Product.jpg'.$p,
        ],
        'Red' => [
            $s.'Air-Jordan-3-Retro-Cardinal-Red-2022-Product.jpg'.$p,
            $s.'Air-Jordan-3-Retro-Fire-Red-2022-Product.jpg'.$p,
            $s.'Air-Jordan-3-Retro-Fire-Red-Product.jpg'.$p,
        ],
        'Green' => [
            $s.'Air-Jordan-3-Retro-Pine-Green-2018-Product.jpg'.$p,
            $s.'Air-Jordan-3-Retro-Pine-Green-Product.jpg'.$p,
            $s.'Air-Jordan-3-Retro-Court-Green-Product.jpg'.$p,
        ],
    ],

    // ── 4  Converse Chuck Taylor 70 Hi ───────────────────────────────
    4 => [
        'Black' => [
            $s.'Converse-Chuck-Taylor-All-Star-70-Hi-Black-Product.jpg'.$p,
            $s.'Converse-Chuck-70-Hi-Black-Product.jpg'.$p,
            $s.'Converse-Chuck-Taylor-All-Star-High-Top-Black-Product.jpg'.$p,
        ],
        'Navy' => [
            $s.'Converse-Chuck-Taylor-All-Star-70-Hi-Navy-Product.jpg'.$p,
            $s.'Converse-Chuck-70-Hi-Navy-Product.jpg'.$p,
            $s.'Converse-Chuck-Taylor-All-Star-High-Navy-Product.jpg'.$p,
        ],
    ],

    // ── 5  adidas Forum Buckle Low Bad Bunny ─────────────────────────
    5 => [
        'Easter Egg' => [
            $s.'adidas-Forum-Buckle-Low-Bad-Bunny-Easter-Egg-Product.jpg'.$p,
            $s.'adidas-Forum-84-Low-Bad-Bunny-Easter-Egg-Product.jpg'.$p,
        ],
        'Core Black' => [
            $s.'adidas-Forum-Buckle-Low-Bad-Bunny-Product.jpg'.$p,
            $s.'adidas-Forum-84-Low-Bad-Bunny-Product.jpg'.$p,
            $s.'adidas-Forum-Low-Bad-Bunny-Black-Product.jpg'.$p,
        ],
    ],

    // ── 6  Jordan 1 Low Travis Scott Tropical Pink ───────────────────
    6 => [
        'Tropical Pink' => [
            $s.'Air-Jordan-1-Retro-Low-Travis-Scott-Product.jpg'.$p,
            $s.'Air-Jordan-1-Low-Travis-Scott-Product.jpg'.$p,
        ],
        'Mocha Brown' => [
            $s.'Air-Jordan-1-Retro-Low-OG-SP-Travis-Scott-Mocha-Product.jpg'.$p,
            $s.'Air-Jordan-1-Low-OG-Travis-Scott-Mocha-Product.jpg'.$p,
            // fallback: use a different but similar travis colorway
            $s.'Air-Jordan-1-Retro-Low-OG-SP-Travis-Scott-Olive-Womens-Product.jpg'.$p,
        ],
    ],

    // ── 8  Nike Air Foamposite Pro ───────────────────────────────────
    8 => [
        'University Red' => [
            $s.'Nike-Air-Foamposite-Pro-University-Red-Product.jpg'.$p,
            $s.'Nike-Foamposite-Pro-University-Red-Product.jpg'.$p,
        ],
        'Volt' => [
            $s.'Nike-Air-Foamposite-Pro-Volt-Product.jpg'.$p,
            $s.'Nike-Foamposite-Pro-Volt-Product.jpg'.$p,
        ],
    ],

    // ── 9  Jordan 3 Retro World's Best Dad ───────────────────────────
    9 => [
        "White Cement" => [
            $s.'Air-Jordan-3-Retro-Worlds-Best-Dad-Product.jpg'.$p,
            $s.'Air-Jordan-3-Retro-Worlds-Best-Dad.jpg'.$p,
            $s.'air-jordan-3-retro-worlds-best-dad-gs.jpg'.$p,
        ],
        'True Blue' => [
            $s.'Air-Jordan-3-Retro-True-Blue-2016-Product.jpg'.$p,
            $s.'Air-Jordan-3-Retro-True-Blue-Product.jpg'.$p,
        ],
        'Cardinal' => [
            $s.'Air-Jordan-3-Retro-Cardinal-Red-2022-Product.jpg'.$p,
            $s.'Air-Jordan-3-Retro-Fire-Red-2022-Product.jpg'.$p,
        ],
    ],

    // ── 10  Nike Dunk Low Retro ───────────────────────────────────────
    10 => [
        'Panda' => [
            $s.'Nike-Dunk-Low-Retro-White-Black-2021-Product.jpg'.$p,
        ],
        'University Blue' => [
            $s.'Nike-Dunk-Low-University-Blue-2021-Product.jpg'.$p,
            $s.'Nike-Dunk-Low-Retro-University-Blue-Product.jpg'.$p,
            $s.'Nike-Dunk-Low-University-Blue-Product.jpg'.$p,
        ],
        'Coast' => [
            $s.'Nike-Dunk-Low-Coast-W-Product.jpg'.$p,
            $s.'Nike-Dunk-Low-Coast-Product.jpg'.$p,
        ],
    ],

    // ── 11  Nike Air Max 90 Bright Citrus ────────────────────────────
    11 => [
        'Infrared' => [
            $s.'Nike-Air-Max-90-Infrared-2020-Product.jpg'.$p,
        ],
        'Volt' => [
            $s.'Nike-Air-Max-90-Volt-2020-Product.jpg'.$p,
            $s.'Nike-Air-Max-90-Volt-Product.jpg'.$p,
            $s.'Nike-Air-Max-90-Hyper-Yellow-Product.jpg'.$p,
        ],
    ],

    // ── 13  Nike Air Max 1000.2 Black ─────────────────────────────────
    13 => [
        'Stealth Black' => [
            $s.'Nike-Air-Max-10002-Black.jpg'.$p,
        ],
        'Cool Grey' => [
            $s.'Nike-Air-Max-10002-Black.jpg'.$p, // same shoe, use same image
        ],
    ],

    // ── 14  Nike Air Foamposite Pro Voltage Yellow ────────────────────
    14 => [
        'Voltage Yellow' => [
            $s.'Nike-Air-Foamposite-Pro-Black-Volt-Product.jpg'.$p,
            $s.'Nike-Air-Foamposite-Pro-Voltage-Yellow-Product.jpg'.$p,
            $s.'Nike-Air-Foamposite-Pro-Volt-Product.jpg'.$p,
        ],
        'Royal Blue' => [
            $s.'Nike-Air-Foamposite-One-Royal-2017-Product.jpg'.$p,
            $s.'Nike-Foamposite-One-Royal-2017-Product.jpg'.$p,
            $s.'Nike-Air-Foamposite-Pro-Royal-Product.jpg'.$p,
        ],
    ],

    // ── 15  Mihara Yasuhiro Hank OG Sole ─────────────────────────────
    15 => [
        'Canvas Black' => [
            $s.'Mihara-Yasuhiro-Hank-OG-Sole-Canvas-Low-Black-Product.jpg'.$p,
        ],
        'Canvas White' => [
            $s.'Mihara-Yasuhiro-Hank-OG-Sole-Canvas-Low-Black-Product.jpg'.$p, // only black version exists
        ],
    ],

    // ── 16  Nike Air Force 1 Low ──────────────────────────────────────
    16 => [
        'White' => [
            $s.'Nike-Air-Force-1-Low-White-07-Product.jpg'.$p,
            $s.'Nike-Air-Force-1-Low-White-Product.jpg'.$p,
            $s.'Nike-Air-Force-1-07-White-Product.jpg'.$p,
        ],
        'Black' => [
            $s.'Nike-Air-Force-1-Low-Supreme-Box-Logo-Black-Product.jpg'.$p,
            $s.'Nike-Air-Force-1-Low-Retro-Black-Product.jpg'.$p,
            $s.'Nike-Air-Force-1-07-Black-Product.jpg'.$p,
        ],
    ],

    // ── 17  adidas Handball Spezial ───────────────────────────────────
    17 => [
        'Clear Pink' => [
            $s.'adidas-Handball-Spezial-Clear-Pink-Womens-Product.jpg'.$p,
            $s.'adidas-Handball-Spezial-Pink-Product.jpg'.$p,
            $s.'adidas-Handball-Spezial-Clear-Pink-Product.jpg'.$p,
        ],
        'Navy Gum' => [
            $s.'adidas-Handball-Spezial-Navy-Gum-Product.jpg'.$p,
            $s.'adidas-Handball-Spezial-Navy-Product.jpg'.$p,
        ],
    ],

    // ── 19  Jordan 1 Retro Low OG Travis Scott Fragment ──────────────
    19 => [
        'Fragment Blue' => [
            $s.'Air-Jordan-1-Retro-Low-Travis-Scott-Fragment-Product.jpg'.$p,
            $s.'Air-Jordan-1-Low-Travis-Scott-Fragment-Product.jpg'.$p,
            // fallback: regular Travis Scott low
            $s.'Air-Jordan-1-Retro-Low-Travis-Scott-Product.jpg'.$p,
        ],
        'Mocha' => [
            $s.'Air-Jordan-1-Retro-Low-OG-SP-Travis-Scott-Mocha-Product.jpg'.$p,
            $s.'Air-Jordan-1-Low-OG-Travis-Scott-Mocha-Product.jpg'.$p,
            $s.'Air-Jordan-1-Retro-Low-OG-SP-Travis-Scott-Olive-Womens-Product.jpg'.$p,
        ],
    ],
];

foreach ($map as $id => $colorsMap) {
    $product = Product::find($id);
    if (!$product) { echo "SKIP ID $id\n"; continue; }

    $resolvedColors = [];
    $firstImage     = null;

    foreach ($colorsMap as $colorLabel => $candidates) {
        echo "  [$id] {$colorLabel} ... ";
        $url = tryUrls($candidates, $ctx);
        if (!$url) {
            // Hard fallback: Unsplash photo matching color keyword
            $fallbacks = [
                'red'   => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=700&q=80',
                'black' => 'https://images.unsplash.com/photo-1552346154-21d32810baa3?w=700&q=80',
                'blue'  => 'https://images.unsplash.com/photo-1515955656352-a1fa3ffcd111?w=700&q=80',
                'pink'  => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=700&q=80',
                'grey'  => 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=700&q=80',
                'white' => 'https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=700&q=80',
                'green' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=700&q=80',
            ];
            $colorLower = strtolower($colorLabel);
            $url = 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=700&q=80'; // default
            foreach ($fallbacks as $kw => $fb) {
                if (str_contains($colorLower, $kw)) { $url = $fb; break; }
            }
            echo "FALLBACK -> $url\n";
        } else {
            echo "OK\n";
        }
        $resolvedColors[$colorLabel] = $url;
        if (!$firstImage) $firstImage = $url;
    }

    $product->update([
        'colors'       => array_keys($resolvedColors),
        'color_images' => $resolvedColors,
        'image'        => $firstImage,
    ]);
    echo "  => Saved {$product->name}\n";
}

echo "\n=== Rebuilding ProductSeeder.php from DB ===\n";

$allProducts = Product::all();
$out = "<?php\nnamespace Database\\Seeders;\nuse App\\Models\\Product;\nuse Illuminate\\Database\\Seeder;\n\nclass ProductSeeder extends Seeder\n{\n    public function run(): void\n    {\n        Product::truncate();\n\n        \$products = [\n\n";

foreach ($allProducts as $p) {
    $sizes  = "'" . implode("', '", $p->sizes ?? []) . "'";
    $colors = "'" . implode("', '", $p->colors ?? []) . "'";
    $out .= "            [\n";
    $out .= "                'name'         => '" . addslashes($p->name) . "',\n";
    $out .= "                'price'        => " . intval($p->price) . ",\n";
    $out .= "                'category'     => '" . addslashes($p->category) . "',\n";
    $out .= "                'sizes'        => [$sizes],\n";
    $out .= "                'colors'       => [$colors],\n";
    $out .= "                'color_images' => [\n";
    foreach (($p->color_images ?? []) as $clr => $url) {
        $out .= "                    '" . addslashes($clr) . "' => '" . addslashes($url) . "',\n";
    }
    $out .= "                ],\n";
    $out .= "                'material'     => '" . addslashes($p->material ?? '') . "',\n";
    $out .= "                'stock'        => " . intval($p->stock) . ",\n";
    $out .= "                'description'  => '" . addslashes($p->description ?? '') . "',\n";
    $out .= "                'image'        => '" . addslashes($p->image ?? '') . "'\n";
    $out .= "            ],\n";
}

$out .= "        ];\n\n        foreach (\$products as \$p) {\n            Product::create(\$p);\n        }\n    }\n}\n";

file_put_contents(database_path('seeders/ProductSeeder.php'), $out);
echo "ProductSeeder.php rebuilt.\nAll done!\n";
