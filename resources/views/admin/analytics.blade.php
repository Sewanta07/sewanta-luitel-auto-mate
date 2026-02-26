@extends('layouts.admin')

@section('title', 'Analytics - AutoMate')

@section('content')
@php
    $topServiceTypeRows = $topServiceTypes ?? collect();
    $recentPaymentRows = $recentPayments ?? collect();
@endphp
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Analytics Dashboard</h1>
                <p class="text-gray-600">Business performance, conversion, and trend insights</p>
            </div>
            <form method="GET" action="{{ route('admin.analytics') }}" class="flex items-center gap-2">
                <label for="period" class="text-sm font-medium text-gray-600">Range</label>
                <select id="period" name="period" class="rounded-lg border-gray-300 text-sm focus:ring-[#ff5a1f] focus:border-[#ff5a1f]">
                    @foreach([7, 30, 90, 180, 365] as $period)
                        <option value="{{ $period }}" {{ (int) ($periodDays ?? 30) === $period ? 'selected' : '' }}>Last {{ $period }} days</option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 rounded-lg bg-[#ff5a1f] text-white text-sm font-semibold hover:opacity-90">Apply</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Revenue (Selected Range)</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rs. {{ number_format((float) ($periodRevenue ?? 0), 2) }}</h3>
                <p class="text-xs mt-2 {{ ($periodRevenueChange ?? null) === null ? 'text-gray-400' : (($periodRevenueChange ?? 0) >= 0 ? 'text-green-600' : 'text-red-600') }}">
                    @if(($periodRevenueChange ?? null) === null)
                        No prior period baseline
                    @else
                        {{ ($periodRevenueChange ?? 0) >= 0 ? '+' : '' }}{{ number_format((float) ($periodRevenueChange ?? 0), 1) }}% vs previous period
                    @endif
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Completed Services (Range)</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format((int) ($periodCompletedServices ?? 0)) }}</h3>
                <p class="text-xs text-gray-500 mt-2">All-time completed: {{ number_format((int) ($servicesCompleted ?? 0)) }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Payment Success Rate</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format((float) ($paymentSuccessRate ?? 0), 1) }}%</h3>
                <p class="text-xs text-gray-500 mt-2">Based on payment attempts in selected range</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">New Customers (Range)</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ number_format((int) ($periodNewCustomers ?? 0)) }}</h3>
                <p class="text-xs text-gray-500 mt-2">Active customers total: {{ number_format((int) ($activeCustomers ?? 0)) }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Top Service Types (Range)</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-3 pr-4">Service Type</th>
                                <th class="py-3 pr-4">Bookings</th>
                                <th class="py-3 pr-4">Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topServiceTypeRows as $service)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 pr-4 text-gray-800 font-semibold">{{ $service->service_type ?: 'Unspecified' }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ number_format((int) $service->total_bookings) }}</td>
                                    <td class="py-3 pr-4 text-gray-700">Rs. {{ number_format((float) $service->total_amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-6 text-center text-gray-500">No completed services in selected range.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Payments</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-3 pr-4">Order</th>
                                <th class="py-3 pr-4">Customer</th>
                                <th class="py-3 pr-4">Amount</th>
                                <th class="py-3 pr-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPaymentRows as $payment)
                                <tr class="border-b last:border-0">
                                    <td class="py-3 pr-4 text-gray-800 font-semibold">{{ $payment->order_id }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ $payment->user->name ?? 'N/A' }}</td>
                                    <td class="py-3 pr-4 text-gray-700">Rs. {{ number_format((float) $payment->amount, 2) }}</td>
                                    <td class="py-3 pr-4 text-gray-700">{{ ucfirst($payment->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500">No payments available.</td>
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
