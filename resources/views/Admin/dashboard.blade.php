@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
@endsection
@section('title', 'Dashboard')

@section('content')
    <!-- Main Content -->
    <!-- Background Overlay -->
    <div class="dashboard-container">
        {{-- Hero Header --}}
        <div class="dashboard-hero">
            <div class="welcome-message">
                <h1>Dashboard Overview</h1>
                <div class="greeting">
                    <p>Welcome back, <span class="user-name">{{ auth()->user()->name }}</span>!</p>
                    <p class="subtext">Here's what's happening today in your café.</p>
                </div>
            </div>
            <div class="date-display">
                <div class="date-card">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ now()->format('l, F j, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="metrics-grid">
            <a href="{{ route('orders.index') }}" class="metric-card orders">
                <div class="metric-content">
                    <div class="metric-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="metric-text">
                        <h3>Total Orders</h3>
                        <h2>{{ $totalOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">
                    <span>View all orders <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>

            <a href="{{ route('orders.index') }}?status=pending" class="metric-card pending">
                <div class="metric-content">
                    <div class="metric-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="metric-text">
                        <h3>Pending Orders</h3>
                        <h2>{{ $pendingOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">
                    <span>Needs attention <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>

            <a href="{{ route('orders.index') }}?status=processing" class="metric-card processing">
                <div class="metric-content">
                    <div class="metric-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="metric-text">
                        <h3>Processing</h3>
                        <h2>{{ $processingOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">
                    <span>Currently preparing <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>

            <a href="{{ route('orders.index') }}?status=delivered" class="metric-card delivered">
                <div class="metric-content">
                    <div class="metric-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="metric-text">
                        <h3>Delivered</h3>
                        <h2>{{ $deliveredOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">
                    <span>Completed today <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>

            <a href="{{ route('orders.index') }}?status=canceled" class="metric-card canceled">
                <div class="metric-content">
                    <div class="metric-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="metric-text">
                        <h3>Canceled</h3>
                        <h2>{{ $canceledOrders }}</h2>
                    </div>
                </div>
                <div class="metric-footer">
                    <span>Canceled orders <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>

            <a href="{{ route('orders.index') }}" class="metric-card revenue">
                <div class="metric-content">
                    <div class="metric-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="metric-text">
                        <h3>Total Sales</h3>
                        <h2>EGP {{ number_format($sales, 2) }}</h2>
                    </div>
                </div>
                <div class="metric-footer">
                    <span>Today's revenue <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>
        </div>

        <!-- Recent Orders Section -->
        <div class="recent-orders">
            <div class="section-header">
                <h2><i class="fas fa-history"></i> Recent Orders</h2>
                <a href="{{ route('orders.index') }}" class="view-all">
                    View All <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            <div class="orders-table-container">
                <table class="orders-table">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Sample data - replace with actual orders data -->
                    <tr>
                        <td>#ORD-0012</td>
                        <td>
                            <div class="customer-info">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah Johnson">
                                <span>Sarah Johnson</span>
                            </div>
                        </td>
                        <td>2x Latte (M)</td>
                        <td>EGP 45.00</td>
                        <td><span class="status-badge delivered">Delivered</span></td>
                        <td>10:25 AM</td>
                        <td class="actions">
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-0011</td>
                        <td>
                            <div class="customer-info">
                                <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Michael Chen">
                                <span>Michael Chen</span>
                            </div>
                        </td>
                        <td>1x Espresso, 1x Croissant</td>
                        <td>EGP 30.50</td>
                        <td><span class="status-badge processing">Processing</span></td>
                        <td>10:15 AM</td>
                        <td class="actions">
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-0010</td>
                        <td>
                            <div class="customer-info">
                                <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Emma Wilson">
                                <span>Emma Wilson</span>
                            </div>
                        </td>
                        <td>1x Cappuccino (L)</td>
                        <td>EGP 35.00</td>
                        <td><span class="status-badge pending">Pending</span></td>
                        <td>10:05 AM</td>
                        <td class="actions">
                            <button class="action-btn view"><i class="fas fa-eye"></i></button>
                            <button class="action-btn edit"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <style>

    </style>
@endsection
