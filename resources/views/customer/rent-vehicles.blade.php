@extends('layouts.app')

@section('title', 'Rent Vehicles - AutoMate')

@section('content')
@include('customer.navbar')

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Rent Vehicles</h1>
            <p class="text-gray-500 mt-1">Browse customer-listed vehicles available for rent.</p>
            <p class="text-xs text-gray-400 mt-2">Debug: Found {{ $vehicles->count() }} vehicle(s) listed for rent.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center animate-fade-in">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 flex items-center animate-fade-in">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('error') }}
            </div>
        @endif

        @if($vehicles->count() === 0)
            <div class="bg-white rounded-3xl border border-dashed border-gray-200 p-10 text-center">
                <h3 class="text-xl font-semibold text-gray-900">No vehicles available right now</h3>
                <p class="text-gray-500 mt-2">Check back soon for new listings.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($vehicles as $vehicle)
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300 flex flex-col group">
                        <!-- Image Gallery Section -->
                        <div class="relative h-48 bg-gray-100 overflow-hidden">
                            <!-- Main Image -->
                            @php
                                $allImages = [];
                                if ($vehicle->image_path) {
                                    $allImages[] = $vehicle->image_path;
                                }
                                $allImages = array_merge($allImages, $vehicle->images->pluck('image_path')->toArray());
                            @endphp

                            @if(count($allImages) > 0)
                                <div class="relative h-full" x-data="{ currentImage: 0, images: {{ json_encode($allImages) }} }">
                                    <img :src="'{{ asset('storage') }}/' + images[currentImage]" 
                                         class="w-full h-full object-cover transition-opacity duration-300"
                                         alt="{{ $vehicle->vehicle_name ?? $vehicle->brand }}">
                                    
                                    <!-- Image Counter -->
                                    @if(count($allImages) > 1)
                                        <div class="absolute bottom-3 right-3 bg-black/60 text-white text-xs px-3 py-1 rounded-full font-semibold">
                                            <span x-text="currentImage + 1"></span>/<span>{{ count($allImages) }}</span>
                                        </div>

                                        <!-- Image Navigation -->
                                        <button @click="currentImage = (currentImage - 1 + images.length) % images.length"
                                                class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-2 opacity-0 group-hover:opacity-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                                        </button>
                                        <button @click="currentImage = (currentImage + 1) % images.length"
                                                class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 rounded-full p-2 opacity-0 group-hover:opacity-100 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                        </button>

                                        <!-- Thumbnail Strip -->
                                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/40 to-transparent p-2 flex gap-1 overflow-x-auto">
                                            <template x-for="(img, idx) in images" :key="idx">
                                                <button @click="currentImage = idx"
                                                        :class="currentImage === idx ? 'ring-2 ring-white' : 'opacity-60 hover:opacity-100'"
                                                        class="flex-shrink-0 w-10 h-10 rounded border border-white/50 overflow-hidden transition">
                                                    <img :src="'{{ asset('storage') }}/' + img" class="w-full h-full object-cover">
                                                </button>
                                            </template>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                                </div>
                            @endif

                            <span class="absolute top-3 left-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-600 mr-2"></span>
                                Available
                            </span>
                        </div>
                        <div class="p-6 flex-1">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-900">
                                    {{ $vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model) }}
                                </h3>
                            </div>
                            <p class="text-sm text-gray-500 mb-2">{{ $vehicle->vehicle_type ?? 'Vehicle' }} • {{ $vehicle->fuel_type ?? 'Fuel N/A' }} • {{ $vehicle->transmission_type ?? 'Transmission N/A' }}</p>
                            <p class="text-xs text-gray-400 mb-3">
                                <span class="inline-flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Owner: {{ $vehicle->customer->name ?? 'N/A' }}
                                </span>
                            </p>
                            <div class="flex items-center text-lg font-bold text-[#ff5a1f] mb-3">
                                <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Rs. {{ $vehicle->daily_rate !== null ? number_format($vehicle->daily_rate, 2) : 'N/A' }} / day
                            </div>
                            <div class="flex items-center text-xs font-mono bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg w-fit">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path>
                                </svg>
                                {{ $vehicle->plate_number }}
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-50">
                            <form action="{{ route('rent-vehicles.request') }}" method="POST" class="space-y-3">
                                @csrf
                                <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-xs text-gray-600 mb-1">Start Date</label>
                                        <input type="date" name="start_date" required class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:border-[#ff5a1f] focus:ring-[#ff5a1f]" min="{{ date('Y-m-d') }}">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-600 mb-1">End Date</label>
                                        <input type="date" name="end_date" required class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:border-[#ff5a1f] focus:ring-[#ff5a1f]" min="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-xs text-gray-600 mb-1">Contact Number</label>
                                        <input type="tel" name="renter_contact" placeholder="Your contact number" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:border-[#ff5a1f] focus:ring-[#ff5a1f]">
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-600 mb-1">Pickup Location</label>
                                        <input type="text" name="pickup_location" placeholder="Where to pickup" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:border-[#ff5a1f] focus:ring-[#ff5a1f]">
                                    </div>
                                </div>
                                <textarea name="notes" rows="2" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:border-[#ff5a1f] focus:ring-[#ff5a1f]" placeholder="Optional notes..."></textarea>
                                <textarea name="service_link" rows="1" class="w-full px-3 py-2 rounded-lg border border-gray-200 text-xs focus:border-[#ff5a1f] focus:ring-[#ff5a1f]" placeholder="Service booking link (if applicable)"></textarea>
                                <button type="submit" class="w-full px-4 py-2.5 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition shadow-lg shadow-orange-100">
                                    Request to Rent
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</div>
@endsection
