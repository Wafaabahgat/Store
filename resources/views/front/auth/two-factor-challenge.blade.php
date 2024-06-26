<x-front-layout title="2FA Challenge">

    <x-slot name="breadcrumb">
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">2FA Challenge</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Home</a></li>
                            <li>2FA Challenge</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Start Account 2FA Challenge Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('two-factor.login') }}" method="post">
                        @csrf
                        <div class="card-body">

                            <div class="title">
                                <h3>2FA Challenge</h3>
                                <p>You can login using your social media account or email address.</p>
                            </div>
                            @if ($errors->has('code'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="code">2FA code</label>
                                <input class="form-control" type="text" name="code" id="code">
                            </div>
                            <div class="form-group input-group">
                                <label for="re-code">Recovery code</label>
                                <input class="form-control" type="text" name="recovery_code" id="re-code">
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->

</x-front-layout>
