

<?php $__env->startSection('title', 'User Profile'); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="flex-1 p-4 sm:p-6 lg:p-8 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
                 <div class="flex items-center text-sm text-gray-500 mb-1">
                    <a href="<?php echo e(route('admin.users')); ?>" class="hover:text-[#ff5a1f] transition-colors">Users</a>
                    <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    <span>Profile</span>
                </div>
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight"><?php echo e($user->name); ?></h2>
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/></svg>
                        <?php echo e(ucfirst($user->role)); ?>

                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                         <?php if($user->status === 'active'): ?>
                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Active</span>
                        <?php else: ?>
                             <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">Inactive</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
             <div class="mt-4 flex md:ml-4 md:mt-0">
                <a href="<?php echo e(url()->previous()); ?>" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Back
                </a>
            </div>
        </div>

        <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
            <div class="px-4 py-6 sm:px-6 bg-gray-50 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="h-16 w-16 rounded-full bg-[#ff5a1f] flex items-center justify-center text-white text-2xl font-bold">
                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold text-gray-900"><?php echo e($user->name); ?></h3>
                        <p class="text-sm text-gray-500"><?php echo e($user->email); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="px-4 py-6 sm:p-8">
                 <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($user->name); ?></dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($user->email); ?></dd>
                    </div>

                    <?php if($user->role === 'staff'): ?>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Position</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($user->staffDetail->position ?? 'N/A'); ?></dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Phone</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($user->staffDetail->phone ?? 'Not provided'); ?></dd>
                        </div>
                         <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Experience</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($user->staffDetail->experience ?? 'Not provided'); ?></dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Documents</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($user->staffDetail->documents ?? 'Not provided'); ?></dd>
                        </div>
                    <?php endif; ?>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Member Since</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($user->created_at?->format('M d, Y')); ?></dd>
                    </div>
                    
                    <div class="col-span-full">
                        <dt class="text-sm font-medium text-gray-500">Address</dt>
                        <dd class="mt-1 text-sm text-gray-900"><?php echo e($user->address ?? 'Not provided'); ?></dd>
                    </div>
                 </dl>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\user_profile.blade.php ENDPATH**/ ?>