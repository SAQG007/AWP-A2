@extends('layout')

@section('page-name')
    My Video
@endsection

@section('page-content')

@if($videos->count() <= 0)
    <div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
        <h3 class="text-center">No videos available!</h3>
    </div>

@else

    <div class="container text-center mb-3 mt-5 text-start">
        @if(session('confirmationMessage'))
            <div class="alert alert-info alert-dismissible fade show text-start" role="alert">
                {{ session('confirmationMessage') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @include('video-gallery')
    </div>

@endif

@endsection