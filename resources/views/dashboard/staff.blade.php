@extends('layouts.app')

@section('title', 'Staff Dashboard - AutoMate')

@section('content')
@include('components.staff-navbar')

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 mt-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Staff Portal</h1>
                <p class="mt-2 text-lg text-gray-600">Manage your service queue and update repair status.</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 animate-pulse">
                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                    System Online
                </span>
            </div>
        </div>

        {{-- Dashboard Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            {{-- Card 1: Total Assigned --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-1">{{ $stats['total'] }}</h3>
                <p class="text-sm font-bold text-gray-500">Total Assigned</p>
            </div>

            {{-- Card 2: Awaiting Acceptance --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-yellow-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-1">{{ $stats['assigned'] }}</h3>
                <p class="text-sm font-bold text-gray-500">Awaiting Acceptance</p>
            </div>

            {{-- Card 3: In Progress --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-1">{{ $stats['in_progress'] }}</h3>
                <p class="text-sm font-bold text-gray-500">Active Jobs</p>
            </div>

            {{-- Card 4: Waiting Parts --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-1">{{ $stats['waiting_parts'] }}</h3>
                <p class="text-sm font-bold text-gray-500">Waiting Parts</p>
            </div>

            {{-- Card 5: Completed --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-1">{{ $stats['completed'] }}</h3>
                <p class="text-sm font-bold text-gray-500">Completed ({{ $stats['completed_today'] }} today)</p>
            </div>
        </div>

        {{-- Schedule Section --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900">Recent Assignments</h2>
                <span class="text-sm text-gray-500">{{ date('l, F j, Y') }}</span>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentBookings as $booking)
                    <div class="p-6 hover:bg-gray-50 transition flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start md:items-center gap-4">
                            <div class="px-4 py-2 
                                @if($booking->status === 'Assigned') bg-yellow-50 
                                @elseif($booking->status === 'Customer Accepted' || $booking->status === 'In Progress') bg-blue-50
                                @elseif($booking->status === 'Completed') bg-green-50
                                @else bg-gray-100 
                                @endif
                                rounded-xl text-center min-w-[5rem]">
                                <span class="block text-sm font-bold 
                                    @if($booking->status === 'Assigned') text-yellow-900 
                                    @elseif($booking->status === 'Customer Accepted' || $booking->status === 'In Progress') text-blue-900
                                    @elseif($booking->status === 'Completed') text-green-900
                                    @else text-gray-900 
                                    @endif">
                                    {{ \Carbon\Carbon::parse($booking->preferred_date)->format('M d') }}
                                </span>
                                <span class="block text-xs 
                                    @if($booking->status === 'Assigned') text-yellow-500 
                                    @elseif($booking->status === 'Customer Accepted' || $booking->status === 'In Progress') text-blue-500
                                    @elseif($booking->status === 'Completed') text-green-500
                                    @else text-gray-500 
                                    @endif uppercase">
                                    {{ $booking->preferred_time_slot }}
                                </span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $booking->service_type }} - {{ $booking->vehicle_model }}</h3>
                                <p class="text-sm text-gray-500">
                                    Owner: {{ $booking->customer->name ?? 'Unknown' }} • 
                                    <span class="font-mono text-gray-400">{{ $booking->booking_code }}</span> •
                                    <span class="font-bold">{{ $booking->vehicle_number }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @php
                                $statusColors = [
                                    'Assigned' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500'],
                                    'Customer Accepted' => ['bg' => 'bg-cyan-100', 'text' => 'text-cyan-700', 'dot' => 'bg-cyan-500'],
                                    'In Progress' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'dot' => 'bg-blue-500'],
                                    'Waiting for Parts' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700', 'dot' => 'bg-purple-500'],
                                    'Completed' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'dot' => 'bg-green-500'],
                                ];
                                $colors = $statusColors[$booking->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'dot' => 'bg-gray-500'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $colors['bg'] }} {{ $colors['text'] }}">
                                @if(in_array($booking->status, ['Customer Accepted', 'In Progress']))
                                    <span class="w-1.5 h-1.5 rounded-full {{ $colors['dot'] }} mr-2 animate-pulse"></span>
                                @endif
                                {{ $booking->status }}
                            </span>
                            <a href="{{ route('staff.services.show', $booking->id) }}" class="px-3 py-1.5 bg-orange-50 text-orange-600 rounded-lg text-xs font-black hover:bg-orange-100 transition-colors">
                                View
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">No Assignments Yet</h3>
                        <p class="text-gray-500">You don't have any service bookings assigned to you.</p>
                    </div>
                @endforelse
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
                <a href="{{ route('staff.bookings') }}" class="text-sm font-bold text-gray-600 hover:text-[#ff5a1f] transition">View All Bookings &rarr;</a>
            </div>
        </div>
    </main>
</div>
@endsection
