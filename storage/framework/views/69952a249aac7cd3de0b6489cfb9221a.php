

<?php $__env->startSection('title', 'Staff Application Pending'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">AutoMate</h1>
        </div>
        
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 p-8">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-6">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Application Under Review</h2>
                <p class="text-gray-600 mb-8">
                    Thanks for registering! Your staff application is currently being reviewed by an administrator. You will be notified once your account has been approved.
                </p>

                <div class="border-t border-gray-100 pt-6">
                     <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition-colors">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="text-center">
             <p class="text-sm text-gray-500">
                &copy; <?php echo e(date('Y')); ?> AutoMate. All rights reserved.
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\staff\pending.blade.php ENDPATH**/ ?>