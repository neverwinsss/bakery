@extends('layouts.app')
@section('title', 'Главная')

@section('content')
{{-- Hero --}}
<section class="relative bg-gradient-to-br from-amber-100 to-orange-50 py-24">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="font-display text-5xl md:text-7xl font-bold text-amber-800 mb-6 leading-tight">
            Свежая выпечка<br>каждое утро
        </h1>
        <p class="text-stone-600 text-xl mb-8 max-w-2xl mx-auto">
            Готовим с любовью из натуральных ингредиентов. Доставка по городу ежедневно.
        </p>
        <a href="{{ route('products.index') }}"
           class="inline-block bg-amber-600 text-white px-8 py-4 rounded-full text-lg font-medium hover:bg-amber-700 transition shadow-lg">
            Смотреть меню
        </a>
    </div>
</section>

{{-- Категории --}}
<section class="py-16 max-w-7xl mx-auto px-4">
    <h2 class="font-display text-3xl font-bold text-stone-800 mb-10 text-center">Наши категории</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <a href="{{ route('products.index', ['category' => $category->id]) }}"
               class="block bg-white rounded-2xl shadow-sm hover:shadow-md transition overflow-hidden group">
                <div class="bg-amber-100 h-32 flex items-center justify-center group-hover:bg-amber-200 transition">
                    <span class="font-display text-2xl font-bold text-amber-700">{{ $category->name }}</span>
                </div>
                <div class="p-4">
                    <p class="text-stone-500 text-sm">{{ $category->products->count() }} товаров</p>
                </div>
            </a>
        @endforeach
    </div>
</section>

{{-- Популярные товары --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="font-display text-3xl font-bold text-stone-800 mb-10 text-center">Хиты продаж</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featured as $product)
                <div class="bg-amber-50 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-amber-200 flex items-center justify-center text-amber-500 text-4xl">
                            --
                        </div>
                    @endif
                    <div class="p-5">
                        <h3 class="font-semibold text-lg text-stone-800 mb-1">{{ $product->name }}</h3>
                        <p class="text-stone-500 text-sm mb-3 line-clamp-2">{{ $product->info }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-amber-700 font-bold text-lg">{{ number_format($product->price, 0, '.', ' ') }} руб.</span>
                            <form method="POST" action="{{ route('cart.add', $product) }}">
                                @csrf
                                <button class="bg-amber-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-700 transition">
                                    В корзину
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Статьи --}}
@if($posts->count())
<section class="py-16 max-w-7xl mx-auto px-4">
    <h2 class="font-display text-3xl font-bold text-stone-800 mb-10 text-center">Полезные статьи</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($posts as $post)
            <a href="{{ route('posts.show', $post) }}" class="block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition">
                @if($post->image)
                    <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-44 object-cover">
                @endif
                <div class="p-5">
                    <h3 class="font-semibold text-stone-800 mb-2">{{ $post->title }}</h3>
                    <p class="text-stone-500 text-sm">{{ Str::limit($post->content, 100) }}</p>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection