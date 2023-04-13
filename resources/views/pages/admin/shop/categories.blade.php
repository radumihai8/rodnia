@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="Manage ItemShop Categories" subtitle=""></x-title>

        <div class="page-holder">
            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

            <form class="row g-3" method="POST" action="/shop/category">
            @csrf
            <div class="col-auto">
                <label class="visually-hidden">Name</label>
                <input type="text" name="name" placeholder="Category name" class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Send</button>
            </div>
        </form>

        <hr>
        <h1>Current categories</h1>
            <div class="text-center">
                @foreach($categories as $category)
                        <form class="row g-3 m-auto" method="POST" action="/shop/category/{{$category->id}}">
                            @csrf
                            @method('PATCH')
                            <div class="col-auto">
                                <label class="visually-hidden">Name</label>
                                <input type="text" name="name" value="{{$category->name}}" class="form-control">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-3">Send</button>
                            </div>
                        </form>
                @endforeach
            </div>

    </div>
    </div>

@endsection
