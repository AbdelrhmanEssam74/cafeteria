@extends('Admin.layouts.app')
@section('title', 'Admin Login')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/admin/login.css') }}">
@endsection
@section('loginForm')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-container mx-auto">
                    <div class="card login-card">
                        <div class="card-header">
                            <div class="logo">
                                <i class="fas fa-coffee"></i>
                                <h1>Café Admin</h1>
                            </div>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <h2 class="card-title text-center mb-4">Admin Portal Login</h2>

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form action="{{ route('admin.login.submit') }}" method="POST">
                                @csrf

                                <div class="mb-3 position-relative">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="position-relative">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" class="form-control ps-4" id="username" name="username" placeholder="Enter your username"   >
                                    </div>
                                </div>

                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="position-relative">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" class="form-control ps-4" id="password" name="password" placeholder="Enter your password"   >
                                    </div>
                                    <div class="text-end mt-2">
                                        <a href="#" class="forgot-password">Forgot password?</a>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                                </div>
                            </form>

                            <div class="footer mt-4">
                                &copy; {{ date('Y') }} Café Admin System. All rights reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
