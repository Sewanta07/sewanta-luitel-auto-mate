@extends('layouts.app')

@section('title', 'Profile Settings - AutoMate')

@section('content')
@php($user = auth()->user())
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links nav-links-staff">
                    <a href="{{ route('dashboard.staff') }}" class="btn btn-outline">Dashboard</a>
                    <a href="{{ route('staff.bookings') }}" class="btn btn-outline">Bookings</a>
                    <a href="{{ route('staff.service.logs') }}" class="btn btn-outline">Service Logs</a>
                    <a href="{{ route('staff.inventory') }}" class="btn btn-outline">Inventory</a>
                    <a href="{{ route('staff.customers') }}" class="btn btn-outline">Customers</a>
                    <a href="{{ route('staff.settings') }}" class="btn btn-outline">Settings</a>
                    <a href="{{ route('staff.profile') }}" class="btn btn-outline">My Profile</a>
                    <span class="user-info">Welcome, {{ $user?->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-outline">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-content">
        <div class="container">
            <div class="dashboard-header">
                <h2>Profile Settings</h2>
                <p>Update your profile and change password.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">👤</div>
                    <h3>Update Profile</h3>
                    <p>Edit your personal information</p>
                    <ul class="feature-list">
                        <li>Profile picture upload</li>
                        <li>Name, email, phone</li>
                        <li>Position, experience, address</li>
                    </ul>
                    <a href="{{ route('staff.profile') }}" class="btn btn-primary btn-sm">Go to Profile</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🔒</div>
                    <h3>Change Password</h3>
                    <p>Secure your account</p>
                    <ul class="feature-list">
                        <li>Current password verification</li>
                        <li>New password confirmation</li>
                        <li>Strong password guidance</li>
                    </ul>
                    <a href="{{ route('staff.profile') }}#password-form" class="btn btn-primary btn-sm">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

