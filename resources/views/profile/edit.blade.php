@extends('layouts.app')
@section('title', 'Редактирование профиля')
@section('content')
<div class="max-w-md mx-auto px-4 py-12"><div class="bg-white rounded-2xl p-8 shadow-sm"><h1 class="font-display text-3xl font-bold mb-6">Профиль</h1><form method="POST" action="{{ route('profile.update') }}" class="space-y-4">@csrf @method('PUT')<div><label class="block text-sm mb-1">Имя</label><input name="name" value="{{ old('name', auth()->user()->name) }}" class="w-full border rounded-lg px-4 py-2"></div><div><label class="block text-sm mb-1">Email</label><input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="w-full border rounded-lg px-4 py-2"></div><button class="w-full bg-amber-600 text-white py-3 rounded-xl">Сохранить</button></form></div></div>
@endsection
