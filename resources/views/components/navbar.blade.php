<nav
    class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
    data-aos="fade-down"
>
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ url('/images/logo.svg') }}" alt="" />
        </a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories') }}" class="nav-link {{ request()->is('categories') ? 'active' : '' }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Rewards</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Sign up</a>
                    </li>
                    <li class="nav-item">
                        <a
                            href="{{ route('login') }}"
                            class="nav-link btn btn-success px-4 text-white"
                        >Sign in</a
                        >
                    </li>
                @endguest
            </ul>

            @auth

                <!-- desktop menu -->
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a
                            href="#"
                            class="nav-link"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                        >
                            <img
                                src="{{ url('/images/icon-user.png') }}"
                                alt="user"
                                class="rounded-circle mr-2 profile-picture"
                            />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            @if(Auth::user()->roles == 'ADMIN')
                                <a href="{{ route('admin') }}" class="dropdown-item">Admin Dashboard</a>
                            @endif
                            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                            <a href="/" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                            @php
                                $carts = \App\Models\Cart::where('user_id', Auth::user()->id)->count();
                            @endphp
                            @if($carts > 0)
                                <img src="{{ url('/images/icon-cart-filled.svg') }}" alt="cart" />
                                <span class="card-badge">{{ $carts }}</span>
                            @else
                                <img src="{{ url('/images/icon-cart-empty.svg') }}" alt="cart" />
                            @endif
                        </a>
                    </li>
                </ul>

                <!-- mobile menu -->
                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item dropdown">
                        <a
                            href="#"
                            class="nav-link"
                            id="navbarDropdown"
                            role="button"
                            data-toggle="dropdown"
                        >
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                            <a href="/" class="dropdown-item">Settings</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                            @php
                                $carts = \App\Models\Cart::where('user_id', Auth::user()->id)->count();
                            @endphp
                            @if($carts > 0)
                                <img src="{{ url('/images/icon-cart-filled.svg') }}" alt="cart" />
                                <span class="card-badge">{{ $carts }}</span>
                            @else
                                <img src="{{ url('/images/icon-cart-empty.svg') }}" alt="cart" />
                            @endif
                        </a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
