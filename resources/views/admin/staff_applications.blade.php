@extends('layouts.app')

@section('title', 'Staff Applications')

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
                        <div class="admin-breadcrumb">Admin / Staff Applications</div>
                        <h2>Pending Staff Applications</h2>
                        <p>Review and approve or reject staff requests.</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="dashboard-section">
                    @if($pendingStaff->isEmpty())
                        <p>No pending staff applications.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Applied</th>
                                        <th>Status</th>
                                        <th>Level</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingStaff as $staff)
                                        <tr>
                                            <td>{{ $staff->name }}</td>
                                            <td>{{ $staff->email }}</td>
                                            <td>{{ $staff->created_at?->format('M d, Y') }}</td>
                                            <td><span class="badge warning">{{ ucfirst($staff->status) }}</span></td>
                                            <td>
                                                <form action="{{ route('admin.staff-applications.updateRole', $staff) }}" method="POST" class="inline-form">
                                                    @csrf
                                                    <input type="text" name="level" class="form-control form-control-sm" placeholder="Head / Senior / Junior" value="{{ $staff->position ?? '' }}">
                                            </td>
                                            <td style="white-space: nowrap;">
                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                </form>
                                                <form action="{{ route('admin.staff-applications.approve', $staff) }}" method="POST" style="display:inline-block; margin-left:0.35rem;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline btn-sm">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.staff-applications.reject', $staff) }}" method="POST" style="display:inline-block; margin-left:0.35rem;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline btn-sm">Reject</button>
                                                </form>
                                                <form action="{{ route('admin.staff-applications.destroy', $staff) }}" method="POST" style="display:inline-block; margin-left:0.35rem;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline btn-sm">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

