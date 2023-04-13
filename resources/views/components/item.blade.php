@if(
	(!$item->max_pcs_account || ( $item->max_pcs_account && $item->max_pcs_account - $item->countHistory() > 0)) &&
    (!$item->max_pcs_global || ( $item->max_pcs_global && $item->max_pcs_global - $item->countHistoryGlobal() > 0)) &&
    (!$item->available_start || ( $item->available_start && $item->available_start->isPast())) &&
    (!$item->available_end || ( $item->available_end && $item->available_end->isFuture()))
	)
<div class="col item d-inline-block position-relative">
    @if($item->max_pcs_account)
    <div class="ribbon-wrapper">
        <div class="ribbon blue" data-bs-toggle="tooltip" data-bs-placement="left" title="{{__("You can buy a limited amount of this item")}}"><i class="bi bi-person-fill"></i></div>
    </div>
    @endif
    @if($item->max_pcs_global)
        <div class="ribbon-wrapper">
            <div class="ribbon green" data-bs-toggle="tooltip" data-bs-placement="left" title="{{__("This item is available in a limited quantity")}}"><i class="bi bi-basket2"></i></div>
        </div>
    @endif
    @if($item->discount > 0 && $item->discount_start <= date('Y-m-d H:i:s') && $item->discount_end >= date('Y-m-d H:i:s'))
        <div class="ribbon-wrapper">
            <div class="ribbon red"><i class="bi bi-percent"></i></div>
        </div>
    @endif
    @if($item->available_start && $item->available_start <= date('Y-m-d H:i:s') && $item->available_end >= date('Y-m-d H:i:s'))
        <div class="ribbon-wrapper" >
            <div class="ribbon orange" data-bs-toggle="tooltip" data-bs-placement="left" title="{{__("Item available for a limited time")}}"><i class="bi bi-clock"></i></div>
        </div>
    @endif
    <div class="row item-first-row">
        <div class="col-4 item-icon">
            <img src="{{asset('images/50065.png')}}">
        </div>
        <div class="col">
            <a class="item-title">{{$item->proto->locale_name}}</a>
            @if($item->max_pcs_account)
                <p class="small-item-desc text-red">
                    Max. {{$item->max_pcs_account}} item(s) per account
                    <br>
                    {{$item->max_pcs_account - $item->countHistory()}} pcs. left
                </p>
            @endif
            @if($item->max_pcs_global)
                <p class="small-item-desc text-red">
                    {{$item->max_pcs_global - $item->countHistoryGlobal()}} / {{$item->max_pcs_global}} item(s) available
                </p>
            @endif
            <p class="small-item-desc">
                {{$item->description}}
                @if(!$item->proto->isTradeable())
                <span class="text-danger d-block">{{__("This item is not tradeable")}}</span>
                @endif
            </p>
        </div>
    </div>
    <!--- Buttons row -->
    <div class="row text-end">
        <div class="container">
        <!-- Button to launch modal -->
            @php
                $bonuses = "";
				//go from attrtype0 to attrtype6, if there is a bonus, append to bonuses
                for($i = 0; $i < 7; $i++) {
                    if($item->{"attrtype$i"} != 0) {
                        $bonuses .= "<span class='bonus-name'>". get_bonus_name($item->{"attrtype$i"}, $item->{"attrvalue$i"}) . "</span><br>";
                    }
                }
				if($bonuses != "") {
					$bonuses = "<div class='item-bonuses'>$bonuses</div>";
				}
            @endphp

            @if($item->discount > 0 && $item->discount_start <= date('Y-m-d H:i:s') && $item->discount_end >= date('Y-m-d H:i:s'))

                <span class="float-start pill-holder">
                    <span class="badge badge rounded-pill badge-soft-warning float-start">-{{$item->discount}}%</span><br>
                    <!-- difference in D H:I:S between now and discount end -->
                    <span class="badge badge-soft-secondary rounded-pill">{{date_diff(date_create(date('Y-m-d H:i:s')), date_create($item->discount_end))->format('%ad %hh:%im')}}</span>
                </span>
            @endif
            @if($item->available_end && $item->available_start <= date('Y-m-d H:i:s') && $item->available_end >= date('Y-m-d H:i:s'))
                <span class="float-start pill-holder">
                    <!-- difference in D H:I:S between now and discount end -->
                    <span class="badge badge-soft-secondary rounded-pill">{{date_diff(date_create(date('Y-m-d H:i:s')), date_create($item->available_end))->format('%ad %hh:%im')}}</span>
                </span>
            @endif
            <button type="button" class="btn
            @if($item->coin == "MD")
                    btn-secondary
            @else
                    btn-silver
            @endif
            buy-button
            ms-auto
            "
                    data-img="{{asset('images/50065.png')}}"
                    data-coin="{{$item->coin}}"
                    data-id="{{$item->id}}"
                    data-price="
                    @if($item->discount > 0 && $item->discount_start <= date('Y-m-d H:i:s') && $item->discount_end >= date('Y-m-d H:i:s'))
                        {{round($item->price - ($item->price * $item->discount / 100))}}
                    @else
                        {{$item->price}}
                    @endif"
                    data-bonuses="{{$bonuses}}"
                    data-description="{{$item->description}}"
                    data-tradeable="{{$item->proto->isTradeable() ? 'true' : 'false'}}"
                    data-title="{{$item->proto->locale_name}}"
                    data-max-quantity="@if($item->max_pcs_account == 0){{$item->max_pcs}}@else{{min($item->max_pcs,$item->max_pcs_account - $item->countHistory())}}@endif"
                    @if($item->coin == "MD")
                        data-coin-image="{{asset('images/coins.png')}}"
                    @else
                        data-coin-image="{{asset('images/jcoins.png')}}"
                    @endif
                    data-bs-toggle="modal" data-bs-target="#itemModal">

                @if($item->coin == "MD")
                    <img class="coin-image" src="{{asset('images/coins.png')}}">
                @else
                    <img class="coin-image" src="{{asset('images/jcoins.png')}}">
                @endif
                <!-- check if $item->discount and if the current date is between discount_start and discount_end, then calculate the price rounded -->

                @if($item->discount > 0 && $item->discount_start <= date('Y-m-d H:i:s') && $item->discount_end >= date('Y-m-d H:i:s'))
                    <span class="item-price">{{round($item->price - ($item->price * $item->discount / 100))}}</span>
                    <s class="discount-price">{{$item->price}}</s>
                @else
                    {{$item->price}}
                @endif
            </button>
        </div>
    </div>
</div>
@endif



