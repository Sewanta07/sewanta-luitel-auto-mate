@extends('layouts.app')

@section('title', 'Rent a Car - AutoMate')

@section('content')
@include('components.customer-navbar')

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Page Header --}}
        <div class="mb-8 mt-4">
            <h1 class="text-3xl font-bold text-gray-900">Rent a Vehicle</h1>
            <p class="mt-2 text-lg text-gray-600">Find the perfect car for your journey. Reliable and affordable rentals.</p>
        </div>

        {{-- Filter Section --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="pickup_date" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Pick-up Date</label>
                    <input type="date" id="pickup_date" class="block w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition" value="{{ date('Y-m-d') }}">
                </div>
                <div>
                    <label for="vehicle_type" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Vehicle Type</label>
                    <select id="vehicle_type" class="block w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition">
                        <option value="all">All Types</option>
                        <option value="sedan">Sedan</option>
                        <option value="suv">SUV</option>
                        <option value="luxury">Luxury</option>
                        <option value="van">Van</option>
                    </select>
                </div>
                <div>
                    <label for="price_range" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Max Price / Day</label>
                    <select id="price_range" class="block w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition">
                        <option value="any">Any Price</option>
                        <option value="50">Under $50</option>
                        <option value="100">Under $100</option>
                        <option value="200">Under $200</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full px-6 py-2.5 rounded-xl bg-gray-900 text-white font-bold hover:bg-gray-800 transition shadow-lg shadow-gray-200">
                        Search Vehicles
                    </button>
                </div>
            </div>
        </div>

        {{-- Vehicle Listing Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            {{-- Car 1 --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 group flex flex-col">
                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Toyota Camry" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800 shadow-sm">
                        Sedan
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Toyota Camry</h3>
                            <p class="text-sm text-gray-500">2023 Model</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-[#ff5a1f]">$45</span>
                            <span class="text-xs text-gray-400">/ day</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 mb-6 mt-4">
                        <div class="flex items-center text-xs text-gray-500" title="Transmission">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Auto
                        </div>
                        <div class="flex items-center text-xs text-gray-500" title="Seats">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            5 Seats
                        </div>
                        <div class="flex items-center text-xs text-gray-500" title="Fuel Type">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Hybrid
                        </div>
                    </div>

                    <button onclick="openBookingModal('Toyota Camry', 45)" class="mt-auto w-full py-3 rounded-xl bg-gray-900 text-white font-bold hover:bg-[#ff5a1f] transition duration-300 shadow-lg shadow-gray-100 hover:shadow-orange-100 group-hover:scale-[1.02] transform">
                        Rent Now
                    </button>
                </div>
            </div>

            {{-- Car 2 --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 group flex flex-col">
                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Honda CR-V" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800 shadow-sm">
                        SUV
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Honda CR-V</h3>
                            <p class="text-sm text-gray-500">2022 Model</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-[#ff5a1f]">$65</span>
                            <span class="text-xs text-gray-400">/ day</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 mb-6 mt-4">
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Auto
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            5 Seats
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Petrol
                        </div>
                    </div>

                    <button onclick="openBookingModal('Honda CR-V', 65)" class="mt-auto w-full py-3 rounded-xl bg-gray-900 text-white font-bold hover:bg-[#ff5a1f] transition duration-300 shadow-lg shadow-gray-100 hover:shadow-orange-100 group-hover:scale-[1.02] transform">
                        Rent Now
                    </button>
                </div>
            </div>

            {{-- Car 3 --}}
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 group flex flex-col">
                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1542282088-fe8426682b8f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Hyundai Tucson" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800 shadow-sm">
                        SUV
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Hyundai Tucson</h3>
                            <p class="text-sm text-gray-500">2023 Model</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-[#ff5a1f]">$60</span>
                            <span class="text-xs text-gray-400">/ day</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4 mb-6 mt-4">
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                            Auto
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            5 Seats
                        </div>
                        <div class="flex items-center text-xs text-gray-500">
                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Diesel
                        </div>
                    </div>

                    <button onclick="openBookingModal('Hyundai Tucson', 60)" class="mt-auto w-full py-3 rounded-xl bg-gray-900 text-white font-bold hover:bg-[#ff5a1f] transition duration-300 shadow-lg shadow-gray-100 hover:shadow-orange-100 group-hover:scale-[1.02] transform">
                        Rent Now
                    </button>
                </div>
            </div>

        </div>
    </main>
</div>

{{-- Booking Modal --}}
<div id="booking-modal-backdrop" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden flex items-center justify-center p-4">
    <div id="booking-modal" class="bg-white rounded-3xl shadow-2xl max-w-lg w-full transform scale-95 opacity-0 transition-all duration-300">
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Complete Reservation</h2>
                <button onclick="closeBookingModal()" class="p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="bg-orange-50 rounded-xl p-4 mb-6 flex items-center justify-between">
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Vehicle</span>
                    <span id="modal-vehicle-name" class="text-lg font-bold text-gray-900">Toyota Camry</span>
                </div>
                <div class="text-right">
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wide">Price/Day</span>
                    <span id="modal-vehicle-price" class="text-lg font-bold text-[#ff5a1f]">$45</span>
                </div>
            </div>

            <form action="#" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="vehicle_name" id="form_vehicle_name">
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Start Date</label>
                        <input type="date" name="start_date" id="start_date" required onchange="calculateTotal()" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">End Date</label>
                        <input type="date" name="end_date" id="end_date" required onchange="calculateTotal()" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition">
                    </div>
                </div>

                {{-- Total Calculation --}}
                <div class="py-4 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Duration</p>
                        <p id="total-days" class="text-lg font-bold text-gray-900">0 Days</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Total Amount</p>
                        <p id="total-price" class="text-2xl font-bold text-[#ff5a1f]">$0</p>
                    </div>
                </div>

                <button type="button" class="w-full py-4 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition transform hover:-translate-y-0.5">
                    Confirm Booking
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    let currentPrice = 0;

    function openBookingModal(name, price) {
        currentPrice = price;
        document.getElementById('modal-vehicle-name').textContent = name;
        document.getElementById('form_vehicle_name').value = name;
        document.getElementById('modal-vehicle-price').textContent = '$' + price;
        
        // Set default dates
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('start_date').value = today;
        document.getElementById('start_date').min = today;
        document.getElementById('end_date').min = today;
        
        calculateTotal();

        const backdrop = document.getElementById('booking-modal-backdrop');
        const modal = document.getElementById('booking-modal');
        backdrop.classList.remove('hidden');
        backdrop.classList.add('flex');
        setTimeout(() => {
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeBookingModal() {
        const backdrop = document.getElementById('booking-modal-backdrop');
        const modal = document.getElementById('booking-modal');
        modal.classList.remove('scale-100', 'opacity-100');
        modal.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
        }, 300);
    }

    function calculateTotal() {
        const start = new Date(document.getElementById('start_date').value);
        const end = new Date(document.getElementById('end_date').value);
        
        if (start && end && end >= start) {
            // Calculate difference in days (add 1 to include start date)
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; 
            
            document.getElementById('total-days').textContent = diffDays + (diffDays === 1 ? ' Day' : ' Days');
            document.getElementById('total-price').textContent = '$' + (diffDays * currentPrice);
        } else {
            document.getElementById('total-days').textContent = '0 Days';
            document.getElementById('total-price').textContent = '$0';
        }
    }

    document.getElementById('booking-modal-backdrop').addEventListener('click', function(e) {
        if (e.target === this) closeBookingModal();
    });
</script>
@endsection
