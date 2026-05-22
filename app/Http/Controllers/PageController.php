<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('static.about');
    }

    public function subscribe(Request $request)
    {
        $request->validate(['email' => ['required', 'email', 'max:255']]);
        return back()->with('success', 'Спасибо! Вы подписаны на новости и акции пекарни.');
    }
}
