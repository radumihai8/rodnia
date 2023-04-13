@extends('layouts.app')

@section('content')
    <div class="register-page">
    <div class="container text-center p-5">
        <div class="steps-form m-auto">
            <div class="steps-row setup-panel" id="steps-row">
                <div class="steps-step " id="step1">
                    <p class="step-title"><span>Registration</span></p>
                    <a type="button" class="btn btn-indigo btn-circle" disabled>&nbsp;</a>
                    <p class="step-subtitle"><span>Step 1</span></p>
                </div>
                <div class="steps-step" id="step2">
                    <p class="step-title">Activation</p>
                    <a type="button" class="btn btn-indigo btn-circle" disabled>&nbsp;</a>
                    <p class="step-subtitle"><span>Step 2</span></p>
                </div>
            </div>
        </div>

        <div class="page-holder clearfix">

                <form method="post" action="/register" class="">
                    <h5 class="small-title">{{__("Create Free Account")}}</h5>
                    <p class="small-subtitle">{{__("Receive a bonus for newcomers")}}</p>
                    @isset($referral_id)
                        <div class="alert alert-info">
                            Your referral ID is: {{$referral_id}}
                        </div>
                    @endisset
                    @csrf

                    <div class="form-floating mb-3">
                        @include("layouts.form.input", ["placeholder"=>"Login", "name" => "login", "type"=>"text"])
                        <label for="login"><i class="bi bi-person-fill"></i> {{ __("Login") }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        @include("layouts.form.input", ["placeholder"=>"Password","name" => "password", "type" => "password", "data_bs_toggle" => "tooltip", "data_bs_placement" => "left", "data_bs_title" => "7-16 Characters Alphanumeric"])
                        <label for="password"><i class="bi bi-lock-fill"></i> {{ __("Password") }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        @include("layouts.form.input", ["placeholder"=>"Password Confirmation","name" => "password_confirmation", "type" => "password"])
                        <label for="password_confirmation"><i class="bi bi-lock-fill"></i> {{ __("Confirm password") }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        @include("layouts.form.input", ["placeholder"=>"email", "name" => "email", "type" => "email"])
                        <label for="email"><i class="bi bi-envelope-fill"></i> {{ __('Email Address') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        @include("layouts.form.input", ["placeholder"=>"1234567","name" => "social_id", "type" => "text", "maxlength" => "7", "data_bs_toggle" => "tooltip", "data_bs_placement" => "left", "data_bs_title" => "7 Characters Numeric"])
                        <label for="social-id"><i class="bi bi-123"></i> {{ __("Character delete code") }}</label>
                    </div>
                    <div class="form-floating mb-3 d-none">
                        @php
                            if(!isset($referral_id))
                                $referral_id = 0;
                        @endphp
                        @include("layouts.form.input", ["placeholder"=>"0","name" => "referrer_id", "type" => "number", "value" => $referral_id])
                        <label for="social-id">{{ __("Referrer id") }}</label>
                    </div>
                    <!-- add a TOS checkbox and a valid email checkbox -->
                    <div class="form-floating mb-3">
                        <div class="form-check
                        @error('tos')
                            is-invalid
                        @enderror
                        ">
                            <input class="form-check-input @error('tos') is-invalid @enderror" type="checkbox" name="tos" id="tos">
                            <label class="form-check-label" for="tos">
                                {{ __("I agree to the") }} <a href="/tos" target="_blank">{{ __("Terms of Service") }}</a>
                            </label>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <div class="form-check
                        @error('email_check')
                            is-invalid
                        @enderror
                        ">
                            <input class="form-check-input @error('email_check') is-invalid @enderror" type="checkbox" name="email_check" id="email_check">
                            <label class="form-check-label" for="email_check">
                                {{ __("I confirm that my email is valid") }}
                            </label>
                        </div>
                    </div>

                    <p class="text-muted">{{__("Without a valid email you will loose access to your account!")}}</p>

                    <div class="form-floating text-center">
                        <button type="submit" class="btn btn-lg btn-secondary w-50">
                            {{ __("Register") }}
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection
<script>
    function resizeRegisterBar(){
        var step1Width = $("#step1").width() / 2;

        //get the width of step2
        var step2Width = $("#step2").width() / 2;
        var totalWidth = $("#steps-row").width() ;

        let sum = step1Width + step2Width;

        let newWidth = totalWidth - sum - 20;

        document.documentElement.style.setProperty('--2stepwidth', newWidth+"px");
        document.documentElement.style.setProperty('--2stepmargin', (step1Width+10)+"px");
    }
    window.onload = resizeRegisterBar;

    //on resize call resizeRegisterBar

    window.onresize = resizeRegisterBar;


</script>
