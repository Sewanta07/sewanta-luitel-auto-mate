

<?php $__env->startSection('title', 'Staff Application Pending'); ?>

<?php $__env->startSection('content'); ?>
<div class="sf-auth-page">
    <div class="sf-auth-shell">
        <div class="sf-auth-brand-wrap">
            <h1 class="sf-auth-brand">AutoMate</h1>
        </div>
        
        <div class="sf-auth-card">
            <div class="sf-auth-card-body">
                <div class="sf-auth-icon-wrap sf-auth-icon-wrap-pending">
                    <svg class="sf-auth-icon sf-auth-icon-pending" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h2 class="sf-auth-title">Application Under Review</h2>
                <p class="sf-auth-copy">
                    Thanks for registering! Your staff application is currently being reviewed by an administrator. You will be notified once your account has been approved.
                </p>

                <div class="sf-auth-actions">
                     <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="sf-auth-btn sf-auth-btn-secondary">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="sf-auth-footer">
             <p class="sf-auth-footer-copy">
                &copy; <?php echo e(date('Y')); ?> AutoMate. All rights reserved.
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\staff\pending.blade.php ENDPATH**/ ?>