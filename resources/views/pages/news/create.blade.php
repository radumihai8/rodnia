@extends('layouts.app')

@section('content')
    <div class="container text-center p-5">
        @php
            $title = __('New Article');
			$subtitle = '';
        @endphp

        <x-title :title="$title" :subtitle="$subtitle"></x-title>
        <div class="page-holder">
            <form method="post" action="/news">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="title"  class="form-control" id="title" placeholder="Title">
                    <label for="title" class="form-label">Title</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" name="content" placeholder="Lorem ipsum.." id="content" style="height: 150px"></textarea>
                    <label for="content">{{__('Content')}}</label>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
            </form>
        </div>
@endsection
