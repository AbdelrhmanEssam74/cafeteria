@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">All Users</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif
    <div class="text-end">
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3"> Add New User</a>
    </div>
    
    <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Orders</th>
                <th>Joined At</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->orders_count}}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" >Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')"style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>

                        
                    </td>

                </tr>
            @empty
            <tr>
                <td colspan="6">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
