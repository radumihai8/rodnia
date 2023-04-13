@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">
        <div class="title-container">
            <h1 class="page-title">{{__('Edit Article')}}</h1>
        </div>
        <div class="page-holder">
            <form method="post" action="/news/{{$article->id}}">
                @csrf
                @method('PATCH')
                <div class="form-floating mb-3">
                    <input type="text" name="title"  class="form-control" id="title" value="{{$article->title}}">
                    <label for="title" class="form-label">Title</label>
                </div>
                <div class="form-group">
                    <label for="content">{{__('Content')}}</label>
                    <textarea class="form-control" name="content" placeholder="Lorem ipsum.." id="content" style="height: 150px" >{{$article->content}}</textarea>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
            </form>
        </div>
@endsection
