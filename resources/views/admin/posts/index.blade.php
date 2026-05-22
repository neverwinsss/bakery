@extends('layouts.admin')
@section('title','Статьи')
@section('content')
<a href="{{ route('admin.posts.create') }}" class="inline-block bg-amber-600 text-white px-4 py-2 rounded mb-4">Добавить статью</a><div class="bg-white rounded-xl p-6">@foreach($posts as $post)<div class="border-b py-3 flex justify-between"><span>{{ $post->title }}</span><a class="text-amber-700" href="{{ route('admin.posts.edit',$post) }}">Редактировать</a></div>@endforeach<div class="mt-4">{{ $posts->links() }}</div></div>
@endsection
