@extends('layouts.user.master')

@section('title', 'Login')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card auth-card p-4">
                    <div class="card-body">
                        <h2 class="auth-title text-center mb-4">Welcome Back</h2>
                        <p class="text-center text-muted mb-4">Sign in to continue to your account</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    placeholder="Enter your email" autofocus>
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="password" class="form-label">Password</label>
                                    <a href="{{ route('password.request') }}" class="link-primary">Forgot password?</a>
                                </div>
                                <input type="password" class="form-control form-control-lg" id="password" name="password"
                                    placeholder="Enter your password">
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <button type="submit" class="btn auth-btn w-100 mb-3">Login</button>

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
                                Don't have an account? <a href="{{ route('register') }}" class="link-primary">Register</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
