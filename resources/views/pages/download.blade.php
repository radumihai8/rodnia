@extends('layouts.app')


@section('content')
    <div class="container text-center p-5">
        <div class="title-container">
            <h1 class="page-title">{{__('Download')}}</h1>
            <span class="page-subtitle">{{__('Game Client or Patcher')}}</span>
        </div>
        <div class="page-holder">
            <div class="row">
                <div class="col">
                <h1 class="page-title mb-5">{{__('Download Game Client')}}</h1>

                @forelse($links as $link)
                        @if($link->type == 'client')
                            <a class="btn btn-secondary btn-download mb-4" href="{{$link->url}}" target="_blank">
                                <div class="row">
                                    <div class="col-auto"><i class="bi bi-download"></i></div>
                                    <div class="col">
                                        <span class="download-title">{{__('Download')}}</span>
                                        <span class="download-name">{{$link->name}}</span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @empty
                        {{ __("Nothing to show here") }}
                    @endforelse
                </div>
                <div class="col">
                    <h1 class="page-title mb-5">{{__('Download Game Patcher')}}</h1>
                    @forelse($links as $link)
                        @if($link->type == 'patcher')
                            <a class="btn btn-info btn-download mb-4" href="{{$link->url}}" target="_blank">
                                <div class="row">
                                    <div class="col-auto"><i class="bi bi-download"></i></div>
                                    <div class="col">
                                        {{__('Download')}}<br>
                                        {{$link->name}}
                                    </div>
                                </div>
                            </a>
                        @endif
                    @empty
                        {{ __("Nothing to show here") }}
                    @endforelse
                </div>
            </div>
            <div class="game-requirements">
                <h1 class="page-title mb-5">{{__('Minimum Game Requirements')}}</h1>
                        <ul class="list-unstyled text-start w-75 m-auto">
                            <li><span class="req-title">OS:</span> 				Windows 7.</li>
                            <li><span class="req-title">Processor:</span> 		    2nd Generation Intel Processors (Intel Core i3/i5/i7-2xxx)</li>
                            <li><span class="req-title">Memory:</span>			1 GB RAM.</li>
                            <li><span class="req-title">Graphics:</span>			Graphics device with 512MB RAM.</li>
                            <li><span class="req-title">DirectX:</span>			Version 9.0c.</li>
                            <li><span class="req-title">Network:</span> 			Broadband Internet connection.</li>
                            <li><span class="req-title">Storage:</span> 			6 GB available space.</li>
                            <li><span class="req-title">Sound Card:</span> 		DirectX Compatible.</li>
                        </ul>
            </div>
            </div>
        </div>
    </div>
@endsection
