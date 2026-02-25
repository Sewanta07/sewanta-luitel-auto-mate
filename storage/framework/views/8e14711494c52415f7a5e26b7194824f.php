

<?php $__env->startSection('title', 'My Profile - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php ($customer = $user ?? auth()->user()); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="mb-8 mt-4">
            <h1 class="text-3xl font-bold text-gray-900">My Profile</h1>
            <p class="mt-2 text-lg text-gray-600">Manage your personal details, vehicles, and account security.</p>
        </div>

        
        <?php if(session('success')): ?>
            <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800">
                <p class="font-semibold mb-2">Please fix the following:</p>
                <ul class="list-disc pl-5 space-y-1 text-sm">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            
            <div class="space-y-8">
                
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-6 text-left">Profile Picture</h3>
                    <form action="<?php echo e(route('customer.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="relative inline-block">
                            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-orange-50 mx-auto bg-gray-100 flex items-center justify-center">
                                <?php if($customer->profile_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $customer->profile_image)); ?>" id="profile-preview-left" alt="Profile" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <span class="text-4xl font-bold text-gray-300"><?php echo e(strtoupper(substr($customer->name ?? 'U', 0, 1))); ?></span>
                                <?php endif; ?>
                            </div>
                            <label for="profile_image_input" class="absolute bottom-0 right-0 bg-[#ff5a1f] p-2 rounded-full text-white cursor-pointer shadow-lg hover:bg-[#e64b15] transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <input type="file" id="profile_image_input" name="profile_image" class="hidden" accept="image/*" onchange="previewProfileImage(this)">
                            </label>
                        </div>
                        <p class="mt-4 text-xs text-gray-500 italic">Accepted formats: JPG, PNG, GIF. Max 2MB.</p>
                        <button type="submit" class="mt-6 w-full py-2.5 rounded-xl bg-orange-50 text-[#ff5a1f] font-semibold hover:bg-orange-100 transition">
                            Update Photo
                        </button>
                    </form>
                </div>

                
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="p-2 bg-purple-50 rounded-lg">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Security</h3>
                    </div>
                    <form action="<?php echo e(route('customer.profile.password')); ?>" method="POST" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Current Password</label>
                            <div class="relative">
                                <input id="customer-current-password" type="password" name="current_password" required class="block w-full px-4 py-3 pr-20 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                                <button type="button" onclick="togglePasswordVisibility('customer-current-password', this)" class="absolute inset-y-0 right-3 my-auto text-xs font-semibold text-gray-500 hover:text-[#ff5a1f] transition">Show</button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">New Password</label>
                            <div class="relative">
                                <input id="customer-new-password" type="password" name="password" required class="block w-full px-4 py-3 pr-20 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                                <button type="button" onclick="togglePasswordVisibility('customer-new-password', this)" class="absolute inset-y-0 right-3 my-auto text-xs font-semibold text-gray-500 hover:text-[#ff5a1f] transition">Show</button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Confirm New Password</label>
                            <div class="relative">
                                <input id="customer-confirm-password" type="password" name="password_confirmation" required class="block w-full px-4 py-3 pr-20 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                                <button type="button" onclick="togglePasswordVisibility('customer-confirm-password', this)" class="absolute inset-y-0 right-3 my-auto text-xs font-semibold text-gray-500 hover:text-[#ff5a1f] transition">Show</button>
                            </div>
                        </div>
                        <button type="submit" class="w-full py-3 rounded-xl bg-gray-900 text-white font-bold hover:bg-gray-800 transition shadow-lg shadow-gray-200">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8">
                    <div class="flex items-center space-x-3 mb-8">
                        <div class="p-2 bg-orange-50 rounded-lg">
                            <svg class="w-5 h-5 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Personal Information</h3>
                    </div>

                    <form action="<?php echo e(route('customer.profile.update')); ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php echo csrf_field(); ?>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Full Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="<?php echo e(old('name', $customer->name)); ?>" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="<?php echo e(old('email', $customer->email)); ?>" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Phone Number</label>
                            <input type="tel" name="phone" value="<?php echo e(old('phone', $customer->phone)); ?>" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Mailing Address</label>
                            <input type="text" name="current_address" value="<?php echo e(old('current_address', $customer->current_address)); ?>" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                        </div>
                        <div class="md:col-span-2 flex justify-end pt-4">
                            <button type="submit" class="px-8 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] shadow-lg shadow-orange-100 transform hover:-translate-y-0.5 transition duration-200">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sm:p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-50 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Registered Vehicles</h3>
                        </div>
                        <a href="<?php echo e(route('customer.vehicles')); ?>" class="text-sm font-bold text-[#ff5a1f] hover:text-[#e64b15] transition flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Add New
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 rounded-xl">
                                <tr>
                                    <th class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider rounded-l-xl">Vehicle</th>
                                    <th class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Model/Year</th>
                                    <th class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Plate No.</th>
                                    <th class="px-4 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider rounded-r-xl">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php $__empty_1 = true; $__currentLoopData = ($vehicles ?? collect()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                                                </div>
                                                <span class="text-sm font-bold text-gray-900"><?php echo e($vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model)); ?></span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-gray-600"><?php echo e($vehicle->model); ?> / <?php echo e($vehicle->year); ?></td>
                                        <td class="px-4 py-4 text-sm text-gray-600 font-mono"><?php echo e($vehicle->plate_number); ?></td>
                                        <td class="px-4 py-4 text-sm">
                                            <div class="flex items-center space-x-3">
                                                <a href="<?php echo e(route('vehicles.edit', $vehicle->id)); ?>" class="text-blue-600 hover:text-blue-800 transition font-medium">Edit</a>
                                                <form action="<?php echo e(route('vehicles.destroy', $vehicle->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to remove this vehicle?');" class="inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="text-red-500 hover:text-red-700 transition font-medium" <?php echo e($vehicle->rented_by_user_id ? 'disabled' : ''); ?>>
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">
                                            No registered vehicles yet. Click <span class="font-semibold text-[#ff5a1f]">Add New</span> to add your first vehicle.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    function togglePasswordVisibility(inputId, button) {
        const input = document.getElementById(inputId);
        if (!input) return;

        const isPassword = input.type === 'password';
        input.type = isPassword ? 'text' : 'password';
        button.textContent = isPassword ? 'Hide' : 'Show';
    }

    function previewProfileImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('profile-preview-left');
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    // If there was no image before, create one
                    const container = input.closest('.relative').querySelector('.w-32');
                    container.innerHTML = `<img src="${e.target.result}" id="profile-preview-left" alt="Profile" class="w-full h-full object-cover">`;
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\profile.blade.php ENDPATH**/ ?>