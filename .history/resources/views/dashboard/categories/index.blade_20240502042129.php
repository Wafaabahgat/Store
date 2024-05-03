@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumbs')
    @parent

    <li class="breadcrumb-item active"> @yield('title') </li>

    @endsection
    




@section('content')
