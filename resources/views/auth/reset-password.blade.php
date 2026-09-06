@extends('layouts.app')

@section('title', 'Set New Password - MLPath Platform')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <h1 class="auth-title">Set New Password</h1>
            <p class="auth-subtitle">Choose a new, strong password to protect your learning progress.</p>
        </div>

        <form method="POST" action="{{ route('password.update') }}" novalidate>
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $token }}">

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
                        value="{{ old('email', $email) }}" 
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

            <!-- New Password Field with Eye Toggle -->
            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
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
                        placeholder="Minimum 8 characters" 
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

            <!-- New Password Confirmation Field with Eye Toggle -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <div class="form-input-wrapper">
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </span>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        placeholder="Re-type your new password" 
                        class="form-input has-toggle"
                    >
                    <button type="button" class="password-toggle-btn" data-target="password_confirmation" aria-label="Toggle confirm password visibility">
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
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top: 24px;">
                <span>Update Password & Sign In</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>
        </form>

        <div class="auth-footer-link">
            <span>Remember your password?</span>
            <a href="{{ route('login') }}">Back to Sign In</a>
        </div>
    </div>
</div>
@endsection
