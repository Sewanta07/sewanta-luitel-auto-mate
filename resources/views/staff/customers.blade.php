@extends('layouts.app')

@section('title', 'Customer Interaction - AutoMate')

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
                <h2>Customer Interaction</h2>
                <p>Access limited customer details for assigned services.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">👥</div>
                    <h3>Customer Details</h3>
                    <p>See customer contact info for assigned bookings</p>
                    <ul class="feature-list">
                        <li>Name, phone, and email (limited view)</li>
                        <li>Vehicle details for the booking</li>
                        <li>Service notes and preferences</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Customers</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">☎️</div>
                    <h3>Contact Customer</h3>
                    <p>Quick access to contact options</p>
                    <ul class="feature-list">
                        <li>Call and SMS shortcuts</li>
                        <li>Predefined update messages</li>
                        <li>Log communications</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Contact Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

