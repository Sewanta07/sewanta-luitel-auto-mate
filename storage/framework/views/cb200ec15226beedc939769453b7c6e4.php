

<?php $__env->startSection('title', 'Inventory Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
    
    <aside class="w-64 flex-shrink-0 z-30">
        <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    
    <div class="flex-1 flex flex-col overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 h-full w-full">
        <main class="max-w-7xl w-full mx-auto p-6 space-y-8">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-black text-gray-900">Inventory Management</h1>
                    <p class="text-gray-600 font-medium mt-2">Monitor and manage spare parts inventory</p>
                </div>
                <div class="flex gap-3">
                    <a href="<?php echo e(route('admin.inventory.reports')); ?>" class="px-4 py-3 rounded-lg border-2 border-gray-300 text-gray-700 hover:border-orange-500 hover:text-orange-600 transition font-bold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Reports
                    </a>
                    <a href="<?php echo e(route('admin.inventory.create')); ?>" class="px-4 py-3 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 text-white hover:shadow-lg transition font-bold flex items-center gap-2 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Part
                    </a>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-md hover:shadow-lg transition-shadow transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Total Parts</p>
                            <p class="text-3xl font-black text-gray-900 mt-2"><?php echo e($stats['total']); ?></p>
                            <p class="text-xs text-gray-500 mt-2">Active in inventory</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-md hover:shadow-lg transition-shadow transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Low Stock Items</p>
                            <p class="text-3xl font-black text-orange-600 mt-2"><?php echo e($stats['low_stock']); ?></p>
                            <p class="text-xs text-gray-500 mt-2">Need restocking soon</p>
                        </div>
                        <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-md hover:shadow-lg transition-shadow transform hover:-translate-y-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Out of Stock</p>
                            <p class="text-3xl font-black text-red-600 mt-2"><?php echo e($stats['out_of_stock']); ?></p>
                            <p class="text-xs text-gray-500 mt-2">Urgent attention needed</p>
                        </div>
                        <div class="w-14 h-14 bg-red-50 rounded-xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inventory Table -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-md overflow-hidden">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                    <h2 class="text-lg font-black text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Parts Inventory
                    </h2>
                    <input type="text" id="searchAdmin" placeholder="Search parts..." class="px-3 py-2 rounded-lg border border-gray-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 w-64 text-sm font-medium outline-none transition">
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Part Name</th>
                                <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Stock Level</th>
                                <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Unit Price</th>
                                <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-gray-900 group-hover:text-orange-600"><?php echo e($item->part_name); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold"><?php echo e($item->category); ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-20 bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-gradient-to-r <?php echo e($item->stock_status === 'out_of_stock' ? 'from-red-500 to-red-600' : ($item->stock_status === 'low_stock' ? 'from-orange-500 to-orange-600' : 'from-green-500 to-green-600')); ?> h-2.5 rounded-full" style="width: <?php echo e(min(($item->quantity / max($item->minimum_stock, 1)) * 100, 100)); ?>%"></div>
                                            </div>
                                            <span class="text-sm font-bold text-gray-900 whitespace-nowrap"><?php echo e($item->quantity); ?>/<?php echo e($item->minimum_stock); ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-gray-900">Rs. <?php echo e(number_format($item->unit_price, 2)); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($item->stock_status === 'out_of_stock'): ?>
                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-red-50 border border-red-200">
                                                <span class="w-2.5 h-2.5 bg-red-600 rounded-full"></span>
                                                <span class="text-xs font-black text-red-700 uppercase tracking-wider">Out of Stock</span>
                                            </div>
                                        <?php elseif($item->stock_status === 'low_stock'): ?>
                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-orange-50 border border-orange-200">
                                                <span class="w-2.5 h-2.5 bg-orange-600 rounded-full animate-pulse"></span>
                                                <span class="text-xs font-black text-orange-700 uppercase tracking-wider">Low Stock</span>
                                            </div>
                                        <?php else: ?>
                                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-green-50 border border-green-200">
                                                <span class="w-2.5 h-2.5 bg-green-600 rounded-full"></span>
                                                <span class="text-xs font-black text-green-700 uppercase tracking-wider">In Stock</span>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="<?php echo e(route('admin.inventory.edit', $item->id)); ?>" class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-orange-50 text-orange-600 hover:bg-orange-100 transition font-bold text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="<?php echo e(route('admin.inventory.destroy', $item->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to deactivate this item?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition font-bold text-sm">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path></svg>
                                        <p class="text-gray-500 font-bold text-lg">No inventory items found</p>
                                        <p class="text-gray-400 text-sm mt-1">Add your first part to get started</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\inventory\index.blade.php ENDPATH**/ ?>