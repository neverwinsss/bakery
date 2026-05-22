@extends('layouts.admin')
@section('title','Пользователи')
@section('content')
<div class="bg-white rounded-xl p-6"><table class="w-full text-sm">@foreach($users as $user)<tr class="border-b"><td class="py-3">{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->role }}</td><td><a class="text-amber-700" href="{{ route('admin.users.edit',$user) }}">Редактировать</a></td></tr>@endforeach</table><div class="mt-4">{{ $users->links() }}</div></div>
@endsection
