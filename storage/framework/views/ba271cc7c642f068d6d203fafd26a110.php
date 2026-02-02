

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <main class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Payment History</h1>
      <p class="text-gray-500 mt-1">View all your past transactions and invoices</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-sm text-gray-500">Total Spent</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">Rs. <?php echo e(number_format($totalSpent, 2)); ?></p>
      </div>
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-sm text-gray-500">This Month</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">Rs. <?php echo e(number_format($thisMonthSpent, 2)); ?></p>
      </div>
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-sm text-gray-500">Last Payment</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">Rs. <?php echo e(number_format($lastPayment, 2)); ?></p>
      </div>
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-sm text-gray-500">Total Transactions</p>
        <p class="text-2xl font-bold text-gray-900 mt-1"><?php echo e($totalTransactions); ?></p>
      </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
      <div class="flex flex-wrap gap-4 items-center">
        <div class="flex-1 min-w-[200px]">
          <input type="text" placeholder="Search..." class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <select class="px-4 py-2 border border-gray-300 rounded-lg">
          <option>All Time</option>
          <option>This Month</option>
        </select>
      </div>
    </div>

    <!-- Payment History Table -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
      <?php if($bookings->count() > 0): ?>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Invoice</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Date</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Service</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Amount</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
              <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-medium">#INV-<?php echo e($booking->id); ?>-<?php echo e($booking->created_at->format('md')); ?></td>
                <td class="px-6 py-4 text-sm text-gray-500"><?php echo e($booking->updated_at->format('M d, Y')); ?></td>
                <td class="px-6 py-4 text-sm"><?php echo e($booking->service_type ?? 'Service'); ?></td>
                <td class="px-6 py-4 text-sm font-semibold">Rs. <?php echo e(number_format($booking->estimated_cost, 2)); ?></td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                </td>
                <td class="px-6 py-4 text-right text-sm">
                  <a href="<?php echo e(route('bookings.invoice', $booking->id)); ?>" class="text-orange-600 font-semibold hover:text-orange-700">View</a>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="p-12 text-center">
          <div class="w-16 h-16 rounded-full bg-gray-100 mx-auto mb-4 flex items-center justify-center">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <p class="text-gray-600 font-medium">No payment history yet</p>
          <p class="text-sm text-gray-500 mt-1">Your completed services will appear here</p>
          <a href="<?php echo e(route('bookings.create')); ?>" class="mt-4 inline-flex items-center px-4 py-2 text-white rounded-lg text-sm font-medium" style="background-color: #ff5a1f;" onmouseover="this.style.backgroundColor='#e64b15'" onmouseout="this.style.backgroundColor='#ff5a1f'">Request a Service</a>
        </div>
      <?php endif; ?>
    </div>
  </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/payment-history.blade.php ENDPATH**/ ?>