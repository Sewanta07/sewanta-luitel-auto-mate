

<?php $__env->startSection('title', 'Book a Service - AutoMate'); ?>

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
                <h2>Service Booking</h2>
                <p>Browse services, book, and confirm your appointment.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">🛠️</div>
                    <h3>Browse Services</h3>
                    <p>Choose from maintenance, repairs, diagnostics, and more.</p>
                    <ul class="feature-list">
                        <li>Service categories and pricing</li>
                        <li>Estimated duration</li>
                        <li>Recommended add-ons</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Browse</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">📅</div>
                    <h3>Book a Service</h3>
                    <p>Select date, slot, and preferred workshop.</p>
                    <ul class="feature-list">
                        <li>Choose vehicle from your garage</li>
                        <li>Pickup / drop options</li>
                        <li>Instant confirmation</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Book Now</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">✅</div>
                    <h3>Booking Confirmation</h3>
                    <p>Review booking details and receive notifications.</p>
                    <ul class="feature-list">
                        <li>Summary of selected services</li>
                        <li>Slot and location details</li>
                        <li>Notification preferences</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Confirmation</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\services.blade.php ENDPATH**/ ?>