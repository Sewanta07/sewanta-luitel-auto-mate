@extends('layouts.app')

@section('title', 'Application Rejected')

@section('content')
<div class="sf-auth-page">
    <div class="sf-auth-shell">
        <div class="sf-auth-brand-wrap">
            <h1 class="sf-auth-brand">AutoMate</h1>
        </div>
        
        <div class="sf-auth-card">
            <div class="sf-auth-card-body">
                <div class="sf-auth-icon-wrap sf-auth-icon-wrap-rejected">
                    <svg class="sf-auth-icon sf-auth-icon-rejected" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                
                <h2 class="sf-auth-title">Application Rejected</h2>
                <p class="sf-auth-copy">
                    We're sorry, but your application for a staff account has been rejected. If you believe this is an error, please contact the administrator.
                </p>

                <div class="sf-auth-actions sf-auth-actions-stack">
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sf-auth-btn sf-auth-btn-primary">
                            Sign Out
                        </button>
                    </form>
                    <a href="{{ route('index') }}" class="sf-auth-btn sf-auth-btn-secondary">
                        Return to Home
                    </a>
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

