@extends('layouts.admin')

@section('title', 'Admin Dashboard - AutoMate')

@section('content')
@php
    $recentBookingRows = collect($recentBookings ?? [])->filter()->values();
@endphp
<div class="ad-page">
    <div class="ad-container">
        <div class="ad-head">
            <div>
                <h1 class="ad-title">Admin Dashboard</h1>
                <p class="ad-subtitle">Real-time overview of services, payments, inventory, and operations</p>
            </div>
            <div class="ad-actions">
                <a href="{{ route('admin.analytics') }}" class="ad-btn ad-btn-primary">Open Analytics</a>
                <a href="{{ route('admin.services') }}" class="ad-btn ad-btn-muted">Manage Services</a>
            </div>
        </div>

        <div class="ad-cards">
            <div class="ad-card">
                <p class="ad-card-label">Total Services</p>
                <h3 class="ad-card-value">{{ number_format((int) ($totalServices ?? 0)) }}</h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">In Progress</p>
                <h3 class="ad-card-value">{{ number_format((int) ($inProgressServices ?? 0)) }}</h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Completed Today</p>
                <h3 class="ad-card-value">{{ number_format((int) ($completedToday ?? 0)) }}</h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Total Revenue</p>
                <h3 class="ad-card-value">Rs. {{ number_format((float) ($totalRevenue ?? 0), 2) }}</h3>
            </div>

            <div class="ad-card">
                <p class="ad-card-label">Pending Review</p>
                <h3 class="ad-card-value">{{ number_format((int) ($pendingReview ?? 0)) }}</h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Active Rentals</p>
                <h3 class="ad-card-value">{{ number_format((int) ($activeRentals ?? 0)) }}</h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Low Stock Items</p>
                <h3 class="ad-card-value">{{ number_format((int) ($lowStockItems ?? 0)) }}</h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Pending Withdrawals</p>
                <h3 class="ad-card-value">{{ number_format((int) ($pendingWithdrawals ?? 0)) }}</h3>
            </div>
        </div>

        <div class="ad-grid-2">
            <x-admin.chart-card
                title="Completed Services (6 Months)"
                subtitle="Completed service volume trend"
                chart="admin-performance"
                :series="$monthlyCompletedServices ?? []"
            />

            <x-admin.chart-card
                title="Revenue (6 Months)"
                subtitle="Paid transactions trend"
                chart="monthly-revenue"
                :series="$monthlyRevenue ?? []"
            />
            <x-admin.chart-card
                title="Service Status Mix"
                subtitle="Distribution across all statuses"
                chart="service-status"
                :series="$serviceStatusCounts ?? []"
            />
            <x-admin.chart-card
                title="Inventory Health"
                subtitle="In stock vs low stock vs out of stock"
                chart="service-status"
                :series="$inventoryHealth ?? []"
            />
        </div>

        <div class="ad-grid-2">
            <div class="ad-panel">
                <div class="ad-panel-head">
                    <h2 class="ad-panel-title">Recent Service Bookings</h2>
                    <a href="{{ route('admin.services') }}" class="ad-panel-link">View all</a>
                </div>
                <div class="ad-table-wrap">
                    <table class="ad-table">
                        <thead>
                            <tr>
                                <th>Booking</th>
                                <th>Customer</th>
                                <th>Staff</th>
                                <th>Status</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookingRows as $booking)
                                <tr>
                                    <td>{{ data_get($booking, 'booking_code', '#' . data_get($booking, 'id')) }}</td>
                                    <td>{{ data_get($booking, 'customer.name', 'N/A') }}</td>
                                    <td>{{ data_get($booking, 'staff.name', 'Unassigned') }}</td>
                                    <td>{{ data_get($booking, 'status', 'N/A') }}</td>
                                    <td>{{ optional(data_get($booking, 'updated_at'))->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No service bookings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ad-panel">
                <h2 class="ad-panel-title">Quick Actions</h2>
                <div class="ad-quick">
                    <a href="{{ route('admin.users') }}" class="ad-quick-link">Manage Users</a>
                    <a href="{{ route('admin.staff-applications.index') }}" class="ad-quick-link">Review Staff Applications</a>
                    <a href="{{ route('admin.inventory.index') }}" class="ad-quick-link">Check Inventory</a>
                    <a href="{{ route('admin.messages') }}" class="ad-quick-link">Open Messages</a>
                </div>

                <div class="ad-revenue">
                    <p class="ad-revenue-label">Service Revenue</p>
                    <p class="ad-revenue-value">Rs. {{ number_format((float) ($totalServiceCharge ?? 0), 2) }}</p>
                    <p class="ad-revenue-note">From completed service bookings</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let reloadTimer = null;

        const scheduleReload = () => {
            if (reloadTimer) {
                return;
            }

            reloadTimer = setTimeout(() => {
                window.location.reload();
            }, 1200);
        };

        if (window.realtime) {
            window.realtime.subscribeDashboard('admin', null, {
                serviceStatus: scheduleReload,
                rentalStatus: scheduleReload,
                paymentStatus: scheduleReload,
                inventoryUpdated: scheduleReload,
                earningsUpdated: scheduleReload,
                withdrawalUpdated: scheduleReload,
            });
        }
    });
</script>
@endpush
