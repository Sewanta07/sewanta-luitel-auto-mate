@extends('layouts.public-core')

@section('title', 'Forgot Password - AutoMate')

@section('content')
<div class="ap-page ap-page-login">
    <div class="ap-login-shell">
        <aside class="ap-login-media" aria-hidden="true">
            <div class="ap-login-overlay"></div>
            <img src="{{ asset('assets/auth/images/auth-hero.jpg') }}" alt="Auto service workshop" class="ap-login-image">
            <div class="ap-login-copy">
                <h1 class="ap-login-copy-title">Reset Your Password</h1>
                <p class="ap-login-copy-text">Regain access to your vehicle management dashboard in minutes.</p>
            </div>
        </aside>

        <main class="ap-login-panel">
            <div class="ap-auth-container">
                <a href="{{ route('index') }}" class="ap-brand-link">
                    <img src="{{ asset('assets/branding/company-logo.png') }}" alt="AutoMate" class="ap-logo-image">
                </a>

                <h2 class="ap-auth-title">Forgot your password?</h2>
                <p class="ap-auth-subtitle">
                    Enter your email and we'll send a password reset link.
                </p>

                @if (session('status'))
                    <div class="ap-alert ap-alert-success">
                        <div class="ap-alert-row">
                            <img src="{{ asset('assets/auth/icons/check-circle.svg') }}" alt="Success" class="ap-icon-sm ap-icon-img ap-alert-icon-success">
                            <div>
                                <h3 class="ap-alert-title ap-alert-title-success">Success!</h3>
                                <p class="ap-alert-text-success">{{ session('status') }} Please check your email for the password reset link.</p>
                            </div>
                        </div>
                    </div>
                @endif

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

                <form method="POST" action="{{ route('password.email') }}" class="ap-form">
                    @csrf

                    <div class="ap-field">
                        <label for="email" class="ap-label">Email address</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            class="ap-input @error('email') ap-input-error @enderror"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                        >
                        @error('email')
                            <p class="ap-field-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="ap-btn ap-btn-primary ap-btn-full">
                        Send Password Reset Link
                    </button>

                    <p class="ap-center-text">
                        Remember your password?
                        <a href="{{ route('login') }}" class="ap-link">Sign in here</a>
                    </p>
                </form>
            </div>
        </main>
    </div>
</div>
@endsection
