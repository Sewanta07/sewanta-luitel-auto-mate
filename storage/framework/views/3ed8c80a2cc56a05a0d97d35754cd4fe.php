<?php $__env->startSection('title', 'Conversation Monitoring'); ?>

<?php $__env->startSection('content'); ?>
<main class="ad-msgc-main">
            <div class="ad-msgc-head">
                <h1 class="ad-msgc-title">Conversation Monitoring</h1>
                <p class="ad-msgc-subtitle">Read-only view of customer and staff chat</p>
            </div>

            <div class="ad-msgc-filter-card">
                <form method="GET" action="<?php echo e(route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id])); ?>" class="ad-msgc-filter-form">
                    <div class="ad-msgc-field">
                        <label class="ad-msgc-label">From Date</label>
                        <input type="date" name="date_from" value="<?php echo e(request('date_from')); ?>" class="ad-msgc-input" />
                    </div>
                    <div class="ad-msgc-field">
                        <label class="ad-msgc-label">To Date</label>
                        <input type="date" name="date_to" value="<?php echo e(request('date_to')); ?>" class="ad-msgc-input" />
                    </div>
                    <button type="submit" class="ad-msgc-btn ad-msgc-btn-primary">Filter</button>
                    <a href="<?php echo e(route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id])); ?>" class="ad-msgc-btn ad-msgc-btn-muted">Reset</a>
                    <a href="<?php echo e(route('admin.messages')); ?>" class="ad-msgc-btn ad-msgc-btn-muted">Back</a>
                </form>
            </div>

            <div class="ad-msgc-grid">
                <div class="ad-msgc-list-col">
                    <div class="ad-msgc-list-card">
                        <div class="ad-msgc-list-head">
                            <h2 class="ad-msgc-list-title">Conversations</h2>
                        </div>

                        <div class="ad-msgc-list-body">
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
                                    <a href="<?php echo e(route('admin.messages.conversation', ['customer' => $listCustomer->id, 'staff' => $listStaff->id])); ?>" class="ad-msgc-list-item <?php echo e($isActive ? 'is-active' : ''); ?>">
                                        <div class="ad-msgc-list-row">
                                            <div class="ad-msgc-avatar ad-msgc-avatar-small">
                                                <?php echo e(strtoupper(substr($listCustomer->name ?? 'C', 0, 1))); ?>

                                            </div>
                                            <div class="ad-msgc-list-content">
                                                <p class="ad-msgc-name"><?php echo e($listCustomer->name); ?></p>
                                                <p class="ad-msgc-with">with <?php echo e($listStaff->name); ?></p>
                                                <p class="ad-msgc-snippet"><?php echo e($lastMessage?->message ?? 'No message preview'); ?></p>
                                            </div>
                                            <?php if((int) $conversation->unread_count > 0): ?>
                                                <span class="ad-msgc-unread"><?php echo e((int) $conversation->unread_count); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="ad-msgc-empty">
                                    <p class="ad-msgc-empty-text">No conversations yet</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="ad-msgc-thread-col">
                    <div class="ad-msgc-thread-card">
                        <div class="ad-msgc-thread-head">
                            <div class="ad-msgc-thread-head-row">
                                <div class="ad-msgc-avatar ad-msgc-avatar-large ad-msgc-avatar-soft">
                                    <?php echo e(strtoupper(substr($customer->name ?? 'C', 0, 1))); ?>

                                </div>
                                <div>
                                    <h3 class="ad-msgc-thread-title"><?php echo e($customer->name); ?></h3>
                                    <p class="ad-msgc-thread-subtitle">Customer ↔ <?php echo e($staff->name); ?> (Staff)</p>
                                </div>
                            </div>
                        </div>

                        <div class="ad-msgc-thread-body" id="adminConversationContainer">
                            <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $isCustomer = (int) $message->sender_id === (int) $customer->id;
                                ?>
                                <div class="ad-msgc-message-row <?php echo e($isCustomer ? 'is-customer' : 'is-staff'); ?>" data-message-id="<?php echo e((int) $message->id); ?>">
                                    <div class="ad-msgc-message-inner">
                                        <p class="ad-msgc-message-author <?php echo e($isCustomer ? 'is-customer' : 'is-staff'); ?>">
                                            <?php echo e($isCustomer ? $customer->name : $staff->name); ?>

                                        </p>
                                        <div class="ad-msgc-bubble <?php echo e($isCustomer ? 'is-customer' : 'is-staff'); ?>">
                                            <p class="ad-msgc-message-text"><?php echo e($message->message); ?></p>
                                            <p class="ad-msgc-message-time <?php echo e($isCustomer ? 'is-customer' : 'is-staff'); ?>">
                                                <?php echo e($message->created_at->format('M d, g:i A')); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="ad-msgc-thread-empty">
                                    <p>No messages found for this conversation</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="ad-msgc-thread-foot">
                            Monitoring mode: Admin can view messages only.
                        </div>
                    </div>
                </div>
            </div>

            <?php if($messages->hasPages()): ?>
                <div class="ad-msgc-pagination">
                    <?php echo e($messages->links()); ?>

                </div>
            <?php endif; ?>
</main>

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
            const wrapperClass = isCustomer ? 'is-customer' : 'is-staff';
            const dateParts = formatDate(payload.created_at);

            const wrapper = document.createElement('div');
            wrapper.className = `ad-msgc-message-row ${wrapperClass}`;
            wrapper.dataset.messageId = String(payload.id);
            wrapper.innerHTML = `
                <div class="ad-msgc-message-inner">
                    <p class="ad-msgc-message-author ${wrapperClass}">${senderName}</p>
                    <div class="ad-msgc-bubble ${wrapperClass}">
                        <p class="ad-msgc-message-text"></p>
                        <p class="ad-msgc-message-time ${wrapperClass}">${dateParts.day ?? ''} ${dateParts.time ?? ''}</p>
                    </div>
                </div>
            `;

            const textNode = wrapper.querySelector('.ad-msgc-message-text');
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/messages-conversation.blade.php ENDPATH**/ ?>