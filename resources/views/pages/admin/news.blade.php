@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="Manage Download Links" subtitle=""></x-title>

        <div class="page-holder">
            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

            <!-- print all news with pagination, have edit button redirecting to /news/:id/edit and delete button  -->
            <div class="table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                @foreach($articles as $article)
                    <tr>
                        <td>{{$article->title}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td>
                            <a class="btn btn-secondary" href="/news/{{$article->id}}/edit">Edit</a>
                            <form action="/news/{{$article->id}}" method="POST" class="d-inline-block">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger d-inline-block" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            </div>
            {{$articles->links()}}
            </div>
        </div>
    </div>

@endsection
