@extends('layouts.app')

@section('title', 'Admin Dashboard - AutoMate')

@section('content')
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <span class="user-info">Welcome, {{ $user->name }}</span>
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
                        <div class="admin-breadcrumb">Home / Dashboard</div>
                        <h2>Admin Dashboard</h2>
                        <p>Use the navigation to manage users, staff approvals, and system settings.</p>
                    </div>
                    <div class="admin-top-actions">
                        <button class="btn btn-outline btn-sm">Today</button>
                        <button class="btn btn-outline btn-sm">This Week</button>
                        <button class="btn btn-primary btn-sm">This Month</button>
                    </div>
                </div>

                <div class="stat-grid">
                    <div class="stat-card primary">
                        <div class="stat-label">Sales</div>
                        <div class="stat-value">3,500</div>
                        <div class="stat-meta">+6.5% vs last week</div>
                    </div>
                    <div class="stat-card secondary">
                        <div class="stat-label">Orders</div>
                        <div class="stat-value">2,900</div>
                        <div class="stat-meta">+2.1%</div>
                    </div>
                    <div class="stat-card neutral">
                        <div class="stat-label">Invoices</div>
                        <div class="stat-value">6,500</div>
                        <div class="stat-meta">On track</div>
                    </div>
                    <div class="stat-card accent">
                        <div class="stat-label">Alerts</div>
                        <div class="stat-value">72</div>
                        <div class="stat-meta">2 new</div>
                    </div>
                </div>

                <div class="admin-panels">
                    <div class="panel highlight">
                        <div class="panel-header">
                            <div>
                                <div class="panel-title">Congratulations, {{ $user->name ?? 'Admin' }} 🎉</div>
                                <div class="panel-subtitle">You have added 66% more protection than last year.</div>
                            </div>
                        </div>
                        <div class="panel-metrics">
                            <div class="panel-metric">
                                <div class="metric-label">Income</div>
                                <div class="metric-value">$4,800</div>
                            </div>
                            <div class="panel-metric">
                                <div class="metric-label">Expenses</div>
                                <div class="metric-value">$2,300</div>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-header">
                            <div class="panel-title">Overall Sales</div>
                        </div>
                        <div class="panel-chart-placeholder">Chart area</div>
                    </div>
                </div>

                <div class="admin-quick">
                    <div class="dashboard-section">
                        <h3>Quick Actions</h3>
                        <div class="quick-links">
                            <a href="#" class="quick-link">
                                <span class="quick-icon">👤</span>
                                Profile
                            </a>
                            <a href="{{ route('admin.users') }}" class="quick-link">
                                <span class="quick-icon">👥</span>
                                Manage Users
                            </a>
                            <a href="{{ route('admin.staff-applications.index') }}" class="quick-link">
                                <span class="quick-icon">🧾</span>
                                Staff Applications
                            </a>
                            <a href="{{ route('admin.settings') }}" class="quick-link">
                                <span class="quick-icon">⚙️</span>
                                Settings
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

