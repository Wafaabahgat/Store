@extends('layouts.dashboard')

@section('title', 'Edit Category')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>
@endsection


@section('content')

    <form action="{{ route('dashboard.categories.update',$categories->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="">Category Name</label>
            <input type="text" name="name" id="" class="form-control" value="{{$categories->name}}">
        </div>

        <div class="form-group">
            <label for="">Category Parent</label>
            <select class="form-control form-select" name="parent_id">
                <option value="">Primary Category</option>
                @foreach ($parents as $parent)
                    <option value=" {{ $parent->id }} " @selected($categories->parent_id,$parent_id)>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" class="form-control">{{$categories->description}}</textarea>
        </div>

        <div class="form-group">
            <label for="">Image</label>
            <input type="file" name="image" class="form-control" value="{{$categories->image}}">
        </div>

        <div class="form-group">
            <label for="">Status</label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="active" @checked($categories->status,'active')>
                    <label class="form-check-label">
                        Active
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="archived" @checked($categories->status,'active')>
                    <label class="form-check-label">
                        Archived
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>

@endsection
