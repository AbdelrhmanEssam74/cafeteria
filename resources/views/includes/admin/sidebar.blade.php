@section('navbar')
    <nav class="sidebar">
        <!-- Brand -->
        <a href="{{ url('/') }}" class="d-flex align-items-center mb-4 text-decoration-none">
            <i class="fas fa-coffee me-2"></i>
            <span class="fw-bold">{{ config('app.name', 'Café Admin') }}</span>
        </a>

        <!-- Navigation Links -->
        <ul class="nav flex-column mb-4">
            @auth
                @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                            <i class="fas fa-users me-2"></i> Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
                            <i class="fas fa-coffee me-2"></i> Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}"
                            class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
                            <i class="fas fa-tags me-2"></i> Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}"
                            class="{{ request()->routeIs('orders.index') ? 'active' : '' }}">
                            <i class="fas fa-list-alt me-2"></i> Orders
                        </a>
                    </li>
                @else
                    <li>
                        <a href="#" class="">
                            <i class="fas fa-home me-2"></i> Home
                        </a>
                    </li>
                @endif
            @endauth
        </ul>

        <hr>

        <!-- User Dropdown -->
        @auth
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=fff&color=5D4037' }}"
                        alt="{{ Auth::user()->name }}" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu shadow" aria-labelledby="userDropdown">
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                </ul>
            </div>
        @endauth
    </nav>
@endsection
