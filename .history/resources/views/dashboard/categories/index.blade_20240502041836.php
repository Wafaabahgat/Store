@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Parent</th>
                <th scope="col">Created_at</th>
                <th scope="col">jj</th>
                <th scope="col">jj</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row"> {{ $category->id }} </th>
                    <td> {{ $category->name }} </td>
                    <td> {{ $category->parent_id }} </td>
                    <td> {{ $category->created_at }} </td>
                    <td>
                        <a href="{{ route('categories.edit') }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('categories.destroy') }}" method="post">
                            @csrf
                            @method("DELETE")
                            <button type="button" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection




@section('content')
