@extends('layouts.admin')

@section('title', 'Owner Vehicle Listings')

@section('content')
<div class="ad-rol-page">
    <div class="ad-rol-container">
        <div class="ad-rol-head">
            <a href="{{ route('admin.rentals.dashboard') }}" class="ad-rol-back-link">← Back to Dashboard</a>
            <h1 class="ad-rol-title">Owner Vehicle Listings</h1>
            <p class="ad-rol-subtitle">Approve or reject marketplace listing submissions.</p>
        </div>

        @if(session('success'))
            <div class="ad-rol-alert ad-rol-alert-success">{{ session('success') }}</div>
        @endif

        <div class="ad-rol-panel">
            <div class="ad-rol-table-wrap">
                <table class="ad-rol-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vehicle</th>
                            <th>Owner</th>
                            <th>Rate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ownerVehicles as $ownerVehicle)
                            <tr>
                                <td>#{{ $ownerVehicle->id }}</td>
                                <td>
                                    {{ $ownerVehicle->vehicle->vehicle_name ?: ($ownerVehicle->vehicle->brand . ' ' . $ownerVehicle->vehicle->model) }}
                                    <div class="ad-rol-inline-muted">{{ $ownerVehicle->vehicle->plate_number }}</div>
                                </td>
                                <td>{{ $ownerVehicle->owner->name ?? 'N/A' }}</td>
                                <td class="ad-rol-strong">Rs. {{ number_format($ownerVehicle->daily_rate, 2) }}</td>
                                <td>
                                    <span class="ad-rol-badge {{ $ownerVehicle->approval_status === 'approved' ? 'ad-rol-badge-green' : ($ownerVehicle->approval_status === 'rejected' ? 'ad-rol-badge-red' : 'ad-rol-badge-yellow') }}">
                                        {{ ucfirst($ownerVehicle->approval_status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($ownerVehicle->approval_status === 'pending')
                                        <div class="ad-rol-actions-stack">
                                            <form action="{{ route('admin.owner-vehicles.approval', $ownerVehicle->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="approval_status" value="approved">
                                                <button type="submit" class="ad-rol-btn ad-rol-btn-approve">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.owner-vehicles.approval', $ownerVehicle->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="approval_status" value="rejected">
                                                <input type="text" name="approval_note" placeholder="Rejection note" class="ad-rol-input" required>
                                                <button type="submit" class="ad-rol-btn ad-rol-btn-reject">Reject</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="ad-rol-muted">No action</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="ad-rol-empty">No owner vehicle listings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
