@extends('layouts.dashboard')

@section('title', 'Starter Page')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>
@endsection

@section('content')
