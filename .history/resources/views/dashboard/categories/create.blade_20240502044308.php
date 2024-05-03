@extends('layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>



    <form action="{{ route('categories.store') }}" method="">
        @csrf
        <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" name="name" id="" class="form-control">
        </div>

    </form>

@endsection



@section('content')
