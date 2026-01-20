<nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      {{-- Logo / Brand --}}
      <div class="flex-shrink-0 flex items-center">
        <a href="{{ route('dashboard.staff') }}" class="flex items-center space-x-2 group">
          <svg class="w-8 h-8 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          <span class="text-xl font-black tracking-tight text-gray-900">
            Auto<span class="text-[#ff5a1f]">Mate</span><span class="ml-1 px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-800 uppercase tracking-wider">Pro</span>
          </span>
        </a>
      </div>

      {{-- Desktop Navigation Menu --}}
      <div class="hidden md:flex md:items-center md:space-x-1">
        <a href="{{ route('dashboard.staff') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard.staff') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-700 hover:bg-gray-100' }} transition">
            Dashboard
        </a>
        <a href="{{ route('staff.bookings') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('staff.bookings*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-700 hover:bg-gray-100' }} transition">
            Bookings
        </a>
        <a href="{{ route('staff.service.logs') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('staff.service.logs*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-700 hover:bg-gray-100' }} transition">
            Service Logs
        </a>
        <a href="{{ route('staff.inventory') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('staff.inventory*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-700 hover:bg-gray-100' }} transition">
            Inventory
        </a>
        <a href="{{ route('staff.customers') }}" class="px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('staff.customers*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-700 hover:bg-gray-100' }} transition">
            Customers
        </a>
      </div>

      {{-- Right side menu (Profile & Logout) --}}
      <div class="flex items-center space-x-3">
        <a href="{{ route('staff.settings') }}" class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-[#ff5a1f] transition" title="Settings">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </a>

        <a href="{{ route('staff.profile') }}" class="hidden md:flex group px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition items-center space-x-2">
          <span class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold border border-blue-200">
              {{ substr(auth()->user()->name, 0, 1) }}
          </span>
        </a>

        <div class="h-6 w-px bg-gray-200 mx-1"></div>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="p-2 rounded-lg text-gray-400 hover:bg-red-50 hover:text-red-500 transition" title="Logout">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
          </button>
        </form>

        {{-- Mobile menu button --}}
        <button class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- Mobile Menu --}}
  <div class="md:hidden hidden bg-white border-t border-gray-200 px-4 py-3 space-y-2">
    <a href="{{ route('dashboard.staff') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Dashboard</a>
    <a href="{{ route('staff.bookings') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Bookings</a>
    <a href="{{ route('staff.service.logs') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Service Logs</a>
    <a href="{{ route('staff.inventory') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Inventory</a>
    <a href="{{ route('staff.customers') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Customers</a>
  </div>
</nav>
