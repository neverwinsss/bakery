@extends('layouts.admin')
@section('title','Новый товар')
@section('content')
@include('admin.products.form', ['product'=>null])
@endsection
