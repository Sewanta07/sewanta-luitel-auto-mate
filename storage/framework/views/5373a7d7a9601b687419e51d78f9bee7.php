

<?php $__env->startSection('title', 'Staff Applications'); ?>

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
                        <div class="admin-breadcrumb">Admin / Staff Applications</div>
                        <h2>Pending Staff Applications</h2>
                        <p>Review and approve or reject staff requests.</p>
                    </div>
                </div>

                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <div class="dashboard-section">
                    <?php if($pendingStaff->isEmpty()): ?>
                        <p>No pending staff applications.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Applied</th>
                                        <th>Status</th>
                                        <th>Level</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $pendingStaff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($staff->name); ?></td>
                                            <td><?php echo e($staff->email); ?></td>
                                            <td><?php echo e($staff->created_at?->format('M d, Y')); ?></td>
                                            <td><span class="badge warning"><?php echo e(ucfirst($staff->status)); ?></span></td>
                                            <td>
                                                <form action="<?php echo e(route('admin.staff-applications.updateRole', $staff)); ?>" method="POST" class="inline-form">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="text" name="level" class="form-control form-control-sm" placeholder="Head / Senior / Junior" value="<?php echo e($staff->position ?? ''); ?>">
                                            </td>
                                            <td style="white-space: nowrap;">
                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                </form>
                                                <form action="<?php echo e(route('admin.staff-applications.approve', $staff)); ?>" method="POST" style="display:inline-block; margin-left:0.35rem;">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-outline btn-sm">Approve</button>
                                                </form>
                                                <form action="<?php echo e(route('admin.staff-applications.reject', $staff)); ?>" method="POST" style="display:inline-block; margin-left:0.35rem;">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="btn btn-outline btn-sm">Reject</button>
                                                </form>
                                                <form action="<?php echo e(route('admin.staff-applications.destroy', $staff)); ?>" method="POST" style="display:inline-block; margin-left:0.35rem;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-outline btn-sm">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/staff_applications.blade.php ENDPATH**/ ?>