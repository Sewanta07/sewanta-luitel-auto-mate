@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<main class="ad-users-main">
            <div class="ad-users-head">
                <div>
                    <h1 class="ad-users-title">Manage Users</h1>
                    <p class="ad-users-subtitle">View and manage staff and customer accounts.</p>
                </div>
                <div class="ad-users-tabs">
                    <a href="{{ route('admin.users', ['view' => 'staff']) }}" class="ad-users-tab {{ $view === 'staff' ? 'ad-users-tab-active' : '' }}">Staff</a>
                    <a href="{{ route('admin.users', ['view' => 'customers']) }}" class="ad-users-tab {{ $view === 'customers' ? 'ad-users-tab-active' : '' }}">Customers</a>
                </div>
            </div>

            @if(session('success'))
                <div class="ad-users-alert ad-users-alert-success">
                    <svg class="ad-users-alert-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="ad-users-alert-text">{{ session('success') }}</span>
                </div>
            @endif

            <div class="ad-users-card">
                @if($view === 'staff')
                    <div class="ad-users-card-head">
                        <h2 class="ad-users-card-title">Staff Members</h2>
                    </div>
                    @if($staff->isEmpty())
                        <div class="ad-users-empty">
                            No staff accounts found.
                        </div>
                    @else
                        <div class="ad-users-table-wrap">
                            <table class="ad-users-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Level</th>
                                        <th scope="col" class="ad-align-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staff as $member)
                                        <tr>
                                            <td>
                                                <div class="ad-users-name-cell">
                                                    <div class="ad-users-avatar ad-users-avatar-staff">
                                                        {{ substr($member->name, 0, 1) }}
                                                    </div>
                                                    <span class="ad-users-name">{{ $member->name }}</span>
                                                </div>
                                            </td>
                                            <td class="ad-users-email">{{ $member->email }}</td>
                                            <td>
                                                <span class="ad-users-status-badge {{ $member->status === 'active' ? 'ad-users-status-active' : ($member->status === 'pending' ? 'ad-users-status-pending' : 'ad-users-status-inactive') }}">
                                                    {{ ucfirst($member->status) }}
                                                </span>
                                            </td>
                                            <td class="ad-users-level">{{ $member->position ?? '—' }}</td>
                                            <td class="ad-users-actions-cell">
                                                @if($member->status !== 'active')
                                                    <form action="{{ route('admin.users.updateStatus', $member->id) }}" method="POST" class="ad-users-inline-form">
                                                        @csrf
                                                        <input type="hidden" name="status" value="active">
                                                        <button type="submit" class="ad-users-action-link ad-users-action-approve">Approve</button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.users.destroy', $member->id) }}" method="POST" class="ad-users-inline-form" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ad-users-action-link ad-users-action-delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @else
                    <div class="ad-users-card-head">
                        <h2 class="ad-users-card-title">Registered Customers</h2>
                    </div>
                    @if($customers->isEmpty())
                        <div class="ad-users-empty">
                            No customer accounts found.
                        </div>
                    @else
                        <div class="ad-users-table-wrap">
                            <table class="ad-users-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" class="ad-align-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>
                                                <div class="ad-users-name-cell">
                                                    <div class="ad-users-avatar ad-users-avatar-customer">
                                                        {{ substr($customer->name, 0, 1) }}
                                                    </div>
                                                    <span class="ad-users-name">{{ $customer->name }}</span>
                                                </div>
                                            </td>
                                            <td class="ad-users-email">{{ $customer->email }}</td>
                                            <td class="ad-users-actions-cell">
                                                <form action="{{ route('admin.users.destroy', $customer) }}" method="POST" class="ad-users-inline-form" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="ad-users-action-link ad-users-action-delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endif
            </div>
</main>
@endsection
