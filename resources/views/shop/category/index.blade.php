@extends('layouts.shop')

@section('content')
    <div class="row mt-2">
        <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($slides as $slide)
                    <div class="carousel-item {{$loop->first ? 'active' : ''}}">
                        <!-- redirect to category with $slide->category_id -->
                        <a href="{{route('shop.subcategory.show', $slide->category_id)}}">
                            <img src="{{asset('images/slides/'.$slide->image)}}" class="d-block w-100" alt="{{$slide->title}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="row-item-grid">
            <h2>{{__('Newest items')}}</h2>
            <div id="itemsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($items->chunk(3) as $chunk)
                        @if($loop->first)
                            <div class="carousel-item active">
                                @else
                                    <div class="carousel-item">
                                        @endif
                                        <div class="row items-row row-cols-3 justify-content-center">
                                            @foreach($chunk as $item)
                                                @include('components.item', ['item' => $item])
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#itemsCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#itemsCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                </div>


            </div>
        </div>
@endsection
