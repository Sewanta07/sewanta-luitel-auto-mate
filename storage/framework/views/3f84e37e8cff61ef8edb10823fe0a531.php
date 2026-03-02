

<?php $__env->startSection('title', 'Edit Inventory Item'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-inve-page">
    <div class="ad-inve-container">
        <main class="ad-inve-main">
    <h1 class="ad-inve-title">Edit Inventory Item</h1>

    <form action="<?php echo e(route('admin.inventory.update', $item->id)); ?>" method="POST" class="ad-inve-form">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      <div class="ad-inve-field">
        <label class="ad-inve-label">Part Name</label>
        <input type="text" name="part_name" value="<?php echo e($item->part_name); ?>" required class="ad-inve-input" />
      </div>
      <div class="ad-inve-field">
        <label class="ad-inve-label">Category</label>
        <input type="text" name="category" value="<?php echo e($item->category); ?>" required class="ad-inve-input" />
      </div>
      <div class="ad-inve-grid-3">
        <div class="ad-inve-field">
          <label class="ad-inve-label">Unit Price</label>
          <input type="number" step="0.01" name="unit_price" value="<?php echo e($item->unit_price); ?>" required class="ad-inve-input" />
        </div>
        <div class="ad-inve-field">
          <label class="ad-inve-label">Quantity</label>
          <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" required class="ad-inve-input" />
        </div>
        <div class="ad-inve-field">
          <label class="ad-inve-label">Minimum Stock</label>
          <input type="number" name="minimum_stock" value="<?php echo e($item->minimum_stock); ?>" required class="ad-inve-input" />
        </div>
      </div>
      <div class="ad-inve-field">
        <label class="ad-inve-label">Supplier (optional)</label>
        <input type="text" name="supplier" value="<?php echo e($item->supplier); ?>" class="ad-inve-input" />
      </div>
      <div class="ad-inve-field">
        <label class="ad-inve-label">Status</label>
        <select name="status" class="ad-inve-input">
          <option value="active" <?php echo e($item->status === 'active' ? 'selected' : ''); ?>>Active</option>
          <option value="inactive" <?php echo e($item->status === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
        </select>
      </div>
      <div class="ad-inve-actions">
        <a href="<?php echo e(route('admin.inventory.index')); ?>" class="ad-inve-btn ad-inve-btn-ghost">Cancel</a>
        <button type="submit" class="ad-inve-btn ad-inve-btn-primary">Update</button>
      </div>
    </form>
        </main>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\inventory\edit.blade.php ENDPATH**/ ?>