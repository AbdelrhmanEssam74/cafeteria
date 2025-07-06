@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/user/navbar.css') }}">
@endsection
@section('navbar')
    @include('includes.user.navbar')
@endsection
@section('title', 'My Orders')

@section('content')

    <!-- Start Hero Section -->
    <div class="hero" style="background-color: #f8f5f0; padding: 5rem 0;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="intro-excerpt">
                        <h1 class="display-4 mb-3" style="color: #3a2e1f; font-weight: 700;">My Orders</h1>
                        <p class="mb-4 lead" style="color: #6d5c4b;">Track and manage all your coffee orders in one place
                        </p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('menu') }}" class="btn btn-primary btn-lg px-4">
                                <i class="fas fa-coffee me-2"></i> Order Again
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-img-wrap">
                        <img src="https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1080&q=80"
                            alt="Coffee orders on table" class="img-fluid rounded-4 shadow-lg"
                            style="border: 10px solid white; transform: rotate(3deg);">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12">

                <!-- Add this above the table, replace the existing empty div -->
                @if (!$orders->isEmpty())
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <form method="GET" action="{{ route('user.orders.index') }}" class="d-flex gap-3">
                            <div class="input-group" style="width: 250px;">
                                <input type="date" class="form-control" name="filter_date"
                                    value="{{ request('filter_date') }}" max="{{ now()->format('Y-m-d') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                                @if (request('filter_date'))
                                    <a href="{{ route('user.orders.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteAllOrdersModal">
                            <i class="fas fa-trash-alt me-2"></i> Delete All Orders
                        </button>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white rounded-top-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><i class="fas fa-history me-2"></i> Order History</h4>
                            <span class="badge bg-white text-primary">{{ $orders->count() }} orders</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if ($orders->isEmpty())
                            <div class="alert alert-info m-4">You haven't placed any orders yet. <a
                                    href="{{ route('menu') }}" class="alert-link">Browse our menu</a> to get started!</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4">Order #</th>
                                            <!-- Replace the current date header cell with this: -->
                                            <th>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                                                        id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Date
                                                        @if (request('sort') == 'date_asc')
                                                            <i class="fas fa-sort-up ms-1"></i>
                                                        @elseif(request('sort') == 'date_desc')
                                                            <i class="fas fa-sort-down ms-1"></i>
                                                        @else
                                                            <i class="fas fa-sort ms-1"></i>
                                                        @endif
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ request()->fullUrlWithQuery(['sort' => 'date_desc']) }}">
                                                                <i class="fas fa-sort-down me-2"></i> Newest First
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ request()->fullUrlWithQuery(['sort' => 'date_asc']) }}">
                                                                <i class="fas fa-sort-up me-2"></i> Oldest First
                                                            </a>
                                                        </li>
                                                        @if (request('sort'))
                                                            <li>
                                                                <hr class="dropdown-divider">
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ request()->fullUrlWithQuery(['sort' => null]) }}">
                                                                    <i class="fas fa-times me-2"></i> Clear Sorting
                                                                </a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </th>
                                            <th>Items</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th class="text-end pe-4">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <span>{{ $order->created_at->format('M d, Y') }}</span>
                                                        <small
                                                            class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                                    </div>
                                                </td>
                                                <td>{{ $order->orderItems->sum('quantity') }} items</td>
                                                <td class="fw-bold">${{ number_format($order->total_price, 2) }}</td>
                                                <td>
                                                    <span class="{{ $order->status_badge }} py-2 px-3 rounded-pill">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-end pe-4">
                                                    <a href="{{ route('user.orders.show', $order) }}"
                                                        class="btn btn-warning btn-sm text-white">
                                                        <i class="fas fa-eye me-1"></i> View
                                                    </a>
                                                    @if ($order->canBeCancelled())
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#cancelOrderModal-{{ $order->id }}">
                                                            <i class="fas fa-times me-1"></i> Cancel
                                                        </button>
                                                    @endif
                                                    <button type="button" class="btn btn-outline-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteOrderModal-{{ $order->id }}">
                                                        <i class="fas fa-trash-alt me-1"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-light rounded-bottom-4">
                        <small class="text-muted">Last updated: {{ now()->format('M d, Y h:i A') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Confirmation Modals -->
    @foreach ($orders as $order)
        @if ($order->canBeCancelled())
            <div class="modal fade" id="cancelOrderModal-{{ $order->id }}" tabindex="-1"
                aria-labelledby="cancelOrderModalLabel-{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="cancelOrderModalLabel-{{ $order->id }}">
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
                                <i class="fas fa-times me-1"></i> No, Keep Order
                            </button>
                            <form action="{{ route('user.orders.cancel', $order) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-check me-1"></i> Yes, Cancel Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Add this after the cancel modals -->
    @foreach ($orders as $order)
        <!-- Delete Order Modal -->
        <div class="modal fade" id="deleteOrderModal-{{ $order->id }}" tabindex="-1"
            aria-labelledby="deleteOrderModalLabel-{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteOrderModalLabel-{{ $order->id }}">
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
                        <form action="{{ route('user.orders.destroy', $order) }}" method="POST">
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
    @endforeach

    <!-- Delete All Orders Modal -->
    <div class="modal fade" id="deleteAllOrdersModal" tabindex="-1" aria-labelledby="deleteAllOrdersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteAllOrdersModalLabel">
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
                            <h5 class="mb-1">Delete ALL your orders permanently?</h5>
                            <p class="mb-0 text-muted">This will remove all {{ $orders->count() }} orders from your
                                history.</p>
                        </div>
                    </div>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i> This action cannot be undone. All your order history
                        will be permanently deleted.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> No, Keep Orders
                    </button>
                    <form id="deleteAllForm" action="{{ route('user.orders.delete-all') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt me-1"></i> Yes, Delete All
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

        .hero-img-wrap {
            position: relative;
        }

        .hero-img-wrap::before {
            content: '';
            position: absolute;
            top: -15px;
            left: -15px;
            width: 100%;
            height: 100%;
            border: 2px dashed #3a2e1f;
            border-radius: 1rem;
            z-index: -1;
            opacity: 0.3;
        }

        .card {
            border-radius: 1rem !important;
            overflow: hidden;
        }

        .table th {
            font-weight: 600;
            color: #3a2e1f;
        }

        .badge.bg-warning {
            background-color: #eba439 !important;
        }

        .btn-warning {
            background-color: #eba439;
            border-color: #eba439;
        }

        .btn-warning:hover {
            background-color: #d8932a;
            border-color: #d8932a;
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

        /* Add this to the existing style section */
        .input-group {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .input-group input[type="date"] {
            border-right: none;
        }

        .input-group .btn {
            border-radius: 0;
        }

        .input-group .btn-outline-secondary {
            border-left: none;
        }

        /* Add this to your existing style section */
        .dropdown-toggle {
            padding: 0.25rem 0.5rem;
            font-weight: 600;
            color: #3a2e1f;
            background: transparent;
            border: none;
            box-shadow: none !important;
        }

        .dropdown-toggle:after {
            display: none;
        }

        .dropdown-toggle:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .dropdown-menu {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .dropdown-item {
            padding: 0.5rem 1rem;
            font-weight: 500;
            color: #3a2e1f;
        }

        .dropdown-item:hover {
            background-color: #f8f5f0;
            color: #3a2e1f;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background-color: #3a2e1f;
            color: white;
        }
    </style>

@section('scripts')

@endsection

@endsection
