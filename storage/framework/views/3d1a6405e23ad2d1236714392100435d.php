<?php $__env->startSection('title', 'Staff Messages'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Messages</h1>
            <p class="text-gray-600 mt-2">Connect with your customers</p>
        </div>

        <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center text-green-700 font-medium">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white">
                        <h2 class="text-xl font-bold text-white">Conversations</h2>
                    </div>

                    <div class="divide-y max-h-96 overflow-y-auto bg-white">
                        <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(route('staff.customers.messages', $c->id)); ?>" class="block p-4 transition-all border-l-4 text-gray-900 visited:text-gray-900 hover:text-gray-900 no-underline <?php echo e($customer->id === $c->id ? 'border-[#ff5a1f] bg-orange-50 shadow-md' : 'border-transparent hover:bg-gray-50'); ?>">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-full bg-[#ff5a1f] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        <?php echo e(strtoupper(substr($c->name ?? $c->email ?? 'C', 0, 1))); ?>

                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 truncate"><?php echo e($c->name ?? 'Customer'); ?></p>
                                        <p class="text-xs text-gray-700 truncate mt-0.5"><?php echo e($c->email); ?></p>
                                    </div>
                                    <?php if(isset($c->unread_count) && $c->unread_count > 0): ?>
                                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full flex-shrink-0"><?php echo e($c->unread_count); ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="p-8 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <p class="font-medium">No conversations yet</p>
                                <p class="text-xs mt-1">Messages from customers will appear here</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col h-full max-h-[650px]">
                    <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center text-white font-bold text-lg">
                                <?php echo e(strtoupper(substr($customer->name ?? 'C', 0, 1))); ?>

                            </div>
                            <div>
                                <h3 class="font-bold text-lg"><?php echo e($customer->name); ?></h3>
                                <p class="text-orange-100 text-sm"><?php echo e($customer->email); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php if($bookings->count() > 0): ?>
                        <div class="p-4 bg-gray-50 border-b border-gray-100">
                        <p class="text-xs uppercase tracking-wide text-gray-700 font-bold mb-2">Related Bookings</p>
                            <div class="flex gap-2 flex-wrap">
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('staff.services.show', $booking->id)); ?>" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-gray-900 no-underline bg-white border border-gray-200 hover:border-[#ff5a1f] hover:text-[#ff5a1f] transition">
                                        <?php echo e($booking->booking_code); ?> - <?php echo e($booking->service_type); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="flex-1 p-6 overflow-y-auto bg-gray-50" id="messages-container">
                        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $isSender = (int) $message->sender_id === (int) $staffChatUserId;
                            ?>
                            <div class="mb-4 flex <?php echo e($isSender ? 'justify-end' : 'justify-start'); ?>" data-message-id="<?php echo e((int) $message->id); ?>">
                                <div class="max-w-xs lg:max-w-md">
                                    <p class="text-xs font-semibold mb-1.5 <?php echo e($isSender ? 'text-[#ff5a1f] text-right' : 'text-gray-900'); ?>">
                                        <?php echo e($isSender ? 'You' : $customer->name); ?>

                                    </p>
                                    <div class="px-4 py-3 rounded-2xl <?php echo e($isSender ? 'bg-[#ff5a1f] text-white rounded-br-none' : 'bg-gray-200 text-gray-900 rounded-bl-none'); ?>">
                                        <p class="break-words"><?php echo e($message->message); ?></p>
                                        <p class="text-xs mt-2 <?php echo e($isSender ? 'text-orange-50' : 'text-gray-700'); ?>">
                                            <?php echo e($message->created_at->format('M d, g:i A')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="h-full flex items-center justify-center text-gray-500">
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="p-6 border-t bg-white">
                        <form id="staffMessageForm" action="<?php echo e(route('staff.customers.sendMessage', $customer->id)); ?>" method="POST" class="flex gap-3">
                            <?php echo csrf_field(); ?>
                            <div class="flex-1">
                                <textarea id="staffMessageInput" name="message" rows="2" required placeholder="Type your message..." class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl text-gray-900 placeholder-gray-600 font-medium focus:border-[#ff5a1f] focus:ring focus:ring-orange-100 resize-none focus:outline-none transition-all"></textarea>
                            </div>
                            <button type="submit" class="px-6 py-3 bg-[#ff5a1f] text-white font-bold rounded-xl hover:bg-[#e44d18] transition-all flex items-center gap-2 self-end">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"/>
                                </svg>
                                Send
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('messages-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }

        const conversationId = <?php echo json_encode($conversationId, 15, 512) ?>;
        const currentUserId = <?php echo json_encode((int) $staffChatUserId, 15, 512) ?>;
        const receiverId = <?php echo json_encode((int) $customerChatUserId, 15, 512) ?>;
        const currentUserName = 'You';
        const otherUserName = <?php echo json_encode($customer->name ?? 'Customer', 15, 512) ?>;
        const form = document.getElementById('staffMessageForm');
        const messageInput = document.getElementById('staffMessageInput');

        const formatDate = (value) => {
            if (!value) {
                return '';
            }

            const date = new Date(value);
            if (Number.isNaN(date.getTime())) {
                return '';
            }

            return date.toLocaleString(undefined, {
                month: 'short',
                day: '2-digit',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true,
                timeZone: 'Asia/Kathmandu',
            });
        };

        const appendMessage = (payload) => {
            if (!container || !payload || !payload.id) {
                return;
            }

            if (document.querySelector(`[data-message-id="${payload.id}"]`)) {
                return;
            }

            const isSender = Number(payload.sender_id) === Number(currentUserId);

            const wrapper = document.createElement('div');
            wrapper.className = `mb-4 flex ${isSender ? 'justify-end' : 'justify-start'}`;
            wrapper.dataset.messageId = String(payload.id);

            const senderLabel = isSender ? currentUserName : otherUserName;
            const bubbleClass = isSender
                ? 'bg-[#ff5a1f] text-white rounded-br-none'
                : 'bg-gray-200 text-gray-900 rounded-bl-none';
            const timeClass = isSender ? 'text-orange-50' : 'text-gray-700';
            const nameClass = isSender ? 'text-[#ff5a1f] text-right' : 'text-gray-900';

            wrapper.innerHTML = `
                <div class="max-w-xs lg:max-w-md">
                    <p class="text-xs font-semibold mb-1.5 ${nameClass}">${senderLabel}</p>
                    <div class="px-4 py-3 rounded-2xl ${bubbleClass}">
                        <p class="break-words"></p>
                        <p class="text-xs mt-2 ${timeClass}">${formatDate(payload.created_at)}</p>
                    </div>
                </div>
            `;

            wrapper.querySelector('.break-words').textContent = payload.message ?? '';
            container.appendChild(wrapper);
            container.scrollTop = container.scrollHeight;
        };

        if (window.realtime) {
            window.realtime.subscribeChat(conversationId, {
                message: (payload) => {
                    if (!payload) {
                        return;
                    }

                    if (Number(payload.sender_id) === Number(currentUserId)) {
                        return;
                    }

                    appendMessage(payload);
                },
            });
        }

        if (form) {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const messageText = (messageInput?.value ?? '').trim();
                if (!messageText) {
                    return;
                }

                if (messageInput) {
                    messageInput.value = '';
                }

                try {
                    const response = await window.axios.post(form.action, {
                        message: messageText,
                    });

                    appendMessage(response.data?.message);
                } catch (error) {
                    console.error(error);
                }
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/staff/messages.blade.php ENDPATH**/ ?>