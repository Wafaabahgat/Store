@extends('layouts.dashboard')

@section('title', 'Edit Category')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>
@endsection


@section('content')

    <form action="{{ route('dashboard.categories.update',$categories->id) }}" method="post">
        @csrf
        @method( 'put' )
        
        @include('')
    </form>

@endsection
