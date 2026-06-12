<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = ['Running', 'Lifestyle', 'Basket', 'Training'];
        $activeCategory = $request->get('category', 'all');

        $query = Product::query();

        if ($activeCategory && $activeCategory !== 'all') {
            $query->where('category', $activeCategory);
        }

        $products = $query->latest()->get();

        return view('shop.index', compact('products', 'categories', 'activeCategory'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Related products same category
        $related = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'related'));
    }
}
