@props(['events'])
<div class="events-section">
    <div class="container">
        <div class="row">
            <div class="col-custom-events rotate-col">
                <span class="rotated-title-holder">
                    <span class="rotated-title">{{__("Upcoming")}}</span>
                    <span class="rotated-subtitle"> {{__("Ingame Events")}}</span>
                </span>
            </div>
            @foreach($events as $event)
            <div class="col-custom-events">
                <div class="event">
                    <span class="date">{{ \Carbon\Carbon::parse($event->date)->format('d M')}} </span>
                    <span class="title">{{$event->name}}</span>
                    <span class="starts">{{__('Starts in')}}:</span>
                    <span class="timer">{{ \Carbon\Carbon::parse($event->date)->diff()->format('%H:%I:%S') }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

