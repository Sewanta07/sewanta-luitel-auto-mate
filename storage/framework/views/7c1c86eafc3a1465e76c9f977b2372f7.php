

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gradient-to-br from-gray-50 to-gray-100">
  <?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  
  <main class="flex-1 overflow-y-auto p-8">
    <div class="max-w-6xl mx-auto">
      <!-- Centered Header -->
      <div class="text-center mb-12">
        <h1 class="text-5xl font-black text-gray-900 mb-2">Service Details</h1>
        <p class="text-gray-500 text-lg">Booking <span class="font-black text-gray-700"><?php echo e($booking->booking_code); ?></span></p>
        <div class="mt-6 flex justify-center">
          <span class="inline-block px-6 py-2 rounded-full font-black text-sm tracking-wider shadow-lg
            <?php if($booking->status == 'Pending'): ?> bg-yellow-100 text-yellow-800 border-2 border-yellow-200
            <?php elseif($booking->status == 'In Progress'): ?> bg-blue-100 text-blue-800 border-2 border-blue-200
            <?php elseif($booking->status == 'Waiting for Parts'): ?> bg-purple-100 text-purple-800 border-2 border-purple-200
            <?php elseif($booking->status == 'Completed'): ?> bg-green-100 text-green-800 border-2 border-green-200
            <?php else: ?> bg-gray-100 text-gray-800 border-2 border-gray-200
            <?php endif; ?>">
            <?php echo e($booking->status); ?>

          </span>
        </div>
      </div>

      <!-- Quick Info Cards - Centered -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-12">
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-orange-500">
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Service Type</p>
          <p class="text-lg font-black text-gray-900"><?php echo e($booking->service_type); ?></p>
        </div>
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-blue-500">
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Priority</p>
          <p class="text-lg font-black text-gray-900"><?php echo e($booking->service_priority ?? 'Standard'); ?></p>
        </div>
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-green-500">
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Estimated Cost</p>
          <p class="text-lg font-black text-gray-900">Rs. <?php echo e($booking->estimated_cost ?? 'TBD'); ?></p>
        </div>
        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow p-6 border-l-4 border-purple-500">
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Booked Date</p>
          <p class="text-lg font-black text-gray-900"><?php echo e($booking->preferred_date); ?></p>
        </div>
      </div>

      <!-- Main Content in Single Column -->
      <div class="space-y-8">
        <!-- Customer & Vehicle Info - Full Width -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- Customer Details Card -->
          <div class="bg-white rounded-2xl shadow-md p-8 border-t-4 border-orange-500 hover:shadow-lg transition-shadow">
            <h2 class="text-base font-black text-gray-900 mb-6 uppercase tracking-wider flex items-center justify-center">
              <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              Customer
            </h2>
            <div class="space-y-5 text-center">
              <div class="pb-5 border-b border-gray-100">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Full Name</p>
                <p class="font-black text-gray-900 text-lg"><?php echo e($booking->customer->name ?? 'Unknown'); ?></p>
              </div>
              <div class="pb-5 border-b border-gray-100">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Contact Number</p>
                <p class="font-black text-gray-900 text-lg"><?php echo e($booking->phone_number ?? ($booking->customer->phone ?? 'N/A')); ?></p>
              </div>
              <div class="pb-5 border-b border-gray-100">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Email Address</p>
                <p class="font-black text-gray-900 text-sm break-all"><?php echo e($booking->customer->email ?? 'N/A'); ?></p>
              </div>
              <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Service Location</p>
                <p class="font-black text-gray-900 text-lg"><?php echo e($booking->location); ?></p>
              </div>
            </div>
          </div>

          <!-- Vehicle Details Card -->
          <div class="bg-white rounded-2xl shadow-md p-8 border-t-4 border-blue-500 hover:shadow-lg transition-shadow">
            <h2 class="text-base font-black text-gray-900 mb-6 uppercase tracking-wider flex items-center justify-center">
              <svg class="w-6 h-6 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              Vehicle
            </h2>
            <div class="space-y-5 text-center">
              <div class="pb-5 border-b border-gray-100">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Make & Model</p>
                <p class="font-black text-gray-900 text-lg"><?php echo e($booking->vehicle_model); ?></p>
              </div>
              <div class="pb-5 border-b border-gray-100">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Registration Number</p>
                <p class="font-black text-gray-900 text-xl bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-3 border-2 border-blue-200"><?php echo e($booking->vehicle_number); ?></p>
              </div>
              <div class="pb-5 border-b border-gray-100">
                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Vehicle Type</p>
                <p class="font-black text-gray-900 text-lg"><?php echo e($booking->vehicle_type); ?></p>
              </div>
              <div>
                <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mb-2">Year of Manufacture</p>
                <p class="font-black text-gray-900 text-lg"><?php echo e($booking->vehicle_year ?? 'N/A'); ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Status Update Form - Full Width, Centered -->
        <div class="bg-white rounded-2xl shadow-md border-t-4 border-orange-500 p-10 hover:shadow-lg transition-shadow max-w-2xl mx-auto w-full">
          <h3 class="font-black text-gray-900 mb-8 uppercase text-base tracking-wider flex items-center justify-center">
            <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Update Service Progress
          </h3>
          <form action="<?php echo e(route('staff.bookings.status', $booking->id)); ?>" method="POST" class="space-y-6" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
              
              <!-- Status Selector -->
              <div>
                  <label class="block text-xs font-black text-gray-600 uppercase tracking-wider mb-3 text-center">Select Status</label>
                  <select name="status" class="w-full px-5 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm font-bold focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all appearance-none outline-none cursor-pointer hover:border-orange-300">
                    <option value="Pending" <?php echo e($booking->status == 'Pending' ? 'selected' : ''); ?> disabled>Pending</option>
                    <option value="In Progress" <?php echo e($booking->status == 'In Progress' ? 'selected' : ''); ?>>In Progress</option>
                    <option value="Waiting for Parts" <?php echo e($booking->status == 'Waiting for Parts' ? 'selected' : ''); ?>>Waiting for Parts</option>
                    <option value="Completed" <?php echo e($booking->status == 'Completed' ? 'selected' : ''); ?>>Completed</option>
                  </select>
              </div>

              <!-- Notes Input -->
              <div>
                  <label class="block text-xs font-black text-gray-600 uppercase tracking-wider mb-3 text-center">Work Notes</label>
                  <textarea name="notes" rows="5" class="w-full px-5 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm font-semibold focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all outline-none resize-none" placeholder="Describe what you've completed..."></textarea>
              </div>

              <!-- File Upload -->
              <div>
                <label class="block text-xs font-black text-gray-600 uppercase tracking-wider mb-3 text-center">Attach Evidence</label>
                <div class="relative">
                  <input type="file" name="attachment" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-5 py-3 bg-gray-50 border-2 border-gray-200 rounded-lg text-sm font-semibold focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:bg-white transition-all outline-none cursor-pointer file:mr-4 file:px-4 file:py-2 file:bg-orange-100 file:text-orange-700 file:font-black file:text-xs file:border-0 file:rounded-md file:cursor-pointer hover:border-orange-300">
                  <p class="text-xs text-gray-500 mt-2 text-center font-bold">JPG, PNG, or PDF • Max 5MB</p>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="w-full px-8 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-black rounded-lg shadow-lg hover:shadow-xl hover:from-orange-600 hover:to-orange-700 transform hover:-translate-y-1 transition-all uppercase text-xs tracking-widest mt-8">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                Post Update
              </button>
          </form>
        </div>

        <!-- Service History Timeline - Full Width -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-10 hover:shadow-lg transition-shadow">
          <h2 class="text-lg font-black text-gray-900 mb-10 flex items-center justify-center">
              <svg class="w-6 h-6 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
              Service History & Updates
          </h2>
          <div class="space-y-8">
              <?php $__empty_1 = true; $__currentLoopData = $booking->logs()->with('user')->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <div class="flex gap-6 relative pb-8">
                      <?php if(!$loop->last): ?>
                          <div class="absolute left-[22px] top-16 bottom-0 w-0.5 bg-gradient-to-b from-gray-300 to-transparent"></div>
                      <?php endif; ?>
                      
                      <!-- Status Badge -->
                      <div class="flex-shrink-0 w-12 h-12 rounded-full <?php echo e($log->status == 'Completed' ? 'bg-green-100 text-green-600 shadow-md' : 'bg-orange-100 text-orange-600 shadow-md'); ?> flex items-center justify-center font-black text-base z-10 flex-shrink-0 ring-4 ring-white">
                          <?php if($log->status == 'Completed'): ?>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                          <?php else: ?>
                            <?php echo e(substr($log->status, 0, 1)); ?>

                          <?php endif; ?>
                      </div>

                      <!-- Content -->
                      <div class="flex-1 min-w-0 pt-1">
                          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-2">
                              <span class="text-base font-black text-gray-900"><?php echo e($log->status); ?></span>
                              <span class="text-xs font-bold text-gray-400"><?php echo e($log->created_at->format('M d, Y')); ?> • <span class="text-gray-600"><?php echo e($log->created_at->format('H:i')); ?></span></span>
                          </div>
                          
                          <?php if($log->notes): ?>
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-lg p-4 mb-4">
                              <p class="text-sm text-gray-700 leading-relaxed"><?php echo e($log->notes); ?></p>
                            </div>
                          <?php endif; ?>

                          <!-- Attachment -->
                          <?php if($log->attachment_path): ?>
                            <div class="mb-4">
                              <a href="<?php echo e(asset('storage/' . $log->attachment_path)); ?>" target="_blank" class="inline-flex items-center gap-3 px-5 py-2 bg-orange-50 border-2 border-orange-200 rounded-lg hover:bg-orange-100 hover:border-orange-300 transition-all shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 text-orange-600" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                <span class="text-xs font-black text-orange-700">View Attachment</span>
                                <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                              </a>
                            </div>
                          <?php endif; ?>

                          <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">By <span class="text-gray-700"><?php echo e($log->user->name ?? 'System'); ?></span></p>
                      </div>
                  </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <div class="text-center py-16">
                      <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                      <p class="text-gray-400 font-bold text-lg">No updates yet</p>
                      <p class="text-gray-400 text-sm mt-1">Start by updating the status above</p>
                  </div>
              <?php endif; ?>
          </div>
        </div>
    </div>
  </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/staff/services/show.blade.php ENDPATH**/ ?>