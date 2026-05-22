@extends('layouts.admin')
@section('title','Заказы')
@section('content')
<div class="bg-white rounded-xl p-6"><table class="w-full text-sm"><tr class="text-left text-stone-500"><th>№</th><th>Клиент</th><th>Адрес</th><th>Статус</th><th>Сумма</th><th></th></tr>@foreach($orders as $order)<tr class="border-t"><td class="py-3">{{ $order->id }}</td><td>{{ $order->user->name ?? '' }}</td><td>{{ $order->delivery_address }}</td><td>{{ $order->status }}</td><td>{{ $order->total_price }} ₽</td><td><a class="text-amber-700" href="{{ route('admin.orders.show',$order) }}">Открыть</a></td></tr>@endforeach</table><div class="mt-4">{{ $orders->links() }}</div></div>
@endsection
