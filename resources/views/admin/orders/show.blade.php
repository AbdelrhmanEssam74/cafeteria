@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Order #{{ $order->id }} Details</h2>
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <p><strong>User:</strong> {{ $order->user->name }}</p>
         <li class="list-group-item">
        <strong>Room Number:</strong> {{ $order->user->room_number ?? '-' }}
    </li>
    
        <p><strong>Status:</strong> <span class="badge 
            @if($order->status == 'pending') bg-warning 
            @elseif($order->status == 'processing') bg-primary 
            @elseif($order->status == 'canceled') bg-danger 
            @else bg-success 
            @endif">{{ ucfirst($order->status) }}</span>
        </p>
        <p><strong>Ordered at:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <h4 class="mb-3">Order Items</h4>

<table class="table table-bordered text-center align-middle">
    <thead class="table-light">
        <tr>
            <th>Product</th>
            <th>Image</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'Product Deleted' }}</td>
                <td>
                    @if($item->product && $item->product->image)
                        <img src="{{ asset($item->product->image) }}" width="70" alt="Product Image">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $item->product->category->name ?? '-' }}</td>
                <td>{{ number_format($item->price, 2) }} EGP</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price * $item->quantity, 2) }} EGP</td>
            </tr>
        @endforeach
    </tbody>
</table>


    <form action="{{ route('orders.status', $order->id) }}" method="POST" class="mb-4">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="status" class="col-form-label fw-bold">Update Status:</label>
        </div>
        <div class="col-auto">
            <select name="status" id="status" class="form-select">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>                
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection
