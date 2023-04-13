@extends('layouts.app')

@section('content')
    <div class="register-page">
        <div class="container text-center p-5">
            <div class="title-container">
                <h1 class="page-title">{{ __("Login") }}</h1>
                <span class="page-subtitle">{{ __("Login into your account") }}</span>
            </div>
            <div class="page-holder clearfix">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            @include("layouts.form.input", ["minlength"=>4, "placeholder"=>"Login", "name" => "login"])
                            <label for="login">{{ __('Username') }}</label>
                        </div>

                        <div class="form-floating mb-3">
                            @include("layouts.form.input", ["minlength"=>4, "placeholder"=>"Password","name" => "password", "type" => "password"])
                            <label for="password">{{ __("Password") }}</label>
                        </div>


                        <div class="form-floating">

                                <button type="submit" class="btn btn-lg btn-secondary w-50">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                        </div>
                    </form>
            </div>
        </div>
    </div>

@endsection
