

<?php $__env->startSection('title', 'Analytics - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $topServiceTypeRows = $topServiceTypes ?? collect();
    $recentPaymentRows = $recentPayments ?? collect();
?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Analytics Dashboard</h1>
                <p class="text-gray-600">Business performance, conversion, and trend insights</p>
            </div>
            <form method="GET" action="<?php echo e(route('admin.analytics')); ?>" class="flex items-center gap-2">
                <label for="period" class="text-sm font-medium text-gray-600">Range</label>
                <select id="period" name="period" class="rounded-lg border-gray-300 text-sm focus:ring-[#ff5a1f] focus:border-[#ff5a1f]">
                    <?php $__currentLoopData = [7, 30, 90, 180, 365]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $period): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($period); ?>" <?php echo e((int) ($periodDays ?? 30) === $period ? 'selected' : ''); ?>>Last <?php echo e($period); ?> days</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" class="px-4 py-2 rounded-lg bg-[#ff5a1f] text-white text-sm font-semibold hover:opacity-90">Apply</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Revenue (Selected Range)</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rs. <?php echo e(number_format((float) ($periodRevenue ?? 0), 2)); ?></h3>
                <p class="text-xs mt-2 <?php echo e(($periodRevenueChange ?? null) === null ? 'text-gray-400' : (($periodRevenueChange ?? 0) >= 0 ? 'text-green-600' : 'text-red-600')); ?>">
                    <?php if(($periodRevenueChange ?? null) === null): ?>
                        No prior period baseline
                    <?php else: ?>
                        <?php echo e(($periodRevenueChange ?? 0) >= 0 ? '+' : ''); ?><?php echo e(number_format((float) ($periodRevenueChange ?? 0), 1)); ?>% vs previous period
                    <?php endif; ?>
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Completed Services (Range)</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((int) ($periodCompletedServices ?? 0))); ?></h3>
                <p class="text-xs text-gray-500 mt-2">All-time completed: <?php echo e(number_format((int) ($servicesCompleted ?? 0))); ?></p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Payment Success Rate</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((float) ($paymentSuccessRate ?? 0), 1)); ?>%</h3>
                <p class="text-xs text-gray-500 mt-2">Based on payment attempts in selected range</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">New Customers (Range)</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((int) ($periodNewCustomers ?? 0))); ?></h3>
                <p class="text-xs text-gray-500 mt-2">Active customers total: <?php echo e(number_format((int) ($activeCustomers ?? 0))); ?></p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Top Service Types (Range)</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-3 pr-4">Service Type</th>
                                <th class="py-3 pr-4">Bookings</th>
                                <th class="py-3 pr-4">Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $topServiceTypeRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-b last:border-0">
                                    <td class="py-3 pr-4 text-gray-800 font-semibold"><?php echo e($service->service_type ?: 'Unspecified'); ?></td>
                                    <td class="py-3 pr-4 text-gray-700"><?php echo e(number_format((int) $service->total_bookings)); ?></td>
                                    <td class="py-3 pr-4 text-gray-700">Rs. <?php echo e(number_format((float) $service->total_amount, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="py-6 text-center text-gray-500">No completed services in selected range.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Payments</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-3 pr-4">Order</th>
                                <th class="py-3 pr-4">Customer</th>
                                <th class="py-3 pr-4">Amount</th>
                                <th class="py-3 pr-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentPaymentRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-b last:border-0">
                                    <td class="py-3 pr-4 text-gray-800 font-semibold"><?php echo e($payment->order_id); ?></td>
                                    <td class="py-3 pr-4 text-gray-700"><?php echo e($payment->user->name ?? 'N/A'); ?></td>
                                    <td class="py-3 pr-4 text-gray-700">Rs. <?php echo e(number_format((float) $payment->amount, 2)); ?></td>
                                    <td class="py-3 pr-4 text-gray-700"><?php echo e(ucfirst($payment->status)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-500">No payments available.</td>
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/analytics.blade.php ENDPATH**/ ?>