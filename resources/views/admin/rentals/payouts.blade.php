@extends('layouts.admin')

@section('title', 'Owner Payouts')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="{{ route('admin.rentals.dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4 font-semibold transition">← Back to Dashboard</a>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Owner Payout Management</h1>
            <p class="text-gray-600">Review withdrawal requests and track owner payments.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800">{{ session('error') }}</div>
        @endif

        {{-- Withdrawal Requests Section --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                <h2 class="text-xl font-bold">Withdrawal Requests</h2>
                <p class="text-sm opacity-90 mt-1">Process owner payout requests</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Request ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Note</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Requested</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($withdrawalRequests as $request)
                            <tr class="{{ $request->status === 'pending' ? 'bg-yellow-50' : '' }}">
                                <td class="px-6 py-4 text-sm font-bold">#{{ $request->id }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="font-semibold text-gray-900">{{ $request->owner->name ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500">{{ $request->owner->email ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm font-bold text-green-600">Rs. {{ number_format($request->amount, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">{{ $request->note ?: '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $request->requested_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                        @if($request->status === 'paid') bg-green-100 text-green-800
                                        @elseif($request->status === 'approved') bg-blue-100 text-blue-800
                                        @elseif($request->status === 'rejected') bg-red-100 text-red-800
                                        @else bg-yellow-100 text-yellow-800
                                        @endif">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                    @if($request->processed_at)
                                        <div class="text-xs text-gray-500 mt-1">{{ $request->processed_at->format('M d, Y') }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($request->status === 'pending')
                                        <div class="flex gap-2">
                                            <form action="{{ route('admin.withdrawals.process', $request->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="paid">
                                                <button type="submit" class="px-3 py-1 rounded bg-green-600 hover:bg-green-700 text-white text-xs font-semibold transition">Mark Paid</button>
                                            </form>
                                            <form action="{{ route('admin.withdrawals.process', $request->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="px-3 py-1 rounded bg-red-600 hover:bg-red-700 text-white text-xs font-semibold transition">Reject</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-xs text-gray-500">{{ ucfirst($request->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">No withdrawal requests.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Individual Earnings Section --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-gray-600 to-gray-700 text-white">
                <h2 class="text-xl font-bold">All Earnings Records</h2>
                <p class="text-sm opacity-90 mt-1">Individual rental earnings and commission breakdown</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rental</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commission</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner Payout</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($earnings as $earning)
                            <tr>
                                <td class="px-6 py-4 text-sm">#{{ $earning->rental_id }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($earning->rental && $earning->rental->vehicle)
                                        {{ $earning->rental->vehicle->vehicle_name ?: ($earning->rental->vehicle->brand . ' ' . $earning->rental->vehicle->model) }}
                                        <br>
                                        <span class="text-xs text-gray-500">{{ $earning->rental->vehicle->plate_number }}</span>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $earning->owner->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm font-semibold">Rs. {{ number_format($earning->rental->total_amount ?? 0, 2) }}</td>
                                <td class="px-6 py-4 text-sm text-orange-600">Rs. {{ number_format($earning->commission, 2) }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-green-700">Rs. {{ number_format($earning->owner_amount, 2) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $earning->payout_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($earning->payout_status) }}
                                    </span>
                                    @if($earning->payout_status === 'paid' && $earning->paid_out_at)
                                        <div class="text-xs text-gray-500 mt-1">{{ $earning->paid_out_at->format('M d, Y') }}</div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">No earnings records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
