

<?php $__env->startSection('title', 'Staff Dashboard - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<div class="sf-page">
    <main class="sf-main">
        
        <div class="sf-head">
            <div>
                <h1 class="sf-title">Staff Portal</h1>
                <p class="sf-subtitle">Manage your service queue and update repair status.</p>
            </div>
            <div>
                <span class="sf-badge">
                    <span class="sf-dot"></span>
                    System Online
                </span>
            </div>
        </div>

        
        <div class="sf-cards">
            
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <h3 class="sf-card-value"><?php echo e($stats['total']); ?></h3>
                <p class="sf-card-label">Total Assigned</p>
            </div>

            
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-yellow">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="sf-card-value"><?php echo e($stats['assigned']); ?></h3>
                <p class="sf-card-label">Awaiting Acceptance</p>
            </div>

            
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <h3 class="sf-card-value"><?php echo e($stats['in_progress']); ?></h3>
                <p class="sf-card-label">Active Jobs</p>
            </div>

            
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="sf-card-value"><?php echo e($stats['assigned_rentals']); ?></h3>
                <p class="sf-card-label">Assigned Rentals</p>
            </div>

            
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="sf-card-value"><?php echo e($stats['ready_pickup_rentals']); ?></h3>
                <p class="sf-card-label">Rentals Ready for Pickup</p>
            </div>
        </div>

        
        <div class="sf-work">
            <div class="sf-work-head">
                <h2 class="sf-work-title">Recent Work</h2>
                <span class="sf-work-date"><?php echo e(date('l, F j, Y')); ?></span>
            </div>
            <div>
                <?php $__empty_1 = true; $__currentLoopData = $recentWork; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="sf-work-item">
                        <div class="sf-work-left">
                            <div class="sf-chip <?php echo e($item['type'] === 'rental' ? 'sf-chip-rental' : 'sf-chip-booking'); ?>">
                                <span class="sf-chip-date">
                                    <?php echo e($item['date_label']); ?>

                                </span>
                                <span class="sf-chip-time">
                                    <?php echo e($item['time_label']); ?>

                                </span>
                            </div>
                            <div>
                                <h3 class="sf-item-title">
                                    <?php echo e($item['title']); ?>

                                    <span class="sf-item-type <?php echo e($item['type'] === 'rental' ? 'sf-type-rental' : 'sf-type-booking'); ?>">(<?php echo e($item['type']); ?>)</span>
                                </h3>
                                <p class="sf-item-subtitle"><?php echo e($item['subtitle']); ?></p>
                            </div>
                        </div>
                        <div class="sf-work-right">
                            <?php
                                $statusClasses = [
                                    'Assigned' => 'sf-status-warning',
                                    'Customer Accepted' => 'sf-status-cyan',
                                    'In Progress' => 'sf-status-info',
                                    'Waiting for Parts' => 'sf-status-purple',
                                    'Completed' => 'sf-status-success',
                                    'Ready for Pickup' => 'sf-status-warning',
                                    'Picked Up' => 'sf-status-info',
                                    'In Use' => 'sf-status-indigo',
                                    'Returned' => 'sf-status-success',
                                ];
                                $statusClass = $statusClasses[$item['status']] ?? 'sf-status-neutral';
                            ?>
                            <span class="sf-status <?php echo e($statusClass); ?>">
                                <?php echo e($item['status']); ?>

                            </span>
                            <a href="<?php echo e($item['action_url']); ?>" class="sf-action">
                                <?php echo e($item['action_label']); ?>

                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="sf-work-empty">
                        <h3>No Assigned Work Yet</h3>
                        <p>You don't have any bookings or rentals assigned right now.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="sf-work-footer">
                <a href="<?php echo e(route('staff.bookings')); ?>" class="sf-link">View All Bookings &rarr;</a>
                <a href="<?php echo e(route('staff.rentals.index')); ?>" class="sf-link">View All Rentals &rarr;</a>
            </div>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const userId = <?php echo json_encode((int) $user->id, 15, 512) ?>;
        let reloadTimer = null;

        const scheduleReload = () => {
            if (reloadTimer) {
                return;
            }

            reloadTimer = setTimeout(() => {
                window.location.reload();
            }, 1200);
        };

        if (window.realtime) {
            window.realtime.subscribeDashboard('staff', userId, {
                serviceStatus: scheduleReload,
                rentalStatus: scheduleReload,
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.staff', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/dashboard/staff.blade.php ENDPATH**/ ?>