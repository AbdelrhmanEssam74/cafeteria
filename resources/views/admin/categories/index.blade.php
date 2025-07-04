@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/categories.css') }}">
@endsection
@section('title', 'Manage Categories')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Product Categories</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i> Add Category
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($categories->isEmpty())
            <div class="card shadow-sm">
                <div class="card-body text-center py-5">
                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                    <h4>No Categories Found</h4>
                    <p class="text-muted">Create your first category to organize products</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i> Add Category
                    </a>
                </div>
            </div>
        @else
            <!-- Categories Grid -->
            <div class="row g-4">
                @foreach ($categories as $category)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-tag text-muted me-2"></i>
                                        {{ $category->name }}
                                    </h5>
{{--                                    <span class="badge bg-light text-dark">--}}
{{--                                    {{ $category->products_count ?? 0 }} products--}}
{{--                                </span>--}}
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        Created: {{ $category->created_at->format('M d, Y') }}
                                    </small>

                                    <div class="btn-group">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                           class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}"
                                              method="POST"
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
            @if($categories->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    <nav aria-label="Categories pagination">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if($categories->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $categories->previousPageUrl() }}"
                                       rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                @if($page == $categories->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if($categories->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $categories->nextPageUrl() }}" rel="next">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">&raquo;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        @endif
    </div>

@endsection
