

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <main class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">My Rentals</h1>
      <p class="text-gray-500 mt-1">Track vehicles you've rented from other users.</p>
    </div>

    <?php if(session('success')): ?>
      <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center animate-fade-in">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <?php if(isset($requests) && $requests->count() > 0): ?>
      <div class="space-y-4">
        <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="bg-white rounded-2xl border border-gray-100 p-6 flex items-center justify-between">
            <div>
              <h3 class="text-lg font-bold text-gray-900">
                <?php echo e($request->vehicle?->vehicle_name ?: ($request->vehicle?->brand . ' ' . $request->vehicle?->model)); ?>

              </h3>
              <p class="text-sm text-gray-500 mt-1"><?php echo e($request->vehicle?->plate_number); ?></p>
              <p class="text-xs text-gray-400 mt-1">
                <?php echo e($request->start_date ? 'From ' . $request->start_date : 'Start date: N/A'); ?> • <?php echo e($request->end_date ? 'To ' . $request->end_date : 'End date: N/A'); ?>

              </p>
              <p class="text-xs text-gray-400 mt-1">Total: <?php echo e($request->total_cost !== null ? 'Rs. ' . number_format($request->total_cost, 2) : 'N/A'); ?> • Payment: <?php echo e($request->payment_status); ?></p>
            </div>
            <div class="flex items-center gap-3">
              <span class="px-3 py-1 rounded-full text-xs font-bold
                <?php if($request->status === 'Approved'): ?> bg-green-100 text-green-700
                <?php elseif($request->status === 'Rejected'): ?> bg-red-100 text-red-700
                <?php elseif($request->status === 'Completed'): ?> bg-gray-200 text-gray-700
                <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>">
                <?php echo e($request->status); ?>

              </span>
              <?php if($request->status === 'Approved' && $request->payment_status !== 'Paid'): ?>
                <form action="<?php echo e(route('rentals.pay', $request->id)); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="px-3 py-1 rounded-lg text-xs font-bold bg-orange-100 text-orange-700 hover:bg-orange-200">Pay Now</button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php else: ?>
      <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
        <h3 class="text-xl font-semibold text-gray-900">No rentals yet</h3>
        <p class="text-gray-500 mt-2">When you rent a vehicle, it will appear here.</p>
        <a href="<?php echo e(route('customer.rent-vehicles')); ?>" class="inline-flex items-center mt-6 px-6 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition">
          Browse Rent Vehicles
        </a>
      </div>
    <?php endif; ?>
  </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/rentals.blade.php ENDPATH**/ ?>