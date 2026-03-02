<?php $__env->startSection('title', 'Rental Requests'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-rreq-page">
    <div class="ad-rreq-container">
    <div class="ad-rreq-back-wrap">
        <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="ad-rreq-back-link">
            <svg class="ad-rreq-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
    <div class="ad-rreq-head">
        <h1 class="ad-rreq-title">Rental Requests Management</h1>
        <p class="ad-rreq-subtitle">Approve requests and assign staff for vehicle handover</p>
    </div>

    <?php if(session('success')): ?>
    <div class="ad-rreq-alert ad-rreq-alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="ad-rreq-alert ad-rreq-alert-error">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <div class="ad-rreq-panel">
        <div class="ad-rreq-table-wrap">
            <table class="ad-rreq-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vehicle</th>
                        <th>Renter</th>
                        <th>Owner</th>
                        <th>Dates</th>
                        <th>Cost</th>
                        <th>Damage</th>
                        <th>Damage Payment</th>
                        <th>Status</th>
                        <th>Staff</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="ad-rreq-strong">#<?php echo e($rental->id); ?></td>
                        <td>
                            <?php echo e($rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model)); ?>

                            <br>
                            <span class="ad-rreq-inline-muted"><?php echo e($rental->vehicle->plate_number); ?></span>
                        </td>
                        <td>
                            <?php echo e($rental->renter->name); ?>

                            <br>
                            <span class="ad-rreq-inline-muted"><?php echo e($rental->renter->email); ?></span>
                        </td>
                        <td class="ad-rreq-muted">
                            <?php if($rental->vehicle->is_service_center_vehicle): ?>
                                <span class="ad-rreq-service-center">Service Center</span>
                            <?php else: ?>
                                <?php echo e($rental->owner->name ?? 'Customer'); ?>

                            <?php endif; ?>
                        </td>
                        <td class="ad-rreq-muted">
                            <?php echo e(\Carbon\Carbon::parse($rental->start_date)->format('M d, Y')); ?>

                            <br>
                            <?php echo e(\Carbon\Carbon::parse($rental->end_date)->format('M d, Y')); ?>

                        </td>
                        <td class="ad-rreq-strong">
                            Rs. <?php echo e(number_format($rental->total_cost, 2)); ?>

                        </td>
                        <td>
                            <?php if($rental->has_damage): ?>
                                Rs. <?php echo e(number_format($rental->damage_charge ?? 0, 2)); ?>

                                <?php if($rental->damage_description): ?>
                                    <div class="ad-rreq-inline-muted ad-rreq-mt-1"><?php echo e($rental->damage_description); ?></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="ad-rreq-none">None</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="ad-rreq-badge
                                <?php if(($rental->damage_payment_status ?? 'Unpaid') === 'Paid'): ?> ad-rreq-badge-green
                                <?php elseif(($rental->damage_payment_status ?? 'Unpaid') === 'Not Required'): ?> ad-rreq-badge-gray
                                <?php else: ?> ad-rreq-badge-yellow <?php endif; ?>">
                                <?php echo e($rental->damage_payment_status ?? 'Unpaid'); ?>

                            </span>
                        </td>
                        <td>
                            <?php
                                $statusClasses = [
                                    'Pending' => 'ad-rreq-badge-yellow',
                                    'Approved' => 'ad-rreq-badge-green',
                                    'Ready for Pickup' => 'ad-rreq-badge-blue',
                                    'Picked Up' => 'ad-rreq-badge-indigo',
                                    'In Use' => 'ad-rreq-badge-purple',
                                    'Returned' => 'ad-rreq-badge-gray',
                                    'Completed' => 'ad-rreq-badge-green',
                                    'Rejected' => 'ad-rreq-badge-red',
                                ];
                            ?>
                            <span class="ad-rreq-badge <?php echo e($statusClasses[$rental->status] ?? 'ad-rreq-badge-gray'); ?>">
                                <?php echo e($rental->status); ?>

                            </span>
                        </td>
                        <td>
                            <?php if($rental->assignedStaff): ?>
                                <span><?php echo e($rental->assignedStaff->name); ?></span>
                            <?php else: ?>
                                <button onclick="assignStaff(<?php echo e($rental->id); ?>)" 
                                        class="ad-rreq-link-btn">
                                    Assign Staff
                                </button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($rental->status === 'Pending'): ?>
                            <div class="ad-rreq-actions-inline">
                                <form action="<?php echo e(route('admin.rentals.requests.approve', $rental)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="ad-rreq-btn ad-rreq-btn-approve">
                                        Approve
                                    </button>
                                </form>
                                <button onclick="rejectRequest(<?php echo e($rental->id); ?>)" 
                                        class="ad-rreq-btn ad-rreq-btn-reject">
                                    Reject
                                </button>
                            </div>
                            <?php else: ?>
                                <span class="ad-rreq-status-note"><?php echo e($rental->status); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="11" class="ad-rreq-empty">No rental requests found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Assign Staff Modal -->
<div id="assignStaffModal" class="ad-rreq-modal-overlay ad-hidden">
    <div class="ad-rreq-modal">
        <div class="ad-rreq-modal-head">
            <h2 class="ad-rreq-modal-title">Assign Staff</h2>
        </div>
        
        <form id="assignStaffForm" method="POST" class="ad-rreq-modal-form">
            <?php echo csrf_field(); ?>
            <div class="ad-rreq-field">
                <label class="ad-rreq-label">Select Staff Member *</label>
                <select name="staff_id" required class="ad-rreq-input">
                    <option value="">-- Choose Staff --</option>
                    <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($member->id); ?>"><?php echo e($member->name); ?> - <?php echo e($member->position ?? 'Staff'); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="ad-rreq-modal-actions">
                <button type="submit" class="ad-rreq-btn ad-rreq-btn-primary ad-rreq-btn-grow">
                    Assign Staff
                </button>
                <button type="button" onclick="document.getElementById('assignStaffModal').classList.add('ad-hidden')" 
                        class="ad-rreq-btn ad-rreq-btn-ghost">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="ad-rreq-modal-overlay ad-hidden">
    <div class="ad-rreq-modal">
        <div class="ad-rreq-modal-head">
            <h2 class="ad-rreq-modal-title">Reject Rental Request</h2>
        </div>
        
        <form id="rejectForm" method="POST" class="ad-rreq-modal-form">
            <?php echo csrf_field(); ?>
            <div class="ad-rreq-field">
                <label class="ad-rreq-label">Rejection Reason *</label>
                <textarea name="rejection_reason" required rows="4" 
                          class="ad-rreq-input"
                          placeholder="Explain why this rental request is rejected..."></textarea>
            </div>
            
            <div class="ad-rreq-modal-actions">
                <button type="submit" class="ad-rreq-btn ad-rreq-btn-danger ad-rreq-btn-grow">
                    Reject Request
                </button>
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('ad-hidden')" 
                        class="ad-rreq-btn ad-rreq-btn-ghost">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function assignStaff(rentalId) {
    document.getElementById('assignStaffForm').action = `/admin/rentals/requests/${rentalId}/assign-staff`;
    document.getElementById('assignStaffModal').classList.remove('ad-hidden');
}

function rejectRequest(rentalId) {
    document.getElementById('rejectForm').action = `/admin/rentals/requests/${rentalId}/reject`;
    document.getElementById('rejectModal').classList.remove('ad-hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\rentals\requests.blade.php ENDPATH**/ ?>