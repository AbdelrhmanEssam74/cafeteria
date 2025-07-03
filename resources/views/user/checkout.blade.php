@extends('layouts.user.master')

@section('title', 'Checkout')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero-checkout">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="intro-excerpt">
                        <h1 class="display-4 mb-3">Secure Checkout</h1>
                        <p class="mb-0">Complete your order with our secure payment system</p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="checkout-steps">
                        <div class="step active">
                            <span class="step-number">1</span>
                            <span class="step-text">Checkout</span>
                        </div>
                        <div class="step-line"></div>
                        <div class="step">
                            <span class="step-number">2</span>
                            <span class="step-text">Confirmation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="checkout-section">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                @csrf
                <div class="row">
                    <!-- Billing Information -->
                    <div class="col-lg-7">
                        <div class="checkout-card">
                            <div class="card-header">
                                <h4><i class="fas fa-user-circle me-2"></i> Billing Information</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name" class="form-label">First Name *</label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                               id="first_name" name="first_name" value="{{ old('first_name', Auth::user()->first_name ?? '') }}" required>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                               id="last_name" name="last_name" value="{{ old('last_name', Auth::user()->last_name ?? '') }}" required>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Street Address *</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                           id="address" name="address" value="{{ old('address') }}" 
                                           placeholder="Street address, apartment, suite, etc." required>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="city" class="form-label">City *</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                               id="city" name="city" value="{{ old('city') }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="state" class="form-label">State *</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror" 
                                               id="state" name="state" value="{{ old('state') }}" required>
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="zip_code" class="form-label">ZIP Code *</label>
                                        <input type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                                               id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required>
                                        @error('zip_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method -->
                        <div class="checkout-card mt-4">
                            <div class="card-header">
                                <h4><i class="fas fa-credit-card me-2"></i> Payment Method</h4>
                            </div>
                            <div class="card-body">
                                <div class="payment-options">
                                    <div class="payment-option">
                                        <input type="radio" id="cash_on_delivery" name="payment_method" value="cash_on_delivery" checked>
                                        <label for="cash_on_delivery" class="payment-label">
                                            <div class="payment-info">
                                                <i class="fas fa-money-bill-wave payment-icon"></i>
                                                <div>
                                                    <strong>Cash on Delivery</strong>
                                                    <p>Pay when your order arrives</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="payment-option">
                                        <input type="radio" id="credit_card" name="payment_method" value="credit_card">
                                        <label for="credit_card" class="payment-label">
                                            <div class="payment-info">
                                                <i class="fas fa-credit-card payment-icon"></i>
                                                <div>
                                                    <strong>Credit Card</strong>
                                                    <p>Pay securely with your credit card</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>

                                    <div class="payment-option">
                                        <input type="radio" id="paypal" name="payment_method" value="paypal">
                                        <label for="paypal" class="payment-label">
                                            <div class="payment-info">
                                                <i class="fab fa-paypal payment-icon"></i>
                                                <div>
                                                    <strong>PayPal</strong>
                                                    <p>Pay with your PayPal account</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Notes -->
                        <div class="checkout-card mt-4">
                            <div class="card-header">
                                <h4><i class="fas fa-sticky-note me-2"></i> Order Notes (Optional)</h4>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="notes" rows="3" 
                                          placeholder="Special instructions for your order...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-5">
                        <div class="order-summary-card">
                            <div class="card-header">
                                <h4><i class="fas fa-receipt me-2"></i> Order Summary</h4>
                            </div>
                            <div class="card-body">
                                <!-- Cart Items -->
                                <div class="order-items">
                                    @foreach ($cartItems as $item)
                                        <div class="order-item">
                                            <div class="item-image">
                                                @if ($item['image'])
                                                    <img src="{{ asset('assets/images/' . $item['image']) }}" alt="{{ $item['name'] }}">
                                                @else
                                                    <div class="no-image">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="item-details">
                                                <h6>{{ $item['name'] }}</h6>
                                                <p>Qty: {{ $item['quantity'] }}</p>
                                            </div>
                                            <div class="item-price">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <hr class="my-4">

                                <!-- Price Breakdown -->
                                <div class="price-breakdown">
                                    <div class="price-row">
                                        <span>Subtotal</span>
                                        <span>${{ number_format($subtotal, 2) }}</span>
                                    </div>
                                    <div class="price-row">
                                        <span>Shipping</span>
                                        <span class="text-success">Free</span>
                                    </div>
                                    <div class="price-row">
                                        <span>Tax (10%)</span>
                                        <span>${{ number_format($tax, 2) }}</span>
                                    </div>
                                    <hr>
                                    <div class="price-row total-row">
                                        <strong>Total</strong>
                                        <strong>${{ number_format($total, 2) }}</strong>
                                    </div>
                                </div>

                                <!-- Place Order Button -->
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg" id="place-order-btn">
                                        <i class="fas fa-lock me-2"></i>
                                        Place Order
                                        <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
                                    </button>
                                </div>

                                <div class="security-badges mt-3">
                                    <div class="text-center">
                                        <small class="text-muted">
                                            <i class="fas fa-shield-alt me-1"></i>
                                            Your information is secure and encrypted
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .hero-checkout {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-checkout::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        .hero-checkout .container {
            position: relative;
            z-index: 2;
        }

        .checkout-steps {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .step.active .step-number {
            background: #fff;
            color: #667eea;
        }

        .step-line {
            width: 50px;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
            margin: 0 1rem;
        }

        .step-text {
            font-size: 0.9rem;
        }

        .checkout-section {
            padding: 4rem 0;
            background: #f8f9fa;
        }

        .checkout-card, .order-summary-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
        }

        .checkout-card .card-header, .order-summary-card .card-header {
            background: linear-gradient(135deg, #3b5d50 0%, #2d4a3e 100%);
            color: white;
            padding: 1.5rem;
            border: none;
        }

        .checkout-card .card-header h4, .order-summary-card .card-header h4 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .checkout-card .card-body, .order-summary-card .card-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #3b5d50;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3b5d50;
            box-shadow: 0 0 0 0.2rem rgba(59, 93, 80, 0.15);
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .payment-option {
            position: relative;
        }

        .payment-option input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .payment-label {
            display: block;
            padding: 1.5rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 0;
        }

        .payment-option input[type="radio"]:checked + .payment-label {
            border-color: #3b5d50;
            background: rgba(59, 93, 80, 0.05);
        }

        .payment-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .payment-icon {
            font-size: 1.5rem;
            color: #3b5d50;
            width: 30px;
        }

        .payment-info strong {
            color: #3b5d50;
            font-size: 1.1rem;
        }

        .payment-info p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .order-items {
            max-height: 300px;
            overflow-y: auto;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            width: 100%;
            height: 100%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

        .item-details {
            flex: 1;
        }

        .item-details h6 {
            margin: 0 0 0.25rem 0;
            font-size: 0.95rem;
            color: #3b5d50;
            font-weight: 600;
        }

        .item-details p {
            margin: 0;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .item-price {
            font-weight: 600;
            color: #3b5d50;
        }

        .price-breakdown {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .price-row:last-child {
            margin-bottom: 0;
        }

        .total-row {
            font-size: 1.1rem;
            color: #3b5d50;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b5d50 0%, #2d4a3e 100%);
            border: none;
            border-radius: 10px;
            padding: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2d4a3e 0%, #1e3128 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 93, 80, 0.3);
        }

        .security-badges {
            text-align: center;
            padding-top: 1rem;
            border-top: 1px solid #f1f3f4;
        }

        @media (max-width: 768px) {
            .checkout-steps {
                margin-top: 2rem;
            }
            
            .step-line {
                width: 30px;
                margin: 0 0.5rem;
            }
            
            .checkout-section {
                padding: 2rem 0;
            }
            
            .checkout-card .card-body, .order-summary-card .card-body {
                padding: 1.5rem;
            }
        }
    </style>

    <script>
        document.getElementById('checkout-form').addEventListener('submit', function() {
            const btn = document.getElementById('place-order-btn');
            const spinner = btn.querySelector('.spinner-border');
            
            btn.disabled = true;
            spinner.classList.remove('d-none');
            btn.innerHTML = '<i class="fas fa-lock me-2"></i>Processing...<span class="spinner-border spinner-border-sm ms-2" role="status"></span>';
        });

        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection