@extends('layouts.app')

@section('content')
<div class="container text-center p-5">
    <x-title title="Admin panel" subtitle=""></x-title>
    <div class="page-holder">
        <div class="list-group mb-3">
            <li class="list-group-item active">
                <i class="fa fa-cogs fa-1" aria-hidden="true"></i> Game Settings
            </li>

            <a href="{{route('admin.players')}}" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> Manage Players </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">View and manage players</p>
            </a>

            <a href="{{route('admin.settings')}}" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> Manage Settings </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">View and manage Settings</p>
            </a>

            <a href="{{route('admin.download')}}" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> Manage Download Links </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">View and manage download links</p>
            </a>

            <a href="{{route('admin.events')}}" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> Manage Events </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">View and manage events</p>
            </a>

            <a href="{{route('admin.news')}}" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> Manage News Articles </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">View and manage articles</p>
            </a>
            <a href="{{route('shop.admin.promocodes')}}" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> Manage Promocodes </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">View and manage promocodes</p>
            </a>
            <a href="/news/create" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-dollar fa-1" aria-hidden="true"></i> Create news </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">Create news articles</p>
            </a>

        </div>

        <div class="list-group mb-3">
            <li class="list-group-item active">
                <i class="fa fa-cogs fa-1" aria-hidden="true"></i> Shop Settings
            </li>

            <a href="{{route('shop.admin.items')}}" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> Manage Items </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">Create and manage items</p>
            </a>


            <a href="{{route('shop.admin.categories')}}" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> Manage Categories </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">Create and manage categories</p>
            </a>
            <a href="{{route('shop.admin.subcategories')}}" class="list-group-item list-group-item-action">
                <h6 class="list-group-item-heading"><i class="fa fa-user fa-1" aria-hidden="true"></i> Manage Subcategories </h6>
                <p class="list-group-item-text" style="color: #0ce3ac;">Create and manage subcategories</p>
            </a>

        </div>
    </div>
</div>
@endsection
