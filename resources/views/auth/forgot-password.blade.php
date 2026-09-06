@extends('layouts.app')

@section('title', 'Forgot Password - MLPath Platform')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Reset Password</h1>
            <p class="auth-subtitle">Enter your registered email address and we'll send you a link to reset your password.</p>
        </div>

        <form method="POST" action="{{ route('password.email') }}" novalidate>
            @csrf

            <!-- Email Address Field -->
            <div class="form-group">
                <label for="email" class="form-label">Registered Email Address</label>
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

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top: 24px;">
                <span>Send Password Reset Link</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </form>

        <div class="auth-footer-link">
            <span>Remembered your password?</span>
            <a href="{{ route('login') }}">Back to Sign In</a>
        </div>
    </div>
</div>
@endsection
