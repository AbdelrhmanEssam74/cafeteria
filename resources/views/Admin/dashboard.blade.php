@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/nav.css') }}">

@endsection
@section('navbar')
@include('includes.admin.sidebar')
@endsection
@section('title', 'Dashboard')
@section('content')
    <div class="dashboard-container">

        <!-- Hero Section -->
        <div class="dashboard-hero">
            <div class="welcome-message">
                <h1>Welcome, <span class="user-name">{{ auth()->user()->name }}</span></h1>
                <p class="subtext">Here’s a quick overview of today’s activity.</p>
            </div>
            <div class="date-display">
                <div class="date-card">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ now()->format('l, F j, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Metrics Grid -->
        <div class="metrics-grid">

            <a href="{{ route('orders.index') }}" class="metric-card orders">
                <div class="metric-content">
                    <div class="metric-icon"><i class="fas fa-shopping-bag"></i></div>
                    <div class="metric-text">
                        <h3>Total Orders</h3>
                        <h2>{{ $totalOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">View all orders <i class="fas fa-arrow-right"></i></div>
            </a>

            <a href="{{ route('orders.index', ['status' => 'pending']) }}" class="metric-card pending">
                <div class="metric-content">
                    <div class="metric-icon"><i class="fas fa-clock"></i></div>
                    <div class="metric-text">
                        <h3>Pending</h3>
                        <h2>{{ $pendingOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">Awaiting approval <i class="fas fa-arrow-right"></i></div>
            </a>

            <a href="{{ route('orders.index', ['status' => 'processing']) }}" class="metric-card processing">
                <div class="metric-content">
                    <div class="metric-icon"><i class="fas fa-cogs"></i></div>
                    <div class="metric-text">
                        <h3>Processing</h3>
                        <h2>{{ $processingOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">Being prepared <i class="fas fa-arrow-right"></i></div>
            </a>

            <a href="{{ route('orders.index', ['status' => 'delivered']) }}" class="metric-card delivered">
                <div class="metric-content">
                    <div class="metric-icon"><i class="fas fa-check-circle"></i></div>
                    <div class="metric-text">
                        <h3>Delivered</h3>
                        <h2>{{ $deliveredOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">Successfully delivered <i class="fas fa-arrow-right"></i></div>
            </a>

            <a href="{{ route('orders.index', ['status' => 'canceled']) }}" class="metric-card canceled">
                <div class="metric-content">
                    <div class="metric-icon"><i class="fas fa-times-circle"></i></div>
                    <div class="metric-text">
                        <h3>Canceled</h3>
                        <h2>{{ $canceledOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">Order canceled <i class="fas fa-arrow-right"></i></div>
            </a>

            <a href="{{ route('orders.index') }}" class="metric-card revenue">
                <div class="metric-content">
                    <div class="metric-icon"><i class="fas fa-dollar-sign"></i></div>
                    <div class="metric-text">
                        <h3>Total Sales</h3>
                        <h2>EGP {{ number_format($sales, 2) }}</h2>
                    </div>
                </div>
                <div class="metric-footer">Today’s revenue <i class="fas fa-arrow-right"></i></div>
            </a>

        </div>

    </div>
@endsection
