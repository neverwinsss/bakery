@extends('layouts.admin')
@section('title','Дашборд')
@section('content')
<div class="grid md:grid-cols-5 gap-4 mb-8">@foreach($stats as $key=>$value)<div class="bg-white rounded-xl p-5 shadow-sm"><p class="text-sm text-stone-500">{{ $key }}</p><b class="text-2xl">{{ $value }}</b></div>@endforeach</div>
<div class="bg-white rounded-xl p-6"><h2 class="font-semibold mb-4">Последние заказы</h2><table class="w-full text-sm"><tr class="text-left text-stone-500"><th>№</th><th>Клиент</th><th>Статус</th><th>Сумма</th></tr>@foreach($latestOrders as $order)<tr class="border-t"><td class="py-2">{{ $order->id }}</td><td>{{ $order->user->name ?? '' }}</td><td>{{ $order->status }}</td><td>{{ $order->total_price }} ₽</td></tr>@endforeach</table></div>
@endsection
