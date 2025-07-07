@extends('layouts.app')

@section('title', 'Login')

@section('navbar')
    @include('includes.user.navbar')
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <style>

    </style>
@endsection

@section('content')
    <div class="login-wrapper">
        <div class="login-card">

            {{-- Right Side Form --}}
            <div class="login-form">
                <div class="login-header">{{ __('Login to Cafeteria') }}</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
                <div class="divider">
                    <span class="divider-text">or</span>
                </div>
                {{-- Google Login Button --}}
                <a href="{{ route('auth.google') }}" class="google-sign-in-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                         class="google-icon">
                        <path fill="#4285F4"
                              d="M17.6 9.2c0-.6-.1-1.2-.2-1.8H9v3.4h4.8c-.2 1.1-.8 2-1.7 2.6v2.1h2.8c1.6-1.5 2.5-3.7 2.5-6.3z" />
                        <path fill="#34A853"
                              d="M9 18c2.3 0 4.2-.7 5.6-2.1l-2.8-2.1c-.8.5-1.8.8-2.8.8-2.1 0-3.9-1.4-4.5-3.3H1.5v2.2C2.9 15.6 5.7 18 9 18z" />
                        <path fill="#FBBC05" d="M4.5 10.7c-.4-1.1-.4-2.3 0-3.4V5.1H1.5c-1.3 2.5-1.3 5.5 0 8l3-2.4z" />
                        <path fill="#EA4335"
                              d="M9 3.6c1.2 0 2.3.4 3.2 1.3L14.6 2C13.1.6 11.2 0 9 0 5.7 0 2.9 2.4 1.5 5.1l3 2.4c.6-1.9 2.4-3.3 4.5-3.3z" />
                    </svg>
                    Login with Google
                </a>


            </div>
            {{-- Left Side Image --}}
            <div class="login-image"></div>

        </div>
    </div>
@endsection
