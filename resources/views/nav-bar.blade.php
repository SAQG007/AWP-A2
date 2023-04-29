<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="@if(Auth::check()) {{ route('dashboard') }} @else {{ route('video.index') }} @endif">My Video</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <form class="d-flex" action="{{ route('video.search') }}" method="POST">
        @csrf
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="searchButton" name="searchField" style="width: 300px" required @if(isset($key)) value="{{ $key }}" @endif>
          <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
        </div>
      </form>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex ms-auto">
            @if(Auth::check())
                <a href="{{ route('video.create') }}" class="text-decoration-none link-secondary me-3">Upload Video</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="logout" class="text-decoration-none link-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-decoration-none link-secondary me-3">Login</a>
                <a href="{{ route('register') }}" class="text-decoration-none link-secondary">Register</a>
            @endif
        </div>
    </div>
  </div>
</nav>
