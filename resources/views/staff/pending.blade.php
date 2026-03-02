@extends('layouts.app')

@section('title', 'Staff Application Pending')

@section('content')
<div class="sf-auth-page">
    <div class="sf-auth-shell">
        <div class="sf-auth-brand-wrap">
            <h1 class="sf-auth-brand">AutoMate</h1>
        </div>
        
        <div class="sf-auth-card">
            <div class="sf-auth-card-body">
                <div class="sf-auth-icon-wrap sf-auth-icon-wrap-pending">
                    <svg class="sf-auth-icon sf-auth-icon-pending" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h2 class="sf-auth-title">Application Under Review</h2>
                <p class="sf-auth-copy">
                    Thanks for registering! Your staff application is currently being reviewed by an administrator. You will be notified once your account has been approved.
                </p>

                <div class="sf-auth-actions">
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sf-auth-btn sf-auth-btn-secondary">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="sf-auth-footer">
             <p class="sf-auth-footer-copy">
                &copy; {{ date('Y') }} AutoMate. All rights reserved.
            </p>
        </div>
    </div>
</div>
@endsection

