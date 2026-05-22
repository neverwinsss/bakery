@extends('layouts.admin')
@section('title','Отзывы')
@section('content')
<div class="space-y-3">@foreach($reviews as $review)<div class="bg-white rounded-xl p-5"><b>{{ $review->user->name ?? '' }}</b> о {{ $review->product->name ?? '' }} — {{ $review->rating }}/5<p>{{ $review->text }}</p><form method="POST" action="{{ route('admin.reviews.destroy',$review) }}">@csrf @method('DELETE')<button class="text-red-600 text-sm">Удалить</button></form></div>@endforeach</div><div class="mt-4">{{ $reviews->links() }}</div>
@endsection
