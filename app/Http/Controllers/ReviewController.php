<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->latest()->paginate(15);

        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'text'   => 'required|min:5|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Один отзыв на товар от пользователя
        $exists = Review::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->exists();

        if ($exists) {
            return back()->with('error', 'Вы уже оставили отзыв на этот товар.');
        }

        Review::create([
            'user_id'    => auth()->id(),
            'product_id' => $product->id,
            'text'       => $request->text,
            'rating'     => $request->rating,
        ]);

        return back()->with('success', 'Отзыв добавлен!');
    }

    public function destroy(Review $review)
    {
        if (!auth()->check() || (!auth()->user()->isAdmin() && auth()->id() !== $review->user_id)) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Отзыв удалён.');
    }
}
