<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- Remove responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap-bundle.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">


    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>

    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/shop.js') }}" defer></script>
</head>

<body>

    <div id="page">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a href="/shop">
                    <img src="{{asset('images/navbar-logo.png')}}" class="navbar-logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto col">
                        <li class="nav-item user-holder">
                            <span class="nav-link">
                                <i class="bi bi-person-fill"></i>
                                {{auth()->user()->login}}
                            </span>
                            <!-- print current time -->
                            <span class="nav-link">
                                <i class="bi bi-clock"></i>
                                <span id="time">{{Carbon\Carbon::now()}}</span>
                            </span>

                            <a class="nav-link history-button" href="{{route('shop.history')}}">
                                <i class="bi bi-clock-history"></i> {{ __('History') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item coin-item">
                            <span class="coin-holder">
                                <span class="d-block"><img src="{{asset('images/shop/dc.png')}}">&nbsp;{{auth()->user()->coins}}</span>
                                <span class="d-block"><img src="{{asset('images/shop/dm.png')}}">&nbsp;{{auth()->user()->jcoins}}</span>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-secondary text-red" href="/coins"><img src="{{asset('images/shop/dc.png')}}">&nbsp;{{ __('Buy Coins') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-secondary text-red btn-redeem"
                               href="{{route('shop.promocode.index')}}"
                               data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{__("Redeem Promo Code")}}"
                            >
                                <i class="bi bi-gift-fill text-red"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <x-toastr></x-toastr>
        <x-item-modal></x-item-modal>

        <div class="shop-container p-2">

            <ul class="nav nav-tabs align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('shop.home')}}"><i class="bi bi-house-fill"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('shop.items.all')}}">{{__('All items')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('shop.subcategory.mostbought')}}">{{__('Most Bought')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('shop.subcategory.promotions')}}">{{__('Promotions')}}</a>
                </li>
                <li class="ms-auto">
                    <form class="d-flex" method="POST" action="{{route('shop.search')}}">
                        @csrf
                        <div class="input-group main-search">
                            <input type="text" class="form-control" name="search" placeholder="Search.." aria-label="Search" aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="submit" id="button-addon2"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </li>
            </ul>
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
 </body>
