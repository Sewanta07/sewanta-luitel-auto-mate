<?php $__env->startSection('title', 'Book a Service - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<section class="cs-page cs-services-page">
    <div class="cs-container cs-services-wrap cs-services-container">
        <header class="cs-page-head cs-services-head">
            <h1 class="cs-page-title cs-services-title">Service Booking</h1>
            <p class="cs-page-subtitle cs-services-subtitle">Browse services, book, and confirm your appointment.</p>
        </header>

        <div class="cs-cards-grid cs-services-grid">
            <article class="cs-card cs-service-card cs-service-card-browse">
                <div class="cs-card-icon cs-service-card-icon" aria-hidden="true">🛠️</div>
                <h2 class="cs-card-title cs-service-card-title">Browse Services</h2>
                <p class="cs-card-text cs-service-card-text">Choose from maintenance, repairs, diagnostics, and more.</p>
                <ul class="cs-list cs-service-card-list">
                    <li class="cs-service-card-item">Service categories and pricing</li>
                    <li class="cs-service-card-item">Estimated duration</li>
                    <li class="cs-service-card-item">Recommended add-ons</li>
                </ul>
                <a href="<?php echo e(route('bookings.create')); ?>" class="cs-btn cs-btn-primary cs-btn-sm cs-service-card-cta">Browse</a>
            </article>

            <article class="cs-card cs-service-card cs-service-card-book">
                <div class="cs-card-icon cs-service-card-icon" aria-hidden="true">📅</div>
                <h2 class="cs-card-title cs-service-card-title">Book a Service</h2>
                <p class="cs-card-text cs-service-card-text">Select date, slot, and preferred workshop.</p>
                <ul class="cs-list cs-service-card-list">
                    <li class="cs-service-card-item">Choose vehicle from your garage</li>
                    <li class="cs-service-card-item">Pickup / drop options</li>
                    <li class="cs-service-card-item">Instant confirmation</li>
                </ul>
                <a href="<?php echo e(route('bookings.create')); ?>" class="cs-btn cs-btn-primary cs-btn-sm cs-service-card-cta">Book Now</a>
            </article>

            <article class="cs-card cs-service-card cs-service-card-confirmation">
                <div class="cs-card-icon cs-service-card-icon" aria-hidden="true">✅</div>
                <h2 class="cs-card-title cs-service-card-title">Booking Confirmation</h2>
                <p class="cs-card-text cs-service-card-text">Review booking details and receive notifications.</p>
                <ul class="cs-list cs-service-card-list">
                    <li class="cs-service-card-item">Summary of selected services</li>
                    <li class="cs-service-card-item">Slot and location details</li>
                    <li class="cs-service-card-item">Notification preferences</li>
                </ul>
                <a href="<?php echo e(route('bookings.index')); ?>" class="cs-btn cs-btn-primary cs-btn-sm cs-service-card-cta">View Confirmation</a>
            </article>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.customer-core', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\services.blade.php ENDPATH**/ ?>