@extends('layout')

@section('page-name')
    My Video
@endsection()

@section('page-content')

@if($videos->count() <= 0)
    <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <h3 class="text-center">No videos available!</h3>
    </div>

@else

    <div class="container container-sm text-center mb-3 mt-5">
        @include('video-gallery')
    </div>

@endif

@endsection()