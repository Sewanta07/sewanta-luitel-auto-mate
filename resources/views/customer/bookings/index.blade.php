@extends('layouts.app')

@section('title', 'My Bookings - AutoMate')

@section('content')
@include('customer.navbar')

<div class="min-h-screen bg-gray-50 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
            <div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">My <span class="text-[#ff5a1f]">Bookings</span></h1>
                <p class="text-gray-500 font-medium mt-2">Manage and track your vehicle service requests.</p>
            </div>
            <a href="{{ route('bookings.create') }}" class="inline-flex items-center px-8 py-4 bg-[#ff5a1f] text-white font-black rounded-2xl shadow-xl shadow-orange-100 hover:bg-[#e44d18] transform hover:-translate-y-1 transition-all duration-300 group">
                <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Book New Service
            </a>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center text-green-700 font-bold animate-fade-in-down">
                <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Bookings Table/List --}}
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            @if($bookings->isEmpty())
                <div class="p-20 text-center">
                    <div class="w-24 h-24 bg-orange-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v3a2 2 0 002 2h2"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-2">No bookings found</h3>
                    <p class="text-gray-500 font-medium mb-8">You haven't made any service bookings yet.</p>
                    <a href="{{ route('bookings.create') }}" class="text-[#ff5a1f] font-black hover:underline px-6 py-3 bg-orange-50 rounded-xl transition-all">Start by booking your first service →</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-50">
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Vehicle Details</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Service Type</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Preferred Date</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mr-4 group-hover:bg-orange-100 group-hover:text-[#ff5a1f] transition-all">
                                                @if($booking->vehicle_type == 'Car')
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                                                @else
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h18M7 16h10a2 2 0 012 2v2a2 2 0 01-2 2H7a2 2 0 01-2-2v-2a2 2 0 012-2zM4 10h16M10 10V4h4v6"></path></svg>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-black text-gray-900">{{ $booking->vehicle_model }}</p>
                                                <p class="text-xs font-bold text-gray-400 uppercase tracking-tighter">{{ $booking->vehicle_number }} • {{ $booking->vehicle_type }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="font-bold text-gray-700">{{ $booking->service_type }}</p>
                                    </td>
                                    <td class="px-8 py-6 text-gray-500 font-medium">
                                        {{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y') }}
                                    </td>
                                    <td class="px-8 py-6">
                                        @php
                                            $statusColors = [
                                                'Pending' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
                                                'Approved' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600'],
                                                'Assigned' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
                                                'In Progress' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
                                                'Waiting for Parts' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600'],
                                                'Completed' => ['bg' => 'bg-green-50', 'text' => 'text-green-600'],
                                                'Cancelled' => ['bg' => 'bg-gray-50', 'text' => 'text-gray-600'],
                                                'Rejected' => ['bg' => 'bg-red-50', 'text' => 'text-red-600'],
                                            ];
                                            $colors = $statusColors[$booking->status] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-600'];
                                        @endphp
                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest {{ $colors['bg'] }} {{ $colors['text'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full mr-2 {{ str_replace('text', 'bg', $colors['text']) }}"></span>
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <!-- View Details Button (Always visible) -->
                                            <a href="{{ route('bookings.show', $booking->id) }}" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-lg text-xs font-black hover:bg-blue-100 transition-colors">
                                              View Details
                                            </a>

                                            @if($booking->status === 'Pending')
                                                <details class="text-left">
                                                    <summary class="cursor-pointer text-xs font-black text-gray-400 uppercase tracking-widest hover:text-[#ff5a1f]">Reschedule</summary>
                                                    <form action="{{ route('bookings.reschedule', $booking->id) }}" method="POST" class="mt-3 bg-gray-50 p-3 rounded-xl border border-gray-100 space-y-2">
                                                        @csrf
                                                        <input type="date" name="preferred_date" value="{{ $booking->preferred_date }}" class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold">
                                                        <select name="preferred_time_slot" class="w-full px-3 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold">
                                                            <option value="Morning" {{ $booking->preferred_time_slot == 'Morning' ? 'selected' : '' }}>Morning</option>
                                                            <option value="Afternoon" {{ $booking->preferred_time_slot == 'Afternoon' ? 'selected' : '' }}>Afternoon</option>
                                                            <option value="Evening" {{ $booking->preferred_time_slot == 'Evening' ? 'selected' : '' }}>Evening</option>
                                                        </select>
                                                        <button type="submit" class="w-full px-3 py-2 bg-orange-500 text-white rounded-lg text-xs font-black">Save</button>
                                                    </form>
                                                </details>

                                                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg text-xs font-black hover:bg-red-100">Cancel</button>
                                                </form>
                                            @endif

                                            @if($booking->status === 'Completed')
                                                <a href="{{ route('bookings.invoice', $booking->id) }}" class="px-3 py-2 bg-green-50 text-green-600 rounded-lg text-xs font-black hover:bg-green-100">Invoice</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
@keyframes fade-in-down {
    0% { opacity: 0; transform: translateY(-10px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-down {
    animation: fade-in-down 0.5s ease-out;
}
</style>
@endsection
