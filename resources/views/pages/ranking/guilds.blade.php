@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">
        <div class="title-container">
            <h1 class="page-title">{{__('Ranking')}}</h1>
            <span class="page-subtitle">{{__('Best players')}}</span>
        </div>
        <div class="page-holder">
            <div class="row">
                <div class="col-lg">
                    <a class="btn btn-info w-100" href="{{route('ranking.players')}}">{{__('Players')}}</a>
                </div>
                <div class="col-lg">
                    <button class="btn btn-secondary w-100">{{__('Guilds')}}</button>
                </div>

                <div class="col-lg mt-3 mt-lg-0">
                    <form method="POST" action="" class="searchbar">
                        @csrf
                        <input type="text" name="name" placeholder="Search..." class="form-control">
                    </form>
                </div>
            </div>
    @isset($guilds)

    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th>#</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Owner')}}</th>
                <th>{{__('Points')}}</th>
                <th>{{__('Kingdom')}}</th>
                <th>{{__('Level')}}</th>
            </tr>
        @foreach($guilds as $guild)
            <tr>
                @if($firstPosition<=3)
                    <td><img class="img-fluid" src="{{asset('images/ribbons/'.($firstPosition++).'.png')}}"></td>
                @else
                    <td>{{$firstPosition++}}.</td>
                @endif
                <td>{{$guild->name}}</td>
                <td>{{$guild->owner->name}}</td>
                <td>{{$guild->ladder_point}}</td>
                <td><img class="img-fluid" src="{{asset('images/empire/'.($guild->owner->kingdom ?? 1).'.png')}}"></td>
                <td>{{$guild->level}}</td>
            <br>
        @endforeach
        </table>
    </div>



    {{ $guilds->links() }}
    @endisset

    @empty($guilds)
        {{'Nothing to show here..'}}
    @endempty
        </div>
    </div>
@endsection
