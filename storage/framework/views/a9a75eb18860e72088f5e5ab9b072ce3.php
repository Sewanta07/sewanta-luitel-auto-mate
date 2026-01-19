
<nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      
      
      <div class="flex-shrink-0 flex items-center">
        <span class="text-2xl font-bold" style="color: #ff5a1f;">AutoMate</span>
      </div>

      
      <div class="hidden md:flex md:items-center md:space-x-1">
        
        <a href="<?php echo e(route('dashboard.customer')); ?>" class="group px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition flex items-center space-x-2">
          <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h7v7H3V3zM14 3h7v7h-7V3zM3 14h7v7H3v-7zM14 14h7v7h-7v-7z"></path>
          </svg>
          <span>Dashboard</span>
        </a>

        
        <a href="<?php echo e(route('customer.requests.create')); ?>" class="px-4 py-2 rounded-lg text-sm font-semibold text-white shadow-md hover:shadow-lg transition flex items-center space-x-2 transform hover:-translate-y-0.5" style="background: linear-gradient(135deg, #ff5a1f 0%, #e64b15 100%);">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.7 6.3a4 4 0 11-5.6 5.6L3 18l3 1 5.1-5.1a4 4 0 001.6-4.6l-2-4.1z"></path>
          </svg>
          <span>Request Service</span>
        </a>

        
        <a href="<?php echo e(route('customer.requests.index')); ?>" class="group px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition flex items-center space-x-2">
          <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2-11a4 4 0 00-4-4H7a4 4 0 00-4 4v12a4 4 0 004 4h6a4 4 0 004-4V5z"></path>
          </svg>
          <span>My Requests</span>
        </a>

        
        </a>
        
        
        <a href="<?php echo e(route('customer.rentals')); ?>" class="group px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition flex items-center space-x-2">
          <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
          </svg>
          <span>Rent a Car</span>
        </a>

        
        <a href="<?php echo e(route('customer.vehicles')); ?>" class="group px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition flex items-center space-x-2">
          <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 13l1-6h16l1 6M5 13v4a1 1 0 001 1h1a1 1 0 001-1v-1h8v1a1 1 0 001 1h1a1 1 0 001-1v-4M3 13H1m20 0h2"></path>
          </svg>
          <span>My Vehicles</span>
        </a>

        
        <a href="<?php echo e(route('customer.history')); ?>" class="group px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition flex items-center space-x-2">
          <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a6 6 0 11-12 0 6 6 0 0112 0z"></path>
          </svg>
          <span>Service History</span>
        </a>
      </div>

      
      <div class="flex items-center space-x-3">
        
        <a href="<?php echo e(route('customer.profile')); ?>" class="hidden md:flex group px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition items-center space-x-2">
          <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5.121 17.804A13.857 13.857 0 1018.88 6.196 9.001 9.001 0 015.12 17.804z"></path>
          </svg>
          <span>Profile</span>
        </a>

        
        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" class="group px-3 py-2 rounded-lg text-sm font-medium transition flex items-center space-x-2" style="color: #ef4444;">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
            <span class="hidden md:inline">Logout</span>
          </button>
        </form>

        
        <button class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  
  <div class="md:hidden hidden bg-white border-t border-gray-200 px-4 py-3 space-y-2">
    <a href="<?php echo e(route('dashboard.customer')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Dashboard</a>
    <a href="<?php echo e(route('customer.requests.create')); ?>" class="block px-3 py-2 rounded-lg text-sm font-semibold text-white transition" style="background: #ff5a1f;">Request Service</a>
    <a href="<?php echo e(route('customer.requests.index')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">My Requests</a>
    <a href="<?php echo e(route('customer.rentals')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Rent a Car</a>
    <a href="<?php echo e(route('customer.vehicles')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">My Vehicles</a>
    <a href="<?php echo e(route('customer.history')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Service History</a>
    <a href="<?php echo e(route('customer.profile')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Profile</a>
    <form method="POST" action="<?php echo e(route('logout')); ?>">
      <?php echo csrf_field(); ?>
      <button type="submit" class="w-full text-left block px-3 py-2 rounded-lg text-sm font-medium transition" style="color: #ef4444;">Logout</button>
    </form>
  </div>
</nav>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/components/customer-navbar.blade.php ENDPATH**/ ?>