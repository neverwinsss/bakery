@extends('layouts.admin')
@section('title','Категории')
@section('content')
<div class="bg-white rounded-xl p-6"><form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-2 mb-6">@csrf<input name="name" placeholder="Название" class="border rounded px-3 py-2"><button class="bg-amber-600 text-white px-4 rounded">Добавить</button></form>@foreach($categories as $category)<form method="POST" action="{{ route('admin.categories.update',$category) }}" class="flex gap-2 mb-2">@csrf @method('PUT')<input name="name" value="{{ $category->name }}" class="border rounded px-3 py-2 flex-1"><button class="text-amber-700">Сохранить</button></form>@endforeach</div>
@endsection
