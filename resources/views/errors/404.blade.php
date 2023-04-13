@extends('layouts.app')


@section('content')
    <div class="container text-center p-5">
        <div class="page-holder p-5 page-text">
            <img src="{{asset('images/404.png')}}" class="logo img-fluid d-block m-auto mt-5 mb-5">
            <span class="page-text d-block">{{__('404 Page Not Found')}}</span>
            <a class="btn btn-light mt-5" href="{{route('home')}}">{{__('Return')}}</a>
        </div>

    </div>


@endsection
