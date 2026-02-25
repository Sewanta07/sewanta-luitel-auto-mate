

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <main class="max-w-7xl mx-auto p-6">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li><a href="<?php echo e(route('dashboard.customer')); ?>" class="text-gray-500 hover:text-gray-700">Dashboard</a></li>
        <li><span class="text-gray-400 mx-2">/</span></li>
        <li><a href="<?php echo e(route('customer.requests.index')); ?>" class="text-gray-500 hover:text-gray-700">My Requests</a></li>
        <li><span class="text-gray-400 mx-2">/</span></li>
        <li class="text-gray-900 font-medium">Service Details</li>
      </ol>
    </nav>

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
      <div>
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">Service <span class="text-[#ff5a1f]">Details</span></h1>
        <p class="text-gray-400 font-bold mt-2 uppercase tracking-widest text-[10px]">Reference: #BK-<?php echo e(str_pad($booking->id, 4, '0', STR_PAD_LEFT)); ?></p>
      </div>
      <div class="px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-widest
        <?php echo e($booking->status == 'Completed' ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-500'); ?>">
        <?php echo e($booking->status); ?>

      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
      <!-- Main Content -->
      <div class="lg:col-span-2 space-y-10">
        <!-- Progress Timeline -->
        <div class="bg-white rounded-[3rem] shadow-xl shadow-gray-100/50 border border-gray-50 p-10">
          <h2 class="text-2xl font-black text-gray-900 mb-10 flex items-center">
              <svg class="w-6 h-6 mr-3 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              Live <span class="ml-2 text-[#ff5a1f]">Timeline</span>
          </h2>
          <div class="space-y-10">
            <?php $__empty_1 = true; $__currentLoopData = $booking->logs()->with('user')->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="flex gap-8 relative group">
                    <?php if(!$loop->last): ?>
                        <div class="absolute left-6 top-14 bottom-0 w-1 bg-gray-50 rounded-full"></div>
                    <?php endif; ?>
                    <div class="flex-shrink-0 w-12 h-12 rounded-2xl <?php echo e($log->status == 'Completed' ? 'bg-green-500 text-white shadow-green-100' : 'bg-orange-500 text-white shadow-orange-100'); ?> flex items-center justify-center font-black text-sm z-10 shadow-lg">
                        <?php echo e(substr($log->status, 0, 1)); ?>

                    </div>
                    <div class="flex-1 pb-2">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-black text-gray-900 tracking-tight transition-colors group-hover:text-[#ff5a1f]"><?php echo e($log->status); ?></h3>
                            <span class="text-[10px] font-black text-gray-300 uppercase tracking-[0.2em]"><?php echo e($log->created_at->format('M d, H:i')); ?></span>
                        </div>
                        <div class="bg-gray-50/50 p-6 rounded-[2rem] border border-gray-50 text-gray-500 font-bold text-sm leading-relaxed">
                            <?php echo e($log->notes); ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-20 bg-gray-50/30 rounded-[3rem] border border-dashed border-gray-100">
                    <p class="text-gray-400 font-black tracking-tight">Your request is being processed. Stay tuned for updates!</p>
                </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
                <h2 class="text-xl font-black text-gray-900 mb-6 uppercase text-xs tracking-widest text-gray-400">Service Info</h2>
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Type</p>
                        <p class="text-lg font-black text-gray-900 tracking-tight"><?php echo e($booking->service_type); ?></p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Description</p>
                        <p class="text-sm font-bold text-gray-500 italic">"<?php echo e($booking->problem_description ?? 'Standard service request'); ?>"</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-10">
                <h2 class="text-xl font-black text-gray-900 mb-6 uppercase text-xs tracking-widest text-gray-400">Vehicle Info</h2>
                <div class="space-y-6">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-[#ff5a1f] font-black text-lg mr-4">
                            <?php echo e(substr($booking->vehicle_model, 0, 1)); ?>

                        </div>
                        <div>
                            <p class="text-lg font-black text-gray-900 tracking-tight leading-none"><?php echo e($booking->vehicle_model); ?></p>
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mt-2"><?php echo e($booking->vehicle_number); ?></p>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-50">
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1">Category</p>
                        <p class="text-sm font-black text-gray-900"><?php echo e($booking->vehicle_type ?? 'N/A'); ?></p>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="space-y-10">
        <!-- Personnel -->
        <?php if($booking->staff): ?>
        <div class="bg-white rounded-[3rem] shadow-xl shadow-gray-100 border border-gray-50 p-10">
          <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-8">Assigned Personnel</h3>
          <div class="flex items-center space-x-5 mb-8">
            <div class="w-16 h-16 rounded-[1.5rem] bg-gray-900 shadow-xl shadow-gray-200 flex items-center justify-center text-white font-black text-xl">
              <?php echo e(substr($booking->staff->name, 0, 1)); ?>

            </div>
            <div>
              <p class="text-xl font-black text-gray-900 tracking-tight leading-none"><?php echo e($booking->staff->name); ?></p>
              <span class="inline-block mt-2 px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest rounded-lg tracking-tighter">Technician</span>
            </div>
          </div>
          <div class="space-y-4">
            <a href="mailto:<?php echo e($booking->staff->email); ?>" class="flex items-center bg-gray-50 p-4 rounded-2xl text-gray-600 hover:bg-orange-50 hover:text-[#ff5a1f] transition-all group">
              <svg class="w-5 h-5 mr-3 text-gray-300 group-hover:text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
              <span class="text-xs font-black tracking-tight truncate"><?php echo e($booking->staff->email); ?></span>
            </a>
          </div>
        </div>
        <?php else: ?>
        <div class="bg-gray-900 rounded-[3rem] shadow-xl p-10 text-center">
            <div class="w-16 h-16 bg-white/10 rounded-[1.5rem] flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-xl font-black text-white tracking-tight mb-2">Awaiting Assignment</h3>
            <p class="text-gray-400 text-xs font-bold leading-relaxed">We are currently vetting the best personnel for your specific service request.</p>
        </div>
        <?php endif; ?>

        <!-- Quick Help -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 p-10 overflow-hidden relative">
          <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-16 -mt-16 z-0"></div>
          <div class="relative z-10">
            <h3 class="text-xl font-black text-gray-900 mb-6 tracking-tight">Need <span class="text-[#ff5a1f]">Assistance?</span></h3>
            <p class="text-gray-400 text-sm font-bold mb-8 leading-relaxed italic">"Our goal is to get you back on the road with maximum safety and performance."</p>
            <button class="w-full px-8 py-5 bg-[#ff5a1f] text-white font-black rounded-3xl shadow-2xl shadow-orange-100 hover:bg-[#e44d18] transform transition-all active:scale-95 uppercase text-[10px] tracking-widest">
              Emergency Contact
            </button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\requests\show.blade.php ENDPATH**/ ?>