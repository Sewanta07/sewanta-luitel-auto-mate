<?php $__env->startSection('title', 'Forgot Password - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<div class="ap-page ap-page-login">
    <div class="ap-login-shell">
        <aside class="ap-login-media" aria-hidden="true">
            <div class="ap-login-overlay"></div>
            <img src="<?php echo e(asset('assets/auth/images/auth-hero.jpg')); ?>" alt="Auto service workshop" class="ap-login-image">
            <div class="ap-login-copy">
                <h1 class="ap-login-copy-title">Reset Your Password</h1>
                <p class="ap-login-copy-text">Regain access to your vehicle management dashboard in minutes.</p>
            </div>
        </aside>

        <main class="ap-login-panel">
            <div class="ap-auth-container">
                <a href="<?php echo e(route('index')); ?>" class="ap-brand-link">
                    <img src="<?php echo e(asset('assets/branding/company-logo.png')); ?>" alt="AutoMate" class="ap-logo-image">
                </a>

                <h2 class="ap-auth-title">Forgot your password?</h2>
                <p class="ap-auth-subtitle">
                    Enter your email and we'll send a password reset link.
                </p>

                <?php if(session('status')): ?>
                    <div class="ap-alert ap-alert-success">
                        <div class="ap-alert-row">
                            <img src="<?php echo e(asset('assets/auth/icons/check-circle.svg')); ?>" alt="Success" class="ap-icon-sm ap-icon-img ap-alert-icon-success">
                            <div>
                                <h3 class="ap-alert-title ap-alert-title-success">Success!</h3>
                                <p class="ap-alert-text-success"><?php echo e(session('status')); ?> Please check your email for the password reset link.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="ap-alert ap-alert-error">
                        <div class="ap-alert-row">
                            <img src="<?php echo e(asset('assets/auth/icons/alert-circle.svg')); ?>" alt="Error" class="ap-icon-sm ap-icon-img ap-alert-icon">
                            <div>
                                <h3 class="ap-alert-title">There were errors with your request</h3>
                                <ul class="ap-error-list">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('password.email')); ?>" class="ap-form">
                    <?php echo csrf_field(); ?>

                    <div class="ap-field">
                        <label for="email" class="ap-label">Email address</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            required
                            class="ap-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ap-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('email')); ?>"
                            placeholder="you@example.com"
                        >
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="ap-field-error"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="ap-btn ap-btn-primary ap-btn-full">
                        Send Password Reset Link
                    </button>

                    <p class="ap-center-text">
                        Remember your password?
                        <a href="<?php echo e(route('login')); ?>" class="ap-link">Sign in here</a>
                    </p>
                </form>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public-core', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\auth\forgot-password.blade.php ENDPATH**/ ?>