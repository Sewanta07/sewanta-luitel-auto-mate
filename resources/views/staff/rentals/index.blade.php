@extends('layouts.staff')

@section('title', 'Rental Operations')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Rental Operations Dashboard</h1>
            <p class="text-gray-600">Manage assigned rental vehicles and handle pickups, inspections, and returns</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-6 border border-blue-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-blue-600 mb-2">Total Assigned</h3>
                        <p class="text-4xl font-bold text-blue-900">{{ $stats['assigned_rentals'] }}</p>
                    </div>
                    <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-6 border border-green-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-green-600 mb-2">Ready for Pickup</h3>
                        <p class="text-4xl font-bold text-green-900">{{ $stats['ready_for_pickup'] }}</p>
                    </div>
                    <svg class="w-12 h-12 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-6 border border-purple-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-purple-600 mb-2">Currently In Use</h3>
                        <p class="text-4xl font-bold text-purple-900">{{ $stats['active_rentals'] }}</p>
                    </div>
                    <svg class="w-12 h-12 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg p-6 border border-orange-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-orange-600 mb-2">Due for Return</h3>
                        <p class="text-4xl font-bold text-orange-900">{{ $stats['awaiting_return'] }}</p>
                    </div>
                    <svg class="w-12 h-12 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 flex items-center animate-fade-in">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Rental Cards -->
        <div class="space-y-6">
            @forelse($rentals as $rental)
                <div class="bg-white rounded-lg shadow-md border-l-4 {{ 
                    $rental->status === 'Approved' ? 'border-blue-500' : 
                    ($rental->status === 'Ready for Pickup' ? 'border-green-500' : 
                    ($rental->status === 'Picked Up' ? 'border-indigo-500' : 
                    ($rental->status === 'In Use' ? 'border-purple-500' : 
                    ($rental->status === 'Returned' ? 'border-gray-400' : 'border-gray-300'))))
                }} overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">
                                    {{ $rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model) }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                                        </svg>
                                        {{ $rental->vehicle->plate_number }}
                                    </span>
                                </p>
                            </div>

                            @php
                                $statusConfig = [
                                    'Approved' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => '📋'],
                                    'Ready for Pickup' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => '✓'],
                                    'Picked Up' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-800', 'icon' => '🚗'],
                                    'In Use' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'icon' => '⏱️'],
                                    'Returned' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => '✓✓'],
                                ];
                                $config = $statusConfig[$rental->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'icon' => '•'];
                            @endphp
                            <span class="px-4 py-2 text-sm font-bold rounded-full {{ $config['bg'] }} {{ $config['text'] }}">
                                {{ $rental->status }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                            <!-- Renter Info -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2">Renter</p>
                                <p class="font-semibold text-gray-800">{{ $rental->renter->name }}</p>
                                <p class="text-sm text-gray-600">{{ $rental->renter->email }}</p>
                                @if($rental->renter_contact)
                                    <p class="text-sm text-gray-600 mt-1">{{ $rental->renter_contact }}</p>
                                @endif
                            </div>

                            <!-- Rental Period -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2">Rental Period</p>
                                <p class="font-semibold text-gray-800">
                                    {{ \Carbon\Carbon::parse($rental->start_date)->format('M d') }}
                                </p>
                                <p class="text-xs text-gray-600">to {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</p>
                                <p class="text-xs text-orange-600 font-semibold mt-2">
                                    {{ \Carbon\Carbon::parse($rental->start_date)->diffInDays(\Carbon\Carbon::parse($rental->end_date)) + 1 }} days
                                </p>
                            </div>

                            <!-- Pickup Location -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2">Pickup Location</p>
                                @if($rental->pickup_location)
                                    <p class="font-semibold text-gray-800">{{ $rental->pickup_location }}</p>
                                @else
                                    <p class="text-gray-500 italic">Not specified</p>
                                @endif
                            </div>

                            <!-- Cost -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2">Total Cost</p>
                                <p class="text-2xl font-bold text-orange-600">Rs. {{ number_format($rental->total_cost, 2) }}</p>
                            </div>
                        </div>

                        <!-- Action Buttons Based on Status -->
                        <div class="flex gap-3 flex-wrap pt-4 border-t border-gray-100">
                            @if($rental->status === 'Approved')
                                <a href="{{ route('staff.rentals.inspection', $rental) }}" 
                                   class="inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    Start Pre-Inspection
                                </a>
                            @elseif($rental->status === 'Ready for Pickup')
                                <form action="{{ route('staff.rentals.pickup', $rental) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Confirm Pickup
                                    </button>
                                </form>
                            @elseif($rental->status === 'Picked Up')
                                <form action="{{ route('staff.rentals.status', $rental) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="In Use">
                                    <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        Mark as In Use
                                    </button>
                                </form>
                            @elseif($rental->status === 'In Use')
                                <a href="{{ route('staff.rentals.inspection', $rental) }}" 
                                   class="inline-flex items-center px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg transition shadow-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                    Start Return Inspection
                                </a>
                            @elseif($rental->status === 'Returned')
                                <form action="{{ route('staff.rentals.complete', $rental) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Complete Rental
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow-md p-12 text-center border-2 border-dashed border-gray-200">
                    <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <p class="text-gray-500 text-lg font-semibold">No rentals assigned yet</p>
                    <p class="text-gray-400 text-sm mt-2">Rentals will appear here once the admin assigns them to you</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
