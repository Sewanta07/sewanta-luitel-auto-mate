@extends('layouts.app')

@section('title', 'Service Logs - AutoMate')

@section('content')
@include('components.staff-navbar')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mb-8 mt-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h1 class="text-4xl font-black text-gray-900">Service History</h1>
                    <p class="mt-2 text-base text-gray-600 font-medium">View your completed services and work logs</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('staff.service.logs') }}" class="px-4 py-3 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white hover:shadow-lg transition font-bold flex items-center gap-2 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Refresh
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow border border-gray-100 p-6 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Total Completed</p>
                        <p class="text-3xl font-black text-green-600 mt-2">{{ $totalServices }}</p>
                        <p class="text-xs text-gray-500 mt-2">Services completed</p>
                    </div>
                    <div class="w-14 h-14 bg-green-50 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow border border-gray-100 p-6 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Total Revenue</p>
                        <p class="text-3xl font-black text-blue-600 mt-2">Rs. {{ number_format($totalCost, 0) }}</p>
                        <p class="text-xs text-gray-500 mt-2">Estimated service value</p>
                    </div>
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mb-8">
            <h3 class="text-lg font-black text-gray-900 mb-4">Filter Results</h3>
            <form action="{{ route('staff.service.logs') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-wider mb-2">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Booking ref, vehicle..." class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-sm font-medium outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-wider mb-2">From Date</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-sm font-medium outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-black text-gray-500 uppercase tracking-wider mb-2">To Date</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 text-sm font-medium outline-none transition">
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full px-6 py-3 bg-orange-500 text-white font-bold rounded-lg hover:bg-orange-600 transition shadow-lg">Filter</button>
                    <a href="{{ route('staff.service.logs') }}" class="w-full text-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition">Reset</a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <h2 class="text-lg font-black text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Completed Services
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Booking Ref</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Vehicle</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Cost</th>
                            <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($logs as $log)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $log->created_at->format('M d, Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $log->created_at->format('h:i A') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-block px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-black text-sm">{{ $log->booking->booking_code }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $log->booking->vehicle_model }}</div>
                                    <div class="text-xs text-gray-500 font-mono">{{ $log->booking->vehicle_number }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 font-medium">{{ $log->booking->service_type }}</div>
                                    @if($log->notes)
                                        <div class="text-xs text-gray-500 mt-1">{{ \Illuminate\Support\Str::limit($log->notes, 70) }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-bold text-gray-900">Rs. {{ number_format((float) ($log->booking->total_amount ?? $log->booking->estimated_cost ?? 0), 2) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <a href="{{ route('staff.services.show', $log->booking->id) }}" class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 transition font-bold text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <p class="text-gray-500 font-bold text-lg">No completed services found</p>
                                    <p class="text-gray-400 text-sm mt-1">Your completed services will appear here</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($logs->hasPages())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Showing <span class="font-bold">{{ $logs->firstItem() }}</span> to <span class="font-bold">{{ $logs->lastItem() }}</span> of <span class="font-bold">{{ $logs->total() }}</span> results
                        </div>
                        <div class="flex gap-2">
                            @if ($logs->onFirstPage())
                                <button disabled class="px-4 py-2 rounded-lg bg-gray-200 text-gray-400 font-bold">← Previous</button>
                            @else
                                <a href="{{ $logs->previousPageUrl() }}" class="px-4 py-2 rounded-lg border-2 border-gray-300 text-gray-700 hover:border-orange-500 hover:text-orange-600 font-bold transition">← Previous</a>
                            @endif

                            @if ($logs->hasMorePages())
                                <a href="{{ $logs->nextPageUrl() }}" class="px-4 py-2 rounded-lg bg-orange-500 text-white font-bold hover:bg-orange-600 transition">Next →</a>
                            @else
                                <button disabled class="px-4 py-2 rounded-lg bg-gray-200 text-gray-400 font-bold">Next →</button>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
</div>
@endsection
