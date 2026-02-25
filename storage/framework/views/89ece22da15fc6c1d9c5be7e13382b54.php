

<?php $__env->startSection('title', 'Manage Users'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
    
    <aside class="w-64 flex-shrink-0 z-30">
        <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    
    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-7xl w-full mx-auto p-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 mt-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Manage Users</h1>
                    <p class="mt-2 text-lg text-gray-600">View and manage staff and customer accounts.</p>
                </div>
                <div class="flex space-x-2 bg-white p-1 rounded-xl shadow-sm border border-gray-200">
                    <a href="<?php echo e(route('admin.users', ['view' => 'staff'])); ?>" class="px-4 py-2 text-sm font-medium rounded-lg transition <?php echo e($view === 'staff' ? 'bg-orange-50 text-[#ff5a1f] font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">Staff</a>
                    <a href="<?php echo e(route('admin.users', ['view' => 'customers'])); ?>" class="px-4 py-2 text-sm font-medium rounded-lg transition <?php echo e($view === 'customers' ? 'bg-orange-50 text-[#ff5a1f] font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">Customers</a>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="mb-6 rounded-xl bg-green-50 p-4 border border-green-100 flex items-center">
                    <svg class="h-5 w-5 text-green-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-sm font-medium text-green-800"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <?php if($view === 'staff'): ?>
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900">Staff Members</h2>
                    </div>
                    <?php if($staff->isEmpty()): ?>
                        <div class="p-12 text-center text-gray-500">
                            No staff accounts found.
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Level</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold text-xs mr-3">
                                                        <?php echo e(substr($member->name, 0, 1)); ?>

                                                    </div>
                                                    <span class="text-sm font-medium text-gray-900"><?php echo e($member->name); ?></span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($member->email); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($member->status === 'active' ? 'bg-green-100 text-green-800' : ($member->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')); ?>">
                                                    <?php echo e(ucfirst($member->status)); ?>

                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($member->position ?? '—'); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <?php if($member->status !== 'active'): ?>
                                                    <form action="<?php echo e(route('admin.users.updateStatus', $member->id)); ?>" method="POST" class="inline-block">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="status" value="active">
                                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-3 font-bold">Approve</button>
                                                    </form>
                                                <?php endif; ?>
                                                <form action="<?php echo e(route('admin.users.destroy', $member->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="text-red-400 hover:text-red-600 font-bold">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900">Registered Customers</h2>
                    </div>
                    <?php if($customers->isEmpty()): ?>
                        <div class="p-12 text-center text-gray-500">
                            No customer accounts found.
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs mr-3">
                                                        <?php echo e(substr($customer->name, 0, 1)); ?>

                                                    </div>
                                                    <span class="text-sm font-medium text-gray-900"><?php echo e($customer->name); ?></span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($customer->email); ?></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="<?php echo e(route('admin.users.destroy', $customer)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="text-red-400 hover:text-red-600 font-bold">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\users.blade.php ENDPATH**/ ?>