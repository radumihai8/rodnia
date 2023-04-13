@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="Manage Events" subtitle=""></x-title>

        <div class="page-holder">
            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

            <form method="post" action="/events">
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
                            <input type="datetime-local" name="date"  class="form-control" id="datetime" placeholder="2021-01-01 00:00:00">
                            <label for="datetime" class="form-label">Date & Time</label>
                        </div>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>

                </div>
            </form>

            <hr>
            <h1>Current Events</h1>
            <div class="text-center">
                @foreach($events as $event)
                    <div class="row">
                        <div class="col-10">
                            <form method="post" action="/events/{{$event->id}}">
                                <div class="row">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="name"  class="form-control" id="name" value="{{$event->name}}">
                                            <label for="name" class="form-label">Name</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="datetime-local" name="date"  class="form-control" id="datetime" value="{{$event->date}}">
                                            <label for="datetime" class="form-label">Date & Time</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="col-2">
                            <form method="post" action="/events/{{$event->id}}">
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
