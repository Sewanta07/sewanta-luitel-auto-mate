@extends('layouts.app')

@section('content')
@include('components.staff-navbar')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 pb-12">
  <main class="max-w-6xl mx-auto p-4 sm:p-6 lg:p-8">
    <!-- Centered Header -->
    <div class="text-center mb-12 mt-4">
      <h1 class="text-5xl font-black text-gray-900 mb-2">Service Details</h1>
      <p class="text-gray-500 text-lg">Booking <span class="font-black text-gray-700">{{ $booking->booking_code }}</span></p>
      <div class="mt-6 flex justify-center">
          <span class="inline-block px-6 py-2 rounded-full font-black text-sm tracking-wider shadow-lg
            @if($booking->status == 'Pending') bg-yellow-100 text-yellow-800 border-2 border-yellow-200
            @elseif($booking->status == 'Assigned') bg-blue-100 text-blue-800 border-2 border-blue-200
            @elseif($booking->status == 'Customer Accepted') bg-cyan-100 text-cyan-800 border-2 border-cyan-200
            @elseif($booking->status == 'In Progress') bg-purple-100 text-purple-800 border-2 border-purple-200
            @elseif($booking->status == 'Waiting for Parts') bg-orange-100 text-orange-800 border-2 border-orange-200
            @elseif($booking->status == 'Completed') bg-green-100 text-green-800 border-2 border-green-200
            @else bg-gray-100 text-gray-800 border-2 border-gray-200
            @endif">
            {{ $booking->status }}
          </span>
        </div>
      </div>

      <!-- Quick Info Cards - Centered -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-12">
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-orange-500">
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Service Type</p>
          <p class="text-lg font-black text-gray-900">{{ $booking->service_type }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-blue-500">
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Priority</p>
          <p class="text-lg font-black text-gray-900">{{ $booking->service_priority ?? 'Standard' }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-green-500">
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Estimated Cost</p>
          <p class="text-lg font-black text-gray-900">Rs. {{ $booking->estimated_cost ?? 'TBD' }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-purple-500">
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Booked Date</p>
          <p class="text-lg font-black text-gray-900">{{ $booking->preferred_date }}</p>
        </div>
      </div>

      <!-- Main Content in Single Column -->
      <div class="space-y-8">
        <!-- Customer & Vehicle Info - Full Width -->
        <!-- Customer & Vehicle Cards - Better Alignment -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <!-- Customer Details Card -->
          <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-orange-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center mb-6 pb-4 border-b-2 border-gray-100">
              <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              </div>
              <h2 class="text-lg font-black text-gray-900 uppercase tracking-wide">Customer Details</h2>
            </div>
            <div class="space-y-4">
              <div class="flex justify-between items-start">
                <div class="flex-1">
                  <p class="text-[10px] text-gray-400 font-black uppercase tracking-wider mb-1">Full Name</p>
                  <p class="font-bold text-gray-900 text-base">{{ $booking->customer->name ?? 'Unknown' }}</p>
                </div>
              </div>
              <div class="flex justify-between items-start pt-3 border-t border-gray-100">
                <div class="flex-1">
                  <p class="text-[10px] text-gray-400 font-black uppercase tracking-wider mb-1">Contact Number</p>
                  <p class="font-bold text-gray-900 text-base">{{ $booking->phone_number ?? ($booking->customer->phone ?? 'N/A') }}</p>
                </div>
              </div>
              <div class="flex justify-between items-start pt-3 border-t border-gray-100">
                <div class="flex-1">
                  <p class="text-[10px] text-gray-400 font-black uppercase tracking-wider mb-1">Email Address</p>
                  <p class="font-bold text-gray-900 text-sm break-all">{{ $booking->customer->email ?? 'N/A' }}</p>
                </div>
              </div>
              <div class="flex justify-between items-start pt-3 border-t border-gray-100">
                <div class="flex-1">
                  <p class="text-[10px] text-gray-400 font-black uppercase tracking-wider mb-1">Service Location</p>
                  <p class="font-bold text-gray-900 text-base">{{ $booking->location }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Vehicle Details Card -->
          <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex items-center mb-6 pb-4 border-b-2 border-gray-100">
              <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              </div>
              <h2 class="text-lg font-black text-gray-900 uppercase tracking-wide">Vehicle Details</h2>
            </div>
            <div class="space-y-4">
              <div class="flex justify-between items-start">
                <div class="flex-1">
                  <p class="text-[10px] text-gray-400 font-black uppercase tracking-wider mb-1">Make & Model</p>
                  <p class="font-bold text-gray-900 text-base">{{ $booking->vehicle_model }}</p>
                </div>
              </div>
              <div class="flex justify-between items-start pt-3 border-t border-gray-100">
                <div class="flex-1">
                  <p class="text-[10px] text-gray-400 font-black uppercase tracking-wider mb-2">Registration Number</p>
                  <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-2 border-blue-300 rounded-lg p-3 text-center">
                    <p class="font-black text-gray-900 text-xl tracking-wider">{{ $booking->vehicle_number }}</p>
                  </div>
                </div>
              </div>
              <div class="flex justify-between items-start pt-3 border-t border-gray-100">
                <div class="flex-1">
                  <p class="text-[10px] text-gray-400 font-black uppercase tracking-wider mb-1">Vehicle Type</p>
                  <p class="font-bold text-gray-900 text-base">{{ $booking->vehicle_type }}</p>
                </div>
              </div>
              <div class="flex justify-between items-start pt-3 border-t border-gray-100">
                <div class="flex-1">
                  <p class="text-[10px] text-gray-400 font-black uppercase tracking-wider mb-1">Year of Manufacture</p>
                  <p class="font-bold text-gray-900 text-base">{{ $booking->vehicle_year ?? 'N/A' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Status Update Form - Professional Layout -->
        <div class="bg-white rounded-xl shadow-md border-l-4 border-orange-500 p-8 hover:shadow-lg transition-shadow">
          <div class="flex items-center mb-8 pb-4 border-b-2 border-gray-100">
            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mr-4">
              <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h3 class="text-lg font-black text-gray-900 uppercase tracking-wide">Update Service Progress</h3>
          </div>
          <form action="{{ route('staff.bookings.status', $booking->id) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
              @csrf
              
              <!-- Status Selector -->
              <div>
                  <label class="block text-xs font-black text-gray-500 uppercase tracking-wider mb-2">Select Status</label>
                  <select name="status" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-lg text-sm font-bold focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all outline-none cursor-pointer hover:border-orange-400">
                    @if($booking->status === 'Assigned')
                      <option value="Assigned" selected disabled>Assigned (Waiting for Customer)</option>
                    @else
                      <option value="Customer Accepted" {{ $booking->status == 'Customer Accepted' ? 'selected' : '' }}>Customer Accepted</option>
                      <option value="In Progress" {{ $booking->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                      <option value="Waiting for Parts" {{ $booking->status == 'Waiting for Parts' ? 'selected' : '' }}>Waiting for Parts</option>
                      <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    @endif
                  </select>
                  @if($booking->status === 'Assigned')
                    <p class="text-xs text-orange-600 mt-2 font-bold flex items-center">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                      Waiting for customer to accept your assignment
                    </p>
                  @endif
              </div>

              <!-- Notes Input -->
              <div>
                  <label class="block text-xs font-black text-gray-500 uppercase tracking-wider mb-2">Work Notes</label>
                  <textarea name="notes" rows="5" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-300 rounded-lg text-sm font-medium focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all outline-none resize-none hover:border-gray-400" placeholder="Describe what you've completed..."></textarea>
              </div>

              <!-- File Upload -->
              <div>
                <label class="block text-xs font-black text-gray-500 uppercase tracking-wider mb-2">Attach Evidence</label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-4 hover:border-orange-400 transition-colors bg-gray-50">
                  <input type="file" name="attachment" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-sm font-medium file:mr-4 file:px-4 file:py-2 file:bg-orange-500 file:text-white file:font-bold file:text-xs file:border-0 file:rounded-lg file:cursor-pointer hover:file:bg-orange-600 file:transition-colors cursor-pointer">
                  <p class="text-xs text-gray-500 mt-2 font-bold">JPG, PNG, or PDF • Max 5MB</p>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-black rounded-lg shadow-lg hover:shadow-xl hover:from-orange-600 hover:to-orange-700 transform hover:-translate-y-0.5 transition-all uppercase text-sm tracking-wider flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                Post Update
              </button>
          </form>
        </div>

        <!-- Service History Timeline - Full Width -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-10 hover:shadow-lg transition-shadow">
          <h2 class="text-lg font-black text-gray-900 mb-10 flex items-center justify-center">
              <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
              Service History & Updates
          </h2>
          <div class="space-y-8">
              @forelse($booking->logs()->with('user')->latest()->get() as $log)
                  <div class="flex gap-6 relative pb-8">
                      @if(!$loop->last)
                          <div class="absolute left-[22px] top-16 bottom-0 w-0.5 bg-gradient-to-b from-gray-300 to-transparent"></div>
                      @endif
                      
                      <!-- Status Badge -->
                      <div class="flex-shrink-0 w-12 h-12 rounded-full {{ $log->status == 'Completed' ? 'bg-green-100 text-green-600 shadow-md' : 'bg-orange-100 text-orange-600 shadow-md' }} flex items-center justify-center font-black text-base z-10 flex-shrink-0 ring-4 ring-white">
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

                          <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">By <span class="text-gray-700">{{ $log->user->name ?? 'System' }}</span></p>
                      </div>
                  </div>
              @empty
                  <div class="text-center py-16">
                      <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                      <p class="text-gray-400 font-bold text-lg">No updates yet</p>
                      <p class="text-gray-400 text-sm mt-1">Start by updating the status above</p>
                  </div>
              @endforelse
          </div>
        </div>
      </div>
    </main>
</div>
@endsection
