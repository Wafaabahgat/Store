@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>
@endsection


@section('content')

    <form action="{{ route('dashboard.categories.store') }}" method="post">
        @csrf
      

    </form>

@endsection
