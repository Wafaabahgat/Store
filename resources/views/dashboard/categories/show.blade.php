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
                <th scope="col">Store</th>
                <th scope="col">Status</th>
                <th scope="col">Created At</th>
            </tr>
        </thead>
        <tbody>

            @php
                $products = $category->products()->with('store')->paginate(); //products that belongTo this category
            @endphp

            @forelse ($products as $product)
                <tr>
                    <th scope="row"> {{ $product->id }} </th>
                    <td> {{ $product->name }} </td>
                    <td> {{ $product->store->name ?? '' }} </td>
                    <td> {{ $product->status }} </td>
                    <td> {{ $product->created_at }} </td>
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
