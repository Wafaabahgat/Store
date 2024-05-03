@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>



   <form action="{{route('')}}" method="">
    @csrf


   </form>

@endsection



@section('content')
