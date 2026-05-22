@extends('layouts.admin')
@section('title','Редактировать статью')
@section('content')
@include('admin.posts.form', ['post'=>$post])
@endsection
