@extends('layouts.app')

@section('title', 'My Listed Vehicles Rental History - AutoMate')

@section('content')
@include('customer.navbar')

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6 mt-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Listed Vehicles Rental History</h1>
                <p class="mt-2 text-lg text-gray-600">Track all rentals of your listed vehicles.</p>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Total Rentals</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <p class="text-3xl font-bold">{{ $stats['total_rentals'] }}</p>
            </div>
            
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Active Rentals</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-3xl font-bold">{{ $stats['active_rentals'] }}</p>
            </div>
            
            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Completed</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-3xl font-bold">{{ $stats['completed_rentals'] }}</p>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Total Earned</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-3xl font-bold">Rs. {{ number_format($stats['total_earned'], 2) }}</p>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="mb-6" x-data="{ activeTab: 'requests' }">
            <div class="flex space-x-1 bg-white rounded-2xl p-2 shadow-sm border border-gray-100 w-fit">
                <button @click="activeTab = 'requests'" 
                        :class="activeTab === 'requests' ? 'bg-[#ff5a1f] text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Rental Requests ({{ $rentalRequests->total() }})
                </button>
                <button @click="activeTab = 'marketplace'" 
                        :class="activeTab === 'marketplace' ? 'bg-[#ff5a1f] text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Marketplace Rentals ({{ $marketplaceRentals->total() }})
                </button>
            </div>

            {{-- Rental Requests Tab --}}
            <div x-show="activeTab === 'requests'" x-transition class="mt-6">
                <div class="space-y-4">
                    @forelse($rentalRequests as $request)
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="text-lg font-bold text-gray-900">
                                            {{ $request->vehicle?->vehicle_name ?: ($request->vehicle?->brand . ' ' . $request->vehicle?->model) }}
                                        </h3>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold
                                            @if($request->status === 'Approved' || $request->status === 'Ready for Pickup') bg-blue-100 text-blue-700
                                            @elseif($request->status === 'Picked Up' || $request->status === 'In Use') bg-green-100 text-green-700
                                            @elseif($request->status === 'Returned') bg-purple-100 text-purple-700
                                            @elseif($request->status === 'Completed') bg-gray-200 text-gray-700
                                            @elseif($request->status === 'Rejected') bg-red-100 text-red-700
                                            @else bg-yellow-100 text-yellow-700 @endif">
                                            {{ $request->status }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-gray-500 mb-2">{{ $request->vehicle?->plate_number }}</p>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-3">
                                        <div>
                                            <p class="text-xs text-gray-500">Renter</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $request->renter?->name ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Duration</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $request->number_of_days ?? 0 }} days</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Period</p>
                                            <p class="text-sm font-bold text-gray-900">
                                                {{ $request->start_date ? $request->start_date->format('M d') : 'N/A' }} - 
                                                {{ $request->end_date ? $request->end_date->format('M d, Y') : 'N/A' }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Total Cost</p>
                                            <p class="text-sm font-bold text-orange-600">Rs. {{ number_format($request->total_cost ?? 0, 2) }}</p>
                                        </div>
                                    </div>

                                    @if($request->assignedStaff)
                                        <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 mb-3">
                                            <p class="text-xs font-bold text-blue-700 mb-1">Assigned Staff</p>
                                            <p class="text-sm text-blue-900">{{ $request->assignedStaff->user->name ?? 'N/A' }}</p>
                                        </div>
                                    @endif

                                    @if($request->has_damage)
                                        <div class="bg-red-50 border border-red-100 rounded-lg p-3 mb-3">
                                            <p class="text-xs font-bold text-red-700 mb-1">Damage Reported</p>
                                            <p class="text-sm text-red-900">Charge: Rs. {{ number_format($request->damage_charge ?? 0, 2) }}</p>
                                            <p class="text-xs text-red-700 mt-1">Payment: {{ $request->damage_payment_status ?? 'Unpaid' }}</p>
                                            @if($request->damage_description)
                                                <p class="text-xs text-gray-600 mt-2">{{ $request->damage_description }}</p>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <span>Payment: <span class="font-bold {{ $request->payment_status === 'Paid' ? 'text-green-600' : 'text-orange-600' }}">{{ $request->payment_status }}</span></span>
                                        <span>•</span>
                                        <span>Request ID: #{{ $request->id }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            <h3 class="text-xl font-semibold text-gray-900">No rental requests yet</h3>
                            <p class="text-gray-500 mt-2">Your rental requests will appear here.</p>
                        </div>
                    @endforelse
                </div>

                @if($rentalRequests->hasPages())
                    <div class="mt-6">
                        {{ $rentalRequests->links() }}
                    </div>
                @endif
            </div>

            {{-- Marketplace Rentals Tab --}}
            <div x-show="activeTab === 'marketplace'" x-transition class="mt-6">
                <div class="space-y-4">
                    @forelse($marketplaceRentals as $rental)
                        <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="text-lg font-bold text-gray-900">
                                            {{ $rental->vehicle?->vehicle_name ?: ($rental->vehicle?->brand . ' ' . $rental->vehicle?->model) }}
                                        </h3>
                                        <span class="px-3 py-1 rounded-full text-xs font-bold
                                            @if($rental->status === 'confirmed') bg-green-100 text-green-700
                                            @elseif($rental->status === 'completed') bg-gray-200 text-gray-700
                                            @else bg-yellow-100 text-yellow-700 @endif">
                                            {{ ucfirst($rental->status) }}
                                        </span>
                                    </div>

                                    <p class="text-sm text-gray-500 mb-2">{{ $rental->vehicle?->plate_number }}</p>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-3">
                                        <div>
                                            <p class="text-xs text-gray-500">Renter</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $rental->renter?->name ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Duration</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $rental->number_of_days ?? 0 }} days</p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Period</p>
                                            <p class="text-sm font-bold text-gray-900">
                                                {{ $rental->start_date ? $rental->start_date->format('M d') : 'N/A' }} - 
                                                {{ $rental->end_date ? $rental->end_date->format('M d, Y') : 'N/A' }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500">Total Amount</p>
                                            <p class="text-sm font-bold text-orange-600">Rs. {{ number_format($rental->total_amount, 2) }}</p>
                                        </div>
                                    </div>

                                    @if($rental->owner_earning || $rental->commission_amount)
                                        <div class="bg-green-50 border border-green-100 rounded-lg p-3 mb-3">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-xs font-bold text-green-700">Your Earning</p>
                                                    <p class="text-lg font-bold text-green-900">Rs. {{ number_format($rental->owner_earning ?? 0, 2) }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs text-orange-600">Commission</p>
                                                    <p class="text-sm font-bold text-orange-600">Rs. {{ number_format($rental->commission_amount ?? 0, 2) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if($rental->damage_charge && $rental->damage_charge > 0)
                                        <div class="bg-red-50 border border-red-100 rounded-lg p-3 mb-3">
                                            <p class="text-xs font-bold text-red-700 mb-1">Damage Charge</p>
                                            <p class="text-sm text-red-900">Rs. {{ number_format($rental->damage_charge, 2) }}</p>
                                            @if($rental->damage_notes)
                                                <p class="text-xs text-gray-600 mt-1">{{ $rental->damage_notes }}</p>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <span>Rental ID: #{{ $rental->id }}</span>
                                        @if($rental->rental_request_id)
                                            <span>•</span>
                                            <span>Request: #{{ $rental->rental_request_id }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <h3 class="text-xl font-semibold text-gray-900">No marketplace rentals yet</h3>
                            <p class="text-gray-500 mt-2">Marketplace rentals will appear here.</p>
                        </div>
                    @endforelse
                </div>

                @if($marketplaceRentals->hasPages())
                    <div class="mt-6">
                        {{ $marketplaceRentals->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection
