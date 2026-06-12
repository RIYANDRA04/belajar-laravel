<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'image', 'description',
        'category', 'sizes', 'colors', 'color_images', 'material', 'stock',
    ];

    protected $casts = [
        'sizes'  => 'array',
        'colors' => 'array',
        'color_images' => 'array',
        'price'  => 'decimal:0',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            if (str_starts_with($this->image, 'http')) {
                return $this->image;
            }
            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
            if (\Storage::disk('public')->exists($this->image)) {
                return asset('storage/' . $this->image);
            }
        }
        // Fallback placeholder by category
        $placeholders = [
            'Running'   => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80',
            'Lifestyle' => 'https://images.unsplash.com/photo-1600185365926-3a2ce3cdb9eb?w=600&q=80',
            'Basket'    => 'https://images.unsplash.com/photo-1579338559194-a162d19bf842?w=800&q=80',
            'Training'  => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=800&q=80',
        ];
        return $placeholders[$this->category] ?? 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=80';
    }

    public function getColorImagesJsonAttribute(): string
    {
        return json_encode($this->color_images);
    }
}
