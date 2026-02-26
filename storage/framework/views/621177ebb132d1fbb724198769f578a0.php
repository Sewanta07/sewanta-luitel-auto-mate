

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
                    <p class="text-gray-500 mt-1">Browse each customer-staff conversation thread</p>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
                <form method="GET" action="<?php echo e(route('admin.messages')); ?>" class="flex gap-4 items-end">
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
                                <th class="px-6 py-3">Customer</th>
                                <th class="px-6 py-3">Staff</th>
                                <th class="px-6 py-3">Last Message</th>
                                <th class="px-6 py-3">Count</th>
                                <th class="px-6 py-3">Unread</th>
                                <th class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php $__empty_1 = true; $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $customer = $users[$conversation->customer_id] ?? null;
                                    $staff = $users[$conversation->staff_id] ?? null;
                                    $pair = [(int) $conversation->customer_id, (int) $conversation->staff_id];
                                    sort($pair);
                                    $lastMessage = $lastMessages->get(implode('-', $pair));
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs mr-2">
                                                <?php echo e(strtoupper(substr($customer->name ?? 'U', 0, 2))); ?>

                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900"><?php echo e($customer->name ?? 'Unknown'); ?></p>
                                                <p class="text-xs text-gray-500">Customer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs mr-2">
                                                <?php echo e(strtoupper(substr($staff->name ?? 'U', 0, 2))); ?>

                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900"><?php echo e($staff->name ?? 'Unknown'); ?></p>
                                                <p class="text-xs text-gray-500">Staff</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 max-w-md">
                                        <p class="text-sm text-gray-900 truncate"><?php echo e($lastMessage?->message ?? 'No message preview'); ?></p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            <?php echo e($conversation->last_message_at ? \Carbon\Carbon::parse($conversation->last_message_at)->format('M d, Y h:i A') : '-'); ?>

                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 font-semibold"><?php echo e((int) $conversation->total_messages); ?></td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium <?php echo e((int) $conversation->unread_count > 0 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'); ?>">
                                            <?php echo e((int) $conversation->unread_count); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if($customer && $staff): ?>
                                            <a href="<?php echo e(route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id])); ?>" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-[#ff5a1f] text-white text-xs font-semibold hover:bg-[#e64b15]">
                                                View Conversation
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        No customer-staff conversations found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <?php if($conversations->hasPages()): ?>
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        <?php echo e($conversations->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let reloadTimer = null;

        const scheduleReload = () => {
            if (reloadTimer) {
                return;
            }

            reloadTimer = setTimeout(() => {
                window.location.reload();
            }, 700);
        };

        if (window.realtime) {
            window.realtime.subscribeDashboard('admin', null, {
                chatMessage: scheduleReload,
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/messages.blade.php ENDPATH**/ ?>