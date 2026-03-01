

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="cs-messages-page min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="cs-messages-container max-w-6xl mx-auto">
        <!-- Header -->
        <div class="cs-messages-head mb-8">
            <h1 class="cs-messages-title text-4xl font-bold text-gray-900">Messages</h1>
            <p class="cs-messages-subtitle text-gray-600 mt-2">Connect with our staff members</p>
        </div>

        <div class="cs-messages-layout grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Staff List Sidebar -->
            <div class="cs-messages-sidebar lg:col-span-1">
                    <div class="cs-message-list bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="cs-message-list-head p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500">
                        <h2 class="cs-message-list-title text-xl font-bold text-white">Conversations</h2>
                    </div>
                    
                    <div class="cs-conversation-list divide-y max-h-96 overflow-y-auto">
                        <?php $__empty_1 = true; $__currentLoopData = $staffMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(route('customer.messages.show', $staff->id)); ?>" 
                               class="cs-conversation-item block p-4 hover:bg-orange-50 transition-colors border-l-4 <?php echo e(isset($selectedStaff) && $selectedStaff->id === $staff->id ? 'cs-conversation-item-active border-[#ff5a1f] bg-orange-50' : 'cs-conversation-item-idle border-transparent'); ?>">
                          
                               <div class="cs-conversation-item-inner flex items-start gap-3">
                                    <?php if($staff->profile_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $staff->profile_image)); ?>" 
                                             alt="<?php echo e($staff->name); ?>"
                                             class="cs-avatar cs-avatar-sm w-10 h-10 rounded-full object-cover">
                                    <?php else: ?>
                                        <div class="cs-avatar cs-avatar-sm cs-avatar-fallback w-10 h-10 rounded-full bg-[#ff5a1f] flex items-center justify-center text-white font-bold">
                                            <?php echo e(substr($staff->name, 0, 1)); ?>

                                        </div>
                                    <?php endif; ?>
                                    <div class="cs-conversation-meta flex-1 min-w-0">
                                        <p class="cs-conversation-name font-bold text-gray-900 truncate"><?php echo e($staff->name); ?></p>
                                        <p class="cs-conversation-role text-xs text-gray-500"><?php echo e($staff->specialization ?? 'Staff Member'); ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="cs-conversation-empty p-6 text-center text-gray-500">
                                <p class="cs-conversation-empty-text">No conversations yet</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Messages Display Area -->
            <div class="cs-messages-main lg:col-span-2">
                <?php if(isset($selectedStaff)): ?>
                    <div class="cs-chat-panel cs-chat-panel-fixed bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col h-full">
                        <!-- Header -->
                        <div class="cs-chat-head p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white border-b">
                            <div class="cs-chat-head-inner flex items-center gap-3">
                                <?php if($selectedStaff->profile_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $selectedStaff->profile_image)); ?>" 
                                         alt="<?php echo e($selectedStaff->name); ?>"
                                         class="cs-avatar cs-avatar-md w-12 h-12 rounded-full object-cover">
                                <?php else: ?>
                                    <div class="cs-avatar cs-avatar-md cs-chat-avatar-fallback w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center text-white font-bold text-lg">
                                        <?php echo e(substr($selectedStaff->name, 0, 1)); ?>

                                    </div>
                                <?php endif; ?>
                                <div class="cs-chat-head-meta">
                                    <h3 class="cs-chat-head-name font-bold text-lg"><?php echo e($selectedStaff->name); ?></h3>
                                    <p class="cs-chat-head-role text-orange-100 text-sm"><?php echo e($selectedStaff->specialization ?? 'Staff Member'); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Messages Container -->
                        <div class="cs-chat-body flex-1 p-6 overflow-y-auto bg-gray-50" id="messagesContainer">
                            <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="cs-message-row mb-4 flex <?php echo e($message->isSentByCustomer() ? 'cs-message-row-sent justify-end' : 'cs-message-row-received justify-start'); ?>" data-message-id="<?php echo e((int) $message->id); ?>">
                                    <div class="cs-message-card max-w-xs lg:max-w-md">
                                        <p class="cs-message-sender text-[10px] font-black uppercase tracking-widest mb-1 <?php echo e($message->isSentByCustomer() ? 'cs-message-sender-sent text-orange-400 text-right' : 'cs-message-sender-received text-gray-400'); ?>">
                                            <?php echo e($message->isSentByCustomer() ? ($customer->name ?? 'You') : ($selectedStaff->name ?? 'Staff')); ?>

                                        </p>
                                        <div class="cs-message-bubble px-4 py-3 rounded-2xl <?php echo e($message->isSentByCustomer() ? 'cs-message-bubble-sent bg-[#ff5a1f] text-white rounded-br-none' : 'cs-message-bubble-received bg-gray-200 text-gray-900 rounded-bl-none'); ?>">
                                            <p class="cs-message-text break-words"><?php echo e($message->message ?? $message->content); ?></p>
                                            <p class="cs-message-time text-xs mt-2 <?php echo e($message->isSentByCustomer() ? 'cs-message-time-sent text-orange-100' : 'cs-message-time-received text-gray-600'); ?>">
                                                <?php echo e($message->created_at->format('M d, g:i A')); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="cs-chat-empty h-full flex items-center justify-center text-gray-500">
                                    <p class="cs-chat-empty-text">No messages yet. Start the conversation!</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Message Input Form -->
                        <div class="cs-chat-composer-wrap p-6 border-t bg-white">
                            <form id="customerMessageForm" action="<?php echo e(route('customer.messages.send', $selectedStaff->id)); ?>" method="POST" class="cs-chat-composer flex gap-3">
                                <?php echo csrf_field(); ?>
                                <div class="cs-chat-input-wrap flex-1">
                                    <textarea id="customerMessageInput" name="message" 
                                              rows="2"
                                              placeholder="Type your message..." 
                                              class="cs-chat-input w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#ff5a1f] focus:ring focus:ring-orange-100 resize-none focus:outline-none transition-all"
                                              required></textarea>
                                </div>
                                <button type="submit" 
                                        class="cs-chat-send-btn px-6 py-3 bg-[#ff5a1f] text-white font-bold rounded-xl hover:bg-[#e44d18] transition-all flex items-center gap-2 self-end">
                                    <svg class="cs-chat-send-icon w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"/>
                                    </svg>
                                    Send
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="cs-chat-placeholder bg-white rounded-2xl shadow-lg p-12 flex items-center justify-center h-full">
                        <div class="cs-chat-placeholder-inner text-center">
                            <div class="cs-chat-placeholder-icon-wrap w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="cs-chat-placeholder-icon w-8 h-8 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <h3 class="cs-chat-placeholder-title text-xl font-bold text-gray-900 mb-2">No Conversation Selected</h3>
                            <p class="cs-chat-placeholder-text text-gray-600">Select a staff member from the left to start messaging</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const messagesContainer = document.getElementById('messagesContainer');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        <?php if(isset($selectedStaff)): ?>
        const conversationId = <?php echo json_encode($conversationId, 15, 512) ?>;
        const currentUserId = <?php echo json_encode((int) $customerChatUserId, 15, 512) ?>;
        const receiverId = <?php echo json_encode((int) $selectedStaffChatUserId, 15, 512) ?>;
        const currentUserName = <?php echo json_encode($customer->name ?? 'You', 15, 512) ?>;
        const otherUserName = <?php echo json_encode($selectedStaff->name ?? 'Staff', 15, 512) ?>;
        const form = document.getElementById('customerMessageForm');
        const messageInput = document.getElementById('customerMessageInput');

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
            if (!messagesContainer || !payload || !payload.id) {
                return;
            }

            if (document.querySelector(`[data-message-id="${payload.id}"]`)) {
                return;
            }

            const isSentByCurrent = Number(payload.sender_id) === Number(currentUserId);

            const wrapper = document.createElement('div');
            wrapper.className = `cs-message-row mb-4 flex ${isSentByCurrent ? 'cs-message-row-sent justify-end' : 'cs-message-row-received justify-start'}`;
            wrapper.dataset.messageId = String(payload.id);

            const senderLabel = isSentByCurrent ? currentUserName : otherUserName;
            const bubbleClass = isSentByCurrent
                ? 'cs-message-bubble-sent bg-[#ff5a1f] text-white rounded-br-none'
                : 'cs-message-bubble-received bg-gray-200 text-gray-900 rounded-bl-none';
            const timeClass = isSentByCurrent ? 'cs-message-time-sent text-orange-100' : 'cs-message-time-received text-gray-600';
            const nameClass = isSentByCurrent ? 'cs-message-sender-sent text-orange-400 text-right' : 'cs-message-sender-received text-gray-400';

            wrapper.innerHTML = `
                <div class="cs-message-card max-w-xs lg:max-w-md">
                    <p class="cs-message-sender text-[10px] font-black uppercase tracking-widest mb-1 ${nameClass}">${senderLabel}</p>
                    <div class="cs-message-bubble px-4 py-3 rounded-2xl ${bubbleClass}">
                        <p class="cs-message-text break-words"></p>
                        <p class="cs-message-time text-xs mt-2 ${timeClass}">${formatDate(payload.created_at)}</p>
                    </div>
                </div>
            `;

            wrapper.querySelector('.cs-message-text').textContent = payload.message ?? '';
            messagesContainer.appendChild(wrapper);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
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
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-core', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/messages.blade.php ENDPATH**/ ?>