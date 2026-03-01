@extends('layouts.customer-core')

@section('title', 'Book a Service - AutoMate')

@section('content')
@include('customer.navbar')

<div class="cs-page cs-booking-create-page min-h-screen bg-gray-50 pb-20">
    <div class="cs-container cs-booking-create-container max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        {{-- Back Link --}}
        <a href="{{ route('bookings.index') }}" class="cs-back-link inline-flex items-center text-sm font-bold text-gray-400 hover:text-[#ff5a1f] transition-colors mb-6 group">
            <svg class="w-5 h-5 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Back to My Bookings
        </a>

        {{-- Header Section --}}
        <div class="cs-page-head cs-page-head-center cs-booking-create-head mb-10 text-center">
            <h1 class="cs-page-title cs-booking-create-title text-4xl font-black text-gray-900 tracking-tight">Book <span class="cs-booking-create-title-accent text-[#ff5a1f]">Service</span></h1>
            <p class="cs-page-subtitle cs-booking-create-subtitle text-gray-500 font-medium mt-2">Professional care for your vehicle.</p>
        </div>

        {{-- Booking Form --}}
        <div class="cs-surface cs-form-card bg-white rounded-3xl shadow-xl p-6 sm:p-10 border border-gray-100">
            <form action="{{ route('bookings.store') }}" method="POST" class="cs-form-stack space-y-8">
                @csrf

                {{-- Saved Vehicles --}}
                <div class="cs-form-section cs-form-section-saved-vehicles">
                    <label for="saved_vehicle" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Saved Vehicles (Optional)</label>
                    <select id="saved_vehicle" class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none">
                        <option value="">Select from your saved vehicles</option>
                        @foreach($savedVehicles as $vehicle)
                            <option value="{{ $vehicle->vehicle_number }}">
                                {{ $vehicle->vehicle_name ? $vehicle->vehicle_name . ' • ' : '' }}{{ $vehicle->vehicle_model }} ({{ $vehicle->vehicle_number }})
                            </option>
                        @endforeach
                    </select>
                    <p class="cs-section-hint mt-2 text-[10px] font-bold text-gray-400 ml-1 uppercase tracking-widest">You can also fill details below</p>
                </div>

                {{-- Pre-filled info message --}}
                @if($preFilledVehicle)
                    <div class="cs-note cs-note-info cs-prefill-note p-4 rounded-2xl bg-blue-50 border border-blue-100 flex items-start">
                        <svg class="cs-prefill-note-icon w-5 h-5 text-blue-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="cs-prefill-note-content">
                            <p class="cs-prefill-note-title text-sm font-bold text-blue-900">Vehicle pre-filled</p>
                            <p class="cs-prefill-note-text text-xs text-blue-700 mt-1">The information for <strong>{{ $preFilledVehicle->brand }} {{ $preFilledVehicle->model }}</strong> ({{ $preFilledVehicle->plate_number }}) has been automatically filled in the form below.</p>
                        </div>
                    </div>
                @endif
                
                {{-- Vehicle Details --}}
                <div class="cs-form-grid cs-form-grid-vehicle grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="cs-field-group cs-field-group-full md:col-span-2">
                        <label for="vehicle_model" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Model</label>
                        <input type="text" name="vehicle_model" id="vehicle_model" list="nepal-vehicles" value="{{ $preFilledVehicle ? $preFilledVehicle->model : old('vehicle_model') }}" 
                               class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('vehicle_model') ring-2 ring-red-500 @enderror" 
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
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="cs-form-grid cs-form-grid-basics grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="cs-field-group">
                        <label for="vehicle_year" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Year <span class="text-red-500">*</span></label>
                        <input type="number" name="vehicle_year" id="vehicle_year" value="{{ $preFilledVehicle ? $preFilledVehicle->year : old('vehicle_year') }}" min="1980" max="{{ now()->year }}"
                               class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('vehicle_year') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. 2022" required>
                        @error('vehicle_year')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="cs-field-group">
                        <label for="vehicle_number" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">License Plate Number</label>
                        <input type="text" name="vehicle_number" id="vehicle_number" value="{{ $preFilledVehicle ? $preFilledVehicle->plate_number : old('vehicle_number') }}" 
                               class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('vehicle_number') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. BA 1 PA 1234" required>
                        @error('vehicle_number')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="cs-form-grid cs-form-grid-service grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="cs-field-group">
                        <label for="vehicle_type" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Type</label>
                        <select name="vehicle_type" id="vehicle_type" 
                                class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('vehicle_type') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Type</option>
                            <option value="Car" {{ $preFilledVehicle && $preFilledVehicle->vehicle_type == 'Car' || old('vehicle_type') == 'Car' ? 'selected' : '' }}>Car</option>
                            <option value="SUV" {{ $preFilledVehicle && $preFilledVehicle->vehicle_type == 'SUV' || old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                            <option value="Bike" {{ $preFilledVehicle && $preFilledVehicle->vehicle_type == 'Bike' || old('vehicle_type') == 'Bike' ? 'selected' : '' }}>Bike</option>
                        </select>
                        @error('vehicle_type')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="cs-field-group">
                        <label for="service_type" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Type</label>
                        <select name="service_type" id="service_type" 
                                class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('service_type') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Service</option>
                            <option value="General Service" {{ old('service_type') == 'General Service' ? 'selected' : '' }}>General Service</option>
                            <option value="Engine Repair" {{ old('service_type') == 'Engine Repair' ? 'selected' : '' }}>Engine Repair</option>
                            <option value="Brake Service" {{ old('service_type') == 'Brake Service' ? 'selected' : '' }}>Brake Service</option>
                            <option value="Oil Change" {{ old('service_type') == 'Oil Change' ? 'selected' : '' }}>Oil Change</option>
                            <option value="Electrical Repair" {{ old('service_type') == 'Electrical Repair' ? 'selected' : '' }}>Electrical Repair</option>
                            <option value="Inspection" {{ old('service_type') == 'Inspection' ? 'selected' : '' }}>Inspection</option>
                        </select>
                        @error('service_type')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="cs-form-grid cs-form-grid-schedule grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="cs-field-group">
                        <label for="preferred_date" class="cs-field-label block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Preferred Date</label>
                        <input type="date" name="preferred_date" id="preferred_date" value="{{ old('preferred_date', date('Y-m-d')) }}" 
                               class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('preferred_date') ring-2 ring-red-500 @enderror" required>
                        @error('preferred_date')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="cs-field-group">
                        <label for="preferred_time_slot" class="cs-field-label block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Preferred Time Slot</label>
                        <select name="preferred_time_slot" id="preferred_time_slot" 
                                class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('preferred_time_slot') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Slot</option>
                            <option value="Morning" {{ old('preferred_time_slot') == 'Morning' ? 'selected' : '' }}>Morning</option>
                            <option value="Afternoon" {{ old('preferred_time_slot') == 'Afternoon' ? 'selected' : '' }}>Afternoon</option>
                            <option value="Evening" {{ old('preferred_time_slot') == 'Evening' ? 'selected' : '' }}>Evening</option>
                        </select>
                        @error('preferred_time_slot')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="cs-form-grid cs-form-grid-priority grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="cs-field-group">
                        <label for="service_priority" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Priority</label>
                        <select name="service_priority" id="service_priority" 
                                class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('service_priority') ring-2 ring-red-500 @enderror" required>
                            <option value="Normal" {{ old('service_priority', 'Normal') == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Urgent" {{ old('service_priority') == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        @error('service_priority')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="cs-field-group">
                        <label for="service_location_type" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Location</label>
                        <select name="service_location_type" id="service_location_type" 
                                class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('service_location_type') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Location</option>
                            <option value="Customer Address" {{ old('service_location_type') == 'Customer Address' ? 'selected' : '' }}>Customer Address</option>
                            <option value="Service Center Pickup" {{ old('service_location_type') == 'Service Center Pickup' ? 'selected' : '' }}>Service Center Pickup</option>
                        </select>
                        @error('service_location_type')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="cs-form-grid cs-form-grid-contact grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="cs-field-group">
                        <label for="location" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Customer Address</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" 
                               class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('location') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. Kathmandu, Pokhara" required>
                        @error('location')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="cs-field-group">
                        <label for="phone_number" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Contact Phone</label>
                        <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', auth()->user()->phone ?? '') }}" 
                               class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('phone_number') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. 98XXXXXXXX" required>
                        @error('phone_number')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="cs-form-grid cs-form-grid-notes grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="cs-field-group">
                        <label for="problem_description" class="cs-field-label block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Problem Description</label>
                        <textarea name="problem_description" id="problem_description" rows="4" 
                                  class="cs-field-control cs-field-textarea w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-medium placeholder-gray-500 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all resize-none @error('problem_description') ring-2 ring-red-500 @enderror" 
                                  placeholder="Describe any specific issues you've been having..." required>{{ old('problem_description') }}</textarea>
                        @error('problem_description')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="cs-field-group">
                        <label for="pickup_drop" class="cs-field-label block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Pickup & Drop Service?</label>
                        <select name="pickup_drop" id="pickup_drop" 
                                class="cs-field-control w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('pickup_drop') ring-2 ring-red-500 @enderror" required>
                            <option value="0" {{ old('pickup_drop') == '0' ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('pickup_drop') == '1' ? 'selected' : '' }}>Yes</option>
                        </select>
                        @error('pickup_drop')
                            <p class="cs-field-error mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="cs-form-actions pt-6">
                    <button type="submit" class="cs-btn cs-btn-primary cs-btn-block w-full flex items-center justify-center px-8 py-5 bg-[#ff5a1f] text-white font-black rounded-2xl shadow-xl shadow-orange-100 hover:bg-[#e44d18] transform hover:-translate-y-1 transition-all duration-300">
                        Confirm Booking
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    <p class="cs-form-footnote text-center text-[10px] text-gray-400 font-bold mt-6 tracking-widest uppercase">By booking, you agree to our terms of service</p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
