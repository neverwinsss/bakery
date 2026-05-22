<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::with('products')->get();
            $featured   = Product::where('is_available', 1)->inRandomOrder()->take(6)->get();
            $posts      = Post::latest()->take(3)->get();
        } catch (\Exception $e) {
            // Database not ready yet
            $categories = collect([]);
            $featured   = collect([]);
            $posts      = collect([]);
        }

        return view('home', compact('categories', 'featured', 'posts'));
    }
}
