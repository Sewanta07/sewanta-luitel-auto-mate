

<?php $__env->startSection('title', 'Owner Payouts'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-rpay-page">
    <div class="ad-rpay-container">
        <div class="ad-rpay-head">
            <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="ad-rpay-back-link">← Back to Dashboard</a>
            <h1 class="ad-rpay-title">Owner Payout Management</h1>
            <p class="ad-rpay-subtitle">Review withdrawal requests and track owner payments.</p>
        </div>

        <?php if(session('success')): ?>
            <div class="ad-rpay-alert ad-rpay-alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="ad-rpay-alert ad-rpay-alert-error"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        
        <div class="ad-rpay-panel ad-rpay-mb-8">
            <div class="ad-rpay-section-head ad-rpay-section-head-blue">
                <h2 class="ad-rpay-section-title">Withdrawal Requests</h2>
                <p class="ad-rpay-section-subtitle">Process owner payout requests</p>
            </div>
            <div class="ad-rpay-table-wrap">
                <table class="ad-rpay-table">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Owner</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Requested</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $withdrawalRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="<?php echo e($request->status === 'pending' ? 'ad-rpay-row-pending' : ''); ?>">
                                <td class="ad-rpay-strong">#<?php echo e($request->id); ?></td>
                                <td>
                                    <div class="ad-rpay-owner-name"><?php echo e($request->owner->name ?? 'N/A'); ?></div>
                                    <div class="ad-rpay-inline-muted"><?php echo e($request->owner->email ?? ''); ?></div>
                                </td>
                                <td class="ad-rpay-amount">Rs. <?php echo e(number_format($request->amount, 2)); ?></td>
                                <td class="ad-rpay-note"><?php echo e($request->note ?: '-'); ?></td>
                                <td class="ad-rpay-date"><?php echo e($request->requested_at->format('M d, Y')); ?></td>
                                <td>
                                    <span class="ad-rpay-badge 
                                        <?php if($request->status === 'paid'): ?> ad-rpay-badge-green
                                        <?php elseif($request->status === 'approved'): ?> ad-rpay-badge-blue
                                        <?php elseif($request->status === 'rejected'): ?> ad-rpay-badge-red
                                        <?php else: ?> ad-rpay-badge-yellow
                                        <?php endif; ?>">
                                        <?php echo e(ucfirst($request->status)); ?>

                                    </span>
                                    <?php if($request->processed_at): ?>
                                        <div class="ad-rpay-inline-muted ad-rpay-mt-1"><?php echo e($request->processed_at->format('M d, Y')); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($request->status === 'pending'): ?>
                                        <div class="ad-rpay-actions-inline">
                                            <form action="<?php echo e(route('admin.withdrawals.process', $request->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status" value="paid">
                                                <button type="submit" class="ad-rpay-btn ad-rpay-btn-pay">Mark Paid</button>
                                            </form>
                                            <form action="<?php echo e(route('admin.withdrawals.process', $request->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="ad-rpay-btn ad-rpay-btn-reject">Reject</button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <span class="ad-rpay-inline-muted"><?php echo e(ucfirst($request->status)); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="ad-rpay-empty">No withdrawal requests.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="ad-rpay-panel">
            <div class="ad-rpay-section-head ad-rpay-section-head-gray">
                <h2 class="ad-rpay-section-title">All Earnings Records</h2>
                <p class="ad-rpay-section-subtitle">Individual rental earnings and commission breakdown</p>
            </div>
            <div class="ad-rpay-table-wrap">
                <table class="ad-rpay-table">
                    <thead>
                        <tr>
                            <th>Rental</th>
                            <th>Vehicle</th>
                            <th>Owner</th>
                            <th>Total Amount</th>
                            <th>Commission</th>
                            <th>Owner Payout</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $earnings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $earning): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>#<?php echo e($earning->rental_id); ?></td>
                                <td>
                                    <?php if($earning->rental && $earning->rental->vehicle): ?>
                                        <?php echo e($earning->rental->vehicle->vehicle_name ?: ($earning->rental->vehicle->brand . ' ' . $earning->rental->vehicle->model)); ?>

                                        <br>
                                        <span class="ad-rpay-inline-muted"><?php echo e($earning->rental->vehicle->plate_number); ?></span>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($earning->owner->name ?? 'N/A'); ?></td>
                                <td class="ad-rpay-strong">Rs. <?php echo e(number_format($earning->rental->total_amount ?? 0, 2)); ?></td>
                                <td class="ad-rpay-commission">Rs. <?php echo e(number_format($earning->commission, 2)); ?></td>
                                <td class="ad-rpay-owner-amount">Rs. <?php echo e(number_format($earning->owner_amount, 2)); ?></td>
                                <td>
                                    <span class="ad-rpay-badge <?php echo e($earning->payout_status === 'paid' ? 'ad-rpay-badge-green' : 'ad-rpay-badge-yellow'); ?>">
                                        <?php echo e(ucfirst($earning->payout_status)); ?>

                                    </span>
                                    <?php if($earning->payout_status === 'paid' && $earning->paid_out_at): ?>
                                        <div class="ad-rpay-inline-muted ad-rpay-mt-1"><?php echo e($earning->paid_out_at->format('M d, Y')); ?></div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="ad-rpay-empty">No earnings records found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/rentals/payouts.blade.php ENDPATH**/ ?>