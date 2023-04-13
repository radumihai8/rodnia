@extends('layouts.shop')

@section('content')
    <h3>{{$subcategory->name}}</h3>
    <x-shop.category-sidebar :categories="$categories" :subcategories="$subcategories"></x-shop.category-sidebar>
    <x-shop.item-grid :items="$items"></x-shop.item-grid>
@endsection
