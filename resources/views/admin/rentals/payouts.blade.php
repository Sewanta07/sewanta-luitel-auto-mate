@extends('layouts.admin')

@section('title', 'Owner Payouts')

@section('content')
<div class="ad-rpay-page">
    <div class="ad-rpay-container">
        <div class="ad-rpay-head">
            <a href="{{ route('admin.rentals.dashboard') }}" class="ad-rpay-back-link">← Back to Dashboard</a>
            <h1 class="ad-rpay-title">Owner Payout Management</h1>
            <p class="ad-rpay-subtitle">Review withdrawal requests and track owner payments.</p>
        </div>

        @if(session('success'))
            <div class="ad-rpay-alert ad-rpay-alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="ad-rpay-alert ad-rpay-alert-error">{{ session('error') }}</div>
        @endif

        {{-- Withdrawal Requests Section --}}
        <div class="ad-rpay-panel ad-rpay-mb-8">
            <div class="ad-rpay-section-head ad-rpay-section-head-blue">
                <h2 class="ad-rpay-section-title">Withdrawal Requests</h2>
                <p class="ad-rpay-section-subtitle">Process owner payout requests</p>
            </div>
            <div class="ad-rpay-table-wrap">
                <table class="ad-rpay-table">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Owner</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Requested</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($withdrawalRequests as $request)
                            <tr class="{{ $request->status === 'pending' ? 'ad-rpay-row-pending' : '' }}">
                                <td class="ad-rpay-strong">#{{ $request->id }}</td>
                                <td>
                                    <div class="ad-rpay-owner-name">{{ $request->owner->name ?? 'N/A' }}</div>
                                    <div class="ad-rpay-inline-muted">{{ $request->owner->email ?? '' }}</div>
                                </td>
                                <td class="ad-rpay-amount">Rs. {{ number_format($request->amount, 2) }}</td>
                                <td class="ad-rpay-note">{{ $request->note ?: '-' }}</td>
                                <td class="ad-rpay-date">{{ $request->requested_at->format('M d, Y') }}</td>
                                <td>
                                    <span class="ad-rpay-badge 
                                        @if($request->status === 'paid') ad-rpay-badge-green
                                        @elseif($request->status === 'approved') ad-rpay-badge-blue
                                        @elseif($request->status === 'rejected') ad-rpay-badge-red
                                        @else ad-rpay-badge-yellow
                                        @endif">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                    @if($request->processed_at)
                                        <div class="ad-rpay-inline-muted ad-rpay-mt-1">{{ $request->processed_at->format('M d, Y') }}</div>
                                    @endif
                                </td>
                                <td>
                                    @if($request->status === 'pending')
                                        <div class="ad-rpay-actions-inline">
                                            <form action="{{ route('admin.withdrawals.process', $request->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="paid">
                                                <button type="submit" class="ad-rpay-btn ad-rpay-btn-pay">Mark Paid</button>
                                            </form>
                                            <form action="{{ route('admin.withdrawals.process', $request->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="ad-rpay-btn ad-rpay-btn-reject">Reject</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="ad-rpay-inline-muted">{{ ucfirst($request->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="ad-rpay-empty">No withdrawal requests.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Individual Earnings Section --}}
        <div class="ad-rpay-panel">
            <div class="ad-rpay-section-head ad-rpay-section-head-gray">
                <h2 class="ad-rpay-section-title">All Earnings Records</h2>
                <p class="ad-rpay-section-subtitle">Individual rental earnings and commission breakdown</p>
            </div>
            <div class="ad-rpay-table-wrap">
                <table class="ad-rpay-table">
                    <thead>
                        <tr>
                            <th>Rental</th>
                            <th>Vehicle</th>
                            <th>Owner</th>
                            <th>Total Amount</th>
                            <th>Commission</th>
                            <th>Owner Payout</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($earnings as $earning)
                            <tr>
                                <td>#{{ $earning->rental_id }}</td>
                                <td>
                                    @if($earning->rental && $earning->rental->vehicle)
                                        {{ $earning->rental->vehicle->vehicle_name ?: ($earning->rental->vehicle->brand . ' ' . $earning->rental->vehicle->model) }}
                                        <br>
                                        <span class="ad-rpay-inline-muted">{{ $earning->rental->vehicle->plate_number }}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $earning->owner->name ?? 'N/A' }}</td>
                                <td class="ad-rpay-strong">Rs. {{ number_format($earning->rental->total_amount ?? 0, 2) }}</td>
                                <td class="ad-rpay-commission">Rs. {{ number_format($earning->commission, 2) }}</td>
                                <td class="ad-rpay-owner-amount">Rs. {{ number_format($earning->owner_amount, 2) }}</td>
                                <td>
                                    <span class="ad-rpay-badge {{ $earning->payout_status === 'paid' ? 'ad-rpay-badge-green' : 'ad-rpay-badge-yellow' }}">
                                        {{ ucfirst($earning->payout_status) }}
                                    </span>
                                    @if($earning->payout_status === 'paid' && $earning->paid_out_at)
                                        <div class="ad-rpay-inline-muted ad-rpay-mt-1">{{ $earning->paid_out_at->format('M d, Y') }}</div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="ad-rpay-empty">No earnings records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
