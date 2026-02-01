@extends('layouts.app')

@section('title', 'Vehicles')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
    {{-- Sidebar --}}
    <aside class="w-64 flex-shrink-0 z-30">
        @include('components.admin-sidebar')
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-7xl w-full mx-auto p-6">
            {{-- Page Header --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 mt-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Vehicles</h1>
                    <p class="mt-2 text-lg text-gray-600">Manage registered vehicles and assignments.</p>
                </div>
                <div class="flex space-x-3">
                    <button class="px-5 py-2.5 bg-[#ff5a1f] text-white font-bold rounded-xl shadow-lg shadow-orange-200 hover:bg-[#e64b15] transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        Add Vehicle
                    </button>
                </div>
            </div>

            {{-- Content Card --}}
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 min-h-[400px] flex flex-col items-center justify-center text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-6 text-gray-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Vehicle Management</h3>
                <p class="text-gray-500 max-w-md mx-auto">This module will allow admin to manage the fleet, assign vehicles to staff, and track vehicle status.</p>
                <button class="mt-6 px-4 py-2 text-[#ff5a1f] font-semibold hover:bg-orange-50 rounded-lg transition">
                    Configure Fleet Settings
                </button>
            </div>
        </main>
    </div>
</div>
@endsection

