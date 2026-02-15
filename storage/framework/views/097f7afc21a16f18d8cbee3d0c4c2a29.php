

<?php $__env->startSection('title', 'Forgot Password - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex bg-white">
    <!-- Left Side: Image/Branding (Hidden on mobile) -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900/60 to-black/60 z-10"></div>
        <img src="https://images.unsplash.com/photo-1486006920555-c77dcf18193c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" class="absolute inset-0 w-full h-full object-cover">
        
        <div class="relative z-20 flex flex-col justify-end p-16 text-white h-full">
            <h1 class="text-4xl font-bold mb-4">Reset Your Password</h1>
            <p class="text-lg text-gray-200">Regain access to your vehicle management dashboard in minutes.</p>
        </div>
    </div>

    <!-- Right Side: Forgot Password Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-12 lg:px-24 xl:px-32 py-12">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="<?php echo e(route('index')); ?>" class="flex items-center mb-8">
                <span class="text-3xl font-extrabold tracking-tight text-[#ff5a1f]">AutoMate</span>
            </a>
            
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Forgot your password?</h2>
            <p class="text-gray-600 mb-10">
                No problem! Enter your email address and we'll send you a secure link to reset your password. This feature is available for staff and customer accounts only.
            </p>
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            
            <?php if(session('status')): ?>
                <div class="mb-6 rounded-xl bg-green-50 p-4 border border-green-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-green-800">Success!</h3>
                            <p class="mt-1 text-sm text-green-700"><?php echo e(session('status')); ?> Please check your email for the password reset link.</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <?php if($errors->any()): ?>
                <div class="mb-6 rounded-xl bg-red-50 p-4 border border-red-100">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors with your request</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.email')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email address</label>
                    <div class="mt-2 relative rounded-md shadow-sm">
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            class="block w-full px-4 py-3 rounded-xl border <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:ring-red-500 focus:border-red-500 <?php else: ?> border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> sm:text-sm shadow-sm placeholder-gray-400" 
                            value="<?php echo e(old('email')); ?>" 
                            placeholder="you@example.com"
                        >
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <p class="mt-1 text-xs text-gray-500">
                        💡 <strong>Tip:</strong> Make sure you enter the email address exactly as you registered it (including capitalization).
                    </p>
                </div>

                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#ff5a1f] hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition transform hover:-translate-y-0.5 shadow-lg shadow-orange-100"
                    >
                        Send Password Reset Link
                    </button>
                </div>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Remember your password? 
                        <a href="<?php echo e(route('login')); ?>" class="font-medium text-[#ff5a1f] hover:text-[#e64b15]">Sign in here</a>
                    </p>
                </div>
            </form>

            <!-- Security Note -->
            <div class="mt-8 p-4 rounded-xl bg-blue-50 border border-blue-200">
                <div class="flex items-start gap-3">
                    <svg class="h-5 w-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-blue-900">Security Note</p>
                        <p class="text-xs text-blue-700 mt-1">
                            Admin accounts are restricted from using password reset for security reasons. If you're an admin user, please contact your system administrator.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Troubleshooting Section -->
            <div class="mt-6 p-4 rounded-xl bg-amber-50 border border-amber-200">
                <div class="flex items-start gap-3">
                    <svg class="h-5 w-5 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-amber-900">Email Not Found?</p>
                        <ul class="text-xs text-amber-700 mt-2 space-y-1">
                            <li>✓ Check you're using the email address you registered with</li>
                            <li>✓ Email addresses are case-sensitive (Example@com ≠ example@com)</li>
                            <li>✓ Remove any leading or trailing spaces</li>
                            <li>✓ Check your spam folder for our emails</li>
                            <li>✓ Only staff and customer accounts can reset via email</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>