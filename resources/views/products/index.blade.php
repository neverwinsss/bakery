@extends('layouts.app')
@section('title', 'Меню')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="font-display text-4xl font-bold text-stone-800 mb-8">Наше меню</h1>

    <form method="GET" action="{{ route('products.index') }}" class="bg-white rounded-2xl p-5 shadow-sm mb-8 grid md:grid-cols-5 gap-4 items-end">
        <div>
            <label class="block text-xs font-medium text-stone-500 mb-1">Тип</label>
            <select name="category" class="w-full border rounded-lg px-3 py-2">
                <option value="">Все типы</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-stone-500 mb-1">Цена от</label>
            <input type="number" name="price_from" value="{{ request('price_from') }}" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-xs font-medium text-stone-500 mb-1">Цена до</label>
            <input type="number" name="price_to" value="{{ request('price_to') }}" class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label class="block text-xs font-medium text-stone-500 mb-1">Свежесть</label>
            <select name="freshness" class="w-full border rounded-lg px-3 py-2">
                <option value="">Любая</option>
                <option value="new" @selected(request('freshness') === 'new')>Новинки</option>
            </select>
        </div>
        <button class="bg-amber-600 text-white rounded-lg px-4 py-2 hover:bg-amber-700">Показать</button>
    </form>

    {{-- Фильтр по категориям --}}
    <div class="flex flex-wrap gap-3 mb-10">
        <a href="{{ route('products.index') }}"
           class="px-5 py-2 rounded-full text-sm font-medium transition
                  {{ !request('category') ? 'bg-amber-600 text-white' : 'bg-white text-stone-600 hover:bg-amber-50' }}">
            Все
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('products.index', ['category' => $cat->id]) }}"
               class="px-5 py-2 rounded-full text-sm font-medium transition
                      {{ request('category') == $cat->id ? 'bg-amber-600 text-white' : 'bg-white text-stone-600 hover:bg-amber-50' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition">
                    <a href="{{ route('products.show', $product) }}">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                 class="w-full h-44 object-cover">
                        @else
                            <div class="w-full h-44 bg-amber-100 flex items-center justify-center text-stone-400 text-sm">
                                Нет фото
                            </div>
                        @endif
                    </a>
                    <div class="p-4">
                        <span class="text-xs text-amber-600 font-medium bg-amber-50 px-2 py-1 rounded-full">
                            {{ $product->category->name }}
                        </span>
                        <h3 class="font-semibold text-stone-800 mt-2 mb-1">{{ $product->name }}</h3>
                        @if($product->weight)
                            <p class="text-stone-400 text-xs mb-2">{{ $product->weight }}</p>
                        @endif
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-amber-700 font-bold">{{ number_format($product->price, 0, '.', ' ') }} руб.</span>
                            @if($product->is_available)
                                <form method="POST" action="{{ route('cart.add', $product) }}">
                                    @csrf
                                    <button class="bg-amber-600 text-white px-3 py-1.5 rounded-lg text-xs hover:bg-amber-700 transition">
                                        В корзину
                                    </button>
                                </form>
                            @else
                                <span class="text-stone-400 text-xs">Нет в наличии</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $products->links() }}</div>
    @else
        <p class="text-stone-500">Товаров в этой категории пока нет.</p>
    @endif
</div>
@endsection