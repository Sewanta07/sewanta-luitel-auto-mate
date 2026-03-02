<?php $__env->startSection('title', 'Admin Dashboard - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $recentBookingRows = collect($recentBookings ?? [])->filter()->values();
?>
<div class="ad-page">
    <div class="ad-container">
        <div class="ad-head">
            <div>
                <h1 class="ad-title">Admin Dashboard</h1>
                <p class="ad-subtitle">Real-time overview of services, payments, inventory, and operations</p>
            </div>
            <div class="ad-actions">
                <a href="<?php echo e(route('admin.analytics')); ?>" class="ad-btn ad-btn-primary">Open Analytics</a>
                <a href="<?php echo e(route('admin.services')); ?>" class="ad-btn ad-btn-muted">Manage Services</a>
            </div>
        </div>

        <div class="ad-cards">
            <div class="ad-card">
                <p class="ad-card-label">Total Services</p>
                <h3 class="ad-card-value"><?php echo e(number_format((int) ($totalServices ?? 0))); ?></h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">In Progress</p>
                <h3 class="ad-card-value"><?php echo e(number_format((int) ($inProgressServices ?? 0))); ?></h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Completed Today</p>
                <h3 class="ad-card-value"><?php echo e(number_format((int) ($completedToday ?? 0))); ?></h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Total Revenue</p>
                <h3 class="ad-card-value">Rs. <?php echo e(number_format((float) ($totalRevenue ?? 0), 2)); ?></h3>
            </div>

            <div class="ad-card">
                <p class="ad-card-label">Pending Review</p>
                <h3 class="ad-card-value"><?php echo e(number_format((int) ($pendingReview ?? 0))); ?></h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Active Rentals</p>
                <h3 class="ad-card-value"><?php echo e(number_format((int) ($activeRentals ?? 0))); ?></h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Low Stock Items</p>
                <h3 class="ad-card-value"><?php echo e(number_format((int) ($lowStockItems ?? 0))); ?></h3>
            </div>
            <div class="ad-card">
                <p class="ad-card-label">Pending Withdrawals</p>
                <h3 class="ad-card-value"><?php echo e(number_format((int) ($pendingWithdrawals ?? 0))); ?></h3>
            </div>
        </div>

        <div class="ad-grid-2">
            <?php if (isset($component)) { $__componentOriginal91b17fe816eccd2dd419f56044b0f392 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91b17fe816eccd2dd419f56044b0f392 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.chart-card','data' => ['title' => 'Completed Services (6 Months)','subtitle' => 'Completed service volume trend','chart' => 'admin-performance','series' => $monthlyCompletedServices ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.chart-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Completed Services (6 Months)','subtitle' => 'Completed service volume trend','chart' => 'admin-performance','series' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($monthlyCompletedServices ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91b17fe816eccd2dd419f56044b0f392)): ?>
<?php $attributes = $__attributesOriginal91b17fe816eccd2dd419f56044b0f392; ?>
<?php unset($__attributesOriginal91b17fe816eccd2dd419f56044b0f392); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91b17fe816eccd2dd419f56044b0f392)): ?>
<?php $component = $__componentOriginal91b17fe816eccd2dd419f56044b0f392; ?>
<?php unset($__componentOriginal91b17fe816eccd2dd419f56044b0f392); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal91b17fe816eccd2dd419f56044b0f392 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91b17fe816eccd2dd419f56044b0f392 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.chart-card','data' => ['title' => 'Revenue (6 Months)','subtitle' => 'Paid transactions trend','chart' => 'monthly-revenue','series' => $monthlyRevenue ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.chart-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Revenue (6 Months)','subtitle' => 'Paid transactions trend','chart' => 'monthly-revenue','series' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($monthlyRevenue ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91b17fe816eccd2dd419f56044b0f392)): ?>
<?php $attributes = $__attributesOriginal91b17fe816eccd2dd419f56044b0f392; ?>
<?php unset($__attributesOriginal91b17fe816eccd2dd419f56044b0f392); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91b17fe816eccd2dd419f56044b0f392)): ?>
<?php $component = $__componentOriginal91b17fe816eccd2dd419f56044b0f392; ?>
<?php unset($__componentOriginal91b17fe816eccd2dd419f56044b0f392); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal91b17fe816eccd2dd419f56044b0f392 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91b17fe816eccd2dd419f56044b0f392 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.chart-card','data' => ['title' => 'Service Status Mix','subtitle' => 'Distribution across all statuses','chart' => 'service-status','series' => $serviceStatusCounts ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.chart-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Service Status Mix','subtitle' => 'Distribution across all statuses','chart' => 'service-status','series' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($serviceStatusCounts ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91b17fe816eccd2dd419f56044b0f392)): ?>
<?php $attributes = $__attributesOriginal91b17fe816eccd2dd419f56044b0f392; ?>
<?php unset($__attributesOriginal91b17fe816eccd2dd419f56044b0f392); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91b17fe816eccd2dd419f56044b0f392)): ?>
<?php $component = $__componentOriginal91b17fe816eccd2dd419f56044b0f392; ?>
<?php unset($__componentOriginal91b17fe816eccd2dd419f56044b0f392); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal91b17fe816eccd2dd419f56044b0f392 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91b17fe816eccd2dd419f56044b0f392 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.chart-card','data' => ['title' => 'Inventory Health','subtitle' => 'In stock vs low stock vs out of stock','chart' => 'service-status','series' => $inventoryHealth ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.chart-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Inventory Health','subtitle' => 'In stock vs low stock vs out of stock','chart' => 'service-status','series' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inventoryHealth ?? [])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91b17fe816eccd2dd419f56044b0f392)): ?>
<?php $attributes = $__attributesOriginal91b17fe816eccd2dd419f56044b0f392; ?>
<?php unset($__attributesOriginal91b17fe816eccd2dd419f56044b0f392); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91b17fe816eccd2dd419f56044b0f392)): ?>
<?php $component = $__componentOriginal91b17fe816eccd2dd419f56044b0f392; ?>
<?php unset($__componentOriginal91b17fe816eccd2dd419f56044b0f392); ?>
<?php endif; ?>
        </div>

        <div class="ad-grid-2">
            <div class="ad-panel">
                <div class="ad-panel-head">
                    <h2 class="ad-panel-title">Recent Service Bookings</h2>
                    <a href="<?php echo e(route('admin.services')); ?>" class="ad-panel-link">View all</a>
                </div>
                <div class="ad-table-wrap">
                    <table class="ad-table">
                        <thead>
                            <tr>
                                <th>Booking</th>
                                <th>Customer</th>
                                <th>Staff</th>
                                <th>Status</th>
                                <th>Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentBookingRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e(data_get($booking, 'booking_code', '#' . data_get($booking, 'id'))); ?></td>
                                    <td><?php echo e(data_get($booking, 'customer.name', 'N/A')); ?></td>
                                    <td><?php echo e(data_get($booking, 'staff.name', 'Unassigned')); ?></td>
                                    <td><?php echo e(data_get($booking, 'status', 'N/A')); ?></td>
                                    <td><?php echo e(optional(data_get($booking, 'updated_at'))->diffForHumans()); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5">No service bookings found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ad-panel">
                <h2 class="ad-panel-title">Quick Actions</h2>
                <div class="ad-quick">
                    <a href="<?php echo e(route('admin.users')); ?>" class="ad-quick-link">Manage Users</a>
                    <a href="<?php echo e(route('admin.staff-applications.index')); ?>" class="ad-quick-link">Review Staff Applications</a>
                    <a href="<?php echo e(route('admin.inventory.index')); ?>" class="ad-quick-link">Check Inventory</a>
                    <a href="<?php echo e(route('admin.messages')); ?>" class="ad-quick-link">Open Messages</a>
                </div>

                <div class="ad-revenue">
                    <p class="ad-revenue-label">Service Revenue</p>
                    <p class="ad-revenue-value">Rs. <?php echo e(number_format((float) ($totalServiceCharge ?? 0), 2)); ?></p>
                    <p class="ad-revenue-note">From completed service bookings</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        let reloadTimer = null;

        const scheduleReload = () => {
            if (reloadTimer) {
                return;
            }

            reloadTimer = setTimeout(() => {
                window.location.reload();
            }, 1200);
        };

        if (window.realtime) {
            window.realtime.subscribeDashboard('admin', null, {
                serviceStatus: scheduleReload,
                rentalStatus: scheduleReload,
                paymentStatus: scheduleReload,
                inventoryUpdated: scheduleReload,
                earningsUpdated: scheduleReload,
                withdrawalUpdated: scheduleReload,
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\dashboard\admin.blade.php ENDPATH**/ ?>