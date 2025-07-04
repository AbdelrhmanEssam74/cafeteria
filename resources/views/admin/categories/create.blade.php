@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/add-category.css') }}">
@endsection
@section('title', 'Add New Category')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Create New Category</h2>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i> Back to Categories
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4">
                <h5 class="alert-heading">Please fix these errors:</h5>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Category Name</label>
                        <input type="text" name="name" id="name"
                               class="form-control form-control-lg"
                               placeholder="e.g. Coffee, Pastries, Sandwiches"
                               value="{{ old('name') }}"
                               required>
                        <div class="form-text">Enter a descriptive name for your new category</div>
                    </div>

{{--                    <div class="mb-4">--}}
{{--                        <label for="description" class="form-label fw-bold">Description (Optional)</label>--}}
{{--                        <textarea name="description" id="description"--}}
{{--                                  class="form-control"--}}
{{--                                  rows="3"--}}
{{--                                  placeholder="Brief description of this category">{{ old('description') }}</textarea>--}}
{{--                    </div>--}}

{{--                    <div class="mb-4">--}}
{{--                        <label for="icon" class="form-label fw-bold">Category Icon</label>--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div class="dropdown me-3">--}}
{{--                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"--}}
{{--                                        id="iconDropdown" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                    <i class="fas fa-tag me-2"></i> Select Icon--}}
{{--                                </button>--}}
{{--                                <ul class="dropdown-menu" aria-labelledby="iconDropdown">--}}
{{--                                    <li><h6 class="dropdown-header">Common Icons</h6></li>--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" href="#" data-icon="fa-coffee">--}}
{{--                                            <i class="fas fa-coffee me-2"></i> Coffee--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" href="#" data-icon="fa-utensils">--}}
{{--                                            <i class="fas fa-utensils me-2"></i> Food--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" href="#" data-icon="fa-mug-hot">--}}
{{--                                            <i class="fas fa-mug-hot me-2"></i> Hot Drinks--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" href="#" data-icon="fa-ice-cream">--}}
{{--                                            <i class="fas fa-ice-cream me-2"></i> Desserts--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li><hr class="dropdown-divider"></li>--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item" href="#" data-icon="fa-tag">--}}
{{--                                            <i class="fas fa-tag me-2"></i> Default--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <input type="hidden" name="icon" id="icon" value="fa-tag">--}}
{{--                            <div id="selectedIconPreview">--}}
{{--                                <i class="fas fa-tag"></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="reset" class="btn btn-outline-secondary me-md-2">
                            <i class="fas fa-undo me-2"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>

    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Icon selection functionality
            const iconDropdownItems = document.querySelectorAll('[data-icon]');
            const iconInput = document.getElementById('icon');
            const iconPreview = document.getElementById('selectedIconPreview');

            iconDropdownItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const selectedIcon = this.getAttribute('data-icon');
                    iconInput.value = selectedIcon;
                    iconPreview.innerHTML = `<i class="fas ${selectedIcon}"></i>`;
                });
            });
        });
    </script>
@endsection
