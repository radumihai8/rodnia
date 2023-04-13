<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Metin2') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

    <script src="{{ asset('js/main.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <!-- Styles -->
    <link rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'" href="{{ asset('css/fonts.css') }}">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rodnia.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">


</head>
<body
    class="min-vh-100 d-flex flex-column justify-content-between {{url()->current() != route('home') && url()->current() != route('index') ? 'bg-body' : ''}}">
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" aria-label="Offcanvas navbar large">
        <div class="container-xxl">
            <a href="/" class="logo-anchor">
                <img src="{{asset('images/navbar-logo.png')}}" class="navbar-logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                <div class="offcanvas-body desktop-offcanvas">
                    <ul class="navbar-nav me-auto text-center">

                        <li class="nav-item">
                            <!-- if current route is index or home print active -->
                            <a class="nav-link {{url()->current() == route('index') || url()->current() == route('home') ? 'active' : ''}}" href="{{ route('index') }}">
                                <i class="bi bi-house-fill"></i>&nbsp;{{ __('Homepage') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link
                            {{url()->current() == route('ranking.players') ? 'active' : ''}}
                            {{url()->current() == route('ranking.guilds') ? 'active' : ''}}
                            {{url()->current() == route('ranking.pets') ? 'active' : ''}}
                        " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bar-chart-fill"></i> {{__('Ranking')}} <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="{{ route('ranking.players') }}">{{ __('Players') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('ranking.guilds') }}">{{ __('Guilds') }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('ranking.pets') }}">{{ __('Pets') }}</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('download.index') ? 'active' : ''}}" href="{{ route('download.index') }}"><i class="bi bi-download"></i>&nbsp;{{ __('Download') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ setting('community') }}"><i class="bi bi-chat-left-text"></i>&nbsp;{{ __('Community') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="{{ route('shop.home') }}"><i class="bi bi-shop"></i>&nbsp;{{ __('Itemshop') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto text-center">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown language-button" style="height:0" >
                            <a class="nav-link px-3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{asset('images/flags/'.app()->getLocale().'.svg')}}" class="language-flag">
                                {{get_languages()[app()->getLocale()] ?? app()->getLocale()}}
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu" style="z-index:-1;">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        &nbsp;
                                    </a>
                                </li>
                                @foreach(get_languages() as $code => $language)
                                    @if($code != app()->getLocale())
                                        <li>
                                            <a class="dropdown-item" href="/language/{{$code}}">
                                                <img src="{{asset('images/flags/'.$code.'.svg')}}" class="language-flag">
                                                {{$language}}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item dropdown d-flex">
                                    <button type="button" class="btn btn-primary align-self-center" data-bs-toggle="modal" data-bs-target="#loginModal">
                                        {{ __('Login') }}
                                    </button>

                                    <!-- Login Modal -->

                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item d-flex">
                                    <a class="btn btn-secondary align-self-center" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-fill"></i>&nbsp;{{ Auth::user()->login }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user')}}">
                                        <i class="bi bi-person-bounding-box"></i> {{ __('Panel') }}
                                    </a>
                                    @admin
                                    <a class="dropdown-item" href="{{route('admin.home')}}">
                                        <i class="bi bi-diagram-2-fill"></i> Admin Panel
                                    </a>
                                    @endadmin

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class="offcanvas-body mobile-offcanvas">
                    <div class="offcanvas-header">
                        <a href="/">
                            <img src="{{asset('images/navbar-logo.png')}}" class="navbar-logo">
                        </a>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <ul class="navbar-nav me-auto px-3">

                        <li class="nav-item">
                            <!-- if current route is index or home print active -->

                            <a class="nav-link {{url()->current() == route('index') || url()->current() == route('home') ? 'active' : ''}}" href="{{ route('index') }}">
                                <i class="bi bi-house-fill"></i>&nbsp;{{ __('Homepage') }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <div class="">
                                <a class="accordion-button nav-link collapsed
                                {{url()->current() == route('ranking.players') ? 'active' : ''}}
                                {{url()->current() == route('ranking.guilds') ? 'active' : ''}}
                                {{url()->current() == route('ranking.pets') ? 'active' : ''}}
                                " type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <i class="bi bi-bar-chart-fill"></i>&nbsp;{{__('Ranking')}}&nbsp;<i class="bi bi-chevron-down"></i>
                                </a>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                                    <div class="accordion-body">
                                        <ul class="accordion-list">
                                            <li><a class="acc-item" href="{{ route('ranking.players') }}">{{ __('Players') }}</a></li>
                                            <li><a class="acc-item" href="{{ route('ranking.guilds') }}">{{ __('Guilds') }}</a></li>
                                            <li><a class="acc-item" href="{{ route('ranking.pets') }}">{{ __('Pets') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{url()->current() == route('download.index') ? 'active' : ''}}" href="{{ route('download.index') }}"><i class="bi bi-download"></i>&nbsp;{{ __('Download') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ setting('community') }}"><i class="bi bi-chat-left-text"></i>&nbsp;{{ __('Community') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" target="_blank" href="{{ route('shop.home') }}"><i class="bi bi-shop"></i>&nbsp;{{ __('Itemshop') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        <li class="nav-item px-3">
                            <div class="">
                                <a class="accordion-button nav-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseLang" aria-expanded="false" aria-controls="flush-collapseLang">
                                    <img src="{{asset('images/flags/'.app()->getLocale().'.svg')}}" class="language-flag">&nbsp;{{get_languages()[app()->getLocale()] ?? app()->getLocale()}}&nbsp;<i class="bi bi-chevron-down"></i>
                                </a>
                                <div id="flush-collapseLang" class="accordion-collapse collapse" aria-labelledby="flush-headingLang" style="">
                                    <div class="accordion-body">
                                        <ul class="accordion-list">
                                            @foreach(get_languages() as $code => $language)
                                                @if($code != app()->getLocale())
                                                    <li>
                                                        <a class="acc-item" href="/language/{{$code}}">
                                                            <img src="{{asset('images/flags/'.$code.'.svg')}}" class="language-flag">
                                                            {{$language}}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>

                        @guest
                            @if (Route::has('login'))
                                <hr>
                                <div class="nav-item mt-2 text-center" id="flush-headingTwo">
                                    <a class="btn btn-primary align-self-center nav-item collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                        {{__('Login')}}
                                    </a>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample" style="">
                                        <div class="accordion-body dropdown-login">
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <div class="form-floating mb-3">
                                                    @include("layouts.form.input", ["id" =>'mobile-login-modal', "placeholder"=>"Login", "name" => "login"])
                                                    <label for="username"><i class="bi bi-person-fill"></i>{{ __('Username') }}</label>

                                                </div>

                                                <div class="form-floating mb-3">
                                                    @include("layouts.form.input", ["id" => 'mobile-password-modal', "placeholder"=>"Password","name" => "password", "type" => "password"])
                                                    <label for="password"><i class="bi bi-lock-fill"></i>{{ __("Password") }}</label>
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
                                        <br>
                                    </div>
                                </div>
                            @endif
                            <a class="m-auto my-2" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                            <h4 class="text-line my-2">or</h4>
                            @if (Route::has('register'))
                                <li class="nav-item text-center">
                                    <a class="btn btn-secondary align-self-center" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <hr>
                            <li class="nav-item px-3">
                                <div class="">
                                    <a class="accordion-button nav-link text-center d-block" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseUser" aria-expanded="true" aria-controls="flush-collapseUser">
                                        <i class="bi bi-person-fill"></i>&nbsp;{{ Auth::user()->login }}&nbsp;<i class="bi bi-chevron-down"></i>
                                    </a>
                                    <div id="flush-collapseUser" class="accordion-collapse collapse show" aria-labelledby="flush-headingUser" style="">
                                        <div class="accordion-body">
                                            <ul class="accordion-list">
                                                <li>
                                                    <a class="acc-item" href="{{ route('user')}}">
                                                        <i class="bi bi-person-bounding-box"></i> {{ __('Panel') }}
                                                    </a>
                                                </li>
                                                @admin
                                                <li>
                                                    <a class="acc-item" href="{{route('admin.home')}}">
                                                       <i class="bi bi-diagram-2-fill"></i> Admin Panel
                                                    </a>
                                                </li>
                                                @endadmin
                                                <li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                    <a class="acc-item text-danger" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                        <i class="bi bi-box-arrow-right"></i> {{ __('Logout') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <header class="masthead" id="particles-js">
        <video muted="" autoplay="" loop="" class="fvideo" style="width:100%;height:100%;" preload="metadata">
            <source src="https://rise.rodnia.to/rise.mp4?v=1.1" type="video/mp4">
        </video>
    </header>
    <main class="">


        <x-toastr></x-toastr>

        @yield('content')

    </main>
</div>
<x-footer></x-footer>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

</script>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">{{ __('Login') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        @include("layouts.form.input", ["id"=>'modal-login', "minlength"=>4, "placeholder"=>"Login", "name" => "login"])
                        <label for="login"><i class="bi bi-person-fill"></i>{{ __('Username') }}</label>
                    </div>

                    <div class="form-floating mb-3">
                        @include("layouts.form.input", ["id" => 'modal-password', "minlength"=>4, "placeholder"=>"Password","name" => "password", "type" => "password"])
                        <label for="password"><i class="bi bi-lock-fill"></i>{{ __("Password") }}</label>
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
</div>
</body>
</html>
