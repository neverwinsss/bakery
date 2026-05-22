<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Свежая выпечка, хлеб, десерты и онлайн-заказ в Пекарне у дома')">
    <title>@yield('title', 'Пекарня у дома')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-amber-50 text-stone-800 min-h-screen flex flex-col">

    {{-- Навигация --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <a href="{{ route('home') }}" class="font-display text-2xl font-bold text-amber-700">
                    Пекарня у дома
                </a>
                <div class="hidden md:flex items-center gap-6 text-sm font-medium text-stone-600">
                    <a href="{{ route('home') }}" class="hover:text-amber-700 transition">Главная</a>
                    <a href="{{ route('about') }}" class="hover:text-amber-700 transition">О нас</a>
                    <a href="{{ route('products.index') }}" class="hover:text-amber-700 transition">Каталог</a>
                    <a href="{{ route('orders.create') }}" class="hover:text-amber-700 transition">Заказ</a>
                    <a href="{{ route('posts.index') }}" class="hover:text-amber-700 transition">Статьи</a>
                    <a href="{{ route('reviews.index') }}" class="hover:text-amber-700 transition">Отзывы</a>
                    <a href="{{ route('contacts') }}" class="hover:text-amber-700 transition">Контакты</a>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('cart.index') }}" class="relative text-stone-600 hover:text-amber-700 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-2 -right-2 bg-amber-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    @auth
                        <a href="{{ route('profile.index') }}" class="text-sm text-stone-600 hover:text-amber-700 transition">Профиль</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-sm bg-amber-700 text-white px-3 py-1.5 rounded-lg hover:bg-amber-800 transition">Админ</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button class="text-sm text-stone-500 hover:text-red-600 transition">Выйти</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-stone-600 hover:text-amber-700 transition">Войти</a>
                        <a href="{{ route('register') }}" class="text-sm bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition">Регистрация</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Флеш-сообщения --}}
    <div class="max-w-7xl mx-auto w-full px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Основной контент --}}
    <main class="flex-1">
        @yield('content')
    </main>

    <a href="tel:+79991234567" class="fixed right-4 bottom-4 z-50 bg-amber-600 text-white px-5 py-3 rounded-full shadow-lg hover:bg-amber-700">Позвонить</a>

    {{-- Футер --}}
    <footer class="bg-stone-800 text-stone-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <span class="font-display text-xl text-white">Пекарня у дома</span>
                <form method="POST" action="{{ route('subscribe') }}" class="flex gap-2">@csrf<input type="email" name="email" placeholder="Email для акций" class="rounded-lg px-3 py-2 text-stone-800 text-sm"><button class="bg-amber-600 text-white px-4 rounded-lg text-sm">Подписаться</button></form>
                <p class="text-sm">© {{ date('Y') }} Все права защищены</p>
            </div>
        </div>
    </footer>
</body>
</html>