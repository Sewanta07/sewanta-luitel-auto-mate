@extends('layouts.admin')

@section('title', 'Service Invoice')

@section('content')
<div class="ad-sinv-page">
    <div class="ad-sinv-container">
        <div class="ad-sinv-panel">
            <div class="ad-sinv-head">
                <div>
                    <h1 class="ad-sinv-title">Service Invoice</h1>
                    <p class="ad-sinv-subtitle">Booking {{ $booking->booking_code }}</p>
                </div>
                <span class="ad-sinv-badge ad-sinv-badge-green">{{ $booking->status }}</span>
            </div>

            <div class="ad-sinv-grid-2">
                <div>
                    <p class="ad-sinv-meta-label">Customer</p>
                    <p class="ad-sinv-meta-title">{{ $booking->customer->name ?? 'N/A' }}</p>
                    <p class="ad-sinv-meta-subtitle">{{ $booking->customer->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="ad-sinv-meta-label">Staff</p>
                    <p class="ad-sinv-meta-title">{{ $booking->staff->name ?? 'Unassigned' }}</p>
                    <p class="ad-sinv-meta-subtitle">{{ $booking->staff->email ?? '' }}</p>
                </div>
                <div>
                    <p class="ad-sinv-meta-label">Vehicle</p>
                    <p class="ad-sinv-meta-title">{{ $booking->vehicle_model }}</p>
                    <p class="ad-sinv-meta-subtitle">{{ $booking->vehicle_number }} • {{ $booking->vehicle_type }}</p>
                </div>
                <div>
                    <p class="ad-sinv-meta-label">Service</p>
                    <p class="ad-sinv-meta-title">{{ $booking->service_type }}</p>
                    <p class="ad-sinv-meta-subtitle">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }} • {{ $booking->preferred_time_slot }}</p>
                </div>
                <div>
                    <p class="ad-sinv-meta-label">Priority</p>
                    <p class="ad-sinv-meta-small">{{ $booking->service_priority }}</p>
                </div>
                <div>
                    <p class="ad-sinv-meta-label">Location</p>
                    <p class="ad-sinv-meta-small">{{ $booking->service_location_type }}</p>
                </div>
            </div>

            @php($partsTotal = $booking->parts->sum('pivot.total_cost'))
            @php($serviceTotal = (float) ($booking->service_cost ?? 0) + (float) ($booking->spare_parts_cost ?? 0) + (float) $partsTotal)
            @php($displayTotal = $serviceTotal)

            <div class="ad-sinv-section">
                <h3 class="ad-sinv-section-title">Parts Used</h3>
                <div class="ad-sinv-table-panel">
                    <table class="ad-sinv-table">
                        <thead>
                            <tr>
                                <th>Part</th>
                                <th class="ad-sinv-align-center">Qty</th>
                                <th class="ad-sinv-align-right">Unit Price</th>
                                <th class="ad-sinv-align-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($booking->parts as $part)
                                <tr>
                                    <td>{{ $part->part_name }}</td>
                                    <td class="ad-sinv-align-center ad-sinv-muted">{{ $part->pivot->quantity }}</td>
                                    <td class="ad-sinv-align-right ad-sinv-muted">Rs. {{ number_format($part->pivot->unit_price, 2) }}</td>
                                    <td class="ad-sinv-align-right ad-sinv-strong">Rs. {{ number_format($part->pivot->total_cost, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="ad-sinv-empty">No parts recorded.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="ad-sinv-align-right">Parts Total</td>
                                <td class="ad-sinv-align-right ad-sinv-accent">Rs. {{ number_format($partsTotal, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="ad-sinv-section">
                <div class="ad-sinv-summary-row">
                    <p class="ad-sinv-summary-label">Service Cost</p>
                    <p class="ad-sinv-summary-value">Rs. {{ number_format($booking->service_cost ?? 0, 2) }}</p>
                </div>
                <div class="ad-sinv-summary-row ad-sinv-summary-row-gap">
                    <p class="ad-sinv-summary-label">Spare Parts Cost</p>
                    <p class="ad-sinv-summary-value">Rs. {{ number_format($booking->spare_parts_cost ?? 0, 2) }}</p>
                </div>
                <div class="ad-sinv-summary-row ad-sinv-summary-row-total">
                    <p class="ad-sinv-summary-label">Total Payable</p>
                    <p class="ad-sinv-total">Rs. {{ number_format($displayTotal, 2) }}</p>
                </div>
                <div class="ad-sinv-summary-row ad-sinv-summary-row-total">
                    <p class="ad-sinv-summary-label">Payment Status</p>
                    <span class="ad-sinv-badge {{ ($booking->payment_status ?? 'pending') === 'paid' ? 'ad-sinv-badge-green' : 'ad-sinv-badge-yellow' }}">
                        {{ ucfirst($booking->payment_status ?? 'pending') }}
                    </span>
                </div>
            </div>

            <div class="ad-sinv-actions">
                <a href="{{ route('admin.services') }}" class="ad-sinv-back-btn">Back to Services</a>
            </div>
        </div>
    </div>
</div>
@endsection
