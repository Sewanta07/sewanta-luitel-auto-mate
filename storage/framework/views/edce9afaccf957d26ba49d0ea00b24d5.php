

<?php $__env->startSection('title', 'Notifications - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <div class="min-h-screen bg-[#f8fafc] pb-12">
    
    <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-orange-50 to-transparent -z-10"></div>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
      
      <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6">
        <div class="flex items-center space-x-4">
          <a href="<?php echo e(route('dashboard.customer')); ?>" class="group flex items-center justify-center w-12 h-12 rounded-2xl bg-white shadow-sm border border-gray-100 text-gray-400 hover:text-[#ff5a1f] hover:border-orange-100 transition-all duration-300">
            <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
          </a>
          <div>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Updates & Alerts</h1>
            <p class="text-gray-500 font-medium">Stay informed about your vehicle services and rentals</p>
          </div>
        </div>
        
        <div class="flex items-center space-x-3">
          <form action="<?php echo e(route('notifications.mark-all-read')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-white border border-gray-100 text-sm font-bold text-gray-600 hover:text-[#ff5a1f] hover:border-orange-100 shadow-sm transition-all active:scale-95">
              Mark all read
            </button>
          </form>
        </div>
      </div>

      
      <?php if(session('success')): ?>
        <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center">
          <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
          <?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>

      
      <div class="flex items-center space-x-2 mb-8 overflow-x-auto pb-2 scrollbar-hide">
        <a href="<?php echo e(route('notifications.index')); ?>" class="whitespace-nowrap px-6 py-2.5 rounded-full <?php echo e(request('filter', 'all') === 'all' ? 'bg-[#ff5a1f] text-white shadow-lg shadow-orange-100' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100'); ?> font-bold transition-all">
          All Activity (<?php echo e(isset($notifications) ? $notifications->total() : 0); ?>)
        </a>
        <a href="<?php echo e(route('notifications.index', ['filter' => 'unread'])); ?>" class="whitespace-nowrap px-6 py-2.5 rounded-full <?php echo e(request('filter') === 'unread' ? 'bg-[#ff5a1f] text-white shadow-lg shadow-orange-100' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100'); ?> font-bold transition-all">
          Unread (<?php echo e($unreadCount ?? 0); ?>)
        </a>
        <a href="<?php echo e(route('notifications.index', ['filter' => 'service'])); ?>" class="whitespace-nowrap px-6 py-2.5 rounded-full <?php echo e(request('filter') === 'service' ? 'bg-[#ff5a1f] text-white shadow-lg shadow-orange-100' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100'); ?> font-bold transition-all">
          Service Updates
        </a>
        <a href="<?php echo e(route('notifications.index', ['filter' => 'payment'])); ?>" class="whitespace-nowrap px-6 py-2.5 rounded-full <?php echo e(request('filter') === 'payment' ? 'bg-[#ff5a1f] text-white shadow-lg shadow-orange-100' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100'); ?> font-bold transition-all">
          Payments
        </a>
        <a href="<?php echo e(route('notifications.index', ['filter' => 'rental'])); ?>" class="whitespace-nowrap px-6 py-2.5 rounded-full <?php echo e(request('filter') === 'rental' ? 'bg-[#ff5a1f] text-white shadow-lg shadow-orange-100' : 'bg-white text-gray-500 hover:bg-gray-50 border border-gray-100'); ?> font-bold transition-all">
          Rentals
        </a>
      </div>

      
      <div class="space-y-4">
        <?php $__empty_1 = true; $__currentLoopData = $notifications ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <?php
            $config = $notification->getIconConfig();
          ?>
          
          
          <div class="group relative bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:<?php echo e($config['border']); ?> hover:shadow-xl hover:<?php echo e($config['shadow']); ?> transition-all duration-300 <?php echo e($notification->is_read ? 'opacity-75' : ''); ?>">
            <?php if(!$notification->is_read): ?>
              <div class="absolute top-6 right-6 w-3 h-3 rounded-full animate-pulse group-hover:scale-125 transition-transform" style="background-color: <?php echo e(str_replace('text-', '#', $config['text'])); ?>"></div>
            <?php endif; ?>
            <div class="flex items-start space-x-5">
              <div class="flex-shrink-0 w-14 h-14 rounded-2xl <?php echo e($config['bg']); ?> flex items-center justify-center <?php echo e($config['text']); ?> group-hover:scale-110 transition-transform duration-300">
                <?php if($notification->icon_type === 'success'): ?>
                  <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php elseif($notification->icon_type === 'warning'): ?>
                  <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <?php elseif($notification->icon_type === 'error'): ?>
                  <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php else: ?>
                  <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <?php endif; ?>
              </div>
              <div class="flex-1">
                <div class="flex items-center justify-between mb-1">
                  <span class="text-xs font-black <?php echo e($config['label']); ?> uppercase tracking-widest"><?php echo e(ucfirst(str_replace('_', ' ', $notification->type))); ?></span>
                  <span class="text-xs font-bold text-gray-400"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                </div>
                <h3 class="text-lg font-black text-gray-900 mb-2"><?php echo e($notification->title); ?></h3>
                <p class="text-gray-600 leading-relaxed max-w-2xl"><?php echo e($notification->message); ?></p>
                <div class="mt-5 flex items-center space-x-3">
                  <?php if($notification->action_url): ?>
                    <a href="<?php echo e($notification->action_url); ?>" class="px-5 py-2 rounded-xl bg-gray-900 text-white text-sm font-bold hover:bg-gray-800 transition-colors shadow-sm">
                      <?php echo e($notification->action_text ?? 'View Details'); ?>

                    </a>
                  <?php endif; ?>
                  <?php if(!$notification->is_read): ?>
                    <form action="<?php echo e(route('notifications.read', $notification->id)); ?>" method="POST" class="inline">
                      <?php echo csrf_field(); ?>
                      <button type="submit" class="px-5 py-2 rounded-xl bg-gray-50 text-gray-500 text-sm font-bold hover:bg-gray-100 transition-colors">Mark as Read</button>
                    </form>
                  <?php endif; ?>
                  <form action="<?php echo e(route('notifications.destroy', $notification->id)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="text-gray-400 hover:text-red-500 text-sm font-bold transition">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <div class="bg-white rounded-3xl border border-dashed border-gray-200 p-10 text-center">
            <div class="w-20 h-20 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4">
              <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No notifications yet</h3>
            <p class="text-gray-500">You're all caught up! New notifications will appear here.</p>
          </div>
        <?php endif; ?>
      </div>

      
      <?php if(isset($notifications) && $notifications->hasPages()): ?>
        <div class="mt-8">
          <?php echo e($notifications->links()); ?>

        </div>
      <?php endif; ?>
    </main>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\notifications\index.blade.php ENDPATH**/ ?>