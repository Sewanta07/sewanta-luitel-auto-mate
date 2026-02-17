

<?php $__env->startSection('title', 'Service History - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mb-8 mt-4">
            <h1 class="text-3xl font-bold text-gray-900">Service History</h1>
            <p class="mt-2 text-lg text-gray-600">View details of all your completed vehicle services.</p>
        </div>

        <form method="GET" action="<?php echo e(route('customer.history')); ?>" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="vehicle" class="sr-only">Filter by Vehicle</label>
                    <select id="vehicle" name="vehicle" class="block w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition cursor-pointer">
                        <option value="">All Vehicles</option>
                        <?php $__currentLoopData = $vehicleOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vehicle->vehicle_number); ?>" <?php echo e(request('vehicle') === $vehicle->vehicle_number ? 'selected' : ''); ?>>
                                <?php echo e($vehicle->vehicle_model); ?><?php echo e($vehicle->vehicle_year ? ' (' . $vehicle->vehicle_year . ')' : ''); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label for="service" class="sr-only">Filter by Service Type</label>
                    <select id="service" name="service" class="block w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition cursor-pointer">
                        <option value="">All Service Types</option>
                        <?php $__currentLoopData = $serviceOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($serviceType); ?>" <?php echo e(request('service') === $serviceType ? 'selected' : ''); ?>>
                                <?php echo e($serviceType); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="md:col-span-2 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search by booking, vehicle, service..." class="block w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition">
                </div>
            </div>
            <div class="mt-4 flex justify-end gap-2">
                <a href="<?php echo e(route('customer.history')); ?>" class="px-4 py-2 rounded-lg border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">Reset</a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-[#ff5a1f] text-sm font-semibold text-white hover:bg-[#e64b15] transition">Apply</button>
            </div>
        </form>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <?php if($history->isEmpty()): ?>
                <div class="flex flex-col items-center justify-center py-20 px-4 text-center">
                    <div class="p-4 bg-gray-50 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2-11a4 4 0 00-4-4H7a4 4 0 00-4 4v12a4 4 0 004 4h6a4 4 0 004-4V5z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">No service history available yet</h3>
                    <p class="text-gray-500 mb-6">Completed services will appear here.</p>
                    <a href="<?php echo e(route('bookings.create')); ?>" class="px-6 py-2 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition">
                        Request a Service
                    </a>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Booking</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Vehicle</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Service Type</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Completed</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Mechanic</th>
                                <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-bold text-gray-900"><?php echo e($item->booking_code ?? ('#' . $item->id)); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo e($item->preferred_time_slot ?? 'N/A'); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-medium text-gray-900"><?php echo e($item->vehicle_model); ?></p>
                                        <p class="text-xs text-gray-500 font-mono"><?php echo e($item->vehicle_number); ?></p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                            <?php echo e($item->service_type); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <?php echo e(optional($item->updated_at)->format('M d, Y')); ?>

                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <?php echo e($item->staff->name ?? 'Not Assigned'); ?>

                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="<?php echo e(route('bookings.show', $item->id)); ?>" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-[#ff5a1f] text-[#ff5a1f] text-xs font-bold hover:bg-orange-50 transition">
                                                View Details
                                            </a>
                                            <a href="<?php echo e(route('bookings.invoice', $item->id)); ?>" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 text-gray-700 text-xs font-bold hover:bg-gray-50 transition">
                                                Invoice
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    <?php echo e($history->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/history.blade.php ENDPATH**/ ?>