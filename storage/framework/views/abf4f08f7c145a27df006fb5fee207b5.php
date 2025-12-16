

<?php $__env->startSection('title', 'Manage Users'); ?>

<?php $__env->startSection('content'); ?>
<?php ($user = auth()->user()); ?>
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <span class="user-info">Welcome, <?php echo e($user?->name); ?></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-content admin-layout">
        <aside class="admin-sidebar">
            <div class="sidebar-section">
                <div class="sidebar-title">Navigation</div>
                <a href="<?php echo e(route('dashboard.admin')); ?>" class="sidebar-link">Overview</a>
                <a href="<?php echo e(route('admin.profile')); ?>" class="sidebar-link">Profile</a>
                <a href="<?php echo e(route('admin.users')); ?>" class="sidebar-link">Manage Users</a>
                <a href="<?php echo e(route('admin.staff-applications.index')); ?>" class="sidebar-link">Staff Applications</a>
                <a href="<?php echo e(route('admin.vehicles')); ?>" class="sidebar-link">Vehicles</a>
                <a href="<?php echo e(route('admin.analytics')); ?>" class="sidebar-link">Analytics</a>
                <a href="<?php echo e(route('admin.settings')); ?>" class="sidebar-link">Settings</a>
            </div>
            <div class="sidebar-section">
                <div class="sidebar-title">Shortcuts</div>
                <a href="<?php echo e(route('logout')); ?>" class="sidebar-link"
                   onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                    Logout
                </a>
                <form id="sidebar-logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display:none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </aside>

        <main class="admin-main">
            <div class="container">
                <div class="admin-topbar">
                    <div>
                        <div class="admin-breadcrumb">Admin / Users</div>
                        <h2>Manage Users</h2>
                    </div>
                </div>

                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <div class="dashboard-section">
                    <div class="toggle-row">
                        <div class="toggle-buttons">
                            <a href="<?php echo e(route('admin.users', ['view' => 'staff'])); ?>" class="btn-toggle <?php echo e($view === 'staff' ? 'active' : ''); ?>">Staff</a>
                            <a href="<?php echo e(route('admin.users', ['view' => 'customers'])); ?>" class="btn-toggle <?php echo e($view === 'customers' ? 'active' : ''); ?>">Customers</a>
                        </div>
                    </div>
                </div>

                <?php if($view === 'staff'): ?>
                    <div class="dashboard-section">
                        <h3>Staff</h3>
                        <?php if($staff->isEmpty()): ?>
                            <p>No staff accounts yet.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Level</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <a href="<?php echo e(route('admin.users.show', $member->id)); ?>" class="name-link"><?php echo e($member->name); ?></a>
                                                </td>
                                                <td><?php echo e($member->email); ?></td>
                                                <td><span class="badge <?php echo e($member->status === 'active' ? 'success' : ($member->status === 'pending' ? 'warning' : 'danger')); ?>"><?php echo e(ucfirst($member->status)); ?></span></td>
                                                <td><?php echo e($member->position ?? '—'); ?></td>
                                                <td style="white-space: nowrap;">
                                                    <?php if($member->status !== 'active'): ?>
                                                        <form action="<?php echo e(route('admin.users.updateStatus', $member->id)); ?>" method="POST" style="display:inline-block;">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="status" value="active">
                                                            <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                                                        </form>
                                                    <?php endif; ?>
                                                    <form action="<?php echo e(route('admin.users.destroy', $member->id)); ?>" method="POST" style="display:inline-block; margin-left:0.35rem;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-outline btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="dashboard-section">
                        <h3>Customers</h3>
                        <?php if($customers->isEmpty()): ?>
                            <p>No customer accounts yet.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><a href="<?php echo e(route('admin.users.show', $customer->id)); ?>" class="name-link"><?php echo e($customer->name); ?></a></td>
                                                <td><?php echo e($customer->email); ?></td>
                                                <td style="white-space: nowrap;">
                                                    <form action="<?php echo e(route('admin.users.destroy', $customer)); ?>" method="POST" style="display:inline-block;">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-outline btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/users.blade.php ENDPATH**/ ?>