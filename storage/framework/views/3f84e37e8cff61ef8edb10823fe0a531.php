

<?php $__env->startSection('title', 'Edit Inventory Item'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
    
    <aside class="w-64 flex-shrink-0 z-30">
        <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    
    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-4xl w-full mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Inventory Item</h1>

    <form action="<?php echo e(route('admin.inventory.update', $item->id)); ?>" method="POST" class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      <div>
        <label class="block text-sm font-semibold text-gray-700">Part Name</label>
        <input type="text" name="part_name" value="<?php echo e($item->part_name); ?>" required class="mt-1 w-full rounded-lg border-gray-200" />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700">Category</label>
        <input type="text" name="category" value="<?php echo e($item->category); ?>" required class="mt-1 w-full rounded-lg border-gray-200" />
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-semibold text-gray-700">Unit Price</label>
          <input type="number" step="0.01" name="unit_price" value="<?php echo e($item->unit_price); ?>" required class="mt-1 w-full rounded-lg border-gray-200" />
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700">Quantity</label>
          <input type="number" name="quantity" value="<?php echo e($item->quantity); ?>" required class="mt-1 w-full rounded-lg border-gray-200" />
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700">Minimum Stock</label>
          <input type="number" name="minimum_stock" value="<?php echo e($item->minimum_stock); ?>" required class="mt-1 w-full rounded-lg border-gray-200" />
        </div>
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700">Supplier (optional)</label>
        <input type="text" name="supplier" value="<?php echo e($item->supplier); ?>" class="mt-1 w-full rounded-lg border-gray-200" />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700">Status</label>
        <select name="status" class="mt-1 w-full rounded-lg border-gray-200">
          <option value="active" <?php echo e($item->status === 'active' ? 'selected' : ''); ?>>Active</option>
          <option value="inactive" <?php echo e($item->status === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
        </select>
      </div>
      <div class="flex gap-3">
        <a href="<?php echo e(route('admin.inventory.index')); ?>" class="px-4 py-2 rounded-lg border border-gray-200">Cancel</a>
        <button type="submit" class="px-4 py-2 rounded-lg bg-[#ff5a1f] text-white">Update</button>
      </div>
    </form>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\inventory\edit.blade.php ENDPATH**/ ?>