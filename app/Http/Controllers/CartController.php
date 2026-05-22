<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        $key  = $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['qty']++;
        } else {
            $cart[$key] = [
                'name'  => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'qty'   => 1,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Товар добавлен в корзину!');
    }

    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Товар удалён из корзины.');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, (int) $request->qty);
            session()->put('cart', $cart);
        }

        return back();
    }
}
