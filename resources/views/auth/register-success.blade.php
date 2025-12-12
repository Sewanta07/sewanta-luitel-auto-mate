@extends('layouts.app')

@section('title', 'Registration Success - AutoMate')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>AutoMate</h1>
            <h2>Registration Successful</h2>
            <p>{{ session('message', 'Your registration has been submitted successfully!') }}</p>
        </div>

        <div class="alert alert-info" style="margin-bottom: 1.5rem;">
            @if(session('role') === 'staff')
                <p><strong>What happens next?</strong></p>
                <ul style="margin-top: 0.5rem; padding-left: 1.5rem;">
                    <li>Your application is now pending admin review</li>
                    <li>You will receive an email notification once your account is approved</li>
                    <li>You can then login with your credentials</li>
                </ul>
            @else
                <p>You can now login to your account.</p>
            @endif
        </div>

        <div class="auth-footer">
            <p><a href="{{ route('login') }}" class="btn btn-primary btn-block" style="text-decoration: none; display: inline-block; width: 100%; text-align: center;">Go to Login</a></p>
            <p style="margin-top: 1rem;"><a href="{{ route('index') }}">Back to Home</a></p>
        </div>
    </div>
</div>
@endsection

