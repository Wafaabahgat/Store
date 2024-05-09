@extends('layouts.dashboard')

@section('title', $category->name)

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> Category </li>
    <li class="breadcrumb-item active"> {{ $category->name }} </li>
@endsection


@section('content')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Parent</th>
                <th scope="col">Parent #</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>

            @php
                $products = $category->products()->with('store')->paginate();
            @endphp

            @forelse ($products as $product)
                <tr>
                    <th scope="row"> {{ $parent->id }} </th>
                    <td> {{ $product->name }} </td>
                    <td> {{ $product->parent_name }} </td>
                    <td> {{ $product->parent_count }} </td>
                    <td> {{ $product->status }} </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        No products yet.
                    </td>
                </tr>
            @endforelse 
        </tbody>
    </table>

@endsection
