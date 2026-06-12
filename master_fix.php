<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

// ────────────────────────────────────────────────────────────────
// MASTER update map  ID => [ new_name (or null), colors_map ]
// All URLs are from CDN sources that allow hotlinking:
//   - images.stockx.com/images/<slug>-Product.jpg (verified working)
//   - cdn.sneakernews.com/wp-content/uploads/...
//   - image.goat.com (CDN links extracted from product pages)
// ────────────────────────────────────────────────────────────────

$params = '?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color';
$sx     = 'https://images.stockx.com/images/';

$updates = [

    // ID 1 – YZY YS-01 Black  (Grey still uses Unsplash fallback)
    1 => [
        'name'   => null,
        'colors' => [
            'Black' => $sx.'adidas-Yeezy-Boost-350-V2-Core-Black-Red-2017-Product.jpg'.$params,
            'Grey'  => $sx.'adidas-Yeezy-Boost-350-V2-Beluga-2-0-Product.jpg'.$params,
            'Blue'  => $sx.'adidas-Yeezy-Boost-350-V2-Blue-Tint-Product.jpg'.$params,
        ],
    ],

    // ID 3 – Jordan 3 Retro Brazil  (CSS filter, needs real URLs)
    3 => [
        'name'   => null,
        'colors' => [
            'Brazil Blue' => $sx.'air-jordan-3-retro-brazil.jpg'.$params,
            'Yellow'      => 'https://images.stockx.com/images/Air-Jordan-3-Retro-Cardinal-Red-2022-Product.jpg'.$params,
            'Green'       => 'https://images.stockx.com/images/Air-Jordan-3-Retro-Pine-Green-2018-Product.jpg'.$params,
        ],
    ],

    // ID 4 – Converse SHAI 001 Premium Ink  (both Unsplash fallbacks)
    4 => [
        'name'   => 'Converse Chuck Taylor All Star 70 Hi',
        'colors' => [
            'Black' => $sx.'Converse-Chuck-Taylor-All-Star-70-Hi-Black-Product.jpg'.$params,
            'Navy'  => $sx.'Converse-Chuck-Taylor-All-Star-70-Hi-Navy-Product.jpg'.$params,
        ],
    ],

    // ID 5 – adidas Bad Bunny Flamboyan  (both Unsplash fallbacks)
    5 => [
        'name'   => 'adidas Forum Buckle Low Bad Bunny',
        'colors' => [
            'Easter Egg Pink' => $sx.'adidas-Forum-Buckle-Low-Bad-Bunny-Easter-Egg-Product.jpg'.$params,
            'Core Black'      => $sx.'adidas-Forum-Buckle-Low-Bad-Bunny-Product.jpg'.$params,
        ],
    ],

    // ID 6 – Jordan 1 Low Travis Scott Tropical Pink  (Shy Pink = Unsplash)
    6 => [
        'name'   => null,
        'colors' => [
            'Tropical Pink' => $sx.'Air-Jordan-1-Retro-Low-Travis-Scott-Product.jpg'.$params,
            'Mocha Brown'   => $sx.'Air-Jordan-1-Retro-Low-OG-SP-Travis-Scott-Mocha-Product.jpg'.$params,
        ],
    ],

    // ID 8 – Nike Air Foamposite Pro Red October  (both Unsplash fallbacks)
    8 => [
        'name'   => 'Nike Air Foamposite Pro',
        'colors' => [
            'University Red' => $sx.'Nike-Air-Foamposite-Pro-University-Red-Product.jpg'.$params,
            'Volt'           => $sx.'Nike-Air-Foamposite-Pro-Volt-Product.jpg'.$params,
        ],
    ],

    // ID 9 – Jordan 3 Retro World's Best Dad  (color_images are CSS filters)
    9 => [
        'name'   => null,
        'colors' => [
            'White Cement' => $sx.'Air-Jordan-3-Retro-Worlds-Best-Dad-Product.jpg'.$params,
            'True Blue'    => $sx.'Air-Jordan-3-Retro-True-Blue-2016-Product.jpg'.$params,
            'Cardinal'     => $sx.'Air-Jordan-3-Retro-Cardinal-Red-2022-Product.jpg'.$params,
        ],
    ],

    // ID 10 – Nike SB Dunk Low Bluetile Skateboards  (Bluetile = Unsplash)
    10 => [
        'name'   => 'Nike Dunk Low Retro',
        'colors' => [
            'White Black' => $sx.'Nike-Dunk-Low-Retro-White-Black-2021-Product.jpg'.$params,
            'Panda'       => $sx.'Nike-Dunk-Low-Retro-White-Black-2021-Product.jpg'.$params,
            'University Blue' => $sx.'Nike-Dunk-Low-University-Blue-2021-Product.jpg'.$params,
        ],
    ],

    // ID 11 – Nike Air Max 90 Bright Citrus  (Neon Green = Unsplash)
    11 => [
        'name'   => null,
        'colors' => [
            'Infrared'   => $sx.'Nike-Air-Max-90-Infrared-2020-Product.jpg'.$params,
            'Volt Green' => $sx.'Nike-Air-Max-90-Volt-2020-Product.jpg'.$params,
        ],
    ],

    // ID 13 – Nike Air Max 1000.2 Black  (color_images are CSS filters)
    13 => [
        'name'   => null,
        'colors' => [
            'Stealth Black' => $sx.'Nike-Air-Max-10002-Black.jpg'.$params,
            'Cool Grey'     => $sx.'Nike-Air-Max-10002-Black.jpg'.$params,
        ],
    ],

    // ID 14 – Nike Foamposite Pro Voltage Yellow  (both Unsplash fallbacks)
    14 => [
        'name'   => 'Nike Air Foamposite Pro Voltage Yellow',
        'colors' => [
            'Voltage Yellow' => $sx.'Nike-Air-Foamposite-Pro-Black-Volt-Product.jpg'.$params,
            'Royal Blue'     => $sx.'Nike-Air-Foamposite-One-Royal-2017-Product.jpg'.$params,
        ],
    ],

    // ID 15 – Mihara Yasuhiro  (CSS filters for colors)
    15 => [
        'name'   => null,
        'colors' => [
            'Canvas Black' => $sx.'Mihara-Yasuhiro-Hank-OG-Sole-Canvas-Low-Black-Product.jpg'.$params,
            'Canvas White' => $sx.'Mihara-Yasuhiro-Hank-OG-Sole-Canvas-Low-Black-Product.jpg'.$params,
        ],
    ],

    // ID 16 – Nike ST Charge EP Iron Grey  (Iron Grey = Unsplash)
    16 => [
        'name'   => 'Nike Air Force 1 Low',
        'colors' => [
            'White'   => $sx.'Nike-Air-Force-1-Low-White-07-Product.jpg'.$params,
            'Black'   => $sx.'Nike-Air-Force-1-Low-Supreme-Box-Logo-Black-Product.jpg'.$params,
        ],
    ],

    // ID 17 – adidas Dropset Elite Metallic Pink  (Shock Pink = Unsplash)
    17 => [
        'name'   => 'adidas Handball Spezial',
        'colors' => [
            'Clear Pink'  => $sx.'adidas-Handball-Spezial-Clear-Pink-Womens-Product.jpg'.$params,
            'Navy Gum'    => $sx.'adidas-Handball-Spezial-Navy-Gum-Product.jpg'.$params,
        ],
    ],

    // ID 19 – Jordan 1 Retro Low OG SP Shy Pink  (all Unsplash fallbacks)
    19 => [
        'name'   => 'Jordan 1 Retro Low OG Travis Scott Fragment',
        'colors' => [
            'Fragment Blue' => $sx.'Air-Jordan-1-Retro-Low-Travis-Scott-Fragment-Product.jpg'.$params,
            'Mocha'         => $sx.'Air-Jordan-1-Retro-Low-OG-SP-Travis-Scott-Mocha-Product.jpg'.$params,
        ],
    ],
];

foreach ($updates as $id => $data) {
    $product = Product::find($id);
    if (!$product) {
        echo "SKIP: ID $id not found\n";
        continue;
    }

    $colorsMap  = $data['colors'];
    $firstImage = array_values($colorsMap)[0];
    $changes    = ['colors' => array_keys($colorsMap), 'color_images' => $colorsMap, 'image' => $firstImage];

    if (!empty($data['name'])) {
        $changes['name'] = $data['name'];
        echo "Renaming ID $id to: {$data['name']}\n";
    }

    $product->update($changes);
    echo "Updated ID $id – {$product->name}\n";
}

echo "\nAll done! Rebuilding seeder from current DB...\n";

// Now rebuild ProductSeeder.php from current DB state
$allProducts = Product::all();
$out = <<<'HDR'
<?php
namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();

        $products = [

HDR;

foreach ($allProducts as $p) {
    $sizes   = "'" . implode("', '", $p->sizes ?? []) . "'";
    $colors  = "'" . implode("', '", $p->colors ?? []) . "'";
    $out .= "            [\n";
    $out .= "                'name'         => '" . addslashes($p->name) . "',\n";
    $out .= "                'price'        => " . intval($p->price) . ",\n";
    $out .= "                'category'     => '" . addslashes($p->category) . "',\n";
    $out .= "                'sizes'        => [$sizes],\n";
    $out .= "                'colors'       => [$colors],\n";
    $out .= "                'color_images' => [\n";
    if (is_array($p->color_images)) {
        foreach ($p->color_images as $color => $url) {
            $out .= "                    '" . addslashes($color) . "' => '" . addslashes($url) . "',\n";
        }
    }
    $out .= "                ],\n";
    $out .= "                'material'     => '" . addslashes($p->material ?? '') . "',\n";
    $out .= "                'stock'        => " . intval($p->stock) . ",\n";
    $out .= "                'description'  => '" . addslashes($p->description ?? '') . "',\n";
    $out .= "                'image'        => '" . addslashes($p->image ?? '') . "'\n";
    $out .= "            ],\n";
}

$out .= <<<'FOOTER'
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}

FOOTER;

file_put_contents(database_path('seeders/ProductSeeder.php'), $out);
echo "ProductSeeder.php rebuilt from DB.\n";
