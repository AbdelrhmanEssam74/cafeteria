@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/order-details.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/nav.css') }}">
@endsection
@section('navbar')
@include('includes.admin.sidebar')
@endsection
@section('title', 'Order Details')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Order #{{ $order->id }} Details</h2>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Orders
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Order Summary Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar me-3">
                                <img
                                    src="{{ $order->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($order->user->name).'&background=795548&color=fff' }}"
                                    alt="{{ $order->user->name }}" class="rounded-circle" width="50">
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $order->user->name }}</h5>
                                <p class="text-muted mb-0">Customer</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted">Room Number:</span>
                                @foreach($order->items as $item)
                                        <p class="mb-0">
                                            {{ $order->items->first()->room_number ?? 'Not specified' }}
                                        </p>
                                @endforeach
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <span class="text-muted">Order Status:</span>
                            <p class="mb-0">
                            <span class="badge rounded-pill {{ $order->status == 'pending' ? 'bg-warning text-dark' :
                                ($order->status == 'processing' ? 'bg-primary' :
                                ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                            </p>
                        </div>

                        <div class="mb-3">
                            <span class="text-muted">Order Date:</span>
                            <p class="mb-0">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">Order Items</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Product</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th class="pe-4 text-end">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td class="ps-4 align-middle">
                                    <strong>{{ $item->product->name ?? 'Product Deleted' }}</strong>
                                </td>
                                <td class="align-middle">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset($item->product->image) }}"
                                             width="60" height="60"
                                             class="rounded object-fit-cover"
                                             alt="Product Image">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                             style="width: 60px; height: 60px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{ $item->product->category->name ?? '-' }}
                                </td>
                                <td class="align-middle">
                                    {{ number_format($item->price, 2) }} EGP
                                </td>
                                <td class="align-middle">
                                    {{ $item->quantity }}
                                </td>
                                <td class="pe-4 text-end align-middle">
                                    <strong>{{ number_format($item->price * $item->quantity, 2) }} EGP</strong>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot class="bg-light">
                        <tr>
                            <td colspan="5" class="text-end fw-bold ps-4">Total:</td>
                            <td class="pe-4 text-end fw-bold">
                                {{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }), 2) }}
                                EGP
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Status Update Card -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Update Order Status</h5>
                <form action="{{ route('orders.status', $order->id) }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <select name="status" id="status" class="form-select">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>
                                    Processing
                                </option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                    Delivered
                                </option>
                                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
