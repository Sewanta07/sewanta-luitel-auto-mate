@extends('layouts.app')

@section('content')
@include('customer.navbar')
  <main class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Car Rental</h1>
      <p class="text-gray-500 mt-1">Rent a vehicle while yours is being serviced</p>
    </div>

    <!-- Active Rentals -->
    <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-2xl p-6 mb-6">
      <h2 class="text-xl font-bold text-gray-900 mb-4">Your Active Rentals</h2>
      <div class="bg-white rounded-xl p-4">
        <div class="flex justify-between items-center">
          <div class="flex items-center space-x-4">
            <div class="w-16 h-16 bg-gray-200 rounded-lg"></div>
            <div>
              <h3 class="font-bold text-gray-900">Honda Civic 2022</h3>
              <p class="text-sm text-gray-500">Rental ends in 2 days</p>
            </div>
          </div>
          <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold">Extend Rental</button>
        </div>
      </div>
    </div>

    <!-- Filters -->
    <div class="flex gap-4 mb-6 overflow-x-auto">
      <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold whitespace-nowrap">All Vehicles</button>
      <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100 whitespace-nowrap">Sedan</button>
      <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100 whitespace-nowrap">SUV</button>
      <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100 whitespace-nowrap">Hatchback</button>
    </div>

    <!-- Available Vehicles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Vehicle Card 1 -->
      <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">
        <div class="h-48 bg-gray-200"></div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-gray-900">Toyota Corolla 2023</h3>
          <p class="text-sm text-gray-500 mt-1">Sedan • Automatic</p>
          <div class="mt-4 space-y-2">
            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
              5 Seats
            </div>
            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              Fuel: Petrol
            </div>
          </div>
          <div class="mt-6 flex items-end justify-between">
            <div>
              <p class="text-sm text-gray-500">Per Day</p>
              <p class="text-2xl font-bold text-orange-600">रू 2,500</p>
            </div>
            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Vehicle Card 2 -->
      <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">
        <div class="h-48 bg-gray-200"></div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-gray-900">Honda City 2022</h3>
          <p class="text-sm text-gray-500 mt-1">Sedan • Manual</p>
          <div class="mt-4 space-y-2">
            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
              5 Seats
            </div>
            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              Fuel: Petrol
            </div>
          </div>
          <div class="mt-6 flex items-end justify-between">
            <div>
              <p class="text-sm text-gray-500">Per Day</p>
              <p class="text-2xl font-bold text-orange-600">रू 2,200</p>
            </div>
            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Book Now</button>
          </div>
        </div>
      </div>

      <!-- Vehicle Card 3 -->
      <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">
        <div class="h-48 bg-gray-200"></div>
        <div class="p-6">
          <h3 class="text-xl font-bold text-gray-900">Hyundai Creta 2023</h3>
          <p class="text-sm text-gray-500 mt-1">SUV • Automatic</p>
          <div class="mt-4 space-y-2">
            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
              7 Seats
            </div>
            <div class="flex items-center text-sm text-gray-600">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              Fuel: Diesel
            </div>
          </div>
          <div class="mt-6 flex items-end justify-between">
            <div>
              <p class="text-sm text-gray-500">Per Day</p>
              <p class="text-2xl font-bold text-orange-600">रू 4,500</p>
            </div>
            <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">Book Now</button>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection
