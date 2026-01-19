{{-- Customer Navigation Bar (UI only) --}}
<nav class="bg-white border-b border-gray-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <div class="flex items-center space-x-6">
        <div class="flex-shrink-0">
          <span class="text-xl font-semibold text-teal-600">AutoMate</span>
        </div>
        <div class="hidden md:flex md:space-x-1">
          {{-- Nav items --}}
          <a href="#" class="group inline-flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition">
            {{-- Grid icon --}}
            <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h7v7H3V3zM14 3h7v7h-7V3zM3 14h7v7H3v-7zM14 14h7v7h-7v-7z"></path></svg>
            <span>Dashboard</span>
          </a>

          <a href="#" class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium bg-gradient-to-r from-teal-50 to-white text-teal-700 ring-1 ring-teal-100 shadow-sm transform hover:-translate-y-0.5 transition">
            {{-- Wrench (primary CTA) --}}
            <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a4 4 0 11-5.6 5.6L3 18l3 1 5.1-5.1a4 4 0 001.6-4.6l-2-4.1z"></path></svg>
            <span>Request Service</span>
          </a>

          <a href="#" class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition">
            {{-- Clipboard icon --}}
            <svg class="w-5 h-5 mr-2 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v3a2 2 0 002 2h2"></path></svg>
            <span>My Requests</span>
          </a>

          <a href="#" class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition">
            {{-- Car icon --}}
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l1-6h16l1 6M5 13v4a1 1 0 001 1h1a1 1 0 001-1v-1h8v1a1 1 0 001 1h1a1 1 0 001-1v-4"></path></svg>
            <span>My Vehicles</span>
          </a>

          <a href="#" class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition">
            {{-- Clock/history icon --}}
            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M12 6a6 6 0 100 12 6 6 0 000-12z"></path></svg>
            <span>Service History</span>
          </a>
        </div>
      </div>

      <div class="flex items-center space-x-4">
        <a href="#" class="hidden md:inline-flex items-center text-gray-700 hover:text-gray-900">
          <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 6.196 9 9 0 015.12 17.804z"></path></svg>
          <span>Profile / Settings</span>
        </a>

        <a href="#" class="inline-flex items-center text-gray-600 hover:text-gray-900">
          {{-- Sign-out icon --}}
          <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"></path></svg>
          <span class="hidden md:inline">Logout</span>
        </a>
      </div>
    </div>
  </div>

  {{-- Mobile compact nav (icons + labels hidden) --}}
  <div class="md:hidden border-t border-gray-100 bg-white">
    <div class="flex justify-between px-4 py-2 overflow-x-auto">
      <a class="flex flex-col items-center text-gray-600 px-3 py-1">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h7v7H3V3zM14 3h7v7h-7V3zM3 14h7v7H3v-7zM14 14h7v7h-7v-7z"></path></svg>
        <span class="text-xs">Home</span>
      </a>
      <a class="flex flex-col items-center text-teal-600 px-3 py-1 bg-teal-50 rounded-lg">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a4 4 0 11-5.6 5.6L3 18l3 1 5.1-5.1a4 4 0 001.6-4.6l-2-4.1z"></path></svg>
        <span class="text-xs">Request</span>
      </a>
      <a class="flex flex-col items-center text-gray-600 px-3 py-1">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v3a2 2 0 002 2h2"></path></svg>
        <span class="text-xs">Requests</span>
      </a>
      <a class="flex flex-col items-center text-gray-600 px-3 py-1">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l1-6h16l1 6M5 13v4a1 1 0 001 1h1a1 1 0 001-1v-1h8v1a1 1 0 001 1h1a1 1 0 001-1v-4"></path></svg>
        <span class="text-xs">Vehicles</span>
      </a>
      <a class="flex flex-col items-center text-gray-600 px-3 py-1">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M12 6a6 6 0 100 12 6 6 0 000-12z"></path></svg>
        <span class="text-xs">History</span>
      </a>
    </div>
  </div>
</nav>
