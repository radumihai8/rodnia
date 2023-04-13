@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">
        <x-title title="{{__('Referrals')}}" subtitle="{{__('View your current referrals and collect rewards')}}"></x-title>
        <div class="page-holder">
            <div class="alert alert-info">
                {{__("Your referral URL is: ")}}
                <strong>{{route('register', ['refferer_id' => auth()->user()->id])}} </strong>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Join Date</th>
                        <th>Level</th>
                        <th>Playtime</th>
                        <th>Action</th>
                    </tr>

                    @foreach($referrals as $referral)
                        <tr>
                            <td>{{$referral->player()->name ?? "No character"}}</td>
                            <td>{{$referral->join_date}}</td>
                            <td>{{$referral->player()->level ?? "No character"}}</td>
                            <td>{{$referral->player()->playtime ?? "No character"}}</td>
                            <td>
                                @if($referral->eligible())
                                    @if($referral->claimed==0)
                                        <form method="post" action="">
                                            @csrf
                                            <input type="number" value="{{$referral->id}}" name="referral_id" class="d-none">
                                            <input type="submit" value="Claim" class="btn btn-secondary">
                                        </form>
                                    @else
                                        {{__('Reward claimed')}}
                                    @endif
                                @else
                                    {{__("Referral not eligible!")}}
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

    </div>
@endsection
