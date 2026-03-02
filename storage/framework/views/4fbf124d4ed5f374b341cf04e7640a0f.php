<?php $__env->startSection('content'); ?>
<div class="sf-inv-page">
  <?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main class="sf-inv-main">
    <div class="sf-inv-head">
      <div>
        <h1 class="sf-inv-title">Inventory Management</h1>
        <p class="sf-inv-subtitle">Monitor available parts and stock status</p>
      </div>
      <div class="sf-inv-actions">
        <input type="text" id="searchInput" placeholder="Search parts..." class="sf-inv-search-input">
      </div>
    </div>

    <div class="sf-inv-stats">
      <div class="sf-inv-stat-card">
        <div class="sf-inv-stat-row">
          <div>
            <p class="sf-inv-stat-label">Total Parts</p>
            <p class="sf-inv-stat-value"><?php echo e($stats['total']); ?></p>
          </div>
          <div class="sf-inv-stat-icon sf-inv-stat-icon-blue">
            <svg class="sf-inv-stat-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path></svg>
          </div>
        </div>
      </div>
      <div class="sf-inv-stat-card">
        <div class="sf-inv-stat-row">
          <div>
            <p class="sf-inv-stat-label">Low Stock Alert</p>
            <p class="sf-inv-stat-value sf-inv-stat-value-orange"><?php echo e($stats['low_stock']); ?></p>
          </div>
          <div class="sf-inv-stat-icon sf-inv-stat-icon-orange">
            <svg class="sf-inv-stat-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
        </div>
      </div>
      <div class="sf-inv-stat-card">
        <div class="sf-inv-stat-row">
          <div>
            <p class="sf-inv-stat-label">Out of Stock</p>
            <p class="sf-inv-stat-value sf-inv-stat-value-red"><?php echo e($stats['out_of_stock']); ?></p>
          </div>
          <div class="sf-inv-stat-icon sf-inv-stat-icon-red">
            <svg class="sf-inv-stat-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </div>
        </div>
      </div>
    </div>

    <div class="sf-inv-panel">
      <div class="sf-inv-panel-head">
        <h2 class="sf-inv-panel-title">
          <svg class="sf-inv-panel-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Stock Status Summary
        </h2>
      </div>

      <div class="sf-inv-table-wrap">
        <table class="sf-inv-table">
          <thead class="sf-inv-thead">
            <tr>
              <th class="sf-inv-th">Part Name</th>
              <th class="sf-inv-th">Category</th>
              <th class="sf-inv-th">Stock Level</th>
              <th class="sf-inv-th">Unit Price</th>
              <th class="sf-inv-th">Status</th>
            </tr>
          </thead>
          <tbody class="sf-inv-tbody">
            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <?php
                $stockPercent = $item->minimum_stock > 0 ? min(($item->quantity / $item->minimum_stock) * 100, 100) : 100;
              ?>
              <tr class="sf-inv-row">
                <td class="sf-inv-td">
                  <p class="sf-inv-part-name"><?php echo e($item->part_name); ?></p>
                </td>
                <td class="sf-inv-td">
                  <span class="sf-inv-category-chip"><?php echo e($item->category); ?></span>
                </td>
                <td class="sf-inv-td">
                  <div class="sf-inv-stock-row">
                    <div class="sf-inv-stock-track">
                      <div class="sf-inv-stock-fill <?php echo e($item->stock_status === 'out_of_stock' ? 'sf-inv-stock-fill-red' : ($item->stock_status === 'low_stock' ? 'sf-inv-stock-fill-orange' : 'sf-inv-stock-fill-green')); ?>" style="width: <?php echo e(max(0, min($stockPercent, 100))); ?>%;"></div>
                    </div>
                    <span class="sf-inv-stock-count"><?php echo e($item->quantity); ?>/<?php echo e($item->minimum_stock); ?></span>
                  </div>
                </td>
                <td class="sf-inv-td">
                  <p class="sf-inv-price">Rs. <?php echo e(number_format($item->unit_price, 2)); ?></p>
                </td>
                <td class="sf-inv-td">
                  <?php if($item->status !== 'active'): ?>
                    <div class="sf-inv-badge sf-inv-badge-inactive">
                      <span class="sf-inv-badge-dot sf-inv-badge-dot-gray"></span>
                      <span class="sf-inv-badge-text">Inactive</span>
                    </div>
                  <?php elseif($item->stock_status === 'out_of_stock'): ?>
                    <div class="sf-inv-badge sf-inv-badge-out">
                      <span class="sf-inv-badge-dot sf-inv-badge-dot-red"></span>
                      <span class="sf-inv-badge-text">Out</span>
                    </div>
                  <?php elseif($item->stock_status === 'low_stock'): ?>
                    <div class="sf-inv-badge sf-inv-badge-low">
                      <span class="sf-inv-badge-dot sf-inv-badge-dot-orange"></span>
                      <span class="sf-inv-badge-text">Low</span>
                    </div>
                  <?php else: ?>
                    <div class="sf-inv-badge sf-inv-badge-good">
                      <span class="sf-inv-badge-dot sf-inv-badge-dot-green"></span>
                      <span class="sf-inv-badge-text">Good</span>
                    </div>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="5" class="sf-inv-empty-cell">
                  <svg class="sf-inv-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path></svg>
                  <p class="sf-inv-empty-title">No inventory items found</p>
                  <p class="sf-inv-empty-copy">Check back later for available parts</p>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<script>
document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
  const searchTerm = e.target.value.toLowerCase();
  const rows = document.querySelectorAll('tbody tr');
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    row.style.display = text.includes(searchTerm) ? '' : 'none';
  });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/staff/inventory.blade.php ENDPATH**/ ?>