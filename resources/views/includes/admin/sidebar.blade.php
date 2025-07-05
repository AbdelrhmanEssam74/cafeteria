@section('adminSidebar')
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <!-- Brand with logo -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="fas fa-coffee me-2"></i>
                <span class="fw-bold">{{ config('app.name', 'Café Admin') }}</span>
            </a>

            <!-- Mobile toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar content -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Left side navigation -->
                <ul class="navbar-nav me-auto">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                   href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                                   href="{{ route('users.index') }}">
                                    <i class="fas fa-users me-1"></i> Users
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}"
                                   href="{{ route('products.index') }}">
                                    <i class="fas fa-coffee me-1"></i> Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('categories.index') ? 'active' : '' }}"
                                   href="{{ route('categories.index') }}">
                                    <i class="fas fa-tags me-1"></i> Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}"
                                   href="{{ route('orders.index') }}">
                                    <i class="fas fa-list-alt me-1"></i> Orders
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="#home">
                                    <i class="fas fa-home me-1"></i> Home
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Right side navigation -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-light me-2" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt me-1"></i> {{ __('Login') }}
                                </a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link btn btn-light text-primary" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus me-1"></i> {{ __('Register') }}
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img
                                    src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=fff&color=5D4037' }}"
                                    class="rounded-circle me-2" width="32" height="32" alt="{{ Auth::user()->name }}">
                                <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
@endsection
