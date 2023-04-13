@extends('layouts.app')

@section('content')
    <div class="register-page">
        <div class="container text-center p-5">
            <div class="steps-form m-auto">
                <div class="steps-row setup-panel" id="steps-row">
                    <div class="steps-step " id="step1">
                        <p class="step-title"><span>{{__("Details")}}</span></p>
                        <a type="button" class="btn btn-indigo btn-circle" disabled>&nbsp;</a>
                        <p class="step-subtitle"><span>{{__("Step 1")}}</span></p>
                    </div>
                    <div class="steps-step" id="step2">
                        <p class="step-title"><span>{{__("Verification")}}</span></p>
                        <a type="button" class="btn btn-indigo btn-circle  step-fill" disabled>&nbsp;</a>
                        <p class="step-subtitle"><span>{{__("Step 2")}}</span></p>
                    </div>
                    <div class="steps-step" id="step3">
                        <p class="step-title">{{__("Completed")}}</p>
                        <a type="button" class="btn btn-indigo btn-circle" disabled>&nbsp;</a>
                        <p class="step-subtitle"><span>{{__("Step 3")}}</span></p>
                    </div>
                </div>
            </div>
            <div class="page-holder clearfix">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    <h5 class="small-title">{{__("Forgot your password?")}}</h5>
                    <p class="small-subtitle">{{__("Reset your password via email")}}</p>
                    @csrf


                    <div class="form-floating mb-3">
                        @include("layouts.form.input", ["placeholder"=>"email", "name" => "email", "type" => "email"])
                        <label for="email"><i class="bi bi-envelope-fill"></i> {{ __('Email Address') }}</label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <p class="text-muted">{{__("A reset password link will be send to your e-mail inbox.")}}</p>

                    <div class="form-floating text-center">
                        <button type="submit" class="btn btn-lg btn-secondary w-75">
                            {{ __('Send') }}
                        </button>
                    </div>
                </form>
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

                let newWidth = totalWidth - sum - 13;

                document.documentElement.style.setProperty('--2stepwidth', newWidth+"px");
                document.documentElement.style.setProperty('--2stepmargin', (step1Width+10)+"px");
            }
            window.onload = resizeRegisterBar;

            //on resize call resizeRegisterBar

            window.onresize = resizeRegisterBar;



        </script>
