

<?php $__env->startSection('title', 'Customer Interaction - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="sf-cus-page">
    <main class="sf-cus-main">
        <div class="sf-cus-head">
            <div>
                <h1 class="sf-cus-title">My Customers</h1>
                <p class="sf-cus-subtitle">Customers with bookings assigned to you (<?php echo e($customers->count()); ?> total)</p>
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
            <div class="sf-cus-empty">
                <div class="sf-cus-empty-icon-wrap">
                    <svg class="sf-cus-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="sf-cus-empty-title">No customers yet</h3>
                <p class="sf-cus-empty-copy">You'll see customers here once bookings are assigned to you.</p>
            </div>
        <?php else: ?>
        <div class="sf-cus-grid" id="customer-list">
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $latestBooking = $customer->bookings->first();
                    $initials = strtoupper(substr($customer->name, 0, 2));
                    $colors = ['orange', 'purple', 'blue', 'green', 'pink', 'indigo'];
                    $color = $colors[ord($customer->name[0]) % count($colors)];
                ?>
                <div class="sf-cus-card customer-card" data-customer-name="<?php echo e(strtolower($customer->name)); ?>">
                    <div class="sf-cus-card-body">
                        <div class="sf-cus-card-head">
                            <div class="sf-cus-person">
                                <div class="sf-cus-avatar sf-cus-avatar-<?php echo e($color); ?>">
                                    <?php echo e($initials); ?>

                                </div>
                                <div class="sf-cus-person-meta">
                                    <h3 class="sf-cus-person-name"><?php echo e($customer->name); ?></h3>
                                    <?php if($latestBooking): ?>
                                        <p class="sf-cus-person-vehicle"><?php echo e($latestBooking->vehicle_model); ?> (<?php echo e($latestBooking->vehicle_number); ?>)</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if($latestBooking): ?>
                                <span class="sf-cus-status
                                    <?php if($latestBooking->status == 'In Progress'): ?> sf-cus-status-progress
                                    <?php elseif($latestBooking->status == 'Completed'): ?> sf-cus-status-completed
                                    <?php elseif($latestBooking->status == 'Pending'): ?> sf-cus-status-pending
                                    <?php else: ?> sf-cus-status-default
                                    <?php endif; ?>">
                                    <?php echo e($latestBooking->status); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="sf-cus-details">
                            <div class="sf-cus-detail-grid">
                                <div>
                                    <span class="sf-cus-detail-label">Phone</span>
                                    <span class="sf-cus-detail-value"><?php echo e($customer->phone ?? 'N/A'); ?></span>
                                </div>
                                <div>
                                    <span class="sf-cus-detail-label">Email</span>
                                    <span class="sf-cus-detail-value sf-cus-detail-truncate" title="<?php echo e($customer->email); ?>"><?php echo e($customer->email); ?></span>
                                </div>
                            </div>
                            <div class="sf-cus-bookings-meta">
                                <span class="sf-cus-detail-label sf-cus-bookings-label">Bookings</span>
                                <span class="sf-cus-detail-value"><?php echo e($customer->bookings->count()); ?> service(s)</span>
                            </div>
                        </div>
                        <div class="sf-cus-card-action-wrap">
                            <a href="<?php echo e(route('staff.customers.messages', $customer->id)); ?>" class="sf-cus-message-btn">
                                <svg class="sf-cus-message-btn-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" /></svg>
                                Message
                                <?php if($customer->unread_count > 0): ?>
                                    <span class="sf-cus-unread-badge"><?php echo e($customer->unread_count); ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\staff\customers.blade.php ENDPATH**/ ?>