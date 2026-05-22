@extends('layouts.app')
@section('title', 'Контакты')
@section('content')
<div class="max-w-6xl mx-auto px-4 py-12"><h1 class="font-display text-4xl font-bold mb-8">Контакты</h1><div class="grid md:grid-cols-2 gap-8"><div class="bg-white rounded-2xl p-6 shadow-sm space-y-4">@foreach($contacts as $contact)<p><b>{{ $contact->name }}:</b> {{ $contact->info }}</p>@endforeach<a href="tel:+79991234567" class="inline-block bg-amber-600 text-white px-6 py-3 rounded-xl">Позвонить менеджеру</a></div><div class="bg-amber-100 rounded-2xl h-80 flex items-center justify-center text-stone-500">Карта расположения пекарни</div></div></div>
@endsection
