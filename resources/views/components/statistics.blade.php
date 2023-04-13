<div class="statistics-section pt-2 pb-2">
    <div class="container">
        <div class="row ">
            <div class="col-6 col-sm-4 col-lg-2 rotate-col">
                <span class="rotated-title-holder">
                    <span class="rotated-title">{{__("Live Statistics")}}</span>
                    <span class="rotated-subtitle"> {{__("Of Lycosa")}}</span>
                </span>
            </div>
            @foreach($statistics as $statistic => $value)
            <div class="col-6 col-sm-4 col-lg-2">
                <div class="statistic">
                    <div class="w-100">
                        <span class="number">{{$value}}</span>
                        <span class="description">{{ucwords(__($statistic))}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
