<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ — @yield('title', 'Панель')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Сайдбар --}}
    <aside class="w-64 bg-stone-900 text-white flex-shrink-0 min-h-screen flex flex-col">
        <div class="p-6 border-b border-stone-700">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-amber-400">Пекарня — Админ</a>
        </div>
        <nav class="flex-1 p-4 space-y-1">
            @php
                $links = [
                    ['Дашборд',      'admin.dashboard',         'admin.dashboard'],
                    ['Товары',       'admin.products.index',    'admin.products'],
                    ['Категории',    'admin.categories.index',  'admin.categories'],
                    ['Заказы',       'admin.orders.index',      'admin.orders'],
                    ['Статьи',       'admin.posts.index',       'admin.posts'],
                    ['Отзывы',       'admin.reviews.index',     'admin.reviews'],
                    ['Контакты',     'admin.contacts.index',    'admin.contacts'],
                    ['Пользователи', 'admin.users.index',       'admin.users'],
                ];
            @endphp
            @foreach($links as [$label, $route, $prefix])
                <a href="{{ route($route) }}"
                   class="block px-4 py-2 rounded-lg text-sm transition
                          {{ request()->routeIs($prefix . '*') ? 'bg-amber-600 text-white' : 'text-stone-300 hover:bg-stone-700' }}">
                    {{ $label }}
                </a>
            @endforeach
        </nav>
        <div class="p-4 border-t border-stone-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left text-sm text-stone-400 hover:text-red-400 transition px-4 py-2">
                    Выйти
                </button>
            </form>
        </div>
    </aside>

    {{-- Контент --}}
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold text-stone-700">@yield('title', 'Дашборд')</h1>
            <span class="text-sm text-stone-500">{{ auth()->user()->name }}</span>
        </header>

        <main class="flex-1 p-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>