@extends('layouts.app')

@section('title', 'Inventory Requests - AutoMate')

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
                <h2>Inventory Requests</h2>
                <p>Request parts and track request status.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">📦</div>
                    <h3>Request Inventory</h3>
                    <p>Create new requests for parts and consumables</p>
                    <ul class="feature-list">
                        <li>Select part, quantity, urgency</li>
                        <li>Add VIN/vehicle reference</li>
                        <li>Attach photos if needed</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">New Request</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">📈</div>
                    <h3>Request Status</h3>
                    <p>Track approvals and fulfillment</p>
                    <ul class="feature-list">
                        <li>Status: Pending / Approved / Fulfilled</li>
                        <li>Expected arrival dates</li>
                        <li>Notes from inventory team</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Requests</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

