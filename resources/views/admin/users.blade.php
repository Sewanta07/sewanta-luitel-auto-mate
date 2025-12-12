@extends('layouts.app')

@section('title', 'Manage Users')

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
                    <span class="user-info">Welcome, {{ $user?->name }}</span>
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
                        <div class="admin-breadcrumb">Admin / Users</div>
                        <h2>Manage Users</h2>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="dashboard-section">
                    <div class="toggle-row">
                        <div class="toggle-buttons">
                            <a href="{{ route('admin.users', ['view' => 'staff']) }}" class="btn-toggle {{ $view === 'staff' ? 'active' : '' }}">Staff</a>
                            <a href="{{ route('admin.users', ['view' => 'customers']) }}" class="btn-toggle {{ $view === 'customers' ? 'active' : '' }}">Customers</a>
                        </div>
                    </div>
                </div>

                @if($view === 'staff')
                    <div class="dashboard-section">
                        <h3>Staff</h3>
                        @if($staff->isEmpty())
                            <p>No staff accounts yet.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Level</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($staff as $member)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.users.show', $member->id) }}" class="name-link">{{ $member->name }}</a>
                                                </td>
                                                <td>{{ $member->email }}</td>
                                                <td><span class="badge {{ $member->status === 'active' ? 'success' : ($member->status === 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($member->status) }}</span></td>
                                                <td>{{ $member->position ?? '—' }}</td>
                                                <td style="white-space: nowrap;">
                                                    @if($member->status !== 'active')
                                                        <form action="{{ route('admin.users.updateStatus', $member->id) }}" method="POST" style="display:inline-block;">
                                                            @csrf
                                                            <input type="hidden" name="status" value="active">
                                                            <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('admin.users.destroy', $member->id) }}" method="POST" style="display:inline-block; margin-left:0.35rem;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="dashboard-section">
                        <h3>Customers</h3>
                        @if($customers->isEmpty())
                            <p>No customer accounts yet.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td><a href="{{ route('admin.users.show', $customer->id) }}" class="name-link">{{ $customer->name }}</a></td>
                                                <td>{{ $customer->email }}</td>
                                                <td style="white-space: nowrap;">
                                                    <form action="{{ route('admin.users.destroy', $customer) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection

