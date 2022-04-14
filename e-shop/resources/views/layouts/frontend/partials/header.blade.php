<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <div class="container">
        <a class="navbar-brand {{ Request::is('/') ? 'active' : '' }}"
            href="{{ url('/') }}">{{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/*') ? 'active' : '' }}" href="{{ url('/') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('all-categories') ? 'active' : '' }}"
                        href="{{ route('all-categories') }}">
                        Categories
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('view-wishlist*') ? 'active' : '' }}"
                            href="{{ route('view.wishlist') }}">
                            Wishlist
                            <span class="badge bg-pill bg-primary wishlist-count">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('view-cart*') ? 'active' : '' }}"
                            href="{{ route('view.cart') }}">
                            Cart
                            <span class="badge bg-pill bg-success cart-count">0</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::is('*') ? 'active' : '' }}" href="#"
                            id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hi 👋 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            @if (auth()->user()->role_as === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                                        My Dashboard
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('my.orders') }}">
                                    My Orders
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else

                    <li class="nav-item">
                        <a class="btn btn-primary {{ Request::is('login*') ? 'active' : '' }}"
                            href="{{ url('login') }}">
                            Login
                        </a>
                    </li>

                @endauth
            </ul>

        </div>
    </div>
</nav>
