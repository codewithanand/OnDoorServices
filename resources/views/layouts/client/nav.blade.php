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
            <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
            <a href="about.html" class="nav-item nav-link">About</a>
            <a href="service.html" class="nav-item nav-link">Service</a>
            <a href="project.html" class="nav-item nav-link">Blog </a>
            <a href="contact.html" class="nav-item nav-link">Contact</a>
        </div>
        <div class="navbar-nav">
            @guest
                <a href="{{ route('register') }}" class="btn rounded-pill py-2 px-4 ms-3 ">Get Started</a>
                <a href="{{ route('login') }}" class="btn rounded-pill py-2 px-4 ms-3 ">Login</a>
            @else
                @if (auth()->user()->role == '0')
                    <a href="{{ url('/cart') }}" class="nav-item nav-link"><i class="fas fa-shopping-cart"></i> Cart</a>
                @endif
                @php
                    $service_partners = [];
                    $services = [];
                @endphp
                @if (auth()->user()->role == '2')
                    @php
                        $service_partners = App\Models\ServicePartner::where('user_id', auth()->user()->id)->first();
                    @endphp
                @endif
                @if (auth()->user()->role == '2' && $service_partners)
                    @php
                        $services = App\Models\Service::where('service_partner_id', $service_partners->id)->get();
                    @endphp
                @endif
                @if (auth()->user()->role == '2' && is_null($service_partners))
                    <a href="{{ url('/register/partner') }}" class="nav-item nav-link ">Collaborate</a>
                @endif
                @if (auth()->user()->role == '2' && $services && count($services) == 0)
                    <a href="{{ url('/partner/services/add') }}" class="nav-item nav-link ">Add Service</a>
                @endif
                <div class="dropdown">
                    <a class="nav-item nav-link" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        @if (auth()->user()->role == '2')
                            <li><a class="dropdown-item" href="{{ url('/partner/dashboard') }}">Dashboard</a></li>
                        @elseif(auth()->user()->role == '1')
                            <li><a class="dropdown-item" href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ url('/profile') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="">Order</a></li>
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
