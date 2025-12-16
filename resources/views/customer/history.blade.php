@extends('layouts.app')

@section('title', 'Service History - AutoMate')

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
                <h2>Service History</h2>
                <p>Review past services and download invoices.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">📜</div>
                    <h3>Past Services</h3>
                    <p>All services completed for your vehicles</p>
                    <ul class="feature-list">
                        <li>Filter by vehicle and date</li>
                        <li>View technician notes</li>
                        <li>Before/after photos</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View History</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🧾</div>
                    <h3>Download Invoice</h3>
                    <p>Get invoices for completed services</p>
                    <ul class="feature-list">
                        <li>PDF download</li>
                        <li>Email invoice</li>
                        <li>Payment details</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Download</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

