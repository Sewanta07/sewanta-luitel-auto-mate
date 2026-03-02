

<?php $__env->startSection('title', 'Inventory Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-invr-page">
    <div class="ad-invr-container">
        <main class="ad-invr-main">
    <div class="ad-invr-head">
      <h1 class="ad-invr-title">Inventory Reports</h1>
      <a href="<?php echo e(route('admin.inventory.index')); ?>" class="ad-invr-btn ad-invr-btn-ghost">Back</a>
    </div>

    <div class="ad-invr-panel">
      <div class="ad-invr-table-wrap">
        <table class="ad-invr-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Part</th>
              <th>Type</th>
              <th>Qty Change</th>
              <th>Booking</th>
              <th>Notes</th>
            </tr>
          </thead>
          <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $move): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr>
                <td class="ad-invr-muted"><?php echo e($move->created_at->format('M d, Y H:i')); ?></td>
                <td class="ad-invr-strong"><?php echo e($move->item->part_name ?? 'Unknown'); ?></td>
                <td class="ad-invr-muted"><?php echo e(ucfirst($move->change_type)); ?></td>
                <td class="<?php echo e($move->quantity_change < 0 ? 'ad-invr-text-red' : 'ad-invr-text-green'); ?>"><?php echo e($move->quantity_change); ?></td>
                <td class="ad-invr-muted"><?php echo e($move->booking->booking_code ?? '-'); ?></td>
                <td class="ad-invr-muted"><?php echo e($move->notes); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr><td colspan="6" class="ad-invr-empty">No movements found.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
        </main>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\inventory\reports.blade.php ENDPATH**/ ?>