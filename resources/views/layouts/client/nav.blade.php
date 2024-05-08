<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
    <a href="{{ url('/') }}" class="navbar-brand p-0">
        <h1 class="m-0">DoorIn</h1>
        <!-- <img src="img/logo.png" alt="Logo"> -->
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto py-0">
            <a href="{{ url('/') }}" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Home</a>
            <a href="{{ url('/services') }}" class="nav-item nav-link">Services</a>
            <a href="{{ url('/jobs') }}" class="nav-item nav-link">Jobs</a>
            <a href="about.html" class="nav-item nav-link">About</a>
            <a href="contact.html" class="nav-item nav-link">Contact</a>
        </div>
        <div class="navbar-nav">
            @guest
                <a href="{{ url('/service/request/call') }}" class="btn rounded-pill py-2 px-4 ms-3 ">Request Call</a>
                <a href="{{ route('login') }}" class="btn rounded-pill py-2 px-4 ms-3 ">Login</a>
            @else
                <div class="dropdown">
                    <a class="nav-item nav-link {{ Request::is('freelancer/dashboard') ? 'active' : '' }}" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu">
                        @if (auth()->user()->role == 0)
                            <li><a class="dropdown-item" href="{{ url('/freelancer/dashboard') }}">Dashboard</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            @endguest
        </div>
    </div>
</nav>
<!-- Navbar & Hero End -->
