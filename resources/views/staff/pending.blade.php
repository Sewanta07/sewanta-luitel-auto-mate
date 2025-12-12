@extends('layouts.app')

@section('title', 'Staff Application Pending')

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Staff Application</h1>
            <h2>Under Review</h2>
            <p>Your staff application is under review. You will be notified when approved.</p>
        </div>
        <div class="auth-footer">
            <p><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection

