

<?php $__env->startSection('title', 'Analytics - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $topServiceTypeRows = $topServiceTypes ?? collect();
    $recentPaymentRows = $recentPayments ?? collect();
?>
<div class="ad-page ad-analytics-page">
    <div class="ad-container">
        <div class="ad-analytics-head">
            <div>
                <h1 class="ad-title">Analytics Dashboard</h1>
                <p class="ad-subtitle">Business performance, conversion, and trend insights</p>
            </div>
            <form method="GET" action="<?php echo e(route('admin.analytics')); ?>" class="ad-filter-form">
                <label for="period" class="ad-filter-label">Range</label>
                <select id="period" name="period" class="ad-filter-select">
                    <?php $__currentLoopData = [7, 30, 90, 180, 365]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($period); ?>" <?php echo e((int) ($periodDays ?? 30) === $period ? 'selected' : ''); ?>>Last <?php echo e($period); ?> days</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" class="ad-filter-btn">Apply</button>
            </form>
        </div>

        <div class="ad-stat-grid">
            <div class="ad-stat-card">
                <p class="ad-stat-label">Revenue (Selected Range)</p>
                <h3 class="ad-stat-value">Rs. <?php echo e(number_format((float) ($periodRevenue ?? 0), 2)); ?></h3>
                <p class="ad-stat-note <?php echo e(($periodRevenueChange ?? null) === null ? 'ad-note-muted' : (($periodRevenueChange ?? 0) >= 0 ? 'ad-note-positive' : 'ad-note-negative')); ?>">
                    <?php if(($periodRevenueChange ?? null) === null): ?>
                        No prior period baseline
                    <?php else: ?>
                        <?php echo e(($periodRevenueChange ?? 0) >= 0 ? '+' : ''); ?><?php echo e(number_format((float) ($periodRevenueChange ?? 0), 1)); ?>% vs previous period
                    <?php endif; ?>
                </p>
            </div>

            <div class="ad-stat-card">
                <p class="ad-stat-label">Completed Services (Range)</p>
                <h3 class="ad-stat-value"><?php echo e(number_format((int) ($periodCompletedServices ?? 0))); ?></h3>
                <p class="ad-stat-note ad-note-neutral">All-time completed: <?php echo e(number_format((int) ($servicesCompleted ?? 0))); ?></p>
            </div>

            <div class="ad-stat-card">
                <p class="ad-stat-label">Payment Success Rate</p>
                <h3 class="ad-stat-value"><?php echo e(number_format((float) ($paymentSuccessRate ?? 0), 1)); ?>%</h3>
                <p class="ad-stat-note ad-note-neutral">Based on payment attempts in selected range</p>
            </div>

            <div class="ad-stat-card">
                <p class="ad-stat-label">New Customers (Range)</p>
                <h3 class="ad-stat-value"><?php echo e(number_format((int) ($periodNewCustomers ?? 0))); ?></h3>
                <p class="ad-stat-note ad-note-neutral">Active customers total: <?php echo e(number_format((int) ($activeCustomers ?? 0))); ?></p>
            </div>
        </div>

        <div class="ad-analytics-grid">
            <?php if (isset($component)) { $__componentOriginal91b17fe816eccd2dd419f56044b0f392 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91b17fe816eccd2dd419f56044b0f392 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.chart-card','data' => ['title' => 'Revenue (Selected Range)','subtitle' => 'Daily paid totals','chart' => 'daily-revenue','series' => $dailyRevenue ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.chart-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Revenue (Selected Range)','subtitle' => 'Daily paid totals','chart' => 'daily-revenue','series' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dailyRevenue ?? [])]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.chart-card','data' => ['title' => 'Service Status Breakdown','subtitle' => 'All service bookings by status','chart' => 'service-status','series' => $serviceStatusCounts ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.chart-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Service Status Breakdown','subtitle' => 'All service bookings by status','chart' => 'service-status','series' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($serviceStatusCounts ?? [])]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.chart-card','data' => ['title' => 'Revenue (6-Month Trend)','subtitle' => 'Monthly paid revenue trend','chart' => 'monthly-revenue','series' => $monthlyRevenue ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.chart-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Revenue (6-Month Trend)','subtitle' => 'Monthly paid revenue trend','chart' => 'monthly-revenue','series' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($monthlyRevenue ?? [])]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.admin.chart-card','data' => ['title' => 'Inventory Health','subtitle' => 'Current stock health distribution','chart' => 'service-status','series' => $inventoryHealth ?? []]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('admin.chart-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Inventory Health','subtitle' => 'Current stock health distribution','chart' => 'service-status','series' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($inventoryHealth ?? [])]); ?>
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

        <div class="ad-analytics-grid">
            <div class="ad-panel">
                <h2 class="ad-panel-title">Top Service Types (Range)</h2>
                <div class="ad-table-wrap">
                    <table class="ad-table">
                        <thead>
                            <tr>
                                <th>Service Type</th>
                                <th>Bookings</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $topServiceTypeRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($service->service_type ?: 'Unspecified'); ?></td>
                                    <td><?php echo e(number_format((int) $service->total_bookings)); ?></td>
                                    <td>Rs. <?php echo e(number_format((float) $service->total_amount, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3">No completed services in selected range.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="ad-panel">
                <h2 class="ad-panel-title">Recent Payments</h2>
                <div class="ad-table-wrap">
                    <table class="ad-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentPaymentRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($payment->order_id); ?></td>
                                    <td><?php echo e($payment->user->name ?? 'N/A'); ?></td>
                                    <td>Rs. <?php echo e(number_format((float) $payment->amount, 2)); ?></td>
                                    <td><?php echo e(ucfirst($payment->status)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4">No payments available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
                const current = new URL(window.location.href);
                window.location.href = current.toString();
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\analytics.blade.php ENDPATH**/ ?>