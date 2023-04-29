@extends('layout')

@section('page-name')
    My Video - Upload
@endsection()

@section('page-content')


<form @if(isset($video)) action={{ route('video.update', ['video' => $video]) }} @else action={{ route('video.store') }} @endif method="POST" enctype="multipart/form-data" id="video-form">
    @csrf
    <div class="container mt-5">
        <span>
            @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
        </span>
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nameInput" placeholder="Name" name="name" @if(isset($video)) value="{{ $video->name }}" @endif required>
                    <label for="nameInput">Name</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label class="mb-2" for="categoryInput">Category</label>
                <select class="form-select form-select-lg mb-3" aria-label="Category" name="category" id="categoryInput" required>
                    <option @if(isset($video) && $video->category == 'sports') selected @endif value="sports">Sports</option>
                    <option @if(isset($video) && $video->category == 'entertainment') selected @endif value="entertainment">Entertainment</option>
                    <option @if(isset($video) && $video->category == 'horror') selected @endif value="horror">Horror</option>
                    <option @if(isset($video) && $video->category == 'fun') selected @endif value="fun">Fun</option>
                    <option @if(isset($video) && $video->category == 'comedy') selected @endif value="comedy">Comedy</option>
                    <option @if(isset($video) && $video->category == 'other') selected @endif value="entertainment" value="other">Other</option>
                </select>
            </div>
            <div class="col">
                <label for="videoInput" class="form-label">Video File @if(isset($video)) (optional) @endif</label>
                <input class="form-control form-control-lg" id="videoInput" type="file" name="file" @if(!isset($video)) required @endif>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-floating">
                    <textarea class="form-control mb-3" placeholder="Description" id="descriptionInput" name="description">@if(isset($video)) {{ $video->description }} @endif</textarea>
                    <label for="descriptionInput">Description</label>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <div class="col text-end">
                <button class="btn btn-primary" @if(isset($video)) id="update-btn" type="button" @else type="submit" @endif>@if(isset($video)) Update @else Upload @endif</button>
            </div>
            <div class="col text-start">
                <button class="btn btn-danger" type="reset">@if(isset($video)) Reset @else Clear @endif</button>
            </div>
        </div>
    </div>
</form>

@if(isset($video))
    <script>
        document.querySelector('#update-btn').addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "All the views of this video will be reverted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!',
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("video-form").submit();
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Video updating cancelled',
                        footer: '<a href="{{ route("dashboard") }}" class="text-decoration-none">Return to dashboard</a>',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                    })
                }
            })
        });
    </script>
@endif

@endsection