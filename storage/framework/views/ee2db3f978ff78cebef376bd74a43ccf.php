

<?php $__env->startSection('title', 'Inventory Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
    
    <aside class="w-64 flex-shrink-0 z-30">
        <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    
    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-6xl w-full mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Inventory Reports</h1>
      <a href="<?php echo e(route('admin.inventory.index')); ?>" class="px-4 py-2 rounded-lg border border-gray-200">Back</a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left">
          <thead class="bg-gray-50 text-xs uppercase tracking-widest text-gray-400">
            <tr>
              <th class="px-6 py-3">Date</th>
              <th class="px-6 py-3">Part</th>
              <th class="px-6 py-3">Type</th>
              <th class="px-6 py-3">Qty Change</th>
              <th class="px-6 py-3">Booking</th>
              <th class="px-6 py-3">Notes</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $move): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($move->created_at->format('M d, Y H:i')); ?></td>
                <td class="px-6 py-4 font-semibold text-gray-900"><?php echo e($move->item->part_name ?? 'Unknown'); ?></td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e(ucfirst($move->change_type)); ?></td>
                <td class="px-6 py-4 text-sm <?php echo e($move->quantity_change < 0 ? 'text-red-600' : 'text-green-600'); ?>"><?php echo e($move->quantity_change); ?></td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($move->booking->booking_code ?? '-'); ?></td>
                <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($move->notes); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr><td colspan="6" class="px-6 py-6 text-center text-gray-500">No movements found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\inventory\reports.blade.php ENDPATH**/ ?>