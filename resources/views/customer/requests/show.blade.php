@extends('layouts.app')

@section('content')
@include('customer.navbar')
  <main class="max-w-7xl mx-auto p-6">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li><a href="{{ route('dashboard.customer') }}" class="text-gray-500 hover:text-gray-700">Dashboard</a></li>
        <li><span class="text-gray-400 mx-2">/</span></li>
        <li><a href="{{ route('customer.requests.index') }}" class="text-gray-500 hover:text-gray-700">My Requests</a></li>
        <li><span class="text-gray-400 mx-2">/</span></li>
        <li class="text-gray-900 font-medium">Service Details</li>
      </ol>
    </nav>

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Service Request Details</h1>
        <p class="text-gray-500 mt-1">Request ID: #SR-2026-001</p>
      </div>
      <span class="px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">In Progress</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Main Content -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Service Information -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Service Information</h2>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <p class="text-sm text-gray-500">Service Type</p>
              <p class="font-semibold text-gray-900">Engine Repair</p>
            </div>
            <div>
              <p class="text-sm text-gray-500">Requested Date</p>
              <p class="font-semibold text-gray-900">Jan 15, 2026</p>
            </div>
            <div>
              <p class="text-sm text-gray-500">Scheduled Date</p>
              <p class="font-semibold text-gray-900">Jan 18, 2026, 10:00 AM</p>
            </div>
            <div>
              <p class="text-sm text-gray-500">Pick-up Option</p>
              <p class="font-semibold text-gray-900">Drop-off</p>
            </div>
          </div>
          <div class="mt-4">
            <p class="text-sm text-gray-500">Description</p>
            <p class="text-gray-900 mt-1">Engine making unusual noise, needs inspection and possible repair. Oil change also requested.</p>
          </div>
        </div>

        <!-- Vehicle Information -->
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

        <!-- Service Progress -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Service Progress</h2>
          <div class="space-y-4">
            <!-- Progress Step -->
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                  <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                  </svg>
                </div>
              </div>
              <div class="ml-4 flex-1">
                <h3 class="font-semibold text-gray-900">Request Received</h3>
                <p class="text-sm text-gray-500">Jan 15, 2026 at 2:30 PM</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                  <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                  </svg>
                </div>
              </div>
              <div class="ml-4 flex-1">
                <h3 class="font-semibold text-gray-900">Assigned to Mechanic</h3>
                <p class="text-sm text-gray-500">Jan 16, 2026 at 9:00 AM</p>
                <p class="text-sm text-gray-600 mt-1">Mechanic: John Doe</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full bg-yellow-500 flex items-center justify-center animate-pulse">
                  <div class="w-3 h-3 rounded-full bg-white"></div>
                </div>
              </div>
              <div class="ml-4 flex-1">
                <h3 class="font-semibold text-gray-900">In Progress</h3>
                <p class="text-sm text-gray-500">Started Jan 18, 2026 at 10:15 AM</p>
                <p class="text-sm text-gray-600 mt-1">Currently inspecting engine components</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                  <div class="w-3 h-3 rounded-full bg-white"></div>
                </div>
              </div>
              <div class="ml-4 flex-1">
                <h3 class="font-semibold text-gray-400">Quality Check</h3>
                <p class="text-sm text-gray-400">Pending</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                  <div class="w-3 h-3 rounded-full bg-white"></div>
                </div>
              </div>
              <div class="ml-4 flex-1">
                <h3 class="font-semibold text-gray-400">Ready for Pickup</h3>
                <p class="text-sm text-gray-400">Pending</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Mechanic Notes -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h2 class="text-xl font-bold text-gray-900 mb-4">Mechanic Notes</h2>
          <div class="space-y-3">
            <div class="border-l-4 border-blue-500 pl-4 py-2">
              <p class="text-sm text-gray-500">Jan 18, 2026 10:30 AM</p>
              <p class="text-gray-900 mt-1">Initial inspection completed. Found worn-out engine mount. Will require replacement.</p>
            </div>
            <div class="border-l-4 border-blue-500 pl-4 py-2">
              <p class="text-sm text-gray-500">Jan 18, 2026 11:00 AM</p>
              <p class="text-gray-900 mt-1">Ordered new engine mount. Expected delivery in 2 hours.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="space-y-6">
        <!-- Actions -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h3 class="font-bold text-gray-900 mb-4">Actions</h3>
          <div class="space-y-3">
            <a href="#" class="block w-full px-4 py-3 bg-orange-500 text-white text-center rounded-lg hover:bg-orange-600 transition font-semibold">
              Contact Support
            </a>
            <button class="block w-full px-4 py-3 bg-gray-100 text-gray-700 text-center rounded-lg hover:bg-gray-200 transition font-semibold">
              Reschedule
            </button>
            <button class="block w-full px-4 py-3 bg-red-50 text-red-600 text-center rounded-lg hover:bg-red-100 transition font-semibold">
              Cancel Request
            </button>
          </div>
        </div>

        <!-- Estimated Cost -->
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl shadow-sm p-6">
          <h3 class="font-bold text-gray-900 mb-4">Estimated Cost</h3>
          <div class="space-y-2">
            <div class="flex justify-between">
              <span class="text-gray-600">Labor</span>
              <span class="font-semibold">रू 3,500</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Parts</span>
              <span class="font-semibold">रू 5,200</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600">Service Fee</span>
              <span class="font-semibold">रू 800</span>
            </div>
            <hr class="my-2">
            <div class="flex justify-between text-lg">
              <span class="font-bold text-gray-900">Total</span>
              <span class="font-bold text-orange-600">रू 9,500</span>
            </div>
          </div>
          <p class="text-xs text-gray-500 mt-3">*Final cost may vary based on actual work done</p>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h3 class="font-bold text-gray-900 mb-4">Assigned Mechanic</h3>
          <div class="flex items-center space-x-3 mb-4">
            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold">JD</div>
            <div>
              <p class="font-semibold text-gray-900">John Doe</p>
              <p class="text-sm text-gray-500">Senior Mechanic</p>
            </div>
          </div>
          <div class="space-y-2 text-sm">
            <div class="flex items-center text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
              john.doe@automate.com
            </div>
            <div class="flex items-center text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
              +977 9841234567
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection
