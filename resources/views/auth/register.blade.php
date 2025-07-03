@extends('layouts.user.master')

@section('title', 'Register')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card auth-card p-4">
                    <div class="card-body">
                        <h2 class="auth-title text-center mb-4">Create Account</h2>
                        <p class="text-center text-muted mb-4">Fill in your details to get started</p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control form-control-lg" id="name" name="name"
                                    placeholder="Enter your full name" required>
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    placeholder="Enter your email" required>
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password"
                                    placeholder="Create a password" required>
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control form-control-lg" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm your password" required>
                            </div>

                            <button type="submit" class="btn auth-btn w-100 mb-3">Create Account</button>

                            <div class="position-relative text-center my-4">
                                <hr>
                                <span class="position-absolute top-50 translate-middle-y bg-white px-3 text-muted">or</span>
                            </div>

                            <div class="mb-4">
                                <div class="d-grid gap-3">
                                    <a href="{{ route('auth.facebook') }}" class="btn btn-primary social-btn"
                                        aria-label="Continue with Facebook">
                                        <i class="fab fa-facebook-f me-2"></i> Continue with Facebook
                                    </a>
                                    <a href="{{ url('auth/google') }}" class="btn btn-outline-danger social-btn"
                                        aria-label="Continue with Google">
                                        <i class="fab fa-google me-2"></i> Continue with Google
                                    </a>
                                </div>
                            </div>

                            <p class="text-center mt-4">
                                Already have an account? <a href="{{ route('login') }}" class="link-primary">Login</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
