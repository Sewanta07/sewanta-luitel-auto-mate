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
      <div class="grid grid-cols-4 gap-3 mb-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-sm p-4 text-white">
          <p class="text-xs opacity-90">Total Revenue</p>
          <p class="text-2xl font-bold mt-1">रू 2.4M</p>
          <p class="text-[10px] mt-1 opacity-75">+12.5% from last month</p>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-sm p-4 text-white">
          <p class="text-xs opacity-90">Services Completed</p>
          <p class="text-2xl font-bold mt-1">145</p>
          <p class="text-[10px] mt-1 opacity-75">+8% from last month</p>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl shadow-sm p-4 text-white">
          <p class="text-xs opacity-90">Customer Satisfaction</p>
          <p class="text-2xl font-bold mt-1">4.8★</p>
          <p class="text-[10px] mt-1 opacity-75">Based on 120 reviews</p>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-sm p-4 text-white">
          <p class="text-xs opacity-90">Active Customers</p>
          <p class="text-2xl font-bold mt-1">342</p>
          <p class="text-[10px] mt-1 opacity-75">+15 new this month</p>
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
              <span class="font-bold text-gray-900">रू 85,500</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <div class="flex items-center">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold mr-3">SS</div>
                <div>
                  <p class="font-medium">Sita Sharma</p>
                  <p class="text-xs text-gray-500">8 services</p>
                </div>
              </div>
              <span class="font-bold text-gray-900">रू 62,000</span>
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
              <span class="font-bold text-orange-600">रू 65,250</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
              <div>
                <p class="font-medium">Brake Pad Set</p>
                <p class="text-xs text-gray-500">82 units used</p>
              </div>
              <span class="font-bold text-orange-600">रू 229,600</span>
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
