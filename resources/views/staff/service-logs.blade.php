@extends('layouts.app')

@section('title', 'Service Logs - AutoMate')

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
                <h2>Service Logs</h2>
                <p>View completed services and your service history.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">📑</div>
                    <h3>Completed Services</h3>
                    <p>All services marked as completed</p>
                    <ul class="feature-list">
                        <li>Filter by date and vehicle</li>
                        <li>View before/after images</li>
                        <li>Download service report</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Completed</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🕑</div>
                    <h3>My Service History</h3>
                    <p>Services assigned to you</p>
                    <ul class="feature-list">
                        <li>Track workload and performance</li>
                        <li>See customer feedback</li>
                        <li>Export history to CSV</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View History</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

