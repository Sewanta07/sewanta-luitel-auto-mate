<?php $__env->startSection('title', 'Inventory Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-inv-page">
    <div class="ad-inv-container">
        <main class="ad-inv-main">
            <!-- Header -->
            <div class="ad-inv-head">
                <div>
                    <h1 class="ad-inv-title">Inventory Management</h1>
                    <p class="ad-inv-subtitle">Monitor and manage spare parts inventory</p>
                </div>
                <div class="ad-inv-head-actions">
                    <a href="<?php echo e(route('admin.inventory.reports')); ?>" class="ad-inv-btn ad-inv-btn-outline">
                        <svg class="ad-inv-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Reports
                    </a>
                    <a href="<?php echo e(route('admin.inventory.create')); ?>" class="ad-inv-btn ad-inv-btn-primary">
                        <svg class="ad-inv-btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Part
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="ad-inv-stats-grid">
                <div class="ad-inv-stat-card">
                    <div class="ad-inv-stat-row">
                        <div>
                            <p class="ad-inv-stat-label">Total Parts</p>
                            <p class="ad-inv-stat-value ad-inv-stat-value-default"><?php echo e($stats['total']); ?></p>
                            <p class="ad-inv-stat-note">Active in inventory</p>
                        </div>
                        <div class="ad-inv-stat-icon-wrap ad-inv-stat-icon-blue">
                            <svg class="ad-inv-stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="ad-inv-stat-card">
                    <div class="ad-inv-stat-row">
                        <div>
                            <p class="ad-inv-stat-label">Low Stock Items</p>
                            <p class="ad-inv-stat-value ad-inv-stat-value-orange"><?php echo e($stats['low_stock']); ?></p>
                            <p class="ad-inv-stat-note">Need restocking soon</p>
                        </div>
                        <div class="ad-inv-stat-icon-wrap ad-inv-stat-icon-orange">
                            <svg class="ad-inv-stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="ad-inv-stat-card">
                    <div class="ad-inv-stat-row">
                        <div>
                            <p class="ad-inv-stat-label">Out of Stock</p>
                            <p class="ad-inv-stat-value ad-inv-stat-value-red"><?php echo e($stats['out_of_stock']); ?></p>
                            <p class="ad-inv-stat-note">Urgent attention needed</p>
                        </div>
                        <div class="ad-inv-stat-icon-wrap ad-inv-stat-icon-red">
                            <svg class="ad-inv-stat-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Table -->
            <div class="ad-inv-panel">
                <!-- Header -->
                <div class="ad-inv-panel-head">
                    <h2 class="ad-inv-panel-title">
                        <svg class="ad-inv-panel-title-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Parts Inventory
                    </h2>
                    <input type="text" id="searchAdmin" placeholder="Search parts..." class="ad-inv-search-input">
                </div>

                <!-- Table -->
                <div class="ad-inv-table-wrap">
                    <table class="ad-inv-table">
                        <thead>
                            <tr>
                                <th>Part Name</th>
                                <th>Category</th>
                                <th>Stock Level</th>
                                <th>Unit Price</th>
                                <th>Status</th>
                                <th class="ad-inv-align-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $stockPercent = max(0, min(($item->quantity / max($item->minimum_stock, 1)) * 100, 100));
                                ?>
                                <tr class="ad-inv-row">
                                    <td>
                                        <p class="ad-inv-part-name"><?php echo e($item->part_name); ?></p>
                                    </td>
                                    <td>
                                        <span class="ad-inv-badge ad-inv-badge-category"><?php echo e($item->category); ?></span>
                                    </td>
                                    <td>
                                        <div class="ad-inv-stock-wrap">
                                            <div class="ad-inv-stock-bar-bg">
                                                <div class="ad-inv-stock-bar-fill <?php echo e($item->stock_status === 'out_of_stock' ? 'ad-inv-stock-fill-red' : ($item->stock_status === 'low_stock' ? 'ad-inv-stock-fill-orange' : 'ad-inv-stock-fill-green')); ?>" style="width: <?php echo e($stockPercent); ?>%;"></div>
                                            </div>
                                            <span class="ad-inv-stock-text"><?php echo e($item->quantity); ?>/<?php echo e($item->minimum_stock); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="ad-inv-price">Rs. <?php echo e(number_format($item->unit_price, 2)); ?></p>
                                    </td>
                                    <td>
                                        <?php if($item->stock_status === 'out_of_stock'): ?>
                                            <div class="ad-inv-status ad-inv-status-red">
                                                <span class="ad-inv-status-dot ad-inv-status-dot-red"></span>
                                                <span class="ad-inv-status-text">Out of Stock</span>
                                            </div>
                                        <?php elseif($item->stock_status === 'low_stock'): ?>
                                            <div class="ad-inv-status ad-inv-status-orange">
                                                <span class="ad-inv-status-dot ad-inv-status-dot-orange"></span>
                                                <span class="ad-inv-status-text">Low Stock</span>
                                            </div>
                                        <?php else: ?>
                                            <div class="ad-inv-status ad-inv-status-green">
                                                <span class="ad-inv-status-dot ad-inv-status-dot-green"></span>
                                                <span class="ad-inv-status-text">In Stock</span>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="ad-inv-align-right">
                                        <div class="ad-inv-actions-row">
                                            <a href="<?php echo e(route('admin.inventory.edit', $item->id)); ?>" class="ad-inv-action-btn ad-inv-action-btn-edit">
                                                <svg class="ad-inv-action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="<?php echo e(route('admin.inventory.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this item? This action cannot be undone.');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="ad-inv-action-btn ad-inv-action-btn-delete">
                                                    <svg class="ad-inv-action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="ad-inv-empty-cell">
                                        <svg class="ad-inv-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path></svg>
                                        <p class="ad-inv-empty-title">No inventory items found</p>
                                        <p class="ad-inv-empty-subtitle">Add your first part to get started</p>
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
document.getElementById('searchAdmin')?.addEventListener('keyup', function(e) {
  const searchTerm = e.target.value.toLowerCase();
  const rows = document.querySelectorAll('tbody tr');
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    row.style.display = text.includes(searchTerm) ? '' : 'none';
  });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/inventory/index.blade.php ENDPATH**/ ?>