

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <main class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">My Rentals</h1>
      <p class="text-gray-500 mt-1">Track vehicles you've rented and view rental history.</p>
    </div>

    <?php if(session('success')): ?>
      <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center animate-fade-in">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    
    <?php if(isset($requests) && $requests->count() > 0): ?>
      <h2 class="text-xl font-bold text-gray-800 mb-4">Rental Requests</h2>
      <div class="space-y-4 mb-8">
        <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
              <div class="flex-1">
                <div class="flex items-center gap-3 mb-3">
                  <h3 class="text-lg font-bold text-gray-900">
                    <?php echo e($request->vehicle?->vehicle_name ?: ($request->vehicle?->brand . ' ' . $request->vehicle?->model)); ?>

                  </h3>
                  <span class="px-3 py-1 rounded-full text-xs font-bold
                    <?php if($request->status === 'Approved' || $request->status === 'Ready for Pickup' || $request->status === 'Picked Up'): ?> bg-blue-100 text-blue-700
                    <?php elseif($request->status === 'In Use'): ?> bg-green-100 text-green-700
                    <?php elseif($request->status === 'Returned'): ?> bg-purple-100 text-purple-700
                    <?php elseif($request->status === 'Completed'): ?> bg-gray-200 text-gray-700
                    <?php elseif($request->status === 'Rejected'): ?> bg-red-100 text-red-700
                    <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>">
                    <?php echo e($request->status); ?>

                  </span>
                </div>

                <p class="text-sm text-gray-500 mb-2"><?php echo e($request->vehicle?->plate_number); ?></p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-3">
                  <div>
                    <p class="text-xs text-gray-500">Duration</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($request->number_of_days ?? 0); ?> days</p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500">Start Date</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($request->start_date ? $request->start_date->format('M d, Y') : 'N/A'); ?></p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500">End Date</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($request->end_date ? $request->end_date->format('M d, Y') : 'N/A'); ?></p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500">Total Cost</p>
                    <p class="text-sm font-bold text-orange-600">Rs. <?php echo e(number_format($request->total_cost ?? 0, 2)); ?></p>
                  </div>
                </div>

                <?php if($request->assignedStaff): ?>
                  <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 mb-3">
                    <p class="text-xs font-bold text-blue-700 mb-1">Assigned Staff</p>
                    <p class="text-sm text-blue-900"><?php echo e($request->assignedStaff->user->name ?? 'N/A'); ?></p>
                  </div>
                <?php endif; ?>

                <?php if($request->has_damage): ?>
                  <div class="bg-red-50 border border-red-100 rounded-lg p-3 mb-3">
                    <p class="text-xs font-bold text-red-700 mb-1">Damage Reported</p>
                    <p class="text-sm text-red-900">Charge: Rs. <?php echo e(number_format($request->damage_charge ?? 0, 2)); ?></p>
                    <p class="text-xs text-red-700 mt-1">Payment: <?php echo e($request->damage_payment_status ?? 'Unpaid'); ?></p>
                    <?php if($request->damage_description): ?>
                      <p class="text-xs text-gray-600 mt-2"><?php echo e($request->damage_description); ?></p>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>

                <div class="flex items-center gap-2 text-xs text-gray-500">
                  <span>Payment: <span class="font-bold <?php echo e($request->payment_status === 'Paid' ? 'text-green-600' : 'text-orange-600'); ?>"><?php echo e($request->payment_status); ?></span></span>
                  <?php if($request->owner): ?>
                    <span>•</span>
                    <span>Owner: <?php echo e($request->owner->name ?? 'AutoMate'); ?></span>
                  <?php endif; ?>
                </div>
              </div>

              <div class="flex flex-col gap-2 ml-4">
                <?php if($request->status === 'Approved' && $request->payment_status !== 'Paid'): ?>
                  <form action="<?php echo e(route('payments.rental-requests.pay', $request->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-4 py-2 rounded-lg text-sm font-bold bg-orange-500 text-white hover:bg-orange-600 transition">Pay Now</button>
                  </form>
                <?php endif; ?>
                <?php if(strtolower((string) ($request->payment_status ?? '')) === 'paid' && isset($requestPaymentIds[$request->id])): ?>
                  <a href="<?php echo e(route('payments.receipt', $requestPaymentIds[$request->id])); ?>" class="px-4 py-2 rounded-lg text-sm font-bold bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-center">View Receipt</a>
                <?php endif; ?>
                <?php if($request->status === 'Returned' && $request->has_damage && ($request->damage_payment_status ?? 'Unpaid') !== 'Paid'): ?>
                  <form action="<?php echo e(route('payments.rental-requests.damage-pay', $request->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-4 py-2 rounded-lg text-sm font-bold bg-red-500 text-white hover:bg-red-600 transition">Pay Damage</button>
                  </form>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>

    
    <?php if(isset($rentals) && $rentals->count() > 0): ?>
      <h2 class="text-xl font-bold text-gray-800 mb-4">Marketplace Rentals</h2>
      <div class="space-y-4">
        <?php $__currentLoopData = $rentals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="bg-white rounded-2xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between">
              <div class="flex-1">
                <div class="flex items-center gap-3 mb-3">
                  <h3 class="text-lg font-bold text-gray-900">
                    <?php echo e($rental->vehicle?->vehicle_name ?: ($rental->vehicle?->brand . ' ' . $rental->vehicle?->model)); ?>

                  </h3>
                  <span class="px-3 py-1 rounded-full text-xs font-bold
                    <?php if($rental->status === 'confirmed'): ?> bg-green-100 text-green-700
                    <?php elseif($rental->status === 'completed'): ?> bg-gray-200 text-gray-700
                    <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>">
                    <?php echo e(ucfirst($rental->status)); ?>

                  </span>
                </div>

                <p class="text-sm text-gray-500 mb-2"><?php echo e($rental->vehicle?->plate_number); ?></p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-3">
                  <div>
                    <p class="text-xs text-gray-500">Duration</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($rental->number_of_days ?? 0); ?> days</p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500">Start Date</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($rental->start_date ? $rental->start_date->format('M d, Y') : 'N/A'); ?></p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500">End Date</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($rental->end_date ? $rental->end_date->format('M d, Y') : 'N/A'); ?></p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500">Total Amount</p>
                    <p class="text-sm font-bold text-orange-600">Rs. <?php echo e(number_format($rental->total_amount, 2)); ?></p>
                  </div>
                </div>

                <?php if($rental->damage_charge && $rental->damage_charge > 0): ?>
                  <div class="bg-red-50 border border-red-100 rounded-lg p-3 mb-3">
                    <p class="text-xs font-bold text-red-700 mb-1">Damage Charge</p>
                    <p class="text-sm text-red-900">Rs. <?php echo e(number_format($rental->damage_charge, 2)); ?></p>
                    <?php if($rental->damage_notes): ?>
                      <p class="text-xs text-gray-600 mt-1"><?php echo e($rental->damage_notes); ?></p>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>

                <div class="flex items-center gap-2 text-xs text-gray-500">
                  <span>Payment: <span class="font-bold text-green-600"><?php echo e(ucfirst($rental->payment_status ?? 'Paid')); ?></span></span>
                  <?php if($rental->owner): ?>
                    <span>•</span>
                    <span>Owner: <?php echo e($rental->owner->name); ?></span>
                  <?php endif; ?>
                </div>
              </div>

              <div class="flex flex-col gap-2 ml-4">
                <?php if($rental->payment_status !== 'paid'): ?>
                  <form action="<?php echo e(route('payments.rentals.pay', $rental->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-4 py-2 rounded-lg text-sm font-bold bg-orange-500 text-white hover:bg-orange-600 transition">Pay Now</button>
                  </form>
                <?php elseif(isset($rentalPaymentIds[$rental->id])): ?>
                  <a href="<?php echo e(route('payments.receipt', $rentalPaymentIds[$rental->id])); ?>" class="px-4 py-2 rounded-lg text-sm font-bold bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-center">View Receipt</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>

    <?php if((!isset($requests) || $requests->count() === 0) && (!isset($rentals) || $rentals->count() === 0)): ?>
      <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path></svg>
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