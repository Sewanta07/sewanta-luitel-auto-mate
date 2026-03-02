

<?php $__env->startSection('title', 'Staff Bookings - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="sf-book-page">
    <main class="sf-book-main">
        <div class="sf-book-head">
            <div>
                <h1 class="sf-book-title">Booking Management</h1>
                <p class="sf-book-subtitle">View and manage your assigned service bookings.</p>
            </div>
            <div class="sf-book-head-actions">
                <button type="button" class="sf-book-btn sf-book-btn-ghost">
                    <svg class="sf-book-btn-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/></svg>
                    Filter
                </button>
                <button type="button" class="sf-book-btn sf-book-btn-primary">
                    <svg class="sf-book-btn-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    New Booking
                </button>
            </div>
        </div>

        <div class="sf-book-stats">
            <div class="sf-book-stat-card">
                <div class="sf-book-stat-icon sf-book-stat-icon-orange">
                    <svg class="sf-book-stat-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                </div>
                <dl class="sf-book-stat-copy">
                    <dt class="sf-book-stat-label">Assigned to Me</dt>
                    <dd class="sf-book-stat-value"><?php echo e($stats['total']); ?></dd>
                </dl>
            </div>

            <div class="sf-book-stat-card">
                <div class="sf-book-stat-icon sf-book-stat-icon-blue">
                    <svg class="sf-book-stat-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <dl class="sf-book-stat-copy">
                    <dt class="sf-book-stat-label">In Progress</dt>
                    <dd class="sf-book-stat-value"><?php echo e($stats['in_progress']); ?></dd>
                </dl>
            </div>

            <div class="sf-book-stat-card">
                <div class="sf-book-stat-icon sf-book-stat-icon-green">
                    <svg class="sf-book-stat-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <dl class="sf-book-stat-copy">
                    <dt class="sf-book-stat-label">Completed Today</dt>
                    <dd class="sf-book-stat-value"><?php echo e($stats['completed_today']); ?></dd>
                </dl>
            </div>

            <div class="sf-book-stat-card">
                <div class="sf-book-stat-icon sf-book-stat-icon-yellow">
                    <svg class="sf-book-stat-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <dl class="sf-book-stat-copy">
                    <dt class="sf-book-stat-label">Pending Review</dt>
                    <dd class="sf-book-stat-value"><?php echo e($stats['pending']); ?></dd>
                </dl>
            </div>
        </div>

        <div class="sf-book-panel">
            <div class="sf-book-table-wrap">
                <table class="sf-book-table">
                    <thead class="sf-book-thead">
                        <tr>
                            <th scope="col" class="sf-book-th">Booking Reference</th>
                            <th scope="col" class="sf-book-th">Customer</th>
                            <th scope="col" class="sf-book-th">Vehicle</th>
                            <th scope="col" class="sf-book-th">Service Type</th>
                            <th scope="col" class="sf-book-th">Schedule</th>
                            <th scope="col" class="sf-book-th">Status</th>
                            <th scope="col" class="sf-book-th sf-book-th-actions"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="sf-book-tbody">
                        <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="sf-book-row">
                            <td class="sf-book-td sf-book-td-nowrap">
                                <span class="sf-book-ref">#BK-<?php echo e(str_pad($booking->id, 4, '0', STR_PAD_LEFT)); ?></span>
                            </td>
                            <td class="sf-book-td sf-book-td-nowrap">
                                <div class="sf-book-customer">
                                    <div class="sf-book-avatar">
                                        <?php echo e(substr($booking->customer->name ?? '?', 0, 1)); ?><?php echo e(substr(strrchr($booking->customer->name ?? '?', ' '), 1, 1)); ?>

                                    </div>
                                    <div class="sf-book-customer-meta">
                                        <div class="sf-book-customer-name"><?php echo e($booking->customer->name ?? 'Unknown'); ?></div>
                                        <div class="sf-book-customer-phone"><?php echo e($booking->phone_number ?? ($booking->customer->phone ?? 'N/A')); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="sf-book-td sf-book-td-nowrap">
                                <div class="sf-book-vehicle-model"><?php echo e($booking->vehicle_model); ?></div>
                                <div class="sf-book-vehicle-number"><?php echo e($booking->vehicle_number); ?></div>
                            </td>
                            <td class="sf-book-td sf-book-td-nowrap">
                                <span class="sf-book-service"><?php echo e($booking->service_type); ?></span>
                            </td>
                            <td class="sf-book-td sf-book-td-nowrap">
                                <div class="sf-book-date"><?php echo e(\Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y')); ?></div>
                            </td>
                            <td class="sf-book-td sf-book-td-nowrap">
                                <?php
                                    $statusClasses = [
                                        'Pending' => 'sf-book-badge-pending',
                                        'Approved' => 'sf-book-badge-approved',
                                        'Assigned' => 'sf-book-badge-assigned',
                                        'In Progress' => 'sf-book-badge-progress',
                                        'Waiting for Parts' => 'sf-book-badge-parts',
                                        'Completed' => 'sf-book-badge-completed',
                                        'Cancelled' => 'sf-book-badge-cancelled',
                                        'Rejected' => 'sf-book-badge-rejected',
                                    ];
                                    $class = $statusClasses[$booking->status] ?? 'sf-book-badge-default';
                                ?>
                                <span class="sf-book-badge <?php echo e($class); ?>">
                                    <?php echo e($booking->status); ?>

                                </span>
                            </td>
                            <td class="sf-book-td sf-book-td-nowrap sf-book-actions-cell">
                                <form action="<?php echo e(route('staff.bookings.status', $booking->id)); ?>" method="POST" class="sf-book-inline-form">
                                    <?php echo csrf_field(); ?>
                                    <input type="text" name="notes" placeholder="Update notes..." class="sf-book-notes-input">
                                    <select name="status" onchange="this.form.submit()" class="sf-book-status-select">
                                        <option value="Pending" <?php echo e($booking->status == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                        <option value="In Progress" <?php echo e($booking->status == 'In Progress' ? 'selected' : ''); ?>>In Progress</option>
                                        <option value="Waiting for Parts" <?php echo e($booking->status == 'Waiting for Parts' ? 'selected' : ''); ?>>Waiting for Parts</option>
                                        <option value="Completed" <?php echo e($booking->status == 'Completed' ? 'selected' : ''); ?>>Completed</option>
                                    </select>
                                </form>
                                <a href="<?php echo e(route('staff.services.show', $booking->id)); ?>" class="sf-book-manage-link">Manage Details</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="sf-book-empty">No bookings assigned to you yet.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="sf-book-pagination-shell">
                <div class="sf-book-pagination-wrap">
                    <div class="sf-book-pagination-row">
                        <div>
                            <p class="sf-book-pagination-meta">
                                Showing <span class="sf-book-pagination-strong">1</span> to <span class="sf-book-pagination-strong">3</span> of <span class="sf-book-pagination-strong">12</span> results
                            </p>
                        </div>
                        <div>
                            <nav class="sf-book-pagination" aria-label="Pagination">
                                <a href="#" class="sf-book-page-link sf-book-page-link-prev">
                                    <span class="sr-only">Previous</span>
                                    <svg class="sf-book-page-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </a>
                                <a href="#" aria-current="page" class="sf-book-page-link sf-book-page-link-active">1</a>
                                <a href="#" class="sf-book-page-link">2</a>
                                <a href="#" class="sf-book-page-link">3</a>
                                <a href="#" class="sf-book-page-link sf-book-page-link-next">
                                    <span class="sr-only">Next</span>
                                    <svg class="sf-book-page-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\staff\bookings.blade.php ENDPATH**/ ?>