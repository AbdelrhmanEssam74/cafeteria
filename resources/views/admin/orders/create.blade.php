@extends('layouts.app')

@section('title', 'Create Order')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/create-order.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/nav.css') }}">
@endsection
@section('navbar')
    @include('includes.admin.sidebar')
@endsection
@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Create New Order</h2>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Orders
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h5 class="alert-heading">Please fix these errors:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('orders.store') }}" class="bg-white p-4 rounded shadow-sm">
            @csrf

            <!-- User Selection -->
            <div class="mb-4">
                <label class="form-label fw-bold">Select Customer</label>
                <select name="user_id" class="form-select form-select-lg" required>
                    <option value="">Choose Customer...</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} (Room: {{ $user->room_number ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Search for customer by name or room number</small>
            </div>

            <hr class="my-4">

            <!-- Product Selection -->
            <h5 class="mb-3 fw-bold">Select Products</h5>

            <!-- Category Filter -->
            <div class="mb-4">
                <label class="form-label">Filter by Category:</label>
                <select id="categoryFilter" class="form-select">
                    <option value="all">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="cat-{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row g-4 product-grid">
                @foreach ($products as $product)
                    <div class="col-md-4 col-lg-3 product-card" data-category="cat-{{ $product->category_id }}">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="position-relative">
                                @if ($product->image)
                                    <img src="{{ asset($product->image) }}" class="card-img-top"
                                        alt="{{ $product->name }}" style="height: 180px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                        style="height: 180px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-primary">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-muted mb-2">
                                    {{ Str::limit($product->description, 60) }}
                                </p>
                                <div class="mt-auto">
                                    <p class="fw-bold text-primary mb-2">
                                        {{ number_format($product->price, 2) }} EGP
                                    </p>

                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary decrement"
                                            data-target="quantity-{{ $product->id }}">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" id="quantity-{{ $product->id }}"
                                            name="products[{{ $loop->index }}][quantity]" class="form-control text-center"
                                            min="0" value="0" data-price="{{ $product->price }}">
                                        <button type="button" class="btn btn-outline-secondary increment"
                                            data-target="quantity-{{ $product->id }}">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="products[{{ $loop->index }}][id]"
                                        value="{{ $product->id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="card mt-4 border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Selected Items:</span>
                        <span id="selected-items-count">0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Quantity:</span>
                        <span id="total-quantity">0</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total Amount:</span>
                        <span id="total-amount">0.00 EGP</span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-check-circle me-2"></i> Submit Order
                </button>
            </div>
        </form>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category filter functionality
            const categoryFilter = document.getElementById('categoryFilter');
            const productCards = document.querySelectorAll('.product-card');

            categoryFilter.addEventListener('change', function() {
                const selectedCategory = this.value;

                productCards.forEach(card => {
                    if (selectedCategory === 'all' || card.dataset.category === selectedCategory) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });

            // Quantity increment/decrement buttons
            document.querySelectorAll('.increment, .decrement').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.dataset.target;
                    const input = document.getElementById(targetId);
                    let value = parseInt(input.value) || 0;

                    if (this.classList.contains('increment')) {
                        value++;
                    } else if (this.classList.contains('decrement') && value > 0) {
                        value--;
                    }

                    input.value = value;
                    updateOrderSummary();
                });
            });

            // Manual quantity input
            document.querySelectorAll('input[type="number"]').forEach(input => {
                input.addEventListener('change', updateOrderSummary);
            });

            // Update order summary
            function updateOrderSummary() {
                let selectedItems = 0;
                let totalQuantity = 0;
                let totalAmount = 0;

                document.querySelectorAll('input[type="number"]').forEach(input => {
                    const quantity = parseInt(input.value) || 0;
                    const price = parseFloat(input.dataset.price) || 0;

                    if (quantity > 0) {
                        selectedItems++;
                        totalQuantity += quantity;
                        totalAmount += quantity * price;
                    }
                });

                document.getElementById('selected-items-count').textContent = selectedItems;
                document.getElementById('total-quantity').textContent = totalQuantity;
                document.getElementById('total-amount').textContent = totalAmount.toFixed(2) + ' EGP';
            }
        });
    </script>
@endsection
