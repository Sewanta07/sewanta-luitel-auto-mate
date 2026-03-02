@extends('layouts.admin')

@section('title', 'Rental Reports')

@section('content')
<div class="ad-rrep-page">
    <div class="ad-rrep-container">
    <div class="ad-rrep-back-wrap">
        <a href="{{ route('admin.rentals.dashboard') }}" class="ad-rrep-back-link">
            <svg class="ad-rrep-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
    <div class="ad-rrep-head">
        <h1 class="ad-rrep-title">Rental Reports & Analytics</h1>
        <p class="ad-rrep-subtitle">Comprehensive rental management statistics</p>
    </div>

    <!-- Summary Cards -->
    <div class="ad-rrep-stats-grid">
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Total Rentals</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-gray">{{ $totalRentals }}</p>
        </div>
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Completed</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-green">{{ $completedRentals }}</p>
        </div>
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Active Rentals</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-blue">{{ $activeRentals }}</p>
        </div>
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Total Revenue</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-purple">Rs. {{ number_format($totalRevenue, 2) }}</p>
        </div>
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Damage Reports</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-red">{{ $damageReports }}</p>
        </div>
    </div>

    <!-- Detailed Rental History -->
    <div class="ad-rrep-panel">
        <div class="ad-rrep-panel-head">
            <h2 class="ad-rrep-panel-title">Recent Rental History</h2>
        </div>
        
        <div class="ad-rrep-table-wrap">
            <table class="ad-rrep-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vehicle</th>
                        <th>Renter</th>
                        <th>Owner</th>
                        <th>Period</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Staff</th>
                        <th>Damage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentRentals as $rental)
                    <tr>
                        <td class="ad-rrep-nowrap ad-rrep-strong">#{{ $rental->id }}</td>
                        <td>
                            {{ $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model) }}
                            <br>
                            <span class="ad-rrep-inline-muted">{{ $rental->vehicle->plate_number }}</span>
                        </td>
                        <td>{{ $rental->renter->name }}</td>
                        <td class="ad-rrep-muted">
                            {{ $rental->vehicle->is_service_center_vehicle ? 'Service Center' : ($rental->owner->name ?? 'Customer') }}
                        </td>
                        <td class="ad-rrep-nowrap ad-rrep-muted">
                            {{ \Carbon\Carbon::parse($rental->start_date)->format('M d') }} - 
                            {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}
                        </td>
                        <td class="ad-rrep-nowrap ad-rrep-strong">
                            Rs. {{ number_format($rental->total_cost, 2) }}
                            @if($rental->damage_charge)
                                <br>
                                <span class="ad-rrep-damage-charge">+Rs. {{ number_format($rental->damage_charge, 2) }} damage</span>
                            @endif
                        </td>
                        <td class="ad-rrep-nowrap">
                            @php
                                $statusColors = [
                                    'Pending' => 'ad-rrep-badge-yellow',
                                    'Approved' => 'ad-rrep-badge-green',
                                    'Ready for Pickup' => 'ad-rrep-badge-blue',
                                    'Picked Up' => 'ad-rrep-badge-indigo',
                                    'In Use' => 'ad-rrep-badge-purple',
                                    'Returned' => 'ad-rrep-badge-gray',
                                    'Completed' => 'ad-rrep-badge-green',
                                    'Rejected' => 'ad-rrep-badge-red',
                                    'Cancelled' => 'ad-rrep-badge-red',
                                ];
                            @endphp
                            <span class="ad-rrep-badge {{ $statusColors[$rental->status] ?? 'ad-rrep-badge-gray' }}">
                                {{ $rental->status }}
                            </span>
                        </td>
                        <td class="ad-rrep-muted">
                            {{ $rental->assignedStaff ? $rental->assignedStaff->name : '-' }}
                        </td>
                        <td class="ad-rrep-center">
                            @if($rental->has_damage)
                                <span class="ad-rrep-badge ad-rrep-badge-red">
                                    Yes
                                </span>
                            @else
                                <span class="ad-rrep-no">No</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="ad-rrep-empty">No rental records found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Insights Section -->
    <div class="ad-rrep-insights-grid">
        <div class="ad-rrep-insight-card">
            <h3 class="ad-rrep-insight-title">Revenue Breakdown</h3>
            <div class="ad-rrep-insight-list">
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Rental Income</span>
                    <span class="ad-rrep-strong">Rs. {{ number_format($totalRevenue, 2) }}</span>
                </div>
                @php
                    $totalDamageCharges = $recentRentals->sum('damage_charge');
                @endphp
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Damage Charges</span>
                    <span class="ad-rrep-text-red">Rs. {{ number_format($totalDamageCharges, 2) }}</span>
                </div>
                <div class="ad-rrep-insight-row ad-rrep-insight-total">
                    <span class="ad-rrep-strong">Total Revenue</span>
                    <span class="ad-rrep-text-green">Rs. {{ number_format($totalRevenue + $totalDamageCharges, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="ad-rrep-insight-card">
            <h3 class="ad-rrep-insight-title">Performance Metrics</h3>
            <div class="ad-rrep-insight-list">
                @php
                    $completionRate = $totalRentals > 0 ? round(($completedRentals / $totalRentals) * 100, 1) : 0;
                    $damageRate = $totalRentals > 0 ? round(($damageReports / $totalRentals) * 100, 1) : 0;
                @endphp
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Completion Rate</span>
                    <span class="ad-rrep-text-green">{{ $completionRate }}%</span>
                </div>
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Damage Rate</span>
                    <span class="{{ $damageRate > 10 ? 'ad-rrep-text-red' : 'ad-rrep-text-yellow' }}">{{ $damageRate }}%</span>
                </div>
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Avg. Rental Value</span>
                    <span class="ad-rrep-text-blue">
                        Rs. {{ $totalRentals > 0 ? number_format($totalRevenue / $totalRentals, 2) : '0.00' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
