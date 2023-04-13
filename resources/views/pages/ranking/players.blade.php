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
                <a class="btn btn-secondary w-100" href="#">{{__('Players')}}</a>
            </div>
            <div class="col-lg">
                <a class="btn btn-info w-100" href="{{route('ranking.guilds')}}">{{__('Guilds')}}</a>
            </div>
            <div class="col-lg mt-3 mt-lg-0">
                <form method="POST" action="" class="searchbar">
                    @csrf
                    <input type="text" name="name" placeholder="Search..." class="form-control">
                </form>
            </div>
        </div>
        @isset($players)
            <div class="table-responsive">
                <table class="table table-striped mt-5">
                    <tr>
                        <th>#</th>
                        <th>{{__('Name')}}</th>
                        <th>{{__('Guild')}}</th>
                        <th>{{__('Class')}}</th>
                        <th>{{__('Time')}}</th>
                        <th>{{__('Kingdom')}}</th>
                        <th>{{__('Level')}}</th>
                    </tr>
                    @foreach($players as $player)
                        <tr>
                            @if($firstPosition<=3)
                                <td><img class="img-fluid" src="{{asset('images/ribbons/'.($firstPosition++).'.png')}}"></td>
                            @else
                                <td>{{$firstPosition++}}.</td>
                            @endif
                            <td>{{$player->name}}</td>
                            <td>{{$player->getGuildAttribute()->name}}</td>
                            <td><img src="{{asset('images/class/'.($player->job).'.png')}}"></td>
                            <td>{{$player->playtime}}</td>
                            <td><img class="img-fluid" src="{{asset('images/empire/'.($player->playerIndex->empire ?? 1).'.png')}}"></td>
                            <td>{{$player->level}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>


            {{ $players->links() }}
        @endisset

        @empty($players)
            {{'Nothing to show here..'}}
        @endempty
        </div>
    </div>
@endsection
