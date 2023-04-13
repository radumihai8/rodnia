@extends("layouts.app")

@section('content')

    <x-news :news="$news"></x-news>
    <x-class></x-class>
    <x-ranking :top_10_players="$top_10_players" :top_10_guilds="$top_10_guilds" :top_10_pets="$top_10_pets"></x-ranking>

@endsection

