@extends('layouts.dashboard')

@section('title', 'Edit Category')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>
@endsection


@section('content')

    <form action="{{ route('dashboard.categories.update',$categories->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method( 'put' )
        
        @include('dashboard.categories._form',[
            'button_label'=>'Update'
        ])
    </form>

@endsection
