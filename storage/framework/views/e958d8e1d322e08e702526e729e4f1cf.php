

<?php $__env->startSection('title', 'My Bookings - AutoMate'); ?>

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
                <h2>My Bookings</h2>
                <p>Track pending, ongoing, and completed bookings. Download receipts.</p>
            </div>

            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <div class="card-icon">⏳</div>
                    <h3>Pending Bookings</h3>
                    <p>Bookings awaiting confirmation or start</p>
                    <ul class="feature-list">
                        <li>Reschedule or cancel options</li>
                        <li>View appointment details</li>
                        <li>Contact support</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Pending</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🔧</div>
                    <h3>Ongoing Service</h3>
                    <p>Services currently in progress</p>
                    <ul class="feature-list">
                        <li>Live status updates</li>
                        <li>Technician notes</li>
                        <li>Before/after images</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Ongoing</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">✅</div>
                    <h3>Completed Service</h3>
                    <p>Services finished and ready for pickup</p>
                    <ul class="feature-list">
                        <li>Service summary</li>
                        <li>Recommendations</li>
                        <li>Feedback and ratings</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">View Completed</a>
                </div>

                <div class="dashboard-card">
                    <div class="card-icon">🧾</div>
                    <h3>Booking Receipt</h3>
                    <p>Download invoices and receipts</p>
                    <ul class="feature-list">
                        <li>PDF and email options</li>
                        <li>Tax and itemized details</li>
                        <li>Payment status</li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-sm">Download Receipt</a>
                </div>
            </div>

            <div class="mt-8 bg-white rounded-xl p-4" style="border: 1px solid #eee;">
                <h3 style="margin-bottom: 12px;">Booking Payments</h3>
                <?php if(isset($bookings) && $bookings->count() > 0): ?>
                    <div style="overflow-x:auto;">
                        <table style="width:100%; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Booking</th>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Service</th>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Total</th>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Payment</th>
                                    <th style="text-align:left; padding:8px; border-bottom:1px solid #ddd;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;"><?php echo e($booking->booking_code ?? ('#' . $booking->id)); ?></td>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;"><?php echo e($booking->service_type); ?></td>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;">Rs. <?php echo e(number_format((float) ($booking->total_amount ?? 0), 2)); ?></td>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;"><?php echo e(ucfirst($booking->payment_status ?? 'pending')); ?></td>
                                        <td style="padding:8px; border-bottom:1px solid #f1f1f1;">
                                            <?php if((float) ($booking->total_amount ?? 0) > 0 && ($booking->payment_status ?? 'pending') !== 'paid'): ?>
                                                <form action="<?php echo e(route('payments.service.pay', $booking->id)); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-primary btn-sm">Pay Now</button>
                                                </form>
                                            <?php else: ?>
                                                <span style="font-size: 12px; color: #666;">No action</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p style="color:#666;">No bookings found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\bookings.blade.php ENDPATH**/ ?>