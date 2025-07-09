@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/user/navbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endsection

@section('navbar')
    @include('includes.user.navbar')
@endsection

@section('title', 'Order Details')

@section('content')

    <!-- Start Hero Section -->
    <div class="hero" style="background: linear-gradient(135deg, #f8f5f0 0%, #e8e1d5 100%); padding: 6rem 0 5rem;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="intro-excerpt animate__animated animate__fadeInLeft">
                        <div class="d-flex align-items-center mb-3">
                            <h1 class="display-4 mb-0" style="color: #3a2e1f; font-weight: 800; letter-spacing: -0.5px;">
                                Order #{{ $order->id }}</h1>
                            <span class="{{ $order->status_badge }} py-2 px-3 rounded-pill ms-3">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <p class="mb-4 lead" style="color: #6d5c4b; font-size: 1.25rem;">
                            Placed on {{ $order->created_at->format('F j, Y') }} at
                            {{ $order->created_at->format('g:i A') }}
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('user.orders.index') }}"
                                class="btn btn-outline-primary btn-lg px-4 rounded-pill">
                                <i class="fas fa-arrow-left me-2"></i> Back to Orders
                            </a>
                            @if ($order->canBeCancelled())
                                <button type="button" class="btn btn-danger btn-lg px-4 rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#cancelOrderModal">
                                    <i class="fas fa-times me-2"></i> Cancel Order
                                </button>
                            @endif
                            <button type="button" class="btn btn-outline-danger btn-lg px-4 rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#deleteOrderModal">
                                <i class="fas fa-trash-alt me-2"></i> Delete Order
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1 mb-4 mb-lg-0">
                    <div class="hero-img-wrap position-relative animate__animated animate__fadeInRight">
                        <img src="https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1080&q=80"
                            alt="Coffee order details" class="img-fluid rounded-4 shadow-lg"
                            style="border: 12px solid white; transform: rotate(-2deg); transition: transform 0.3s ease;">
                        <div class="floating-badge bg-primary text-white p-3 rounded-4 shadow"
                            style="position: absolute; bottom: -20px; right: -20px; width: 120px; transform: rotate(10deg);">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-box-open fa-2x me-2"></i>
                                <div>
                                    <div class="fw-bold">{{ $order->items->sum('quantity') }}</div>
                                    <small>Items</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="card-header bg-gradient-primary text-white rounded-top-4 py-3">
                        <h4 class="mb-0 fw-bold"><i class="fas fa-receipt me-2"></i> Order Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-5 g-4">
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary mb-4 d-flex align-items-center">
                                            <i class="fas fa-info-circle me-3"></i> Order Details
                                        </h5>
                                        <div class="row">
                                            <div class="col-6 mb-4">
                                                <h6 class="text-muted small mb-2">Order Number</h6>
                                                <p class="mb-0 fw-bold">#{{ $order->id }}</p>
                                            </div>
                                            <div class="col-6 mb-4">
                                                <h6 class="text-muted small mb-2">Date & Time</h6>
                                                <p class="mb-0">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                                            </div>
                                            <div class="col-6 mb-4">
                                                <h6 class="text-muted small mb-2">Payment Method</h6>
                                                <p class="mb-0">{{ ucfirst($order->payment_method) }}</p>
                                            </div>
                                            <div class="col-6 mb-4">
                                                <h6 class="text-muted small mb-2">Payment Status</h6>
                                                <p class="mb-0">
                                                    <span class="badge bg-success rounded-pill px-3 py-1">
                                                        {{ $order->payment_status ? 'Paid' : 'Pending' }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-12">
                                                <h6 class="text-muted small mb-2">Total Amount</h6>
                                                <p class="mb-0 fw-bold display-6 text-success">
                                                    EGP {{ number_format($order->total_price, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary mb-4 d-flex align-items-center">
                                            <i class="fas fa-truck me-3"></i> Delivery Information
                                        </h5>
                                        <div class="mb-4">
                                            <h6 class="text-muted small mb-2">Shipping Address</h6>
                                            <p class="mb-0">{{ $order->shipping_address }}</p>
                                        </div>
                                        <div class="mb-4">
                                            <h6 class="text-muted small mb-2">Room Number</h6>
                                            <p class="mb-0">
                                                @if ($order->room_number)
                                                    <span
                                                        class="badge bg-primary bg-opacity-10 text-primary py-1 px-3 rounded-pill">
                                                        <i class="fas fa-door-open me-2"></i>{{ $order->room_number }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">Not specified</span>
                                                @endif
                                            </p>
                                        </div>
                                        @if ($order->notes)
                                            <div>
                                                <h6 class="text-muted small mb-2">Special Instructions</h6>
                                                <p class="mb-0">
                                                    <i class="fas fa-quote-left text-muted me-2"></i>
                                                    {{ $order->notes }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-4 text-primary d-flex align-items-center">
                            <i class="fas fa-coffee me-3"></i> Order Items
                        </h5>
                        <div class="table-responsive rounded-3 overflow-hidden border">
                            <table class="table table-borderless mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4" style="width: 50%">Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end pe-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr class="border-top">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    @if ($item->product->image)
                                                        <img src="{{ asset('/' . $item->product->image) }}"
                                                            alt="{{ $item->product->name }}" width="80"
                                                            class="me-3 rounded-3 shadow-sm"
                                                            style="object-fit: cover; height: 80px;">
                                                    @else
                                                        <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center"
                                                            style="width: 80px; height: 80px;">
                                                            <i class="fas fa-coffee text-muted fa-2x"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                        <small
                                                            class="text-muted">{{ Str::limit($item->product->description, 50) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>EGP {{ number_format($item->price, 2) }}</td>
                                            <td>
                                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                                    {{ $item->quantity }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4 fw-bold">
                                                EGP {{ number_format($item->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold ps-4">Subtotal:</td>
                                        <td class="text-end pe-4 fw-bold">EGP {{ number_format($order->total_price, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold ps-4">Shipping:</td>
                                        <td class="text-end pe-4 fw-bold">EGP 0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold ps-4">Tax:</td>
                                        <td class="text-end pe-4 fw-bold">EGP 0.00</td>
                                    </tr>
                                    <tr class="border-top">
                                        <td colspan="3" class="text-end fw-bold ps-4 h5">Total:</td>
                                        <td class="text-end pe-4 fw-bold h5 text-primary">
                                            EGP {{ number_format($order->total_price, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-5 text-center">
                            <a href="{{ route('menu') }}" class="btn btn-primary px-5 py-3 rounded-pill shadow-sm">
                                <i class="fas fa-coffee me-2"></i> Order Again
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Confirmation Modal -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-danger text-white">
                    <h5 class="modal-title" id="cancelOrderModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i> Confirm Cancellation
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-soft-danger rounded-circle p-3">
                                <i class="fas fa-question-circle text-danger fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fw-bold">Cancel Order #{{ $order->id }}?</h5>
                            <p class="mb-0 text-muted">Placed on {{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                    <div class="alert alert-warning border-0 bg-soft-warning">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-3 fa-lg"></i>
                            <div>This action cannot be undone. Any payment will be refunded according to our policy.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Keep Order
                    </button>
                    <form id="cancelOrderForm" action="{{ route('user.orders.cancel', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="fas fa-check me-1"></i> Confirm Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Order Modal -->
    <div class="modal fade" id="deleteOrderModal" tabindex="-1" aria-labelledby="deleteOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-danger text-white">
                    <h5 class="modal-title" id="deleteOrderModalLabel">
                        <i class="fas fa-trash-alt me-2"></i> Delete Order Permanently
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-soft-danger rounded-circle p-3">
                                <i class="fas fa-exclamation-triangle text-danger fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fw-bold">Delete Order #{{ $order->id }}?</h5>
                            <p class="mb-0 text-muted">This will permanently remove this order from your history.</p>
                        </div>
                    </div>
                    <div class="alert alert-danger border-0 bg-soft-danger">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-3 fa-lg"></i>
                            <div>Warning: This action cannot be undone. All order details will be lost.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <form action="{{ route('user.orders.destroy', $order) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="fas fa-trash-alt me-1"></i> Delete Permanently
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #3a2e1f;
            --secondary-color: #6d5c4b;
            --light-color: #f8f5f0;
            --accent-color: #eba439;
            --danger-color: #dc3545;
        }

        .hero {
            position: relative;
            overflow: hidden;
            background-size: cover;
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

        .hero-img-wrap {
            position: relative;
            transition: all 0.3s ease;
        }

        .hero-img-wrap:hover img {
            transform: rotate(0deg) scale(1.02);
        }

        .floating-badge {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(10deg);
            }

            50% {
                transform: translateY(-10px) rotate(10deg);
            }

            100% {
                transform: translateY(0) rotate(10deg);
            }
        }

        .card {
            border-radius: 1rem !important;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #5a4a3a 100%);
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #c82333 100%);
        }

        .table th {
            font-weight: 600;
            color: var(--primary-color);
            background-color: #f9f9f9;
            padding: 1rem 1.5rem;
        }

        .table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        /* Status badges */
        .badge-processing {
            background-color: #0dcaf0;
            color: white;
        }

        .badge-completed {
            background-color: #198754;
            color: white;
        }

        .badge-cancelled {
            background-color: #6c757d;
            color: white;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #212529;
        }

        /* Modal styling */
        .modal-content {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: none;
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

        /* Soft background colors */
        .bg-soft-primary {
            background-color: rgba(58, 46, 31, 0.1);
        }

        .bg-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .bg-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .hero {
                padding: 3rem 0;
                text-align: center;
            }

            .hero .intro-excerpt {
                margin-bottom: 2rem;
            }

            .hero-img-wrap {
                max-width: 80%;
                margin: 0 auto;
            }

            .floating-badge {
                right: 0 !important;
            }

            .table-responsive {
                border: 1px solid #dee2e6;
                border-radius: 0.75rem;
                overflow: hidden;
            }

            .table thead {
                display: none;
            }

            .table tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 0.5rem;
            }

            .table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 1rem;
                border-bottom: 1px solid #f1f1f1;
            }

            .table td:before {
                content: attr(data-label);
                font-weight: 600;
                color: var(--primary-color);
                margin-right: 1rem;
            }

            .table td:last-child {
                border-bottom: none;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effect to order items
            const tableRows = document.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                    this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.05)';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });
            });

            // Add animation to modals
            const cancelModal = document.getElementById('cancelOrderModal');
            if (cancelModal) {
                cancelModal.addEventListener('show.bs.modal', function() {
                    this.querySelector('.modal-content').classList.add('animate__animated',
                        'animate__fadeInDown');
                });
            }

            const deleteModal = document.getElementById('deleteOrderModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function() {
                    this.querySelector('.modal-content').classList.add('animate__animated',
                        'animate__fadeInDown');
                });
            }
        });
    </script>
@endsection