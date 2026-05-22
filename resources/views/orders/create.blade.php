@extends('layouts.app')
@section('title', 'Оформление заказа')
@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <h1 class="font-display text-4xl font-bold mb-8">Оформление заказа</h1>
    @if(empty($cart))
        <div class="bg-white rounded-2xl p-8 text-center">Корзина пуста. <a class="text-amber-700" href="{{ route('products.index') }}">Перейти в каталог</a></div>
    @else
    <div class="grid md:grid-cols-3 gap-8">
        <form method="POST" action="{{ route('orders.store') }}" class="md:col-span-2 bg-white rounded-2xl p-6 shadow-sm space-y-4">
            @csrf
            <div><label class="block text-sm font-medium mb-1">Адрес доставки *</label><input name="delivery_address" value="{{ old('delivery_address') }}" required placeholder="Улица, дом, квартира" class="w-full border rounded-lg px-4 py-2">@error('delivery_address')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm font-medium mb-1">Телефон</label><input name="phone" value="{{ old('phone') }}" placeholder="+7 ..." class="w-full border rounded-lg px-4 py-2"></div>
            <div><label class="block text-sm font-medium mb-1">Комментарий к заказу</label><textarea name="comment" rows="4" class="w-full border rounded-lg px-4 py-2" placeholder="Например: позвонить за 10 минут">{{ old('comment') }}</textarea></div>
            <button class="w-full bg-amber-600 text-white py-3 rounded-xl hover:bg-amber-700">Подтвердить заказ</button>
        </form>
        <aside class="bg-amber-50 rounded-2xl p-6 h-fit">
            <h2 class="font-semibold text-lg mb-4">Ваш заказ</h2>
            <div class="space-y-3">
                @foreach($cart as $item)
                <div class="flex justify-between text-sm"><span>{{ $item['name'] }} × {{ $item['qty'] }}</span><b>{{ number_format($item['price']*$item['qty'], 0, '.', ' ') }} ₽</b></div>
                @endforeach
            </div>
            <div class="border-t mt-4 pt-4 flex justify-between text-xl font-bold"><span>Итого</span><span>{{ number_format($total, 0, '.', ' ') }} ₽</span></div>
        </aside>
    </div>
    @endif
</div>
@endsection
