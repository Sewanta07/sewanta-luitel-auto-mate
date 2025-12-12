@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
@php($authUser = auth()->user())
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <span class="user-info">Welcome, {{ $authUser?->name }}</span>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-content admin-layout">
        <aside class="admin-sidebar">
            <div class="sidebar-section">
                <div class="sidebar-title">Navigation</div>
                <a href="{{ route('dashboard.admin') }}" class="sidebar-link">Overview</a>
                <a href="{{ route('admin.profile') }}" class="sidebar-link">Profile</a>
                <a href="{{ route('admin.users') }}" class="sidebar-link">Manage Users</a>
                <a href="{{ route('admin.staff-applications.index') }}" class="sidebar-link">Staff Applications</a>
                <a href="{{ route('admin.vehicles') }}" class="sidebar-link">Vehicles</a>
                <a href="{{ route('admin.analytics') }}" class="sidebar-link">Analytics</a>
                <a href="{{ route('admin.settings') }}" class="sidebar-link">Settings</a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-title">Shortcuts</div>
                <a href="{{ route('logout') }}" class="sidebar-link"
                   onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                    Logout
                </a>
                <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <div class="container">
                <div class="admin-topbar">
                    <div>
                        <div class="admin-breadcrumb">Admin / Users / Profile</div>
                        <h2>{{ $user->name }}</h2>
                        <p>Role: {{ ucfirst($user->role) }} | Status: {{ ucfirst($user->status ?? 'active') }}</p>
                    </div>
                    <div class="admin-top-actions">
                        <a class="btn btn-outline btn-sm" href="{{ url()->previous() }}">Back</a>
                    </div>
                </div>

                <div class="dashboard-section profile-card">
                    <div class="profile-header">
                        <div class="avatar">
                            <span>{{ strtoupper(substr($user->name,0,1)) }}</span>
                        </div>
                        <div>
                            <h3>{{ $user->name }}</h3>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="profile-grid">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>
                        @if($user->role === 'staff')
                        <div class="form-group">
                            <label>Level</label>
                            <input type="text" class="form-control" value="{{ $user->staffDetail->position ?? 'N/A' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" value="{{ $user->staffDetail->phone ?? 'Not provided' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Experience</label>
                            <input type="text" class="form-control" value="{{ $user->staffDetail->experience ?? 'Not provided' }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>Documents</label>
                            <input type="text" class="form-control" value="{{ $user->staffDetail->documents ?? 'Not provided' }}" disabled>
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Member Since</label>
                            <input type="text" class="form-control" value="{{ $user->created_at?->format('M d, Y') }}" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" value="Not provided" disabled>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

