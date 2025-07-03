@extends('layouts.app')

@section('title', 'Product Management')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-center">All Products</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="text-end mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-primary text-end" style="display: inline">Add New Product</a>
        </div>

        <form method="GET" action="{{ route('products.index') }}" class="row mb-3" >
            <div class="col-md-4">
                <select name="category" class="form-select" onchange="this.form.submit()" >
                    <option value="">-- All Categories --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form> 


        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>{{ $product->price }} EGP</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="Product Image" width="70">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            @if($product->availability === 1)
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Unavailable</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No products available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
