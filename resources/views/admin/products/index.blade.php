@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/products.css') }}">
@endsection

@section('title', 'Product Management')

@section('content')
    <div class="container">
        <h1 class="page-title">Product Management</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="action-bar">
            <form method="GET" action="{{ route('products.index') }}">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                Add Product
            </a>
        </div>

        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image">
                        @else
                            <div class="product-image" style="display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-box-open fa-3x" style="color: var(--primary-light);"></i>
                            </div>
                        @endif

                        <h3 class="product-name">{{ $product->name }}</h3>
                        <div class="product-category">{{ $product->category->name ?? 'Uncategorized' }}</div>
                        <div class="product-price">{{ number_format($product->price, 2) }} EGP</div>

                        <span class="product-status {{ $product->availability === 1 ? 'status-available' : 'status-unavailable' }}">
                        {{ $product->availability === 1 ? 'Available' : 'Out of Stock' }}
                    </span>

                        <div class="product-actions">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline btn-edit">
                                Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline btn-delete"
                                        onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <p>No products found. Add your first product to get started.</p>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    Add Product
                </a>
            </div>
        @endif

        @if($products->hasPages())
            <div class="pagination">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
