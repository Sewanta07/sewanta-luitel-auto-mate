

<?php $__env->startSection('title', 'Customer Interaction - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="sf-cus-page">
    <main class="sf-msg-main sf-cus-main">
        <div class="sf-msg-head sf-cus-head">
            <div>
                <h1 class="sf-msg-title sf-cus-title">My Customers</h1>
                <p class="sf-msg-subtitle sf-cus-subtitle">Customers with bookings assigned to you (<?php echo e($customers->count()); ?> total)</p>
            </div>
            <div class="sf-cus-search-wrap">
                <div class="sf-cus-search-shell">
                    <div class="sf-cus-search-icon-wrap">
                        <svg class="sf-cus-search-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
                    </div>
                    <input type="text" name="search" id="customer-search" class="sf-cus-search-input" placeholder="Search customers...">
                </div>
            </div>
        </div>

        <?php if($customers->isEmpty()): ?>
            <div class="sf-msg-conversation-empty sf-cus-empty">
                <svg class="sf-msg-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <p class="sf-msg-empty-title">No customers yet</p>
                <p class="sf-msg-empty-copy">You'll see customers here once bookings are assigned to you.</p>
            </div>
        <?php else: ?>
        <div class="sf-msg-layout sf-cus-layout">
            <div class="sf-cus-sidebar-col">
                <div class="sf-msg-sidebar sf-cus-sidebar" id="customer-list">
                    <div class="sf-msg-sidebar-head sf-cus-sidebar-head">
                        <h2 class="sf-msg-sidebar-title">Conversations</h2>
                    </div>
                    <div class="sf-msg-conversation-list sf-cus-conversation-list">
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $latestBooking = $customer->bookings->first();
                ?>
                <a href="<?php echo e(route('staff.customers.messages', $customer->id)); ?>" class="sf-msg-conversation-item sf-cus-conversation-item customer-card" data-customer-name="<?php echo e(strtolower($customer->name)); ?>">
                    <div class="sf-msg-conversation-row">
                        <div class="sf-msg-conversation-avatar">
                            <?php echo e(strtoupper(substr($customer->name ?? $customer->email ?? 'C', 0, 1))); ?>

                        </div>
                        <div class="sf-msg-conversation-meta">
                            <p class="sf-msg-conversation-name"><?php echo e($customer->name ?? 'Customer'); ?></p>
                            <p class="sf-msg-conversation-email" title="<?php echo e($customer->email); ?>"><?php echo e($customer->email); ?></p>
                            <div class="sf-cus-details-row">
                                <span class="sf-cus-detail-line"><?php echo e($customer->phone ?? 'N/A'); ?></span>
                                <span class="sf-cus-detail-line"><?php echo e($customer->bookings->count()); ?> booking(s)</span>
                                <?php if($latestBooking): ?>
                                    <span class="sf-cus-detail-line"><?php echo e($latestBooking->status); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if($customer->unread_count > 0): ?>
                            <span class="sf-msg-unread-badge"><?php echo e($customer->unread_count); ?></span>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="sf-msg-chat-col sf-cus-preview-col">
                <div class="sf-msg-chat-shell sf-cus-preview">
                    <div class="sf-msg-chat-head">
                        <div class="sf-msg-chat-customer">
                            <div class="sf-msg-chat-avatar">
                                <svg class="sf-cus-preview-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4v-4z"/></svg>
                            </div>
                            <div>
                                <h3 class="sf-msg-chat-name">Start a Conversation</h3>
                                <p class="sf-msg-chat-email">Select a conversation from the sidebar to open messages.</p>
                            </div>
                        </div>
                    </div>
                    <div class="sf-msg-messages sf-cus-preview-body">
                        <div class="sf-msg-empty-chat">
                            <p>Choose a customer to view and send messages.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>
</div>

<script>
    document.getElementById('customer-search')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.customer-card');
        
        cards.forEach(card => {
            const customerName = card.getAttribute('data-customer-name');
            if (customerName.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/staff/customers.blade.php ENDPATH**/ ?>