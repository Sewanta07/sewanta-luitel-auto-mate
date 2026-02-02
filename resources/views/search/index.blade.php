@extends('layouts.app')

@section('content')
  <div class="min-h-screen bg-gray-50">
    <!-- Header with Logo -->
    <div class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-6 py-6">
        <div class="text-center">
          <h1 class="text-4xl font-bold text-gray-900">AutoMate</h1>
          <p class="text-gray-600 mt-2">Search across services, customers, and inventory</p>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto p-6">
      <!-- Search Bar -->
      <div class="mb-8">
        <div class="relative">
          <input 
            type="search" 
            placeholder="Search for services, customers, parts, vehicles..." 
            class="w-full px-6 py-4 pl-12 text-lg border-2 border-gray-300 rounded-2xl focus:ring-4 focus:ring-orange-200 focus:border-orange-500"
          >
          <svg class="w-6 h-6 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
      </div>

      <!-- Advanced Filters -->
      <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Advanced Filters</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg">
              <option>All Categories</option>
              <option>Services</option>
              <option>Customers</option>
              <option>Parts</option>
              <option>Vehicles</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg">
              <option>All Time</option>
              <option>Today</option>
              <option>This Week</option>
              <option>This Month</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg">
              <option>All Status</option>
              <option>Pending</option>
              <option>In Progress</option>
              <option>Completed</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
            <select class="w-full px-4 py-2 border border-gray-300 rounded-lg">
              <option>Relevance</option>
              <option>Date (Newest)</option>
              <option>Date (Oldest)</option>
              <option>Alphabetical</option>
            </select>
          </div>
        </div>
        <div class="mt-4 flex gap-3">
          <button class="px-6 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Apply Filters</button>
          <button class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300">Reset</button>
        </div>
      </div>

      <!-- Search Results -->
      <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-900">Search Results</h2>
        <p class="text-sm text-gray-500">Showing 24 results</p>
      </div>

      <!-- Results Tabs -->
      <div class="flex gap-4 mb-6 border-b border-gray-200">
        <button class="px-4 py-3 border-b-2 border-orange-500 text-orange-600 font-semibold">All Results (24)</button>
        <button class="px-4 py-3 text-gray-600 hover:text-gray-900">Services (12)</button>
        <button class="px-4 py-3 text-gray-600 hover:text-gray-900">Customers (5)</button>
        <button class="px-4 py-3 text-gray-600 hover:text-gray-900">Parts (7)</button>
      </div>

      <!-- Results Grid -->
      <div class="space-y-4">
        <!-- Service Result -->
        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Service</span>
                <h3 class="text-lg font-bold text-gray-900">Engine Repair - #SR-2026-001</h3>
              </div>
              <p class="text-gray-600 mb-3">Toyota Camry 2020 • Customer: Rajesh Kumar</p>
              <div class="flex items-center gap-4 text-sm text-gray-500">
                <span>Status: In Progress</span>
                <span>•</span>
                <span>Jan 18, 2026</span>
              </div>
            </div>
            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">View</button>
          </div>
        </div>

        <!-- Customer Result -->
        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Customer</span>
                <h3 class="text-lg font-bold text-gray-900">Rajesh Kumar</h3>
              </div>
              <p class="text-gray-600 mb-3">rajesh@example.com • +977 9841234567</p>
              <div class="flex items-center gap-4 text-sm text-gray-500">
                <span>Vehicles: 2</span>
                <span>•</span>
                <span>Total Services: 12</span>
              </div>
            </div>
            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">View Profile</button>
          </div>
        </div>

        <!-- Part Result -->
        <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Part</span>
                <h3 class="text-lg font-bold text-gray-900">Engine Oil Filter</h3>
              </div>
              <p class="text-gray-600 mb-3">SKU: EOF-001 • Category: Engine Parts</p>
              <div class="flex items-center gap-4 text-sm text-gray-500">
                <span>Stock: 45 units</span>
                <span>•</span>
                <span>Price: Rs. 450</span>
                <span>•</span>
                <span class="text-green-600 font-semibold">In Stock</span>
              </div>
            </div>
            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Details</button>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="mt-8 flex items-center justify-center gap-2">
        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Previous</button>
        <button class="px-4 py-2 bg-orange-500 text-white rounded-lg">1</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">2</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">3</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Next</button>
      </div>
    </div>
  </div>
@endsection
