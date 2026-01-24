@extends('layouts.app')

@section('title', 'Book a Service - AutoMate')

@section('content')
@include('customer.navbar')

<div class="min-h-screen bg-gray-50 pb-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
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
        <div class="bg-white rounded-[2.5rem] shadow-2xl p-8 sm:p-12 border border-gray-100">
            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-8">
                @csrf
                
                {{-- Vehicle Details Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="vehicle_number" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Number</label>
                        <input type="text" name="vehicle_number" id="vehicle_number" value="{{ old('vehicle_number') }}" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('vehicle_number') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. BA 1 PA 1234" required>
                        @error('vehicle_number')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="vehicle_type" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Type</label>
                        <select name="vehicle_type" id="vehicle_type" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('vehicle_type') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Type</option>
                            <option value="Car" {{ old('vehicle_type') == 'Car' ? 'selected' : '' }}>Car</option>
                            <option value="Bike" {{ old('vehicle_type') == 'Bike' ? 'selected' : '' }}>Bike</option>
                        </select>
                        @error('vehicle_type')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Vehicle Model and Location Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="vehicle_model" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Model</label>
                        <input type="text" name="vehicle_model" id="vehicle_model" list="nepal-vehicles" value="{{ old('vehicle_model') }}" 
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

                    <div>
                        <label for="location" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Pick-up Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('location') ring-2 ring-red-500 @enderror" 
                               placeholder="e.g. Kathmandu, Pokhara" required>
                        @error('location')
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Service and Phone Row --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="service_type" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Type</label>
                        <select name="service_type" id="service_type" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none @error('service_type') ring-2 ring-red-500 @enderror" required>
                            <option value="">Select Service</option>
                            <option value="General Service" {{ old('service_type') == 'General Service' ? 'selected' : '' }}>General Service</option>
                            <option value="Full Wash" {{ old('service_type') == 'Full Wash' ? 'selected' : '' }}>Full Wash & Shine</option>
                            <option value="Oil Change" {{ old('service_type') == 'Oil Change' ? 'selected' : '' }}>Oil Change</option>
                            <option value="Engine Tuning" {{ old('service_type') == 'Engine Tuning' ? 'selected' : '' }}>Engine Tuning</option>
                            <option value="Brake Inspection" {{ old('service_type') == 'Brake Inspection' ? 'selected' : '' }}>Brake Inspection & Repair</option>
                            <option value="Battery Check" {{ old('service_type') == 'Battery Check' ? 'selected' : '' }}>Battery Check & Replacement</option>
                            <option value="AC Service" {{ old('service_type') == 'AC Service' ? 'selected' : '' }}>AC Service & Gas Top-up</option>
                            <option value="Repair" {{ old('service_type') == 'Repair' ? 'selected' : '' }}>Other Repair</option>
                        </select>
                        @error('service_type')
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

                <div>
                    <label for="preferred_date" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Preferred Date</label>
                    <input type="date" name="preferred_date" id="preferred_date" value="{{ old('preferred_date', date('Y-m-d')) }}" 
                           class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all @error('preferred_date') ring-2 ring-red-500 @enderror" required>
                    @error('preferred_date')
                        <p class="mt-2 text-xs font-bold text-red-500 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="problem_description" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Problem Description (Optional)</label>
                    <textarea name="problem_description" id="problem_description" rows="4" 
                              class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-medium focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all resize-none @error('problem_description') ring-2 ring-red-500 @enderror" 
                              placeholder="Describe any specific issues you've been having...">{{ old('problem_description') }}</textarea>
                    @error('problem_description')
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
