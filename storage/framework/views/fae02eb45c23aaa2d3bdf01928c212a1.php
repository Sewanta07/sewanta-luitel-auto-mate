

<?php $__env->startSection('title', 'Pending Vehicle Listings'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4 font-semibold transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Pending Vehicle Listings</h1>
        <p class="text-gray-600">Review and approve customer vehicles for rental</p>
    </div>

    <?php if(session('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <?php if($vehicle->image_path): ?>
            <img src="<?php echo e(asset('storage/' . $vehicle->image_path)); ?>" alt="Vehicle" class="w-full h-48 object-cover">
            <?php else: ?>
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            </div>
            <?php endif; ?>
            
            <div class="p-5">
                <h3 class="text-xl font-semibold text-gray-800 mb-2"><?php echo e($vehicle->vehicle_name); ?></h3>
                <p class="text-gray-600 text-sm mb-4"><?php echo e($vehicle->brand); ?> <?php echo e($vehicle->model); ?> (<?php echo e($vehicle->year); ?>)</p>
                
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Owner:</span>
                        <span class="font-medium text-gray-800"><?php echo e($vehicle->customer->name); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Type:</span>
                        <span class="font-medium text-gray-800"><?php echo e($vehicle->vehicle_type); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Daily Rate:</span>
                        <span class="font-bold text-blue-600">Rs. <?php echo e(number_format($vehicle->daily_rate, 2)); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Plate Number:</span>
                        <span class="font-medium text-gray-800"><?php echo e($vehicle->plate_number); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Submitted:</span>
                        <span class="text-gray-600"><?php echo e($vehicle->created_at->diffForHumans()); ?></span>
                    </div>
                </div>

                <div class="flex gap-2">
                    <form action="<?php echo e(route('admin.rentals.pending-listings.approve', $vehicle)); ?>" method="POST" class="flex-1">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                            ✓ Approve
                        </button>
                    </form>
                    <button onclick="rejectVehicle(<?php echo e($vehicle->id); ?>)" 
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition">
                        ✗ Reject
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-3 text-center py-12">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-gray-500 text-lg">No pending vehicle listings</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg max-w-md w-full">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Reject Vehicle Listing</h2>
        </div>
        
        <form id="rejectForm" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Rejection Reason *</label>
                <textarea name="rejection_reason" required rows="4" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                          placeholder="Explain why this vehicle cannot be listed for rent..."></textarea>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Reject Listing
                </button>
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" 
                        class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function rejectVehicle(vehicleId) {
    document.getElementById('rejectForm').action = `/admin/rentals/pending-listings/${vehicleId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/rentals/pending-listings.blade.php ENDPATH**/ ?>