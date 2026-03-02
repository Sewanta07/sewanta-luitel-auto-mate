<?php $__env->startSection('title', 'Manage Users'); ?>

<?php $__env->startSection('content'); ?>
<main class="ad-users-main">
            <div class="ad-users-head">
                <div>
                    <h1 class="ad-users-title">Manage Users</h1>
                    <p class="ad-users-subtitle">View and manage staff and customer accounts.</p>
                </div>
                <div class="ad-users-tabs">
                    <a href="<?php echo e(route('admin.users', ['view' => 'staff'])); ?>" class="ad-users-tab <?php echo e($view === 'staff' ? 'ad-users-tab-active' : ''); ?>">Staff</a>
                    <a href="<?php echo e(route('admin.users', ['view' => 'customers'])); ?>" class="ad-users-tab <?php echo e($view === 'customers' ? 'ad-users-tab-active' : ''); ?>">Customers</a>
                </div>
            </div>

            <?php if(session('success')): ?>
                <div class="ad-users-alert ad-users-alert-success">
                    <svg class="ad-users-alert-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="ad-users-alert-text"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>

            <div class="ad-users-card">
                <?php if($view === 'staff'): ?>
                    <div class="ad-users-card-head">
                        <h2 class="ad-users-card-title">Staff Members</h2>
                    </div>
                    <?php if($staff->isEmpty()): ?>
                        <div class="ad-users-empty">
                            No staff accounts found.
                        </div>
                    <?php else: ?>
                        <div class="ad-users-table-wrap">
                            <table class="ad-users-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Level</th>
                                        <th scope="col" class="ad-align-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="ad-users-name-cell">
                                                    <div class="ad-users-avatar ad-users-avatar-staff">
                                                        <?php echo e(substr($member->name, 0, 1)); ?>

                                                    </div>
                                                    <span class="ad-users-name"><?php echo e($member->name); ?></span>
                                                </div>
                                            </td>
                                            <td class="ad-users-email"><?php echo e($member->email); ?></td>
                                            <td>
                                                <span class="ad-users-status-badge <?php echo e($member->status === 'active' ? 'ad-users-status-active' : ($member->status === 'pending' ? 'ad-users-status-pending' : 'ad-users-status-inactive')); ?>">
                                                    <?php echo e(ucfirst($member->status)); ?>

                                                </span>
                                            </td>
                                            <td class="ad-users-level"><?php echo e($member->position ?? '—'); ?></td>
                                            <td class="ad-users-actions-cell">
                                                <?php if($member->status !== 'active'): ?>
                                                    <form action="<?php echo e(route('admin.users.updateStatus', $member->id)); ?>" method="POST" class="ad-users-inline-form">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="status" value="active">
                                                        <button type="submit" class="ad-users-action-link ad-users-action-approve">Approve</button>
                                                    </form>
                                                <?php endif; ?>
                                                <form action="<?php echo e(route('admin.users.destroy', $member->id)); ?>" method="POST" class="ad-users-inline-form" onsubmit="return confirm('Are you sure?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="ad-users-action-link ad-users-action-delete">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="ad-users-card-head">
                        <h2 class="ad-users-card-title">Registered Customers</h2>
                    </div>
                    <?php if($customers->isEmpty()): ?>
                        <div class="ad-users-empty">
                            No customer accounts found.
                        </div>
                    <?php else: ?>
                        <div class="ad-users-table-wrap">
                            <table class="ad-users-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" class="ad-align-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="ad-users-name-cell">
                                                    <div class="ad-users-avatar ad-users-avatar-customer">
                                                        <?php echo e(substr($customer->name, 0, 1)); ?>

                                                    </div>
                                                    <span class="ad-users-name"><?php echo e($customer->name); ?></span>
                                                </div>
                                            </td>
                                            <td class="ad-users-email"><?php echo e($customer->email); ?></td>
                                            <td class="ad-users-actions-cell">
                                                <form action="<?php echo e(route('admin.users.destroy', $customer)); ?>" method="POST" class="ad-users-inline-form" onsubmit="return confirm('Are you sure?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="ad-users-action-link ad-users-action-delete">Delete</button>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/users.blade.php ENDPATH**/ ?>