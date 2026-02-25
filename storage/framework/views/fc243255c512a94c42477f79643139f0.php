

<?php $__env->startSection('title', 'Register - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <div class="flex justify-center">
            <a href="<?php echo e(route('index')); ?>" class="text-3xl font-extrabold tracking-tight text-[#ff5a1f]">AutoMate</a>
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Create your account
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            Already have an account?
            <a href="<?php echo e(route('login')); ?>" class="font-medium text-[#ff5a1f] hover:text-[#e64b15]">
                Sign in instead
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white py-8 px-4 shadow-xl shadow-gray-100 sm:rounded-3xl sm:px-10 border border-gray-100">
            <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                    <div class="rounded-xl bg-red-50 p-4 border border-red-100">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
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

                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" autocomplete="name" required class="block w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] sm:text-sm shadow-sm placeholder-gray-400" value="<?php echo e(old('name')); ?>" placeholder="John Doe">
                        </div>
                    </div>

                    
                    <div class="sm:col-span-3">
                        <label for="phone" class="block text-sm font-semibold text-gray-700">Phone Number</label>
                        <div class="mt-2">
                            <input type="tel" name="phone" id="phone" autocomplete="tel" required class="block w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] sm:text-sm shadow-sm placeholder-gray-400" value="<?php echo e(old('phone')); ?>" placeholder="+1 (555) 000-0000">
                        </div>
                    </div>

                    
                    <div class="sm:col-span-6">
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" required class="block w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] sm:text-sm shadow-sm placeholder-gray-400" value="<?php echo e(old('email')); ?>" placeholder="you@example.com">
                        </div>
                    </div>

                    
                    <div class="sm:col-span-6">
                        <label for="current_address" class="block text-sm font-semibold text-gray-700">Current Address</label>
                        <div class="mt-2">
                            <textarea id="current_address" name="current_address" rows="2" required class="block w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] sm:text-sm shadow-sm placeholder-gray-400" placeholder="123 Main St, Apt 4B"><?php echo e(old('current_address')); ?></textarea>
                        </div>
                    </div>

                    
                    <div class="sm:col-span-3">
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        <div class="mt-2 relative">
                            <input id="password" name="password" type="password" required class="block w-full px-4 py-3 pr-12 rounded-xl border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] sm:text-sm shadow-sm placeholder-gray-400" placeholder="••••••••">
                            <button type="button" onclick="togglePasswordVisibility('password', 'password-toggle')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                                <svg id="password-toggle" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    
                    <div class="sm:col-span-3">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
                        <div class="mt-2 relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required class="block w-full px-4 py-3 pr-12 rounded-xl border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] sm:text-sm shadow-sm placeholder-gray-400" placeholder="••••••••">
                            <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'password_confirmation-toggle')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition">
                                <svg id="password_confirmation-toggle" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    
                    <div class="sm:col-span-6">
                        <label for="role" class="block text-sm font-semibold text-gray-700">Register as</label>
                        <div class="mt-2">
                            <select id="role" name="role" required class="block w-full px-4 py-3 rounded-xl border-gray-300 focus:ring-[#ff5a1f] focus:border-[#ff5a1f] sm:text-sm shadow-sm">
                                <option value="" disabled selected>Select your account type</option>
                                <option value="customer" <?php echo e(old('role') == 'customer' ? 'selected' : ''); ?>>Customer (I want to book services)</option>
                                <option value="staff" <?php echo e(old('role') == 'staff' ? 'selected' : ''); ?>>Mechanic/Staff (I work here)</option>
                            </select>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Staff accounts require admin approval before access is granted.</p>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-[#ff5a1f] hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition transform hover:-translate-y-0.5 shadow-lg shadow-orange-100">
                        Create Account
                    </button>
                </div>
            </form>
        </div>
        
        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400">
                &copy; <?php echo e(date('Y')); ?> AutoMate. All rights reserved.
            </p>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\auth\register.blade.php ENDPATH**/ ?>