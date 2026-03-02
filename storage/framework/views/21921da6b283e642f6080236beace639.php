<?php $__env->startSection('title', 'Staff Messages'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="sf-msg-page">
    <div class="sf-msg-main">
        <div class="sf-msg-head">
            <h1 class="sf-msg-title">Messages</h1>
            <p class="sf-msg-subtitle">Connect with your customers</p>
        </div>

        <?php if(session('success')): ?>
            <div class="sf-msg-flash-success">
                <svg class="sf-msg-flash-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="sf-msg-layout">
            <div class="sf-msg-sidebar-col">
                <div class="sf-msg-sidebar">
                    <div class="sf-msg-sidebar-head">
                        <h2 class="sf-msg-sidebar-title">Conversations</h2>
                    </div>

                    <div class="sf-msg-conversation-list">
                        <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(route('staff.customers.messages', $c->id)); ?>" class="sf-msg-conversation-item <?php echo e($customer->id === $c->id ? 'sf-msg-conversation-active' : ''); ?>">
                                <div class="sf-msg-conversation-row">
                                    <div class="sf-msg-conversation-avatar">
                                        <?php echo e(strtoupper(substr($c->name ?? $c->email ?? 'C', 0, 1))); ?>

                                    </div>
                                    <div class="sf-msg-conversation-meta">
                                        <p class="sf-msg-conversation-name"><?php echo e($c->name ?? 'Customer'); ?></p>
                                        <p class="sf-msg-conversation-email"><?php echo e($c->email); ?></p>
                                    </div>
                                    <?php if(isset($c->unread_count) && $c->unread_count > 0): ?>
                                        <span class="sf-msg-unread-badge"><?php echo e($c->unread_count); ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="sf-msg-conversation-empty">
                                <svg class="sf-msg-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <p class="sf-msg-empty-title">No conversations yet</p>
                                <p class="sf-msg-empty-copy">Messages from customers will appear here</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="sf-msg-chat-col">
                <div class="sf-msg-chat-shell">
                    <div class="sf-msg-chat-head">
                        <div class="sf-msg-chat-customer">
                            <div class="sf-msg-chat-avatar">
                                <?php echo e(strtoupper(substr($customer->name ?? 'C', 0, 1))); ?>

                            </div>
                            <div>
                                <h3 class="sf-msg-chat-name"><?php echo e($customer->name); ?></h3>
                                <p class="sf-msg-chat-email"><?php echo e($customer->email); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php if($bookings->count() > 0): ?>
                        <div class="sf-msg-bookings-strip">
                        <p class="sf-msg-bookings-title">Related Bookings</p>
                            <div class="sf-msg-bookings-list">
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('staff.services.show', $booking->id)); ?>" class="sf-msg-booking-chip">
                                        <?php echo e($booking->booking_code); ?> - <?php echo e($booking->service_type); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="sf-msg-messages" id="messages-container">
                        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $isSender = (int) $message->sender_id === (int) $staffChatUserId;
                            ?>
                            <div class="sf-msg-row <?php echo e($isSender ? 'sf-msg-row-sender' : 'sf-msg-row-receiver'); ?>" data-message-id="<?php echo e((int) $message->id); ?>">
                                <div class="sf-msg-bubble-wrap">
                                    <p class="sf-msg-sender <?php echo e($isSender ? 'sf-msg-sender-self' : 'sf-msg-sender-other'); ?>">
                                        <?php echo e($isSender ? 'You' : $customer->name); ?>

                                    </p>
                                    <div class="sf-msg-bubble <?php echo e($isSender ? 'sf-msg-bubble-self' : 'sf-msg-bubble-other'); ?>">
                                        <p class="sf-msg-bubble-text"><?php echo e($message->message); ?></p>
                                        <p class="sf-msg-time <?php echo e($isSender ? 'sf-msg-time-self' : 'sf-msg-time-other'); ?>">
                                            <?php echo e($message->created_at->format('M d, g:i A')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="sf-msg-empty-chat">
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="sf-msg-compose">
                        <form id="staffMessageForm" action="<?php echo e(route('staff.customers.sendMessage', $customer->id)); ?>" method="POST" class="sf-msg-compose-form">
                            <?php echo csrf_field(); ?>
                            <div class="sf-msg-compose-input-wrap">
                                <textarea id="staffMessageInput" name="message" rows="2" required placeholder="Type your message..." class="sf-msg-compose-input"></textarea>
                            </div>
                            <button type="submit" class="sf-msg-send-btn">
                                <svg class="sf-msg-send-icon" fill="currentColor" viewBox="0 0 20 20">
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
            wrapper.className = `sf-msg-row ${isSender ? 'sf-msg-row-sender' : 'sf-msg-row-receiver'}`;
            wrapper.dataset.messageId = String(payload.id);

            const senderLabel = isSender ? currentUserName : otherUserName;
            const bubbleClass = isSender ? 'sf-msg-bubble sf-msg-bubble-self' : 'sf-msg-bubble sf-msg-bubble-other';
            const timeClass = isSender ? 'sf-msg-time sf-msg-time-self' : 'sf-msg-time sf-msg-time-other';
            const nameClass = isSender ? 'sf-msg-sender sf-msg-sender-self' : 'sf-msg-sender sf-msg-sender-other';

            wrapper.innerHTML = `
                <div class="sf-msg-bubble-wrap">
                    <p class="${nameClass}">${senderLabel}</p>
                    <div class="${bubbleClass}">
                        <p class="sf-msg-bubble-text"></p>
                        <p class="${timeClass}">${formatDate(payload.created_at)}</p>
                    </div>
                </div>
            `;

            wrapper.querySelector('.sf-msg-bubble-text').textContent = payload.message ?? '';
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\staff\messages.blade.php ENDPATH**/ ?>