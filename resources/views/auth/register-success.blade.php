@extends('layouts.public-core')

@section('title', 'Registration Success - AutoMate')

@section('content')
<div class="ap-page ap-page-register">
    <div class="ap-register-success">
        <a href="{{ route('index') }}" class="ap-brand-link ap-brand-center"><img src="{{ asset('assets/branding/company-logo.png') }}" alt="AutoMate" class="ap-logo-image"></a>

        <div class="ap-success-card">
            <div class="ap-success-badge">
                <img src="{{ asset('assets/auth/icons/check-circle.svg') }}" alt="Success" class="ap-success-badge-icon ap-icon-img">
            </div>

            <h2 class="ap-success-title">Registration Successful!</h2>
            <p class="ap-success-text">{{ session('message', 'Your account has been created successfully.') }}</p>

            <div class="ap-note ap-note-info ap-note-left">
                @if(session('role') === 'staff')
                    <div class="ap-note-row">
                        <img src="{{ asset('assets/auth/icons/info.svg') }}" alt="Info" class="ap-icon-sm ap-icon-img ap-note-icon-info">
                        <div>
                            <p class="ap-note-title">Pending Approval</p>
                            <div class="ap-note-text">
                                <p>Since you registered as a staff member:</p>
                                <ul class="ap-note-list">
                                    <li>Your application is pending admin review.</li>
                                    <li>You will be notified once approved.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="ap-note-row">
                        <img src="{{ asset('assets/auth/icons/check-circle.svg') }}" alt="Ready" class="ap-icon-sm ap-icon-img ap-note-icon-info">
                        <div>
                            <p class="ap-note-title">You're all set!</p>
                            <p class="ap-note-text">You can now access your dashboard and start booking services.</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="ap-success-actions">
                <a href="{{ route('login') }}" class="ap-btn ap-btn-primary ap-btn-full">Sign In Now</a>
                <a href="{{ route('index') }}" class="ap-muted-link">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
