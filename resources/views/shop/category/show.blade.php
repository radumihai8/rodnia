@extends('layouts.shop')

@section('content')
    <h2>{{$category->name}}</h2>
    <div class="row">
        <x-shop.category-sidebar :categories="$categories" :subcategories="$subcategories"></x-shop.category-sidebar>

        <div class="col-10">
        <div class="item-grid">


            @foreach($items->chunk(3) as $chunk)
                <div class="row items-row row-cols-3">
                    @foreach($chunk as $item)
                        @include('components.item', ['item' => $item])
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    </div>


@endsection
