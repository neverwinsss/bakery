@extends('layouts.admin')
@section('title','Товары')
@section('content')
<a href="{{ route('admin.products.create') }}" class="inline-block bg-amber-600 text-white px-4 py-2 rounded mb-4">Добавить товар</a><div class="bg-white rounded-xl p-6"><table class="w-full text-sm">@foreach($products as $product)<tr class="border-b"><td class="py-3">{{ $product->name }}</td><td>{{ $product->category->name ?? '' }}</td><td>{{ $product->price }} ₽</td><td><a class="text-amber-700" href="{{ route('admin.products.edit',$product) }}">Редактировать</a></td></tr>@endforeach</table><div class="mt-4">{{ $products->links() }}</div></div>
@endsection
