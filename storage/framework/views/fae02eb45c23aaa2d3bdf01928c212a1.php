<?php $__env->startSection('title', 'Pending Vehicle Listings'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-rpen-page">
    <div class="ad-rpen-container">
    <div class="ad-rpen-back-wrap">
        <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="ad-rpen-back-link">
            <svg class="ad-rpen-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
    <div class="ad-rpen-head">
        <h1 class="ad-rpen-title">Pending Vehicle Listings</h1>
        <p class="ad-rpen-subtitle">Review and approve customer vehicles for rental</p>
    </div>

    <?php if(session('success')): ?>
    <div class="ad-rpen-alert ad-rpen-alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <div class="ad-rpen-grid">
        <?php $__empty_1 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="ad-rpen-card">
            <?php if($vehicle->image_path): ?>
            <img src="<?php echo e(asset('storage/' . $vehicle->image_path)); ?>" alt="Vehicle" class="ad-rpen-image">
            <?php else: ?>
            <div class="ad-rpen-image-placeholder">
                <svg class="ad-rpen-image-placeholder-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            </div>
            <?php endif; ?>
            
            <div class="ad-rpen-card-body">
                <h3 class="ad-rpen-card-title"><?php echo e($vehicle->vehicle_name); ?></h3>
                <p class="ad-rpen-card-subtitle"><?php echo e($vehicle->brand); ?> <?php echo e($vehicle->model); ?> (<?php echo e($vehicle->year); ?>)</p>
                
                <div class="ad-rpen-details">
                    <div class="ad-rpen-detail-row">
                        <span class="ad-rpen-detail-label">Owner:</span>
                        <span class="ad-rpen-detail-value"><?php echo e($vehicle->customer->name); ?></span>
                    </div>
                    <div class="ad-rpen-detail-row">
                        <span class="ad-rpen-detail-label">Type:</span>
                        <span class="ad-rpen-detail-value"><?php echo e($vehicle->vehicle_type); ?></span>
                    </div>
                    <div class="ad-rpen-detail-row">
                        <span class="ad-rpen-detail-label">Daily Rate:</span>
                        <span class="ad-rpen-detail-value ad-rpen-detail-value-blue">Rs. <?php echo e(number_format($vehicle->daily_rate, 2)); ?></span>
                    </div>
                    <div class="ad-rpen-detail-row">
                        <span class="ad-rpen-detail-label">Plate Number:</span>
                        <span class="ad-rpen-detail-value"><?php echo e($vehicle->plate_number); ?></span>
                    </div>
                    <div class="ad-rpen-detail-row">
                        <span class="ad-rpen-detail-label">Submitted:</span>
                        <span class="ad-rpen-submitted"><?php echo e($vehicle->created_at->diffForHumans()); ?></span>
                    </div>
                </div>

                <div class="ad-rpen-actions-row">
                    <form action="<?php echo e(route('admin.rentals.pending-listings.approve', $vehicle)); ?>" method="POST" class="ad-rpen-form-grow">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="ad-rpen-btn ad-rpen-btn-approve ad-rpen-btn-full">
                            ✓ Approve
                        </button>
                    </form>
                    <button onclick="rejectVehicle(<?php echo e($vehicle->id); ?>)" 
                            class="ad-rpen-btn ad-rpen-btn-reject ad-rpen-btn-grow">
                        ✗ Reject
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="ad-rpen-empty">
            <svg class="ad-rpen-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="ad-rpen-empty-text">No pending vehicle listings</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="ad-rpen-modal-overlay ad-hidden">
    <div class="ad-rpen-modal">
        <div class="ad-rpen-modal-head">
            <h2 class="ad-rpen-modal-title">Reject Vehicle Listing</h2>
        </div>
        
        <form id="rejectForm" method="POST" class="ad-rpen-modal-form">
            <?php echo csrf_field(); ?>
            <div class="ad-rpen-field">
                <label class="ad-rpen-label">Rejection Reason *</label>
                <textarea name="rejection_reason" required rows="4" 
                          class="ad-rpen-input"
                          placeholder="Explain why this vehicle cannot be listed for rent..."></textarea>
            </div>
            
            <div class="ad-rpen-modal-actions">
                <button type="submit" class="ad-rpen-btn ad-rpen-btn-reject-strong ad-rpen-btn-grow ad-rpen-btn-lg">
                    Reject Listing
                </button>
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('ad-hidden')" 
                        class="ad-rpen-btn ad-rpen-btn-ghost ad-rpen-btn-lg">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function rejectVehicle(vehicleId) {
    document.getElementById('rejectForm').action = `/admin/rentals/pending-listings/${vehicleId}/reject`;
    document.getElementById('rejectModal').classList.remove('ad-hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/rentals/pending-listings.blade.php ENDPATH**/ ?>