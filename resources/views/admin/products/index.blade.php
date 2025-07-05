@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/products.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/nav.css') }}">
@endsection
@section('navbar')
    @include('includes.admin.sidebar')
@endsection
@section('title', 'Product Management')
@section('content')
    <div class="container py-4">
        <div class="d-flex  justify-content-between align-items-center mb-4">
            <h1 class="page-title mb-3 mb-md-0">Product Management</h1>
            <div class="d-flex gap-3 align-items-center">
                <a href="{{ route('products.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </div>
        </div>
        <div class="row mb-4 ">
            <form method="GET" action="{{ route('products.index') }}" class="w-100 w-md-auto">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($products->count() > 0)
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-4">
                        <div class="card product-card shadow-sm border-0 rounded-4 h-100">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                                    class="card-img-top object-fit-cover" style="height: 200px;">
                            @else
                                <div class="d-flex justify-content-center align-items-center bg-light"
                                    style="height: 200px;">
                                    <i class="fas fa-box-open fa-3x text-secondary"></i>
                                </div>
                            @endif

                            <div class="card-body">
                                <h5 class="card-title text-primary fw-bold mb-1">{{ $product->name }}</h5>
                                <p class="text-muted mb-1"><i class="fas fa-tag me-1"></i>
                                    {{ $product->category->name ?? 'Uncategorized' }}</p>
                                <p class="text-dark fw-semibold mb-1">{{ number_format($product->price, 2) }} EGP</p>

                                <span class="badge {{ $product->availability === 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $product->availability === 1 ? 'Available' : 'Out of Stock' }}
                                </span>
                            </div>

                            <div class="card-footer d-flex justify-content-between border-top pt-3">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger d-flex align-items-center gap-1"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center p-5 bg-white rounded-4 shadow-sm mt-4">
                <i class="fas fa-box text-primary fs-1 mb-3"></i>
                <h4 class="mb-2">No Products Found</h4>
                <p class="text-muted">Add your first product to get started.</p>
                <a href="{{ route('products.create') }}" class="btn btn-outline-primary mt-2">
                    <i class="fas fa-plus"></i> Add Product
                </a>
            </div>
        @endif

        @if ($products->hasPages())
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
