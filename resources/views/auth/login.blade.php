@extends('layouts.app')

@section('title', 'Login - AutoMate')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>AutoMate</h1>
            <h2>Welcome Back</h2>
            <p>Sign in to your account to continue</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="auth-form">
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
                <label for="email">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    class="form-control @error('email') is-invalid @enderror"
                >
                @error('email')
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

            <div class="form-group form-group-inline">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Remember me</span>
                </label>
                <a href="#" class="forgot-password-link">Forgot Password?</a>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </form>

        <div class="auth-footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
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

