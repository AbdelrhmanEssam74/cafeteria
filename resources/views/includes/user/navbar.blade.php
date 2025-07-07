    <!-- Start Header/Navigation -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark fixed-top"
        style="background-color: #3a2e1f; box-shadow: 0 2px 10px rgba(0,0,0,0.1);" aria-label="Brew Haven navigation bar">

        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span style="color: #eba439; opacity: 1;">Brew</span><span
                    style="color: rgb(216, 214, 214); opacity: 1;">Haven</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsBrewHaven"
                aria-controls="navbarsBrewHaven" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsBrewHaven">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                                <span class="nav-link-content">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('menu') ? 'active' : '' }}" href="{{ url('/menu') }}">
                                <span class="nav-link-content">Menu</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                                href="{{ url('/about') }}">
                                <span class="nav-link-content">About</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                                href="{{ url('/contact') }}">
                                <span class="nav-link-content">Contact</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            @auth
                                <a class="nav-link {{ request()->is('orders*') ? 'active' : '' }}"
                                    href="{{ route('user.orders.index') }}">
                                    <span class="nav-link-content"> My Orders</span>

                                </a>
                            @endauth
                        </li>
                </ul>


                <!-- Rest of your navbar code remains the same -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <div class="dropdown-divider"></div>
                                @if(auth()->check() && auth()->user()->role === "admin")
                                <a  class="dropdown-item" href="{{route('admin.dashboard')}}">
                                    <i class="fa-regular fa-file-user"></i>
                                    Dashboard
                                </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-3">
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span
                                class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                style="{{ count((array) session('cart')) > 0 ? '' : 'display: none;' }}">
                                {{ array_sum(array_column(session('cart') ?? [], 'quantity')) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
