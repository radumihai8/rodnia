@extends("layouts.app")

@section('content')
<div class="container text-center p-5">
    <div class="title-container">
        <h1 class="page-title">{{__('User Panel')}}</h1>
        <span class="page-subtitle">{{__('View your account details')}}</span>
    </div>
    <div class="page-holder">
        <div class="btn-holder text-start mb-5">
            <div class="row">
                <div class="col-md">
                 <button class="btn btn-secondary w-100">{{__('My Account')}}</button>
                </div>

                @if(setting('referral_active') == '1')
                    <div class="col-md">
                        <a href="/referrals" class="btn btn-secondary w-100">{{__('Invite Players')}}</a>
                    </div>
                @endif
                <div class="col-md">
                    <a class="btn btn-info w-100" href="{{route('shop.home')}}">{{__('Itemshop')}}</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="table-responsive">
                    <table class="table table-hover table-panel">
                        <tr>
                            <td>{{__("Username")}}:</td>
                            <td>{{$account->login}}</td>
                        </tr>
                        <tr>
                            <td>{{__("Real name")}}:</td>
                            <td>{{$account->real_name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('E-Mail Address')}}:</td>
                            <td>{{$account->email}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Coins')}}:</td>
                            <td>{{$account->coins}}</td>
                        </tr>
                        <tr>
                            <td>{{__('JCoins')}}:</td>
                            <td>{{$account->jcoins}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Change email')}}:</td>
                            <td><button class="btn btn-primary">{{__('Submit')}}</button></td>
                        </tr>
                        <tr>
                            <td>{{__('Change password')}}:</td>
                            <td>
                                <form method="POST" action="/forgot-password">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('Receive storekeeper password')}}:</td>
                            <td><button class="btn btn-primary">{{__('Submit')}}</button></td>
                        </tr>
                        <tr>
                            <td>{{__('Character deletion code')}}:</td>
                            <td>
                                <form method="POST" action="/forgot-charcode">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="table-responsive">
                    <table class="table table-hover table-characters w-100">
                        @forelse($account->players as $player)
                            <tr>
                                <td>
                                    <img class="img-fluid" src="{{asset("images/class_avatar/1.png")}}">
                                </td>
                                <td class="w-50">
                                    <span class="highlight">Lv. {{ $player->level }} {{ $player->name }}</span>
                                    <br>
                                    {{__('Warrior')}}
                                </td>
                                <td>
                                    <form method="POST" action="/debug/{{$player->id}}">
                                        @csrf
                                        <input type="submit" class="btn btn-secondary btn-debug" value="Debug">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <li>No characters</li>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
