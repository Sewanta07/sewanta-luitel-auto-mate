@extends('layouts.app')

@section('title', 'Inventory Requests - AutoMate')

@section('content')
@include('components.staff-navbar')

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        {{-- Page Header --}}
        <div class="sm:flex sm:items-center sm:justify-between mb-8 mt-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Inventory Management</h1>
                <p class="mt-2 text-lg text-gray-600">Check stock levels and request parts for service jobs.</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                 <button type="button" class="inline-flex items-center rounded-xl bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm border border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#ff5a1f] focus:ring-offset-2 transition-colors">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Request History
                </button>
                <button type="button" class="inline-flex items-center rounded-xl border border-transparent bg-[#ff5a1f] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-[#ff5a1f] focus:ring-offset-2 transition-colors">
                    <svg class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    Request New Part
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Inventory List -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Search & Filters -->
                 <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-4">
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
                        </div>
                        <input type="text" class="block w-full rounded-xl border border-gray-300 pl-10 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3" placeholder="Search for parts (e.g., Oil Filter, Brake Pads)...">
                    </div>
                </div>

                <!-- Parts Table -->
                <div class="bg-white shadow-sm rounded-3xl border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Part Details</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKU</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Level</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Action</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500">
                                                ⚙️
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Synthetic Motor Oil (5W-30)</div>
                                                <div class="text-xs text-gray-500">Premium Grade</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        OIL-5W30-SYN
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            High (45 units)
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-[#ff5a1f] hover:text-[#e64b15]">Request</button>
                                    </td>
                                </tr>
                                 <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500">
                                               🛑
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Brake Pads (Front)</div>
                                                <div class="text-xs text-gray-500">Ceramic</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        BRK-PAD-F-01
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Low (3 sets)
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-[#ff5a1f] hover:text-[#e64b15]">Request</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500">
                                                🔋
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Car Battery (12V)</div>
                                                <div class="text-xs text-gray-500">Standard Lead-Acid</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        BAT-12V-STD
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Out of Stock
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-[#ff5a1f] hover:text-[#e64b15]">Urgent Request</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Quick Request Sidebar -->
            <div class="space-y-6">
                 <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Quick Request</h3>
                    <form>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Part Name / Number</label>
                                <input type="text" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                <input type="number" class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border" value="1">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Associated Booking (Optional)</label>
                                <select class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                    <option>Select booking...</option>
                                    <option>#BK-7890 (John Doe)</option>
                                    <option>#BK-7891 (Alice Smith)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Urgency</label>
                                <select class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3 border">
                                    <option>Normal</option>
                                    <option>Urgent</option>
                                    <option>Critical (Vehicle Off Road)</option>
                                </select>
                            </div>
                            <button type="button" class="w-full inline-flex justify-center rounded-xl border border-transparent bg-[#ff5a1f] py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-[#e64b15] transition-colors">
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

