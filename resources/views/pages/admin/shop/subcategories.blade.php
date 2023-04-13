@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="Manage ItemShop Subcategories" subtitle=""></x-title>

        <div class="page-holder">
            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

            <h1>Create new subcategory</h1>
            <form class="row g-3" method="POST" action="/shop/subcategory">
                @csrf
                <div class="col-auto">
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label class="visually-hidden">Name</label>
                    <input type="text" name="name" placeholder="Subcategory name" class="form-control">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Send</button>
                </div>
            </form>

            <hr>
            <h1>Current subcategories</h1>
            <div class="text-center">
                @foreach($subcategories as $subcategory)
                    <form class="row g-3 m-auto" method="POST" action="/shop/subcategory/{{$subcategory->id}}">
                        @csrf
                        @method('PATCH')
                        <div class="col-auto">
                            <select name="category_id" class="form-select">
                                @foreach($categories as $category)

                                    <option value="{{$category->id}}"
                                            @if($category->id == $subcategory->category_id)
                                                selected
                                        @endif
                                    >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <label class="visually-hidden">Name</label>
                            <input type="text" name="name" value="{{$subcategory->name}}" class="form-control">
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
