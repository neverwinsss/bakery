@extends('layouts.app')
@section('title', 'Полезные статьи')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12"><h1 class="font-display text-4xl font-bold mb-8">Полезные статьи</h1><div class="grid md:grid-cols-3 gap-6">@forelse($posts as $post)<a href="{{ route('posts.show',$post) }}" class="bg-white rounded-2xl p-6 shadow-sm hover:shadow-md"><h2 class="font-semibold text-xl mb-3">{{ $post->title }}</h2><p class="text-stone-500 text-sm">{{ Str::limit($post->content, 160) }}</p></a>@empty<p>Статей пока нет.</p>@endforelse</div><div class="mt-8">{{ $posts->links() }}</div></div>
@endsection
