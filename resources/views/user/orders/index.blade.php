@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/css/user/navbar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
@endsection
@section('navbar')
    @include('includes.user.navbar')
@endsection
@section('title', 'My Orders')

@section('content')

    <!-- Start Hero Section -->
    <div class="hero" style="background: linear-gradient(135deg, #f8f5f0 0%, #e8e1d5 100%); padding: 6rem 0 5rem;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-1 order-2">
                    <div class="intro-excerpt animate__animated animate__fadeInLeft">
                        <h1 class="display-4 mb-3" style="color: #3a2e1f; font-weight: 800; letter-spacing: -0.5px;">My Orders</h1>
                        <p class="mb-4 lead" style="color: #6d5c4b; font-size: 1.25rem; max-width: 90%;">
                            Track and manage all your coffee orders in one place. Your caffeine journey awaits!
                        </p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('menu') }}" class="btn btn-primary btn-lg px-4 shadow-sm" style="border-radius: 50px;">
                                <i class="fas fa-coffee me-2"></i> Order Again
                            </a>
                            <a href="#order-history" class="btn btn-outline-secondary btn-lg px-4" style="border-radius: 50px;">
                                <i class="fas fa-history me-2"></i> View History
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-2 order-1 mb-4 mb-lg-0">
                    <div class="hero-img-wrap position-relative animate__animated animate__fadeInRight">
                        <img src="https://images.unsplash.com/photo-1517705008128-361805f42e86?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1080&q=80"
                             alt="Coffee orders on table" class="img-fluid rounded-4 shadow-lg"
                             style="border: 12px solid white; transform: rotate(3deg); transition: transform 0.3s ease;">
                        <div class="floating-badge bg-primary text-white p-3 rounded-4 shadow" style="position: absolute; bottom: -20px; right: -20px; width: 120px; transform: rotate(10deg);">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-box-open fa-2x me-2"></i>
                                <div>
                                    <div class="fw-bold">{{ $orders->count() }}</div>
                                    <small>Orders</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="container py-5" id="order-history">
        <div class="row">
            <div class="col-lg-12">

                @if (!$orders->isEmpty())
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                        <form method="GET" action="{{ route('user.orders.index') }}" class="d-flex gap-3 w-100">
                            <div class="input-group" style="max-width: 350px;">
                                <span class="input-group-text bg-white border-end-0"><i class="fas fa-calendar-alt text-muted"></i></span>
                                <input type="date" class="form-control border-start-0" name="filter_date"
                                       value="{{ request('filter_date') }}" max="{{ now()->format('Y-m-d') }}">
                                <button type="submit" class="btn btn-primary px-3">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                                @if (request('filter_date'))
                                    <a href="{{ route('user.orders.index') }}" class="btn btn-outline-secondary px-3">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                        <button type="button" class="btn btn-danger  ms-auto" data-bs-toggle="modal"
                                data-bs-target="#deleteAllOrdersModal" style="border-radius: 10px;">
                            <i class="fas fa-trash-alt me-2"></i> Clear History
                        </button>
                    </div>
                @endif

                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="card-header bg-gradient-primary text-white rounded-top-4 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-bold"><i class="fas fa-history me-2"></i> Order History</h4>
                            <span class="badge bg-white text-primary rounded-pill px-3 py-2">{{ $orders->count() }} orders</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @if ($orders->isEmpty())
                            <div class="empty-state text-center py-5">
                                <div class="empty-state-icon bg-soft-primary rounded-circle mb-4">
                                    <i class="fas fa-shopping-bag fa-3x text-primary"></i>
                                </div>
                                <h3 class="fw-bold mb-3">No Orders Yet</h3>
                                <p class="text-muted mb-4">You haven't placed any orders yet. Let's fix that!</p>
                                <a href="{{ route('menu') }}" class="btn btn-primary px-4" style="border-radius: 50px;">
                                    <i class="fas fa-utensils me-2"></i> Browse Menu
                                </a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Order #</th>
                                        <th>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light dropdown-toggle d-flex align-items-center" type="button"
                                                        id="sortDropdown" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                    <span>Date</span>
                                                    @if (request('sort') == 'date_asc')
                                                        <i class="fas fa-sort-up ms-2"></i>
                                                    @elseif(request('sort') == 'date_desc')
                                                        <i class="fas fa-sort-down ms-2"></i>
                                                    @else
                                                        <i class="fas fa-sort ms-2"></i>
                                                    @endif
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                                                    <li>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                                           href="{{ request()->fullUrlWithQuery(['sort' => 'date_desc']) }}">
                                                            <span>Newest First</span>
                                                            <i class="fas fa-sort-down ms-3"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                                           href="{{ request()->fullUrlWithQuery(['sort' => 'date_asc']) }}">
                                                            <span>Oldest First</span>
                                                            <i class="fas fa-sort-up ms-3"></i>
                                                        </a>
                                                    </li>
                                                    @if (request('sort'))
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item text-danger"
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
                                        <tr class="border-bottom">
                                            <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <span class="fw-medium">{{ $order->created_at->format('M d, Y') }}</span>
                                                    <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2">{{ $order->items->sum('quantity') }}</span>
                                                    <i class="fas fa-box-open text-muted"></i>
                                                </div>
                                            </td>
                                            <td class="fw-bold text-primary">EGP {{ number_format($order->total_price, 2) }}</td>
                                            <td>
                                                <span class="{{ $order->status_badge }} py-2 px-3 rounded-pill d-inline-flex align-items-center">
                                                    @switch($order->status)
                                                        @case('completed')
                                                            <i class="fas fa-check-circle me-2"></i>
                                                            @break
                                                        @case('processing')
                                                            <i class="fas fa-cog fa-spin me-2"></i>
                                                            @break
                                                        @case('cancelled')
                                                            <i class="fas fa-times-circle me-2"></i>
                                                            @break
                                                        @default
                                                            <i class="fas fa-clock me-2"></i>
                                                    @endswitch
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('user.orders.show', $order) }}"
                                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                        <i class="fas fa-eye me-1"></i> Details
                                                    </a>
                                                    @if ($order->canBeCancelled())
                                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#cancelOrderModal-{{ $order->id }}">
                                                            <i class="fas fa-times me-1"></i> Cancel
                                                        </button>
                                                    @endif
                                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteOrderModal-{{ $order->id }}">
                                                        <i class="fas fa-trash-alt me-1"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    @if (!$orders->isEmpty())
                        <div class="card-footer bg-light rounded-bottom-4 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="fas fa-sync-alt me-1"></i> Updated: {{ now()->format('M d, Y h:i A') }}
                                </small>
                                @if ($orders->hasPages())
                                    <div class="pagination-container">
                                        {{ $orders->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
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
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header bg-gradient-danger text-white">
                            <h5 class="modal-title" id="cancelOrderModalLabel-{{ $order->id }}">
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
                            <form action="{{ route('user.orders.cancel', $order) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger rounded-pill px-4">
                                    <i class="fas fa-check me-1"></i> Confirm Cancel
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- Delete Order Modals -->
    @foreach ($orders as $order)
        <div class="modal fade" id="deleteOrderModal-{{ $order->id }}" tabindex="-1"
             aria-labelledby="deleteOrderModalLabel-{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-gradient-danger text-white">
                        <h5 class="modal-title" id="deleteOrderModalLabel-{{ $order->id }}">
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
    @endforeach

    <!-- Delete All Orders Modal -->
    <div class="modal fade" id="deleteAllOrdersModal" tabindex="-1" aria-labelledby="deleteAllOrdersModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-danger text-white">
                    <h5 class="modal-title" id="deleteAllOrdersModalLabel">
                        <i class="fas fa-trash-alt me-2"></i> Clear All Order History
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
                            <h5 class="mb-1 fw-bold">Delete all {{ $orders->count() }} orders?</h5>
                            <p class="mb-0 text-muted">This will permanently remove your entire order history.</p>
                        </div>
                    </div>
                    <div class="alert alert-danger border-0 bg-soft-danger">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-circle me-3 fa-lg"></i>
                            <div>
                                <strong>Warning:</strong> This action cannot be undone. All your order records will be permanently deleted.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <form id="deleteAllForm" action="{{ route('user.orders.delete-all') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="fas fa-trash-alt me-1"></i> Delete All
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
            0% { transform: translateY(0) rotate(10deg); }
            50% { transform: translateY(-10px) rotate(10deg); }
            100% { transform: translateY(0) rotate(10deg); }
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

        .badge.bg-warning {
            background-color: var(--accent-color) !important;
        }

        .btn-warning {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-warning:hover {
            background-color: #d8932a;
            border-color: #d8932a;
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

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
        }

        /* Input group enhancements */
        .input-group {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-radius: 50px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .input-group:focus-within {
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.15);
        }

        .input-group input[type="date"] {
            border-right: none;
            padding: 0.5rem 1rem;
        }

        .input-group .btn {
            border-radius: 0;
            padding: 0.5rem 1.25rem;
        }

        .input-group .btn-outline-secondary {
            border-left: none;
        }

        /* Dropdown enhancements */
        .dropdown-toggle {
            padding: 0.5rem 1rem;
            font-weight: 600;
            color: var(--primary-color);
            background: transparent;
            border: 1px solid #dee2e6;
            border-radius: 50px;
            transition: all 0.2s ease;
        }

        .dropdown-toggle:hover {
            background-color: rgba(0, 0, 0, 0.05);
            border-color: #adb5bd;
        }

        .dropdown-menu {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            color: var(--primary-color);
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f5f0;
            color: var(--primary-color);
            padding-left: 1.75rem;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            background-color: var(--primary-color);
            color: white;
        }

        /* Empty state styling */
        .empty-state {
            padding: 3rem 1rem;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
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

        /* Pagination styling */
        .pagination-container .pagination {
            margin-bottom: 0;
        }

        .pagination-container .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination-container .page-link {
            color: var(--primary-color);
            border-radius: 50px !important;
            margin: 0 3px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .pagination-container .page-link:hover {
            background-color: #f8f5f0;
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

            .card-footer {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>

    <script>
    </script>
@endsection

@section('footer')
    @include('includes.user.footer')
@endsection
