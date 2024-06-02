@extends('layouts.dashboard')

@section('title', 'Trashed Products ')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item"> Products </li>
    <li class="breadcrumb-item active"> Trashed Products </li>

@endsection

@section('content')

    <div class="mb-2">
        <a href="{{ route('dashboard.singleproduct.index') }}" class="btn btn-success">Back</a>
    </div>

    <x-alert type="success" />
    <x-alert type="delete" />

    <form action="{{ URL::current() }}" method="get" class="mb-2 justify-content d-flex">
        <x-form.input name="name" type="text" placeholder="Name" :value="request('name')" />
        <select name="status" class="mx-2 form-conrtol">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button class="mx-2 btn btn-dark">Filter</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Image</th>
                <th scope="col">Deleted_at</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>

            @forelse ($products as $product)
                <tr>
                    <th scope="row"> {{ $product->id }} </th>
                    <td> {{ $product->name }} </td>
                    <td> {{ $product->status }} </td>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="" height="60" width="80" />
                    </td>
                    <td> {{ $product->deleted_at }} </td>
                    <td>
                        <form action="{{ route('dashboard.products.restore', $product->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-info">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.force-delete', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        No products yet.
                    </td>
                </tr>
            @endforelse ($products as $product)
        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}

@endsection
