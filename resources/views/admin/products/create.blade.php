@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Add New Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required  value="{{old('name')}}">
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" step="0.01" class="form-control" required  value="{{old('price')}}"> 
    </div>

    <div class="mb-3">
    <label for="category_id" class="form-label">Category</label>
    <div class="d-flex gap-2">
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">-- Choose Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
            @endforeach
        </select>

        <a href="{{ route('categories.create') }}" class="btn btn-outline-primary">
             Add Category
        </a>
    </div>
</div>


    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" accept="image/*" class="form-control">
    </div>

    <div class="mb-3">
        <label>Available</label>
        <select name="availability" class="form-control">
            <option value="1" selected>Available</option>
            <option value="0">Not Available</option>
        </select>
    </div>

    <button class="btn btn-success">Save</button>
</form>

</div>
@endsection
