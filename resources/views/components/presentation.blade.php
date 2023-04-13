<div class="presentation-section p-5">
    <div class="container">
        <img src="{{asset("images/presentation-banner.png")}}" class="img-fluid">
    </div>
</div>
<div class="register-offer">
    <div class="container">
        <div class="row">
            <div class="col text-left">
                <img class="img-fluid d-inline-block" src="{{asset('images/book.png')}}">
                <div class="promo-text d-inline-block">
                    <h1 class="d-block">{{__('Not registered yet?')}}</h1>
                    <span class="d-block">{{__('Create a new account and receive special limited offer reward.')}}</span>
                </div>
            </div>
            <div class="col text-end d-flex align-items-center justify-content-center">
                @if (Route::has('register'))
                        <a class="btn btn-secondary d-table-cell align-middle text-red philosopher" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            </div>
        </div>
    </div>
</div>
