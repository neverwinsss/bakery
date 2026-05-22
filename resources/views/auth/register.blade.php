@extends('layouts.app')
@section('title', 'Регистрация')
@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl shadow-sm p-8">
        <h1 class="font-display text-3xl font-bold text-stone-800 mb-6">Регистрация</h1>
        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf
            <div><label class="block text-sm mb-1">Имя</label><input name="name" value="{{ old('name') }}" required class="w-full border rounded-lg px-4 py-2">@error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm mb-1">Email</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full border rounded-lg px-4 py-2">@error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm mb-1">Пароль</label><input type="password" name="password" required class="w-full border rounded-lg px-4 py-2">@error('password')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror</div>
            <div><label class="block text-sm mb-1">Повторите пароль</label><input type="password" name="password_confirmation" required class="w-full border rounded-lg px-4 py-2"></div>
            <button class="w-full bg-amber-600 text-white py-3 rounded-xl hover:bg-amber-700">Создать аккаунт</button>
        </form>
    </div>
</div>
@endsection
