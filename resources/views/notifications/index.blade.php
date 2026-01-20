@extends('layouts.app')

@section('content')
  @include('customer.navbar')

  <div class="min-h-screen bg-[#f8fafc] pb-12">
    {{-- Decorative Background Element --}}
    <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-orange-50 to-transparent -z-10"></div>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
      {{-- Header Section --}}
      <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
        <div class="flex items-center space-x-4">
          <a href="{{ route('dashboard.customer') }}" class="group flex items-center justify-center w-12 h-12 rounded-2xl bg-white shadow-sm border border-gray-100 text-gray-400 hover:text-[#ff5a1f] hover:border-orange-100 transition-all duration-300">
            <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
          </a>
          <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Updates & Alerts</h1>
            <p class="text-gray-500 font-medium">Stay informed about your vehicle services</p>
          </div>
        </div>
        
        <div class="flex items-center space-x-3">
          <button class="px-5 py-2.5 rounded-xl bg-white border border-gray-100 text-sm font-bold text-gray-600 hover:text-[#ff5a1f] hover:border-orange-100 shadow-sm transition-all active:scale-95">
            Mark all read
          </button>
          <button class="p-2.5 rounded-xl bg-white border border-gray-100 text-gray-400 hover:text-gray-600 shadow-sm transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
          </button>
        </div>
      </div>

      {{-- Notification Categories --}}
      <div class="flex items-center space-x-2 mb-8 overflow-x-auto pb-2 scrollbar-hide">
        <button class="whitespace-nowrap px-6 py-2.5 rounded-full bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 transition-all">All Activity</button>
        <button class="whitespace-nowrap px-6 py-2.5 rounded-full bg-white text-gray-500 font-bold hover:bg-gray-50 transition-all border border-gray-100">Unread</button>
        <button class="whitespace-nowrap px-6 py-2.5 rounded-full bg-white text-gray-500 font-bold hover:bg-gray-50 transition-all border border-gray-100">Service Logs</button>
        <button class="whitespace-nowrap px-6 py-2.5 rounded-full bg-white text-gray-500 font-bold hover:bg-gray-50 transition-all border border-gray-100">Payments</button>
      </div>

      {{-- Notifications List --}}
      <div class="space-y-4">
        
        {{-- Notification Card: Service Progress --}}
        <div class="group relative bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:border-blue-100 hover:shadow-xl hover:shadow-blue-50/50 transition-all duration-300">
          <div class="absolute top-6 right-6 w-3 h-3 bg-blue-500 rounded-full animate-pulse group-hover:scale-125 transition-transform"></div>
          <div class="flex items-start space-x-5">
            <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform duration-300">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div class="flex-1">
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs font-black text-blue-500 uppercase tracking-widest">Service Update</span>
                <span class="text-xs font-bold text-gray-400">Just now</span>
              </div>
              <h3 class="text-lg font-black text-gray-900 mb-2">Service Request in Progress</h3>
              <p class="text-gray-600 leading-relaxed max-w-2xl">Your 2018 Toyota Corolla (#SR-2026-001) is currently being inspected by <span class="text-gray-900 font-bold">John Doe</span>. We'll update you on the progress shortly.</p>
              <div class="mt-5 flex items-center space-x-3">
                <a href="{{ route('customer.requests.index') }}" class="px-5 py-2 rounded-xl bg-gray-900 text-white text-sm font-bold hover:bg-gray-800 transition-colors shadow-sm">View Timeline</a>
                <button class="px-5 py-2 rounded-xl bg-gray-50 text-gray-500 text-sm font-bold hover:bg-gray-100 transition-colors">Dismiss</button>
              </div>
            </div>
          </div>
        </div>

        {{-- Notification Card: Success/Payment --}}
        <div class="group relative bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:border-green-100 hover:shadow-xl hover:shadow-green-50/50 transition-all duration-300">
          <div class="flex items-start space-x-5">
            <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 group-hover:scale-110 transition-transform duration-300">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="flex-1 text-opacity-60">
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs font-black text-green-500 uppercase tracking-widest">Billing success</span>
                <span class="text-xs font-bold text-gray-400">2 hours ago</span>
              </div>
              <h3 class="text-lg font-black text-gray-900 mb-2">Payment Received</h3>
              <p class="text-gray-600 leading-relaxed max-w-2xl">Invoice <span class="font-mono font-bold text-gray-900">#INV-8812</span> has been paid in full. Your service history has been updated successfully.</p>
              <div class="mt-5">
                <button class="px-5 py-2 rounded-xl border border-gray-200 text-gray-600 text-sm font-bold hover:bg-gray-50 transition-all flex items-center">
                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                  Download Receipt
                </button>
              </div>
            </div>
          </div>
        </div>

        {{-- Notification Card: Alert/Reminder --}}
        <div class="group relative bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:border-orange-100 hover:shadow-xl hover:shadow-orange-50/50 transition-all duration-300 opacity-80 hover:opacity-100 border-l-4 border-l-orange-500">
          <div class="flex items-start space-x-5">
            <div class="flex-shrink-0 w-14 h-14 rounded-2xl bg-orange-50 flex items-center justify-center text-orange-600 group-hover:scale-110 transition-transform duration-300">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="flex-1">
              <div class="flex items-center justify-between mb-1">
                <span class="text-xs font-black text-orange-500 uppercase tracking-widest">Schedule info</span>
                <span class="text-xs font-bold text-gray-400">Yesterday</span>
              </div>
              <h3 class="text-lg font-black text-gray-900 mb-2">Appointment Scheduled</h3>
              <p class="text-gray-600 leading-relaxed max-w-2xl">Reminder: Your vehicle pickup is scheduled for tomorrow between <span class="text-gray-900 font-bold">10:00 AM - 12:00 PM</span>. Please ensure your keys are ready.</p>
            </div>
          </div>
        </div>
      </div>

      {{-- Load More Section --}}
      <div class="mt-12 text-center">
        <button class="inline-flex items-center space-x-2 text-gray-400 font-bold hover:text-gray-600 transition-colors">
          <span>View past updates</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
      </div>
    </main>
  </div>
@endsection
