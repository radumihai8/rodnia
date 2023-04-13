@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">
        <div class="title-container">
            <h1 class="page-title">{{__('Ranking')}}</h1>
            <span class="page-subtitle">{{__('Best pets')}}</span>
        </div>
        <div class="page-holder">
            <div class="row">
                <div class="col-md">
                    <a class="btn btn-info w-100" href="{{route('ranking.players')}}">{{__('Players')}}</a>
                </div>
                <div class="col-md">
                    <a class="btn btn-info w-100" href="{{route('ranking.guilds')}}">{{__('Guilds')}}</a>
                </div>

                <div class="col-md">
                    <button class="btn btn-secondary w-100">{{__('Pets')}}</button>
                </div>
                <div class="col-md"></div>
                <div class="col-md">
                    <form method="POST" action="" class="searchbar">
                        @csrf
                        <input type="text" name="name" placeholder="Search..." class="form-control">
                    </form>
                </div>
            </div>
            @isset($pets)
                <div class="table-responsive">
                    <table class="table table-striped mt-5">
                        <tr>
                            <th>#</th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Icon')}}</th>
                            <th>{{__('Owner')}}</th>
                            <th>{{__('Level')}}</th>
                        </tr>
                        @foreach($pets as $pet)
                            <tr>
                                @if($firstPosition<=3)
                                    <td><img class="img-fluid" src="{{asset('images/ribbons/'.($firstPosition++).'.png')}}"></td>
                                @else
                                    <td>{{$firstPosition++}}.</td>
                                @endif
                                <td>{{$pet->nickname}}</td>
                                <td><img class="img-fluid" src="{{asset('images/pets/'.$pet->vnum.'.png')}}"></td>
                                <td>{{$pet->getOwnerAttribute()->name}}</td>
                                <td>{{$pet->level}}</td>

                            </tr>
                        @endforeach
                    </table>
                </div>


                {{ $pets->links() }}
            @endisset

            @empty($pets)
                {{'Nothing to show here..'}}
            @endempty
        </div>
    </div>
@endsection
