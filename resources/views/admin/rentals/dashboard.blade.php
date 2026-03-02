@extends('layouts.admin')

@section('title', 'Rental Dashboard')

@section('content')
<div class="ad-rdash-page">
    <div class="ad-rdash-container">
        <!-- Page Header -->
        <div class="ad-rdash-head">
            <h1 class="ad-rdash-title">Rental Management Dashboard</h1>
            <p class="ad-rdash-subtitle">Monitor and manage all rental operations</p>
        </div>

    <!-- Statistics Cards -->
    <div class="ad-rdash-stats">
        <!-- Total Vehicles -->
        <div class="ad-rdash-stat-card">
            <div class="ad-rdash-stat-row">
                <div>
                    <p class="ad-rdash-stat-label">Total Rental Vehicles</p>
                    <h3 class="ad-rdash-stat-value">{{ $stats['total_vehicles'] }}</h3>
                </div>
                <div class="ad-rdash-stat-icon blue">
                    <svg class="ad-rdash-stat-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Rentals -->
        <div class="ad-rdash-stat-card">
            <div class="ad-rdash-stat-row">
                <div>
                    <p class="ad-rdash-stat-label">Active Rentals</p>
                    <h3 class="ad-rdash-stat-value green">{{ $stats['active_rentals'] }}</h3>
                </div>
                <div class="ad-rdash-stat-icon green">
                    <svg class="ad-rdash-stat-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="ad-rdash-stat-card">
            <div class="ad-rdash-stat-row">
                <div>
                    <p class="ad-rdash-stat-label">Pending Requests</p>
                    <h3 class="ad-rdash-stat-value yellow">{{ $stats['pending_requests'] }}</h3>
                </div>
                <div class="ad-rdash-stat-icon yellow">
                    <svg class="ad-rdash-stat-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Listings -->
        <div class="ad-rdash-stat-card">
            <div class="ad-rdash-stat-row">
                <div>
                    <p class="ad-rdash-stat-label">Pending Listings</p>
                    <h3 class="ad-rdash-stat-value orange">{{ $stats['pending_listings'] }}</h3>
                </div>
                <div class="ad-rdash-stat-icon orange">
                    <svg class="ad-rdash-stat-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="ad-rdash-stat-card">
            <div class="ad-rdash-stat-row">
                <div>
                    <p class="ad-rdash-stat-label">Total Revenue</p>
                    <h3 class="ad-rdash-stat-value purple">Rs. {{ number_format($stats['total_revenue'], 2) }}</h3>
                </div>
                <div class="ad-rdash-stat-icon purple">
                    <svg class="ad-rdash-stat-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="ad-rdash-actions-grid">
        <a href="{{ route('admin.rentals.vehicles') }}" class="ad-rdash-action-link blue">
            <h3 class="ad-rdash-action-title">Manage Vehicles</h3>
            <p class="ad-rdash-action-note">Add or edit rental vehicles</p>
        </a>
        <a href="{{ route('admin.rentals.requests') }}" class="ad-rdash-action-link green">
            <h3 class="ad-rdash-action-title">Rental Requests</h3>
            <p class="ad-rdash-action-note">Approve or reject rentals</p>
        </a>
        <a href="{{ route('admin.rentals.pending-listings') }}" class="ad-rdash-action-link orange">
            <h3 class="ad-rdash-action-title">Pending Listings</h3>
            <p class="ad-rdash-action-note">Approve customer vehicles</p>
        </a>
        <a href="{{ route('admin.owner-vehicles.index') }}" class="ad-rdash-action-link amber">
            <h3 class="ad-rdash-action-title">Owner Listings</h3>
            <p class="ad-rdash-action-note">Approve marketplace entries</p>
        </a>
        <a href="{{ route('admin.earnings.payouts') }}" class="ad-rdash-action-link emerald">
            <h3 class="ad-rdash-action-title">Owner Payouts</h3>
            <p class="ad-rdash-action-note">Mark owner withdrawals paid</p>
        </a>
        <a href="{{ route('admin.rentals.reports') }}" class="ad-rdash-action-link purple">
            <h3 class="ad-rdash-action-title">Reports</h3>
            <p class="ad-rdash-action-note">View analytics and reports</p>
        </a>
    </div>

    <!-- Recent Rentals -->
    <div class="ad-rdash-panel">
        <div class="ad-rdash-panel-head">
            <h2 class="ad-rdash-panel-title">Recent Rental Activity</h2>
        </div>
        <div class="ad-rdash-table-wrap">
            <table class="ad-rdash-table">
                <thead>
                    <tr>
                        <th>Rental ID</th>
                        <th>Vehicle</th>
                        <th>Renter</th>
                        <th>Owner</th>
                        <th>Dates</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Damage</th>
                        <th>Damage Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRentals as $rental)
                    <tr>
                        <td class="ad-rdash-strong">#{{ $rental->id }}</td>
                        <td>
                            {{ $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model) }}
                        </td>
                        <td>{{ $rental->renter->name }}</td>
                        <td class="ad-rdash-muted">
                            {{ $rental->vehicle->is_service_center_vehicle ? 'Service Center' : ($rental->owner->name ?? 'Customer') }}
                        </td>
                        <td class="ad-rdash-muted">
                            {{ \Carbon\Carbon::parse($rental->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}
                        </td>
                        <td>
                            @php
                                $statusClasses = [
                                    'Pending' => 'ad-rdash-badge-yellow',
                                    'Approved' => 'ad-rdash-badge-green',
                                    'Ready for Pickup' => 'ad-rdash-badge-blue',
                                    'Picked Up' => 'ad-rdash-badge-indigo',
                                    'In Use' => 'ad-rdash-badge-purple',
                                    'Returned' => 'ad-rdash-badge-gray',
                                    'Completed' => 'ad-rdash-badge-green',
                                    'Rejected' => 'ad-rdash-badge-red',
                                ];
                            @endphp
                            <span class="ad-rdash-badge {{ $statusClasses[$rental->status] ?? 'ad-rdash-badge-gray' }}">
                                {{ $rental->status }}
                            </span>
                        </td>
                        <td class="ad-rdash-strong">Rs. {{ number_format($rental->total_cost, 2) }}</td>
                        <td>
                            @if($rental->has_damage)
                                Rs. {{ number_format($rental->damage_charge ?? 0, 2) }}
                            @else
                                <span class="ad-rdash-none">None</span>
                            @endif
                        </td>
                        <td>
                            <span class="ad-rdash-badge
                                @if(($rental->damage_payment_status ?? 'Unpaid') === 'Paid') ad-rdash-badge-green
                                @elseif(($rental->damage_payment_status ?? 'Unpaid') === 'Not Required') ad-rdash-badge-gray
                                @else ad-rdash-badge-yellow @endif">
                                {{ $rental->damage_payment_status ?? 'Unpaid' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="ad-rdash-empty">No recent rental activity</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
@endsection
