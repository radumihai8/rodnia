@extends('layouts.shop')

@section('content')
    <h3>{{__("All items")}}</h3>
    <div class="col-md-2">
        <ul class="nav flex-column">
            @foreach($categories as $category_)
                <li class="nav-item category-link">

                    <a class="nav-link" href="{{route('shop.category.show', ['category' => $category_->id])}}">
                        <i class="bi bi-balloon-heart"></i>
                        <span class="d-block">{{$category_->name}}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-md-10">
        <div class="item-grid">
            @foreach($categories as $category)
                <h5>{{$category->name}}</h5>
                @foreach($category->items->chunk(3) as $chunk)
                    <div class="row items-row row-cols-3">
                        @foreach($chunk as $item)
                            @include('components.item', ['item' => $item])
                        @endforeach
                    </div>
                @endforeach
            @endforeach

        </div>


@endsection
