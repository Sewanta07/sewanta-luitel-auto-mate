<?php $__env->startSection('title', 'AutoMate - Smart Vehicle Service Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="landing-page">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <a href="#top">Home</a>
                    <a href="#services">Services</a>
                    <a href="#features">Features</a>
                    <a href="#contact">Contact</a>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard.' . auth()->user()->role)); ?>" class="btn btn-outline">Dashboard</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-primary">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="top">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Digital Vehicle Service Management, Simplified.</h1>
                <p class="hero-subtitle">Increase efficiency, keep every service transparent, and manage bookings, updates, and approvals from one centralized platform.</p>
                
                <?php if(auth()->guard()->guest()): ?>
                <div class="hero-actions">
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary btn-large">Book Service Now</a>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-outline btn-large">Login / Register</a>
                </div>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                <div class="hero-actions">
                    <a href="<?php echo e(route('dashboard.' . auth()->user()->role)); ?>" class="btn btn-primary btn-large">Book Service Now</a>
                    <a href="<?php echo e(route('dashboard.' . auth()->user()->role)); ?>" class="btn btn-outline btn-large">Go to Dashboard</a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="container">
            <h2 class="section-title">How It Works</h2>
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-icon">📍</div>
                    <h3>Choose Location & Service</h3>
                    <p>Select your workshop or pickup option and the services you need.</p>
                </div>
                <div class="step-card">
                    <div class="step-icon">📅</div>
                    <h3>Pick a Slot</h3>
                    <p>Reserve a time that fits your schedule with instant confirmation.</p>
                </div>
                <div class="step-card">
                    <div class="step-icon">⚙️</div>
                    <h3>Track in Real Time</h3>
                    <p>Follow status updates, approvals, and chat with staff as work progresses.</p>
                </div>
                <div class="step-card">
                    <div class="step-icon">✅</div>
                    <h3>Pickup or Deliver</h3>
                    <p>Get notified when ready, settle payments, and keep records synced.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Categories Preview -->
    <section class="services-preview" id="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Service Categories</h2>
                <p class="section-subtitle">Essential maintenance, diagnostics, and repairs to keep every vehicle healthy.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🛠️</div>
                    <h3>Maintenance</h3>
                    <p>Oil changes, filters, fluids, and scheduled checkups to prevent surprises.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🔧</div>
                    <h3>Repairs</h3>
                    <p>Brakes, suspension, electrical, and mechanical fixes with status transparency.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🧭</div>
                    <h3>Diagnostics</h3>
                    <p>Computer scans and road tests to pinpoint issues before they grow.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🚗</div>
                    <h3>Pickup & Delivery</h3>
                    <p>Doorstep pickup/dropoff options to keep customers moving without downtime.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials / Trust -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Trusted by Drivers and Teams</h2>
                <p class="section-subtitle">Consistency, transparency, and proactive updates that build confidence.</p>
            </div>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="quote">“</div>
                    <p>Booking and live updates cut my calls in half. I always know where my car stands.</p>
                    <div class="testimonial-meta">
                        <span class="name">Ava M.</span>
                        <span class="role">Customer</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="quote">“</div>
                    <p>Approvals, estimates, and payments are centralized. Our team moves faster with fewer errors.</p>
                    <div class="testimonial-meta">
                        <span class="name">Liam K.</span>
                        <span class="role">Service Manager</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="quote">“</div>
                    <p>Automated reminders and history tracking make recurring maintenance easy to forecast.</p>
                    <div class="testimonial-meta">
                        <span class="name">Noah T.</span>
                        <span class="role">Fleet Lead</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <h2 class="section-title">Why Choose AutoMate?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🗓️</div>
                    <h3>Online Service Booking</h3>
                    <p>Let customers reserve service slots anytime with clear confirmation and reminders.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Real-Time Status Updates</h3>
                    <p>Keep everyone synced with live progress, approvals, and pickup notifications.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⏰</div>
                    <h3>Automated Service Reminders</h3>
                    <p>Prevent surprises with scheduled maintenance nudges and due-date alerts.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🤝</div>
                    <h3>Centralized Collaboration</h3>
                    <p>Unify customer, staff, and admin communication with a shared service timeline.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h3>AutoMate</h3>
                    <p>Digital vehicle service management for transparent, efficient operations.</p>
                </div>
                <div class="footer-links">
                    <h4>Navigate</h4>
                    <a href="<?php echo e(route('index')); ?>">Home</a>
                    <a href="#services">Services</a>
                    <a href="#features">Features</a>
                    <a href="#contact">Contact</a>
                </div>
                <div class="footer-contact" id="contact">
                    <h4>Contact</h4>
                    <p>Email: support@automate.com</p>
                    <p>Phone: (555) 123-4567</p>
                    <p>Hours: Mon–Sat, 8am–6pm</p>
                </div>
                <div class="footer-social">
                    <h4>Follow</h4>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"></a>
                        <a href="#" aria-label="Twitter"></a>
                        <a href="#" aria-label="LinkedIn"></a>
                        <a href="#" aria-label="Instagram"></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
            <p>&copy; <?php echo e(date('Y')); ?> AutoMate. All rights reserved.</p>
            </div>
        </div>
    </footer>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/index.blade.php ENDPATH**/ ?>