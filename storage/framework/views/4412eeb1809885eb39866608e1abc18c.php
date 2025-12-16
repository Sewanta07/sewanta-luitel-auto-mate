<?php $__env->startSection('title', 'Admin Profile'); ?>

<?php $__env->startSection('content'); ?>
<?php ($admin = auth()->user()); ?>
<div class="dashboard">
    <nav class="dashboard-nav">
        <div class="container">
            <div class="nav-content">
                <div class="logo">
                    <h1>AutoMate</h1>
                </div>
                <div class="nav-links">
                    <span class="user-info">Welcome, <?php echo e($admin?->name); ?></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="dashboard-content admin-layout">
        <aside class="admin-sidebar">
            <div class="sidebar-section">
                <div class="sidebar-title">Navigation</div>
                <a href="<?php echo e(route('dashboard.admin')); ?>" class="sidebar-link">Overview</a>
                <a href="<?php echo e(route('admin.profile')); ?>" class="sidebar-link active">Profile</a>
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
                        <div class="admin-breadcrumb">Admin / Profile</div>
                        <h2>My Profile</h2>
                        <p>Manage your profile information and credentials</p>
                    </div>
                </div>

                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                    <div class="alert alert-error">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Profile Information Section -->
                <div class="dashboard-section">
                    <h3>Profile Information</h3>
                    
                    <form method="POST" action="<?php echo e(route('admin.profile.update')); ?>" enctype="multipart/form-data" class="profile-form">
                        <?php echo csrf_field(); ?>
                        
                        <div class="profile-header">
                            <div class="profile-image-section">
                                <div class="profile-image-preview">
                                    <?php if($admin->profile_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $admin->profile_image)); ?>" alt="Profile Image" id="profile-preview">
                                    <?php else: ?>
                                        <div class="profile-placeholder" id="profile-preview">
                                            <span><?php echo e(strtoupper(substr($admin->name, 0, 1))); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label for="profile_image">Profile Picture</label>
                                    <input type="file" id="profile_image" name="profile_image" accept="image/*" onchange="previewImage(this)" class="form-control">
                                    <small class="text-muted">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</small>
                                    <?php $__errorArgs = ['profile_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="error-message"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name <span class="required">*</span></label>
                                <input type="text" id="name" name="name" value="<?php echo e(old('name', $admin->name)); ?>" required class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error-message"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" name="email" value="<?php echo e(old('email', $admin->email)); ?>" required class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error-message"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone', $admin->phone)); ?>" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="e.g., +1234567890">
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error-message"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group">
                                <label for="status">Account Status</label>
                                <input type="text" value="<?php echo e(ucfirst($admin->status)); ?>" class="form-control" disabled>
                                <small class="text-muted">Status cannot be changed from profile</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="current_address">Current Address</label>
                            <textarea id="current_address" name="current_address" rows="3" class="form-control <?php $__errorArgs = ['current_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter your full address"><?php echo e(old('current_address', $admin->current_address)); ?></textarea>
                            <?php $__errorArgs = ['current_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>

                <!-- Password Change Section -->
                <div class="dashboard-section">
                    <h3>Change Password</h3>
                    
                    <form method="POST" action="<?php echo e(route('admin.profile.password')); ?>" class="password-form">
                        <?php echo csrf_field(); ?>
                        
                        <div class="form-group">
                            <label for="current_password">Current Password <span class="required">*</span></label>
                            <div class="password-input-wrapper">
                                <input type="password" id="current_password" name="current_password" required class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                                    <span class="password-icon-show">👁️</span>
                                    <span class="password-icon-hide" style="display: none;">🙈</span>
                                </button>
                            </div>
                            <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">New Password <span class="required">*</span></label>
                                <div class="password-input-wrapper">
                                    <input type="password" id="password" name="password" required class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                        <span class="password-icon-show">👁️</span>
                                        <span class="password-icon-hide" style="display: none;">🙈</span>
                                    </button>
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error-message"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password <span class="required">*</span></label>
                                <div class="password-input-wrapper">
                                    <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control">
                                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                        <span class="password-icon-show">👁️</span>
                                        <span class="password-icon-hide" style="display: none;">🙈</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>

                <!-- Account Credentials Section -->
                <div class="dashboard-section">
                    <h3>Account Credentials</h3>
                    <div class="credentials-info">
                        <div class="info-row">
                            <span class="info-label">User ID:</span>
                            <span class="info-value"><?php echo e($admin->id); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email:</span>
                            <span class="info-value"><?php echo e($admin->email); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Role:</span>
                            <span class="info-value badge success">Administrator</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Account Created:</span>
                            <span class="info-value"><?php echo e($admin->created_at->format('F d, Y')); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Last Updated:</span>
                            <span class="info-value"><?php echo e($admin->updated_at->format('F d, Y h:i A')); ?></span>
                        </div>
                        <?php if($admin->email_verified_at): ?>
                        <div class="info-row">
                            <span class="info-label">Email Verified:</span>
                            <span class="info-value badge success"><?php echo e($admin->email_verified_at->format('F d, Y')); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
.profile-header {
    margin-bottom: 2rem;
}

.profile-image-section {
    display: flex;
    align-items: center;
    gap: 2rem;
    padding: 1.5rem;
    background: var(--card-bg);
    border-radius: var(--radius);
    border: 1px solid var(--border-color);
}

.profile-image-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.profile-image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-color), #2563eb);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    font-weight: bold;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .profile-image-section {
        flex-direction: column;
        text-align: center;
    }
}

.form-actions {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-color);
}

.required {
    color: var(--danger-color);
}

.credentials-info {
    background: var(--card-bg);
    border-radius: var(--radius);
    padding: 1.5rem;
    border: 1px solid var(--border-color);
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--border-color);
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 500;
    color: var(--text-secondary);
}

.info-value {
    color: var(--text-primary);
    font-weight: 500;
}

.password-form {
    margin-top: 1rem;
}
</style>

<script>
function previewImage(input) {
    const preview = document.getElementById('profile-preview');
    const file = input.files[0];
    
    if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                // Replace placeholder with image
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Profile Image';
                img.id = 'profile-preview';
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                preview.parentNode.replaceChild(img, preview);
            }
        };
        
        reader.readAsDataURL(file);
    }
}

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const wrapper = input.closest('.password-input-wrapper');
    const button = wrapper.querySelector('.password-toggle');
    const showIcon = button.querySelector('.password-icon-show');
    const hideIcon = button.querySelector('.password-icon-hide');
    
    if (input.type === 'password') {
        input.type = 'text';
        showIcon.style.display = 'none';
        hideIcon.style.display = 'inline-block';
    } else {
        input.type = 'password';
        showIcon.style.display = 'inline-block';
        hideIcon.style.display = 'none';
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/profile.blade.php ENDPATH**/ ?>