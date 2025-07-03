@extends('layouts.user.master')

@section('title', 'Order Confirmation')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero-confirmation">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="success-animation">
                        <div class="checkmark-circle">
                            <div class="checkmark"></div>
                        </div>
                    </div>
                    <div class="intro-excerpt">
                        <h1 class="display-4 mb-3">Order Confirmed!</h1>
                        <p class="lead mb-4">Thank you for your order. We've received your request and will process it shortly.</p>
                        <div class="order-number-badge">
                            <span class="badge">Order #{{ $order->order_number }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="checkout-steps-complete">
                        <div class="step completed">
                            <span class="step-number"><i class="fas fa-check"></i></span>
                            <span class="step-text">Cart</span>
                        </div>
                        <div class="step-line completed"></div>
                        <div class="step completed">
                            <span class="step-number"><i class="fas fa-check"></i></span>
                            <span class="step-text">Checkout</span>
                        </div>
                        <div class="step-line completed"></div>
                        <div class="step active">
                            <span class="step-number"><i class="fas fa-check"></i></span>
                            <span class="step-text">Confirmed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="confirmation-section">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <!-- Order Details -->
                <div class="col-lg-8">
                    <!-- Order Status -->
                    <div class="confirmation-card">
                        <div class="card-header">
                            <h4><i class="fas fa-info-circle me-2"></i> Order Status</h4>
                        </div>
                        <div class="card-body">
                            <div class="status-timeline">
                                <div class="status-item active">
                                    <div class="status-icon">
                                        <i class="fas fa-receipt"></i>
                                    </div>
                                    <div class="status-content">
                                        <h6>Order Placed</h6>
                                        <p>{{ $order->created_at->format('M d, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                                <div class="status-item">
                                    <div class="status-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="status-content">
                                        <h6>Order Confirmed</h6>
                                        <p>We'll confirm your order soon</p>
                                    </div>
                                </div>
                                <div class="status-item">
                                    <div class="status-icon">
                                        <i class="fas fa-utensils"></i>
                                    </div>
                                    <div class="status-content">
                                        <h6>Preparing</h6>
                                        <p>Your order is being prepared</p>
                                    </div>
                                </div>
                                <div class="status-item">
                                    <div class="status-icon">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div class="status-content">
                                        <h6>Out for Delivery</h6>
                                        <p>Your order is on the way</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="confirmation-card mt-4">
                        <div class="card-header">
                            <h4><i class="fas fa-shopping-bag me-2"></i> Order Items</h4>
                        </div>
                        <div class="card-body">
                            <div class="order-items-list">
                                @foreach ($order->orderItems as $item)
                                    <div class="order-item">
                                        <div class="item-image">
                                            @if ($item->product && $item->product->image)
                                                <img src="{{ asset('assets/images/' . $item->product->image) }}" alt="{{ $item->product_name }}">
                                            @else
                                                <div class="no-image">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="item-details">
                                            <h6>{{ $item->product_name }}</h6>
                                            <p class="item-price">${{ number_format($item->product_price, 2) }} × {{ $item->quantity }}</p>
                                        </div>
                                        <div class="item-total">
                                            <strong>${{ number_format($item->total, 2) }}</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Delivery Information -->
                    <div class="confirmation-card mt-4">
                        <div class="card-header">
                            <h4><i class="fas fa-map-marker-alt me-2"></i> Delivery Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-group">
                                        <label>Customer Name</label>
                                        <p>{{ $order->full_name }}</p>
                                    </div>
                                    <div class="info-group">
                                        <label>Phone Number</label>
                                        <p>{{ $order->phone }}</p>
                                    </div>
                                    <div class="info-group">
                                        <label>Email</label>
                                        <p>{{ $order->email }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-group">
                                        <label>Delivery Address</label>
                                        <p>
                                            {{ $order->address }}<br>
                                            {{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}
                                        </p>
                                    </div>
                                    <div class="info-group">
                                        <label>Payment Method</label>
                                        <p>
                                            @if($order->payment_method == 'cash_on_delivery')
                                                <i class="fas fa-money-bill-wave me-1"></i> Cash on Delivery
                                            @elseif($order->payment_method == 'credit_card')
                                                <i class="fas fa-credit-card me-1"></i> Credit Card
                                            @elseif($order->payment_method == 'paypal')
                                                <i class="fab fa-paypal me-1"></i> PayPal
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if($order->notes)
                                <div class="info-group mt-3">
                                    <label>Special Instructions</label>
                                    <p>{{ $order->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="order-summary-card sticky-top">
                        <div class="card-header">
                            <h4><i class="fas fa-receipt me-2"></i> Order Summary</h4>
                        </div>
                        <div class="card-body">
                            <div class="order-summary-details">
                                <div class="summary-row">
                                    <span>Order Number</span>
                                    <strong>{{ $order->order_number }}</strong>
                                </div>
                                <div class="summary-row">
                                    <span>Order Date</span>
                                    <span>{{ $order->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="summary-row">
                                    <span>Status</span>
                                    <span class="badge bg-{{ $order->status_badge }}">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </div>
                                
                                <hr class="my-3">
                                
                                <div class="summary-row">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($order->subtotal, 2) }}</span>
                                </div>
                                <div class="summary-row">
                                    <span>Tax</span>
                                    <span>${{ number_format($order->tax, 2) }}</span>
                                </div>
                                <div class="summary-row">
                                    <span>Shipping</span>
                                    <span class="text-success">Free</span>
                                </div>
                                
                                <hr class="my-3">
                                
                                <div class="summary-row total-row">
                                    <strong>Total</strong>
                                    <strong>${{ number_format($order->total, 2) }}</strong>
                                </div>
                            </div>

                            <div class="action-buttons mt-4">
                                <a href="{{ route('menu') }}" class="btn btn-outline-primary w-100 mb-3">
                                    <i class="fas fa-utensils me-2"></i> Order Again
                                </a>
                                <a href="{{ route('order.history') }}" class="btn btn-secondary w-100 mb-3">
                                    <i class="fas fa-history me-2"></i> Order History
                                </a>
                                <button class="btn btn-outline-secondary w-100" onclick="window.print()">
                                    <i class="fas fa-print me-2"></i> Print Receipt
                                </button>
                            </div>

                            <div class="contact-support mt-4">
                                <div class="text-center">
                                    <h6>Need Help?</h6>
                                    <p class="text-muted small">Contact our support team</p>
                                    <div class="support-contacts">
                                        <a href="tel:+1234567890" class="support-link">
                                            <i class="fas fa-phone"></i> Call Us
                                        </a>
                                        <a href="{{ route('contact') }}" class="support-link">
                                            <i class="fas fa-envelope"></i> Email Us
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hero-confirmation {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-confirmation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        .hero-confirmation .container {
            position: relative;
            z-index: 2;
        }

        .success-animation {
            margin-bottom: 2rem;
        }

        .checkmark-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            margin: 0 auto 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.6s ease-out;
        }

        .checkmark {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            position: relative;
        }

        .checkmark::after {
            content: '';
            position: absolute;
            left: 15px;
            top: 8px;
            width: 8px;
            height: 16px;
            border: solid #28a745;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
            }
            100% {
                transform: scale(1);
            }
        }

        .order-number-badge .badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-size: 1.1rem;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .checkout-steps-complete {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 3rem;
        }

        .checkout-steps-complete .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .checkout-steps-complete .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .checkout-steps-complete .step.completed .step-number,
        .checkout-steps-complete .step.active .step-number {
            background: #fff;
            color: #28a745;
        }

        .checkout-steps-complete .step-line {
            width: 80px;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            margin: 0 1rem;
            border-radius: 2px;
        }

        .checkout-steps-complete .step-line.completed {
            background: #fff;
        }

        .checkout-steps-complete .step-text {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .confirmation-section {
            padding: 4rem 0;
            background: #f8f9fa;
        }

        .confirmation-card, .order-summary-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
        }

        .confirmation-card .card-header, .order-summary-card .card-header {
            background: linear-gradient(135deg, #3b5d50 0%, #2d4a3e 100%);
            color: white;
            padding: 1.5rem;
            border: none;
        }

        .confirmation-card .card-header h4, .order-summary-card .card-header h4 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
        }

        .confirmation-card .card-body, .order-summary-card .card-body {
            padding: 2rem;
        }

        .status-timeline {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-left: 4px solid #e9ecef;
            background: #f8f9fa;
            border-radius: 0 10px 10px 0;
            transition: all 0.3s ease;
        }

        .status-item.active {
            border-left-color: #28a745;
            background: rgba(40, 167, 69, 0.1);
        }

        .status-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            flex-shrink: 0;
        }

        .status-item.active .status-icon {
            background: #28a745;
            color: white;
        }

        .status-content h6 {
            margin: 0 0 0.25rem 0;
            color: #3b5d50;
            font-weight: 600;
        }

        .status-content p {
            margin: 0;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .order-items-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .order-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .item-image {
            width: 70px;
            height: 70px;
            border-radius: 10px;
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
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
        }

        .item-details {
            flex: 1;
        }

        .item-details h6 {
            margin: 0 0 0.5rem 0;
            color: #3b5d50;
            font-weight: 600;
        }

        .item-price {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }

        .item-total {
            font-weight: 600;
            color: #3b5d50;
            font-size: 1.1rem;
        }

        .info-group {
            margin-bottom: 1rem;
        }

        .info-group label {
            display: block;
            font-weight: 600;
            color: #3b5d50;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }

        .info-group p {
            color: #6c757d;
            margin: 0;
        }

        .order-summary-details {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }

        .summary-row:last-child {
            margin-bottom: 0;
        }

        .total-row {
            font-size: 1.1rem;
            color: #3b5d50;
        }

        .action-buttons .btn {
            border-radius: 10px;
            font-weight: 500;
        }

        .contact-support {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
        }

        .support-contacts {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .support-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #3b5d50;
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }

        .support-link:hover {
            color: #28a745;
        }

        .support-link i {
            font-size: 1.2rem;
            margin-bottom: 0.25rem;
        }

        .sticky-top {
            top: 2rem;
        }

        @media (max-width: 768px) {
            .checkout-steps-complete {
                flex-direction: column;
                gap: 1rem;
            }
            
            .checkout-steps-complete .step-line {
                width: 3px;
                height: 40px;
                margin: 0.5rem 0;
            }
            
            .confirmation-section {
                padding: 2rem 0;
            }
            
            .confirmation-card .card-body, .order-summary-card .card-body {
                padding: 1.5rem;
            }
            
            .status-timeline {
                gap: 1rem;
            }
            
            .order-item {
                flex-direction: column;
                text-align: center;
            }
            
            .support-contacts {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        @media print {
            .hero-confirmation,
            .action-buttons,
            .contact-support {
                display: none !important;
            }
            
            .confirmation-section {
                padding: 0;
                background: white;
            }
            
            .confirmation-card, .order-summary-card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>

    <script>
        // Auto-refresh order status (optional)
        // setInterval(function() {
        //     // You can implement AJAX call to update order status
        //     console.log('Checking order status...');
        // }, 30000); // Check every 30 seconds
    </script>
@endsection