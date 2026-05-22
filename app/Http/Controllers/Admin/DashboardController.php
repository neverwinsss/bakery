<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'orders'   => Order::count(),
            'products' => Product::count(),
            'users'    => User::count(),
            'reviews'  => Review::count(),
            'revenue'  => Order::where('status', 'завершён')->sum('total_price'),
        ];

        $latestOrders = Order::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'latestOrders'));
    }
}
