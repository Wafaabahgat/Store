@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>



    <form action="{{ route('categories.store') }}" method="">
        @csrf
        <div>
            <label for="">Category Name</label>
        </div>

    </form>

@endsection



@section('content')
