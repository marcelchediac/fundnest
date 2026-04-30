<nav class="navbar navbar-expand-lg navbar-light shadow-sm" 
     style="background: linear-gradient(90deg,#4e54c8,#8f94fb);">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-white" href="{{ route('home') }}">FundNest</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarContent" aria-controls="navbarContent" 
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item mx-2">
          <a class="nav-link fw-semibold px-3 py-2 rounded text-white {{ request()->routeIs('home') ? 'bg-dark' : '' }}" 
             href="{{ route('home') }}">Home</a>
        </li>


        <li class="nav-item mx-2">
         <a class="nav-link fw-semibold px-3 py-2 rounded text-white {{ request()->routeIs('home') ? 'bg-dark' : '' }}" 
             href="{{ route('campaign.create') }}">Campaign</a>
        </li>


       <li class="nav-item mx-2">
        <li class="nav-item mx-2">
          <a class="nav-link fw-semibold px-3 py-2 rounded text-white {{ request()->routeIs('home') ? 'bg-dark' : '' }}" 
             href="{{route('about')}}">About</a>
        </li>
      </ul>

      <div class="d-flex align-items-center">
        @guest
        <a class="btn btn-outline-light me-2" href="{{ route('RegisterAction') }}">Register</a>
          <a class="btn btn-outline-light me-2" href="{{ route('LoginAction') }}">Login</a>
        @endguest
</div>

        @auth
          <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
        @endauth
        
        @auth 
          @if(auth()->user()->role === 'admin')
        <li class="nav-item mx-2">
        <a class="nav-link fw-semibold px-3 py-2 rounded text-white {{ request()->routeIs('home') ? 'bg-dark' : '' }}" 
             href="{{route('admin.campaigns')}}">Admin Dashboard</a>
              @endif
        </li>
            @endauth
        
      </div>
    </div>
  </div>
</nav>
