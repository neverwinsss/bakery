@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="flex justify-between items-center mb-8"><h1 class="font-display text-4xl font-bold">Личный кабинет</h1><a class="text-amber-700" href="{{ route('profile.edit') }}">Редактировать профиль</a></div>
    <h2 class="text-2xl font-semibold mb-4">История заказов</h2>
    <div class="space-y-4">
        @forelse($orders as $order)
        <div class="bg-white rounded-2xl p-6 shadow-sm">
            <div class="flex flex-wrap justify-between gap-3"><b>Заказ №{{ $order->id }}</b><span>{{ $order->created_at->format('d.m.Y H:i') }}</span><span class="px-3 py-1 bg-amber-100 rounded-full">{{ $order->status }}</span><b>{{ number_format($order->total_price, 0, '.', ' ') }} ₽</b></div>
            <p class="text-sm text-stone-500 mt-2">{{ $order->delivery_address }}</p>
            <ul class="text-sm mt-3 list-disc pl-5">@foreach($order->items as $item)<li>{{ $item->product->name ?? 'Товар удален' }} × {{ $item->quantity }}</li>@endforeach</ul>
            <form method="POST" action="{{ route('orders.repeat', $order) }}" class="mt-4">@csrf<button class="text-amber-700 hover:underline">Повторить заказ</button></form>
        </div>
        @empty
        <div class="bg-white rounded-2xl p-8 text-center text-stone-500">У вас пока нет заказов.</div>
        @endforelse
    </div>
</div>
@endsection
