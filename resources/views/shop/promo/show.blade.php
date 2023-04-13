@extends('layouts.shop')

@section('content')
    <div class="item-grid">
        <h1>{{__("Redeem Promo Code")}}</h1>

        <div class="row">
            <div class="col-6 m-auto pt-3">
                <form class="row g-2" method="POST" action="{{route("shop.redeem.redeem")}}">
                    @csrf
                    <div class="mb-3">
                        <label for="code" class="form-label">{{__("Promo Code")}}</label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="{{__("Enter Promo Code")}}">
                        <div id="codeHelp" class="form-text">Check our social media for promotions</div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{__("Redeem")}}</button>
                </form>
            </div>
        </div>

    </div>

@endsection
