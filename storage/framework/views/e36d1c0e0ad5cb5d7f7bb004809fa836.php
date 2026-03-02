

<?php $__env->startSection('title', 'Service Logs - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="sf-slog-page">
    <main class="sf-slog-main">
        <div class="sf-slog-head-wrap">
            <div class="sf-slog-head">
                <div>
                    <h1 class="sf-slog-title">Service History</h1>
                    <p class="sf-slog-subtitle">View your completed services and work logs</p>
                </div>
                <div class="sf-slog-head-actions">
                    <a href="<?php echo e(route('staff.service.logs')); ?>" class="sf-slog-refresh-btn">
                        <svg class="sf-slog-refresh-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Refresh
                    </a>
                </div>
            </div>
        </div>

        <div class="sf-slog-stats">
            <div class="sf-slog-stat-card">
                <div class="sf-slog-stat-row">
                    <div>
                        <p class="sf-slog-stat-label">Total Completed</p>
                        <p class="sf-slog-stat-value sf-slog-stat-value-green"><?php echo e($totalServices); ?></p>
                        <p class="sf-slog-stat-help">Services completed</p>
                    </div>
                    <div class="sf-slog-stat-icon sf-slog-stat-icon-green">
                        <svg class="sf-slog-stat-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>

            <div class="sf-slog-stat-card">
                <div class="sf-slog-stat-row">
                    <div>
                        <p class="sf-slog-stat-label">Total Revenue</p>
                        <p class="sf-slog-stat-value sf-slog-stat-value-blue">Rs. <?php echo e(number_format($totalCost, 0)); ?></p>
                        <p class="sf-slog-stat-help">Estimated service value</p>
                    </div>
                    <div class="sf-slog-stat-icon sf-slog-stat-icon-blue">
                        <svg class="sf-slog-stat-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="sf-slog-filter-panel">
            <h3 class="sf-slog-filter-title">Filter Results</h3>
            <form action="<?php echo e(route('staff.service.logs')); ?>" method="GET" class="sf-slog-filter-form">
                <div>
                    <label class="sf-slog-filter-label">Search</label>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Booking ref, vehicle..." class="sf-slog-input">
                </div>
                <div>
                    <label class="sf-slog-filter-label">From Date</label>
                    <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="sf-slog-input">
                </div>
                <div>
                    <label class="sf-slog-filter-label">To Date</label>
                    <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="sf-slog-input">
                </div>
                <div class="sf-slog-filter-actions">
                    <button type="submit" class="sf-slog-filter-btn sf-slog-filter-btn-primary">Filter</button>
                    <a href="<?php echo e(route('staff.service.logs')); ?>" class="sf-slog-filter-btn sf-slog-filter-btn-secondary">Reset</a>
                </div>
            </form>
        </div>

        <div class="sf-slog-panel">
            <div class="sf-slog-panel-head">
                <h2 class="sf-slog-panel-title">
                    <svg class="sf-slog-panel-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Completed Services
                </h2>
            </div>

            <div class="sf-slog-table-wrap">
                <table class="sf-slog-table">
                    <thead class="sf-slog-thead">
                        <tr>
                            <th class="sf-slog-th">Date</th>
                            <th class="sf-slog-th">Booking Ref</th>
                            <th class="sf-slog-th">Vehicle</th>
                            <th class="sf-slog-th">Description</th>
                            <th class="sf-slog-th">Cost</th>
                            <th class="sf-slog-th sf-slog-th-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="sf-slog-tbody">
                        <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="sf-slog-row">
                                <td class="sf-slog-td sf-slog-nowrap">
                                    <div class="sf-slog-date"><?php echo e($log->created_at->format('M d, Y')); ?></div>
                                    <div class="sf-slog-time"><?php echo e($log->created_at->format('h:i A')); ?></div>
                                </td>
                                <td class="sf-slog-td sf-slog-nowrap">
                                    <span class="sf-slog-booking-chip"><?php echo e($log->booking->booking_code); ?></span>
                                </td>
                                <td class="sf-slog-td">
                                    <div class="sf-slog-vehicle"><?php echo e($log->booking->vehicle_model); ?></div>
                                    <div class="sf-slog-plate"><?php echo e($log->booking->vehicle_number); ?></div>
                                </td>
                                <td class="sf-slog-td">
                                    <div class="sf-slog-service"><?php echo e($log->booking->service_type); ?></div>
                                    <?php if($log->notes): ?>
                                        <div class="sf-slog-notes"><?php echo e(\Illuminate\Support\Str::limit($log->notes, 70)); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td class="sf-slog-td sf-slog-nowrap">
                                    <span class="sf-slog-cost">Rs. <?php echo e(number_format((float) ($log->booking->total_amount ?? $log->booking->estimated_cost ?? 0), 2)); ?></span>
                                </td>
                                <td class="sf-slog-td sf-slog-nowrap sf-slog-right">
                                    <a href="<?php echo e(route('staff.services.show', $log->booking->id)); ?>" class="sf-slog-view-btn">
                                        <svg class="sf-slog-view-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="sf-slog-empty-cell">
                                    <svg class="sf-slog-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <p class="sf-slog-empty-title">No completed services found</p>
                                    <p class="sf-slog-empty-copy">Your completed services will appear here</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($logs->hasPages()): ?>
                <div class="sf-slog-pagination-shell">
                    <div class="sf-slog-pagination-row">
                        <div class="sf-slog-pagination-meta">
                            Showing <span class="sf-slog-strong"><?php echo e($logs->firstItem()); ?></span> to <span class="sf-slog-strong"><?php echo e($logs->lastItem()); ?></span> of <span class="sf-slog-strong"><?php echo e($logs->total()); ?></span> results
                        </div>
                        <div class="sf-slog-pagination-actions">
                            <?php if($logs->onFirstPage()): ?>
                                <button disabled class="sf-slog-page-btn sf-slog-page-btn-disabled">← Previous</button>
                            <?php else: ?>
                                <a href="<?php echo e($logs->previousPageUrl()); ?>" class="sf-slog-page-btn sf-slog-page-btn-ghost">← Previous</a>
                            <?php endif; ?>

                            <?php if($logs->hasMorePages()): ?>
                                <a href="<?php echo e($logs->nextPageUrl()); ?>" class="sf-slog-page-btn sf-slog-page-btn-primary">Next →</a>
                            <?php else: ?>
                                <button disabled class="sf-slog-page-btn sf-slog-page-btn-disabled">Next →</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/staff/service-logs.blade.php ENDPATH**/ ?>