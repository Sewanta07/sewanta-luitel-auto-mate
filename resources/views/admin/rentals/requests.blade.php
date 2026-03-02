@extends('layouts.admin')

@section('title', 'Rental Requests')

@section('content')
<div class="ad-rreq-page">
    <div class="ad-rreq-container">
    <div class="ad-rreq-back-wrap">
        <a href="{{ route('admin.rentals.dashboard') }}" class="ad-rreq-back-link">
            <svg class="ad-rreq-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
    <div class="ad-rreq-head">
        <h1 class="ad-rreq-title">Rental Requests Management</h1>
        <p class="ad-rreq-subtitle">Approve requests and assign staff for vehicle handover</p>
    </div>

    @if(session('success'))
    <div class="ad-rreq-alert ad-rreq-alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="ad-rreq-alert ad-rreq-alert-error">
        {{ session('error') }}
    </div>
    @endif

    <div class="ad-rreq-panel">
        <div class="ad-rreq-table-wrap">
            <table class="ad-rreq-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vehicle</th>
                        <th>Renter</th>
                        <th>Owner</th>
                        <th>Dates</th>
                        <th>Cost</th>
                        <th>Damage</th>
                        <th>Damage Payment</th>
                        <th>Status</th>
                        <th>Staff</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($requests as $rental)
                    <tr>
                        <td class="ad-rreq-strong">#{{ $rental->id }}</td>
                        <td>
                            {{ $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model) }}
                            <br>
                            <span class="ad-rreq-inline-muted">{{ $rental->vehicle->plate_number }}</span>
                        </td>
                        <td>
                            {{ $rental->renter->name }}
                            <br>
                            <span class="ad-rreq-inline-muted">{{ $rental->renter->email }}</span>
                        </td>
                        <td class="ad-rreq-muted">
                            @if($rental->vehicle->is_service_center_vehicle)
                                <span class="ad-rreq-service-center">Service Center</span>
                            @else
                                {{ $rental->owner->name ?? 'Customer' }}
                            @endif
                        </td>
                        <td class="ad-rreq-muted">
                            {{ \Carbon\Carbon::parse($rental->start_date)->format('M d, Y') }}
                            <br>
                            {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}
                        </td>
                        <td class="ad-rreq-strong">
                            Rs. {{ number_format($rental->total_cost, 2) }}
                        </td>
                        <td>
                            @if($rental->has_damage)
                                Rs. {{ number_format($rental->damage_charge ?? 0, 2) }}
                                @if($rental->damage_description)
                                    <div class="ad-rreq-inline-muted ad-rreq-mt-1">{{ $rental->damage_description }}</div>
                                @endif
                            @else
                                <span class="ad-rreq-none">None</span>
                            @endif
                        </td>
                        <td>
                            <span class="ad-rreq-badge
                                @if(($rental->damage_payment_status ?? 'Unpaid') === 'Paid') ad-rreq-badge-green
                                @elseif(($rental->damage_payment_status ?? 'Unpaid') === 'Not Required') ad-rreq-badge-gray
                                @else ad-rreq-badge-yellow @endif">
                                {{ $rental->damage_payment_status ?? 'Unpaid' }}
                            </span>
                        </td>
                        <td>
                            @php
                                $statusClasses = [
                                    'Pending' => 'ad-rreq-badge-yellow',
                                    'Approved' => 'ad-rreq-badge-green',
                                    'Ready for Pickup' => 'ad-rreq-badge-blue',
                                    'Picked Up' => 'ad-rreq-badge-indigo',
                                    'In Use' => 'ad-rreq-badge-purple',
                                    'Returned' => 'ad-rreq-badge-gray',
                                    'Completed' => 'ad-rreq-badge-green',
                                    'Rejected' => 'ad-rreq-badge-red',
                                ];
                            @endphp
                            <span class="ad-rreq-badge {{ $statusClasses[$rental->status] ?? 'ad-rreq-badge-gray' }}">
                                {{ $rental->status }}
                            </span>
                        </td>
                        <td>
                            @if($rental->assignedStaff)
                                <span>{{ $rental->assignedStaff->name }}</span>
                            @else
                                <button onclick="assignStaff({{ $rental->id }})" 
                                        class="ad-rreq-link-btn">
                                    Assign Staff
                                </button>
                            @endif
                        </td>
                        <td>
                            @if($rental->status === 'Pending')
                            <div class="ad-rreq-actions-inline">
                                <form action="{{ route('admin.rentals.requests.approve', $rental) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="ad-rreq-btn ad-rreq-btn-approve">
                                        Approve
                                    </button>
                                </form>
                                <button onclick="rejectRequest({{ $rental->id }})" 
                                        class="ad-rreq-btn ad-rreq-btn-reject">
                                    Reject
                                </button>
                            </div>
                            @else
                                <span class="ad-rreq-status-note">{{ $rental->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="ad-rreq-empty">No rental requests found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Assign Staff Modal -->
<div id="assignStaffModal" class="ad-rreq-modal-overlay ad-hidden">
    <div class="ad-rreq-modal">
        <div class="ad-rreq-modal-head">
            <h2 class="ad-rreq-modal-title">Assign Staff</h2>
        </div>
        
        <form id="assignStaffForm" method="POST" class="ad-rreq-modal-form">
            @csrf
            <div class="ad-rreq-field">
                <label class="ad-rreq-label">Select Staff Member *</label>
                <select name="staff_id" required class="ad-rreq-input">
                    <option value="">-- Choose Staff --</option>
                    @foreach($staff as $member)
                    <option value="{{ $member->id }}">{{ $member->name }} - {{ $member->position ?? 'Staff' }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="ad-rreq-modal-actions">
                <button type="submit" class="ad-rreq-btn ad-rreq-btn-primary ad-rreq-btn-grow">
                    Assign Staff
                </button>
                <button type="button" onclick="document.getElementById('assignStaffModal').classList.add('ad-hidden')" 
                        class="ad-rreq-btn ad-rreq-btn-ghost">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="ad-rreq-modal-overlay ad-hidden">
    <div class="ad-rreq-modal">
        <div class="ad-rreq-modal-head">
            <h2 class="ad-rreq-modal-title">Reject Rental Request</h2>
        </div>
        
        <form id="rejectForm" method="POST" class="ad-rreq-modal-form">
            @csrf
            <div class="ad-rreq-field">
                <label class="ad-rreq-label">Rejection Reason *</label>
                <textarea name="rejection_reason" required rows="4" 
                          class="ad-rreq-input"
                          placeholder="Explain why this rental request is rejected..."></textarea>
            </div>
            
            <div class="ad-rreq-modal-actions">
                <button type="submit" class="ad-rreq-btn ad-rreq-btn-danger ad-rreq-btn-grow">
                    Reject Request
                </button>
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('ad-hidden')" 
                        class="ad-rreq-btn ad-rreq-btn-ghost">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function assignStaff(rentalId) {
    document.getElementById('assignStaffForm').action = `/admin/rentals/requests/${rentalId}/assign-staff`;
    document.getElementById('assignStaffModal').classList.remove('ad-hidden');
}

function rejectRequest(rentalId) {
    document.getElementById('rejectForm').action = `/admin/rentals/requests/${rentalId}/reject`;
    document.getElementById('rejectModal').classList.remove('ad-hidden');
}
</script>
@endsection
