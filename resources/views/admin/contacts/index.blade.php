@extends('layouts.admin')
@section('title','Контакты')
@section('content')
<div class="bg-white rounded-xl p-6"><form method="POST" action="{{ route('admin.contacts.store') }}" class="grid md:grid-cols-3 gap-2 mb-6">@csrf<input name="name" placeholder="Название" class="border rounded px-3 py-2"><input name="info" placeholder="Значение" class="border rounded px-3 py-2"><button class="bg-amber-600 text-white rounded">Добавить</button></form>@foreach($contacts as $contact)<form method="POST" action="{{ route('admin.contacts.update',$contact) }}" class="grid md:grid-cols-3 gap-2 mb-2">@csrf @method('PUT')<input name="name" value="{{ $contact->name }}" class="border rounded px-3 py-2"><input name="info" value="{{ $contact->info }}" class="border rounded px-3 py-2"><button class="text-amber-700">Сохранить</button></form>@endforeach</div>
@endsection
