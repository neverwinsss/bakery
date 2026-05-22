<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query      = Product::with('category')->where('is_available', 1);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('type')) {
            $query->whereHas('category', fn ($q) => $q->where('name', 'like', '%' . $request->type . '%'));
        }

        if ($request->filled('price_from')) {
            $query->where('price', '>=', (float) $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', (float) $request->price_to);
        }

        if ($request->freshness === 'new') {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $reviews = $product->reviews()->with('user')->latest()->get();

        return view('products.show', compact('product', 'reviews'));
    }
}
