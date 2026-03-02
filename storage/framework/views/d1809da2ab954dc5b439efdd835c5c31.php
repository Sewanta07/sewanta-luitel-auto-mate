

<?php $__env->startSection('title', 'Payment Receipt - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 sm:p-7">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-black text-gray-900">Payment Receipt</h1>
                    <p class="text-gray-500 mt-1"><?php echo e(ucfirst(str_replace('_', ' ', $payment->type))); ?></p>
                    <div class="mt-3 space-y-1">
                        <p class="text-sm font-black text-gray-800"><?php echo e(config('billing.company_name', config('app.name', 'AutoMate'))); ?></p>
                        <p class="text-xs text-gray-500"><?php echo e(config('billing.tagline', 'Vehicle Service & Rental Management')); ?></p>
                        <?php if(config('billing.address')): ?>
                            <p class="text-xs text-gray-500"><?php echo e(config('billing.address')); ?></p>
                        <?php endif; ?>
                        <p class="text-xs text-gray-500">
                            <?php echo e(config('billing.website')); ?> • <?php echo e(config('billing.email')); ?>

                            <?php if(config('billing.phone')): ?>
                                • <?php echo e(config('billing.phone')); ?>

                            <?php endif; ?>
                            <?php if(config('billing.vat')): ?>
                                • VAT: <?php echo e(config('billing.vat')); ?>

                            <?php endif; ?>
                        </p>
                    </div>
                </div>
                <span class="px-3 py-1 text-xs font-black uppercase tracking-widest rounded-full bg-green-50 text-green-600">Paid</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Receipt ID</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($payment->order_id); ?></p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Transaction ID</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e($payment->transaction_id ?? 'N/A'); ?></p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Paid Date</p>
                    <p class="text-sm font-bold text-gray-900"><?php echo e(($payment->paid_at ?? $payment->created_at)?->format('M d, Y • g:i A')); ?></p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Payment Method</p>
                    <p class="text-sm font-bold text-gray-900">eSewa</p>
                </div>
            </div>

            <div class="mt-6 border-t border-gray-100 pt-5">
                <h3 class="text-sm font-bold text-gray-700 mb-3">Details</h3>
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-4 space-y-3">
                    <?php if($prefix === 'service_booking' && $entity): ?>
                        <?php ($partsTotal = $entity->parts->sum('pivot.total_cost')); ?>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Booking</p>
                            <p class="text-sm font-bold text-gray-900"><?php echo e($entity->booking_code); ?></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Service</p>
                            <p class="text-sm font-bold text-gray-900"><?php echo e($entity->service_type); ?></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Vehicle</p>
                            <p class="text-sm font-bold text-gray-900"><?php echo e($entity->vehicle_model); ?> • <?php echo e($entity->vehicle_number); ?></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Charge Breakdown</p>
                            <p class="text-sm font-bold text-gray-900 text-right">Service Rs. <?php echo e(number_format((float) ($entity->service_cost ?? 0), 2)); ?> + Spare Rs. <?php echo e(number_format((float) ($entity->spare_parts_cost ?? 0), 2)); ?> + Parts Rs. <?php echo e(number_format((float) $partsTotal, 2)); ?></p>
                        </div>
                    <?php elseif(in_array($prefix, ['rental_request', 'rental_damage'], true) && $entity): ?>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Rental Request</p>
                            <p class="text-sm font-bold text-gray-900">#<?php echo e($entity->id); ?></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Vehicle</p>
                            <p class="text-sm font-bold text-gray-900"><?php echo e($entity->vehicle?->vehicle_name ?: (($entity->vehicle?->brand ?? '') . ' ' . ($entity->vehicle?->model ?? ''))); ?></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Duration</p>
                            <p class="text-sm font-bold text-gray-900"><?php echo e($entity->start_date ? $entity->start_date->format('M d, Y') : 'N/A'); ?> - <?php echo e($entity->end_date ? $entity->end_date->format('M d, Y') : 'N/A'); ?></p>
                        </div>
                    <?php elseif(in_array($prefix, ['admin_rental', 'marketplace_rental'], true) && $entity): ?>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Rental</p>
                            <p class="text-sm font-bold text-gray-900">#<?php echo e($entity->id); ?></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Vehicle</p>
                            <p class="text-sm font-bold text-gray-900"><?php echo e($entity->vehicle?->vehicle_name ?: (($entity->vehicle?->brand ?? '') . ' ' . ($entity->vehicle?->model ?? ''))); ?></p>
                        </div>
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-bold text-gray-500">Duration</p>
                            <p class="text-sm font-bold text-gray-900"><?php echo e($entity->start_date ? $entity->start_date->format('M d, Y') : 'N/A'); ?> - <?php echo e($entity->end_date ? $entity->end_date->format('M d, Y') : 'N/A'); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="flex items-center justify-between pt-2 border-t border-gray-200">
                        <p class="text-sm font-bold text-gray-500">Amount Paid</p>
                        <p class="text-xl font-black text-[#ff5a1f]">Rs. <?php echo e(number_format((float) $payment->amount, 2)); ?></p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="<?php echo e(route('bookings.index')); ?>" class="flex-1 px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl text-center hover:bg-gray-200">Back to Bookings</a>
                <a href="<?php echo e(route('customer.rentals')); ?>" class="flex-1 px-6 py-3 bg-[#ff5a1f] text-white font-black rounded-xl text-center hover:bg-[#e44d18]">My Rentals</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/payments/receipt.blade.php ENDPATH**/ ?>