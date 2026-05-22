@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        {{-- Изображение --}}
        <div>
            @if($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                     class="w-full rounded-2xl shadow-lg object-cover max-h-96">
            @else
                <div class="w-full h-72 bg-amber-100 rounded-2xl flex items-center justify-center text-stone-400">
                    Нет фото
                </div>
            @endif
        </div>

        {{-- Информация --}}
        <div class="flex flex-col justify-center">
            <span class="text-amber-600 text-sm font-medium">{{ $product->category->name }}</span>
            <h1 class="font-display text-4xl font-bold text-stone-800 my-3">{{ $product->name }}</h1>
            @if($product->weight)
                <p class="text-stone-500 text-sm mb-3">Вес: {{ $product->weight }}</p>
            @endif
            @if($product->info)
                <p class="text-stone-600 leading-relaxed mb-6">{{ $product->info }}</p>
            @endif
            <div class="flex items-center gap-4">
                <span class="text-3xl font-bold text-amber-700">{{ number_format($product->price, 0, '.', ' ') }} руб.</span>
                @if($product->is_available)
                    <form method="POST" action="{{ route('cart.add', $product) }}">
                        @csrf
                        <button class="bg-amber-600 text-white px-6 py-3 rounded-xl font-medium hover:bg-amber-700 transition">
                            Добавить в корзину
                        </button>
                    </form>
                @else
                    <span class="text-red-500 font-medium">Нет в наличии</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Отзывы --}}
    <div class="mt-16">
        <h2 class="font-display text-2xl font-bold text-stone-800 mb-6">Отзывы ({{ $reviews->count() }})</h2>

        @auth
            <form method="POST" action="{{ route('reviews.store', $product) }}"
                  class="bg-white rounded-2xl p-6 shadow-sm mb-8">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-stone-700 mb-1">Оценка</label>
                    <select name="rating" class="border border-stone-200 rounded-lg px-3 py-2 text-sm" required>
                        @for($i = 5; $i >= 1; $i--)
                            <option value="{{ $i }}">{{ $i }} из 5</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-stone-700 mb-1">Ваш отзыв</label>
                    <textarea name="text" rows="3"
                              class="w-full border border-stone-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-300"
                              required></textarea>
                </div>
                <button class="bg-amber-600 text-white px-6 py-2 rounded-lg text-sm hover:bg-amber-700 transition">
                    Оставить отзыв
                </button>
            </form>
        @endauth

        <div class="space-y-4">
            @forelse($reviews as $review)
                <div class="bg-white rounded-xl p-5 shadow-sm">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-medium text-stone-700">{{ $review->user->name }}</span>
                        <span class="text-amber-500 text-sm">
                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                        </span>
                    </div>
                    <p class="text-stone-600 text-sm">{{ $review->text }}</p>
                    <p class="text-stone-400 text-xs mt-2">{{ $review->created_at->format('d.m.Y') }}</p>
                </div>
            @empty
                <p class="text-stone-500">Отзывов пока нет. Будьте первым!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection