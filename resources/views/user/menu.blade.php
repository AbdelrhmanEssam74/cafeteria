@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user/menu.css') }}">
@endsection
@section('navbar')
    @include('includes.user.navbar')
@endsection
@section('title', 'Our Menu - Brew Haven')
@section('content')
    <!-- Start Hero Section -->
    <div class="hero vh-100" style="background-color: #f8f5f0;">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <div class="intro-excerpt">
                        <h1 style="color: #3a2e1f; font-weight: 700;">Our Beverage Selection</h1>
                        <p class="mb-4 lead" style="color: #6d5c4b;">Explore our carefully crafted menu featuring specialty
                            coffees, refreshing teas, and signature drinks made with premium ingredients.</p>
                        <div class="d-flex gap-3">
                            <a href="#hot-drinks" class="btn btn-primary px-4"
                                style="background-color: #d4a762; border: none;">Hot Drinks</a>
                            <a href="#cold-drinks" class="btn btn-outline-dark px-4">Cold Drinks</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-img-wrap">
                        <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                            alt="Barista preparing coffee" class="img-fluid rounded shadow-lg"
                            style="border: 8px solid white;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->
    <!-- Start Menu Categories -->
    <div class="product-section py-5">
        <div class="container mt-3">
            <!-- Enhanced Category Filter Section -->
            <div class="row mb-4">
                <!-- Category Filter Dropdown -->
                <div class="col-md-6 mb-3">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="categoryDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false"
                            style="background-color: #d4a762; border-color: #d4a762;">
                            <i class="fas fa-tags me-2"></i>
                            {{ request('category') ? $categories->firstWhere('id', request('category'))->name : 'All Categories' }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                            <li>
                                <a class="dropdown-item {{ !request('category') ? 'active' : '' }}"
                                    href="{{ route('menu', array_merge(request()->except(['category', 'page']))) }}">
                                    <i class="fas fa-list me-2"></i> All Categories
                                </a>
                            </li>
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item {{ request('category') == $category->id ? 'active' : '' }}"
                                        href="{{ route('menu', array_merge(request()->except(['category', 'page']), ['category' => $category->id])) }}">
                                        <i class="fas fa-{{ $category->image ?? 'coffee' }} me-2"></i> {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Price Filter Form -->
                <div class="col-md-6 mb-3">
                    <form id="priceFilterForm" action="{{ route('menu') }}" method="GET" class="d-flex gap-2">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">

                        <div class="input-group">
                            <span class="input-group-text" style="background-color: #f8f5f0; border-color: #d4a762;">
                                <i class="fas fa-dollar-sign"></i>
                            </span>
                            <input type="number" name="min_price" class="form-control" placeholder="Min"
                                value="{{ request('min_price') }}" step="0.01" min="0"
                                style="border-color: #d4a762;">
                            <span class="input-group-text"
                                style="background-color: #f8f5f0; border-color: #d4a762;">to</span>
                            <input type="number" name="max_price" class="form-control" placeholder="Max"
                                value="{{ request('max_price') }}" step="0.01" min="0"
                                style="border-color: #d4a762;">
                            <button type="submit" class="btn btn-primary"
                                style="background-color: #d4a762; border-color: #d4a762;">
                                <i class="fas fa-filter"></i>
                            </button>
                            @if (request('min_price') || request('max_price'))
                                <a href="{{ route('menu', array_merge(request()->except(['min_price', 'max_price', 'page']))) }}"
                                    class="btn btn-outline-secondary" style="border-color: #6d5c4b;">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search Form -->
            <div class="row mb-4">
                <div class="col-12">
                    <form action="{{ route('menu') }}" method="GET" class="d-flex gap-2">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                        <input type="hidden" name="max_price" value="{{ request('max_price') }}">

                        <div class="input-group flex-grow-1">
                            <span class="input-group-text" style="background-color: #f8f5f0; border-color: #d4a762;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control" placeholder="Search by name..."
                                value="{{ request('search') }}" style="border-color: #d4a762;">
                            <button type="submit" class="btn btn-primary"
                                style="background-color: #d4a762; border-color: #d4a762;">
                                Search
                            </button>
                            @if (request('search'))
                                <a href="{{ route('menu', array_merge(request()->except(['search', 'page']))) }}"
                                    class="btn btn-outline-secondary" style="border-color: #6d5c4b;">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Dynamic Title Section -->
            <div class="col-12 text-center mb-4">
                <h2 class="section-title">
                    @if (request('category'))
                        <span class="category-title">
                            <i
                                class="fas fa-{{ $categories->firstWhere('id', request('category'))->slug ?? 'tag' }} me-2"></i>
                            {{ $categories->firstWhere('id', request('category'))->name }} Selection
                        </span>
                    @else
                        <span class="main-title">
                            <i class="fas fa-coffee me-2"></i>
                            Our Complete Beverage Menu
                        </span>
                    @endif
                </h2>

                {{-- <p class="lead mb-0">
                    @if (request('category'))
                        <span class="category-description">
                            {{ $categories->firstWhere('id', request('category'))->description ?? 'Handcrafted with care' }}
                        </span>
                    @else
                        <span class="main-description">
                            Discover our wide range of warm and cold beverages
                        </span>
                    @endif
                </p> --}}
            </div>

            <!-- Products Grid -->
            <div class="container">
                <div class="row">
                    @forelse($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 product-card" data-product-id="{{ $product->id }}">
                                <div class="image-container">
                                    <img src="{{ asset('/' . $product->image) }}" class="card-img-top"
                                        alt="{{ $product->name }}">
                                </div>
                                <div class="card-body">
                                    <h5 class="product-name">{{ $product->name }}</h5>
                                    <p class="product-price">${{ number_format($product->price, 2) }}</p>
                                    <span class="product-category">
                                        <i class="fas fa-tag me-1"></i> {{ $product->category->name }}
                                    </span>
                                    <form class="add-to-cart-form" data-product-id="{{ $product->id }}">
                                        @csrf
                                        <div class="input-group">
                                            <input type="number" name="quantity" value="1" min="1"
                                                class="form-control">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-cart-plus me-2"></i> Add to Cart
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-4">
                            <div class="alert alert-warning">No products found matching your criteria</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <div class="row g-0">
                        <div class="col-md-6">
                            <img id="modalProductImage" src="{{asset('assets/images/'. $product->image)}}" class="img-fluid rounded-start h-100"
                                alt="">
                        </div>
                        <div class="col-md-6 p-4">
                            <h3 id="modalProductName" class="mb-3"></h3>
                            <div class="d-flex align-items-center mb-3">
                                <span id="modalProductPrice" class="fs-4 fw-bold me-3"></span>
                                <span id="modalProductCategory" class="badge"></span>
                            </div>
                            <p id="modalProductDescription" class="mb-4"></p>   

                            <form id="modalAddToCartForm" class="mt-auto">
                                @csrf
                                <input type="hidden" id="modalProductId" name="product_id">
                                <div class="input-group mb-3">
                                    <input type="number" name="quantity" value="1" min="1"
                                        class="form-control">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-cart-plus me-2"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex pagination justify-content-center">
        {{ $products->appends(request()->query())->links() }}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modal
            const productModal = new bootstrap.Modal(document.getElementById('productModal'));
            let isModalLoading = false;

            // Click handler for product cards
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Don't trigger if clicking on form elements
                    if (e.target.closest('.add-to-cart-form') ||
                        e.target.tagName === 'INPUT' ||
                        e.target.tagName === 'BUTTON') {
                        return;
                    }

                    const productId = this.getAttribute('data-product-id');
                    loadProductDetails(productId);
                });
            });

            // Function to load product details
            function loadProductDetails(productId) {
                if (isModalLoading) return;
                isModalLoading = true;

                // Set loading state
                document.getElementById('modalProductName').textContent = 'Loading...';
                document.getElementById('modalProductPrice').textContent = '';
                document.getElementById('modalProductCategory').textContent = '';
                // document.getElementById('modalProductDescription').textContent = 'Loading product details...';//
                document.getElementById('modalProductImage').innerHTML =
                    '<div class="spinner-border text-warning"></div>';

                // Show modal
                productModal.show();

                // Fetch product details with error handling
                fetch(`/products/${productId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Check for API-level errors
                        if (data.error) {
                            throw new Error(data.error);
                        }

                        // Update modal content
                        document.getElementById('modalProductName').textContent = data.name;
                        document.getElementById('modalProductPrice').textContent =
                            `$${parseFloat(data.price).toFixed(2)}`;
                        document.getElementById('modalProductCategory').textContent = data.category.name;
                        // document.getElementById('modalProductDescription').textContent =
                        //     data.description || 'No description available';
                        document.getElementById('modalProductId').value = data.id;

                        // Handle image - use placeholder if not found
                        const imageUrl = data.image_exists ?
                            `/assets/images/${data.image}` :
                            '/assets/images/placeholder.jpg';
                        document.getElementById('modalProductImage').src = imageUrl;

                        isModalLoading = false;
                    })
                    .catch(error => {
                        console.error('Error loading product details:', error);
                        // document.getElementById('modalProductDescription').textContent =
                        //     `Error loading product: ${error.message}`;
                        document.getElementById('modalProductImage').src = '/assets/images/placeholder.jpg';
                        isModalLoading = false;
                    });
            }

            // Add to cart functionality for cards
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const productId = this.getAttribute('data-product-id');
                    const quantity = this.querySelector('input[name="quantity"]').value;
                    const button = this.querySelector('button[type="submit"]');
                    const originalText = button.innerHTML;

                    // Show loading state
                    button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Adding...';
                    button.disabled = true;

                    // AJAX request
                    fetch(`/cart/add/${productId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                quantity: quantity
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`Server returned ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                button.innerHTML = '<i class="fas fa-check me-2"></i> Added!';
                                updateCartCount(data.cart_count);
                                showToast(`Added to cart: ${data.product_name}`);
                                setTimeout(() => {
                                    button.innerHTML = originalText;
                                    button.disabled = false;
                                }, 2000);
                            } else {
                                throw new Error(data.message || 'Failed to add to cart');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            button.innerHTML = '<i class="fas fa-times me-2"></i> Error';
                            showToast('Failed to add to cart. Please try again.', 'error');
                            setTimeout(() => {
                                button.innerHTML = originalText;
                                button.disabled = false;
                            }, 2000);
                        });
                });
            });

            // Add to cart functionality for modal
            document.getElementById('modalAddToCartForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const productId = document.getElementById('modalProductId').value;
                const quantity = this.querySelector('input[name="quantity"]').value;
                const button = this.querySelector('button[type="submit"]');
                const originalText = button.innerHTML;

                // Show loading state
                button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Adding...';
                button.disabled = true;

                // AJAX request
                fetch(`/cart/add/${productId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            quantity: quantity
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Server returned ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            button.innerHTML = '<i class="fas fa-check me-2"></i> Added!';
                            updateCartCount(data.cart_count);
                            showToast(`Added to cart: ${data.product_name}`);
                            setTimeout(() => {
                                button.innerHTML = originalText;
                                button.disabled = false;
                                // Close modal after successful add if desired
                                // productModal.hide();
                            }, 2000);
                        } else {
                            throw new Error(data.message || 'Failed to add to cart');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        button.innerHTML = '<i class="fas fa-times me-2"></i> Error';
                        showToast('Failed to add to cart. Please try again.', 'error');
                        setTimeout(() => {
                            button.innerHTML = originalText;
                            button.disabled = false;
                        }, 2000);
                    });
            });

            // Price filter validation
            document.getElementById('priceFilterForm').addEventListener('submit', function(e) {
                const minPrice = parseFloat(this.elements.min_price.value);
                const maxPrice = parseFloat(this.elements.max_price.value);

                if (minPrice && maxPrice && minPrice > maxPrice) {
                    showToast('Minimum price cannot be greater than maximum price', 'error');
                    e.preventDefault();
                }
            });

            // Auto-close dropdown after selection
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    var dropdown = bootstrap.Dropdown.getInstance(document.getElementById(
                        'categoryDropdown'));
                    dropdown.hide();
                });
            });

            // Toast notification function (positioned at bottom)
            function showToast(message, type = 'success') {
                // Create toast element
                const toast = document.createElement('div');
                toast.className =
                    `toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0`;
                toast.setAttribute('role', 'alert');
                toast.setAttribute('aria-live', 'assertive');
                toast.setAttribute('aria-atomic', 'true');

                toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        `;

                // Add to container (create one if it doesn't exist)
                let container = document.getElementById('toastContainer');
                if (!container) {
                    container = document.createElement('div');
                    container.id = 'toastContainer';
                    container.style.position = 'fixed';
                    container.style.bottom = '20px';
                    container.style.right = '20px';
                    container.style.zIndex = '1100';
                    container.style.maxWidth = '100%';
                    document.body.appendChild(container);
                }

                container.appendChild(toast);

                // Initialize and show toast
                const bsToast = new bootstrap.Toast(toast, {
                    autohide: true,
                    delay: 3000
                });
                bsToast.show();

                // Remove after hide
                toast.addEventListener('hidden.bs.toast', function() {
                    toast.remove();
                });
            }

function updateCartCount(count) {
    const cartCountElements = document.querySelectorAll('.cart-count');
    cartCountElements.forEach(el => {
        el.textContent = count;

        // Always show the badge, but change color if empty
        if (count <= 0) {
            el.classList.remove('bg-danger');
            el.classList.add('bg-secondary');
        } else {
            el.classList.remove('bg-secondary');
            el.classList.add('bg-danger');
        }

        // Add animation
        el.classList.add('animate__animated', 'animate__bounceIn');
        setTimeout(() => {
            el.classList.remove('animate__animated', 'animate__bounceIn');
        }, 1000);
    });
}
        });
    </script>
@endsection
@section('footer')
    @include('includes.user.footer')
@endsection
