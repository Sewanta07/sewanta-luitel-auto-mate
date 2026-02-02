@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
  <aside class="w-64 flex-shrink-0 z-30">
    @include('components.admin-sidebar')
  </aside>

  <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50">
    <main class="max-w-7xl w-full mx-auto p-6">
      <div class="mb-3">
        <h1 class="text-3xl font-bold text-gray-900">Stock Management</h1>
        <p class="text-gray-500 mt-1">Manage inventory and spare parts</p>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-4 gap-4 mb-4">
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Total Items</p>
              <p class="text-2xl font-bold text-gray-900">256</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Low Stock</p>
              <p class="text-2xl font-bold text-red-600">15</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Total Value</p>
              <p class="text-2xl font-bold text-gray-900">Rs. 4.2M</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Monthly Usage</p>
              <p class="text-2xl font-bold text-orange-600">Rs. 850K</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Actions -->
      <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
        <div class="flex flex-wrap gap-4 items-center justify-between">
          <div class="flex gap-4 flex-1">
            <input type="search" placeholder="Search items..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
            <select class="px-4 py-2 border border-gray-300 rounded-lg">
              <option>All Categories</option>
              <option>Engine Parts</option>
              <option>Brake System</option>
            </select>
            <select class="px-4 py-2 border border-gray-300 rounded-lg">
              <option>All Stock Levels</option>
              <option>In Stock</option>
              <option>Low Stock</option>
              <option>Out of Stock</option>
            </select>
          </div>
          <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">+ Add New Item</button>
        </div>
      </div>

      <!-- Stock Table -->
      <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Part Name</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">SKU</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Category</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Current Stock</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Min Level</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Unit Price</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
              <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 font-medium">Engine Oil Filter</td>
              <td class="px-6 py-4 text-sm text-gray-500">EOF-001</td>
              <td class="px-6 py-4 text-sm">Engine Parts</td>
              <td class="px-6 py-4 text-sm font-semibold">45</td>
              <td class="px-6 py-4 text-sm text-gray-500">20</td>
              <td class="px-6 py-4 text-sm">Rs. 450</td>
              <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">In Stock</span></td>
              <td class="px-6 py-4 text-right">
                <button class="text-blue-600 hover:text-blue-900 font-semibold mr-3">Edit</button>
                <button class="text-orange-600 hover:text-orange-900 font-semibold">Restock</button>
              </td>
            </tr>
            <tr class="hover:bg-gray-50 bg-red-50">
              <td class="px-6 py-4 font-medium">Brake Pad Set</td>
              <td class="px-6 py-4 text-sm text-gray-500">BPS-002</td>
              <td class="px-6 py-4 text-sm">Brake System</td>
              <td class="px-6 py-4 text-sm font-semibold text-red-600">5</td>
              <td class="px-6 py-4 text-sm text-gray-500">15</td>
              <td class="px-6 py-4 text-sm">Rs. 2,800</td>
              <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Low Stock</span></td>
              <td class="px-6 py-4 text-right">
                <button class="text-blue-600 hover:text-blue-900 font-semibold mr-3">Edit</button>
                <button class="text-red-600 hover:text-red-900 font-semibold">Urgent Order</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Recent Activity -->
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Stock Activity</h2>
        <div class="space-y-3">
          <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center text-white mr-3">+</div>
              <div>
                <p class="font-medium">Stock Added</p>
                <p class="text-sm text-gray-600">Engine Oil Filter - 50 units</p>
              </div>
            </div>
            <span class="text-sm text-gray-500">2 hours ago</span>
          </div>
          <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
            <div class="flex items-center">
              <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center text-white mr-3">-</div>
              <div>
                <p class="font-medium">Stock Used</p>
                <p class="text-sm text-gray-600">Brake Pad Set - 10 units</p>
              </div>
            </div>
            <span class="text-sm text-gray-500">5 hours ago</span>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
@endsection
