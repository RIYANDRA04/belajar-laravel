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
            [
                'name'         => 'Adidas samba',
                'price'        => 2200000,
                'category'     => 'Lifestyle',
                'sizes'        => ['36', '37', '38', '39', '40', '41', '42'],
                'colors'       => ['White Black Gum', 'Black Gum', 'Reflective Nylon Pack - Oat', 'Royal Blue Gum', 'Wonder Clay Royal Blue'],
                'color_images' => [
                    'White Black Gum' => 'shoes/shoe_6a0fa23020c058.61351003.webp',
                    'Black Gum' => 'shoes/shoe_6a0fa23021b741.55714145.webp',
                    'Reflective Nylon Pack - Oat' => 'shoes/shoe_6a0fa230224c98.55065837.webp',
                    'Royal Blue Gum' => 'shoes/shoe_6a0fa23022e4d4.59761305.webp',
                    'Wonder Clay Royal Blue' => 'shoes/shoe_6a0fa23023a106.68738940.webp',
                ],
                'material'     => 'Leather & Suede',
                'stock'        => 15,
                'description'  => 'Adidas Samba OG adalah ikon sepak bola jalanan retro yang tak lekang oleh waktu, menampilkan upper kulit premium, toe box suede berbentuk T, dan sol karet gum yang ikonik.',
                'image'        => 'shoes/shoe_6a0fa23020c058.61351003.webp'
            ],
            [
                'name'         => 'Adidas Spezial',
                'price'        => 2000000,
                'category'     => 'Lifestyle',
                'sizes'        => ['38', '39', '40', '41', '42'],
                'colors'       => ['Collegiate Navy Clear Sky', 'Crystal Sky Pure Tangerine', 'Lucid Pink Gum', 'Collegiate Green Pink Velvet'],
                'color_images' => [
                    'Collegiate Navy Clear Sky' => 'shoes/shoe_6a0fa2f2b32699.97466196.webp',
                    'Crystal Sky Pure Tangerine' => 'shoes/shoe_6a0fa2f2b41082.46318550.webp',
                    'Lucid Pink Gum' => 'shoes/shoe_6a0fa2f2b4c0e4.06186553.webp',
                    'Collegiate Green Pink Velvet' => 'shoes/shoe_6a0fa2f2b55109.53581150.webp',
                ],
                'material'     => 'Suede',
                'stock'        => 18,
                'description'  => 'Adidas Handball Spezial pertama kali dirilis tahun 1979 untuk olahraga bola tangan, kini hadir kembali sebagai ikon streetwear kasual dengan material suede premium dan kenyamanan luar biasa.',
                'image'        => 'shoes/shoe_6a0fa2f2b32699.97466196.webp'
            ],
            [
                'name'         => 'adidas Gazelle',
                'price'        => 1900000,
                'category'     => 'Lifestyle',
                'sizes'        => ['38', '39', '40', '41', '42'],
                'colors'       => ['Better Scarlet Core White', 'Bold Green EQT Yellow', 'Mineral Green Silver Dawn'],
                'color_images' => [
                    'Better Scarlet Core White' => 'shoes/shoe_6a0fa60639aec5.38540173.webp',
                    'Bold Green EQT Yellow' => 'shoes/shoe_6a0fa6063a7fa5.68633710.webp',
                    'Mineral Green Silver Dawn' => 'shoes/shoe_6a0fa6063b2918.78993772.webp',
                ],
                'material'     => 'Suede/Leather',
                'stock'        => 20,
                'description'  => 'Siluet klasik adidas Gazelle menghadirkan getaran retro tahun 90-an dengan upper suede yang halus, 3-Stripes kontras, dan outsole karet bertekstur.',
                'image'        => 'shoes/shoe_6a0fa60639aec5.38540173.webp'
            ],
            [
                'name'         => 'Converse 70S HI',
                'price'        => 1400000,
                'category'     => 'Lifestyle',
                'sizes'        => ['38', '39', '40', '41', '42'],
                'colors'       => ['Electrolights', 'Cold Stare', 'Black', 'Southern Flame', 'Pigeon Grey'],
                'color_images' => [
                    'Electrolights' => 'shoes/shoe_6a0fa41d97d807.92281490.webp',
                    'Cold Stare' => 'shoes/shoe_6a0fa41d9871e5.78175796.webp',
                    'Black' => 'shoes/shoe_6a0fa41d992d24.69676145.webp',
                    'Southern Flame' => 'shoes/shoe_6a0fa41d9a0231.77366337.webp',
                    'Pigeon Grey' => 'shoes/shoe_6a0fa41d9acd66.95601692.webp',
                ],
                'material'     => 'Premium Canvas',
                'stock'        => 25,
                'description'  => 'Converse Chuck 70 High adalah bentuk penghormatan bagi Chuck Taylor All Star klasik dengan kanvas yang lebih tebal, sol karet kokoh, dan bantalan kaki yang lebih empuk.',
                'image'        => 'shoes/shoe_6a0fa41d97d807.92281490.webp'
            ],
            [
                'name'         => 'Nike Dunk',
                'price'        => 2400000,
                'category'     => 'Lifestyle',
                'sizes'        => ['39', '40', '41', '42'],
                'colors'       => ['Bubbles', 'Chunky Dunky', 'Halloween Skull', 'Los Angeles'],
                'color_images' => [
                    'Bubbles' => 'shoes/shoe_6a0fa526217c84.00862652.webp',
                    'Chunky Dunky' => 'shoes/shoe_6a0fa526223766.95152182.webp',
                    'Halloween Skull' => 'shoes/shoe_6a0fa526230694.03495565.webp',
                    'Los Angeles' => 'shoes/shoe_6a0fa52623c165.75313753.webp',
                ],
                'material'     => 'Leather',
                'stock'        => 12,
                'description'  => 'Nike Dunk Low menghadirkan kembali gaya lapangan basket tahun 80-an ke jalan raya. Kombinasi warna yang mencolok dan siluet legendaris memberikan kenyamanan harian berkat sol tengah empuk.',
                'image'        => 'shoes/shoe_6a0fa526217c84.00862652.webp'
            ],
            [
                'name'         => 'Nike Air Force 1 Low',
                'price'        => 1800000,
                'category'     => 'Lifestyle',
                'sizes'        => ['38', '39', '40', '41', '42'],
                'colors'       => ['Fauna Brown', 'Genesis'],
                'color_images' => [
                    'Fauna Brown' => 'shoes/shoe_6a0fa67055ef83.09610234.webp',
                    'Genesis' => 'shoes/shoe_6a0fa67056aa85.80056515.webp',
                ],
                'material'     => 'Leather/Suede',
                'stock'        => 30,
                'description'  => 'Gaya legendaris yang tidak pernah pudar, Nike Air Force 1 Low menggabungkan kenyamanan luar biasa dari bantalan udara Nike Air dengan siluet retro berkelas.',
                'image'        => 'shoes/shoe_6a0fa67055ef83.09610234.webp'
            ],
            [
                'name'         => 'New Balance 1000',
                'price'        => 2600000,
                'category'     => 'Running',
                'sizes'        => ['39', '40', '41', '42'],
                'colors'       => ['Green Grey', 'Deep Ocean', 'Bāṅdhnū'],
                'color_images' => [
                    'Green Grey' => 'shoes/shoe_6a0fa71de9da80.73179536.webp',
                    'Deep Ocean' => 'shoes/shoe_6a0fa71dea8712.59711272.webp',
                    'Bāṅdhnū' => 'shoes/shoe_6a0fa71deb33c8.27210459.webp',
                ],
                'material'     => 'Mesh & Synthetic',
                'stock'        => 10,
                'description'  => 'New Balance 1000 menghadirkan kembali siluet lari retro akhir tahun 90-an dengan sol tebal yang empuk, garis dinamis yang sporty, serta kombinasi warna-warni yang mencolok.',
                'image'        => 'shoes/shoe_6a0fa71de9da80.73179536.webp'
            ],
            [
                'name'         => 'Nike Air Max Plus TN',
                'price'        => 2900000,
                'category'     => 'Running',
                'sizes'        => ['39', '40', '41', '42'],
                'colors'       => ['Black Metallic Silver', 'Triple Black', 'Black Dusty Cactus', 'University Red'],
                'color_images' => [
                    'Black Metallic Silver' => 'shoes/shoe_6a0fa82731f3d5.24733302.webp',
                    'Triple Black' => 'shoes/shoe_6a0fa827328065.35091740.webp',
                    'Black Dusty Cactus' => 'shoes/shoe_6a0fa827330ad0.46731804.webp',
                    'University Red' => 'shoes/shoe_6a0fa827339fd8.82635161.webp',
                ],
                'material'     => 'Mesh & TPU',
                'stock'        => 15,
                'description'  => 'Nike Air Max Plus (Tuned Air) menawarkan kestabilan luar biasa dan bantalan udara ikonik di bawah kaki Anda, dibalut desain taring TPU terinspirasi pohon palem pantai.',
                'image'        => 'shoes/shoe_6a0fa82731f3d5.24733302.webp'
            ],
            [
                'name'         => 'New Balance 1906R',
                'price'        => 2800000,
                'category'     => 'Running',
                'sizes'        => ['39', '40', '41', '42'],
                'colors'       => ['White Gold', 'New Spruce', 'Grey Blue Metallic', 'Inkwell Sea Salt'],
                'color_images' => [
                    'White Gold' => 'shoes/shoe_6a0fa92baac5a5.09856935.webp',
                    'New Spruce' => 'shoes/shoe_6a0fa92bab7a92.36731703.webp',
                    'Grey Blue Metallic' => 'shoes/shoe_6a0fa92bac83c1.29181089.webp',
                    'Inkwell Sea Salt' => 'shoes/shoe_6a0fa92bad06e9.54303142.webp',
                ],
                'material'     => 'Synthetic Mesh',
                'stock'        => 14,
                'description'  => 'Menghormati estetika lari tahun 2000-an, New Balance 1906R menawarkan sol tengah N-ergy yang menyerap benturan keras dan bantalan tumit ABZORB SBS yang luar biasa stabil.',
                'image'        => 'shoes/shoe_6a0fa92baac5a5.09856935.webp'
            ],
            [
                'name'         => 'ASICS Gel Kayano 14',
                'price'        => 2700000,
                'category'     => 'Running',
                'sizes'        => ['39', '40', '41', '42'],
                'colors'       => ['Metropolis Jasper Green', 'Aizuri Blue', 'Oyster Grey'],
                'color_images' => [
                    'Metropolis Jasper Green' => 'shoes/shoe_6a0faa327d4152.79659274.webp',
                    'Aizuri Blue' => 'shoes/shoe_6a0faa327dfea3.71245427.webp',
                    'Oyster Grey' => 'shoes/shoe_6a0faa327eb9f7.65099083.webp',
                ],
                'material'     => 'Mesh/Synthetic',
                'stock'        => 16,
                'description'  => 'ASICS Gel-Kayano 14 mengekspresikan estetika retro lari tahun 2000-an dengan teknologi bantalan GEL yang legendaris, memberikan kenyamanan luar biasa sepanjang hari.',
                'image'        => 'shoes/shoe_6a0faa327d4152.79659274.webp'
            ],
            [
                'name'         => 'Vans SK 8 HI',
                'price'        => 1200000,
                'category'     => 'Lifestyle',
                'sizes'        => ['38', '39', '40', '41', '42'],
                'colors'       => ['Midnight Shift Black Skull', 'Bolt - Big Reveal', 'Glow', 'Metallica x \'Kill \'Em All\''],
                'color_images' => [
                    'Midnight Shift Black Skull' => 'shoes/shoe_6a0fa12b2b2826.38171245.webp',
                    'Bolt - Big Reveal' => 'shoes/shoe_6a0fa12b2bbb20.42037903.webp',
                    'Glow' => 'shoes/shoe_6a0f9fe9a577c7.74520097.webp',
                    'Metallica x \'Kill \'Em All\'' => 'shoes/shoe_6a0fa053579161.78905570.webp',
                ],
                'material'     => 'Canvas & Suede',
                'stock'        => 20,
                'description'  => 'Vans Sk8-Hi adalah sepatu skate legendaris bermodel high-top bertali yang ikonik. Menampilkan upper kanvas dan suede yang tangguh, kerah empuk, dan sol luar waffle karet khas Vans.',
                'image'        => 'shoes/shoe_6a0fa12b2b2826.38171245.webp'
            ],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
