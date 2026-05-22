@extends('layouts.admin')
@section('title','Пользователь')
@section('content')
<form method="POST" action="{{ route('admin.users.update',$user) }}" class="bg-white rounded-xl p-6 space-y-4 max-w-xl">@csrf @method('PUT')<input name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2"><input name="email" value="{{ $user->email }}" class="w-full border rounded px-3 py-2"><select name="role" class="w-full border rounded px-3 py-2"><option value="user" @selected($user->role==='user')>user</option><option value="admin" @selected($user->role==='admin')>admin</option></select><button class="bg-amber-600 text-white px-5 py-2 rounded">Сохранить</button></form>
@endsection
