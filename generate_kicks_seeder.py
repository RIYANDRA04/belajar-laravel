import json
import urllib.parse

kicks_data = [
  {
    "category": "Lifestyle",
    "name": "YZY YS-01 Black",
    "colors": ["Black", "Grey", "Blue"],
    "image_url": "https://images.stockx.com/images/YZY-YS-01-Black-Product.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1762290968",
    "price": 2500000,
    "material": "Primeknit",
    "description": "Minimalist slip-on design from YZY.",
    "color_images": {
        "Black": "hue-rotate(0deg)",
        "Grey": "brightness(150%) grayscale(100%)",
        "Blue": "hue-rotate(200deg) saturate(150%)"
    }
  },
  {
    "category": "Lifestyle",
    "name": "Jordan 4 Retro Nigel Sylvester",
    "colors": ["Sail", "Cinnabar", "Metallic Gold"],
    "image_url": "https://images.stockx.com/images/Air-Jordan-4-Retro-OG-Nigel-Sylvester-Sail-Cinnabar-Product.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1777572762",
    "price": 3100000,
    "material": "Leather",
    "description": "Exclusive collaboration with Nigel Sylvester.",
    "color_images": {
        "Sail": "hue-rotate(0deg)",
        "Cinnabar": "sepia(50%) hue-rotate(330deg) saturate(200%)",
        "Metallic Gold": "sepia(100%) saturate(300%) hue-rotate(35deg)"
    }
  },
  {
    "category": "Basket",
    "name": "Jordan 3 Retro Brazil",
    "colors": ["Brazil Blue", "Yellow", "Green"],
    "image_url": "https://images.stockx.com/images/air-jordan-3-retro-brazil.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1777668757",
    "price": 2900000,
    "material": "Leather",
    "description": "Inspired by the Brazilian flag colors.",
    "color_images": {
        "Brazil Blue": "hue-rotate(0deg)",
        "Yellow": "hue-rotate(45deg) saturate(200%)",
        "Green": "hue-rotate(120deg) saturate(150%)"
    }
  },
  {
    "category": "Lifestyle",
    "name": "Converse SHAI 001 Premium Ink",
    "colors": ["Ink Black", "Midnight Blue"],
    "image_url": "https://images.stockx.com/images/Converse-SHAI-001-Premium-Ink.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1776693888",
    "price": 1400000,
    "material": "Premium Canvas",
    "description": "Sleek and modern take on the classic Converse.",
    "color_images": {
        "Ink Black": "hue-rotate(0deg)",
        "Midnight Blue": "hue-rotate(200deg) saturate(120%) brightness(80%)"
    }
  },
  {
    "category": "Lifestyle",
    "name": "adidas Bad Bunny Flamboyan",
    "colors": ["Flamboyan Pink", "Core Red"],
    "image_url": "https://images.stockx.com/images/adidas-Ballerina-Bad-Bunny-Flamboyan-Product.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1777572525",
    "price": 2300000,
    "material": "Suede",
    "description": "Bad Bunny collaboration in striking pink.",
    "color_images": {
        "Flamboyan Pink": "hue-rotate(0deg)",
        "Core Red": "hue-rotate(330deg) saturate(150%)"
    }
  },
  {
    "category": "Lifestyle",
    "name": "Jordan 1 Low Travis Scott Tropical Pink",
    "colors": ["Tropical Pink", "Shy Pink"],
    "image_url": "https://images.stockx.com/images/air-jordan-1-retro-low-og-sp-travis-scott-sail-tropical-pink.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1779123671",
    "price": 3500000,
    "material": "Nubuck Leather",
    "description": "Travis Scott iconic inverted swoosh.",
    "color_images": {
        "Tropical Pink": "hue-rotate(0deg)",
        "Shy Pink": "hue-rotate(330deg) brightness(120%) saturate(60%)"
    }
  },
  {
    "category": "Basket",
    "name": "Jordan 4 Retro Toro Bravo (2026)",
    "colors": ["Toro Red", "Stealth Black"],
    "image_url": "https://images.stockx.com/images/Air-Jordan-4-Retro-Toro-Bravo-2026-Product.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1775837171",
    "price": 3200000,
    "material": "Nubuck",
    "description": "The return of the legendary Toro Bravo.",
    "color_images": {
        "Toro Red": "hue-rotate(0deg)",
        "Stealth Black": "grayscale(100%) brightness(50%)"
    }
  },
  {
    "category": "Basket",
    "name": "Nike Air Foamposite Pro Red October",
    "colors": ["Red October", "Volt Green"],
    "image_url": "https://images.stockx.com/images/Nike-Air-Foamposite-Pro-Red-October-2026.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1776312696",
    "price": 3000000,
    "material": "Foamposite",
    "description": "Futuristic basketball shoe in striking red.",
    "color_images": {
        "Red October": "hue-rotate(0deg)",
        "Volt Green": "hue-rotate(90deg) saturate(200%)"
    }
  },
  {
    "category": "Lifestyle",
    "name": "Jordan 3 Retro World's Best Dad",
    "colors": ["White", "Blue", "Red"],
    "image_url": "https://images.stockx.com/images/air-jordan-3-retro-worlds-best-dad-gs.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1777812433",
    "price": 2800000,
    "material": "Tumbled Leather",
    "description": "A tribute to all the great fathers.",
    "color_images": {
        "White": "hue-rotate(0deg)",
        "Blue": "hue-rotate(200deg)",
        "Red": "hue-rotate(330deg)"
    }
  },
  {
    "category": "Lifestyle",
    "name": "Nike SB Dunk Low Bluetile Skateboards",
    "colors": ["Bluetile", "Blackout"],
    "image_url": "https://images.stockx.com/images/Nike-SB-Dunk-Low-Pro-Bluetile-Skateboards-Product.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1778510144",
    "price": 2400000,
    "material": "Suede",
    "description": "Premium skate shoe collaboration.",
    "color_images": {
        "Bluetile": "hue-rotate(0deg)",
        "Blackout": "grayscale(100%) brightness(60%)"
    }
  },
  {
    "category": "Running",
    "name": "Nike Air Max 90 Bright Citrus",
    "colors": ["Bright Citrus", "Neon Green"],
    "image_url": "https://images.stockx.com/images/Nike-Air-Max-90-Bright-Citrus-Hypervenom.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1773095127",
    "price": 1900000,
    "material": "Mesh/Synthetic",
    "description": "Classic Air Max 90 with a bright twist.",
    "color_images": {
        "Bright Citrus": "hue-rotate(0deg)",
        "Neon Green": "hue-rotate(50deg) saturate(150%)"
    }
  },
  {
    "category": "Lifestyle",
    "name": "adidas Taekwondo Mei Ballet",
    "colors": ["Cream White", "Dusty Pink"],
    "image_url": "https://images.stockx.com/images/adidas-Taekwondo-Mei-Ballet-Basketweave-Cream-White-Womens.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1772758130",
    "price": 1500000,
    "material": "Basketweave",
    "description": "Elegant ballet-inspired design.",
    "color_images": {
        "Cream White": "hue-rotate(0deg)",
        "Dusty Pink": "sepia(50%) hue-rotate(320deg) brightness(110%)"
    }
  },
  {
    "category": "Running",
    "name": "Nike Air Max 1000.2 Black",
    "colors": ["Stealth Black", "Cool Grey"],
    "image_url": "https://images.stockx.com/images/Nike-Air-Max-10002-Black.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1777581014",
    "price": 2100000,
    "material": "Engineered Mesh",
    "description": "Next generation Air Max comfort.",
    "color_images": {
        "Stealth Black": "hue-rotate(0deg)",
        "Cool Grey": "brightness(150%) grayscale(100%)"
    }
  },
  {
    "category": "Basket",
    "name": "Nike Foamposite Pro Voltage Yellow",
    "colors": ["Voltage Yellow", "Neon Blue"],
    "image_url": "https://images.stockx.com/images/Nike-Air-Foamposite-Pro-Voltage-2026-Product.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1778769033",
    "price": 2900000,
    "material": "Foamposite",
    "description": "Electrifying yellow colorway.",
    "color_images": {
        "Voltage Yellow": "hue-rotate(0deg)",
        "Neon Blue": "hue-rotate(180deg) saturate(150%)"
    }
  },
  {
    "category": "Lifestyle",
    "name": "Mihara Yasuhiro Hank OG Sole",
    "colors": ["Canvas Black", "Canvas White"],
    "image_url": "https://images.stockx.com/images/Mihara-Yasuhiro-Hank-OG-Sole-Canvas-Low-Black-Product.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1738193358",
    "price": 3800000,
    "material": "Canvas",
    "description": "Iconic melted sole design.",
    "color_images": {
        "Canvas Black": "hue-rotate(0deg)",
        "Canvas White": "invert(90%) brightness(120%) contrast(110%)"
    }
  },
  {
    "category": "Training",
    "name": "Nike ST Charge EP Iron Grey",
    "colors": ["Iron Grey", "Crimson"],
    "image_url": "https://images.stockx.com/images/Nike-ST-Charge-EP-Iron-Grey.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1777063811",
    "price": 1800000,
    "material": "Synthetic",
    "description": "Durable training shoe.",
    "color_images": {
        "Iron Grey": "hue-rotate(0deg)",
        "Crimson": "sepia(50%) hue-rotate(330deg) saturate(200%)"
    }
  },
  {
    "category": "Training",
    "name": "adidas Dropset Elite Metallic Pink",
    "colors": ["Shock Pink", "Electric Blue"],
    "image_url": "https://images.stockx.com/images/adidas-Dropset-Elite-Black-Iron-Metallic-Shock-Pink.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1773783623",
    "price": 2000000,
    "material": "Mesh",
    "description": "Elite weightlifting stability.",
    "color_images": {
        "Shock Pink": "hue-rotate(0deg)",
        "Electric Blue": "hue-rotate(180deg) saturate(150%)"
    }
  },
  {
    "category": "Running",
    "name": "Nike Air Max 95 OG Big Bubble",
    "colors": ["Comet Red", "Neon Green"],
    "image_url": "https://images.stockx.com/images/nike-air-max-95-og-big-bubble-comet-red.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1776290993",
    "price": 2600000,
    "material": "Suede/Mesh",
    "description": "Classic 95 with larger air units.",
    "color_images": {
        "Comet Red": "hue-rotate(0deg)",
        "Neon Green": "hue-rotate(90deg) saturate(150%)"
    }
  },
  {
    "category": "Lifestyle",
    "name": "Jordan 1 Retro Low OG SP Shy Pink",
    "colors": ["Shy Pink", "Cool Blue"],
    "image_url": "https://images.stockx.com/images/air-jordan-1-retro-low-og-sp-travis-scott-shy-pink.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1779123654",
    "price": 3500000,
    "material": "Nubuck Leather",
    "description": "Travis Scott iteration in beautiful shy pink.",
    "color_images": {
        "Shy Pink": "hue-rotate(0deg)",
        "Cool Blue": "hue-rotate(200deg) saturate(120%)"
    }
  },
  {
    "category": "Basket",
    "name": "Jordan 4 Retro Toro Bravo GS",
    "colors": ["Toro Red", "Blue Metallic"],
    "image_url": "https://images.stockx.com/images/air-jordan-4-retro-toro-bravo-2026-gs.jpg?fit=fill&bg=FFFFFF&w=700&h=500&fm=webp&auto=compress&q=90&dpr=2&trim=color&updated_at=1776894819",
    "price": 2200000,
    "material": "Nubuck",
    "description": "Youth sizing of the iconic Toro Bravo.",
    "color_images": {
        "Toro Red": "hue-rotate(0deg)",
        "Blue Metallic": "hue-rotate(220deg) saturate(150%)"
    }
  }
]

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

for p in kicks_data:
    seeder_content += f"""
            [
                'name'         => '{escape_php_str(p['name'])}',
                'price'        => {p['price']},
                'category'     => '{escape_php_str(p['category'])}',
                'sizes'        => ['39', '40', '41', '42'],
                'colors'       => {to_php_array(p['colors'])},
                'color_images' => {to_php_array(p['color_images'])},
                'material'     => '{escape_php_str(p['material'])}',
                'stock'        => 20,
                'description'  => '{escape_php_str(p['description'])}',
                'image'        => '{escape_php_str(p['image_url'])}'
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
print("ProductSeeder.php generated with KicksDB data and CSS Filters!")
