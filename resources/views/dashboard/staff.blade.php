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

            {{-- Card 4: Assigned Rentals --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-1">{{ $stats['assigned_rentals'] }}</h3>
                <p class="text-sm font-bold text-gray-500">Assigned Rentals</p>
            </div>

            {{-- Card 5: Ready for Pickup Rentals --}}
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-1">{{ $stats['ready_pickup_rentals'] }}</h3>
                <p class="text-sm font-bold text-gray-500">Rentals Ready for Pickup</p>
            </div>
        </div>

        {{-- Recent Work (Bookings + Rentals) --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900">Recent Work</h2>
                <span class="text-sm text-gray-500">{{ date('l, F j, Y') }}</span>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($recentWork as $item)
                    <div class="p-6 hover:bg-gray-50 transition flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start md:items-center gap-4">
                            <div class="px-4 py-2 rounded-xl text-center min-w-[5rem] {{ $item['type'] === 'rental' ? 'bg-indigo-50' : 'bg-blue-50' }}">
                                <span class="block text-sm font-bold {{ $item['type'] === 'rental' ? 'text-indigo-900' : 'text-blue-900' }}">
                                    {{ $item['date_label'] }}
                                </span>
                                <span class="block text-xs uppercase {{ $item['type'] === 'rental' ? 'text-indigo-500' : 'text-blue-500' }}">
                                    {{ $item['time_label'] }}
                                </span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900">
                                    {{ $item['title'] }}
                                    <span class="text-xs font-bold uppercase tracking-wide {{ $item['type'] === 'rental' ? 'text-indigo-600' : 'text-orange-600' }}">({{ $item['type'] }})</span>
                                </h3>
                                <p class="text-sm text-gray-500">{{ $item['subtitle'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @php
                                $statusColors = [
                                    'Assigned' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700'],
                                    'Customer Accepted' => ['bg' => 'bg-cyan-100', 'text' => 'text-cyan-700'],
                                    'In Progress' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                                    'Waiting for Parts' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700'],
                                    'Completed' => ['bg' => 'bg-green-100', 'text' => 'text-green-700'],
                                    'Ready for Pickup' => ['bg' => 'bg-amber-100', 'text' => 'text-amber-700'],
                                    'Picked Up' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                                    'In Use' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-700'],
                                    'Returned' => ['bg' => 'bg-green-100', 'text' => 'text-green-700'],
                                ];
                                $colors = $statusColors[$item['status']] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700'];
                            @endphp
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $colors['bg'] }} {{ $colors['text'] }}">
                                {{ $item['status'] }}
                            </span>
                            <a href="{{ $item['action_url'] }}" class="px-3 py-1.5 bg-orange-50 text-orange-600 rounded-lg text-xs font-black hover:bg-orange-100 transition-colors">
                                {{ $item['action_label'] }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">No Assigned Work Yet</h3>
                        <p class="text-gray-500">You don't have any bookings or rentals assigned right now.</p>
                    </div>
                @endforelse
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 text-center flex items-center justify-center gap-6">
                <a href="{{ route('staff.bookings') }}" class="text-sm font-bold text-gray-600 hover:text-[#ff5a1f] transition">View All Bookings &rarr;</a>
                <a href="{{ route('staff.rentals.index') }}" class="text-sm font-bold text-gray-600 hover:text-[#ff5a1f] transition">View All Rentals &rarr;</a>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const userId = @json((int) $user->id);
        let reloadTimer = null;

        const scheduleReload = () => {
            if (reloadTimer) {
                return;
            }

            reloadTimer = setTimeout(() => {
                window.location.reload();
            }, 1200);
        };

        if (window.realtime) {
            window.realtime.subscribeDashboard('staff', userId, {
                serviceStatus: scheduleReload,
                rentalStatus: scheduleReload,
            });
        }
    });
</script>
@endpush
