@extends('layouts.public-core')

@section('title', 'Login - AutoMate')

@section('content')
<div class="ap-page ap-page-login">
    <div class="ap-login-shell">
        <aside class="ap-login-media" aria-hidden="true">
            <div class="ap-login-overlay"></div>
            <img src="{{ asset('assets/auth/images/auth-hero.jpg') }}" alt="Auto service workshop" class="ap-login-image">
            <div class="ap-login-copy">
                <h1 class="ap-login-copy-title">Welcome back to AutoMate</h1>
                <p class="ap-login-copy-text">Manage your vehicle service, track repairs, and stay on the road with confidence.</p>
            </div>
        </aside>

        <main class="ap-login-panel">
            <div class="ap-auth-container">
                <a href="{{ route('index') }}" class="ap-brand-link">
                    <img src="{{ asset('assets/branding/company-logo.png') }}" alt="AutoMate" class="ap-logo-image">
                </a>

                <h2 class="ap-auth-title">Sign in to your account</h2>
                <p class="ap-auth-subtitle">
                    Or <a href="{{ route('register') }}" class="ap-link">create a new account</a>
                </p>

                <form method="POST" action="{{ route('login') }}" class="ap-form">
                    @csrf

                    @if ($errors->any())
                        <div class="ap-alert ap-alert-error">
                            <div class="ap-alert-row">
                                <img src="{{ asset('assets/auth/icons/alert-circle.svg') }}" alt="Error" class="ap-icon-sm ap-icon-img ap-alert-icon">
                                <div>
                                    <h3 class="ap-alert-title">There were errors with your submission</h3>
                                    <ul class="ap-error-list">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="ap-field">
                        <label for="email" class="ap-label">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required class="ap-input" value="{{ old('email') }}" placeholder="you@example.com">
                    </div>

                    <div class="ap-field">
                        <label for="password" class="ap-label">Password</label>
                        <div class="ap-input-wrap">
                            <input id="password" name="password" type="password" autocomplete="current-password" required class="ap-input ap-input-password" placeholder="••••••••">
                            <button type="button" onclick="togglePasswordVisibility('password', 'password-toggle')" class="ap-password-toggle" aria-label="Toggle password visibility">
                                <img src="{{ asset('assets/auth/icons/eye.svg') }}" id="password-toggle" alt="Show password" class="ap-icon-sm ap-icon-img ap-password-icon">
                            </button>
                        </div>
                    </div>

                    <div class="ap-form-meta">
                        <label for="remember" class="ap-checkbox-row">
                            <input id="remember" name="remember" type="checkbox" class="ap-checkbox" {{ old('remember') ? 'checked' : '' }}>
                            <span>Remember me</span>
                        </label>

                        <a href="{{ route('password.request') }}" class="ap-link ap-link-sm">Forgot your password?</a>
                    </div>

                    <button type="submit" class="ap-btn ap-btn-primary ap-btn-full">
                        Sign in
                    </button>
                </form>

                <div class="ap-separator-wrap">
                    <div class="ap-separator"></div>
                    <span class="ap-separator-label">Secured by AutoMate</span>
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
