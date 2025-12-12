@extends('layouts.app')

@section('title', 'Staff Dashboard - AutoMate')

@section('content')
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <a href="{{ route('staff.profile') }}" class="btn btn-outline">My Profile</a>
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
                <h2>Staff Dashboard</h2>
                <p>Manage service appointments and vehicle maintenance</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">📋</div>
                    <h3>Service Queue</h3>
                    <p>View and manage pending service requests</p>
                    <a href="#" class="btn btn-primary btn-sm">View Queue</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🔧</div>
                    <h3>Active Services</h3>
                    <p>Track services currently in progress</p>
                    <a href="#" class="btn btn-primary btn-sm">View Active</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">✅</div>
                    <h3>Completed Services</h3>
                    <p>Review completed service records</p>
                    <a href="#" class="btn btn-primary btn-sm">View Completed</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">📊</div>
                    <h3>Reports</h3>
                    <p>Generate service reports and statistics</p>
                    <a href="#" class="btn btn-primary btn-sm">View Reports</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">👤</div>
                    <h3>My Profile</h3>
                    <p>Manage your profile and credentials</p>
                    <a href="{{ route('staff.profile') }}" class="btn btn-primary btn-sm">View Profile</a>
                </div>
            </div>

            <div class="dashboard-section">
                <h3>Today's Schedule</h3>
                <div class="schedule-list">
                    <div class="schedule-item">
                        <div class="schedule-time">09:00 AM</div>
                        <div class="schedule-content">
                            <h4>Oil Change - Vehicle #1234</h4>
                            <p>Customer: John Doe</p>
                        </div>
                        <div class="schedule-status status-pending">Pending</div>
                    </div>
                    <div class="schedule-item">
                        <div class="schedule-time">11:30 AM</div>
                        <div class="schedule-content">
                            <h4>Brake Inspection - Vehicle #5678</h4>
                            <p>Customer: Jane Smith</p>
                        </div>
                        <div class="schedule-status status-in-progress">In Progress</div>
                    </div>
                    <div class="schedule-item">
                        <div class="schedule-time">02:00 PM</div>
                        <div class="schedule-content">
                            <h4>Tire Replacement - Vehicle #9012</h4>
                            <p>Customer: Bob Johnson</p>
                        </div>
                        <div class="schedule-status status-scheduled">Scheduled</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

