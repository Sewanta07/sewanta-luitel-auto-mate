@extends('layouts.app')

@section('content')
@include('customer.navbar')
  <main class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">My Rentals</h1>
      <p class="text-gray-500 mt-1">Track vehicles you've rented from other users.</p>
    </div>

    @if(session('success'))
      <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center animate-fade-in">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        {{ session('success') }}
      </div>
    @endif

    @if(isset($requests) && $requests->count() > 0)
      <div class="space-y-4">
        @foreach($requests as $request)
          <div class="bg-white rounded-2xl border border-gray-100 p-6 flex items-center justify-between">
            <div>
              <h3 class="text-lg font-bold text-gray-900">
                {{ $request->vehicle?->vehicle_name ?: ($request->vehicle?->brand . ' ' . $request->vehicle?->model) }}
              </h3>
              <p class="text-sm text-gray-500 mt-1">{{ $request->vehicle?->plate_number }}</p>
              <p class="text-xs text-gray-400 mt-1">
                {{ $request->start_date ? 'From ' . $request->start_date : 'Start date: N/A' }} • {{ $request->end_date ? 'To ' . $request->end_date : 'End date: N/A' }}
              </p>
              <p class="text-xs text-gray-400 mt-1">Total: {{ $request->total_cost !== null ? 'Rs. ' . number_format($request->total_cost, 2) : 'N/A' }} • Payment: {{ $request->payment_status }}</p>
            </div>
            <div class="flex items-center gap-3">
              <span class="px-3 py-1 rounded-full text-xs font-bold
                @if($request->status === 'Approved') bg-green-100 text-green-700
                @elseif($request->status === 'Rejected') bg-red-100 text-red-700
                @elseif($request->status === 'Completed') bg-gray-200 text-gray-700
                @else bg-yellow-100 text-yellow-700 @endif">
                {{ $request->status }}
              </span>
              @if($request->status === 'Approved' && $request->payment_status !== 'Paid')
                <form action="{{ route('rentals.pay', $request->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold bg-orange-100 text-orange-700 hover:bg-orange-200">Pay Now</button>
                </form>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
        <h3 class="text-xl font-semibold text-gray-900">No rentals yet</h3>
        <p class="text-gray-500 mt-2">When you rent a vehicle, it will appear here.</p>
        <a href="{{ route('customer.rent-vehicles') }}" class="inline-flex items-center mt-6 px-6 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition">
          Browse Rent Vehicles
        </a>
      </div>
    @endif
  </main>
@endsection
