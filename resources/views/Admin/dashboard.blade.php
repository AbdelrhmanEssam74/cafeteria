@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-center">Admin Dashboard</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <a href="{{ route('orders.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-primary shadow-sm rounded-4 text-center">
                        <div class="card-body">
                            <h6>Total Orders</h6>
                            <h2>{{ $totalOrders }}</h2>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('orders.index') }}?status=pending" class="text-decoration-none">
                    <div class="card text-white bg-warning shadow-sm rounded-4 text-center">
                        <div class="card-body">
                            <h6>Pending</h6>
                            <h2>{{ $pendingOrders }}</h2>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('orders.index') }}?status=delivered" class="text-decoration-none">
                    <div class="card text-white bg-success shadow-sm rounded-4 text-center">
                        <div class="card-body">
                            <h6>Delivered</h6>
                            <h2>{{ $deliveredOrders }}</h2>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('orders.index') }}?status=processing" class="text-decoration-none">
                    <div class="card text-white bg-secondary warning shadow-sm rounded-4 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Processing</h5>
                            <p class="card-text fs-3">{{ $processingOrders }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('orders.index') }}?status=canceled" class="text-decoration-none">
                    <div class="card text-white bg-danger danger shadow-sm rounded-4 text-center">
                        <div class="card-body">
                            <h5 class="card-title">Canceled</h5>
                            <p class="card-text fs-3">{{ $canceledOrders }}</p>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-md-3">
                <a href="{{ route('orders.index') }}" class="text-decoration-none">
                    <div class="card text-white bg-dark shadow-sm rounded-4 text-center">
                        <div class="card-body">
                            <h6>Total Sales (EGP)</h6>
                            <h2>{{ number_format($sales, 2) }}</h2>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
@endsection
