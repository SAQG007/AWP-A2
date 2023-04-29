@extends('layout')

@section('page-name')
    {{ $video->name }} - My Video
@endsection

@section('page-content')

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-9">
            <div class="row">
                <div class="col">
                    <video width="900" height="500" id="videoPlayer" controls @if(!Auth::user() || Auth::user()->id != $video->user_id) controlsList="nodownload" @endif>
                        <source src="{{ asset('uploaded-videos/' . $video->file_unique_name) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-6">
                    <h5>{{ $video->name }}</h5>
                </div>
                <div class="col-auto">
                    <h6>Views:</h6>
                </div>
                <div class="col-auto">
                    <p>{{ $video->views }}</p>
                </div>
                <div class="col-auto">
                    <h6>Uploaded By:</h6>
                </div>
                <div class="col-auto">
                    <p>{{ $video->user->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-9 text-dark">
                    @if(!$video->description)
                        <p>No description available</p>
                    @else
                        <p>{{ $video->description }}</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-3">
            <h5 class="text-start">Related Videos</h5>
            <div class="row">
                @if($videos->count() <= 0)
                    <h6 class="text-center mt-5">No similar videos available.</h6>
                @else
                    @foreach($videos as $video)
                        <div class="row">
                            <div class="col-4">
                                <a href="{{ route('video.show', ['video' => $video]) }}" class="text-decoration-none link-dark">
                                    <video width="100" height="100" id="videoPlayer">
                                        <source src="{{ asset('uploaded-videos/' . $video->file_unique_name) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </a>
                            </div>
                            <div class="col-7 mt-4">
                                <a href="{{ route('video.show', ['video' => $video]) }}" class="text-decoration-none link-dark">
                                    <p>{{ $video->name }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

@endsection