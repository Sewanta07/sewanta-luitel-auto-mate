

<?php $__env->startSection('title', 'Manage Rental Vehicles'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4 font-semibold transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Manage Rental Vehicles</h1>
                <p class="text-gray-600">Manage service center vehicles and approved customer-listed vehicles</p>
            </div>
            <button onclick="document.getElementById('addVehicleModal').classList.remove('hidden')" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg transition">
                + Add Rental Vehicle
            </button>
        </div>

    <?php if(session('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <!-- Vehicles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <?php if($vehicle->image_path): ?>
            <img src="<?php echo e(asset('storage/' . $vehicle->image_path)); ?>" alt="<?php echo e($vehicle->vehicle_name); ?>" class="w-full h-48 object-cover">
            <?php else: ?>
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            </div>
            <?php endif; ?>
            
            <div class="p-5">
                <div class="flex items-center gap-2 mb-2">
                    <h3 class="text-xl font-semibold text-gray-800"><?php echo e($vehicle->vehicle_name); ?></h3>
                    <?php if($vehicle->customer_id): ?>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                            Customer Listed
                        </span>
                    <?php else: ?>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                            Service Center
                        </span>
                    <?php endif; ?>
                </div>
                <p class="text-gray-600 text-sm mb-4"><?php echo e($vehicle->brand); ?> <?php echo e($vehicle->model); ?> (<?php echo e($vehicle->year); ?>)</p>
                
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Type:</span>
                        <span class="font-medium text-gray-800"><?php echo e($vehicle->vehicle_type); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Daily Rate:</span>
                        <span class="font-bold text-blue-600">Rs. <?php echo e(number_format($vehicle->daily_rate, 2)); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Security Deposit:</span>
                        <span class="font-medium text-gray-800">Rs. <?php echo e(number_format($vehicle->security_deposit ?? 0, 2)); ?></span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Status:</span>
                        <?php if($vehicle->is_listed_for_rent): ?>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Active</span>
                        <?php else: ?>
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-semibold rounded-full">Inactive</span>
                        <?php endif; ?>
                    </div>
                    <?php if($vehicle->customer_id): ?>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Owner:</span>
                        <span class="font-medium text-gray-800"><?php echo e($vehicle->customer->name ?? 'N/A'); ?></span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="flex gap-2">
                    <?php if(!$vehicle->customer_id): ?>
                    <button onclick="editVehicle(<?php echo e($vehicle->id); ?>, '<?php echo e($vehicle->vehicle_name); ?>', <?php echo e($vehicle->daily_rate); ?>, <?php echo e($vehicle->security_deposit ?? 0); ?>, <?php echo e($vehicle->is_listed_for_rent ? 'true' : 'false'); ?>);" 
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition">
                        Edit
                    </button>
                    <form action="<?php echo e(route('admin.rentals.vehicles.destroy', $vehicle)); ?>" method="POST" class="flex-1" onsubmit="return confirm('Delete this vehicle?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                            Delete
                        </button>
                    </form>
                    <?php else: ?>
                    <form action="<?php echo e(route('admin.rentals.vehicles.destroy', $vehicle)); ?>" method="POST" class="w-full" onsubmit="return confirm('Delete this customer-listed vehicle?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                            Delete Listing
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-3 text-center py-12">
            <svg class="w-20 h-20 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg>
            <p class="text-gray-500 text-lg">No rental vehicles added yet</p>
            <button onclick="document.getElementById('addVehicleModal').classList.remove('hidden')" 
                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                Add Your First Vehicle
            </button>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Vehicle Modal -->
<div id="addVehicleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Add Rental Vehicle</h2>
            <button onclick="document.getElementById('addVehicleModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form action="<?php echo e(route('admin.rentals.vehicles.store')); ?>" method="POST" enctype="multipart/form-data" class="p-6">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Vehicle Name *</label>
                    <input type="text" name="vehicle_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Brand *</label>
                    <input type="text" name="brand" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Model *</label>
                    <input type="text" name="model" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Year *</label>
                    <input type="number" name="year" required min="1900" max="<?php echo e(date('Y')); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Plate Number *</label>
                    <input type="text" name="plate_number" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Vehicle Type *</label>
                    <select name="vehicle_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="Car">Car</option>
                        <option value="Bike">Bike</option>
                        <option value="SUV">SUV</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Fuel Type *</label>
                    <select name="fuel_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="Petrol">Petrol</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Electric">Electric</option>
                        <option value="Hybrid">Hybrid</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Transmission *</label>
                    <select name="transmission_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="Manual">Manual</option>
                        <option value="Automatic">Automatic</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Daily Rate (Rs.) *</label>
                    <input type="number" name="daily_rate" required min="0" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Security Deposit (Rs.)</label>
                    <input type="number" name="security_deposit" min="0" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Rental Rules</label>
                    <textarea name="rental_rules" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Vehicle Image</label>
                    <input type="file" name="vehicle_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div class="flex gap-4 mt-6">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Add Vehicle
                </button>
                <button type="button" onclick="document.getElementById('addVehicleModal').classList.add('hidden')" 
                        class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Vehicle Modal -->
<div id="editVehicleModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg max-w-md w-full">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Edit Vehicle</h2>
            <button onclick="document.getElementById('editVehicleModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form id="editVehicleForm" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Vehicle Name *</label>
                    <input type="text" id="edit_vehicle_name" name="vehicle_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Daily Rate (Rs.) *</label>
                    <input type="number" id="edit_daily_rate" name="daily_rate" required min="0" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Security Deposit (Rs.)</label>
                    <input type="number" id="edit_security_deposit" name="security_deposit" min="0" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" id="edit_is_listed" name="is_listed_for_rent" value="1" class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                        <span class="ml-2 text-gray-700">Available for Rent</span>
                    </label>
                </div>
            </div>
            
            <div class="flex gap-4 mt-6">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Update Vehicle
                </button>
                <button type="button" onclick="document.getElementById('editVehicleModal').classList.add('hidden')" 
                        class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function editVehicle(id, name, dailyRate, securityDeposit, isListed) {
    document.getElementById('editVehicleForm').action = `/admin/rentals/vehicles/${id}`;
    document.getElementById('edit_vehicle_name').value = name;
    document.getElementById('edit_daily_rate').value = dailyRate;
    document.getElementById('edit_security_deposit').value = securityDeposit;
    document.getElementById('edit_is_listed').checked = isListed;
    document.getElementById('editVehicleModal').classList.remove('hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\rentals\vehicles.blade.php ENDPATH**/ ?>