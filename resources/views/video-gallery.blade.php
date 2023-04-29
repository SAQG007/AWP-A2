<div class="row row-cols-2">
    @foreach($videos as $video)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card mb-4 shadow-sm" style="max-width: 250px;">
                <a href="{{ route('video.show', ['video' => $video]) }}" class="text-decoration-none link-dark">
                    <video width="100%" height="150" id="videoPlayer">
                        <source src="{{ asset('uploaded-videos/' . $video->file_unique_name) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="card-body">
                        <p class="card-text">{{ $video->name }}</p>
                    </div>
                </a>
                @if(Auth::user() && Auth::user()->id == $video->user_id)
                    <div class="card-footer">
                        <div class="row row-cols-2">
                            <div class="col-lg-6 col-md-4 col-sm-6 text-end">
                                <a href="{{ route('video.edit', ['video' => $video]) }}" class="btn btn-primary text-decoration-none">Edit</a>
                            </div>
                            <div class="col-lg-6 col-md-4 col-sm-6 text-start">
                                <button class="btn btn-danger" type="submit" id="delete-btn-{{ $video->id }}">Delete</button>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.querySelector('#delete-btn-{{ $video->id }}').addEventListener('click', function() {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    // Make an Ajax request to delete the video using the Laravel route
                                    axios.post('{{ route('video.destroy', ['video' => $video]) }}', {
                                        _method: 'DELETE'
                                    }).then((response) => {
                                        Swal.fire(
                                            'Deleted!',
                                            'The video has been deleted.',
                                            'success'
                                        ).then((result) => {
                                            // Reload the page after deletion
                                            window.location.reload();
                                        });
                                    }).catch((error) => {
                                        Swal.fire(
                                            'Error!',
                                            'An error occurred while deleting the video.',
                                            'error'
                                        );
                                    });
                                }
                            })
                        });
                    </script>
                @endif
            </div>
        </div>
    @endforeach
</div>