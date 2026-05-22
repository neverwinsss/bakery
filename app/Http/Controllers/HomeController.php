<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        $featured   = Product::where('is_available', 1)->inRandomOrder()->take(6)->get();
        $posts      = Post::latest()->take(3)->get();

        return view('home', compact('categories', 'featured', 'posts'));
    }
}
