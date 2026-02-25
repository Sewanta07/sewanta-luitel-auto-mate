

<?php $__env->startSection('title', 'Reset Password - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex bg-white">
    <!-- Left Side: Image/Branding (Hidden on mobile) -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900/60 to-black/60 z-10"></div>
        <img src="https://images.unsplash.com/photo-1486006920555-c77dcf18193c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" class="absolute inset-0 w-full h-full object-cover">
        
        <div class="relative z-20 flex flex-col justify-end p-16 text-white h-full">
            <h1 class="text-4xl font-bold mb-4">Create New Password</h1>
            <p class="text-lg text-gray-200">Secure your account with a strong new password.</p>
        </div>
    </div>

    <!-- Right Side: Reset Password Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-12 lg:px-24 xl:px-32 py-12">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="<?php echo e(route('index')); ?>" class="flex items-center mb-8">
                <span class="text-3xl font-extrabold tracking-tight text-[#ff5a1f]">AutoMate</span>
            </a>
            
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Reset your password</h2>
            <p class="text-gray-600 mb-10">
                Enter a new password for your account. Make sure it's strong and secure.
            </p>
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            
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

            <form method="POST" action="<?php echo e(route('password.update')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                
                <input type="hidden" name="token" value="<?php echo e($token); ?>">

                
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email address</label>
                    <div class="mt-2 relative rounded-md shadow-sm">
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required 
                            readonly
                            class="block w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] sm:text-sm shadow-sm placeholder-gray-400 bg-gray-50" 
                            value="<?php echo e($email ?? old('email')); ?>" 
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
                </div>

                
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700">New Password</label>
                    <div class="mt-2 relative rounded-md shadow-sm">
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="new-password" 
                            required 
                            class="block w-full px-4 py-3 pr-12 rounded-xl border <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:ring-red-500 focus:border-red-500 <?php else: ?> border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> sm:text-sm shadow-sm placeholder-gray-400"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('password', 'password-toggle')" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition"
                        >
                            <svg id="password-toggle" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <p class="mt-2 text-xs text-gray-600">
                        Password must be at least 8 characters and include uppercase, lowercase, numbers, and symbols.
                    </p>
                </div>

                
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                    <div class="mt-2 relative rounded-md shadow-sm">
                        <input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password" 
                            autocomplete="new-password" 
                            required 
                            class="block w-full px-4 py-3 pr-12 rounded-xl border <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 focus:ring-red-500 focus:border-red-500 <?php else: ?> border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> sm:text-sm shadow-sm placeholder-gray-400"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility('password_confirmation', 'password-confirmation-toggle')" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition"
                        >
                            <svg id="password-confirmation-toggle" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#ff5a1f] hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition transform hover:-translate-y-0.5 shadow-lg shadow-orange-100"
                    >
                        Reset Password
                    </button>
                </div>

                
                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        <a href="<?php echo e(route('login')); ?>" class="font-medium text-[#ff5a1f] hover:text-[#e64b15]">Back to Login</a>
                    </p>
                </div>
            </form>

            
            <div class="mt-8 p-4 rounded-xl bg-green-50 border border-green-200">
                <div class="flex items-start gap-3">
                    <svg class="h-5 w-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-green-900">🔐 Password Security</p>
                        <p class="text-xs text-green-700 mt-1">
                            Your password will be securely encrypted. Make it unique and don't share it with anyone.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.add('text-[#ff5a1f]');
    } else {
        field.type = 'password';
        icon.classList.remove('text-[#ff5a1f]');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\auth\reset-password.blade.php ENDPATH**/ ?>