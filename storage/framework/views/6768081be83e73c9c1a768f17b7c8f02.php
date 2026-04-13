<?php $__env->startSection('title', 'Registration Success - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<div class="ap-page ap-page-register">
    <div class="ap-register-success">
        <a href="<?php echo e(route('index')); ?>" class="ap-brand-link ap-brand-center"><img src="<?php echo e(asset('assets/branding/company-logo.png')); ?>" alt="AutoMate" class="ap-logo-image"></a>

        <div class="ap-success-card">
            <div class="ap-success-badge">
                <img src="<?php echo e(asset('assets/auth/icons/check-circle.svg')); ?>" alt="Success" class="ap-success-badge-icon ap-icon-img">
            </div>

            <h2 class="ap-success-title">Registration Successful!</h2>
            <p class="ap-success-text"><?php echo e(session('message', 'Your account has been created successfully.')); ?></p>

            <div class="ap-note ap-note-info ap-note-left">
                <?php if(session('role') === 'staff'): ?>
                    <div class="ap-note-row">
                        <img src="<?php echo e(asset('assets/auth/icons/info.svg')); ?>" alt="Info" class="ap-icon-sm ap-icon-img ap-note-icon-info">
                        <div>
                            <p class="ap-note-title">Pending Approval</p>
                            <div class="ap-note-text">
                                <p>Since you registered as a staff member:</p>
                                <ul class="ap-note-list">
                                    <li>Your application is pending admin review.</li>
                                    <li>You will be notified once approved.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="ap-note-row">
                        <img src="<?php echo e(asset('assets/auth/icons/check-circle.svg')); ?>" alt="Ready" class="ap-icon-sm ap-icon-img ap-note-icon-info">
                        <div>
                            <p class="ap-note-title">You're all set!</p>
                            <p class="ap-note-text">You can now access your dashboard and start booking services.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="ap-success-actions">
                <a href="<?php echo e(route('login')); ?>" class="ap-btn ap-btn-primary ap-btn-full">Sign In Now</a>
                <a href="<?php echo e(route('index')); ?>" class="ap-muted-link">Back to Home</a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public-core', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/auth/register-success.blade.php ENDPATH**/ ?>