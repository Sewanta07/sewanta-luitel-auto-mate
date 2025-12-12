@extends('layouts.app')

@section('title', 'Customer Dashboard - AutoMate')

@section('content')
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <a href="{{ route('customer.profile') }}" class="btn btn-outline">My Profile</a>
                    <span class="user-info">Welcome, {{ $user->name }}</span>
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
                <h2>Customer Dashboard</h2>
                <p>Manage your vehicles and service appointments</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">🚗</div>
                    <h3>My Vehicles</h3>
                    <p>View and manage your registered vehicles</p>
                    <a href="#" class="btn btn-primary btn-sm">View Vehicles</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">📅</div>
                    <h3>Appointments</h3>
                    <p>Schedule and track service appointments</p>
                    <a href="#" class="btn btn-primary btn-sm">View Appointments</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">📋</div>
                    <h3>Service History</h3>
                    <p>View past service records and invoices</p>
                    <a href="#" class="btn btn-primary btn-sm">View History</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">💬</div>
                    <h3>Support</h3>
                    <p>Get help or contact our support team</p>
                    <a href="#" class="btn btn-primary btn-sm">Contact Support</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">👤</div>
                    <h3>My Profile</h3>
                    <p>Manage your profile and account settings</p>
                    <a href="{{ route('customer.profile') }}" class="btn btn-primary btn-sm">View Profile</a>
                </div>
            </div>

            <div class="dashboard-section">
                <h3>Recent Activity</h3>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">✓</div>
                        <div class="activity-content">
                            <h4>Service Completed</h4>
                            <p>Your vehicle service has been completed successfully.</p>
                            <span class="activity-date">2 days ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">📅</div>
                        <div class="activity-content">
                            <h4>Appointment Scheduled</h4>
                            <p>New appointment scheduled for next week.</p>
                            <span class="activity-date">5 days ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

