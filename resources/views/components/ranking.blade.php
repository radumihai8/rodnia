@props(['top_10_players', 'top_10_guilds', 'top_10_pets'])

<div class="ranking-title">
    <h1>{{__('Ranking')}}</h1>
    <p>{{__('Best Players, and Guilds')}}</p>
</div>
<div class="ranking-section">
    <div class="container">
        <div class="p-5 top-10">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <img class="d-block mb-2 m-auto" src="{{asset('images/top-10-players.png')}}" alt="Top 10 players icon">
                    <div class="card text-center">
                        <h4 class="ranking-subtitle">{{__("Top 10 Players")}}</h4>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped small-ranking">
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Class')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Guild')}}</th>
                                    <th>{{__('Empire')}}</th>
                                    <th>{{__('Level')}}</th>
                                </tr>
                                @foreach($top_10_players as $player)
                                    <tr>
                                        @if($loop->index+1<=3)
                                            <td><img class="img-fluid" src="{{asset('images/ribbons/'.($loop->index+1).'.png')}}"></td>
                                        @else
                                            <td>{{$loop->index+1}}.</td>
                                        @endif
                                        <td><img class="img-fluid" src="{{asset('images/class/'.($player->job).'.png')}}"></td>
                                        <td>{{$player->name}}</td>
                                        <td>{{$player->getGuildAttribute()->name}}</td>
                                        <td><img class="img-fluid" src="{{asset('images/empire/'.($player->playerIndex->empire ?? 1).'.png')}}"></td>
                                        <td>Lv. {{$player->level}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            </div>
                            <a class="ranking-btn" href="{{route('ranking.players')}}">{{__("Show full")}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img class="d-block mb-2 m-auto" src="{{asset('images/top-10-guilds.png')}}" alt="Top 10 guilds icon">
                    <div class="card text-center">
                        <h4 class="ranking-subtitle">{{__("Top 10 Guilds")}}</h4>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-striped small-ranking">
                                <tr>
                                    <th>#</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Empire')}}</th>
                                    <th>{{__('Points')}}</th>
                                </tr>
                                @foreach($top_10_guilds as $guild)
                                    <tr>
                                        @if($loop->index+1<=3)
                                            <td><img class="img-fluid" src="{{asset('images/ribbons/'.($loop->index+1).'.png')}}"></td>
                                        @else
                                            <td>{{$loop->index+1}}.</td>
                                        @endif
                                        <td>{{$guild->name}}</td>
                                        <td>{{$guild->getOwnerAttribute()->playerIndex->kingdom}}</td>
                                        <td>{{$guild->ladder_point}}</td>
                                    </tr>
                                @endforeach
                            </table>
                            </div>
                            <a class="ranking-btn" href="{{route('ranking.guilds')}}">{{__("Show full")}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
