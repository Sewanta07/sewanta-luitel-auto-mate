@extends('layouts.app')

@section('title', 'My Vehicles - AutoMate')

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
                <h2>Vehicle Management</h2>
                <p>Add, edit, and manage your vehicles.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">➕</div>
                    <h3>Add Vehicle</h3>
                    <p>Register a new vehicle to your account</p>
                    <ul class="feature-list">
                        <li>VIN, make, model, year</li>
                        <li>License plate and color</li>
                        <li>Notes and attachments</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Add Vehicle</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🚗</div>
                    <h3>My Vehicles</h3>
                    <p>View all registered vehicles</p>
                    <ul class="feature-list">
                        <li>Default vehicle selection</li>
                        <li>Service history per vehicle</li>
                        <li>Upcoming bookings per vehicle</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Vehicles</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">✏️</div>
                    <h3>Edit / Delete</h3>
                    <p>Update details or remove a vehicle</p>
                    <ul class="feature-list">
                        <li>Edit stored details</li>
                        <li>Delete vehicle safely</li>
                        <li>Reassign bookings if needed</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Manage Vehicles</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

