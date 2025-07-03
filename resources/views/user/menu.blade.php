@extends('layouts.user.master')

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
            <!-- Search and Filter Section -->
            <div class="row mb-4 mt-5">
                <div class="col-md-6 mb-3">
                    <form action="{{ route('menu') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search by name..."
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 mb-3">
                    <form id="priceFilterForm" action="{{ route('menu') }}" method="GET">
                        <div class="input-group">
                            <input type="number" name="min_price" class="form-control" placeholder="Min"
                                value="{{ request('min_price') }}" step="0.01" min="0">
                            <input type="number" name="max_price" class="form-control" placeholder="Max"
                                value="{{ request('max_price') }}" step="0.01" min="0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i> Apply
                            </button>
                            @if (request('min_price') || request('max_price') || request('search'))
                                <a href="{{ route('menu') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Hot Drinks Section -->
            <div class="row mb-5" id="hot-drinks">
                <div class="col-12 text-center mb-4">
                    <h2 class="section-title" style="color: #3a2e1f;">Our Drinks</h2>
                    <p class="lead" style="color: #6d5c4b;">Warm and Cold comforting beverages</p>
                </div>

                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-container" style="height: 250px; overflow: hidden;">
                                <img src="{{ asset('assets/images/' . $product->image) }}"
                                    class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">${{ number_format($product->price, 2) }}</p>
                                <!-- Replace the existing form with this AJAX version -->
                                <form class="add-to-cart-form" data-product-id="{{ $product->id }}">
                                    @csrf
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
                @empty
                    <div class="col-12 text-center py-4">
                        <div class="alert alert-warning">No products found matching your criteria</div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        {{ $products->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <style>
        .product-section {
            background-color: #fff;
        }

        .section-title {
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: #d4a762;
        }

        .card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        /* Improved Pagination Styles */
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .page-item .page-link {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            color: #3a2e1f;
            border: 1px solid #dee2e6;
        }

        .page-item.active .page-link {
            background-color: #d4a762;
            border-color: #d4a762;
            color: white;
        }

        .page-item.disabled .page-link {
            color: #6c757d;
        }

        .image-container {
            position: relative;
        }

        /* Price filter inputs */
        #priceFilterForm .form-control {
            width: 100px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validate price filter form
            document.getElementById('priceFilterForm').addEventListener('submit', function(e) {
                const minPrice = parseFloat(this.elements.min_price.value);
                const maxPrice = parseFloat(this.elements.max_price.value);

                if (minPrice && maxPrice && minPrice > maxPrice) {
                    alert('Minimum price cannot be greater than maximum price');
                    e.preventDefault();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Handle add to cart forms
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
                        .then(response => response.json())
                        // In your menu.blade.php AJAX code
                        .then(data => {
                            if (data.success) {
                                // Show success feedback
                                button.innerHTML = '<i class="fas fa-check me-2"></i> Added!';

                                // Update cart count
                                updateCartCount(data.cart_count);

                                // Show toast notification
                                showToast('Added to cart: ${data.product_name}');

                                // Reset button after 2 seconds
                                setTimeout(() => {
                                    button.innerHTML = originalText;
                                    button.disabled = false;
                                }, 2000);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            button.innerHTML = '<i class="fas fa-times me-2"></i> Error';
                            setTimeout(() => {
                                button.innerHTML = originalText;
                                button.disabled = false;
                            }, 2000);
                        });
                });
            });
        });
    </script>
@endsection
