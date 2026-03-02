<?php $__env->startSection('title', 'Admin Dashboard - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php
    $recentBookingRows = collect($recentBookings ?? [])->filter()->values();
?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Dashboard</h1>
                <p class="text-gray-600">Real-time overview of services, payments, inventory, and operations</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="<?php echo e(route('admin.analytics')); ?>" class="px-4 py-2 rounded-lg bg-[#ff5a1f] text-white text-sm font-semibold hover:opacity-90">Open Analytics</a>
                <a href="<?php echo e(route('admin.services')); ?>" class="px-4 py-2 rounded-lg bg-white border border-gray-300 text-gray-700 text-sm font-semibold hover:bg-gray-50">Manage Services</a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Total Services</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((int) ($totalServices ?? 0))); ?></h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">In Progress</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((int) ($inProgressServices ?? 0))); ?></h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Completed Today</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((int) ($completedToday ?? 0))); ?></h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Total Revenue</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">Rs. <?php echo e(number_format((float) ($totalRevenue ?? 0), 2)); ?></h3>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Pending Review</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((int) ($pendingReview ?? 0))); ?></h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Active Rentals</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((int) ($activeRentals ?? 0))); ?></h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Low Stock Items</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((int) ($lowStockItems ?? 0))); ?></h3>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-500 text-sm font-medium">Pending Withdrawals</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo e(number_format((int) ($pendingWithdrawals ?? 0))); ?></h3>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-900">Recent Service Bookings</h2>
                    <a href="<?php echo e(route('admin.services')); ?>" class="text-sm font-semibold text-[#ff5a1f] hover:underline">View all</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-3 pr-4">Booking</th>
                                <th class="py-3 pr-4">Customer</th>
                                <th class="py-3 pr-4">Staff</th>
                                <th class="py-3 pr-4">Status</th>
                                <th class="py-3 pr-4">Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recentBookingRows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-b last:border-0">
                                    <td class="py-3 pr-4 font-semibold text-gray-800"><?php echo e(data_get($booking, 'booking_code', '#' . data_get($booking, 'id'))); ?></td>
                                    <td class="py-3 pr-4 text-gray-700"><?php echo e(data_get($booking, 'customer.name', 'N/A')); ?></td>
                                    <td class="py-3 pr-4 text-gray-700"><?php echo e(data_get($booking, 'staff.name', 'Unassigned')); ?></td>
                                    <td class="py-3 pr-4 text-gray-700"><?php echo e(data_get($booking, 'status', 'N/A')); ?></td>
                                    <td class="py-3 pr-4 text-gray-500"><?php echo e(optional(data_get($booking, 'updated_at'))->diffForHumans()); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-500">No service bookings found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h2>
                <div class="space-y-3">
                    <a href="<?php echo e(route('admin.users')); ?>" class="block px-4 py-3 rounded-lg bg-gray-50 hover:bg-orange-50 text-gray-700 font-semibold">Manage Users</a>
                    <a href="<?php echo e(route('admin.staff-applications.index')); ?>" class="block px-4 py-3 rounded-lg bg-gray-50 hover:bg-orange-50 text-gray-700 font-semibold">Review Staff Applications</a>
                    <a href="<?php echo e(route('admin.inventory.index')); ?>" class="block px-4 py-3 rounded-lg bg-gray-50 hover:bg-orange-50 text-gray-700 font-semibold">Check Inventory</a>
                    <a href="<?php echo e(route('admin.messages')); ?>" class="block px-4 py-3 rounded-lg bg-gray-50 hover:bg-orange-50 text-gray-700 font-semibold">Open Messages</a>
                </div>

                <div class="mt-6 rounded-lg border border-gray-100 bg-gray-50 p-4">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Service Revenue</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">Rs. <?php echo e(number_format((float) ($totalServiceCharge ?? 0), 2)); ?></p>
                    <p class="text-sm text-gray-500 mt-1">From completed service bookings</p>
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>