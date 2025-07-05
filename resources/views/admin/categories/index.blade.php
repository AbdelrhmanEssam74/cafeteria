@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/nav.css') }}">
@endsection
@section('navbar')
    @include('includes.admin.sidebar')
@endsection
@section('title', 'Manage Categories')

@section('content')
    <div class="container py-4">
        <!-- Header + Action -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 fw-bold">
                <i class="fas fa-tags me-2 text-primary"></i> Product Categories
            </h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Empty State -->
        @if ($categories->isEmpty())
            <div class="card shadow-sm border-0 text-center py-5">
                <div class="card-body">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <h4 class="fw-semibold">No Categories Found</h4>
                    <p class="text-muted">Start by creating your first category to organize your products.</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-outline-primary mt-2">
                        <i class="fas fa-plus me-1"></i> Add Category
                    </a>
                </div>
            </div>
        @else
            <!-- Categories Grid -->
            <div class="row g-4">
                @foreach ($categories as $category)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100 border-0 rounded-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0 text-primary d-flex align-items-center gap-2">
                                        <i class="fas fa-tag text-muted"></i> {{ $category->name }}
                                    </h5>
                                    {{-- Optional Product Count Badge --}}
                                    @if (isset($category->products_count))
                                        <span class="badge bg-light text-dark">
                                            {{ $category->products_count }} products
                                        </span>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted">
                                        Created on {{ $category->created_at->format('M d, Y') }}
                                    </small>
                                    <div class="btn-group">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($categories->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            @endif
        @endif
    </div>
@endsection
