@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="Manage Download Links" subtitle=""></x-title>

        <div class="page-holder">
            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>
            <form method="post" action="/download">
                <div class="row">
                    @csrf
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" name="name"  class="form-control" id="name" placeholder="Name">
                            <label for="name" class="form-label">Name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" name="url"  class="form-control" id="url" placeholder="https://...">
                            <label for="url" class="form-label">URL</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating mb-3">
                            <select name="type" class="form-select">
                                <option value="client" selected>Client</option>
                                <option value="patcher">Patcher</option>
                            </select>
                            <label for="type" class="form-label">Type</label>
                        </div>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>

                </div>
            </form>

            <hr>
            <h1>Current Download Links</h1>
            <div class="text-center">


                @foreach($downloads as $download)
                <div class="row">
                    <div class="col-11">
                        <form method="post" action="/download/{{$download->id}}">
                            <div class="row">
                                @csrf
                                @method('PATCH')
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name"  class="form-control" id="name" value="{{$download->name}}">
                                        <label for="name" class="form-label">Name</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="url"  class="form-control" id="url" value="{{$download->url}}">
                                        <label for="url" class="form-label">URL</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating mb-3">
                                        <select name="type" class="form-select">
                                            <option value="client"
                                                    @if($download->type == 'client')
                                                    selected
                                                @endif
                                            >Client</option>
                                            <option value="patcher"
                                                    @if($download->type == 'patcher')
                                                    selected
                                                @endif
                                            >Patcher</option>
                                        </select>
                                        <label for="type" class="form-label">Type</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="col-1">
                        <form method="post" action="/download/{{$download->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{__('Delete')}}</button>
                        </form>
                    </div>

                </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection
