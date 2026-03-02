<?php $__env->startSection('title', 'My Profile - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<main class="ad-prof-main">
        
        <div class="ad-prof-head">
            <h1 class="ad-prof-title">My Profile</h1>
            <p class="ad-prof-subtitle">Sensitive account data is locked. Only profile photo and password reset are available.</p>
        </div>

        <?php if(session('success')): ?>
            <div class="ad-prof-alert ad-prof-alert-success">
                <div class="ad-prof-alert-row">
                    <div class="ad-prof-alert-icon-wrap">
                        <svg class="ad-prof-alert-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="ad-prof-alert-content">
                        <p class="ad-prof-alert-text"><?php echo e(session('success')); ?></p>
                        <?php if(session('password_reset_url')): ?>
                            <p class="ad-prof-alert-text">Use this reset link now (local/debug):</p>
                            <a href="<?php echo e(session('password_reset_url')); ?>" class="ad-prof-link"><?php echo e(session('password_reset_url')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="ad-prof-alert ad-prof-alert-danger">
                <div class="ad-prof-alert-row">
                    <div class="ad-prof-alert-icon-wrap">
                        <svg class="ad-prof-alert-icon" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="ad-prof-alert-content">
                        <h3 class="ad-prof-alert-title">There were errors with your submission</h3>
                        <ul class="ad-prof-alert-list">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="ad-prof-grid">
            <!-- Left Column: Profile Card & Credentials -->
            <div class="ad-prof-left-stack">
                 <!-- Account Info Card -->
                 <div class="ad-prof-card">
                    <div class="ad-prof-card-body ad-prof-center">
                        <div class="ad-prof-avatar-wrap">
                            <div class="ad-prof-avatar-lg">
                                <?php if($admin->profile_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $admin->profile_image)); ?>" alt="Profile" class="ad-prof-avatar-image-cover">
                                <?php else: ?>
                                    <span class="ad-prof-avatar-initial-lg"><?php echo e(strtoupper(substr($admin->name, 0, 1))); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <h2 class="ad-prof-name"><?php echo e($admin->name); ?></h2>
                        <p class="ad-prof-email"><?php echo e($admin->email); ?></p>
                        <span class="ad-prof-pill ad-prof-pill-blue">
                            <?php echo e(ucfirst($admin->role ?? 'Administrator')); ?>

                        </span>
                    </div>
                    <div class="ad-prof-card-foot">
                        <h3 class="ad-prof-section-subtitle">Account Details</h3>
                        <div class="ad-prof-details-list">
                            <div class="ad-prof-detail-row">
                                <span class="ad-prof-detail-label">Admin ID</span>
                                <span class="ad-prof-mono">#<?php echo e($admin->id); ?></span>
                            </div>
                            <div class="ad-prof-detail-row">
                                <span class="ad-prof-detail-label">Status</span>
                                <span class="ad-prof-pill ad-prof-pill-green">
                                    <?php echo e(ucfirst($admin->status ?? 'active')); ?>

                                </span>
                            </div>
                            <div class="ad-prof-detail-row">
                                <span class="ad-prof-detail-label">Email Verified</span>
                                <?php if($admin->email_verified_at): ?>
                                    <span class="ad-prof-text-success">Verified</span>
                                <?php else: ?>
                                    <span class="ad-prof-text-warning">Verified</span>
                                <?php endif; ?>
                            </div>
                            <div class="ad-prof-detail-row">
                                <span class="ad-prof-detail-label">Joined</span>
                                <span class="ad-prof-detail-value"><?php echo e($admin->created_at->format('M d, Y')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="ad-prof-card ad-prof-card-padded">
                    <div class="ad-prof-section-head">
                        <div class="ad-prof-icon-box ad-prof-icon-purple">
                            <svg class="ad-prof-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="ad-prof-section-title">Security</h3>
                    </div>
                    <form action="<?php echo e(route('admin.profile.password.reset-link')); ?>" method="POST" class="ad-prof-form-stack-sm">
                        <?php echo csrf_field(); ?>
                        <div class="ad-prof-field">
                            <label class="ad-prof-label">Password Reset</label>
                            <p class="ad-prof-upload-note">Send a secure reset link to your admin email: <?php echo e($admin->email); ?></p>
                        </div>
                        <button type="submit" class="ad-prof-btn ad-prof-btn-dark ad-prof-btn-full">
                            Send Reset Link
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Profile Edit Forms (lg:col-span-2) -->
            <div class="ad-prof-right-col">
                
                <div class="ad-prof-card ad-prof-card-padded-lg">
                    <div class="ad-prof-section-head">
                        <div class="ad-prof-icon-box ad-prof-icon-blue">
                            <svg class="ad-prof-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="ad-prof-section-title">Profile Information</h3>
                    </div>
                    <form action="<?php echo e(route('admin.profile.update')); ?>" method="POST" enctype="multipart/form-data" class="ad-prof-form-stack">
                        <?php echo csrf_field(); ?>
                        
                        
                        <div class="ad-prof-field">
                            <label class="ad-prof-label ad-prof-label-spaced">Profile Picture</label>
                            <div class="ad-prof-photo-row">
                                <div class="ad-prof-avatar-sm">
                                    <?php if($admin->profile_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $admin->profile_image)); ?>" alt="Profile" class="ad-prof-avatar-image-sm" id="profile-preview">
                                    <?php else: ?>
                                        <span class="ad-prof-avatar-initial-sm"><?php echo e(strtoupper(substr($admin->name, 0, 1))); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <label for="profile_image_input" class="ad-prof-upload-btn">
                                        <svg class="ad-prof-upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Change Photo
                                        <input type="file" id="profile_image_input" name="profile_image" class="ad-prof-hidden-input" accept="image/*" onchange="previewProfileImage(this)">
                                    </label>
                                    <p class="ad-prof-upload-note">JPG, PNG, GIF. Max 2MB.</p>
                                </div>
                            </div>
                        </div>

                        <div class="ad-prof-field">
                            <label class="ad-prof-label">Full Name</label>
                            <input type="text" value="<?php echo e($admin->name); ?>" readonly class="ad-prof-input ad-prof-input-soft">
                        </div>

                        <div class="ad-prof-field">
                            <label class="ad-prof-label">Email Address</label>
                            <input type="email" value="<?php echo e($admin->email); ?>" readonly class="ad-prof-input ad-prof-input-soft">
                        </div>

                        <div class="ad-prof-field">
                            <label class="ad-prof-label">Phone Number</label>
                            <input type="text" value="<?php echo e($admin->phone ?: 'N/A'); ?>" readonly class="ad-prof-input ad-prof-input-soft">
                        </div>

                        <div class="ad-prof-field">
                            <label class="ad-prof-label">Address</label>
                            <textarea rows="3" readonly class="ad-prof-input ad-prof-input-soft"><?php echo e($admin->current_address ?: 'N/A'); ?></textarea>
                        </div>

                        
                        <div class="ad-prof-actions">
                            <button type="submit" class="ad-prof-btn ad-prof-btn-primary ad-prof-btn-full">
                                Update Profile Photo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</main>

<script>
function previewProfileImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            let preview = document.getElementById('profile-preview');
            if (!preview) {
                const container = input.closest('div')?.previousElementSibling;
                if (container) {
                    container.innerHTML = '<img id="profile-preview" class="ad-prof-avatar-image-sm" alt="Profile">';
                    preview = document.getElementById('profile-preview');
                }
            }
            if (preview) {
                preview.src = e.target.result;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/profile.blade.php ENDPATH**/ ?>