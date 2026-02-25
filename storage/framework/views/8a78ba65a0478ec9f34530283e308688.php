

<?php $__env->startSection('title', 'Profile Settings - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php ($user = auth()->user()); ?>
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <a href="<?php echo e(route('dashboard.customer')); ?>" class="btn btn-outline">Dashboard</a>
                    <a href="<?php echo e(route('customer.profile')); ?>" class="btn btn-outline">My Profile</a>
                    <span class="user-info">Welcome, <?php echo e($user?->name); ?></span>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-outline">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-content">
        <div class="container">
            <div class="dashboard-header">
                <h2>Profile Settings</h2>
                <p>Update your profile and change password.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">👤</div>
                    <h3>Update Profile</h3>
                    <p>Edit your personal information</p>
                    <ul class="feature-list">
                        <li>Profile picture upload</li>
                        <li>Name, email, phone</li>
                        <li>Address updates</li>
                    </ul>
                    <a href="<?php echo e(route('customer.profile')); ?>" class="btn btn-primary btn-sm">Go to Profile</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🔒</div>
                    <h3>Change Password</h3>
                    <p>Secure your account</p>
                    <ul class="feature-list">
                        <li>Current password verification</li>
                        <li>New password confirmation</li>
                        <li>Strong password guidance</li>
                    </ul>
                    <a href="<?php echo e(route('customer.profile')); ?>#password-form" class="btn btn-primary btn-sm">Change Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\settings.blade.php ENDPATH**/ ?>