@extends('layouts.app')
@section('title', 'Вход')
@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white rounded-2xl shadow-sm p-8">
        <h1 class="font-display text-3xl font-bold text-stone-800 mb-6">Вход</h1>
        <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
            @csrf
            <div><label class="block text-sm mb-1">Email</label><input type="email" name="email" value="{{ old('email') }}" required class="w-full border rounded-lg px-4 py-2"></div>
            <div><label class="block text-sm mb-1">Пароль</label><input type="password" name="password" required class="w-full border rounded-lg px-4 py-2"></div>
            <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="remember"> Запомнить меня</label>
            @error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
            <button class="w-full bg-amber-600 text-white py-3 rounded-xl hover:bg-amber-700">Войти</button>
        </form>
        <p class="text-sm text-stone-500 mt-5">Нет аккаунта? <a class="text-amber-700" href="{{ route('register') }}">Зарегистрироваться</a></p>
    </div>
</div>
@endsection
