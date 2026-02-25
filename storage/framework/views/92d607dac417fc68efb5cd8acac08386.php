

<?php $__env->startSection('title', 'Message Monitoring'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
    
    <aside class="w-64 flex-shrink-0 z-30">
        <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    
    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-7xl w-full mx-auto p-6">
            <div class="flex items-center justify-between mb-6 mt-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Message Monitoring</h1>
                    <p class="text-gray-500 mt-1">Monitor all staff-customer communications</p>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
                <form method="GET" action="<?php echo e(route('admin.messages')); ?>" class="flex gap-4 items-end">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Booking</label>
                        <select name="booking_id" class="w-full rounded-lg border-gray-200">
                            <option value="">All bookings</option>
                            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($booking->id); ?>" <?php echo e(request('booking_id') == $booking->id ? 'selected' : ''); ?>>
                                    <?php echo e($booking->booking_code); ?> - <?php echo e($booking->service_type); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="rounded-lg border-gray-200" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="rounded-lg border-gray-200" />
                    </div>
                    <button type="submit" class="px-6 py-2 bg-[#ff5a1f] text-white rounded-lg font-medium hover:bg-[#e64b15]">
                        Filter
                    </button>
                    <a href="<?php echo e(route('admin.messages')); ?>" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200">
                        Reset
                    </a>
                </form>
            </div>

            
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-xs uppercase tracking-widest text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Date/Time</th>
                                <th class="px-6 py-3">From</th>
                                <th class="px-6 py-3">To</th>
                                <th class="px-6 py-3">Message</th>
                                <th class="px-6 py-3">Booking</th>
                                <th class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <?php echo e($message->created_at->format('M d, Y')); ?><br/>
                                        <span class="text-xs text-gray-400"><?php echo e($message->created_at->format('h:i A')); ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs mr-2">
                                                <?php echo e(strtoupper(substr($message->sender->name ?? 'U', 0, 2))); ?>

                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900"><?php echo e($message->sender->name ?? 'Unknown'); ?></p>
                                                <p class="text-xs text-gray-500"><?php echo e(class_basename($message->sender_type)); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs mr-2">
                                                <?php echo e(strtoupper(substr($message->receiver->name ?? 'U', 0, 2))); ?>

                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900"><?php echo e($message->receiver->name ?? 'Unknown'); ?></p>
                                                <p class="text-xs text-gray-500"><?php echo e(class_basename($message->receiver_type)); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 max-w-md">
                                        <p class="text-sm text-gray-900 truncate"><?php echo e($message->message); ?></p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <?php if($message->booking): ?>
                                            <a href="<?php echo e(route('bookings.show', $message->booking->id)); ?>" class="text-[#ff5a1f] hover:underline">
                                                <?php echo e($message->booking->booking_code); ?>

                                            </a>
                                        <?php else: ?>
                                            <span class="text-gray-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($message->is_read): ?>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Read
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Unread
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        No messages found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($messages->hasPages()): ?>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <?php echo e($messages->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\messages.blade.php ENDPATH**/ ?>