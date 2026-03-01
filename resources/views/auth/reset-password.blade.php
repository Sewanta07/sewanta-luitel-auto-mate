@extends('layouts.public-core')

@section('title', 'Reset Password - AutoMate')

@section('content')
<div class="ap-page ap-page-login">
    <div class="ap-login-shell">
        <aside class="ap-login-media" aria-hidden="true">
            <div class="ap-login-overlay"></div>
            <img src="{{ asset('assets/auth/images/auth-hero.jpg') }}" alt="Auto service workshop" class="ap-login-image">
            <div class="ap-login-copy">
                <h1 class="ap-login-copy-title">Create New Password</h1>
                <p class="ap-login-copy-text">Secure your account with a strong new password.</p>
            </div>
        </aside>

        <main class="ap-login-panel">
            <div class="ap-auth-container">
                <a href="{{ route('index') }}" class="ap-brand-link">
                    <img src="{{ asset('assets/branding/company-logo.png') }}" alt="AutoMate" class="ap-logo-image">
                </a>

                <h2 class="ap-auth-title">Reset your password</h2>
                <p class="ap-auth-subtitle">Enter a new password for your account. Make sure it's strong and secure.</p>

                @if ($errors->any())
                    <div class="ap-alert ap-alert-error">
                        <div class="ap-alert-row">
                            <img src="{{ asset('assets/auth/icons/alert-circle.svg') }}" alt="Error" class="ap-icon-sm ap-icon-img ap-alert-icon">
                            <div>
                                <h3 class="ap-alert-title">There were errors with your request</h3>
                                <ul class="ap-error-list">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="ap-form">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="ap-field">
                        <label for="email" class="ap-label">Email address</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            readonly
                            class="ap-input ap-input-readonly"
                            value="{{ $email ?? old('email') }}"
                            placeholder="you@example.com"
                        >
                        @error('email')
                            <p class="ap-field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="ap-field">
                        <label for="password" class="ap-label">New Password</label>
                        <div class="ap-input-wrap">
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="new-password"
                                required
                                class="ap-input ap-input-password @error('password') ap-input-error @enderror"
                                placeholder="••••••••"
                            >
                            <button type="button" onclick="togglePasswordVisibility('password', 'password-toggle')" class="ap-password-toggle" aria-label="Toggle password visibility">
                                <img src="{{ asset('assets/auth/icons/eye.svg') }}" id="password-toggle" alt="Show password" class="ap-icon-sm ap-icon-img ap-password-icon">
                            </button>
                        </div>
                        @error('password')
                            <p class="ap-field-error">{{ $message }}</p>
                        @enderror
                        <p class="ap-tip-text">Password must be at least 8 characters and include uppercase, lowercase, numbers, and symbols.</p>
                    </div>

                    <div class="ap-field">
                        <label for="password_confirmation" class="ap-label">Confirm Password</label>
                        <div class="ap-input-wrap">
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                required
                                class="ap-input ap-input-password @error('password_confirmation') ap-input-error @enderror"
                                placeholder="••••••••"
                            >
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'password-confirmation-toggle')" class="ap-password-toggle" aria-label="Toggle password visibility">
                                <img src="{{ asset('assets/auth/icons/eye.svg') }}" id="password-confirmation-toggle" alt="Show password" class="ap-icon-sm ap-icon-img ap-password-icon">
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="ap-field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="ap-btn ap-btn-primary ap-btn-full">Reset Password</button>

                    <p class="ap-center-text">
                        <a href="{{ route('login') }}" class="ap-link">Back to Login</a>
                    </p>
                </form>

                <div class="ap-note ap-note-success">
                    <div class="ap-note-row">
                        <img src="{{ asset('assets/auth/icons/shield-check.svg') }}" alt="Security" class="ap-icon-sm ap-icon-img ap-note-icon-success">
                        <div>
                            <p class="ap-note-title">Password Security</p>
                            <p class="ap-note-text">Your password will be securely encrypted. Make it unique and don't share it with anyone.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
function togglePasswordVisibility(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.add('ap-icon-active');
    } else {
        field.type = 'password';
        icon.classList.remove('ap-icon-active');
    }
}
</script>
@endsection
