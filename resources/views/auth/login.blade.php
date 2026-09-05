@extends('layouts.app')

@section('title', 'Sign In - MLPath Platform')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Welcome Back</h1>
            <p class="auth-subtitle">Sign in to continue your Machine Learning practice tracks.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <!-- Email Address Field -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="form-input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </span>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        placeholder="name@example.com" 
                        class="form-input @error('email') is-invalid @enderror"
                    >
                </div>
                @error('email')
                    <span class="error-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field with Eye Toggle -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="form-input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required 
                        placeholder="Enter your password" 
                        class="form-input has-toggle @error('password') is-invalid @enderror"
                    >
                    <button type="button" class="password-toggle-btn" data-target="password" aria-label="Toggle password visibility">
                        <!-- Eye Open Icon -->
                        <svg class="eye-open" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <!-- Eye Closed Icon (Initially Hidden) -->
                        <svg class="eye-closed" style="display: none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="error-feedback">{{ $message }}</span>
                @enderror
            </div>

            <!-- Options (Remember Me & Forgot Password) -->
            <div class="form-options">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Remember this session</span>
                </label>
                <a href="{{ route('password.request') }}" style="color: var(--color-emerald); text-decoration: none; font-size: 0.85rem; font-weight: 600;">Forgot password?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block btn-lg">
                <span>Sign In to Practice</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </form>

        <div class="auth-footer-link">
            <span>Don't have an account yet?</span>
            <a href="{{ route('register') }}">Create an Account</a>
        </div>
    </div>
</div>
@endsection
