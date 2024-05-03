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
        <div class="form-group">
            <label for="">Category Parent</label>
            <select class="form-control" name="">
                <option value="">Primary Category</option>
            </select>
        </div>

    </form>

@endsection



@section('content')
