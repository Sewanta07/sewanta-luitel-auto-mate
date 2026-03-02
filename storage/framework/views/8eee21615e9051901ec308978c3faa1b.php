<?php $__env->startSection('title', 'Rental Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-rrep-page">
    <div class="ad-rrep-container">
    <div class="ad-rrep-back-wrap">
        <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="ad-rrep-back-link">
            <svg class="ad-rrep-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
    <div class="ad-rrep-head">
        <h1 class="ad-rrep-title">Rental Reports & Analytics</h1>
        <p class="ad-rrep-subtitle">Comprehensive rental management statistics</p>
    </div>

    <!-- Summary Cards -->
    <div class="ad-rrep-stats-grid">
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Total Rentals</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-gray"><?php echo e($totalRentals); ?></p>
        </div>
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Completed</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-green"><?php echo e($completedRentals); ?></p>
        </div>
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Active Rentals</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-blue"><?php echo e($activeRentals); ?></p>
        </div>
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Total Revenue</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-purple">Rs. <?php echo e(number_format($totalRevenue, 2)); ?></p>
        </div>
        <div class="ad-rrep-stat-card">
            <p class="ad-rrep-stat-label">Damage Reports</p>
            <p class="ad-rrep-stat-value ad-rrep-stat-value-red"><?php echo e($damageReports); ?></p>
        </div>
    </div>

    <!-- Detailed Rental History -->
    <div class="ad-rrep-panel">
        <div class="ad-rrep-panel-head">
            <h2 class="ad-rrep-panel-title">Recent Rental History</h2>
        </div>
        
        <div class="ad-rrep-table-wrap">
            <table class="ad-rrep-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vehicle</th>
                        <th>Renter</th>
                        <th>Owner</th>
                        <th>Period</th>
                        <th>Cost</th>
                        <th>Status</th>
                        <th>Staff</th>
                        <th>Damage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentRentals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="ad-rrep-nowrap ad-rrep-strong">#<?php echo e($rental->id); ?></td>
                        <td>
                            <?php echo e($rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model)); ?>

                            <br>
                            <span class="ad-rrep-inline-muted"><?php echo e($rental->vehicle->plate_number); ?></span>
                        </td>
                        <td><?php echo e($rental->renter->name); ?></td>
                        <td class="ad-rrep-muted">
                            <?php echo e($rental->vehicle->is_service_center_vehicle ? 'Service Center' : ($rental->owner->name ?? 'Customer')); ?>

                        </td>
                        <td class="ad-rrep-nowrap ad-rrep-muted">
                            <?php echo e(\Carbon\Carbon::parse($rental->start_date)->format('M d')); ?> - 
                            <?php echo e(\Carbon\Carbon::parse($rental->end_date)->format('M d, Y')); ?>

                        </td>
                        <td class="ad-rrep-nowrap ad-rrep-strong">
                            Rs. <?php echo e(number_format($rental->total_cost, 2)); ?>

                            <?php if($rental->damage_charge): ?>
                                <br>
                                <span class="ad-rrep-damage-charge">+Rs. <?php echo e(number_format($rental->damage_charge, 2)); ?> damage</span>
                            <?php endif; ?>
                        </td>
                        <td class="ad-rrep-nowrap">
                            <?php
                                $statusColors = [
                                    'Pending' => 'ad-rrep-badge-yellow',
                                    'Approved' => 'ad-rrep-badge-green',
                                    'Ready for Pickup' => 'ad-rrep-badge-blue',
                                    'Picked Up' => 'ad-rrep-badge-indigo',
                                    'In Use' => 'ad-rrep-badge-purple',
                                    'Returned' => 'ad-rrep-badge-gray',
                                    'Completed' => 'ad-rrep-badge-green',
                                    'Rejected' => 'ad-rrep-badge-red',
                                    'Cancelled' => 'ad-rrep-badge-red',
                                ];
                            ?>
                            <span class="ad-rrep-badge <?php echo e($statusColors[$rental->status] ?? 'ad-rrep-badge-gray'); ?>">
                                <?php echo e($rental->status); ?>

                            </span>
                        </td>
                        <td class="ad-rrep-muted">
                            <?php echo e($rental->assignedStaff ? $rental->assignedStaff->name : '-'); ?>

                        </td>
                        <td class="ad-rrep-center">
                            <?php if($rental->has_damage): ?>
                                <span class="ad-rrep-badge ad-rrep-badge-red">
                                    Yes
                                </span>
                            <?php else: ?>
                                <span class="ad-rrep-no">No</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="ad-rrep-empty">No rental records found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Insights Section -->
    <div class="ad-rrep-insights-grid">
        <div class="ad-rrep-insight-card">
            <h3 class="ad-rrep-insight-title">Revenue Breakdown</h3>
            <div class="ad-rrep-insight-list">
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Rental Income</span>
                    <span class="ad-rrep-strong">Rs. <?php echo e(number_format($totalRevenue, 2)); ?></span>
                </div>
                <?php
                    $totalDamageCharges = $recentRentals->sum('damage_charge');
                ?>
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Damage Charges</span>
                    <span class="ad-rrep-text-red">Rs. <?php echo e(number_format($totalDamageCharges, 2)); ?></span>
                </div>
                <div class="ad-rrep-insight-row ad-rrep-insight-total">
                    <span class="ad-rrep-strong">Total Revenue</span>
                    <span class="ad-rrep-text-green">Rs. <?php echo e(number_format($totalRevenue + $totalDamageCharges, 2)); ?></span>
                </div>
            </div>
        </div>

        <div class="ad-rrep-insight-card">
            <h3 class="ad-rrep-insight-title">Performance Metrics</h3>
            <div class="ad-rrep-insight-list">
                <?php
                    $completionRate = $totalRentals > 0 ? round(($completedRentals / $totalRentals) * 100, 1) : 0;
                    $damageRate = $totalRentals > 0 ? round(($damageReports / $totalRentals) * 100, 1) : 0;
                ?>
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Completion Rate</span>
                    <span class="ad-rrep-text-green"><?php echo e($completionRate); ?>%</span>
                </div>
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Damage Rate</span>
                    <span class="<?php echo e($damageRate > 10 ? 'ad-rrep-text-red' : 'ad-rrep-text-yellow'); ?>"><?php echo e($damageRate); ?>%</span>
                </div>
                <div class="ad-rrep-insight-row">
                    <span class="ad-rrep-muted">Avg. Rental Value</span>
                    <span class="ad-rrep-text-blue">
                        Rs. <?php echo e($totalRentals > 0 ? number_format($totalRevenue / $totalRentals, 2) : '0.00'); ?>

                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/rentals/reports.blade.php ENDPATH**/ ?>