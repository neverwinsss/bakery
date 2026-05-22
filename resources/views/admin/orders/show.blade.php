@extends('layouts.admin')
@section('title','Заказ №'.$order->id)
@section('content')
<div class="bg-white rounded-xl p-6"><p><b>Клиент:</b> {{ $order->user->name ?? '' }}</p><p><b>Адрес:</b> {{ $order->delivery_address }}</p><p><b>Сумма:</b> {{ $order->total_price }} ₽</p><form method="POST" action="{{ route('admin.orders.status',$order) }}" class="my-4 flex gap-2">@csrf @method('PATCH')<select name="status" class="border rounded px-3 py-2">@foreach(['новый','готовится','готов','завершён','отменён'] as $st)<option @selected($order->status==$st)>{{ $st }}</option>@endforeach</select><button class="bg-amber-600 text-white px-4 rounded">Обновить</button></form><h2 class="font-semibold mt-6 mb-2">Состав</h2><ul class="list-disc pl-5">@foreach($order->items as $item)<li>{{ $item->product->name ?? 'Товар удален' }} × {{ $item->quantity }} — {{ $item->price }} ₽</li>@endforeach</ul></div>
@endsection
