@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/create-user.css') }}">
@endsection

@section('title', 'Add User')

@section('content')
    <div class="registration-container">
        <h1 class="page-title">Add New User</h1>

        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}" class="registration-card">
            @csrf

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Room Number</label>
                <input type="text" name="room_number" value="{{ old('room_number') }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">Admin Privileges</label>
                <select name="role" class="form-select">
                    <option value="user" selected>Regular User</option>
                    <option value="admin">Administrator</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Create User</button>
        </form>
    </div>
@endsection
