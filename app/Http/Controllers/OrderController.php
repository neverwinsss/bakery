<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn ($i) => $i['price'] * $i['qty'], $cart));

        return view('orders.create', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста. Добавьте товары перед оформлением.');
        }

        $total = array_sum(array_map(fn ($i) => $i['price'] * $i['qty'], $cart));

        DB::transaction(function () use ($request, $cart, $total) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $total,
                'status' => 'новый',
                'delivery_address' => $request->delivery_address,
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect()->route('profile.index')->with('success', 'Заказ оформлен! Мы свяжемся с вами для подтверждения.');
    }

    public function repeat(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $cart = session()->get('cart', []);
        $order->load('items.product');

        foreach ($order->items as $item) {
            if (!$item->product || !$item->product->is_available) {
                continue;
            }

            $cart[$item->product_id] = [
                'name' => $item->product->name,
                'price' => $item->product->price,
                'image' => $item->product->image,
                'qty' => ($cart[$item->product_id]['qty'] ?? 0) + $item->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Товары из заказа добавлены в корзину.');
    }
}
