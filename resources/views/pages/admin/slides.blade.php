@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="Manage ItemShop Categories" subtitle=""></x-title>

        <div class="page-holder">
            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

            <form class="row g-3" method="POST" action="/slides" enctype="multipart/form-data">
                @csrf
                <div class="col-auto">
                    <label class="visually-hidden">Title</label>
                    <input type="text" name="title" placeholder="Slide title" class="form-control">
                </div>
                <!-- image upload -->
                <div class="col-auto">
                    <label class="visually-hidden">Image</label>
                    <input type="file" name="image" placeholder="Slide image" class="form-control">
                </div>
                <!-- select subcategory id -->
                <div class="col-auto">
                    <label class="visually-hidden">Subcategory</label>
                    <select name="category_id" class="form-select">
                        @foreach($subcategories as $subcategory)
                            <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Send</button>
                </div>
            </form>

            <hr>
            <h1>Current categories</h1>
            <div class="text-center">

                @foreach($slides as $slide)
                    <div class="row">
                        <div class="col-10">
                            <form class="row g-3 m-auto" method="POST" action="/slides/{{$slide->id}}">
                                @csrf
                                @method('PATCH')
                                <div class="col-auto">
                                    <label class="visually-hidden">Title</label>
                                    <input type="text" name="name" value="{{$slide->title}}" class="form-control">
                                </div>
                                <!-- subcategory select -->
                                <div class="col-auto">
                                    <label class="visually-hidden">Subcategory</label>
                                    <select name="category_id" class="form-select">
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}" @if($subcategory->id == $slide->category_id) selected @endif>{{$subcategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-3">Send</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-2 g-3 m-auto text-start">
                            <form class="g-3 m-auto" method="POST" action="/slides/{{$slide->id}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>

                @endforeach
            </div>

        </div>
    </div>

@endsection
