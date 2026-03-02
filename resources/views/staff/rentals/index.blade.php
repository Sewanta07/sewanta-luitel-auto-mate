@extends('layouts.staff')

@section('title', 'Rental Operations')

@section('content')
<div class="sf-ridx-page">
    <div class="sf-ridx-main">
        <div class="sf-ridx-head">
            <h1 class="sf-ridx-title">Rental Operations Dashboard</h1>
            <p class="sf-ridx-subtitle">Manage assigned rental vehicles and handle pickups, inspections, and returns</p>
        </div>

        <div class="sf-ridx-stats">
            <div class="sf-ridx-stat sf-ridx-stat-blue">
                <div class="sf-ridx-stat-row">
                    <div>
                        <h3 class="sf-ridx-stat-label">Total Assigned</h3>
                        <p class="sf-ridx-stat-value">{{ $stats['assigned_rentals'] }}</p>
                    </div>
                    <svg class="sf-ridx-stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="sf-ridx-stat sf-ridx-stat-green">
                <div class="sf-ridx-stat-row">
                    <div>
                        <h3 class="sf-ridx-stat-label">Ready for Pickup</h3>
                        <p class="sf-ridx-stat-value">{{ $stats['ready_for_pickup'] }}</p>
                    </div>
                    <svg class="sf-ridx-stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <div class="sf-ridx-stat sf-ridx-stat-purple">
                <div class="sf-ridx-stat-row">
                    <div>
                        <h3 class="sf-ridx-stat-label">Currently In Use</h3>
                        <p class="sf-ridx-stat-value">{{ $stats['active_rentals'] }}</p>
                    </div>
                    <svg class="sf-ridx-stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>

            <div class="sf-ridx-stat sf-ridx-stat-orange">
                <div class="sf-ridx-stat-row">
                    <div>
                        <h3 class="sf-ridx-stat-label">Due for Return</h3>
                        <p class="sf-ridx-stat-value">{{ $stats['awaiting_return'] }}</p>
                    </div>
                    <svg class="sf-ridx-stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="sf-ridx-flash-success">
                <svg class="sf-ridx-flash-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="sf-ridx-list">
            @forelse($rentals as $rental)
                <div class="sf-ridx-card {{ 
                    $rental->status === 'Approved' ? 'sf-ridx-card-approved' : 
                    ($rental->status === 'Ready for Pickup' ? 'sf-ridx-card-ready' : 
                    ($rental->status === 'Picked Up' ? 'sf-ridx-card-picked' : 
                    ($rental->status === 'In Use' ? 'sf-ridx-card-inuse' : 
                    ($rental->status === 'Returned' ? 'sf-ridx-card-returned' : 'sf-ridx-card-default'))))
                }}">
                    <div class="sf-ridx-card-body">
                        <div class="sf-ridx-card-head">
                            <div>
                                <h3 class="sf-ridx-vehicle-name">
                                    {{ $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model) }}
                                </h3>
                                <p class="sf-ridx-plate-wrap">
                                    <span class="sf-ridx-plate-inline">
                                        <svg class="sf-ridx-plate-icon" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                        </svg>
                                        {{ $rental->vehicle->plate_number }}
                                    </span>
                                </p>
                            </div>

                            @php
                                $statusConfig = [
                                    'Approved' => ['class' => 'sf-ridx-status-approved', 'icon' => '📋'],
                                    'Ready for Pickup' => ['class' => 'sf-ridx-status-ready', 'icon' => '✓'],
                                    'Picked Up' => ['class' => 'sf-ridx-status-picked', 'icon' => '🚗'],
                                    'In Use' => ['class' => 'sf-ridx-status-inuse', 'icon' => '⏱️'],
                                    'Returned' => ['class' => 'sf-ridx-status-returned', 'icon' => '✓✓'],
                                ];
                                $config = $statusConfig[$rental->status] ?? ['class' => 'sf-ridx-status-default', 'icon' => '•'];
                            @endphp
                            <span class="sf-ridx-status-chip {{ $config['class'] }}">
                                {{ $rental->status }}
                            </span>
                        </div>

                        <div class="sf-ridx-meta-grid">
                            <div class="sf-ridx-meta-card">
                                <p class="sf-ridx-meta-label">Renter</p>
                                <p class="sf-ridx-meta-primary">{{ $rental->renter->name }}</p>
                                <p class="sf-ridx-meta-secondary">{{ $rental->renter->email }}</p>
                                @if($rental->renter_contact)
                                    <p class="sf-ridx-meta-secondary sf-ridx-meta-secondary-gap">{{ $rental->renter_contact }}</p>
                                @endif
                            </div>

                            <div class="sf-ridx-meta-card">
                                <p class="sf-ridx-meta-label">Rental Period</p>
                                <p class="sf-ridx-meta-primary">
                                    {{ \Carbon\Carbon::parse($rental->start_date)->format('M d') }}
                                </p>
                                <p class="sf-ridx-meta-secondary">to {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</p>
                                <p class="sf-ridx-meta-days">
                                    {{ \Carbon\Carbon::parse($rental->start_date)->diffInDays(\Carbon\Carbon::parse($rental->end_date)) + 1 }} days
                                </p>
                            </div>

                            <div class="sf-ridx-meta-card">
                                <p class="sf-ridx-meta-label">Pickup Location</p>
                                @if($rental->pickup_location)
                                    <p class="sf-ridx-meta-primary">{{ $rental->pickup_location }}</p>
                                @else
                                    <p class="sf-ridx-meta-empty">Not specified</p>
                                @endif
                            </div>

                            <div class="sf-ridx-meta-card">
                                <p class="sf-ridx-meta-label">Total Cost</p>
                                <p class="sf-ridx-cost">Rs. {{ number_format($rental->total_cost, 2) }}</p>
                            </div>
                        </div>

                        <div class="sf-ridx-actions">
                            @if($rental->status === 'Approved')
                                <a href="{{ route('staff.rentals.inspection', $rental) }}" 
                                   class="sf-ridx-btn sf-ridx-btn-blue">
                                    <svg class="sf-ridx-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    Start Pre-Inspection
                                </a>
                            @elseif($rental->status === 'Ready for Pickup')
                                <form action="{{ route('staff.rentals.pickup', $rental) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="sf-ridx-btn sf-ridx-btn-green">
                                        <svg class="sf-ridx-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Confirm Pickup
                                    </button>
                                </form>
                            @elseif($rental->status === 'Picked Up')
                                <form action="{{ route('staff.rentals.status', $rental) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="In Use">
                                    <button type="submit" class="sf-ridx-btn sf-ridx-btn-purple">
                                        <svg class="sf-ridx-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        Mark as In Use
                                    </button>
                                </form>
                            @elseif($rental->status === 'In Use')
                                <a href="{{ route('staff.rentals.inspection', $rental) }}" 
                                   class="sf-ridx-btn sf-ridx-btn-orange">
                                    <svg class="sf-ridx-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    Start Return Inspection
                                </a>
                            @elseif($rental->status === 'Returned')
                                <form action="{{ route('staff.rentals.complete', $rental) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="sf-ridx-btn sf-ridx-btn-green">
                                        <svg class="sf-ridx-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Complete Rental
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="sf-ridx-empty">
                    <svg class="sf-ridx-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <p class="sf-ridx-empty-title">No rentals assigned yet</p>
                    <p class="sf-ridx-empty-copy">Rentals will appear here once the admin assigns them to you</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
