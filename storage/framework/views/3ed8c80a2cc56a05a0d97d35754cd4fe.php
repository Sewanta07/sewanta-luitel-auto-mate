

<?php $__env->startSection('title', 'Conversation Monitoring'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
    <aside class="w-64 flex-shrink-0 z-30">
        <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-7xl w-full mx-auto p-6">
            <div class="mb-6 mt-4">
                <h1 class="text-3xl font-bold text-gray-900">Conversation Monitoring</h1>
                <p class="text-gray-500 mt-1">Read-only view of customer and staff chat</p>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
                <form method="GET" action="<?php echo e(route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id])); ?>" class="flex gap-4 items-end flex-wrap">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="rounded-lg border-gray-200" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="rounded-lg border-gray-200" />
                    </div>
                    <button type="submit" class="px-6 py-2 bg-[#ff5a1f] text-white rounded-lg font-medium hover:bg-[#e64b15]">Filter</button>
                    <a href="<?php echo e(route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id])); ?>" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200">Reset</a>
                    <a href="<?php echo e(route('admin.messages')); ?>" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200">Back</a>
                </form>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white">
                            <h2 class="text-xl font-bold text-white">Conversations</h2>
                        </div>

                        <div class="divide-y max-h-[600px] overflow-y-auto bg-white">
                            <?php $__empty_1 = true; $__currentLoopData = $conversationList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $listCustomer = $users[$conversation->customer_id] ?? null;
                                    $listStaff = $users[$conversation->staff_id] ?? null;
                                    $pair = [(int) $conversation->customer_id, (int) $conversation->staff_id];
                                    sort($pair);
                                    $lastMessage = $lastMessages->get(implode('-', $pair));
                                    $isActive = (int) $conversation->customer_id === (int) $customer->id && (int) $conversation->staff_id === (int) $staff->id;
                                ?>
                                <?php if($listCustomer && $listStaff): ?>
                                    <a href="<?php echo e(route('admin.messages.conversation', ['customer' => $listCustomer->id, 'staff' => $listStaff->id])); ?>" class="block p-4 hover:bg-orange-50 transition-colors border-l-4 <?php echo e($isActive ? 'border-[#ff5a1f] bg-orange-50' : 'border-transparent'); ?>">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 rounded-full bg-[#ff5a1f] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                                <?php echo e(strtoupper(substr($listCustomer->name ?? 'C', 0, 1))); ?>

                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="font-bold text-gray-900 truncate"><?php echo e($listCustomer->name); ?></p>
                                                <p class="text-xs text-gray-500 truncate">with <?php echo e($listStaff->name); ?></p>
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
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col h-full" style="max-height: 700px;">
                        <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white border-b">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center text-white font-bold text-lg">
                                    <?php echo e(strtoupper(substr($customer->name ?? 'C', 0, 1))); ?>

                                </div>
                                <div>
                                    <h3 class="font-bold text-lg"><?php echo e($customer->name); ?></h3>
                                    <p class="text-orange-100 text-sm">Customer ↔ <?php echo e($staff->name); ?> (Staff)</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex-1 p-6 overflow-y-auto bg-gray-50" id="adminConversationContainer">
                            <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $isCustomer = (int) $message->sender_id === (int) $customer->id;
                                ?>
                                <div class="mb-4 flex <?php echo e($isCustomer ? 'justify-start' : 'justify-end'); ?>" data-message-id="<?php echo e((int) $message->id); ?>">
                                    <div class="max-w-xs lg:max-w-md">
                                        <p class="text-xs font-semibold mb-1.5 <?php echo e($isCustomer ? 'text-gray-900' : 'text-[#ff5a1f] text-right'); ?>">
                                            <?php echo e($isCustomer ? $customer->name : $staff->name); ?>

                                        </p>
                                        <div class="px-4 py-3 rounded-2xl <?php echo e($isCustomer ? 'bg-gray-200 text-gray-900 rounded-bl-none' : 'bg-[#ff5a1f] text-white rounded-br-none'); ?>">
                                            <p class="break-words"><?php echo e($message->message); ?></p>
                                            <p class="text-xs mt-2 <?php echo e($isCustomer ? 'text-gray-600' : 'text-orange-50'); ?>">
                                                <?php echo e($message->created_at->format('M d, g:i A')); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="h-full flex items-center justify-center text-gray-500">
                                    <p>No messages found for this conversation</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="p-4 border-t bg-white text-sm text-gray-500">
                            Monitoring mode: Admin can view messages only.
                        </div>
                    </div>
                </div>
            </div>

            <?php if($messages->hasPages()): ?>
                <div class="mt-6 px-2">
                    <?php echo e($messages->links()); ?>

                </div>
            <?php endif; ?>
        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('adminConversationContainer');
        const conversationId = <?php echo json_encode($conversationId, 15, 512) ?>;
        const customerId = <?php echo json_encode((int) $customer->id, 15, 512) ?>;
        const staffId = <?php echo json_encode((int) $staff->id, 15, 512) ?>;
        const customerName = <?php echo json_encode($customer->name, 15, 512) ?>;
        const staffName = <?php echo json_encode($staff->name, 15, 512) ?>;

        const formatDate = (value) => {
            if (!value) {
                return '';
            }

            const date = new Date(value);
            if (Number.isNaN(date.getTime())) {
                return '';
            }

            return {
                day: date.toLocaleDateString(undefined, { month: 'short', day: '2-digit', year: 'numeric' }),
                time: date.toLocaleTimeString(undefined, { hour: '2-digit', minute: '2-digit', hour12: true }),
            };
        };

        const appendMessage = (payload) => {
            if (!container || !payload || !payload.id) {
                return;
            }

            if (document.querySelector(`[data-message-id="${payload.id}"]`)) {
                return;
            }

            const isCustomer = Number(payload.sender_id) === Number(customerId);
            const senderName = isCustomer ? customerName : staffName;
            const wrapperClass = isCustomer ? 'justify-start' : 'justify-end';
            const labelClass = isCustomer ? 'text-gray-900' : 'text-[#ff5a1f] text-right';
            const bubbleClass = isCustomer
                ? 'bg-gray-200 text-gray-900 rounded-bl-none'
                : 'bg-[#ff5a1f] text-white rounded-br-none';
            const timeClass = isCustomer ? 'text-gray-600' : 'text-orange-50';
            const dateParts = formatDate(payload.created_at);

            const wrapper = document.createElement('div');
            wrapper.className = `mb-4 flex ${wrapperClass}`;
            wrapper.dataset.messageId = String(payload.id);
            wrapper.innerHTML = `
                <div class="max-w-xs lg:max-w-md">
                    <p class="text-xs font-semibold mb-1.5 ${labelClass}">${senderName}</p>
                    <div class="px-4 py-3 rounded-2xl ${bubbleClass}">
                        <p class="break-words"></p>
                        <p class="text-xs mt-2 ${timeClass}">${dateParts.day ?? ''} ${dateParts.time ?? ''}</p>
                    </div>
                </div>
            `;

            const textNode = wrapper.querySelector('.break-words');
            if (textNode) {
                textNode.textContent = payload.message ?? '';
            }

            container.appendChild(wrapper);
            container.scrollTop = container.scrollHeight;
        };

        if (window.realtime && conversationId) {
            window.realtime.subscribeChat(conversationId, {
                message: appendMessage,
            });
        }

        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/messages-conversation.blade.php ENDPATH**/ ?>