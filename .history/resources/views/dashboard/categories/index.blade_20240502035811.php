@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>
@endsection

@section('content')


    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Parent</th>
                <th scope="col">Created_at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">
                        {{ $category->id }}
                    </th>
                    <td>
                        {{ $category->name }}
                    </td>
                    <td>
                        {{ $category->ParentCategory() }}
                    </td>
                    <td>@mdo</td>
                </tr>
            @endforeach


        </tbody>
    </table>
