@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/user/navbar.css') }}">
@endsection

@section('navbar')
    @include('includes.user.navbar')
@endsection

@section('title', 'Cart')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero" style="background-color: #f8f9fa; padding: 80px 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="intro-excerpt">
                        <h1 class="display-4 mb-3" style="color: #3b5d50; font-weight: 700;">Your Shopping Cart</h1>
                        <p class="mb-0 fs-5" style="color: #32453d;">Review and manage your items before checkout</p>
                    </div>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                        alt="Shopping Cart" class="img-fluid" style="max-height: 200px; border-radius: 8px;">
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Toast Notification -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="cartToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Cart Update</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <div class="untree_co-section pt-0">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (count($cartItems) > 0)
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $id => $item)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    @if ($item['image'])
                                                        <img src="{{ asset('/' . $item['image']) }}" width="80"
                                                            class="me-4 rounded">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                        <small class="text-muted">SKU: {{ $item['sku'] ?? 'N/A' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ number_format($item['price'], 2) }}</td>
                                            <td>
                                                <form class="quantity-form" data-item-id="{{ $id }}">
                                                    @csrf
                                                    <div class="input-group" style="width: 140px;">
                                                        <!-- Increased width from 120px to 140px -->
                                                        <button class="btn btn-outline-secondary minus-btn"
                                                            type="button">-</button>
                                                        <input type="number" name="quantity"
                                                            value="{{ $item['quantity'] }}" min="1"
                                                            class="form-control text-center quantity-input"
                                                            style="min-width: 50px;"> <!-- Added min-width -->
                                                        <button class="btn btn-outline-secondary plus-btn"
                                                            type="button">+</button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="item-total">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                            <td class="text-end pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteModal-{{ $id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel-{{ $id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="deleteModalLabel-{{ $id }}">
                                                            <i class="fas fa-exclamation-triangle me-2"></i> Confirm Removal
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex align-items-center mb-4">
                                                            <div class="flex-shrink-0 me-3">
                                                                <i class="fas fa-question-circle text-danger fa-3x"></i>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="mb-1">Remove this item from your cart?</h5>
                                                                <p class="mb-0">{{ $item['name'] }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="alert alert-warning">
                                                            <i class="fas fa-info-circle me-2"></i> This action cannot be
                                                            undone.
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt me-1"></i> Remove Item
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Coupon Code</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter coupon code">
                                    <button class="btn btn-outline-primary" type="button">Apply</button>
                                </div>
                                <p class="text-muted small mt-2">Have a discount code? Enter it here.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Order Summary</h5>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Subtotal</span>
                                    <span class="cart-subtotal">${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Shipping</span>
                                    <span class="text-success">Free</span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span>Tax</span>
                                    <span class="cart-tax">${{ number_format($total * 0.1, 2) }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold">
                                    <span>Total</span>
                                    <span class="cart-total">${{ number_format($total * 1.1, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-3 mt-4">
                            <!-- Continue Shopping Button (full width) -->
                            <a href="{{ route('menu') }}" class="btn btn-outline-secondary py-2">
                                <i class="fas fa-chevron-left me-2"></i> Continue Shopping
                            </a>

                            <!-- Checkout Form -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i> Delivery Details
                                    </h5>

                                    <form action="{{ route('cart.storeOrder') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="room_number" class="form-label fw-medium">Room Number</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light">
                                                    <i class="fas fa-door-open text-muted"></i>
                                                </span>
                                                <input type="text" class="form-control" id="room_number"
                                                    name="room_number" placeholder="e.g., 305, 4B, etc." required
                                                    style="border-left: 0">
                                            </div>
                                            <small class="text-muted">Where should we deliver your order?</small>
                                        </div>

                                        <div class="d-flex gap-2 mt-4">
                                            <!-- Clear Cart Button -->
                                            <button type="button" class="btn btn-outline-danger py-2 flex-grow-1"
                                                data-bs-toggle="modal" data-bs-target="#clearCartModal">
                                                <i class="fas fa-trash me-2"></i> Clear Cart
                                            </button>

                                            <!-- Place Order Button -->
                                            <button type="submit" class="btn btn-primary py-2 flex-grow-1">
                                                <i class="fas fa-check-circle me-2"></i> Place Order
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-shopping-cart fa-4x text-muted"></i>
                    </div>
                    <h3 class="mb-3">Your cart is empty</h3>
                    <p class="text-muted mb-4">Looks like you haven't added any items to your cart yet.</p>
                    <a href="{{ route('menu') }}" class="btn btn-primary">
                        <i class="fas fa-utensils me-2"></i> Browse Menu
                    </a>
                </div>
            @endif
        </div>
    </div>






    <!-- Clear Cart Confirmation Modal -->
    <div class="modal fade" id="clearCartModal" tabindex="-1" aria-labelledby="clearCartModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="clearCartModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i> Confirm Clear Cart
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 me-3">
                            <i class="fas fa-shopping-cart text-danger fa-3x"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">Clear your entire shopping cart?</h5>
                            <p class="mb-0">This will remove all {{ count($cartItems) }} items from
                                your cart.</p>
                        </div>
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle me-2"></i> This action cannot be undone. All items
                        will be permanently removed.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary py-2 px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <form action="{{ route('cart.clear') }}" method="POST" class="flex-grow-1">
                        @csrf
                        <button type="submit" class="btn btn-danger py-2 w-100">
                            <i class="fas fa-trash-alt me-1"></i> Yes, Clear Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* Enhanced form styles */
        .card .card-body {
            padding: 1.5rem;
        }

        .form-label {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: 0;
        }

        .input-group input:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        .input-group input:focus+.input-group-text {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* Button enhancements */
        .btn-outline-danger {
            transition: all 0.3s ease;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .d-flex.gap-2 {
                flex-direction: column;
                gap: 0.75rem !important;
            }

            .flex-grow-1 {
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartToast = new bootstrap.Toast(document.getElementById('cartToast'));

            // Function to show toast notification
            function showToast(message) {
                const toastBody = document.querySelector('#cartToast .toast-body');
                toastBody.textContent = message;
                cartToast.show();
            }

            // Function to update cart totals
            function updateCartTotals(response) {
                if (response.subtotal) {
                    document.querySelector('.cart-subtotal').textContent = '$' + response.subtotal.toFixed(2);
                    document.querySelector('.cart-tax').textContent = '$' + (response.subtotal * 0.1).toFixed(2);
                    document.querySelector('.cart-total').textContent = '$' + (response.subtotal * 1.1).toFixed(2);
                }
            }

            // Function to update cart badge count
            function updateCartBadgeCount(newCount) {
                const cartBadge = document.querySelector('.cart-count');
                if (cartBadge) {
                    cartBadge.textContent = newCount;
                    cartBadge.style.display = newCount > 0 ? '' : 'none';
                }
            }

            // Modify the handleQuantityChange function to update the cart count
            function handleQuantityChange(itemId, newQuantity) {
                const formData = new FormData();
                formData.append('_token', document.querySelector('input[name="_token"]').value);
                formData.append('quantity', newQuantity);

                fetch(`/cart/update/${itemId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update the item total
                            const itemTotalElement = document.querySelector(`form[data-item-id="${itemId}"]`)
                                .closest('tr').querySelector('.item-total');
                            if (itemTotalElement) {
                                itemTotalElement.textContent = '$' + (data.item_price * newQuantity).toFixed(2);
                            }

                            // Update cart totals
                            updateCartTotals(data);

                            // Update cart badge count
                            if (data.cart_count !== undefined) {
                                updateCartBadgeCount(data.cart_count);
                            }

                            // Show appropriate toast message
                            const action = newQuantity > parseInt(itemTotalElement.dataset.prevQuantity ||
                                newQuantity) ? 'increased' : 'decreased';
                            showToast(`Item quantity ${action} successfully.`);
                        } else {
                            showToast(data.message || 'Error updating cart.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('An error occurred while updating the cart.');
                    });
            }

            // Quantity input change event
            document.querySelectorAll('.quantity-input').forEach(input => {
                // Store initial quantity
                input.dataset.prevQuantity = input.value;

                input.addEventListener('change', function() {
                    const itemId = this.closest('form').dataset.itemId;
                    const newQuantity = parseInt(this.value);

                    if (newQuantity < 1) {
                        this.value = 1;
                        return;
                    }

                    handleQuantityChange(itemId, newQuantity);
                    this.dataset.prevQuantity = newQuantity;
                });
            });

            // Minus button click event
            document.querySelectorAll('.minus-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.nextElementSibling;
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                        input.dispatchEvent(new Event('change'));
                    }
                });
            });

            // Plus button click event
            document.querySelectorAll('.plus-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    input.value = parseInt(input.value) + 1;
                    input.dispatchEvent(new Event('change'));
                });
            });
        });
    </script>
@endsection

@section('footer')
    @include('includes.user.footer')
@endsection