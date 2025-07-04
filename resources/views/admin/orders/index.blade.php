@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/users.css') }}">
@endsection
@section('title', 'All Orders')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Order Management</h2>
            <a href="{{ route('orders.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Create Order
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Enhanced Filter Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('orders.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">From Date</label>
                            <input type="date" id="start_date" name="start_date"
                                   value="{{ request('start_date') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">To Date</label>
                            <input type="date" id="end_date" name="end_date"
                                   value="{{ request('end_date') }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="canceled" {{ request('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter me-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Orders Cards -->
        <div class="row g-4 mt-5">
            @forelse ($orders as $order)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Order #{{ $order->id }}</h5>
                            <span class="badge rounded-pill {{ $order->status == 'pending' ? 'bg-warning text-dark' :
                                 ($order->status == 'processing' ? 'bg-info text-dark' :
                                 ($order->status == 'delivered' ? 'bg-success' : 'bg-danger')) }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar me-3">
                                    <img src="{{ $order->user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($order->user->name).'&background=795548&color=fff' }}"
                                         alt="{{ $order->user->name }}" class="rounded-circle" width="40">
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $order->user->name }}</h6>
                                    <small class="text-muted">Customer</small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted">Order Date</small>
                                <p class="mb-0">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>

                            @if($order->items->count() > 0)
                                <div class="mb-3">
                                    <small class="text-muted">Items ({{ $order->items->count() }})</small>
                                    <div class="mt-2">
                                        @foreach($order->items->take(2) as $item)
                                            <span class="badge bg-light text-dark me-1 mb-1">
                                                {{ $item->product->name }} × {{ $item->quantity }}
                                            </span>
                                        @endforeach
                                        @if($order->items->count() > 2)
                                            <span class="badge bg-light text-dark">+{{ $order->items->count() - 2 }} more</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> Details
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this order?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                            <h4>No Orders Found</h4>
                            <p class="text-muted">Create your first order to get started</p>
                            <a href="{{ route('orders.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Create Order
                            </a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Orders pagination">
                    <ul class="pagination">
                        {{-- Previous Page Link --}}
                        @if($orders->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                            @if($page == $orders->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($orders->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $orders->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection
