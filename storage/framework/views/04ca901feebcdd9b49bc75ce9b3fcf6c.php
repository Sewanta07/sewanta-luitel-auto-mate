<div class="ad-sidebar">
    
    <div class="ad-brand">
        <a href="<?php echo e(route('dashboard.admin')); ?>" class="ad-brand-link">
            <span class="ad-brand-name">AutoMate</span>
            <span class="ad-brand-tag">Admin</span>
        </a>
    </div>

    
    <div class="ad-sidebar-body">
        <nav class="ad-nav">
            
            <a href="<?php echo e(route('dashboard.admin')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('dashboard.admin') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Overview
            </a>

            
            <a href="<?php echo e(route('admin.users')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('admin.users*') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Manage Users
            </a>

            
            <a href="<?php echo e(route('admin.staff-applications.index')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('admin.staff-applications*') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Staff Applications
            </a>

            
            <a href="<?php echo e(route('admin.analytics')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('admin.analytics*') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Analytics
            </a>

            
            <a href="<?php echo e(route('admin.transactions')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('admin.transactions*') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Transactions
            </a>

            
            <a href="<?php echo e(route('admin.contact-messages.index')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('admin.contact-messages*') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Contact Messages
                <?php if(($navCounts['contact_new'] ?? 0) > 0): ?>
                    <span class="ad-pill">
                        <?php echo e($navCounts['contact_new']); ?>

                    </span>
                <?php endif; ?>
            </a>

            
            <a href="<?php echo e(route('admin.services')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('admin.services*') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Services
                <?php if(($navCounts['services_pending'] ?? 0) > 0): ?>
                    <span class="ad-pill">
                        <?php echo e($navCounts['services_pending']); ?>

                    </span>
                <?php endif; ?>
            </a>

            
            <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('admin.rentals*') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Rentals
                <?php if(($navCounts['rentals_pending'] ?? 0) > 0): ?>
                    <span class="ad-pill">
                        <?php echo e($navCounts['rentals_pending']); ?>

                    </span>
                <?php endif; ?>
            </a>

            
            <a href="<?php echo e(route('admin.inventory.index')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('admin.inventory*') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Inventory
                <?php if(($navCounts['inventory_low_stock'] ?? 0) > 0): ?>
                    <span class="ad-pill ad-pill-danger">
                        <?php echo e($navCounts['inventory_low_stock']); ?>

                    </span>
                <?php endif; ?>
            </a>

            
            <a href="<?php echo e(route('admin.messages')); ?>" class="ad-nav-link <?php echo e(request()->routeIs('admin.messages*') ? 'ad-nav-link-active' : ''); ?>">
                <svg class="ad-nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                Messages
                <span id="adminMessagesUnreadBadge" class="ad-pill <?php echo e((int) ($navCounts['messages_unread'] ?? 0) > 0 ? '' : 'ad-hidden'); ?>">
                    <?php echo e((int) ($navCounts['messages_unread'] ?? 0) > 99 ? '99+' : (int) ($navCounts['messages_unread'] ?? 0)); ?>

                </span>
            </a>
        </nav>

        
        <div class="ad-user-box">
            <a href="<?php echo e(route('admin.profile')); ?>" class="ad-user-link">
                <div class="ad-user-avatar">
                    A
                </div>
                <div class="ad-user-copy">
                    <p class="ad-user-name"><?php echo e(auth()->user()->name ?? 'Administrator'); ?></p>
                    <p class="ad-user-note">View Profile</p>
                </div>
            </a>
            
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="ad-logout">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>




<?php if (! $__env->hasRenderedOnce('19a9677d-6d98-4d44-b7bb-aefe60c0753f')): $__env->markAsRenderedOnce('19a9677d-6d98-4d44-b7bb-aefe60c0753f'); ?>
    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const badge = document.getElementById('adminMessagesUnreadBadge');
                let unreadCount = <?php echo json_encode((int) ($navCounts['messages_unread'] ?? 0), 15, 512) ?>;

                const setBadge = (count) => {
                    unreadCount = Math.max(0, Number(count) || 0);

                    if (!badge) {
                        return;
                    }

                    if (unreadCount > 0) {
                        badge.classList.remove('hidden');
                        badge.textContent = unreadCount > 99 ? '99+' : String(unreadCount);
                        return;
                    }

                    badge.classList.add('hidden');
                    badge.textContent = '';
                };

                if (window.realtime) {
                    window.realtime.subscribeDashboard('admin', null, {
                        chatMessage: (payload) => {
                            if (!payload) {
                                return;
                            }

                            if (payload.is_read === false || payload.is_read === 0) {
                                setBadge(unreadCount + 1);
                            }
                        },
                        chatRead: (payload) => {
                            const readCount = Array.isArray(payload?.message_ids) ? payload.message_ids.length : 0;
                            if (readCount > 0) {
                                setBadge(unreadCount - readCount);
                            }
                        },
                    });
                }

                setBadge(unreadCount);
            });
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/components/admin-sidebar.blade.php ENDPATH**/ ?>