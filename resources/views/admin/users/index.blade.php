@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/users.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/nav.css') }}">
@endsection
@section('navbar')
    @include('includes.admin.sidebar')
@endsection
@section('title', 'User Management')

@section('content')
    <div class="container user-management py-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h1 class="page-title mb-2 mb-md-0">User Management</h1>

            <a href="{{ route('users.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-sm">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>

        {{-- Session alerts --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($users->count() > 0)
            <div class="row g-4 mt-3">
                @foreach ($users as $user)
                    <div class="col-md-6 col-lg-4">
                        <div class="card user-card shadow-sm h-100 border-0 rounded-4">
                            <div class="card-body">
                                <h5 class="card-title text-primary fw-bold">{{ $user->name }}</h5>

                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="fas fa-envelope me-2 text-secondary"></i>
                                    <span>{{ $user->email }}</span>
                                </div>

                                <div class="d-flex align-items-center text-muted mb-2">
                                    <i class="fas fa-shopping-cart me-2 text-secondary"></i>
                                    <span>{{ $user->orders_count }} Orders</span>
                                </div>

                                <div class="d-flex align-items-center text-muted mb-3">
                                    <i class="fas fa-calendar-alt me-2 text-secondary"></i>
                                    <span>Joined {{ $user->created_at->format('M Y') }}</span>
                                </div>

                                <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state text-center bg-white p-5 rounded-4 shadow-sm mt-4">
                <i class="fas fa-users text-primary fs-1 mb-3"></i>
                <h3>No Users Found</h3>
                <p class="text-muted">Get started by adding your first user.</p>
                <a href="{{ route('users.create') }}" class="btn btn-outline-primary mt-2">
                    <i class="fas fa-plus"></i> Add User
                </a>
            </div>
        @endif
        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
@endsection
