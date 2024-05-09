@extends('layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>
@endsection

@section('content')

    <div class="mb-2">
        <a href="{{ route('dashboard.categories.create') }}" class="mr-2 btn btn-primary">Create</a>
        <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-dark">Trash</a>

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
                <th scope="col">Parent</th>
                <th scope="col">Parent #</th>
                <th scope="col">Status</th>
                <th scope="col">Image</th>
                <th scope="col">Created_at</th>
                <th colspan="2"></th>
            </tr>
        </thead>
        <tbody>

            @forelse ($categories as $category)
                <tr>
                    <th scope="row"> {{ $category->id }} </th>
                    <td>
                        <a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a>

                    </td>
                    <td> {{ $category->parent_name }} </td>
                    <td> {{ $category->parent_count }} </td>
                    <td> {{ $category->status }} </td>
                    <td>
                        <img src="{{ asset('storage/' . $category->image) }}" alt="" height="60"
                            width="80" />
                    </td>
                    <td> {{ $category->created_at }} </td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        No categories yet.
                    </td>
                </tr>
            @endforelse ($categories as $category)
        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}

@endsection
