@extends('layouts.app')

@section('title', 'My Service Requests - AutoMate')

@section('content')
@include('components.customer-navbar')

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Page Header --}}
        <div class="mb-8 mt-4">
            <h1 class="text-3xl font-bold text-gray-900 font-sans">My Service Requests</h1>
            <p class="mt-2 text-lg text-gray-600">Track the status of your vehicle service requests in real time.</p>
        </div>

        {{-- Filter & Search Section --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
                    {{-- Status Filter --}}
                    <div class="w-full sm:w-48">
                        <label for="status_filter" class="sr-only">Filter by Status</label>
                        <select id="status_filter" class="block w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition transition-all duration-200 cursor-pointer">
                            <option value="all">All Statuses</option>
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    {{-- Search Input --}}
                    <div class="relative w-full sm:w-80">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" placeholder="Search by vehicle or service type..." class="block w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition transition-all duration-200">
                    </div>
                </div>

                {{-- Quick Link --}}
                <a href="{{ route('customer.requests.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-[#ff5a1f] text-white font-semibold text-sm hover:bg-[#e64b15] shadow-lg shadow-orange-100 transition duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Request
                </a>
            </div>
        </div>

        {{-- Requests Table Section --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Request ID</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Vehicle</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Service Type</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Requested Date</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        {{-- Row 1: Pending Example --}}
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-900">#REQ-8291</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="p-2 bg-orange-50 rounded-lg mr-3">
                                        <svg class="w-4 h-4 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-700 font-medium">Toyota Corolla (2018)</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">Oil Change</td>
                            <td class="px-6 py-4 text-sm text-gray-600">Jan 22, 2026</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 mr-1.5"></span>
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium space-x-3">
                                <button onclick="openModal('modal-8291')" class="text-[#ff5a1f] hover:text-[#e64b15] transition">View Details</button>
                                <button class="text-red-500 hover:text-red-700 transition">Cancel</button>
                            </td>
                        </tr>

                        {{-- Row 2: In Progress Example --}}
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-900">#REQ-8104</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="p-2 bg-blue-50 rounded-lg mr-3">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-700 font-medium">Honda CR-V (2021)</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">Engine Repair</td>
                            <td class="px-6 py-4 text-sm text-gray-600">Jan 18, 2026</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-1.5"></span>
                                    In Progress
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <button onclick="openModal('modal-8104')" class="text-[#ff5a1f] hover:text-[#e64b15] transition">View Details</button>
                            </td>
                        </tr>

                        {{-- Row 3: Completed Example --}}
                        <tr class="hover:bg-gray-50/50 transition duration-150">
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-gray-900">#REQ-7952</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="p-2 bg-green-50 rounded-lg mr-3">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-gray-700 font-medium">Tesla Model 3 (2022)</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">Battery Replacement</td>
                            <td class="px-6 py-4 text-sm text-gray-600">Jan 10, 2026</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                    Completed
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <button onclick="openModal('modal-7952')" class="text-[#ff5a1f] hover:text-[#e64b15] transition">View Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination (Placeholder) --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <span class="text-xs text-gray-500">Showing 1 to 3 of 3 results</span>
                <div class="flex items-center space-x-2">
                    <button class="p-2 rounded-lg border border-gray-200 text-gray-400 disabled hover:bg-white transition opacity-50 cursor-not-allowed" disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="p-2 rounded-lg border border-gray-200 text-gray-600 hover:bg-white transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Empty State (Hidden for demo) --}}
        <div id="empty-state" class="hidden flex flex-col items-center justify-center py-24 px-4 bg-white rounded-2xl shadow-sm border border-gray-100 text-center">
            <div class="p-6 bg-gray-50 rounded-full mb-6">
                <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">You haven’t requested any services yet</h3>
            <p class="text-gray-500 mb-8 max-w-sm">When you request a service, it will appear here for you to track and manage.</p>
            <a href="{{ route('customer.requests.create') }}" class="px-8 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition transform hover:-translate-y-0.5">
                Request a Service
            </a>
        </div>
    </main>
</div>

{{-- Modal Section: View Details --}}
<div id="modal-backdrop" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden flex items-center justify-center p-4">
    <div id="details-modal" class="bg-white rounded-3xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform scale-95 opacity-0 transition-all duration-300">
        <div class="p-6 sm:p-8">
            <div class="flex items-start justify-between mb-8">
                <div>
                    <span class="text-xs font-bold text-[#ff5a1f] uppercase tracking-widest">Request Details</span>
                    <h2 class="text-2xl font-bold text-gray-900 mt-1">#REQ-8291</h2>
                </div>
                <button onclick="closeModal()" class="p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Vehicle Info --}}
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-900 border-l-4 border-orange-400 pl-3">Vehicle Info</h3>
                    <div class="bg-gray-50 rounded-2xl p-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Vehicle:</span>
                            <span class="text-gray-900 font-medium text-right">Toyota Corolla (2018)</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">License Plate:</span>
                            <span class="text-gray-900 font-medium">BA 2 PA 1234</span>
                        </div>
                    </div>
                </div>

                {{-- Service Info --}}
                <div class="space-y-4">
                    <h3 class="text-sm font-semibold text-gray-900 border-l-4 border-blue-400 pl-3">Service Details</h3>
                    <div class="bg-gray-50 rounded-2xl p-4 space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Service Type:</span>
                            <span class="text-gray-900 font-medium">Oil Change</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Date:</span>
                            <span class="text-gray-900 font-medium">Jan 22, 2026</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Time Slot:</span>
                            <span class="text-gray-900 font-medium capitalize">Morning</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Pick-up:</span>
                            <span class="text-gray-900 font-medium">Yes</span>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="md:col-span-2 space-y-4">
                    <h3 class="text-sm font-semibold text-gray-900 border-l-4 border-purple-400 pl-3">Additional Notes</h3>
                    <div class="bg-gray-50 rounded-2xl p-4 text-sm text-gray-600 italic">
                        "Vehicle has been making a squeaking noise when braking. Please check the brake pads as well."
                    </div>
                </div>

                {{-- Progress Timeline --}}
                <div class="md:col-span-2 space-y-6 pt-4">
                    <h3 class="text-sm font-semibold text-gray-900 border-l-4 border-green-400 pl-3 mb-6">Service Progress</h3>
                    <div class="relative ml-4">
                        {{-- Timeline Items --}}
                        <div class="space-y-8 relative before:absolute before:inset-y-0 before:left-[11px] before:w-[2px] before:bg-gray-100">
                            {{-- Step 1 --}}
                            <div class="flex items-start relative z-10">
                                <div class="w-6 h-6 rounded-full bg-green-500 flex items-center justify-center ring-4 ring-white">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div class="ml-6">
                                    <p class="text-sm font-bold text-gray-900">Request Submitted</p>
                                    <p class="text-xs text-gray-500 mt-1">Jan 20, 2026 - 02:45 PM</p>
                                </div>
                            </div>
                            {{-- Step 2 --}}
                            <div class="flex items-start relative z-10 opacity-50">
                                <div class="w-6 h-6 rounded-full bg-gray-200 flex items-center justify-center ring-4 ring-white">
                                    <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                                </div>
                                <div class="ml-6">
                                    <p class="text-sm font-semibold text-gray-500">Pick-up In Progress</p>
                                    <p class="text-xs text-gray-400 mt-0.5 whitespace-nowrap">Scheduled for Jan 22</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex justify-end">
                <button onclick="closeModal()" class="px-8 py-3 rounded-xl bg-gray-900 text-white font-bold hover:bg-gray-800 transition">
                    Done
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        const backdrop = document.getElementById('modal-backdrop');
        const modal = document.getElementById('details-modal');
        
        // In a real app, you'd fetch data based on the ID here
        
        backdrop.classList.remove('hidden');
        backdrop.classList.add('flex');
        
        setTimeout(() => {
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeModal() {
        const backdrop = document.getElementById('modal-backdrop');
        const modal = document.getElementById('details-modal');
        
        modal.classList.remove('scale-100', 'opacity-100');
        modal.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
        }, 300);
    }

    // Close on backdrop click
    document.getElementById('modal-backdrop').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>

@endsection
