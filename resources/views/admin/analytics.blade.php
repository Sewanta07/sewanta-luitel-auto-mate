@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
  <aside class="w-64 flex-shrink-0 z-30">
    @include('components.admin-sidebar')
  </aside>

  <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50">
    <main class="max-w-7xl w-full mx-auto p-6">
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Reports & Analytics</h1>
        <p class="text-gray-500 mt-1">Comprehensive business insights and reports</p>
      </div>

      <!-- Time Period Selector -->
      <div class="flex gap-4 mb-6">
        <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold">This Month</button>
        <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100">Last 3 Months</button>
        <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100">This Year</button>
        <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100">Custom Range</button>
      </div>

      <!-- Key Metrics -->
      <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Total Revenue</p>
              <p class="text-2xl font-bold text-gray-900">Rs. 2.4M</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Services Completed</p>
              <p class="text-2xl font-bold text-gray-900">145</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Customer Satisfaction</p>
              <p class="text-2xl font-bold text-gray-900">4.8★</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Active Customers</p>
              <p class="text-2xl font-bold text-gray-900">342</p>
            </div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Revenue Chart -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Revenue Trend</h2>
          <div class="h-64 flex items-end space-x-2">
            <div class="flex-1 bg-blue-200 rounded-t" style="height: 40%"></div>
            <div class="flex-1 bg-blue-300 rounded-t" style="height: 55%"></div>
            <div class="flex-1 bg-blue-400 rounded-t" style="height: 70%"></div>
            <div class="flex-1 bg-blue-500 rounded-t" style="height: 85%"></div>
            <div class="flex-1 bg-blue-600 rounded-t" style="height: 100%"></div>
          </div>
          <div class="flex justify-between mt-2 text-xs text-gray-500">
            <span>Week 1</span>
            <span>Week 2</span>
            <span>Week 3</span>
            <span>Week 4</span>
            <span>Week 5</span>
          </div>
        </div>

        <!-- Service Distribution -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Service Distribution</h2>
          <div class="space-y-4">
            <div>
              <div class="flex justify-between mb-1">
                <span class="text-sm text-gray-600">Engine Repair</span>
                <span class="text-sm font-semibold">35%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-500 h-2 rounded-full" style="width: 35%"></div>
              </div>
            </div>
            <div>
              <div class="flex justify-between mb-1">
                <span class="text-sm text-gray-600">Brake Service</span>
                <span class="text-sm font-semibold">25%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 25%"></div>
              </div>
            </div>
            <div>
              <div class="flex justify-between mb-1">
                <span class="text-sm text-gray-600">Oil Change</span>
                <span class="text-sm font-semibold">20%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-orange-500 h-2 rounded-full" style="width: 20%"></div>
              </div>
            </div>
            <div>
              <div class="flex justify-between mb-1">
                <span class="text-sm text-gray-600">General Inspection</span>
                <span class="text-sm font-semibold">20%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-purple-500 h-2 rounded-full" style="width: 20%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Reports Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Customer Activity -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Top Customers</h2>
          <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold mr-3">RK</div>
                <div>
                  <p class="font-medium">Rajesh Kumar</p>
                  <p class="text-xs text-gray-500">12 services</p>
                </div>
              </div>
              <span class="font-bold text-gray-900">Rs. 85,500</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold mr-3">SS</div>
                <div>
                  <p class="font-medium">Sita Sharma</p>
                  <p class="text-xs text-gray-500">8 services</p>
                </div>
              </div>
              <span class="font-bold text-gray-900">Rs. 62,000</span>
            </div>
          </div>
        </div>

        <!-- Inventory Usage -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Top Used Parts</h2>
          <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <div>
                <p class="font-medium">Engine Oil Filter</p>
                <p class="text-xs text-gray-500">145 units used</p>
              </div>
              <span class="font-bold text-orange-600">Rs. 65,250</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <div>
                <p class="font-medium">Brake Pad Set</p>
                <p class="text-xs text-gray-500">82 units used</p>
              </div>
              <span class="font-bold text-orange-600">Rs. 229,600</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Export Section -->
      <div class="mt-6 bg-white rounded-2xl shadow-sm p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Export Reports</h2>
        <div class="flex flex-wrap gap-4">
          <button class="px-4 py-2 bg-green-500 text-white rounded-lg font-semibold hover:bg-green-600">Export as Excel</button>
          <button class="px-4 py-2 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600">Export as PDF</button>
          <button class="px-4 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600">Email Report</button>
        </div>
      </div>
    </main>
  </div>
</div>
@endsection
