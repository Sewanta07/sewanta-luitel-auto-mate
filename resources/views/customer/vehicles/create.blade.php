@extends('layouts.app')

@section('title', 'Add Vehicle - AutoMate')

@section('content')
@include('components.customer-navbar')

<div class="min-h-screen bg-gray-50">
  <main class="max-w-3xl mx-auto p-6">
    <div class="bg-white rounded-2xl shadow-sm p-6">
      <h1 class="text-xl font-semibold text-gray-900 mb-2">Add Vehicle</h1>
      <p class="text-sm text-gray-500 mb-6">Provide details for your vehicle.</p>

      <form class="space-y-4">
        <div>
          <label class="text-sm text-gray-700">Make & Model</label>
          <input class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm" placeholder="e.g., Toyota Corolla" />
        </div>

        <div>
          <label class="text-sm text-gray-700">Year</label>
          <input type="number" class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm" />
        </div>

        <div>
          <label class="text-sm text-gray-700">License Plate</label>
          <input class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm" />
        </div>

        <div class="flex items-center justify-end space-x-3 mt-6">
          <a href="#" class="px-4 py-2 rounded-lg border border-gray-200 text-gray-700">Cancel</a>
          <button class="px-4 py-2 rounded-lg bg-[#2563eb] text-white shadow hover:bg-[#1d4ed8]">Add Vehicle</button>
        </div>
      </form>
    </div>
  </main>
</div>

@endsection
