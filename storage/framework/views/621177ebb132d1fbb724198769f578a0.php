<?php $__env->startSection('title', 'Message Monitoring'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
    <aside class="w-64 flex-shrink-0 z-30">
        <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-7xl w-full mx-auto p-6">
            <div class="mb-6 mt-4">
                <h1 class="text-3xl font-bold text-gray-900">Message Monitoring</h1>
                <p class="text-gray-500 mt-1">Customer-staff conversations (read-only)</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
                <form method="GET" action="<?php echo e(route('admin.messages')); ?>" class="flex gap-4 items-end flex-wrap">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="rounded-lg border-gray-200" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="rounded-lg border-gray-200" />
                    </div>
                    <button type="submit" class="px-6 py-2 bg-[#ff5a1f] text-white rounded-lg font-medium hover:bg-[#e64b15]">Filter</button>
                    <a href="<?php echo e(route('admin.messages')); ?>" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200">Reset</a>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white">
                            <h2 class="text-xl font-bold text-white">Conversations</h2>
                        </div>

                        <div class="divide-y max-h-[560px] overflow-y-auto bg-white">
                            <?php $__empty_1 = true; $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $customer = $users[$conversation->customer_id] ?? null;
                                    $staff = $users[$conversation->staff_id] ?? null;
                                    $pair = [(int) $conversation->customer_id, (int) $conversation->staff_id];
                                    sort($pair);
                                    $lastMessage = $lastMessages->get(implode('-', $pair));
                                ?>
                                <?php if($customer && $staff): ?>
                                    <a href="<?php echo e(route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id])); ?>" class="block p-4 hover:bg-orange-50 transition-colors border-l-4 border-transparent">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 rounded-full bg-[#ff5a1f] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                <?php echo e(strtoupper(substr($customer->name ?? 'C', 0, 1))); ?>

                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="font-bold text-gray-900 truncate"><?php echo e($customer->name); ?></p>
                                                <p class="text-xs text-gray-500 truncate">with <?php echo e($staff->name); ?></p>
                                                <p class="text-xs text-gray-600 truncate mt-1"><?php echo e($lastMessage?->message ?? 'No message preview'); ?></p>
                                            </div>
                                            <?php if((int) $conversation->unread_count > 0): ?>
                                                <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full flex-shrink-0"><?php echo e((int) $conversation->unread_count); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="p-8 text-center text-gray-500">
                                    <p class="font-medium">No conversations yet</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg p-12 flex items-center justify-center h-full min-h-[560px]">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Select a Conversation</h3>
                            <p class="text-gray-600">Choose a thread from the left to monitor messages</p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($conversations->hasPages()): ?>
                <div class="mt-6 px-2">
                    <?php echo e($conversations->links()); ?>

                </div>
            <?php endif; ?>
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