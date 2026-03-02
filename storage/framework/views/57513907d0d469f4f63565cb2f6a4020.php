<nav class="sf-topnav">
  <div class="sf-topnav-container">
    <div class="sf-topnav-row">
      
      <div class="sf-topnav-brand-wrap">
        <a href="<?php echo e(route('dashboard.staff')); ?>" class="sf-topnav-brand-link">
          <svg class="sf-topnav-brand-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          <span class="sf-topnav-brand-title">
            Auto<span class="sf-topnav-brand-accent">Mate</span><span class="sf-topnav-brand-tag">Staff</span>
          </span>
        </a>
      </div>

      
      <div class="sf-topnav-menu">
        <a href="<?php echo e(route('dashboard.staff')); ?>" class="sf-topnav-link <?php echo e(request()->routeIs('dashboard.staff') ? 'sf-topnav-link-active' : ''); ?>">
            Dashboard
        </a>
        <a href="<?php echo e(route('staff.bookings')); ?>" class="sf-topnav-link <?php echo e(request()->routeIs('staff.bookings*') ? 'sf-topnav-link-active' : ''); ?>">
            Bookings
            <?php if(($navCounts['services_pending'] ?? 0) > 0): ?>
              <span class="sf-topnav-pill">
                <?php echo e(($navCounts['services_pending'] ?? 0) > 99 ? '99+' : ($navCounts['services_pending'] ?? 0)); ?>

              </span>
            <?php endif; ?>
        </a>
        <a href="<?php echo e(route('staff.rentals.index')); ?>" class="sf-topnav-link <?php echo e(request()->routeIs('staff.rentals*') ? 'sf-topnav-link-active' : ''); ?>">
            Rentals
            <?php if(($navCounts['rentals_pending'] ?? 0) > 0): ?>
              <span class="sf-topnav-pill">
                <?php echo e(($navCounts['rentals_pending'] ?? 0) > 99 ? '99+' : ($navCounts['rentals_pending'] ?? 0)); ?>

              </span>
            <?php endif; ?>
        </a>
        <a href="<?php echo e(route('staff.service.logs')); ?>" class="sf-topnav-link <?php echo e(request()->routeIs('staff.service.logs*') ? 'sf-topnav-link-active' : ''); ?>">
            Service Logs
        </a>
        <a href="<?php echo e(route('staff.inventory')); ?>" class="sf-topnav-link <?php echo e(request()->routeIs('staff.inventory*') ? 'sf-topnav-link-active' : ''); ?>">
            Inventory
            <?php if(($navCounts['inventory_low_stock'] ?? 0) > 0): ?>
              <span class="sf-topnav-pill sf-topnav-pill-danger">
                <?php echo e(($navCounts['inventory_low_stock'] ?? 0) > 99 ? '99+' : ($navCounts['inventory_low_stock'] ?? 0)); ?>

              </span>
            <?php endif; ?>
        </a>
        <a href="<?php echo e(route('staff.customers')); ?>" class="sf-topnav-link <?php echo e(request()->routeIs('staff.customers*') ? 'sf-topnav-link-active' : ''); ?>">
            Customers
            <?php if(($navCounts['messages_unread'] ?? 0) > 0): ?>
              <span class="sf-topnav-pill">
                <?php echo e(($navCounts['messages_unread'] ?? 0) > 99 ? '99+' : ($navCounts['messages_unread'] ?? 0)); ?>

              </span>
            <?php endif; ?>
        </a>
      </div>

      
      <div class="sf-topnav-actions">
        <a href="<?php echo e(route('staff.profile')); ?>" class="sf-topnav-profile-link">
          <span class="sf-topnav-avatar">
              <?php echo e(substr(auth()->user()->name, 0, 1)); ?>

          </span>
        </a>

        <div class="sf-topnav-divider"></div>

        <form method="POST" action="<?php echo e(route('logout')); ?>">
          <?php echo csrf_field(); ?>
          <button type="submit" class="sf-topnav-logout" title="Logout">
            <svg class="sf-topnav-logout-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg>
          </button>
        </form>

        
        <button class="sf-topnav-mobile-btn" type="button" aria-label="Toggle mobile menu">
          <svg class="sf-topnav-mobile-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>

  
  <div class="sf-topnav-mobile-menu sf-hidden">
    <a href="<?php echo e(route('dashboard.staff')); ?>" class="sf-topnav-mobile-link">Dashboard</a>
    <a href="<?php echo e(route('staff.bookings')); ?>" class="sf-topnav-mobile-link">Bookings</a>
    <a href="<?php echo e(route('staff.service.logs')); ?>" class="sf-topnav-mobile-link">Service Logs</a>
    <a href="<?php echo e(route('staff.inventory')); ?>" class="sf-topnav-mobile-link">Inventory</a>
    <a href="<?php echo e(route('staff.customers')); ?>" class="sf-topnav-mobile-link">Customers</a>
  </div>
</nav>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/components/staff-navbar.blade.php ENDPATH**/ ?>