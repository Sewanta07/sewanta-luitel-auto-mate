@extends('layouts.app')

@section('title', 'Rental Vehicles - AutoMate')

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
                <h2>Rental Vehicles</h2>
                <p>Browse, book, and manage rental vehicles.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">🚙</div>
                    <h3>View Rental Vehicles</h3>
                    <p>Browse available rental vehicles</p>
                    <ul class="feature-list">
                        <li>Filter by type and price</li>
                        <li>Vehicle specs and photos</li>
                        <li>Availability calendar</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Browse Rentals</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">📅</div>
                    <h3>Book Rental</h3>
                    <p>Reserve a rental vehicle</p>
                    <ul class="feature-list">
                        <li>Select dates and pickup/drop</li>
                        <li>Insurance options</li>
                        <li>Payment and confirmation</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Book Now</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🗂️</div>
                    <h3>My Rentals</h3>
                    <p>Manage your current and past rentals</p>
                    <ul class="feature-list">
                        <li>Extend or modify bookings</li>
                        <li>View rental agreements</li>
                        <li>Return instructions</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Rentals</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

