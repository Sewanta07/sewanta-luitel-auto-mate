@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
  @include('components.staff-navbar')
  
  <main class="flex-1 overflow-y-auto p-6">
    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Assigned Service Details</h1>
        <p class="text-gray-500 mt-1">Service Request #SR-2026-001</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Customer & Vehicle Info -->
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Customer Information</h2>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <p class="text-sm text-gray-500">Customer Name</p>
                <p class="font-semibold text-gray-900">Rajesh Kumar</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Contact</p>
                <p class="font-semibold text-gray-900">+977 9841234567</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-semibold text-gray-900">rajesh@example.com</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Address</p>
                <p class="font-semibold text-gray-900">Kathmandu, Nepal</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Vehicle Information</h2>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <p class="text-sm text-gray-500">Make & Model</p>
                <p class="font-semibold text-gray-900">Toyota Camry 2020</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">License Plate</p>
                <p class="font-semibold text-gray-900">BA-01-PA-1234</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">VIN</p>
                <p class="font-semibold text-gray-900">1HGCM82633A123456</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Mileage</p>
                <p class="font-semibold text-gray-900">45,230 km</p>
              </div>
            </div>
          </div>

          <!-- Service Details -->
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Service Details</h2>
            <div class="space-y-4">
              <div>
                <p class="text-sm text-gray-500">Service Type</p>
                <p class="font-semibold text-gray-900">Engine Repair</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Customer Request</p>
                <p class="text-gray-900">Engine making unusual noise, needs inspection and possible repair. Oil change also requested.</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Scheduled Date</p>
                <p class="font-semibold text-gray-900">Jan 18, 2026, 10:00 AM</p>
              </div>
            </div>
          </div>

          <!-- Add Notes -->
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Service Notes</h2>
            <textarea rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500" placeholder="Add your notes here..."></textarea>
            <div class="mt-4">
              <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Add Note</button>
            </div>
            
            <!-- Previous Notes -->
            <div class="mt-6 space-y-3">
              <div class="border-l-4 border-blue-500 pl-4 py-2 bg-blue-50">
                <p class="text-sm text-gray-500">Jan 18, 2026 10:30 AM</p>
                <p class="text-gray-900 mt-1">Initial inspection completed. Found worn-out engine mount.</p>
              </div>
            </div>
          </div>

          <!-- Upload Images -->
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Upload Images</h2>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
              <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
              <p class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</p>
              <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
          <!-- Update Status -->
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4">Update Status</h3>
            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg mb-4">
              <option>Pending</option>
              <option>In Progress</option>
              <option>Inspection Done</option>
              <option>Repair Done</option>
              <option>Quality Check</option>
              <option>Ready for Pickup</option>
              <option>Completed</option>
            </select>
            <button class="w-full px-4 py-3 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Update Status</button>
          </div>

          <!-- Parts Used -->
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4">Parts Used</h3>
            <div class="space-y-3 mb-4">
              <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                <div>
                  <p class="font-medium text-gray-900">Engine Mount</p>
                  <p class="text-xs text-gray-500">Qty: 1</p>
                </div>
                <button class="text-red-500 text-sm">Remove</button>
              </div>
            </div>
            <button class="w-full px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50">+ Add Part</button>
          </div>

          <!-- Time Tracking -->
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4">Time Tracking</h3>
            <div class="space-y-2 text-sm">
              <div class="flex justify-between">
                <span class="text-gray-600">Started</span>
                <span class="font-medium">10:15 AM</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600">Duration</span>
                <span class="font-medium">2h 15m</span>
              </div>
            </div>
            <button class="w-full mt-4 px-4 py-2 bg-green-500 text-white rounded-lg font-semibold">Mark Complete</button>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection
