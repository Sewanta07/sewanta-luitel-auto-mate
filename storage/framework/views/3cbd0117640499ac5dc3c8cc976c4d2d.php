
<nav x-data="{ userDropdownOpen: false, mobileMenuOpen: false }" class="bg-white sticky top-0 z-50 border-b border-gray-100 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-20">
      
      
      <div class="flex-shrink-0">
        <a href="<?php echo e(route('index')); ?>" class="flex items-center space-x-2 group">
          <svg class="w-8 h-8 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          <span class="text-2xl font-black tracking-tight text-gray-900">
            Auto<span class="text-[#ff5a1f]">Mate</span>
          </span>
        </a>
      </div>

      
      <div class="hidden lg:flex flex-1 justify-center">
        <div class="flex items-center space-x-2">
          <a href="<?php echo e(route('dashboard.customer')); ?>" 
             class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 <?php echo e(request()->routeIs('dashboard.customer') ? 'text-[#ff5a1f] bg-orange-50' : 'text-gray-600 hover:text-[#ff5a1f] hover:bg-gray-50'); ?>">
            Dashboard
          </a>
          <a href="<?php echo e(route('bookings.create')); ?>" 
             class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 <?php echo e(request()->routeIs('bookings.create') ? 'text-[#ff5a1f] bg-orange-50' : 'text-gray-600 hover:text-[#ff5a1f] hover:bg-gray-50'); ?>">
            Bookings
          </a>
          <a href="<?php echo e(route('customer.vehicles')); ?>" 
             class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 <?php echo e(request()->routeIs('customer.vehicles*') ? 'text-[#ff5a1f] bg-orange-50' : 'text-gray-600 hover:text-[#ff5a1f] hover:bg-gray-50'); ?>">
            Vehicles
          </a>
          <a href="<?php echo e(route('customer.rent-vehicles')); ?>" 
             class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 <?php echo e(request()->routeIs('customer.rent-vehicles') ? 'text-[#ff5a1f] bg-orange-50' : 'text-gray-600 hover:text-[#ff5a1f] hover:bg-gray-50'); ?>">
            Rent Vehicles
          </a>
          <a href="<?php echo e(route('customer.rentals')); ?>" 
             class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 <?php echo e(request()->routeIs('customer.rentals*') ? 'text-[#ff5a1f] bg-orange-50' : 'text-gray-600 hover:text-[#ff5a1f] hover:bg-gray-50'); ?>">
            My Rentals
          </a>
          <a href="<?php echo e(route('customer.history')); ?>" 
             class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 <?php echo e(request()->routeIs('customer.history') ? 'text-[#ff5a1f] bg-orange-50' : 'text-gray-600 hover:text-[#ff5a1f] hover:bg-gray-50'); ?>">
            History
          </a>
          </div>
      </div>

      
      <div class="flex items-center space-x-4">
        
        
        <a href="<?php echo e(route('bookings.create')); ?>" 
           class="hidden md:flex items-center px-6 py-2.5 rounded-full text-sm font-black bg-[#ff5a1f] text-white shadow-lg shadow-orange-100 hover:bg-[#e44d18] hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
          Request Service
        </a>

        
        <a href="<?php echo e(route('notifications.index')); ?>" class="p-2.5 rounded-xl text-gray-400 hover:text-[#ff5a1f] hover:bg-orange-50 transition-all duration-200 relative">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
          <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
        </a>

        
        <div class="relative">
          <button @click="userDropdownOpen = !userDropdownOpen" 
                  class="flex items-center p-1 rounded-full hover:bg-gray-50 transition-all duration-200 focus:outline-none border border-transparent hover:border-gray-200">
            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center border-2 border-white overflow-hidden shadow-sm">
              <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
          </button>

          
          <div x-show="userDropdownOpen" 
               @click.away="userDropdownOpen = false"
               x-transition:enter="transition ease-out duration-150"
               x-transition:enter-start="opacity-0 scale-95 translate-y-2"
               x-transition:enter-end="opacity-100 scale-100 translate-y-0"
               class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 ring-1 ring-black/5 overflow-hidden">
            
            <div class="px-5 py-4 border-b border-gray-50">
              <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none">Logged in as</p>
              <p class="text-base font-black text-gray-900 mt-1 truncate"><?php echo e(Auth::user()->name ?? 'Customer'); ?></p>
            </div>

            <div class="p-2 space-y-1">
              <a href="<?php echo e(route('customer.profile')); ?>" class="flex items-center px-4 py-3 rounded-xl text-sm font-bold text-gray-700 hover:bg-orange-50 hover:text-[#ff5a1f] transition-all">
                <svg class="w-5 h-5 mr-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                My Profile
              </a>

              <a href="<?php echo e(route('customer.payments')); ?>" class="flex items-center px-4 py-3 rounded-xl text-sm font-bold text-gray-700 hover:bg-orange-50 hover:text-[#ff5a1f] transition-all">
                <svg class="w-5 h-5 mr-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                Payments
              </a>

              <div class="h-px bg-gray-50 my-2"></div>

              <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full flex items-center px-4 py-3 rounded-xl text-sm font-black text-red-600 hover:bg-red-50 transition-all">
                  <svg class="w-5 h-5 mr-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/></svg>
                  Sign Out
                </button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  
  <div x-show="mobileMenuOpen" 
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-4"
       x-transition:enter-end="opacity-100 translate-y-0"
       class="lg:hidden bg-white border-t border-gray-50 p-4 space-y-1 shadow-inner">
    
    <a href="<?php echo e(route('dashboard.customer')); ?>" class="block p-4 rounded-xl text-sm font-bold text-gray-700 hover:bg-orange-50 hover:text-[#ff5a1f] transition-all">Dashboard</a>
    <a href="<?php echo e(route('customer.vehicles')); ?>" class="block p-4 rounded-xl text-sm font-bold text-gray-700 hover:bg-orange-50 hover:text-[#ff5a1f] transition-all">My Vehicles</a>
    <a href="<?php echo e(route('bookings.create')); ?>" class="block p-4 rounded-xl text-sm font-bold text-gray-700 hover:bg-orange-50 hover:text-[#ff5a1f] transition-all">Request Service</a>
    <a href="<?php echo e(route('customer.rent-vehicles')); ?>" class="block p-4 rounded-xl text-sm font-bold text-gray-700 hover:bg-orange-50 hover:text-[#ff5a1f] transition-all">Rent Vehicles</a>
    <a href="<?php echo e(route('customer.rentals')); ?>" class="block p-4 rounded-xl text-sm font-bold text-gray-700 hover:bg-orange-50 hover:text-[#ff5a1f] transition-all">My Rentals</a>
    <a href="<?php echo e(route('customer.profile')); ?>" class="block p-4 rounded-xl text-sm font-bold text-gray-700 hover:bg-orange-50 hover:text-[#ff5a1f] transition-all">Profile</a>
    
    <div class="h-px bg-gray-100 my-4"></div>
    
    <form action="<?php echo e(route('logout')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <button type="submit" class="w-full text-left p-4 rounded-xl text-sm font-bold text-red-600 hover:bg-red-50 transition-all">Logout</button>
    </form>
  </div>
</nav>

<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/navbar.blade.php ENDPATH**/ ?>