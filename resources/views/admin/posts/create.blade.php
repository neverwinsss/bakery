@extends('layouts.admin')
@section('title','Новая статья')
@section('content')
@include('admin.posts.form', ['post'=>null])
@endsection
