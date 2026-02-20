@extends('layouts.admin')

@section('title', 'Quick Approval - Rental Requests')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Quick Approval Dashboard</h1>
            <p class="text-gray-600">Fast-track approval and staff assignment for rental requests</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg p-6 border border-orange-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-orange-600 font-semibold mb-1">Pending Approval</p>
                        <p class="text-4xl font-bold text-orange-700">{{ $stats['pending_count'] }}</p>
                    </div>
                    <svg class="w-12 h-12 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-blue-600 font-semibold mb-1">Approved (Awaiting Staff)</p>
                        <p class="text-4xl font-bold text-blue-700">{{ $stats['awaiting_staff'] }}</p>
                    </div>
                    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Pending Requests Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-orange-100 text-orange-700 font-bold mr-3">{{ $pendingRequests->count() }}</span>
                Pending Rental Requests
            </h2>

            @if($pendingRequests->count() === 0)
                <div class="bg-white rounded-lg border border-dashed border-gray-200 p-8 text-center">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500 font-medium">No pending requests</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($pendingRequests as $rental)
                        <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-md transition">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                                <!-- Vehicle & Renter Info -->
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800 mb-2">
                                        {{ $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model) }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold">Plate:</span> {{ $rental->vehicle->plate_number }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        <span class="font-semibold">Renter:</span> {{ $rental->renter->name }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $rental->renter->email }}</p>
                                </div>

                                <!-- Rental Details -->
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold">Dates:</span>
                                    </p>
                                    <p class="text-sm text-gray-800">{{ \Carbon\Carbon::parse($rental->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        <span class="font-semibold">Cost:</span> Rs. {{ number_format($rental->total_cost, 2) }}
                                    </p>
                                    @if($rental->renter_contact)
                                        <p class="text-sm text-gray-600 mt-1">
                                            <span class="font-semibold">Contact:</span> {{ $rental->renter_contact }}
                                        </p>
                                    @endif
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col gap-2">
                                    <form action="{{ route('admin.rentals.requests.approve', $rental) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold transition">
                                            Approve
                                        </button>
                                    </form>
                                    <button type="button" onclick="openRejectModal({{ $rental->id }})" class="px-4 py-2 rounded-lg bg-red-100 hover:bg-red-200 text-red-700 font-semibold transition">
                                        Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Approved (Awaiting Staff Assignment) Section -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-700 font-bold mr-3">{{ $approvedWaitingStaff->count() }}</span>
                Approved - Awaiting Staff Assignment
            </h2>

            @if($approvedWaitingStaff->count() === 0)
                <div class="bg-white rounded-lg border border-dashed border-gray-200 p-8 text-center">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-500 font-medium">All approved rentals have staff assigned</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($approvedWaitingStaff as $rental)
                        <div class="bg-white rounded-lg border border-blue-200 bg-blue-50 p-6 hover:shadow-md transition">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                                <!-- Vehicle & Renter Info -->
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800 mb-2">
                                        {{ $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model) }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold">Plate:</span> {{ $rental->vehicle->plate_number }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        <span class="font-semibold">Renter:</span> {{ $rental->renter->name }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $rental->renter->email }}</p>
                                </div>

                                <!-- Rental Details -->
                                <div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-semibold">Dates:</span>
                                    </p>
                                    <p class="text-sm text-gray-800">{{ \Carbon\Carbon::parse($rental->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        <span class="font-semibold">Status:</span> <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Approved</span>
                                    </p>
                                </div>

                                <!-- Staff Assignment -->
                                <form action="{{ route('admin.rentals.requests.assign-staff', $rental) }}" method="POST" class="flex flex-col gap-2">
                                    @csrf
                                    <label class="block text-sm font-semibold text-gray-700">Assign Staff Member</label>
                                    <select name="staff_id" required class="px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Select staff member...</option>
                                        @foreach($staff as $member)
                                            <option value="{{ $member->id }}">
                                                {{ $member->name }} ({{ $member->position ?? 'Staff' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                                        Assign Staff
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Reject Rental Request</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for rejection</label>
                <textarea name="rejection_reason" required rows="4" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Please explain why you're rejecting this request..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition">
                    Reject
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(rentalId) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    form.action = `/admin/rentals/requests/${rentalId}/reject`;
    modal.classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }
</style>
@endsection
