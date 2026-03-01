@extends('layouts.customer-core')

@section('content')
@include('customer.navbar')

<div class="cs-page cs-bookings-show-page min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 pb-20">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="text-center mb-10">
      <h1 class="text-5xl font-black text-gray-900 mb-2">Booking Details</h1>
      <p class="text-gray-500 text-lg">Booking <span class="font-black text-gray-700">{{ $booking->booking_code }}</span></p>
      <div class="mt-6 flex justify-center">
          <span class="cs-booking-status inline-block px-6 py-2 rounded-full font-black text-sm tracking-wider shadow-lg
            @if($booking->status == 'Pending') bg-yellow-100 text-yellow-800 border-2 border-yellow-200
            @elseif($booking->status == 'Approved') bg-indigo-100 text-indigo-800 border-2 border-indigo-200
            @elseif($booking->status == 'Assigned') bg-blue-100 text-blue-800 border-2 border-blue-200
            @elseif($booking->status == 'Customer Accepted') bg-cyan-100 text-cyan-800 border-2 border-cyan-200
            @elseif($booking->status == 'In Progress') bg-purple-100 text-purple-800 border-2 border-purple-200
            @elseif($booking->status == 'Waiting for Parts') bg-orange-100 text-orange-800 border-2 border-orange-200
            @elseif($booking->status == 'Completed') bg-green-100 text-green-800 border-2 border-green-200
            @elseif($booking->status == 'Cancelled') bg-gray-100 text-gray-800 border-2 border-gray-200
            @elseif($booking->status == 'Rejected') bg-red-100 text-red-800 border-2 border-red-200
            @else bg-gray-100 text-gray-800 border-2 border-gray-200
            @endif">
            {{ $booking->status }}
          </span>
        </div>
      </div>

      <!-- Customer Acceptance Action -->
      @if($booking->status === 'Assigned')
        <div class="bg-blue-50 border-2 border-blue-200 rounded-2xl p-8 mb-8 text-center">
          <svg class="w-16 h-16 mx-auto text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <h3 class="text-2xl font-black text-gray-900 mb-3">Staff Assigned!</h3>
          <p class="text-gray-700 mb-2 font-semibold">Mechanic <span class="font-black text-blue-700">{{ $booking->staff->name }}</span> has been assigned to your service.</p>
          <p class="text-gray-600 mb-6">Please accept to authorize them to begin work on your vehicle.</p>
          <form action="{{ route('bookings.accept', $booking->id) }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-black rounded-lg shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-700 transform hover:-translate-y-1 transition-all uppercase text-sm tracking-widest">
              Accept & Start Service
            </button>
          </form>
        </div>
      @endif

      <!-- Booking Info Cards -->
      <div class="cs-booking-info-grid grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-orange-500">
          <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Service Type</p>
          <p class="text-lg font-black text-gray-900">{{ $booking->service_type }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-blue-500">
          <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Vehicle</p>
          <p class="text-lg font-black text-gray-900">{{ $booking->vehicle_model }}</p>
          <p class="text-sm font-bold text-gray-600">{{ $booking->vehicle_number }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-6 border-l-4 border-green-500">
          <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Scheduled Date</p>
          <p class="text-lg font-black text-gray-900">{{ $booking->preferred_date }}</p>
          <p class="text-sm font-bold text-gray-600">{{ $booking->preferred_time_slot }}</p>
        </div>
      </div>

      <!-- Service History Timeline -->
      <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-10">
        <h2 class="text-lg font-black text-gray-900 mb-10 flex items-center justify-center">
            <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Service Updates & Communication
        </h2>
        <div class="cs-timeline space-y-8">
            @forelse($booking->logs as $log)
                <div class="flex gap-6 relative pb-8">
                    @if(!$loop->last)
                        <div class="absolute left-[22px] top-16 bottom-0 w-0.5 bg-gradient-to-b from-gray-300 to-transparent"></div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="flex-shrink-0 w-12 h-12 rounded-full 
                      @if($log->status == 'Completed') bg-green-100 text-green-600 
                      @elseif($log->status == 'Customer Accepted') bg-cyan-100 text-cyan-600
                      @elseif($log->status == 'In Progress') bg-purple-100 text-purple-600
                      @else bg-orange-100 text-orange-600 
                      @endif 
                      shadow-md flex items-center justify-center font-black text-base z-10 ring-4 ring-white">
                        @if($log->status == 'Completed')
                          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                        @else
                          {{ substr($log->status, 0, 1) }}
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0 pt-1">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-2">
                            <span class="text-base font-black text-gray-900">{{ $log->status }}</span>
                            <span class="text-xs font-bold text-gray-400">{{ $log->created_at->format('M d, Y') }} • <span class="text-gray-600">{{ $log->created_at->format('H:i') }}</span></span>
                        </div>
                        
                        @if($log->notes)
                          <div class="bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-lg p-4 mb-4">
                            <p class="text-sm text-gray-700 leading-relaxed">{{ $log->notes }}</p>
                          </div>
                        @endif

                        <!-- Attachment -->
                        @if($log->attachment_path)
                          <div class="mb-4">
                            <a href="{{ asset('storage/' . $log->attachment_path) }}" target="_blank" class="inline-flex items-center gap-3 px-5 py-2 bg-orange-50 border-2 border-orange-200 rounded-lg hover:bg-orange-100 hover:border-orange-300 transition-all shadow-sm hover:shadow-md">
                              <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                              <span class="text-xs font-black text-orange-700">View Attachment</span>
                              <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                          </div>
                        @endif

                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">
                          By <span class="text-gray-700">{{ $log->user->name ?? 'System' }}</span>
                          @if($log->user_type === 'App\Models\StaffMember')
                            <span class="ml-2 px-2 py-0.5 bg-blue-100 text-blue-700 rounded text-xs font-black">STAFF</span>
                          @elseif($log->user_type === 'App\Models\Admin')
                            <span class="ml-2 px-2 py-0.5 bg-purple-100 text-purple-700 rounded text-xs font-black">ADMIN</span>
                          @else
                            <span class="ml-2 px-2 py-0.5 bg-green-100 text-green-700 rounded text-xs font-black">CUSTOMER</span>
                          @endif
                        </p>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-gray-400 font-bold text-lg">No updates yet</p>
                </div>
            @endforelse
        </div>
      </div>

      <!-- Parts Used -->
      <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8 mt-8">
        <h2 class="text-lg font-black text-gray-900 mb-6 flex items-center">
          <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
          Parts Used
        </h2>
        <div class="border border-gray-100 rounded-xl overflow-hidden">
          <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500 font-semibold border-b border-gray-100">
              <tr>
                <th class="px-4 py-3">Part</th>
                <th class="px-4 py-3 text-center">Qty</th>
                <th class="px-4 py-3 text-right">Unit Price</th>
                <th class="px-4 py-3 text-right">Total</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
              @forelse($booking->parts as $part)
                <tr>
                  <td class="px-4 py-3 text-gray-900">{{ $part->part_name }}</td>
                  <td class="px-4 py-3 text-center text-gray-500">{{ $part->pivot->quantity }}</td>
                  <td class="px-4 py-3 text-right text-gray-500">Rs. {{ number_format($part->pivot->unit_price, 2) }}</td>
                  <td class="px-4 py-3 text-right text-gray-900 font-medium">Rs. {{ number_format($part->pivot->total_cost, 2) }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="px-4 py-6 text-center text-gray-500">No parts recorded for this service.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Back Button -->
      <div class="text-center mt-8">
        <a href="{{ route('bookings.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-lg hover:bg-gray-200 transition-colors">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
          Back to My Bookings
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
