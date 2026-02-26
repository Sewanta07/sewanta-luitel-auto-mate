

<?php $__env->startSection('title', 'Service Invoice'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Service Invoice</h1>
                    <p class="text-gray-500 mt-1">Booking <?php echo e($booking->booking_code); ?></p>
                </div>
                <span class="px-3 py-1 text-xs font-bold uppercase tracking-widest rounded-full bg-green-50 text-green-600"><?php echo e($booking->status); ?></span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Customer</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($booking->customer->name ?? 'N/A'); ?></p>
                    <p class="text-sm text-gray-500"><?php echo e($booking->customer->email ?? 'N/A'); ?></p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Staff</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($booking->staff->name ?? 'Unassigned'); ?></p>
                    <p class="text-sm text-gray-500"><?php echo e($booking->staff->email ?? ''); ?></p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Vehicle</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($booking->vehicle_model); ?></p>
                    <p class="text-sm text-gray-500"><?php echo e($booking->vehicle_number); ?> • <?php echo e($booking->vehicle_type); ?></p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Service</p>
                    <p class="text-lg font-bold text-gray-900"><?php echo e($booking->service_type); ?></p>
                    <p class="text-sm text-gray-500"><?php echo e(\Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y')); ?> • <?php echo e($booking->preferred_time_slot); ?></p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Priority</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($booking->service_priority); ?></p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Location</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($booking->service_location_type); ?></p>
                </div>
            </div>

            <?php ($partsTotal = $booking->parts->sum('pivot.total_cost')); ?>
            <?php ($serviceTotal = (float) ($booking->service_cost ?? 0) + (float) ($booking->spare_parts_cost ?? 0) + (float) $partsTotal); ?>
            <?php ($displayTotal = $serviceTotal); ?>

            <div class="mt-8 border-t border-gray-100 pt-6">
                <h3 class="text-sm font-bold text-gray-700 mb-4">Parts Used</h3>
                <div class="border border-gray-100 rounded-xl overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 font-semibold border-b border-gray-100">
                            <tr>
                                <th class="px-4 py-3">Part</th>
                                <th class="px-4 py-3 text-center">Qty</th>
                                <th class="px-4 py-3 text-right">Unit Price</th>
                                <th class="px-4 py-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $booking->parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="px-4 py-3 text-gray-900"><?php echo e($part->part_name); ?></td>
                                    <td class="px-4 py-3 text-center text-gray-500"><?php echo e($part->pivot->quantity); ?></td>
                                    <td class="px-4 py-3 text-right text-gray-500">Rs. <?php echo e(number_format($part->pivot->unit_price, 2)); ?></td>
                                    <td class="px-4 py-3 text-right text-gray-900 font-medium">Rs. <?php echo e(number_format($part->pivot->total_cost, 2)); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">No parts recorded.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="bg-gray-50 font-bold text-gray-900">
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-right">Parts Total</td>
                                <td class="px-4 py-3 text-right text-[#ff5a1f]">Rs. <?php echo e(number_format($partsTotal, 2)); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-100 pt-6">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-bold text-gray-500">Service Cost</p>
                    <p class="text-xl font-bold text-gray-900">Rs. <?php echo e(number_format($booking->service_cost ?? 0, 2)); ?></p>
                </div>
                <div class="flex items-center justify-between mt-3">
                    <p class="text-sm font-bold text-gray-500">Spare Parts Cost</p>
                    <p class="text-xl font-bold text-gray-900">Rs. <?php echo e(number_format($booking->spare_parts_cost ?? 0, 2)); ?></p>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <p class="text-sm font-bold text-gray-500">Total Payable</p>
                    <p class="text-2xl font-black text-[#ff5a1f]">Rs. <?php echo e(number_format($displayTotal, 2)); ?></p>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <p class="text-sm font-bold text-gray-500">Payment Status</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold <?php echo e(($booking->payment_status ?? 'pending') === 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'); ?>">
                        <?php echo e(ucfirst($booking->payment_status ?? 'pending')); ?>

                    </span>
                </div>
            </div>

            <div class="mt-8 flex gap-3">
                <a href="<?php echo e(route('admin.services')); ?>" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl text-center hover:bg-gray-200">Back to Services</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/services/invoice.blade.php ENDPATH**/ ?>