@extends('layouts.app')

@section('title', 'Book a Service - AutoMate')

@section('content')
@include('customer.navbar')

<div class="min-h-screen bg-gray-50 pb-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        {{-- Back Link --}}
        <a href="{{ route('bookings.index') }}" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-[#ff5a1f] transition-colors mb-6 group">
            <svg class="w-5 h-5 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Back to My Bookings
        </a>

        {{-- Header Section --}}
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Book <span class="text-[#ff5a1f]">Service</span></h1>
            <p class="text-gray-500 font-medium mt-2">Professional care for your vehicle.</p>
        </div>

        {{-- Booking Form --}}
        <div class="bg-white rounded-3xl shadow-xl p-6 sm:p-10 border border-gray-100">
            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-8">
                @csrf

                {{-- Saved Vehicles --}}
                <div>
                    <label for="saved_vehicle" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Saved Vehicles (Optional)</label>
                    <select id="saved_vehicle" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none">
                        <option value="">Select from your saved vehicles</option>
                        @foreach($savedVehicles as $vehicle)
                            <option value="{{ $vehicle->vehicle_number }}">
                                {{ $vehicle->vehicle_name ? $vehicle->vehicle_name . ' • ' : '' }}{{ $vehicle->vehicle_model }} ({{ $vehicle->vehicle_number }})
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-[10px] font-bold text-gray-400 ml-1 uppercase tracking-widest">You can also fill details below</p>
                </div>

                {{-- Pre-filled info message --}}
                @if($preFilledVehicle)
                    <div class="p-4 rounded-2xl bg-blue-50 border border-blue-100 flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-bold text-blue-900">Vehicle pre-filled</p>
                            <p class="text-xs text-blue-700 mt-1">The information for <strong>{{ $preFilledVehicle->brand }} {{ $preFilledVehicle->model }}</strong> ({{ $preFilledVehicle->plate_number }}) has been automatically filled in the form below.</p>
                        </div>
                    </div>
                @endif
                
                {{-- Vehicle Details --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label for="vehicle_model" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Model</label>
                        <input type="text" name="vehicle_model" id="vehicle_model" list="nepal-vehicles" value="{{ $preFilledVehicle ? $preFilledVehicle->model : old('vehicle_model') }}" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('vehicle_model') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. Scorpio, Pulsar" required>
                        <datalist id="nepal-vehicles">
                            <option value="Mahindra Scorpio">
                            <option value="Toyota Hilux">
                            <option value="Suzuki Swift">
                            <option value="Hyundai Creta">
                            <option value="Bajaj Pulsar 220">
                            <option value="TVS Apache RTR">
                            <option value="Yamaha FZ-S">
                            <option value="Honda Shine">
                            <option value="Royal Enfield Classic 350">
                            <option value="Kia Seltos">
                            <option value="Tata Nexon">
                        </datalist>
                        @error('vehicle_model')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="vehicle_year" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Year <span class="text-red-500">*</span></label>
                        <input type="number" name="vehicle_year" id="vehicle_year" value="{{ $preFilledVehicle ? $preFilledVehicle->year : old('vehicle_year') }}" min="1980" max="{{ now()->year }}"
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('vehicle_year') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. 2022" required>
                        @error('vehicle_year')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="vehicle_number" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">License Plate Number</label>
                        <input type="text" name="vehicle_number" id="vehicle_number" value="{{ $preFilledVehicle ? $preFilledVehicle->plate_number : old('vehicle_number') }}" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('vehicle_number') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. BA 1 PA 1234" required>
                        @error('vehicle_number')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="vehicle_type" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Type</label>
                        <select name="vehicle_type" id="vehicle_type" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('vehicle_type') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Type</option>
                            <option value="Car" {{ $preFilledVehicle && $preFilledVehicle->vehicle_type == 'Car' || old('vehicle_type') == 'Car' ? 'selected' : '' }}>Car</option>
                            <option value="SUV" {{ $preFilledVehicle && $preFilledVehicle->vehicle_type == 'SUV' || old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Bike" {{ $preFilledVehicle && $preFilledVehicle->vehicle_type == 'Bike' || old('vehicle_type') == 'Bike' ? 'selected' : '' }}>Bike</option>
                        </select>
                        @error('vehicle_type')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="service_type" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Type</label>
                        <select name="service_type" id="service_type" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('service_type') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Service</option>
                            <option value="General Service" {{ old('service_type') == 'General Service' ? 'selected' : '' }}>General Service</option>
                            <option value="Engine Repair" {{ old('service_type') == 'Engine Repair' ? 'selected' : '' }}>Engine Repair</option>
                            <option value="Brake Service" {{ old('service_type') == 'Brake Service' ? 'selected' : '' }}>Brake Service</option>
                            <option value="Oil Change" {{ old('service_type') == 'Oil Change' ? 'selected' : '' }}>Oil Change</option>
                            <option value="Electrical Repair" {{ old('service_type') == 'Electrical Repair' ? 'selected' : '' }}>Electrical Repair</option>
                            <option value="Inspection" {{ old('service_type') == 'Inspection' ? 'selected' : '' }}>Inspection</option>
                            <option value="Custom Service" {{ old('service_type') == 'Custom Service' ? 'selected' : '' }}>Custom Service</option>
                        </select>
                        @error('service_type')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="custom_service" class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Custom Service (If Selected)</label>
                    <input type="text" name="custom_service" id="custom_service" value="{{ old('custom_service') }}" 
                           class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold placeholder-gray-500 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('custom_service') ring-2 ring-red-500 @enderror" 
                           placeholder="Describe custom service">
                    @error('custom_service')
                        <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="preferred_date" class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Preferred Date</label>
                        <input type="date" name="preferred_date" id="preferred_date" value="{{ old('preferred_date', date('Y-m-d')) }}" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('preferred_date') ring-2 ring-red-500 @enderror" required>
                        @error('preferred_date')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="preferred_time_slot" class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Preferred Time Slot</label>
                        <select name="preferred_time_slot" id="preferred_time_slot" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('preferred_time_slot') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Slot</option>
                            <option value="Morning" {{ old('preferred_time_slot') == 'Morning' ? 'selected' : '' }}>Morning</option>
                            <option value="Afternoon" {{ old('preferred_time_slot') == 'Afternoon' ? 'selected' : '' }}>Afternoon</option>
                            <option value="Evening" {{ old('preferred_time_slot') == 'Evening' ? 'selected' : '' }}>Evening</option>
                        </select>
                        @error('preferred_time_slot')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="service_priority" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Priority</label>
                        <select name="service_priority" id="service_priority" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('service_priority') ring-2 ring-red-500 @enderror" required>
                            <option value="Normal" {{ old('service_priority', 'Normal') == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Urgent" {{ old('service_priority') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        @error('service_priority')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="service_location_type" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Location</label>
                        <select name="service_location_type" id="service_location_type" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('service_location_type') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Location</option>
                            <option value="Customer Address" {{ old('service_location_type') == 'Customer Address' ? 'selected' : '' }}>Customer Address</option>
                            <option value="Service Center Pickup" {{ old('service_location_type') == 'Service Center Pickup' ? 'selected' : '' }}>Service Center Pickup</option>
                        </select>
                        @error('service_location_type')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="location" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Customer Address (Optional)</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('location') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. Kathmandu, Pokhara">
                        @error('location')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone_number" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Contact Phone (Optional)</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', auth()->user()->phone ?? '') }}" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('phone_number') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. 98XXXXXXXX">
                        @error('phone_number')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="rental_required" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Require Car Rental?</label>
                        <select name="rental_required" id="rental_required" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('rental_required') ring-2 ring-red-500 @enderror" required>
                            <option value="0" {{ old('rental_required') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('rental_required') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        @error('rental_required')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="pickup_drop" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Pickup & Drop Service?</label>
                        <select name="pickup_drop" id="pickup_drop" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('pickup_drop') ring-2 ring-red-500 @enderror" required>
                            <option value="0" {{ old('pickup_drop') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('pickup_drop') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        @error('pickup_drop')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="problem_description" class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Problem Description (Optional)</label>
                    <textarea name="problem_description" id="problem_description" rows="4" 
                              class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-medium placeholder-gray-500 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all resize-none @error('problem_description') ring-2 ring-red-500 @enderror" 
                              placeholder="Describe any specific issues you've been having...">{{ old('problem_description') }}</textarea>
                    @error('problem_description')
                        <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notes" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Additional Notes (Optional)</label>
                    <textarea name="notes" id="notes" rows="3" 
                              class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-medium focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all resize-none @error('notes') ring-2 ring-red-500 @enderror" 
                              placeholder="Any extra details or requests...">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full flex items-center justify-center px-8 py-5 bg-[#ff5a1f] text-white font-black rounded-2xl shadow-xl shadow-orange-100 hover:bg-[#e44d18] transform hover:-translate-y-1 transition-all duration-300">
                        Confirm Booking
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    <p class="text-center text-[10px] text-gray-400 font-bold mt-6 tracking-widest uppercase">By booking, you agree to our terms of service</p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
