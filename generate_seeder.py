import json

products = [
    # RUNNING
    {
        "name": "Nike Air Zoom Pegasus 40", 
        "price": 1950000, 
        "category": "Running", 
        "sizes": ["39", "40", "41", "42", "43"], 
        "material": "Engineered Mesh", 
        "stock": 25,
        "description": "Sepatu lari ikonik dengan bantalan Zoom Air ganda yang responsif untuk kenyamanan maksimal dalam lari harian Anda.",
        "image": "https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80",
        "colors": ["Red", "Blue", "Volt Green", "Grayscale"],
        "color_images": {
            "Red": "hue-rotate(0deg)", 
            "Blue": "hue-rotate(220deg)", 
            "Volt Green": "hue-rotate(60deg) saturate(150%)", 
            "Grayscale": "grayscale(100%)"
        }
    },
    {
        "name": "Adidas Ultraboost Light", 
        "price": 3300000, 
        "category": "Running", 
        "sizes": ["40", "41", "42", "43"], 
        "material": "Primeknit", 
        "stock": 15,
        "description": "Ultraboost teringan dengan material Primeknit+ adaptif dan pengembalian energi maksimal dari teknologi Boost Light.",
        "image": "https://images.unsplash.com/photo-1587563871167-1ee9c731aefb?w=800&q=80",
        "colors": ["White/Grey", "Ocean Blue", "Triple Black", "Solar Red"],
        "color_images": {
            "White/Grey": "hue-rotate(0deg)", 
            "Ocean Blue": "sepia(100%) saturate(500%) hue-rotate(180deg) brightness(80%)", 
            "Triple Black": "brightness(30%) grayscale(100%)", 
            "Solar Red": "sepia(100%) saturate(600%) hue-rotate(330deg) brightness(90%)"
        }
    },
    {
        "name": "New Balance Fresh Foam X", 
        "price": 2799000, 
        "category": "Running", 
        "sizes": ["38", "39", "40", "41", "42"], 
        "material": "Hypoknit", 
        "stock": 20,
        "description": "Sepatu lari premium dengan sol Fresh Foam X yang tebal dan empuk, memberikan transisi tumit-ke-jari yang sangat halus.",
        "image": "https://images.unsplash.com/photo-1511556532299-8f662fc26c06?w=800&q=80",
        "colors": ["Cream/Grey", "Forest Green", "Burgundy", "Charcoal"],
        "color_images": {
            "Cream/Grey": "hue-rotate(0deg)", 
            "Forest Green": "sepia(100%) saturate(400%) hue-rotate(75deg) brightness(75%)", 
            "Burgundy": "sepia(100%) saturate(500%) hue-rotate(320deg) brightness(65%)", 
            "Charcoal": "grayscale(100%) brightness(50%)"
        }
    },
    {
        "name": "Asics Gel-Kayano 30", 
        "price": 2599000, 
        "category": "Running", 
        "sizes": ["40", "41", "42", "43", "44"], 
        "material": "Engineered Stretch Mesh", 
        "stock": 18,
        "description": "Pelindung lari jarak jauh dengan kestabilan tingkat tinggi berkat 4D Guidance System dan bantalan PureGEL yang legendaris.",
        "image": "https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=800&q=80",
        "colors": ["Neon Multi", "Cool Blue", "Electric Purple", "Sunset Gold"],
        "color_images": {
            "Neon Multi": "hue-rotate(0deg)", 
            "Cool Blue": "hue-rotate(180deg)", 
            "Electric Purple": "hue-rotate(270deg)", 
            "Sunset Gold": "hue-rotate(45deg) saturate(150%)"
        }
    },
    {
        "name": "Puma Velocity Nitro 2", 
        "price": 1799000, 
        "category": "Running", 
        "sizes": ["39", "40", "41", "42"], 
        "material": "Engineered Mesh", 
        "stock": 30,
        "description": "Sepatu lari harian serbaguna yang ringan dan responsif, dibekali busa NITRO Foam dan outsole PUMAGRIP berdaya cengkeram kuat.",
        "image": "https://images.unsplash.com/photo-1552346154-21d32810aba3?w=800&q=80",
        "colors": ["Lime Green", "Hot Pink", "Stealth Black", "Electric Blue"],
        "color_images": {
            "Lime Green": "hue-rotate(0deg)", 
            "Hot Pink": "hue-rotate(180deg) saturate(180%)", 
            "Stealth Black": "grayscale(100%) brightness(40%)", 
            "Electric Blue": "hue-rotate(240deg) saturate(150%)"
        }
    },

    # LIFESTYLE
    {
        "name": "Nike Air Force 1 '07", 
        "price": 1549000, 
        "category": "Lifestyle", 
        "sizes": ["38", "39", "40", "41", "42"], 
        "material": "Premium Leather", 
        "stock": 50,
        "description": "Koleksi streetwear paling legendaris dengan siluet kulit klasik, sistem sirkulasi udara berlubang, dan bantalan Nike Air yang ikonik.",
        "image": "https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?w=800&q=80",
        "colors": ["White", "Vintage Sail", "Midnight Black", "Soft Pink"],
        "color_images": {
            "White": "hue-rotate(0deg)", 
            "Vintage Sail": "sepia(30%) brightness(95%)", 
            "Midnight Black": "invert(90%) hue-rotate(180deg) brightness(40%)", 
            "Soft Pink": "hue-rotate(330deg) saturate(120%) brightness(95%)"
        }
    },
    {
        "name": "Adidas Samba OG", 
        "price": 2200000, 
        "category": "Lifestyle", 
        "sizes": ["38", "39", "40", "41", "42", "43"], 
        "material": "Full Grain Leather & Suede T-Toe", 
        "stock": 10,
        "description": "Klasik abadi bertekstur kulit lembut dengan detail T-toe suede retro dan sol karet tipis (gum sole) yang ikonik.",
        "image": "https://images.unsplash.com/photo-1605348532760-6753d2c43329?w=800&q=80",
        "colors": ["Black/White", "Inverted White", "Vintage Brown", "Forest Green"],
        "color_images": {
            "Black/White": "hue-rotate(0deg)", 
            "Inverted White": "invert(90%) brightness(100%) contrast(105%)", 
            "Vintage Brown": "sepia(70%) saturate(120%) brightness(85%)", 
            "Forest Green": "hue-rotate(100deg) brightness(80%)"
        }
    },
    {
        "name": "New Balance 550", 
        "price": 2199000, 
        "category": "Lifestyle", 
        "sizes": ["39", "40", "41", "42", "43"], 
        "material": "Leather & Suede Panel", 
        "stock": 12,
        "description": "Menghidupkan kembali siluet basket retro tahun 1989 dengan panel kulit berlapis premium dan detail logo '550' di bagian samping.",
        "image": "https://images.unsplash.com/photo-1549298916-b41d501d3772?w=800&q=80",
        "colors": ["White/Off-White", "Varsity Green", "Varsity Red", "Shadow Grey"],
        "color_images": {
            "White/Off-White": "hue-rotate(0deg)", 
            "Varsity Green": "hue-rotate(110deg) saturate(130%) brightness(90%)", 
            "Varsity Red": "hue-rotate(350deg) saturate(150%)", 
            "Shadow Grey": "grayscale(100%) contrast(110%)"
        }
    },
    {
        "name": "Nike Dunk Low Retro", 
        "price": 1900000, 
        "category": "Lifestyle", 
        "sizes": ["38", "39", "40", "41", "42"], 
        "material": "Smooth Leather", 
        "stock": 8,
        "description": "Ikon basket universitas tahun 80-an yang kembali merajai tren jalanan dengan desain color block tebal dan sol karet grip tinggi.",
        "image": "https://images.unsplash.com/photo-1584735174965-48c48d7028a9?w=800&q=80",
        "colors": ["Classic Red/Black", "Cobalt Blue", "Pine Green", "Stealth Grey"],
        "color_images": {
            "Classic Red/Black": "hue-rotate(0deg)", 
            "Cobalt Blue": "hue-rotate(210deg)", 
            "Pine Green": "hue-rotate(120deg) brightness(85%)", 
            "Stealth Grey": "grayscale(100%)"
        }
    },
    {
        "name": "Vans Old Skool", 
        "price": 999000, 
        "category": "Lifestyle", 
        "sizes": ["38", "39", "40", "41", "42", "43"], 
        "material": "Suede & Heavyweight Canvas", 
        "stock": 40,
        "description": "Sepatu skate pertama yang menampilkan garis samping (sidestripe) legendaris, dilengkapi kerah empuk dan sol waffle karet khas Vans.",
        "image": "https://images.unsplash.com/photo-1525966222134-fcfa99b8ae77?w=800&q=80",
        "colors": ["Cyber Yellow", "Navy Blue", "True White", "Classic Black"],
        "color_images": {
            "Cyber Yellow": "hue-rotate(0deg)", 
            "Navy Blue": "hue-rotate(180deg) brightness(80%)", 
            "True White": "brightness(150%) grayscale(100%)", 
            "Classic Black": "grayscale(100%) brightness(35%)"
        }
    },

    # BASKET
    {
        "name": "Air Jordan 1 Retro High", 
        "price": 2849000, 
        "category": "Basket", 
        "sizes": ["40", "41", "42", "43", "44"], 
        "material": "Full-Grain Premium Leather", 
        "stock": 5,
        "description": "Mahakarya Michael Jordan dari tahun 1985 yang legendaris, menampilkan logo Air Jordan Wings dan perpaduan kulit premium berkualitas tinggi.",
        "image": "https://images.unsplash.com/photo-1579338559194-a162d19bf842?w=800&q=80",
        "colors": ["Royal Blue", "Bred (Red/Black)", "Court Purple", "Shadow Gray"],
        "color_images": {
            "Royal Blue": "hue-rotate(0deg)", 
            "Bred (Red/Black)": "hue-rotate(150deg) saturate(140%)", 
            "Court Purple": "hue-rotate(80deg)", 
            "Shadow Gray": "grayscale(100%)"
        }
    },
    {
        "name": "Nike LeBron XX", 
        "price": 3199000, 
        "category": "Basket", 
        "sizes": ["41", "42", "43", "44", "45"], 
        "material": "Dimensional Knit", 
        "stock": 12,
        "description": "Dibuat khusus untuk Sang Raja LeBron James, dibekali unit Zoom Air ultra-responsif dan rajutan rajutan bernapas ultra-ringan.",
        "image": "images/shoes/nike_lebron_xx.png",
        "colors": ["Sunset Orange", "Grape Purple", "Miami Teal", "Blackout"],
        "color_images": {
            "Sunset Orange": "hue-rotate(0deg)", 
            "Grape Purple": "hue-rotate(270deg)", 
            "Miami Teal": "hue-rotate(160deg) saturate(120%)", 
            "Blackout": "grayscale(100%) brightness(40%)"
        }
    },
    {
        "name": "Under Armour Curry 11", 
        "price": 2799000, 
        "category": "Basket", 
        "sizes": ["40", "41", "42", "43", "44"], 
        "material": "UA Warp Upper & Dual-Density UA Flow", 
        "stock": 15,
        "description": "Sepatu signature dari Stephen Curry dengan traksi UA Flow luar biasa tanpa sol karet berat, memberikan cengkeraman maksimal di lapangan.",
        "image": "images/shoes/under_armour_curry_11.png",
        "colors": ["Stealth Black", "Aurora Gold", "Cyber Blue", "Pure White"],
        "color_images": {
            "Stealth Black": "hue-rotate(0deg)", 
            "Aurora Gold": "sepia(100%) saturate(800%) hue-rotate(15deg) brightness(120%)", 
            "Cyber Blue": "sepia(100%) saturate(800%) hue-rotate(180deg) brightness(110%)", 
            "Pure White": "invert(90%) grayscale(100%) brightness(130%)"
        }
    },
    {
        "name": "Adidas Trae Young 3", 
        "price": 2400000, 
        "category": "Basket", 
        "sizes": ["41", "42", "43", "44"], 
        "material": "Adaptive Textile", 
        "stock": 10,
        "description": "Dirancang untuk gaya bermain eksplosif Trae Young, memadukan sistem kestabilan midfoot dengan bantalan sol busa asimetris.",
        "image": "https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=800&q=80",
        "colors": ["Multicolor", "Hyper Blue", "Solar Pink", "Core Black"],
        "color_images": {
            "Multicolor": "hue-rotate(0deg)", 
            "Hyper Blue": "hue-rotate(200deg)", 
            "Solar Pink": "hue-rotate(300deg) saturate(150%)", 
            "Core Black": "grayscale(100%) brightness(50%)"
        }
    },
    {
        "name": "Nike KD16", 
        "price": 2699000, 
        "category": "Basket", 
        "sizes": ["41", "42", "43", "44", "45"], 
        "material": "Multi-Layer Light Mesh", 
        "stock": 14,
        "description": "Sepatu andalan Kevin Durant dengan unit Air Zoom tebal dan pelindung tumit kokoh, ideal untuk pergerakan lateral cepat.",
        "image": "https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?w=800&q=80",
        "colors": ["Ice White", "Hot Crimson", "Deep Cobalt", "Triple Black"],
        "color_images": {
            "Ice White": "hue-rotate(0deg)", 
            "Hot Crimson": "hue-rotate(330deg) saturate(180%)", 
            "Deep Cobalt": "hue-rotate(220deg) brightness(85%)", 
            "Triple Black": "grayscale(100%) brightness(30%)"
        }
    },

    # TRAINING
    {
        "name": "Nike Metcon 9", 
        "price": 2099000, 
        "category": "Training", 
        "sizes": ["40", "41", "42", "43", "44"], 
        "material": "Abrasion-Resistant Mesh with Haptic Overlay", 
        "stock": 22,
        "description": "Dirancang untuk stabilitas luar biasa saat latihan beban berat, CrossFit, dan latihan intensitas tinggi (HIIT).",
        "image": "https://images.unsplash.com/photo-1491553895911-0055eca6402d?w=800&q=80",
        "colors": ["Obsidian Black", "Volt Green", "Racer Blue", "Crimson Red"],
        "color_images": {
            "Obsidian Black": "hue-rotate(0deg)", 
            "Volt Green": "hue-rotate(85deg) saturate(200%) brightness(110%)", 
            "Racer Blue": "hue-rotate(210deg) saturate(150%)", 
            "Crimson Red": "hue-rotate(345deg) saturate(180%)"
        }
    },
    {
        "name": "Reebok Nano X3", 
        "price": 2199000, 
        "category": "Training", 
        "sizes": ["39", "40", "41", "42", "43"], 
        "material": "Flexweave Knit", 
        "stock": 18,
        "description": "Menampilkan teknologi Lift and Run Chassis yang inovatif, memberikan kestabilan tumit saat angkat beban dan kelenturan saat berlari.",
        "image": "images/shoes/reebok_nano_x3.png",
        "colors": ["Chalk White", "Army Green", "Navy Blue", "Stealth Gray"],
        "color_images": {
            "Chalk White": "hue-rotate(0deg)", 
            "Army Green": "sepia(100%) saturate(300%) hue-rotate(70deg) brightness(60%)", 
            "Navy Blue": "sepia(100%) saturate(500%) hue-rotate(180deg) brightness(70%)", 
            "Stealth Gray": "grayscale(100%) brightness(50%)"
        }
    },
    {
        "name": "Adidas Dropset 2", 
        "price": 1900000, 
        "category": "Training", 
        "sizes": ["40", "41", "42", "43", "44"], 
        "material": "Recycled Canvas & Mesh", 
        "stock": 20,
        "description": "Sepatu latihan angkat beban dengan sol datar kokoh (dual-density midsole) untuk traksi maksimal dan perpindahan energi langsung.",
        "image": "images/shoes/adidas_dropset_2.png",
        "colors": ["Ash Grey", "Solar Orange", "Signal Green", "Core Black"],
        "color_images": {
            "Ash Grey": "hue-rotate(0deg)", 
            "Solar Orange": "sepia(100%) saturate(800%) hue-rotate(340deg) brightness(95%)", 
            "Signal Green": "sepia(100%) saturate(600%) hue-rotate(60deg) brightness(100%)", 
            "Core Black": "grayscale(100%) brightness(30%)"
        }
    },
    {
        "name": "Under Armour Project Rock 6", 
        "price": 2599000, 
        "category": "Training", 
        "sizes": ["41", "42", "43", "44"], 
        "material": "UA Clone Upper & UA TriBase Soles", 
        "stock": 12,
        "description": "Signature training dari Dwayne 'The Rock' Johnson, dirancang tangguh dengan upper UA Clone yang dapat menyesuaikan lekukan kaki.",
        "image": "images/shoes/under_armour_project_rock_6.png",
        "colors": ["Iron Gray", "Blood Orange", "Abyss Blue", "Blackout"],
        "color_images": {
            "Iron Gray": "hue-rotate(0deg)", 
            "Blood Orange": "sepia(100%) saturate(800%) hue-rotate(340deg) brightness(90%)", 
            "Abyss Blue": "sepia(100%) saturate(800%) hue-rotate(190deg) brightness(70%)", 
            "Blackout": "grayscale(100%) brightness(30%)"
        }
    },
    {
        "name": "Nike Free Metcon 5", 
        "price": 1899000, 
        "category": "Training", 
        "sizes": ["38", "39", "40", "41", "42"], 
        "material": "Dynamic Fit Flywire Mesh", 
        "stock": 25,
        "description": "Memadukan kelenturan sol depan Nike Free untuk kelincahan gerakan dengan tumit datar Metcon yang kokoh dan stabil untuk angkat beban.",
        "image": "https://images.unsplash.com/photo-1562183241-b937e95585b6?w=800&q=80",
        "colors": ["Hyper Crimson", "Electric Lime", "Deep Purple", "Stealth Grey"],
        "color_images": {
            "Hyper Crimson": "hue-rotate(0deg)", 
            "Electric Lime": "hue-rotate(75deg) saturate(150%)", 
            "Deep Purple": "hue-rotate(250deg)", 
            "Stealth Grey": "grayscale(100%) brightness(70%)"
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

for p in products:
    seeder_content += f"""
            [
                'name'         => '{escape_php_str(p['name'])}',
                'price'        => {p['price']},
                'category'     => '{escape_php_str(p['category'])}',
                'sizes'        => {to_php_array(p['sizes'])},
                'colors'       => {to_php_array(p['colors'])},
                'color_images' => {to_php_array(p['color_images'])},
                'material'     => '{escape_php_str(p['material'])}',
                'stock'        => {p['stock']},
                'description'  => '{escape_php_str(p['description'])}',
                'image'        => '{escape_php_str(p['image'])}'
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
