@extends('layouts.app')

@section('title', 'Staff Bookings - AutoMate')

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
                <h2>Booking Management</h2>
                <p>View assigned bookings, change status, add notes, and upload before/after images.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">🗂️</div>
                    <h3>Assigned Bookings</h3>
                    <p>List of bookings assigned to you</p>
                    <ul class="feature-list">
                        <li>Filter by status: Pending / In Service / Completed</li>
                        <li>Sort by date or priority</li>
                        <li>Quick search by customer or vehicle</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Assigned</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🔄</div>
                    <h3>Change Status</h3>
                    <p>Update booking status as you work</p>
                    <ul class="feature-list">
                        <li>Pending → In Service → Completed</li>
                        <li>Add timestamps and remarks</li>
                        <li>Notify customer on status change</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Update Status</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">📝</div>
                    <h3>Service Notes</h3>
                    <p>Add technical notes for each booking</p>
                    <ul class="feature-list">
                        <li>Work performed and observations</li>
                        <li>Parts used and torque specs</li>
                        <li>Next recommended services</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Add Notes</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">📷</div>
                    <h3>Before / After Photos</h3>
                    <p>Upload images for quality assurance</p>
                    <ul class="feature-list">
                        <li>Attach before/after shots</li>
                        <li>Tag damages or replaced parts</li>
                        <li>Visible in service history</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Upload Images</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

