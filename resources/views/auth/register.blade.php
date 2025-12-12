@extends('layouts.app')

@section('title', 'Register - AutoMate')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>AutoMate</h1>
            <h2>Create Account</h2>
            <p>Sign up to get started with AutoMate</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    autofocus
                    class="form-control @error('name') is-invalid @enderror"
                >
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required
                    class="form-control @error('email') is-invalid @enderror"
                >
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input 
                    type="tel" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone') }}" 
                    required
                    class="form-control @error('phone') is-invalid @enderror"
                    placeholder="e.g., +1234567890"
                >
                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="current_address">Current Address</label>
                <textarea 
                    id="current_address" 
                    name="current_address" 
                    required
                    rows="3"
                    class="form-control @error('current_address') is-invalid @enderror"
                    placeholder="Enter your full address"
                >{{ old('current_address') }}</textarea>
                @error('current_address')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-input-wrapper">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required
                        class="form-control @error('password') is-invalid @enderror"
                    >
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <span class="password-icon-show">👁️</span>
                        <span class="password-icon-hide" style="display: none;">🙈</span>
                    </button>
                </div>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <div class="password-input-wrapper">
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        required
                        class="form-control"
                    >
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <span class="password-icon-show">👁️</span>
                        <span class="password-icon-hide" style="display: none;">🙈</span>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label for="role">Register as</label>
                <select 
                    id="role" 
                    name="role" 
                    required
                    class="form-control @error('role') is-invalid @enderror"
                >
                    <option value="">Select your role</option>
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Mechanic/Staff</option>
                </select>
                @error('role')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            <p><a href="{{ route('index') }}">Back to Home</a></p>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const wrapper = input.closest('.password-input-wrapper');
    const button = wrapper.querySelector('.password-toggle');
    const showIcon = button.querySelector('.password-icon-show');
    const hideIcon = button.querySelector('.password-icon-hide');
    
    if (input.type === 'password') {
        input.type = 'text';
        showIcon.style.display = 'none';
        hideIcon.style.display = 'inline-block';
    } else {
        input.type = 'password';
        showIcon.style.display = 'inline-block';
        hideIcon.style.display = 'none';
    }
}
</script>
@endsection

