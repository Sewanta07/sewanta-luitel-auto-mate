@extends('layouts.public-core')

@section('title', 'Register - AutoMate')

@section('content')
<div class="ap-page ap-page-register">
    <div class="ap-register-head">
        <a href="{{ route('index') }}" class="ap-brand-link ap-brand-center"><img src="{{ asset('assets/branding/company-logo.png') }}" alt="AutoMate" class="ap-logo-image"></a>
        <h2 class="ap-auth-title ap-auth-title-center">Create your account</h2>
        <p class="ap-auth-subtitle ap-auth-subtitle-center">
            Already have an account?
            <a href="{{ route('login') }}" class="ap-link">Sign in instead</a>
        </p>
    </div>

    <div class="ap-register-card">
        <form method="POST" action="{{ route('register') }}" class="ap-form">
            @csrf

            @if ($errors->any())
                <div class="ap-alert ap-alert-error">
                    <div class="ap-alert-row">
                        <img src="{{ asset('assets/auth/icons/alert-circle.svg') }}" alt="Error" class="ap-icon-sm ap-icon-img ap-alert-icon">
                        <div>
                            <h3 class="ap-alert-title">Please correct the following errors:</h3>
                            <ul class="ap-error-list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="ap-grid ap-grid-2">
                <div class="ap-field">
                    <label for="name" class="ap-label">Full Name</label>
                    <input type="text" name="name" id="name" autocomplete="name" required class="ap-input" value="{{ old('name') }}" placeholder="John Doe">
                </div>

                <div class="ap-field">
                    <label for="phone" class="ap-label">Phone Number</label>
                    <input type="tel" name="phone" id="phone" autocomplete="tel" required class="ap-input" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000">
                </div>
            </div>

            <div class="ap-field">
                <label for="email" class="ap-label">Email Address</label>
                <input id="email" name="email" type="email" autocomplete="email" required class="ap-input" value="{{ old('email') }}" placeholder="you@example.com">
            </div>

            <div class="ap-field">
                <label for="current_address" class="ap-label">Current Address</label>
                <textarea id="current_address" name="current_address" rows="2" required class="ap-input ap-textarea" placeholder="123 Main St, Apt 4B">{{ old('current_address') }}</textarea>
            </div>

            <div class="ap-grid ap-grid-2">
                <div class="ap-field">
                    <label for="password" class="ap-label">Password</label>
                    <div class="ap-input-wrap">
                        <input id="password" name="password" type="password" required class="ap-input ap-input-password" placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('password', 'password-toggle')" class="ap-password-toggle" aria-label="Toggle password visibility">
                            <img src="{{ asset('assets/auth/icons/eye.svg') }}" id="password-toggle" alt="Show password" class="ap-icon-sm ap-icon-img ap-password-icon">
                        </button>
                    </div>
                </div>

                <div class="ap-field">
                    <label for="password_confirmation" class="ap-label">Confirm Password</label>
                    <div class="ap-input-wrap">
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="ap-input ap-input-password" placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'password_confirmation-toggle')" class="ap-password-toggle" aria-label="Toggle confirm password visibility">
                            <img src="{{ asset('assets/auth/icons/eye.svg') }}" id="password_confirmation-toggle" alt="Show password" class="ap-icon-sm ap-icon-img ap-password-icon">
                        </button>
                    </div>
                </div>
            </div>

            <div class="ap-field">
                <label for="role" class="ap-label">Register as</label>
                <select id="role" name="role" required class="ap-input ap-select">
                    <option value="" disabled selected>Select your account type</option>
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer (I want to book services)</option>
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Mechanic/Staff (I work here)</option>
                </select>
                <p class="ap-help-text">Staff accounts require admin approval before access is granted.</p>
            </div>

            <button type="submit" class="ap-btn ap-btn-primary ap-btn-full">
                Create Account
            </button>
        </form>
    </div>

    <div class="ap-register-foot">
        <p>&copy; {{ date('Y') }} AutoMate. All rights reserved.</p>
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
