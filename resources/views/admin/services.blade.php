@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
  <aside class="w-64 flex-shrink-0 z-30">
    @include('components.admin-sidebar')
  </aside>

  <div class="flex-1 flex flex-col overflow-y-auto sm:ml-64 bg-gray-50">
    <main class="max-w-7xl w-full mx-auto p-6">
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Service Management</h1>
        <p class="text-gray-500 mt-1">View and manage all service requests</p>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <p class="text-sm text-gray-500">Total Requests</p>
          <p class="text-2xl font-bold text-gray-900 mt-1">145</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <p class="text-sm text-gray-500">Pending</p>
          <p class="text-2xl font-bold text-yellow-600 mt-1">12</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <p class="text-sm text-gray-500">In Progress</p>
          <p class="text-2xl font-bold text-blue-600 mt-1">28</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <p class="text-sm text-gray-500">Completed</p>
          <p class="text-2xl font-bold text-green-600 mt-1">105</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <p class="text-sm text-gray-500">Unassigned</p>
          <p class="text-2xl font-bold text-red-600 mt-1">5</p>
        </div>
      </div>

      <!-- Filters -->
      <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
        <div class="flex flex-wrap gap-4">
          <input type="search" placeholder="Search services..." class="flex-1 min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg">
          <select class="px-4 py-2 border border-gray-300 rounded-lg">
            <option>All Status</option>
            <option>Pending</option>
            <option>In Progress</option>
            <option>Completed</option>
          </select>
          <select class="px-4 py-2 border border-gray-300 rounded-lg">
            <option>All Staff</option>
            <option>John Doe</option>
            <option>Jane Smith</option>
          </select>
        </div>
      </div>

      <!-- Services Table -->
      <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Request ID</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Customer</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Service Type</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Vehicle</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Assigned To</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
              <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm font-medium">#SR-2026-001</td>
              <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">Rajesh Kumar</div>
                <div class="text-xs text-gray-500">+977 9841234567</div>
              </td>
              <td class="px-6 py-4 text-sm">Engine Repair</td>
              <td class="px-6 py-4">
                <div class="text-sm text-gray-900">Toyota Camry</div>
                <div class="text-xs text-gray-500">BA-01-PA-1234</div>
              </td>
              <td class="px-6 py-4 text-sm">John Doe</td>
              <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">In Progress</span></td>
              <td class="px-6 py-4 text-right">
                <button class="text-orange-600 hover:text-orange-900 font-semibold mr-3">View</button>
                <button class="text-blue-600 hover:text-blue-900 font-semibold">Reassign</button>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm font-medium">#SR-2026-002</td>
              <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">Sita Sharma</div>
                <div class="text-xs text-gray-500">+977 9851234567</div>
              </td>
              <td class="px-6 py-4 text-sm">Oil Change</td>
              <td class="px-6 py-4">
                <div class="text-sm text-gray-900">Honda City</div>
                <div class="text-xs text-gray-500">BA-02-PA-5678</div>
              </td>
              <td class="px-6 py-4 text-sm text-red-600 font-semibold">Unassigned</td>
              <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span></td>
              <td class="px-6 py-4 text-right">
                <button class="text-orange-600 hover:text-orange-900 font-semibold mr-3">View</button>
                <button class="text-green-600 hover:text-green-900 font-semibold">Assign</button>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm font-medium">#SR-2026-003</td>
              <td class="px-6 py-4">
                <div class="text-sm font-medium text-gray-900">Ram Prasad</div>
                <div class="text-xs text-gray-500">+977 9861234567</div>
              </td>
              <td class="px-6 py-4 text-sm">Brake Service</td>
              <td class="px-6 py-4">
                <div class="text-sm text-gray-900">Hyundai Creta</div>
                <div class="text-xs text-gray-500">BA-03-PA-9012</div>
              </td>
              <td class="px-6 py-4 text-sm">Jane Smith</td>
              <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span></td>
              <td class="px-6 py-4 text-right">
                <button class="text-orange-600 hover:text-orange-900 font-semibold">View</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
@endsection
