@extends('layouts.app')
@section('title', 'Корзина')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="font-display text-4xl font-bold text-stone-800 mb-8">Корзина</h1>

    @if(empty($cart))
        <div class="text-center py-16 bg-white rounded-2xl">
            <p class="text-stone-500 text-lg">Корзина пуста</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block text-amber-600 hover:underline">
                Перейти в меню
            </a>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
            @foreach($cart as $id => $item)
                <div class="flex items-center gap-6 p-5 border-b border-stone-100 last:border-0">
                    <div class="flex-1">
                        <h3 class="font-medium text-stone-800">{{ $item['name'] }}</h3>
                        <p class="text-stone-500 text-sm">{{ number_format($item['price'], 0, '.', ' ') }} руб.</p>
                    </div>
                    <form method="POST" action="{{ route('cart.update', $id) }}" class="flex items-center gap-2">
                        @csrf @method('PATCH')
                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                               class="w-16 border border-stone-200 rounded-lg text-center text-sm py-1.5"
                               onchange="this.form.submit()">
                    </form>
                    <span class="font-bold text-amber-700 w-24 text-right">
                        {{ number_format($item['price'] * $item['qty'], 0, '.', ' ') }} руб.
                    </span>
                    <form method="POST" action="{{ route('cart.remove', $id) }}">
                        @csrf @method('DELETE')
                        <button class="text-stone-400 hover:text-red-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="bg-amber-50 rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <span class="text-lg font-medium text-stone-700">Итого:</span>
                <span class="text-2xl font-bold text-amber-700">{{ number_format($total, 0, '.', ' ') }} руб.</span>
            </div>

            @auth
                <a href="{{ route('orders.create') }}"
                   class="block text-center w-full bg-amber-600 text-white py-3 rounded-xl font-medium hover:bg-amber-700 transition">
                    Перейти к оформлению заказа
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="block text-center bg-amber-600 text-white py-3 rounded-xl font-medium hover:bg-amber-700 transition">
                    Войдите для оформления
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection