@extends('layouts.app')

@section('title', 'My Bookings - AutoMate')

@section('content')
@php($user = auth()->user())
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <a href="{{ route('dashboard.customer') }}" class="btn btn-outline">Dashboard</a>
                    <a href="{{ route('customer.profile') }}" class="btn btn-outline">My Profile</a>
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
                <h2>My Bookings</h2>
                <p>Track pending, ongoing, and completed bookings. Download receipts.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">⏳</div>
                    <h3>Pending Bookings</h3>
                    <p>Bookings awaiting confirmation or start</p>
                    <ul class="feature-list">
                        <li>Reschedule or cancel options</li>
                        <li>View appointment details</li>
                        <li>Contact support</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Pending</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🔧</div>
                    <h3>Ongoing Service</h3>
                    <p>Services currently in progress</p>
                    <ul class="feature-list">
                        <li>Live status updates</li>
                        <li>Technician notes</li>
                        <li>Before/after images</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Ongoing</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">✅</div>
                    <h3>Completed Service</h3>
                    <p>Services finished and ready for pickup</p>
                    <ul class="feature-list">
                        <li>Service summary</li>
                        <li>Recommendations</li>
                        <li>Feedback and ratings</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Completed</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🧾</div>
                    <h3>Booking Receipt</h3>
                    <p>Download invoices and receipts</p>
                    <ul class="feature-list">
                        <li>PDF and email options</li>
                        <li>Tax and itemized details</li>
                        <li>Payment status</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Download Receipt</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

