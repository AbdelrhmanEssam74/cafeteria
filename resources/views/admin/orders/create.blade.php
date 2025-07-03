@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-center">Create Order for User</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('orders.store') }}">
            @csrf

            <div class="mb-4">
                <label class="form-label">User</label>
                <select name="user_id" class="form-select" required>
                    <option value="">Choose User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <h5 class="mb-3">Choose Products</h5>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/images/no-image.png') }}" class="card-img-top" alt="No image" style="height: 200px; object-fit: cover;">
                            @endif

                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="text-muted mb-1">Category: {{ $product->category->name ?? '-' }}</p>
                                    <p class="fw-bold">{{ number_format($product->price, 2) }} EGP</p>
                                </div>

                                <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}">
                                <input type="number" name="products[{{ $loop->index }}][quantity]" class="form-control mt-2" min="0" placeholder="Quantity">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success"> Submit Order</button>
            </div>
        </form>
    </div>
@endsection
