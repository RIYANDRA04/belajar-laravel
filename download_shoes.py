import os
import urllib.request
import json

shoes = [
    {
        "name": "Nike Pegasus 40", "price": 1950000, "category": "Running", "sizes": ["39", "40", "41", "42", "43", "44"], "material": "Engineered Mesh", "stock": 25,
        "description": "Sepatu lari yang responsif dengan bantalan empuk untuk kenyamanan ekstra.",
        "colors": {
            "Black/White": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/13f064f2-95f7-4184-a827-010df0498ebc/pegasus-40-mens-road-running-shoes-MCWTLc.png",
            "White": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/88b776a3-2287-4fc9-808f-287964dfb3a4/pegasus-40-mens-road-running-shoes-MCWTLc.png"
        }
    },
    {
        "name": "Adidas Ultraboost Light", "price": 3300000, "category": "Running", "sizes": ["40", "41", "42", "43"], "material": "Primeknit", "stock": 15,
        "description": "Ultraboost teringan yang pernah ada, memberikan pengembalian energi maksimal.",
        "colors": {
            "Black": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/20b57ea920c84132b4bbaef800dd3a7a_9366/Ultraboost_Light_Running_Shoes_Black_HQ6339_01_standard.jpg",
            "White": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/c6c39bb7e6874ebf88e1aef800dd4afb_9366/Ultraboost_Light_Running_Shoes_White_HQ6341_01_standard.jpg"
        }
    },
    {
        "name": "Nike Vaporfly 3", "price": 3990000, "category": "Running", "sizes": ["40", "41", "42", "43", "44"], "material": "Flyknit", "stock": 10,
        "description": "Sepatu lari maraton untuk memecahkan rekor pribadi Anda.",
        "colors": {
            "Pink": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/3bc9f71c-7704-4537-a169-6d60bc56cf1a/vaporfly-3-mens-road-racing-shoes-8ZHdxM.png",
            "White": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/1ec7d1ec-78c6-43b6-ae90-c24da57c8bf7/vaporfly-3-mens-road-racing-shoes-8ZHdxM.png"
        }
    },
    {
        "name": "Adidas Adizero Boston 12", "price": 2500000, "category": "Running", "sizes": ["39", "40", "41", "42"], "material": "Mesh", "stock": 20,
        "description": "Sepatu latihan dan balap yang cepat dan ringan.",
        "colors": {
            "Black": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/df3082aefad94fdfb0d46695b2907409_9366/Adizero_Boston_12_Shoes_Black_ID5861_01_standard.jpg",
            "White": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/fde9895c2560411bbf1917fcf18f2d62_9366/Adizero_Boston_12_Shoes_White_ID5860_01_standard.jpg"
        }
    },
    {
        "name": "Puma Velocity Nitro 2", "price": 1799000, "category": "Running", "sizes": ["40", "41", "42", "43"], "material": "Engineered Mesh", "stock": 30,
        "description": "Sepatu serbaguna yang ringan dan responsif.",
        "colors": {
            "Black": "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/376262/01/sv01/fnd/IDN/fmt/png/Velocity-NITRO%E2%84%A2-2-Men's-Running-Shoes",
            "Orange": "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/376262/06/sv01/fnd/IDN/fmt/png/Velocity-NITRO%E2%84%A2-2-Men's-Running-Shoes"
        }
    },

    {
        "name": "Nike Air Force 1 '07", "price": 1549000, "category": "Lifestyle", "sizes": ["38", "39", "40", "41", "42"], "material": "Leather", "stock": 50,
        "description": "Ikon gaya jalanan klasik yang selalu relevan.",
        "colors": {
            "White": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/b7d9211c-26e7-431a-ac24-b0540fb3c00f/air-force-1-07-mens-shoes-jBrhbr.png",
            "Black": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/fc4622a4-569d-4c3c-a496-e10db7c54f5f/air-force-1-07-mens-shoes-jBrhbr.png"
        }
    },
    {
        "name": "Adidas Samba OG", "price": 2200000, "category": "Lifestyle", "sizes": ["38", "39", "40", "41", "42", "43"], "material": "Full Grain Leather", "stock": 15,
        "description": "Klasik dari lapangan indoor yang menjadi favorit street style.",
        "colors": {
            "White": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/3bbecbdf584e40398446a8bf0117cf62_9366/Samba_OG_Shoes_White_B75806_01_standard.jpg",
            "Black": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/c6488eb4f940409a807ba91801267d3e_9366/Samba_OG_Shoes_Black_B75807_01_standard.jpg"
        }
    },
    {
        "name": "Nike Dunk Low", "price": 1900000, "category": "Lifestyle", "sizes": ["39", "40", "41", "42"], "material": "Leather", "stock": 10,
        "description": "Ikon basket tahun 80-an dengan warna bold.",
        "colors": {
            "Panda (Black/White)": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/a3e7dead-1ad2-4c40-996d-93ebc9df0fca/dunk-low-retro-mens-shoe-66Dzv5.png",
            "University Blue": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/8c6ed2c5-ad92-4fdf-9730-7cb5f86641b7/dunk-low-retro-mens-shoe-66Dzv5.png"
        }
    },
    {
        "name": "Vans Old Skool", "price": 999000, "category": "Lifestyle", "sizes": ["38", "39", "40", "41", "42"], "material": "Suede/Canvas", "stock": 40,
        "description": "Sepatu skate ikonik dengan sidestripe khas Vans.",
        "colors": {
            "Black/White": "https://images.vans.com/is/image/Vans/VN000D3HY28-HERO?$583x583$",
            "Navy": "https://images.vans.com/is/image/Vans/VN000D3HNVY-HERO?$583x583$"
        }
    },
    {
        "name": "Converse Chuck 70", "price": 1299000, "category": "Lifestyle", "sizes": ["38", "39", "40", "41", "42"], "material": "Canvas", "stock": 35,
        "description": "Siluet ikonik dengan material premium.",
        "colors": {
            "Black": "https://www.converse.id/media/catalog/product/cache/e81e4f913a1cad058ef66fea8e95c839/0/2/02-CONVERSE-FFSSCONCO-CON162058C-Black.jpg",
            "Parchment": "https://www.converse.id/media/catalog/product/cache/e81e4f913a1cad058ef66fea8e95c839/0/2/02-CONVERSE-FFSSCONCO-CON162053C-Cream.jpg"
        }
    },

    {
        "name": "Nike LeBron XXI", "price": 3199000, "category": "Basket", "sizes": ["41", "42", "43", "44", "45"], "material": "Knit", "stock": 12,
        "description": "Generasi baru sepatu signature sang raja.",
        "colors": {
            "Black": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/9c08baef-0211-47fa-8041-055104d4ad9b/lebron-xxi-basketball-shoes-340Pnd.png",
            "White": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/cd57bda8-5541-47ed-af2b-c8ff2762299c/lebron-xxi-basketball-shoes-340Pnd.png"
        }
    },
    {
        "name": "Nike KD16", "price": 2699000, "category": "Basket", "sizes": ["41", "42", "43", "44"], "material": "Multi-layer mesh", "stock": 14,
        "description": "Ringan, responsif, siap mencetak skor.",
        "colors": {
            "Black": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/f2479ca4-fa6d-4cc1-9b6d-a77317d74cc6/kd16-basketball-shoes-H3gcDG.png",
            "Blue": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/b1633519-c967-4eb4-b97c-9b88e0b67ff9/kd16-basketball-shoes-H3gcDG.png"
        }
    },
    {
        "name": "Adidas Trae Young 3", "price": 2400000, "category": "Basket", "sizes": ["41", "42", "43", "44"], "material": "Textile", "stock": 10,
        "description": "Kelincahan maksimal untuk pergerakan eksplosif.",
        "colors": {
            "Black": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/295966601b3443a4914c0429fde062de_9366/Trae_Young_3_Basketball_Shoes_Black_IE9363_01_standard.jpg",
            "White": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/c77e7da2011246c49645ae4df8415c8f_9366/Trae_Young_3_Basketball_Shoes_White_IE9364_01_standard.jpg"
        }
    },
    {
        "name": "Puma MB.03", "price": 2599000, "category": "Basket", "sizes": ["40", "41", "42", "43"], "material": "Mesh", "stock": 18,
        "description": "Sepatu signature LaMelo Ball dengan desain unik.",
        "colors": {
            "Blue/Green": "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/379220/01/sv01/fnd/IDN/fmt/png/MB.03-Toxic-Men's-Basketball-Shoes",
            "Pink": "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_600,h_600/global/379233/01/sv01/fnd/IDN/fmt/png/MB.03-LaFranc%C3%A9-Men's-Basketball-Shoes"
        }
    },
    {
        "name": "Nike Ja 1", "price": 1900000, "category": "Basket", "sizes": ["40", "41", "42", "43"], "material": "Mesh", "stock": 20,
        "description": "Sepatu signature pertama Ja Morant, dirancang untuk kelincahan.",
        "colors": {
            "White/Black": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/e8179b5c-d78a-4db5-b829-0ec608d0e517/ja-1-basketball-shoes-b0b230.png",
            "Red": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/37e3d179-8d19-482a-bc91-2dc04a621e25/ja-1-basketball-shoes-b0b230.png"
        }
    },

    {
        "name": "Nike Metcon 9", "price": 2099000, "category": "Training", "sizes": ["40", "41", "42", "43", "44"], "material": "Mesh/Synthetic", "stock": 22,
        "description": "Sangat stabil untuk angkat berat dan CrossFit.",
        "colors": {
            "Black": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/7be3726a-9311-4770-bcfa-1f196ce2d3d9/metcon-9-mens-workout-shoes-28z8K2.png",
            "Grey": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/60f7dfb9-43c2-4dc9-8e7c-885ecb2ad870/metcon-9-mens-workout-shoes-28z8K2.png"
        }
    },
    {
        "name": "Adidas Dropset 2", "price": 1900000, "category": "Training", "sizes": ["40", "41", "42", "43"], "material": "Recycled material", "stock": 20,
        "description": "Dirancang untuk rasa percaya diri maksimal di gym.",
        "colors": {
            "Black": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/2ab237e1fa164741aa28cf7e852d7657_9366/Dropset_2_Training_Shoes_Black_ID5036_01_standard.jpg",
            "White": "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/01f016dcc91649d28216127bcfb92dcb_9366/Dropset_2_Training_Shoes_White_ID5037_01_standard.jpg"
        }
    },
    {
        "name": "Nike Free Metcon 5", "price": 1899000, "category": "Training", "sizes": ["39", "40", "41", "42"], "material": "Mesh", "stock": 25,
        "description": "Fleksibilitas luar biasa untuk kelincahan.",
        "colors": {
            "Black": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/b18d22c9-d224-4f81-b541-698f12cc6b3d/free-metcon-5-mens-workout-shoes-HfHGC6.png",
            "Grey": "https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/5fa179b8-1755-46f4-b2c6-f7c87c800c2f/free-metcon-5-mens-workout-shoes-HfHGC6.png"
        }
    },
    {
        "name": "Reebok Nano X3", "price": 2199000, "category": "Training", "sizes": ["40", "41", "42", "43"], "material": "Flexweave", "stock": 18,
        "description": "Sepatu serbaguna paling mumpuni.",
        "colors": {
            "Black": "https://reebok.id/media/catalog/product/5/e/5e1739cd205244dd8cbfaef5012ca57b_9366_1.jpg",
            "White": "https://reebok.id/media/catalog/product/7/0/709db1e721a3406f97f7aef5012a6479_9366_1.jpg"
        }
    },
    {
        "name": "Under Armour Project Rock 6", "price": 2599000, "category": "Training", "sizes": ["41", "42", "43", "44"], "material": "UA Clone", "stock": 12,
        "description": "Hardest worker in the room.",
        "colors": {
            "Black": "https://underarmour.scene7.com/is/image/Underarmour/3026459-001_DEFAULT?scl=1&fmt=png-alpha",
            "White": "https://underarmour.scene7.com/is/image/Underarmour/3026459-100_DEFAULT?scl=1&fmt=png-alpha"
        }
    }
]

import ssl
ssl._create_default_https_context = ssl._create_unverified_context

os.makedirs("public/images/shoes", exist_ok=True)
import string
def get_safe_filename(s):
    valid_chars = "-_.() %s%s" % (string.ascii_letters, string.digits)
    return ''.join(c for c in s if c in valid_chars).replace(' ', '_').lower()

seeder_content = """<?php
namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::truncate();
        $products = [
"""

def escape_php_str(val):
    return val.replace("'", "\\'")

def to_php_array(val):
    if isinstance(val, dict):
        items = []
        for k, v in val.items():
            items.append(f"'{escape_php_str(k)}' => {to_php_array(v)}")
        return "[" + ", ".join(items) + "]"
    elif isinstance(val, list):
        items = []
        for v in val:
            items.append(to_php_array(v))
        return "[" + ", ".join(items) + "]"
    elif isinstance(val, str):
        return f"'{escape_php_str(val)}'"
    elif isinstance(val, bool):
        return "true" if val else "false"
    elif val is None:
        return "null"
    else:
        return str(val)

for i, p in enumerate(shoes):
    colors_list = list(p['colors'].keys())
    color_images = {}
    for color, url in p['colors'].items():
        color_images[color] = url

    seeder_content += f"""
            [
                'name'         => '{escape_php_str(p['name'])}',
                'price'        => {p['price']},
                'category'     => '{escape_php_str(p['category'])}',
                'sizes'        => {to_php_array(p['sizes'])},
                'colors'       => {to_php_array(colors_list)},
                'color_images' => {to_php_array(color_images)},
                'material'     => '{escape_php_str(p['material'])}',
                'stock'        => {p['stock']},
                'description'  => '{escape_php_str(p['description'])}',
                'image'        => '{escape_php_str(list(color_images.values())[0])}' // Using first color as main image
            ],"""

seeder_content += """
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
"""

with open("database/seeders/ProductSeeder.php", "w") as f:
    f.write(seeder_content)
print("ProductSeeder.php generated.")
