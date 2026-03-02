@extends('layouts.admin')

@section('title', 'Analytics - AutoMate')

@section('content')
@php
    $topServiceTypeRows = $topServiceTypes ?? collect();
    $recentPaymentRows = $recentPayments ?? collect();
@endphp
<div class="ad-page ad-analytics-page">
    <div class="ad-container">
        <div class="ad-analytics-head">
            <div>
                <h1 class="ad-title">Analytics Dashboard</h1>
                <p class="ad-subtitle">Business performance, conversion, and trend insights</p>
            </div>
            <form method="GET" action="{{ route('admin.analytics') }}" class="ad-filter-form">
                <label for="period" class="ad-filter-label">Range</label>
                <select id="period" name="period" class="ad-filter-select">
                    @foreach([7, 30, 90, 180, 365] as $period)
                        <option value="{{ $period }}" {{ (int) ($periodDays ?? 30) === $period ? 'selected' : '' }}>Last {{ $period }} days</option>
                    @endforeach
                </select>
                <button type="submit" class="ad-filter-btn">Apply</button>
            </form>
        </div>

        <div class="ad-stat-grid">
            <div class="ad-stat-card">
                <p class="ad-stat-label">Revenue (Selected Range)</p>
                <h3 class="ad-stat-value">Rs. {{ number_format((float) ($periodRevenue ?? 0), 2) }}</h3>
                <p class="ad-stat-note {{ ($periodRevenueChange ?? null) === null ? 'ad-note-muted' : (($periodRevenueChange ?? 0) >= 0 ? 'ad-note-positive' : 'ad-note-negative') }}">
                    @if(($periodRevenueChange ?? null) === null)
                        No prior period baseline
                    @else
                        {{ ($periodRevenueChange ?? 0) >= 0 ? '+' : '' }}{{ number_format((float) ($periodRevenueChange ?? 0), 1) }}% vs previous period
                    @endif
                </p>
            </div>

            <div class="ad-stat-card">
                <p class="ad-stat-label">Completed Services (Range)</p>
                <h3 class="ad-stat-value">{{ number_format((int) ($periodCompletedServices ?? 0)) }}</h3>
                <p class="ad-stat-note ad-note-neutral">All-time completed: {{ number_format((int) ($servicesCompleted ?? 0)) }}</p>
            </div>

            <div class="ad-stat-card">
                <p class="ad-stat-label">Payment Success Rate</p>
                <h3 class="ad-stat-value">{{ number_format((float) ($paymentSuccessRate ?? 0), 1) }}%</h3>
                <p class="ad-stat-note ad-note-neutral">Based on payment attempts in selected range</p>
            </div>

            <div class="ad-stat-card">
                <p class="ad-stat-label">New Customers (Range)</p>
                <h3 class="ad-stat-value">{{ number_format((int) ($periodNewCustomers ?? 0)) }}</h3>
                <p class="ad-stat-note ad-note-neutral">Active customers total: {{ number_format((int) ($activeCustomers ?? 0)) }}</p>
            </div>
        </div>

        <div class="ad-analytics-grid">
            <x-admin.chart-card
                title="Revenue (Selected Range)"
                subtitle="Daily paid totals"
                chart="daily-revenue"
                :series="$dailyRevenue ?? []"
            />

            <x-admin.chart-card
                title="Service Status Breakdown"
                subtitle="All service bookings by status"
                chart="service-status"
                :series="$serviceStatusCounts ?? []"
            />
            <x-admin.chart-card
                title="Revenue (6-Month Trend)"
                subtitle="Monthly paid revenue trend"
                chart="monthly-revenue"
                :series="$monthlyRevenue ?? []"
            />
            <x-admin.chart-card
                title="Inventory Health"
                subtitle="Current stock health distribution"
                chart="service-status"
                :series="$inventoryHealth ?? []"
            />
        </div>

        <div class="ad-analytics-grid">
            <div class="ad-panel">
                <h2 class="ad-panel-title">Top Service Types (Range)</h2>
                <div class="ad-table-wrap">
                    <table class="ad-table">
                        <thead>
                            <tr>
                                <th>Service Type</th>
                                <th>Bookings</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topServiceTypeRows as $service)
                                <tr>
                                    <td>{{ $service->service_type ?: 'Unspecified' }}</td>
                                    <td>{{ number_format((int) $service->total_bookings) }}</td>
                                    <td>Rs. {{ number_format((float) $service->total_amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No completed services in selected range.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="ad-panel">
                <h2 class="ad-panel-title">Recent Payments</h2>
                <div class="ad-table-wrap">
                    <table class="ad-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPaymentRows as $payment)
                                <tr>
                                    <td>{{ $payment->order_id }}</td>
                                    <td>{{ $payment->user->name ?? 'N/A' }}</td>
                                    <td>Rs. {{ number_format((float) $payment->amount, 2) }}</td>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No payments available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                const current = new URL(window.location.href);
                window.location.href = current.toString();
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
