@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/users.css') }}">
@endsection

@section('title', 'User Management')

@section('content')
    <div class="user-management">
        <div class="page-header">
            <h1 class="page-title">User Management</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <a href="{{ route('users.create') }}" class="add-user-btn">
                <i class="fas fa-plus"></i> Add New User
            </a>
        </div>

        @if($users->count() > 0)
            <div class="users-grid">
                @foreach($users as $user)
                    <div class="user-card">
                        <h3 class="user-name">{{ $user->name }}</h3>

                        <div class="user-detail">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $user->email }}</span>
                        </div>

                        <div class="user-detail">
                            <i class="fas fa-shopping-cart"></i>
                            <span>{{ $user->orders_count }} orders</span>
                        </div>

                        <div class="user-detail">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Joined {{ $user->created_at->format('M Y') }}</span>
                        </div>

                        <div class="user-actions">
                            <a href="{{ route('users.edit', $user->id) }}" class="action-btn edit-btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-users empty-icon"></i>
                <h3>No Users Found</h3>
                <p>Get started by adding your first user</p>
            </div>
        @endif
    </div>
@endsection
