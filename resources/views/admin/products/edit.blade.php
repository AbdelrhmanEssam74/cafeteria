@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Edit Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Product Name:</label>
            <input type="text" class="form-control" name="name" id="name" required value="{{ old('name', $product->name) }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (EGP):</label>
            <input type="number" class="form-control" name="price" id="price" required step="0.01" value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <select name="category_id" id="category_id" class="form-select" required>
        <option value="">-- Choose Category --</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>


        <div class="mb-3">
            <label for="image" class="form-label">Product Image:</label><br>
            @if ($product->image)
                <img src="{{ asset($product->image) }}" alt="Current Image" width="100" class="mb-2"><br>
            @endif
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="availability" id="availability" {{ $product->availability ? 'checked' : '' }}>
            <label class="form-check-label" for="availability">
                Available for sale
            </label>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
