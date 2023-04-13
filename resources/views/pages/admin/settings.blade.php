@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">

        <x-title title="Manage Settings" subtitle=""></x-title>

        <div class="page-holder">

            <a href="{{route('admin.home')}}" class="btn btn-indigo btn-sm mb-3"><i class="bi bi-arrow-left"></i> Back to Admin Panel</a>

            <hr>
            <h1>Current Settings</h1>
            <div class="text-center">


                @foreach($settings as $setting)
                    <div class="row">
                        <div class="col-11">
                            <form method="post" action="/settings/{{$setting->id}}">
                                <div class="row">
                                    @csrf
                                    @method('PATCH')
                                    <div class="col d-none">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="id"  class="form-control" id="id" value="{{$setting->id}}">
                                            <label for="id" class="form-label">ID</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="value"  class="form-control" id="value" value="{{$setting->value}}">
                                            <label for="value" class="form-label">{{$setting->key}}</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection
