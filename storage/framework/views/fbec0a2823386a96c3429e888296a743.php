<?php $__env->startSection('title', 'My Bookings - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="cs-page cs-bookings-page">
    <div class="cs-container cs-bookings-container">
        
        
        <div class="cs-page-head cs-bookings-head">
            <div>
                <h1 class="cs-bookings-title">My <span class="cs-bookings-title-accent">Bookings</span></h1>
                <p class="cs-bookings-subtitle">Manage and track your vehicle service requests.</p>
            </div>
            <a href="<?php echo e(route('bookings.create')); ?>" class="cs-btn cs-btn-primary cs-bookings-cta">
                <svg class="cs-bookings-cta-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Book New Service
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="cs-alert-success cs-bookings-success">
                <svg class="cs-bookings-success-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="cs-surface cs-bookings-table-wrap cs-table-wrap">
            <?php if($bookings->isEmpty()): ?>
                <div class="cs-empty">
                    <div class="cs-empty-icon-wrap">
                        <svg class="cs-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v3a2 2 0 002 2h2"></path></svg>
                    </div>
                    <h3 class="cs-empty-title">No bookings found</h3>
                    <p class="cs-empty-text">You haven't made any service bookings yet.</p>
                    <a href="<?php echo e(route('bookings.create')); ?>" class="cs-link-accent cs-empty-link">Start by booking your first service →</a>
                </div>
            <?php else: ?>
                <div class="cs-table-scroll">
                    <table class="cs-table">
                        <thead>
                            <tr class="cs-table-head-row">
                                <th class="cs-table-head-cell">Vehicle Details</th>
                                <th class="cs-table-head-cell">Service Type</th>
                                <th class="cs-table-head-cell">Preferred Date</th>
                                <th class="cs-table-head-cell">Status</th>
                                <th class="cs-table-head-cell">View Receipt</th>
                                <th class="cs-table-head-cell cs-table-head-cell-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="cs-table-body">
                            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="cs-table-row">
                                    <td class="cs-table-cell">
                                        <div class="cs-vehicle-cell">
                                            <div class="cs-vehicle-icon-wrap">
                                                <?php if($booking->vehicle_type == 'Car'): ?>
                                                    <svg class="cs-vehicle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                                                <?php else: ?>
                                                    <svg class="cs-vehicle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h18M7 16h10a2 2 0 012 2v2a2 2 0 01-2 2H7a2 2 0 01-2-2v-2a2 2 0 012-2zM4 10h16M10 10V4h4v6"></path></svg>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <p class="cs-vehicle-title"><?php echo e($booking->vehicle_model); ?></p>
                                                <p class="cs-vehicle-meta"><?php echo e($booking->vehicle_number); ?> • <?php echo e($booking->vehicle_type); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cs-table-cell">
                                        <p class="cs-service-type"><?php echo e($booking->service_type); ?></p>
                                    </td>
                                    <td class="cs-table-cell cs-date-cell">
                                        <?php echo e(\Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y')); ?>

                                    </td>
                                    <td class="cs-table-cell">
                                        <?php
                                            $statusColors = [
                                                'Pending' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
                                                'Approved' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600'],
                                                'Assigned' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
                                                'In Progress' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
                                                'Waiting for Parts' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600'],
                                                'Completed' => ['bg' => 'bg-green-50', 'text' => 'text-green-600'],
                                                'Cancelled' => ['bg' => 'bg-gray-50', 'text' => 'text-gray-600'],
                                                'Rejected' => ['bg' => 'bg-red-50', 'text' => 'text-red-600'],
                                            ];
                                            $colors = $statusColors[$booking->status] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-600'];
                                        ?>
                                        <span class="cs-status-pill inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest <?php echo e($colors['bg']); ?> <?php echo e($colors['text']); ?>">
                                            <span class="cs-status-dot w-1.5 h-1.5 rounded-full mr-2 <?php echo e(str_replace('text', 'bg', $colors['text'])); ?>"></span>
                                            <?php echo e($booking->status); ?>

                                        </span>
                                    </td>
                                    <td class="cs-table-cell">
                                        <?php ($paymentStatus = strtolower((string) ($booking->payment_status ?? 'pending'))); ?>
                                        <?php if($paymentStatus === 'paid' && isset($receiptPaymentIds[$booking->id])): ?>
                                            <a href="<?php echo e(route('payments.receipt', $receiptPaymentIds[$booking->id])); ?>" class="cs-receipt-link">View Receipt</a>
                                        <?php else: ?>
                                            <span class="cs-receipt-na">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="cs-table-cell cs-table-cell-right">
                                        <div class="cs-actions">
                                            <!-- View Details Button (Always visible) -->
                                            <a href="<?php echo e(route('bookings.show', $booking->id)); ?>" class="cs-action-btn cs-action-btn-view">
                                              View Details
                                            </a>

                                            <?php if($booking->status === 'Pending'): ?>
                                                <details class="cs-reschedule-details">
                                                    <summary class="cs-reschedule-summary">Reschedule</summary>
                                                    <form action="<?php echo e(route('bookings.reschedule', $booking->id)); ?>" method="POST" class="cs-reschedule-form">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="date" name="preferred_date" value="<?php echo e($booking->preferred_date); ?>" class="cs-reschedule-input">
                                                        <select name="preferred_time_slot" class="cs-reschedule-select">
                                                            <option value="Morning" <?php echo e($booking->preferred_time_slot == 'Morning' ? 'selected' : ''); ?>>Morning</option>
                                                            <option value="Afternoon" <?php echo e($booking->preferred_time_slot == 'Afternoon' ? 'selected' : ''); ?>>Afternoon</option>
                                                            <option value="Evening" <?php echo e($booking->preferred_time_slot == 'Evening' ? 'selected' : ''); ?>>Evening</option>
                                                        </select>
                                                        <button type="submit" class="cs-reschedule-save">Save</button>
                                                    </form>
                                                </details>

                                                <form action="<?php echo e(route('bookings.cancel', $booking->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="cs-action-btn cs-action-btn-cancel">Cancel</button>
                                                </form>
                                            <?php endif; ?>

                                            <?php if($booking->status === 'Completed'): ?>
                                                <a href="<?php echo e(route('bookings.invoice', $booking->id)); ?>" class="cs-action-btn cs-action-btn-invoice">Invoice</a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-core', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/bookings/index.blade.php ENDPATH**/ ?>