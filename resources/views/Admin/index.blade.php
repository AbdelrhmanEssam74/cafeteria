@extends('Admin.layouts.app')
@section('title', 'Dashboard')
@include('Admin.includes.sidebar')
@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search...">
            </div>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin">
                <span>Admin</span>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="card-container">
            <div class="card">
                <div class="card-header">
                    <h3>Today's Orders</h3>
                    <div class="card-icon orders">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                </div>
                <h2>24</h2>
                <p>+5 from yesterday</p>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Total Users</h3>
                    <div class="card-icon users">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <h2>156</h2>
                <p>+3 new this week</p>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3>Today's Revenue</h3>
                    <div class="card-icon revenue">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
                <h2>$245.50</h2>
                <p>+12% from yesterday</p>
            </div>
        </div>

        <!-- Quick Order Section -->
        <div class="section">
            <div class="section-header">
                <h2>Quick Order</h2>
            </div>
            <div class="order-form">
                <div class="form-group">
                    <label for="user-id">User ID/Phone</label>
                    <input type="text" id="user-id" class="form-control" placeholder="Enter user ID or phone number">
                </div>
                <div class="form-group">
                    <label for="user-name">User Name</label>
                    <input type="text" id="user-name" class="form-control" placeholder="Will auto-fill if user exists" disabled>
                </div>
                <div class="form-group">
                    <label for="drink">Drink</label>
                    <select id="drink" class="form-control">
                        <option value="">Select a drink</option>
                        <option value="espresso">Espresso</option>
                        <option value="latte">Latte</option>
                        <option value="cappuccino">Cappuccino</option>
                        <option value="americano">Americano</option>
                        <option value="mocha">Mocha</option>
                        <option value="tea">Tea</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="size">Size</label>
                    <select id="size" class="form-control">
                        <option value="small">Small</option>
                        <option value="medium" selected>Medium</option>
                        <option value="large">Large</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" class="form-control" value="1" min="1">
                </div>
                <div class="form-group">
                    <label for="special-notes">Special Notes</label>
                    <textarea id="special-notes" class="form-control" rows="2" placeholder="Any special instructions..."></textarea>
                </div>
                <div class="form-actions">
                    <button class="btn btn-outline">Clear</button>
                    <button class="btn btn-primary">Place Order</button>
                </div>
            </div>
        </div>

        <!-- Recent Orders Section -->
        <div class="section">
            <div class="section-header">
                <h2>Recent Orders</h2>
                <button class="btn btn-outline">View All</button>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#ORD-0012</td>
                        <td>Sarah Johnson</td>
                        <td>2x Latte (M)</td>
                        <td>$7.50</td>
                        <td><span class="status active">Completed</span></td>
                        <td>10:25 AM</td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-0011</td>
                        <td>Michael Chen</td>
                        <td>1x Espresso, 1x Croissant</td>
                        <td>$5.25</td>
                        <td><span class="status active">Completed</span></td>
                        <td>10:15 AM</td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-0010</td>
                        <td>Emma Wilson</td>
                        <td>1x Cappuccino (L)</td>
                        <td>$4.75</td>
                        <td><span class="status pending">Preparing</span></td>
                        <td>10:05 AM</td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#ORD-0009</td>
                        <td>David Kim</td>
                        <td>1x Mocha (M), 1x Blueberry Muffin</td>
                        <td>$8.00</td>
                        <td><span class="status pending">Pending</span></td>
                        <td>9:50 AM</td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- User Management Section -->
        <div class="section">
            <div class="section-header">
                <h2>User Management</h2>
                <button class="btn btn-primary" id="add-user-btn">Add New User</button>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Orders</th>
                        <th>Last Order</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#USR-0042</td>
                        <td>Sarah Johnson</td>
                        <td>(555) 123-4567</td>
                        <td>sarah.j@example.com</td>
                        <td>12</td>
                        <td>Today</td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#USR-0041</td>
                        <td>Michael Chen</td>
                        <td>(555) 987-6543</td>
                        <td>michael.c@example.com</td>
                        <td>8</td>
                        <td>Today</td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#USR-0040</td>
                        <td>Emma Wilson</td>
                        <td>(555) 456-7890</td>
                        <td>emma.w@example.com</td>
                        <td>5</td>
                        <td>Today</td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>#USR-0039</td>
                        <td>David Kim</td>
                        <td>(555) 789-0123</td>
                        <td>david.k@example.com</td>
                        <td>15</td>
                        <td>Yesterday</td>
                        <td>
                            <button class="action-btn"><i class="fas fa-eye"></i></button>
                            <button class="action-btn"><i class="fas fa-edit"></i></button>
                            <button class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
