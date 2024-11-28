@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
 
 
<h1>Cześć, {{ auth()->user()->name }}! <i class="far fa-smile-wink"></i></h1>
@endsection