<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Admin</div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('user') }}">User Data</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('driver') }}">Driver Data</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('vehicle') }}">Vehicle Data</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('request') }}">Requests</a>
                  </li>
            </ul>
        </div>
    </nav> 
</div>