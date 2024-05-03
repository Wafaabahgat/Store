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
                <th colspan="2"></th>

            </tr>
        </thead>
        <tbody>
            @if ($categories)
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
                            @method('delete')
                            <button type="button" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    No categories yet.</tr>
            @endif
        </tbody>
    </table>

@endsection



@section('content')
