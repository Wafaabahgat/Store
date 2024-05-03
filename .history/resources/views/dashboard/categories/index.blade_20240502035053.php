@extends('layouts.dashboard')

@section('title', 'categories')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>
@endsection

@section('content')
