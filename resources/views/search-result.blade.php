@extends('layout')

@section('page-name')
    {{ $key }} - My Video
@endsection()

@section('page-content')

@if($videos->count() <= 0)
    <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <h3 class="text-center">No videos found!</h3>
    </div>

@else

    <div class="container text-center mb-3 mt-5 text-start">
        @include('video-gallery')
    </div>

@endif

@endsection()