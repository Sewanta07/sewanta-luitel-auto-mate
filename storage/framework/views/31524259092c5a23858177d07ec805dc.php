<?php $__env->startSection('title', 'Service Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-page ad-services-page">
    <div class="ad-container">
        <!-- Page Header -->
        <div class="ad-services-head">
            <h1 class="ad-services-title">Service Management</h1>
            <p class="ad-services-subtitle">Monitor and manage all service operations</p>
        </div>

    <!-- Statistics Cards -->
    <div class="ad-services-stats">
      
        <!-- Total Active -->
        <div class="ad-services-stat">
            <div class="ad-services-stat-row">
                <div>
                    <p class="ad-services-stat-label">Total Active</p>
                    <h3 class="ad-services-stat-value"><?php echo e($stats['total']); ?></h3>
                </div>
                <div class="ad-services-icon gray">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="ad-services-stat">
            <div class="ad-services-stat-row">
                <div>
                    <p class="ad-services-stat-label">Pending</p>
                    <h3 class="ad-services-stat-value ad-color-orange"><?php echo e($stats['pending']); ?></h3>
                </div>
                <div class="ad-services-icon orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <!-- In Progress -->
        <div class="ad-services-stat">
            <div class="ad-services-stat-row">
                <div>
                    <p class="ad-services-stat-label">In Progress</p>
                    <h3 class="ad-services-stat-value ad-color-blue"><?php echo e($stats['in_progress']); ?></h3>
                </div>
                <div class="ad-services-icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
        </div>

        <!-- Completed -->
        <div class="ad-services-stat">
            <div class="ad-services-stat-row">
                <div>
                    <p class="ad-services-stat-label">Completed</p>
                    <h3 class="ad-services-stat-value ad-color-green"><?php echo e($stats['completed']); ?></h3>
                </div>
                <div class="ad-services-icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
        </div>

        <!-- Unassigned -->
        <div class="ad-services-stat">
            <div class="ad-services-stat-row">
                <div>
                    <p class="ad-services-stat-label">Unassigned</p>
                    <h3 class="ad-services-stat-value ad-color-red"><?php echo e($stats['unassigned']); ?></h3>
                </div>
                <div class="ad-services-icon red">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Services -->
    <div class="ad-services-stack">
        <div class="ad-services-panel">
            <div class="ad-services-panel-head">
                <h2 class="ad-services-panel-title">Service Bookings Overview</h2>
            </div>
            <div class="ad-services-table-wrap">
                <table class="ad-services-table">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Service Type</th>
                            <th>Customer</th>
                            <th>Technician</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="ad-services-table-row" onclick="toggleBookingDetails('booking-<?php echo e($booking->id); ?>')">
                            <td>#<?php echo e($booking->id); ?></td>
                            <td><?php echo e($booking->service_type); ?></td>
                            <td><?php echo e($booking->customer->name ?? 'Unknown'); ?></td>
                            <td>
                                <?php echo e($booking->staff->name ?? 'Unassigned'); ?>

                            </td>
                            <td>
                                <?php
                                    $statusClasses = [
                                        'Pending' => 'ad-status-pending',
                                        'Approved' => 'ad-status-approved',
                                        'Assigned' => 'ad-status-assigned',
                                        'Paid' => 'ad-status-paid',
                                        'In Progress' => 'ad-status-in-progress',
                                        'Waiting for Parts' => 'ad-status-waiting-parts',
                                        'Completed' => 'ad-status-completed',
                                        'Cancelled' => 'ad-status-cancelled',
                                        'Rejected' => 'ad-status-rejected',
                                    ];
                                ?>
                                <span class="ad-status-badge <?php echo e($statusClasses[$booking->status] ?? 'ad-status-cancelled'); ?>">
                                    <?php echo e($booking->status); ?>

                                </span>
                            </td>
                            <td>
                                <?php echo e(\Carbon\Carbon::parse($booking->created_at)->format('M d, Y')); ?>

                            </td>
                        </tr>
                        <!-- Detailed Booking Information -->
                        <tr id="booking-<?php echo e($booking->id); ?>" class="ad-services-detail-row ad-hidden">
                            <td colspan="6" class="ad-services-detail-cell">
                                <div class="ad-services-detail-grid">
                                    <!-- Customer Details -->
                                    <div class="ad-services-detail-card">
                                        <h3 class="ad-services-detail-title">
                                            <svg class="ad-services-detail-icon ad-icon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Customer Information
                                        </h3>
                                        <div class="ad-services-detail-list">
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Name:</span> <span class="ad-services-item-value"><?php echo e($booking->customer->name ?? 'N/A'); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Phone:</span> <span class="ad-services-item-value"><?php echo e($booking->phone_number ?? 'N/A'); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Email:</span> <span class="ad-services-item-value"><?php echo e($booking->customer->email ?? 'N/A'); ?></span></p>
                                        </div>
                                    </div>

                                    <!-- Vehicle Details -->
                                    <div class="ad-services-detail-card">
                                        <h3 class="ad-services-detail-title">
                                            <svg class="ad-services-detail-icon ad-icon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                            Vehicle Information
                                        </h3>
                                        <div class="ad-services-detail-list">
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Model:</span> <span class="ad-services-item-value"><?php echo e($booking->vehicle_model ?? 'N/A'); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Type:</span> <span class="ad-services-item-value"><?php echo e($booking->vehicle_type ?? 'N/A'); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Number:</span> <span class="ad-services-item-value"><?php echo e($booking->vehicle_number ?? 'N/A'); ?></span></p>
                                        </div>
                                    </div>

                                    <!-- Service Details -->
                                    <div class="ad-services-detail-card">
                                        <h3 class="ad-services-detail-title">
                                            <svg class="ad-services-detail-icon ad-icon-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                            Service Details
                                        </h3>
                                        <div class="ad-services-detail-list">
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Service Type:</span> <span class="ad-services-item-value"><?php echo e($booking->service_type ?? 'N/A'); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Priority:</span> <span class="ad-priority-badge <?php echo e(str_contains($booking->service_priority, 'High') ? 'ad-priority-high' : (str_contains($booking->service_priority, 'Medium') ? 'ad-priority-medium' : 'ad-priority-normal')); ?>"><?php echo e($booking->service_priority ?? 'Normal'); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Location:</span> <span class="ad-services-item-value"><?php echo e($booking->service_location_type ?? 'N/A'); ?></span></p>
                                        </div>
                                    </div>

                                    <!-- Timeline & Status -->
                                    <div class="ad-services-detail-card">
                                        <h3 class="ad-services-detail-title">
                                            <svg class="ad-services-detail-icon ad-icon-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Timeline
                                        </h3>
                                        <div class="ad-services-detail-list">
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Created:</span> <span class="ad-services-item-value"><?php echo e(\Carbon\Carbon::parse($booking->created_at)->format('M d, Y h:i A')); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Preferred Date:</span> <span class="ad-services-item-value"><?php echo e(\Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y')); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Expected Completion:</span> <span class="ad-services-item-value"><?php echo e($booking->expected_completion_date ? \Carbon\Carbon::parse($booking->expected_completion_date)->format('M d, Y') : 'Not Set'); ?></span></p>
                                        </div>
                                    </div>

                                    <!-- Cost Information -->
                                    <div class="ad-services-detail-card">
                                        <h3 class="ad-services-detail-title">
                                            <svg class="ad-services-detail-icon ad-icon-purple" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Cost Information
                                        </h3>
                                        <div class="ad-services-detail-list">
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Estimated Cost:</span> <span class="ad-services-item-value ad-services-item-value-strong">Rs. <?php echo e(number_format($booking->estimated_cost, 2)); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Service Cost:</span> <span class="ad-services-item-value ad-services-item-value-strong">Rs. <?php echo e(number_format((float) ($booking->service_cost ?? 0), 2)); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Spare Parts Cost:</span> <span class="ad-services-item-value ad-services-item-value-strong">Rs. <?php echo e(number_format((float) ($booking->spare_parts_cost ?? 0), 2)); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Total Amount:</span> <span class="ad-services-item-value ad-services-item-value-strong">Rs. <?php echo e(number_format((float) ($booking->total_amount ?? 0), 2)); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Payment Status:</span> <span class="ad-services-item-value ad-services-item-value-strong"><?php echo e(ucfirst($booking->payment_status ?? 'pending')); ?></span></p>
                                            <p class="ad-services-detail-item"><span class="ad-services-item-label">Parts Used:</span> <span class="ad-services-item-value"><?php echo e($booking->parts->count() ?? 0); ?></span></p>
                                            <?php if($booking->parts->count() > 0): ?>
                                                <p class="ad-services-detail-item"><span class="ad-services-item-label">Parts Total:</span> <span class="ad-services-item-value ad-services-item-value-strong">Rs. <?php echo e(number_format($booking->parts->sum('pivot.total_cost'), 2)); ?></span></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Assigned Staff -->
                                    <div class="ad-services-detail-card">
                                        <h3 class="ad-services-detail-title">
                                            <svg class="ad-services-detail-icon ad-icon-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            Assigned Staff
                                        </h3>
                                        <div class="ad-services-detail-list">
                                            <?php if($booking->staff): ?>
                                                <p class="ad-services-detail-item"><span class="ad-services-item-label">Name:</span> <span class="ad-services-item-value"><?php echo e($booking->staff->name ?? 'Unassigned'); ?></span></p>
                                                <p class="ad-services-detail-item"><span class="ad-services-item-label">Position:</span> <span class="ad-services-item-value"><?php echo e($booking->staff->position ?? 'N/A'); ?></span></p>
                                                <p class="ad-services-detail-item"><span class="ad-services-item-label">Status:</span> <span class="ad-priority-badge ad-priority-normal">Available</span></p>
                                            <?php else: ?>
                                                <p class="ad-services-item-muted">Not yet assigned</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Problem Description -->
                                    <?php if($booking->problem_description): ?>
                                    <div class="ad-services-detail-card ad-services-detail-card-wide">
                                        <h3 class="ad-services-detail-title">
                                            <svg class="ad-services-detail-icon ad-icon-red" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Problem Description
                                        </h3>
                                        <p class="ad-services-problem-text"><?php echo e($booking->problem_description); ?></p>
                                    </div>
                                    <?php endif; ?>

                                    <!-- Action Buttons -->
                                    <div class="ad-services-detail-card ad-services-detail-card-wide">
                                        <h3 class="ad-services-detail-title ad-services-detail-title-no-icon">Actions</h3>
                                        <div class="ad-services-actions-wrap">
                                            <?php if($booking->status === 'Completed'): ?>
                                                <a href="<?php echo e(route('admin.services.invoice', $booking->id)); ?>" onclick="event.stopPropagation()" class="ad-btn ad-btn-emerald-soft">
                                                    View Invoice
                                                </a>
                                            <?php endif; ?>
                                            <?php if($booking->status !== 'Completed' && $booking->status !== 'Rejected' && $booking->status !== 'Cancelled'): ?>
                                                <form action="<?php echo e(route('admin.services.set-amount', $booking->id)); ?>" method="POST" class="ad-services-inline-form" onclick="event.stopPropagation()">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="ad-form-row">
                                                        <div class="ad-form-group">
                                                            <label class="ad-form-label">Service Cost (Rs.)</label>
                                                            <input type="number" name="service_cost" step="0.01" min="0" required value="<?php echo e(old('service_cost', $booking->service_cost ?? $booking->estimated_cost ?? 0)); ?>" class="ad-input ad-input-sm ad-input-w-36">
                                                        </div>
                                                        <div class="ad-form-group">
                                                            <label class="ad-form-label">Spare Parts Cost (Rs.)</label>
                                                            <input type="number" name="spare_parts_cost" step="0.01" min="0" value="<?php echo e(old('spare_parts_cost', $booking->spare_parts_cost ?? 0)); ?>" class="ad-input ad-input-sm ad-input-w-40">
                                                        </div>
                                                        <button type="submit" class="ad-btn ad-btn-slate">
                                                            Set Amount
                                                        </button>
                                                    </div>
                                                </form>
                                            <?php endif; ?>

                                            <?php if($booking->status === 'Pending'): ?>
                                                <!-- Approve Form -->
                                                <form action="<?php echo e(route('admin.services.approve', $booking->id)); ?>" method="POST" class="ad-services-inline-form" onclick="event.stopPropagation()">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="ad-form-row">
                                                        <div class="ad-form-group">
                                                            <label class="ad-form-label">Assign Staff</label>
                                                            <select name="staff_id" required class="ad-select ad-input-sm">
                                                                <option value="">Select Staff</option>
                                                                <?php $__currentLoopData = $staffMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="ad-form-group">
                                                            <label class="ad-form-label">Estimated Cost (Rs.)</label>
                                                            <input type="number" name="estimated_cost" step="0.01" class="ad-input ad-input-sm ad-input-w-32">
                                                        </div>
                                                        <div class="ad-form-group">
                                                            <label class="ad-form-label">Completion Date</label>
                                                            <input type="date" name="expected_completion_date" class="ad-input ad-input-sm">
                                                        </div>
                                                        <button type="submit" class="ad-btn ad-btn-green">
                                                            Approve & Assign
                                                        </button>
                                                    </div>
                                                </form>

                                                <!-- Reject Form -->
                                                <button onclick="event.stopPropagation(); toggleRejectForm('reject-<?php echo e($booking->id); ?>')" class="ad-btn ad-btn-red">
                                                    Reject
                                                </button>
                                                <div id="reject-<?php echo e($booking->id); ?>" class="ad-reject-form ad-hidden">
                                                    <form action="<?php echo e(route('admin.services.reject', $booking->id)); ?>" method="POST" onclick="event.stopPropagation()">
                                                        <?php echo csrf_field(); ?>
                                                        <textarea name="rejection_reason" required placeholder="Rejection reason..." class="ad-textarea ad-textarea-sm" rows="2"></textarea>
                                                        <button type="submit" class="ad-btn ad-btn-red">
                                                            Confirm Reject
                                                        </button>
                                                    </form>
                                                </div>
                                            <?php elseif($booking->status !== 'Completed' && $booking->status !== 'Rejected' && $booking->status !== 'Cancelled'): ?>
                                                <!-- Assign Staff (for already approved bookings) -->
                                                <?php if(!$booking->staff_id): ?>
                                                <form action="<?php echo e(route('admin.services.assign', $booking->id)); ?>" method="POST" class="ad-services-inline-form" onclick="event.stopPropagation()">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="ad-form-row">
                                                        <div class="ad-form-group">
                                                            <label class="ad-form-label">Assign Staff</label>
                                                            <select name="staff_id" required class="ad-select ad-input-sm">
                                                                <option value="">Select Staff</option>
                                                                <?php $__currentLoopData = $staffMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="ad-btn ad-btn-blue">
                                                            Assign
                                                        </button>
                                                    </div>
                                                </form>
                                                <?php endif; ?>

                                                <!-- Update Status -->
                                                <form action="<?php echo e(route('admin.services.status', $booking->id)); ?>" method="POST" class="ad-services-inline-form" onclick="event.stopPropagation()">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="ad-form-row">
                                                        <div class="ad-form-group">
                                                            <label class="ad-form-label">Update Status</label>
                                                            <select name="status" required class="ad-select ad-input-sm">
                                                                <option value="Approved" <?php echo e($booking->status === 'Approved' ? 'selected' : ''); ?>>Approved</option>
                                                                <option value="Assigned" <?php echo e($booking->status === 'Assigned' ? 'selected' : ''); ?>>Assigned</option>
                                                                <option value="Customer Accepted" <?php echo e($booking->status === 'Customer Accepted' ? 'selected' : ''); ?>>Customer Accepted</option>
                                                                <option value="In Progress" <?php echo e($booking->status === 'In Progress' ? 'selected' : ''); ?>>In Progress</option>
                                                                <option value="Waiting for Parts" <?php echo e($booking->status === 'Waiting for Parts' ? 'selected' : ''); ?>>Waiting for Parts</option>
                                                                <option value="Completed" <?php echo e($booking->status === 'Completed' ? 'selected' : ''); ?>>Completed</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="ad-btn ad-btn-orange">
                                                            Update
                                                        </button>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6">No recent service bookings</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
function toggleBookingDetails(elementId) {
    const element = document.getElementById(elementId);
    if (element.classList.contains('ad-hidden')) {
        element.classList.remove('ad-hidden');
    } else {
        element.classList.add('ad-hidden');
    }
}

function toggleRejectForm(elementId) {
    const element = document.getElementById(elementId);
    if (element.classList.contains('ad-hidden')) {
        element.classList.remove('ad-hidden');
    } else {
        element.classList.add('ad-hidden');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\services.blade.php ENDPATH**/ ?>