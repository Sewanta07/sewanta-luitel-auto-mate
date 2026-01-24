@extends('layouts.app')

@section('content')
<div class="flex h-screen bg-gray-50">
  @include('components.staff-navbar')
  
  <main class="flex-1 overflow-y-auto p-6">
    <div class="max-w-7xl mx-auto">
      <!-- Header -->
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Assigned Service Details</h1>
        <p class="text-gray-500 mt-1">Service Request #BK-{{ str_pad($booking->id, 4, '0', STR_PAD_LEFT) }}</p>
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
                <p class="font-semibold text-gray-900">{{ $booking->customer->name ?? 'Unknown' }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Contact</p>
                <p class="font-semibold text-gray-900">{{ $booking->phone_number ?? ($booking->customer->phone ?? 'N/A') }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-semibold text-gray-900">{{ $booking->customer->email ?? 'N/A' }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Pick-up Location</p>
                <p class="font-semibold text-gray-900">{{ $booking->location }}</p>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Vehicle Information</h2>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <p class="text-sm text-gray-500">Make & Model</p>
                <p class="font-semibold text-gray-900">{{ $booking->vehicle_model }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">License Plate</p>
                <p class="font-semibold text-gray-900">{{ $booking->vehicle_number }}</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Vehicle Type</p>
                <p class="font-semibold text-gray-900">{{ $booking->vehicle_type }}</p>
              </div>
            </div>
          </div>

          </div>

          <!-- Progress Logs -->
          <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
            <h2 class="text-xl font-black text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-3 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Service History & Logs
            </h2>
            <div class="space-y-6">
                @forelse($booking->logs()->with('user')->latest()->get() as $log)
                    <div class="flex gap-4 relative">
                        @if(!$loop->last)
                            <div class="absolute left-5 top-10 bottom-0 w-0.5 bg-gray-50"></div>
                        @endif
                        <div class="flex-shrink-0 w-10 h-10 rounded-xl {{ $log->status == 'Completed' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-[#ff5a1f]' }} flex items-center justify-center font-black text-xs z-10">
                            {{ substr($log->status, 0, 1) }}
                        </div>
                        <div class="flex-1 pb-6">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-black text-gray-900">{{ $log->status }}</span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $log->created_at->format('M d, H:i') }}</span>
                            </div>
                            <p class="text-sm text-gray-500 font-medium bg-gray-50/50 p-3 rounded-xl border border-gray-50">{{ $log->notes }}</p>
                            <div class="text-[10px] font-black text-gray-400 mt-2 tracking-tighter uppercase">By {{ $log->user->name }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-gray-400 font-bold italic">No log entries yet.</p>
                    </div>
                @endforelse
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
          <!-- Update Status -->
          <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
            <h3 class="font-black text-gray-900 mb-6 uppercase text-xs tracking-[0.2em]">Update Progress</h3>
            <form action="{{ route('staff.bookings.status', $booking->id) }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Current Status</label>
                    <select name="status" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-black focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none outline-none">
                      <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                      <option value="In Progress" {{ $booking->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                      <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Update Notes</label>
                    <textarea name="notes" rows="4" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all outline-none resize-none" placeholder="What progress was made?"></textarea>
                </div>
                <button type="submit" class="w-full px-8 py-5 bg-[#ff5a1f] text-white font-black rounded-2xl shadow-xl shadow-orange-100 hover:bg-[#e44d18] transform hover:-translate-y-1 transition-all uppercase text-xs tracking-widest">Post Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection
