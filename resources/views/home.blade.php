@extends('layouts.layout')
@section('style')

<link rel="stylesheet" type="text/css" href="../public/css/home.css">
@endsection

@section('content')
<h1 class="text-Left"> Bienvenido {{ Auth::user()->name }} <br/>a CONAFOR </h1>

@endsection
