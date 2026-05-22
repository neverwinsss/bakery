@extends('layouts.app')
@section('title', $post->title)
@section('content')
<article class="max-w-3xl mx-auto px-4 py-12 bg-white md:mt-12 rounded-2xl shadow-sm"><h1 class="font-display text-4xl font-bold mb-6">{{ $post->title }}</h1>@if($post->image)<img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="rounded-xl mb-6">@endif<div class="prose max-w-none text-stone-700 whitespace-pre-line">{{ $post->content }}</div></article>
@endsection
