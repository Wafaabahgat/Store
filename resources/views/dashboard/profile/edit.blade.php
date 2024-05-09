@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active"> @yield('title') </li>
@endsection


@section('content')

    <form action="{{ route('dashboard.profile.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="first_name" label="First_name" :value='$user->profile->first_name' />
            </div>
            <div class="col-md-6">
                <x-form.input name="last_name" label="Last_name" :value='$user->profile->last_name' />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <x-form.input name="birthday" label="Birthday" :value='$user->profile->birthday' />
            </div>
            <div class="col-md-6">
                <x-form.input name="gender" label="Gender" :value='$user->profile->gender' :options="['male' => 'Male', 'female' => 'Female']" :checked="$user->profile->gender" />
            </div>
        </div>
        
        <div class="form-row">
            <div class="col-md-4">
                <x-form.input name="street_address" label="Street Address" :value='$user->profile->street_address' />
            </div>
            <div class="col-md-4">
                <x-form.input name="city" label="City" :value='$user->profile->city' />
            </div>
            <div class="col-md-4">
                <x-form.input name="state" label="State" :value='$user->profile->state' />
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <x-form.input name="postal_code" label="Postal Code" :value='$user->profile->postal_code' />
            </div>
            <div class="col-md-4">
                <x-form.select name="country" label="Country" :options="$countries" :selected='$user->profile->country' />
            </div>
            <div class="col-md-4">
                <x-form.select name="locale" :options="$locales" label="Locale" :selected='$user->profile->locale' />
            </div>
        </div>

    </form>

@endsection
