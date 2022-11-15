<nav
    class="navbar navbar-store navbar-expand-lg navbar-light fixed-top"
    data-aos="fade-down"
>
    <button
        class="btn btn-secondary d-md-none mr-auto mr-2"
        id="menu-toggle"
    >
        &laquo; Menu
    </button>

    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto d-none d-lg-flex">
            <li class="nav-item dropdown">
                <a
                    class="nav-link"
                    href="#"
                    id="navbarDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <img
                        src="{{ url('/images/icon-user.png') }}"
                        alt=""
                        class="rounded-circle mr-2 profile-picture"
                    />
                    Hi, {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('home') }}">Back to Store</a>
                    <a class="dropdown-item" href="{{ route('dashboard.account') }}">Settings</a>
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
        <!-- Mobile Menu -->
        <ul class="navbar-nav d-block d-lg-none mt-3">
            <li class="nav-item">
                <a class="nav-link" href="#"> Hi, {{ Auth::user()->name }} </a>
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
    </div>
</nav>
