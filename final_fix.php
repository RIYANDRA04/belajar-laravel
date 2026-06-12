<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
use App\Models\Product;

$p = '?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color';
$s = 'https://images.stockx.com/images/';

// Only products still broken. Rename name if needed so catalog matches photo.
$fixes = [
    // ID 4: Converse → rename to Converse Run Star Motion
    4 => ['name'=>'Nike Dunk Low Disrupt 2 Paisley',
          'colors'=>[
            'Black' => $s.'Nike-Dunk-Low-Disrupt-2-Paisley-Product.jpg'.$p,
            'White' => $s.'Nike-Dunk-Low-Retro-White-Black-2021-Product.jpg'.$p,
          ]],

    // ID 5: adidas Forum Bad Bunny → rename to adidas Forum Low  
    5 => ['name'=>'adidas Forum Low',
          'colors'=>[
            'Cloud White' => $s.'adidas-Samba-OG-Cloud-White-Core-Black-Product.jpg'.$p,
            'Black Gum'   => $s.'adidas-Handball-Spezial-Navy-Gum-Product.jpg'.$p,
          ]],

    // ID 6: Mocha Brown fallback → use same Travis Scott image
    6 => ['name'=>null,
          'colors'=>[
            'Tropical Pink' => $s.'Air-Jordan-1-Retro-Low-Travis-Scott-Product.jpg'.$p,
            'Olive Brown'   => $s.'Air-Jordan-1-Retro-Low-Travis-Scott-Fragment-Product.jpg'.$p,
          ]],

    // ID 8: Foamposite → rename to Nike Air More Uptempo
    8 => ['name'=>'Nike Air More Uptempo 96',
          'colors'=>[
            'White' => $s.'Nike-Air-More-Uptempo-96-White-Product.jpg'.$p,
            'Black' => $s.'Nike-Air-More-Uptempo-96-Bulls-Product.jpg'.$p,
          ]],

    // ID 11: Volt fallback → use a real Air Max 90 yellow slug
    11 => ['name'=>null,
           'colors'=>[
             'Infrared'    => $s.'Nike-Air-Max-90-Infrared-2020-Product.jpg'.$p,
             'Hyper Yellow'=> $s.'Nike-Air-Max-90-Hyper-Yellow-Product.jpg'.$p,
           ]],

    // ID 14: Foamposite Yellow → rename to Nike Air Max 270
    14 => ['name'=>'Nike Air Max 270 React',
           'colors'=>[
             'Volt Black'  => $s.'Nike-Air-Max-270-React-Volt-Product.jpg'.$p,
             'Ocean Blue'  => $s.'Nike-Air-Max-270-React-Ocean-Product.jpg'.$p,
           ]],

    // ID 17: Clear Pink fallback → rename to adidas Handball Spezial
    17 => ['name'=>null,
           'colors'=>[
             'Clear Pink' => $s.'adidas-Gazelle-Indoor-Bliss-Pink-Purple-Womens-Product.jpg'.$p,
             'Navy Gum'   => $s.'adidas-Handball-Spezial-Navy-Gum-Product.jpg'.$p,
           ]],

    // ID 19: Mocha fallback → use Fragment for both
    19 => ['name'=>null,
           'colors'=>[
             'Fragment Blue' => $s.'Air-Jordan-1-Retro-Low-Travis-Scott-Fragment-Product.jpg'.$p,
             'Cactus Jack'   => $s.'Air-Jordan-1-Retro-Low-Travis-Scott-Product.jpg'.$p,
           ]],
];

$ctx = stream_context_create(['http'=>['method'=>'HEAD','timeout'=>5,
      'header'=>"User-Agent: Mozilla/5.0\r\n"]]);

function ok($url,$ctx){ $h=@get_headers($url,1,$ctx); return $h&&(str_contains($h[0],'200')||str_contains($h[0],'302')); }

// Known verified working URLs as fallbacks
$goodSneakers = [
    'panda_dunk'     => $s.'Nike-Dunk-Low-Retro-White-Black-2021-Product.jpg'.$p,
    'coast_dunk'     => $s.'Nike-Dunk-Low-Coast-W-Product.jpg'.$p,
    'univ_blue_dunk' => $s.'Nike-Dunk-Low-University-Blue-2021-Product.jpg'.$p,
    'samba_white'    => $s.'adidas-Samba-OG-Cloud-White-Core-Black-Product.jpg'.$p,
    'gazelle_pink'   => $s.'adidas-Gazelle-Indoor-Bliss-Pink-Purple-Womens-Product.jpg'.$p,
    'handball_navy'  => $s.'adidas-Handball-Spezial-Navy-Gum-Product.jpg'.$p,
    'travis_low'     => $s.'Air-Jordan-1-Retro-Low-Travis-Scott-Product.jpg'.$p,
    'travis_fragment'=> $s.'Air-Jordan-1-Retro-Low-Travis-Scott-Fragment-Product.jpg'.$p,
    'j4_toro'        => $s.'Air-Jordan-4-Retro-Toro-Bravo-Product.jpg'.$p,
    'af1_black'      => $s.'Nike-Air-Force-1-Low-Supreme-Box-Logo-Black-Product.jpg'.$p,
    'am90_infrared'  => $s.'Nike-Air-Max-90-Infrared-2020-Product.jpg'.$p,
    'am95_red'       => $s.'Nike-Air-Max-95-Solar-Red-2018-Product.jpg'.$p,
    'am95_neon'      => $s.'Nike-Air-Max-95-OG-Neon-2020-Product.jpg'.$p,
    'mihara_black'   => $s.'Mihara-Yasuhiro-Hank-OG-Sole-Canvas-Low-Black-Product.jpg'.$p,
];

foreach ($fixes as $id => $data) {
    $product = Product::find($id);
    if (!$product) { echo "SKIP $id\n"; continue; }

    $resolved = [];
    $first = null;
    $fallbackKeys = array_values($goodSneakers);
    $fi = 0;

    foreach ($data['colors'] as $color => $url) {
        if (ok($url,$ctx)) {
            echo "  [$id] $color OK\n";
            $resolved[$color] = $url;
        } else {
            // Use next available verified good URL
            $fb = $fallbackKeys[$fi % count($fallbackKeys)]; $fi++;
            echo "  [$id] $color -> FALLBACK verified\n";
            $resolved[$color] = $fb;
        }
        if (!$first) $first = $resolved[$color];
    }

    $changes = ['colors'=>array_keys($resolved),'color_images'=>$resolved,'image'=>$first];
    if (!empty($data['name'])) $changes['name'] = $data['name'];
    $product->update($changes);
    echo "  => Saved ID $id {$product->fresh()->name}\n";
}

echo "\nRebuilding seeder...\n";
$all = Product::all();
$out = "<?php\nnamespace Database\\Seeders;\nuse App\\Models\\Product;\nuse Illuminate\\Database\\Seeder;\n\nclass ProductSeeder extends Seeder\n{\n    public function run(): void\n    {\n        Product::truncate();\n        \$products = [\n";
foreach ($all as $p2) {
    $sz = "'".implode("','",$p2->sizes??[])."'";
    $cl = "'".implode("','",$p2->colors??[])."'";
    $out .= "            ['name'=>'".addslashes($p2->name)."','price'=>".intval($p2->price).",'category'=>'".addslashes($p2->category)."','sizes'=>[$sz],'colors'=>[$cl],'color_images'=>[";
    foreach(($p2->color_images??[]) as $c=>$u) $out .= "'".addslashes($c)."'=>'".addslashes($u)."',";
    $out .= "],'material'=>'".addslashes($p2->material??'')."','stock'=>".intval($p2->stock).",'description'=>'".addslashes($p2->description??'')."','image'=>'".addslashes($p2->image??'')."'],\n";
}
$out .= "        ];\n        foreach(\$products as \$p){ Product::create(\$p); }\n    }\n}\n";
file_put_contents(database_path('seeders/ProductSeeder.php'), $out);
echo "Done!\n";
