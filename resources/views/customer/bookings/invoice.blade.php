@extends('layouts.app')

@section('title', 'Service Invoice - AutoMate')

@section('content')
@include('customer.navbar')

<div class="min-h-screen bg-gray-50 pb-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 sm:p-10">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-black text-gray-900">Service Invoice</h1>
                    <p class="text-gray-500 mt-1">Booking {{ $booking->booking_code }}</p>
                </div>
                <span class="px-3 py-1 text-xs font-black uppercase tracking-widest rounded-full bg-green-50 text-green-600">Completed</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Vehicle</p>
                    <p class="text-lg font-bold text-gray-900">{{ $booking->vehicle_model }}</p>
                    <p class="text-sm text-gray-500">{{ $booking->vehicle_number }} • {{ $booking->vehicle_type }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Service</p>
                    <p class="text-lg font-bold text-gray-900">{{ $booking->service_type }}</p>
                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }} • {{ $booking->preferred_time_slot }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Priority</p>
                    <p class="text-sm font-bold text-gray-900">{{ $booking->service_priority }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Location</p>
                    <p class="text-sm font-bold text-gray-900">{{ $booking->service_location_type }}</p>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-100 pt-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-bold text-gray-500">Estimated Cost</p>
                    <p class="text-xl font-black text-gray-900">{{ $booking->estimated_cost ? 'Rs. ' . number_format($booking->estimated_cost, 2) : 'TBD' }}</p>
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <a href="{{ route('bookings.index') }}" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl text-center hover:bg-gray-200">Back to Bookings</a>
                <button class="flex-1 px-6 py-3 bg-[#ff5a1f] text-white font-black rounded-xl hover:bg-[#e44d18]">Download PDF</button>
            </div>
        </div>
    </div>
</div>
@endsection
