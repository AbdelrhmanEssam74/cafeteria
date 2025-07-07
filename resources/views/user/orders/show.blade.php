@extends('layouts.user.master')

@section('title', 'Order Details')

@section('content')

    <!-- Start Hero Section -->
    <div class="hero" style="background-color: #f8f5f0; padding: 5rem 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="intro-excerpt">
                        <h1 class="display-4 mb-3" style="color: #3a2e1f; font-weight: 700;">Order #{{ $order->id }}
                        </h1>
                        <p class="mb-4 lead" style="color: #6d5c4b;">Details for your coffee order placed on
                            {{ $order->created_at->format('M d, Y') }}</p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary btn-lg px-4">
                                <i class="fas fa-arrow-left me-2"></i> Back to Orders
                            </a>
                            @if ($order->canBeCancelled())
                                <button type="button" class="btn btn-danger btn-lg px-4" data-bs-toggle="modal"
                                    data-bs-target="#cancelOrderModal">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </button>
                            @endif
                            <button type="button" class="btn btn-outline-danger btn-lg px-4" data-bs-toggle="modal"
                                data-bs-target="#deleteOrderModal">
                                <i class="fas fa-trash-alt me-2"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img-wrap">
                        <img src="https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1080&q=80"
                            alt="Coffee order details" class="img-fluid rounded-4 shadow-lg"
                            style="border: 10px solid white; transform: rotate(-2deg);">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><i class="fas fa-receipt me-2"></i> Order Summary</h4>
                            <span class="{{ $order->status_badge }} py-2 px-3 rounded-pill">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary mb-4">
                                            <i class="fas fa-info-circle me-2"></i> Order Details
                                        </h5>
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-2">Order Number</h6>
                                            <p class="mb-0 fw-bold">#{{ $order->id }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-2">Date & Time</h6>
                                            <p class="mb-0">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-2">Payment Method</h6>
                                            <p class="mb-0">{{ ucfirst($order->payment_method) }}</p>
                                        </div>
                                        <div>
                                            <h6 class="text-muted mb-2">Total Amount</h6>
                                            <p class="mb-0 fw-bold text-success">
                                                ${{ number_format($order->total_price, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary mb-4">
                                            <i class="fas fa-truck me-2"></i> Delivery Information
                                        </h5>
                                        <div class="mb-3">
                                            <h6 class="text-muted mb-2">Shipping Address</h6>
                                            <p class="mb-0">{{ $order->shipping_address }}</p>
                                        </div>
                                        @if ($order->notes)
                                            <div>
                                                <h6 class="text-muted mb-2">Special Instructions</h6>
                                                <p class="mb-0">{{ $order->notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-4 text-primary">
                            <i class="fas fa-coffee me-2"></i> Order Items
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4" style="width: 50%">Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end pe-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    @if ($item->product->image)
                                                        <img src="{{ asset('assets/images/' . $item->product->image) }}"
                                                            alt="{{ $item->product->name }}" width="80"
                                                            class="me-3 rounded-3 shadow-sm">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                        <small
                                                            class="text-muted">{{ Str::limit($item->product->description, 50) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>
                                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                                    {{ $item->quantity }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4 fw-bold">
                                                ${{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="border-top">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold ps-4">Subtotal:</td>
                                        <td class="text-end pe-4 fw-bold">${{ number_format($order->total_price, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-5 text-center">
                            <a href="{{ route('menu') }}" class="btn btn-primary px-5 py-3">
                                <i class="fas fa-coffee me-2"></i> Order Again
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Confirmation Modal -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="cancelOrderModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i> Confirm Cancellation
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 me-3">
                            <i class="fas fa-question-circle text-danger fa-3x"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">Are you sure you want to cancel this order?</h5>
                            <p class="mb-0 text-muted">Order #{{ $order->id }} -
                                {{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-info-circle me-2"></i> This action cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> No, Keep Order
                    </button>
                    <form id="cancelOrderForm" action="{{ route('orders.cancel', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-check me-2"></i> Yes, Cancel Order
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this after the cancel modal -->
    <!-- Delete Order Modal -->
    <div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteOrderModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i> Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 me-3">
                            <i class="fas fa-trash-alt text-danger fa-3x"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">Delete this order permanently?</h5>
                            <p class="mb-0 text-muted">Order #{{ $order->id }} -
                                {{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i> This will permanently delete the order record.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> No, Keep Order
                    </button>
                    <form action="{{ route('orders.destroy', $order) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-1"></i> Yes, Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hero {
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%233a2e1f' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .card {
            border-radius: 1rem !important;
        }

        .table th {
            font-weight: 600;
            color: #3a2e1f;
        }

        .badge.bg-warning {
            background-color: #eba439 !important;
        }

        .badge.bg-success {
            background-color: #28a745 !important;
        }

        .badge.bg-danger {
            background-color: #dc3545 !important;
        }

        .btn-primary {
            background-color: #3a2e1f;
            border-color: #3a2e1f;
        }

        .btn-primary:hover {
            background-color: #2b2218;
            border-color: #2b2218;
        }

        .btn-outline-primary {
            color: #fff;
            border-color: #3a2e1f;
        }

        .btn-outline-primary:hover {
            background-color: #3a2e1f;
            border-color: #3a2e1f;
        }

        /* Modal animations */
        .animate__animated {
            animation-duration: 0.3s;
        }

        .animate__fadeInDown {
            animation-name: fadeInDown;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -20px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        /* Modal styling */
        .modal-content {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: none;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            border-top: none;
            padding: 1.5rem;
            background-color: #f8f9fa;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
        }
    </style>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Optional: Add animation to the modal
            const cancelModal = document.getElementById('cancelOrderModal');
            if (cancelModal) {
                cancelModal.addEventListener('show.bs.modal', function() {
                    this.querySelector('.modal-content').classList.add('animate__animated',
                        'animate__fadeInDown');
                });
            }
        });
    </script>
@endsection

@endsection