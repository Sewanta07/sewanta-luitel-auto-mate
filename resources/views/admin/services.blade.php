@extends('layouts.admin')

@section('title', 'Service Management')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Service Management</h1>
            <p class="text-gray-600">Monitor and manage all service operations</p>
        </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
      
        <!-- Total Active -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Active</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['total'] }}</h3>
                </div>
                <div class="bg-gray-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Pending</p>
                    <h3 class="text-3xl font-bold text-orange-600 mt-2">{{ $stats['pending'] }}</h3>
                </div>
                <div class="bg-orange-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">In Progress</p>
                    <h3 class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['in_progress'] }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Completed</p>
                    <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $stats['completed'] }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
        </div>

        <!-- Unassigned -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Unassigned</p>
                    <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $stats['unassigned'] }}</h3>
                </div>
                <div class="bg-red-100 p-3 rounded-full">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Services -->
    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Service Bookings Overview</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Technician</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="toggleBookingDetails('booking-{{ $booking->id }}')">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $booking->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->service_type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->customer->name ?? 'Unknown' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $booking->staff->name ?? 'Unassigned' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                        'Approved' => 'bg-blue-100 text-blue-800',
                                        'Assigned' => 'bg-indigo-100 text-indigo-800',
                                        'In Progress' => 'bg-purple-100 text-purple-800',
                                        'Waiting for Parts' => 'bg-orange-100 text-orange-800',
                                        'Completed' => 'bg-green-100 text-green-800',
                                        'Cancelled' => 'bg-gray-100 text-gray-800',
                                        'Rejected' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y') }}
                            </td>
                        </tr>
                        <!-- Detailed Booking Information -->
                        <tr id="booking-{{ $booking->id }}" class="hidden">
                            <td colspan="6" class="px-6 py-6 bg-gray-50">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <!-- Customer Details -->
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Customer Information
                                        </h3>
                                        <div class="space-y-2 text-sm">
                                            <p><span class="font-medium text-gray-600">Name:</span> <span class="text-gray-900">{{ $booking->customer->name ?? 'N/A' }}</span></p>
                                            <p><span class="font-medium text-gray-600">Phone:</span> <span class="text-gray-900">{{ $booking->phone_number ?? 'N/A' }}</span></p>
                                            <p><span class="font-medium text-gray-600">Email:</span> <span class="text-gray-900">{{ $booking->customer->email ?? 'N/A' }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Vehicle Details -->
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                            Vehicle Information
                                        </h3>
                                        <div class="space-y-2 text-sm">
                                            <p><span class="font-medium text-gray-600">Model:</span> <span class="text-gray-900">{{ $booking->vehicle_model ?? 'N/A' }}</span></p>
                                            <p><span class="font-medium text-gray-600">Type:</span> <span class="text-gray-900">{{ $booking->vehicle_type ?? 'N/A' }}</span></p>
                                            <p><span class="font-medium text-gray-600">Number:</span> <span class="text-gray-900">{{ $booking->vehicle_number ?? 'N/A' }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Service Details -->
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            Service Details
                                        </h3>
                                        <div class="space-y-2 text-sm">
                                            <p><span class="font-medium text-gray-600">Service Type:</span> <span class="text-gray-900">{{ $booking->service_type ?? 'N/A' }}</span></p>
                                            <p><span class="font-medium text-gray-600">Priority:</span> <span class="px-2 py-1 rounded text-xs font-medium {{ str_contains($booking->service_priority, 'High') ? 'bg-red-100 text-red-800' : (str_contains($booking->service_priority, 'Medium') ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">{{ $booking->service_priority ?? 'Normal' }}</span></p>
                                            <p><span class="font-medium text-gray-600">Location:</span> <span class="text-gray-900">{{ $booking->service_location_type ?? 'N/A' }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Timeline & Status -->
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Timeline
                                        </h3>
                                        <div class="space-y-2 text-sm">
                                            <p><span class="font-medium text-gray-600">Created:</span> <span class="text-gray-900">{{ \Carbon\Carbon::parse($booking->created_at)->format('M d, Y h:i A') }}</span></p>
                                            <p><span class="font-medium text-gray-600">Preferred Date:</span> <span class="text-gray-900">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }}</span></p>
                                            <p><span class="font-medium text-gray-600">Expected Completion:</span> <span class="text-gray-900">{{ $booking->expected_completion_date ? \Carbon\Carbon::parse($booking->expected_completion_date)->format('M d, Y') : 'Not Set' }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Cost Information -->
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Cost Information
                                        </h3>
                                        <div class="space-y-2 text-sm">
                                            <p><span class="font-medium text-gray-600">Estimated Cost:</span> <span class="text-gray-900 font-semibold">Rs. {{ number_format($booking->estimated_cost, 2) }}</span></p>
                                            <p><span class="font-medium text-gray-600">Parts Used:</span> <span class="text-gray-900">{{ $booking->parts->count() ?? 0 }}</span></p>
                                            @if($booking->parts->count() > 0)
                                                <p><span class="font-medium text-gray-600">Parts Total:</span> <span class="text-gray-900 font-semibold">Rs. {{ number_format($booking->parts->sum('pivot.total_cost'), 2) }}</span></p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Assigned Staff -->
                                    <div class="bg-white rounded-lg p-4 border border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            Assigned Staff
                                        </h3>
                                        <div class="space-y-2 text-sm">
                                            @if($booking->staff)
                                                <p><span class="font-medium text-gray-600">Name:</span> <span class="text-gray-900">{{ $booking->staff->name ?? 'Unassigned' }}</span></p>
                                                <p><span class="font-medium text-gray-600">Position:</span> <span class="text-gray-900">{{ $booking->staff->position ?? 'N/A' }}</span></p>
                                                <p><span class="font-medium text-gray-600">Status:</span> <span class="px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">Available</span></p>
                                            @else
                                                <p class="text-gray-500">Not yet assigned</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Problem Description -->
                                    @if($booking->problem_description)
                                    <div class="lg:col-span-3 bg-white rounded-lg p-4 border border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Problem Description
                                        </h3>
                                        <p class="text-sm text-gray-700">{{ $booking->problem_description }}</p>
                                    </div>
                                    @endif

                                    <!-- Action Buttons -->
                                    <div class="lg:col-span-3 bg-white rounded-lg p-4 border border-gray-200">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Actions</h3>
                                        <div class="flex flex-wrap gap-3">
                                            @if($booking->status === 'Pending')
                                                <!-- Approve Form -->
                                                <form action="{{ route('admin.services.approve', $booking->id) }}" method="POST" class="inline-block" onclick="event.stopPropagation()">
                                                    @csrf
                                                    <div class="flex gap-2 items-end">
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-700 mb-1">Assign Staff</label>
                                                            <select name="staff_id" required class="border border-gray-300 rounded px-3 py-2 text-sm">
                                                                <option value="">Select Staff</option>
                                                                @foreach($staffMembers as $staff)
                                                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-700 mb-1">Estimated Cost (Rs.)</label>
                                                            <input type="number" name="estimated_cost" step="0.01" class="border border-gray-300 rounded px-3 py-2 text-sm w-32">
                                                        </div>
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-700 mb-1">Completion Date</label>
                                                            <input type="date" name="expected_completion_date" class="border border-gray-300 rounded px-3 py-2 text-sm">
                                                        </div>
                                                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg text-sm font-medium hover:bg-green-600 transition">
                                                            Approve & Assign
                                                        </button>
                                                    </div>
                                                </form>

                                                <!-- Reject Form -->
                                                <button onclick="event.stopPropagation(); toggleRejectForm('reject-{{ $booking->id }}')" class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition">
                                                    Reject
                                                </button>
                                                <div id="reject-{{ $booking->id }}" class="hidden mt-3 w-full">
                                                    <form action="{{ route('admin.services.reject', $booking->id) }}" method="POST" onclick="event.stopPropagation()">
                                                        @csrf
                                                        <textarea name="rejection_reason" required placeholder="Rejection reason..." class="w-full border border-gray-300 rounded px-3 py-2 text-sm mb-2" rows="2"></textarea>
                                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg text-sm font-medium hover:bg-red-600 transition">
                                                            Confirm Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            @elseif($booking->status !== 'Completed' && $booking->status !== 'Rejected' && $booking->status !== 'Cancelled')
                                                <!-- Assign Staff (for already approved bookings) -->
                                                @if(!$booking->staff_id)
                                                <form action="{{ route('admin.services.assign', $booking->id) }}" method="POST" class="inline-block" onclick="event.stopPropagation()">
                                                    @csrf
                                                    <div class="flex gap-2 items-end">
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-700 mb-1">Assign Staff</label>
                                                            <select name="staff_id" required class="border border-gray-300 rounded px-3 py-2 text-sm">
                                                                <option value="">Select Staff</option>
                                                                @foreach($staffMembers as $staff)
                                                                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition">
                                                            Assign
                                                        </button>
                                                    </div>
                                                </form>
                                                @endif

                                                <!-- Update Status -->
                                                <form action="{{ route('admin.services.status', $booking->id) }}" method="POST" class="inline-block" onclick="event.stopPropagation()">
                                                    @csrf
                                                    <div class="flex gap-2 items-end">
                                                        <div>
                                                            <label class="block text-xs font-medium text-gray-700 mb-1">Update Status</label>
                                                            <select name="status" required class="border border-gray-300 rounded px-3 py-2 text-sm">
                                                                <option value="Approved" {{ $booking->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                                                <option value="Assigned" {{ $booking->status === 'Assigned' ? 'selected' : '' }}>Assigned</option>
                                                                <option value="Customer Accepted" {{ $booking->status === 'Customer Accepted' ? 'selected' : '' }}>Customer Accepted</option>
                                                                <option value="In Progress" {{ $booking->status === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                                <option value="Waiting for Parts" {{ $booking->status === 'Waiting for Parts' ? 'selected' : '' }}>Waiting for Parts</option>
                                                                <option value="Completed" {{ $booking->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-lg text-sm font-medium hover:bg-orange-600 transition">
                                                            Update
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No recent service bookings</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
function toggleBookingDetails(elementId) {
    const element = document.getElementById(elementId);
    if (element.classList.contains('hidden')) {
        element.classList.remove('hidden');
    } else {
        element.classList.add('hidden');
    }
}

function toggleRejectForm(elementId) {
    const element = document.getElementById(elementId);
    if (element.classList.contains('hidden')) {
        element.classList.remove('hidden');
    } else {
        element.classList.add('hidden');
    }
}
</script>
@endsection
