@extends('layouts.admin')
@section('title','Редактировать товар')
@section('content')
@include('admin.products.form', ['product'=>$product])
@endsection
