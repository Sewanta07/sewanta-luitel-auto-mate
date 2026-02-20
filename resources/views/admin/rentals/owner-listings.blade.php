@extends('layouts.admin')

@section('title', 'Owner Vehicle Listings')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('admin.rentals.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4 font-semibold transition">← Back to Dashboard</a>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Owner Vehicle Listings</h1>
            <p class="text-gray-600">Approve or reject marketplace listing submissions.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rate</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($ownerVehicles as $ownerVehicle)
                            <tr>
                                <td class="px-6 py-4 text-sm">#{{ $ownerVehicle->id }}</td>
                                <td class="px-6 py-4 text-sm">
                                    {{ $ownerVehicle->vehicle->vehicle_name ?: ($ownerVehicle->vehicle->brand . ' ' . $ownerVehicle->vehicle->model) }}
                                    <div class="text-xs text-gray-500">{{ $ownerVehicle->vehicle->plate_number }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $ownerVehicle->owner->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm font-semibold">Rs. {{ number_format($ownerVehicle->daily_rate, 2) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $ownerVehicle->approval_status === 'approved' ? 'bg-green-100 text-green-800' : ($ownerVehicle->approval_status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($ownerVehicle->approval_status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($ownerVehicle->approval_status === 'pending')
                                        <div class="flex flex-col gap-2">
                                            <form action="{{ route('admin.owner-vehicles.approval', $ownerVehicle->id) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="approval_status" value="approved">
                                                <button type="submit" class="px-3 py-1 rounded bg-green-600 text-white text-xs font-semibold">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.owner-vehicles.approval', $ownerVehicle->id) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="approval_status" value="rejected">
                                                <input type="text" name="approval_note" placeholder="Rejection note" class="border rounded px-2 py-1 text-xs w-44 mb-1" required>
                                                <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white text-xs font-semibold">Reject</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-500">No action</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No owner vehicle listings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
