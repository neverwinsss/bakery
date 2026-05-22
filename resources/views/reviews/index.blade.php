@extends('layouts.app')
@section('title', 'Отзывы')
@section('content')
<div class="max-w-5xl mx-auto px-4 py-12"><h1 class="font-display text-4xl font-bold mb-8">Отзывы клиентов</h1><div class="space-y-4">@forelse($reviews as $review)<div class="bg-white rounded-2xl p-5 shadow-sm"><div class="flex justify-between"><b>{{ $review->user->name ?? 'Клиент' }}</b><span class="text-amber-500">{{ str_repeat('★',$review->rating) }}{{ str_repeat('☆',5-$review->rating) }}</span></div><p class="text-sm text-stone-500">{{ $review->product->name ?? 'Товар' }}</p><p class="mt-3 text-stone-700">{{ $review->text }}</p></div>@empty<div class="bg-white rounded-2xl p-8 text-center">Отзывов пока нет.</div>@endforelse</div><div class="mt-8">{{ $reviews->links() }}</div></div>
@endsection
