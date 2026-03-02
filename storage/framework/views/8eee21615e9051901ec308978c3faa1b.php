<?php $__env->startSection('title', 'Rental Reports'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4 font-semibold transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Dashboard
        </a>
    </div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Rental Reports & Analytics</h1>
        <p class="text-gray-600">Comprehensive rental management statistics</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-sm text-gray-500 mb-2">Total Rentals</p>
            <p class="text-3xl font-bold text-gray-800"><?php echo e($totalRentals); ?></p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-sm text-gray-500 mb-2">Completed</p>
            <p class="text-3xl font-bold text-green-600"><?php echo e($completedRentals); ?></p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-sm text-gray-500 mb-2">Active Rentals</p>
            <p class="text-3xl font-bold text-blue-600"><?php echo e($activeRentals); ?></p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-sm text-gray-500 mb-2">Total Revenue</p>
            <p class="text-3xl font-bold text-purple-600">Rs. <?php echo e(number_format($totalRevenue, 2)); ?></p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-sm text-gray-500 mb-2">Damage Reports</p>
            <p class="text-3xl font-bold text-red-600"><?php echo e($damageReports); ?></p>
        </div>
    </div>

    <!-- Detailed Rental History -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Recent Rental History</h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Renter</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Period</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cost</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Staff</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Damage</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $recentRentals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?php echo e($rental->id); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <?php echo e($rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model)); ?>

                            <br>
                            <span class="text-xs text-gray-500"><?php echo e($rental->vehicle->plate_number); ?></span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900"><?php echo e($rental->renter->name); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?php echo e($rental->vehicle->is_service_center_vehicle ? 'Service Center' : ($rental->owner->name ?? 'Customer')); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php echo e(\Carbon\Carbon::parse($rental->start_date)->format('M d')); ?> - 
                            <?php echo e(\Carbon\Carbon::parse($rental->end_date)->format('M d, Y')); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                            Rs. <?php echo e(number_format($rental->total_cost, 2)); ?>

                            <?php if($rental->damage_charge): ?>
                                <br>
                                <span class="text-xs text-red-600">+Rs. <?php echo e(number_format($rental->damage_charge, 2)); ?> damage</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'Approved' => 'bg-green-100 text-green-800',
                                    'Ready for Pickup' => 'bg-blue-100 text-blue-800',
                                    'Picked Up' => 'bg-indigo-100 text-indigo-800',
                                    'In Use' => 'bg-purple-100 text-purple-800',
                                    'Returned' => 'bg-gray-100 text-gray-800',
                                    'Completed' => 'bg-green-100 text-green-800',
                                    'Rejected' => 'bg-red-100 text-red-800',
                                    'Cancelled' => 'bg-red-100 text-red-800',
                                ];
                            ?>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full <?php echo e($statusColors[$rental->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                <?php echo e($rental->status); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <?php echo e($rental->assignedStaff ? $rental->assignedStaff->name : '-'); ?>

                        </td>
                        <td class="px-6 py-4 text-center">
                            <?php if($rental->has_damage): ?>
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
                                    Yes
                                </span>
                            <?php else: ?>
                                <span class="text-gray-400 text-xs">No</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="px-6 py-8 text-center text-gray-500">No rental records found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Insights Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Revenue Breakdown</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Rental Income</span>
                    <span class="font-bold text-gray-800">Rs. <?php echo e(number_format($totalRevenue, 2)); ?></span>
                </div>
                <?php
                    $totalDamageCharges = $recentRentals->sum('damage_charge');
                ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Damage Charges</span>
                    <span class="font-bold text-red-600">Rs. <?php echo e(number_format($totalDamageCharges, 2)); ?></span>
                </div>
                <div class="flex justify-between pt-3 border-t border-gray-200">
                    <span class="text-gray-800 font-semibold">Total Revenue</span>
                    <span class="font-bold text-green-600">Rs. <?php echo e(number_format($totalRevenue + $totalDamageCharges, 2)); ?></span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Performance Metrics</h3>
            <div class="space-y-3">
                <?php
                    $completionRate = $totalRentals > 0 ? round(($completedRentals / $totalRentals) * 100, 1) : 0;
                    $damageRate = $totalRentals > 0 ? round(($damageReports / $totalRentals) * 100, 1) : 0;
                ?>
                <div class="flex justify-between">
                    <span class="text-gray-600">Completion Rate</span>
                    <span class="font-bold text-green-600"><?php echo e($completionRate); ?>%</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Damage Rate</span>
                    <span class="font-bold <?php echo e($damageRate > 10 ? 'text-red-600' : 'text-yellow-600'); ?>"><?php echo e($damageRate); ?>%</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Avg. Rental Value</span>
                    <span class="font-bold text-blue-600">
                        Rs. <?php echo e($totalRentals > 0 ? number_format($totalRevenue / $totalRentals, 2) : '0.00'); ?>

                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/rentals/reports.blade.php ENDPATH**/ ?>