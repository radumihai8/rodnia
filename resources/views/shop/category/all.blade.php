@extends('layouts.shop')

@section('content')
    <h1>{{__("All items")}}</h1>
    <div class="row">
        <x-shop.category-sidebar :categories="$categories" :subcategories="$subcategories"></x-shop.category-sidebar>
        <div class="col-lg-10">
            <div class="item-grid">
                @foreach($categories as $category)

                    @foreach($category->subcategories as $subcategory)
                        @if(!$subcategory->isEmpty())
                            <ol class="breadcrumb" >
                                <li class="breadcrumb-item">{{$category->name}}</li>
                                <li class="breadcrumb-item active" aria-current="page">{{$subcategory->name}}</li>
                            </ol>

                            @foreach($subcategory->items->chunk(3) as $chunk)
                                <div class="row items-row row-cols-3">
                                    @foreach($chunk as $item)
                                        @include('components.item', ['item' => $item])
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                @endforeach

            </div>
        </div>
    </div>

@endsection
