<nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      
      <div class="flex-shrink-0 flex items-center">
        <a href="<?php echo e(route('dashboard.admin')); ?>" class="flex items-center space-x-2 group">
          <svg class="w-8 h-8 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          <span class="text-xl font-black tracking-tight text-gray-900">
            Auto<span class="text-[#ff5a1f]">Mate</span><span class="ml-1 px-2 py-0.5 rounded text-[10px] font-bold bg-gray-900 text-white uppercase tracking-wider">Admin</span>
          </span>
        </a>
      </div>

      
      <div class="hidden md:flex md:items-center md:space-x-1">
        <a href="<?php echo e(route('dashboard.admin')); ?>" class="px-3 py-2 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('dashboard.admin') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-700 hover:bg-gray-100'); ?> transition">
            Overview
        </a>
        <a href="<?php echo e(route('admin.users')); ?>" class="px-3 py-2 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.users*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-700 hover:bg-gray-100'); ?> transition">
            Users
        </a>
        <a href="<?php echo e(route('admin.staff-applications.index')); ?>" class="px-3 py-2 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.staff-applications*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-700 hover:bg-gray-100'); ?> transition">
            Applications
        </a>
        <a href="<?php echo e(route('admin.analytics')); ?>" class="px-3 py-2 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.analytics') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-700 hover:bg-gray-100'); ?> transition">
            Analytics
        </a>
      </div>

      
      <div class="flex items-center space-x-3">
        <div class="h-6 w-px bg-gray-200 mx-2"></div>

        <div class="flex items-center space-x-2">
            <span class="text-sm font-semibold text-gray-700 hidden sm:block"><?php echo e(auth()->user()->name); ?></span>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="p-2 rounded-lg text-gray-400 hover:bg-red-50 hover:text-red-500 transition" title="Logout">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
            </button>
            </form>
        </div>

        
        <button class="md:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  
  <div class="md:hidden hidden bg-white border-t border-gray-200 px-4 py-3 space-y-2">
    <a href="<?php echo e(route('dashboard.admin')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Overview</a>
    <a href="<?php echo e(route('admin.users')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Users</a>
    <a href="<?php echo e(route('admin.staff-applications.index')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Applications</a>
     <a href="<?php echo e(route('admin.analytics')); ?>" class="block px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">Analytics</a>
  </div>
</nav>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\components\admin-navbar.blade.php ENDPATH**/ ?>