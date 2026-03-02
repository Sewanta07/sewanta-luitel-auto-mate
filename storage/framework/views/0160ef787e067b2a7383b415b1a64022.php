

<?php $__env->startSection('title', 'Owner Vehicle Listings'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-rol-page">
    <div class="ad-rol-container">
        <div class="ad-rol-head">
            <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="ad-rol-back-link">← Back to Dashboard</a>
            <h1 class="ad-rol-title">Owner Vehicle Listings</h1>
            <p class="ad-rol-subtitle">Approve or reject marketplace listing submissions.</p>
        </div>

        <?php if(session('success')): ?>
            <div class="ad-rol-alert ad-rol-alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="ad-rol-panel">
            <div class="ad-rol-table-wrap">
                <table class="ad-rol-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vehicle</th>
                            <th>Owner</th>
                            <th>Rate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $ownerVehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ownerVehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>#<?php echo e($ownerVehicle->id); ?></td>
                                <td>
                                    <?php echo e($ownerVehicle->vehicle->vehicle_name ?: ($ownerVehicle->vehicle->brand . ' ' . $ownerVehicle->vehicle->model)); ?>

                                    <div class="ad-rol-inline-muted"><?php echo e($ownerVehicle->vehicle->plate_number); ?></div>
                                </td>
                                <td><?php echo e($ownerVehicle->owner->name ?? 'N/A'); ?></td>
                                <td class="ad-rol-strong">Rs. <?php echo e(number_format($ownerVehicle->daily_rate, 2)); ?></td>
                                <td>
                                    <span class="ad-rol-badge <?php echo e($ownerVehicle->approval_status === 'approved' ? 'ad-rol-badge-green' : ($ownerVehicle->approval_status === 'rejected' ? 'ad-rol-badge-red' : 'ad-rol-badge-yellow')); ?>">
                                        <?php echo e(ucfirst($ownerVehicle->approval_status)); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php if($ownerVehicle->approval_status === 'pending'): ?>
                                        <div class="ad-rol-actions-stack">
                                            <form action="<?php echo e(route('admin.owner-vehicles.approval', $ownerVehicle->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="approval_status" value="approved">
                                                <button type="submit" class="ad-rol-btn ad-rol-btn-approve">Approve</button>
                                            </form>
                                            <form action="<?php echo e(route('admin.owner-vehicles.approval', $ownerVehicle->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="approval_status" value="rejected">
                                                <input type="text" name="approval_note" placeholder="Rejection note" class="ad-rol-input" required>
                                                <button type="submit" class="ad-rol-btn ad-rol-btn-reject">Reject</button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <span class="ad-rol-muted">No action</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="ad-rol-empty">No owner vehicle listings found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\rentals\owner-listings.blade.php ENDPATH**/ ?>