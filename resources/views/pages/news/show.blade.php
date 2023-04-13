@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">
        <div class="title-container">
            <h1 class="page-title">{{$article->title}}</h1>
            <span class="page-subtitle">{{$article->created_at->diffForHumans()}}</span>
        </div>

        <div class="page-holder">

            @admin
            <div class="row w-50">
                <div class="col">
                    <a class="btn btn-secondary d-block" href="/news/{{$article->id}}/edit">Edit article</a>
                </div>
                <div class="col">
                    <form action="/news/{{$article->id}}" method="POST" class="d-inline-block">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger d-inline-block" type="submit">Delete Post</button>
                    </form>
                </div>
            </div>
            @endadmin
            <p>{{$article->content}}</p>
        </div>
    </div>
@endsection
