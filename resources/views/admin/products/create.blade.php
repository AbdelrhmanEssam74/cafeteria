@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/create-product.css') }}">
@endsection

@section('title', 'Add New Product')

@section('content')
    <div class="container py-5">
        <div class="form-container">
            <h2 class="form-title">Add New Product</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="Enter product name">
                </div>

                <div class="mb-4">
                    <label class="form-label">Price (EGP)</label>
                    <input type="number" name="price" step="0.01" class="form-control" required value="{{ old('price') }}" placeholder="0.00">
                </div>

                <div class="mb-4">
                    <label class="form-label">Category</label>
                    <div class="input-group">
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">-- Choose Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <a href="{{ route('categories.create') }}" class="btn btn-add-category">
                            <i class="fas fa-plus me-1"></i> Add Category
                        </a>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" accept="image/*" class="form-control" id="imageUpload">
                    <div class="image-preview-container" id="imagePreviewContainer">
                        <img src="" alt="Image Preview" class="image-preview" id="imagePreview">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Availability</label>
                    <select name="availability" class="form-select">
                        <option value="1" selected>Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-submit">
                    <i class="fas fa-save me-2"></i> Save Product
                </button>
            </form>
        </div>
    </div>

    <script>
        // Image preview functionality
        document.getElementById('imageUpload').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('imagePreviewContainer');
            const preview = document.getElementById('imagePreview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }

                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        });
    </script>
@endsection
