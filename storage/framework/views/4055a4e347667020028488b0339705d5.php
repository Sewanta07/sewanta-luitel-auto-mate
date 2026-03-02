<?php $__env->startSection('title', 'Manage Rental Vehicles'); ?>

<?php $__env->startSection('content'); ?>
<div class="ad-rveh-page">
    <div class="ad-rveh-container">
        <div class="ad-rveh-back-wrap">
            <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="ad-rveh-back-link">
                <svg class="ad-rveh-back-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>
        <div class="ad-rveh-head">
            <div>
                <h1 class="ad-rveh-title">Manage Rental Vehicles</h1>
                <p class="ad-rveh-subtitle">Manage service center vehicles and approved customer-listed vehicles</p>
            </div>
            <button onclick="document.getElementById('addVehicleModal').classList.remove('ad-hidden')" 
                    class="ad-rveh-btn ad-rveh-btn-primary ad-rveh-btn-lg">
                + Add Rental Vehicle
            </button>
        </div>

    <?php if(session('success')): ?>
    <div class="ad-rveh-alert ad-rveh-alert-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <!-- Vehicles Grid -->
    <div class="ad-rveh-grid">
        <?php $__empty_1 = true; $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="ad-rveh-card">
            <?php if($vehicle->image_path): ?>
            <img src="<?php echo e(asset('storage/' . $vehicle->image_path)); ?>" alt="<?php echo e($vehicle->vehicle_name); ?>" class="ad-rveh-image">
            <?php else: ?>
            <div class="ad-rveh-image-placeholder">
                <svg class="ad-rveh-image-placeholder-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            </div>
            <?php endif; ?>
            
            <div class="ad-rveh-card-body">
                <div class="ad-rveh-card-title-row">
                    <h3 class="ad-rveh-card-title"><?php echo e($vehicle->vehicle_name); ?></h3>
                    <?php if($vehicle->customer_id): ?>
                        <span class="ad-rveh-badge ad-rveh-badge-blue">
                            Customer Listed
                        </span>
                    <?php else: ?>
                        <span class="ad-rveh-badge ad-rveh-badge-purple">
                            Service Center
                        </span>
                    <?php endif; ?>
                </div>
                <p class="ad-rveh-card-subtitle"><?php echo e($vehicle->brand); ?> <?php echo e($vehicle->model); ?> (<?php echo e($vehicle->year); ?>)</p>
                
                <div class="ad-rveh-details">
                    <div class="ad-rveh-detail-row">
                        <span class="ad-rveh-detail-label">Type:</span>
                        <span class="ad-rveh-detail-value"><?php echo e($vehicle->vehicle_type); ?></span>
                    </div>
                    <div class="ad-rveh-detail-row">
                        <span class="ad-rveh-detail-label">Daily Rate:</span>
                        <span class="ad-rveh-detail-value ad-rveh-detail-value-blue">Rs. <?php echo e(number_format($vehicle->daily_rate, 2)); ?></span>
                    </div>
                    <div class="ad-rveh-detail-row">
                        <span class="ad-rveh-detail-label">Security Deposit:</span>
                        <span class="ad-rveh-detail-value">Rs. <?php echo e(number_format($vehicle->security_deposit ?? 0, 2)); ?></span>
                    </div>
                    <div class="ad-rveh-detail-row">
                        <span class="ad-rveh-detail-label">Status:</span>
                        <?php if($vehicle->is_listed_for_rent): ?>
                            <span class="ad-rveh-badge ad-rveh-badge-green">Active</span>
                        <?php else: ?>
                            <span class="ad-rveh-badge ad-rveh-badge-gray">Inactive</span>
                        <?php endif; ?>
                    </div>
                    <?php if($vehicle->customer_id): ?>
                    <div class="ad-rveh-detail-row">
                        <span class="ad-rveh-detail-label">Owner:</span>
                        <span class="ad-rveh-detail-value"><?php echo e($vehicle->customer->name ?? 'N/A'); ?></span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="ad-rveh-actions-row">
                    <?php if(!$vehicle->customer_id): ?>
                    <button onclick="editVehicle(<?php echo e($vehicle->id); ?>, '<?php echo e($vehicle->vehicle_name); ?>', <?php echo e($vehicle->daily_rate); ?>, <?php echo e($vehicle->security_deposit ?? 0); ?>, <?php echo e($vehicle->is_listed_for_rent ? 'true' : 'false'); ?>);" 
                            class="ad-rveh-btn ad-rveh-btn-edit ad-rveh-btn-grow">
                        Edit
                    </button>
                    <form action="<?php echo e(route('admin.rentals.vehicles.destroy', $vehicle)); ?>" method="POST" class="ad-rveh-form-grow" onsubmit="return confirm('Delete this vehicle?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="ad-rveh-btn ad-rveh-btn-delete ad-rveh-btn-full">
                            Delete
                        </button>
                    </form>
                    <?php else: ?>
                    <form action="<?php echo e(route('admin.rentals.vehicles.destroy', $vehicle)); ?>" method="POST" class="ad-rveh-form-full" onsubmit="return confirm('Delete this customer-listed vehicle?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="ad-rveh-btn ad-rveh-btn-delete ad-rveh-btn-full">
                            Delete Listing
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="ad-rveh-empty">
            <svg class="ad-rveh-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
            </svg>
            <p class="ad-rveh-empty-text">No rental vehicles added yet</p>
            <button onclick="document.getElementById('addVehicleModal').classList.remove('ad-hidden')" 
                    class="ad-rveh-btn ad-rveh-btn-primary ad-rveh-empty-btn">
                Add Your First Vehicle
            </button>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Vehicle Modal -->
<div id="addVehicleModal" class="ad-rveh-modal-overlay ad-hidden">
    <div class="ad-rveh-modal ad-rveh-modal-lg">
        <div class="ad-rveh-modal-head">
            <h2 class="ad-rveh-modal-title">Add Rental Vehicle</h2>
            <button onclick="document.getElementById('addVehicleModal').classList.add('ad-hidden')" class="ad-rveh-modal-close">
                <svg class="ad-rveh-modal-close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form action="<?php echo e(route('admin.rentals.vehicles.store')); ?>" method="POST" enctype="multipart/form-data" class="ad-rveh-modal-form">
            <?php echo csrf_field(); ?>
            <div class="ad-rveh-form-grid">
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Vehicle Name *</label>
                    <input type="text" name="vehicle_name" required class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Brand *</label>
                    <input type="text" name="brand" required class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Model *</label>
                    <input type="text" name="model" required class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Year *</label>
                    <input type="number" name="year" required min="1900" max="<?php echo e(date('Y')); ?>" class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Plate Number *</label>
                    <input type="text" name="plate_number" required class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Vehicle Type *</label>
                    <select name="vehicle_type" required class="ad-rveh-input">
                        <option value="Car">Car</option>
                        <option value="Bike">Bike</option>
                        <option value="SUV">SUV</option>
                    </select>
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Fuel Type *</label>
                    <select name="fuel_type" required class="ad-rveh-input">
                        <option value="Petrol">Petrol</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Electric">Electric</option>
                        <option value="Hybrid">Hybrid</option>
                    </select>
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Transmission *</label>
                    <select name="transmission_type" required class="ad-rveh-input">
                        <option value="Manual">Manual</option>
                        <option value="Automatic">Automatic</option>
                    </select>
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Daily Rate (Rs.) *</label>
                    <input type="number" name="daily_rate" required min="0" step="0.01" class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Security Deposit (Rs.)</label>
                    <input type="number" name="security_deposit" min="0" step="0.01" class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field ad-rveh-span-2">
                    <label class="ad-rveh-label">Rental Rules</label>
                    <textarea name="rental_rules" rows="3" class="ad-rveh-input"></textarea>
                </div>
                
                <div class="ad-rveh-field ad-rveh-span-2">
                    <label class="ad-rveh-label">Vehicle Image</label>
                    <input type="file" name="vehicle_image" accept="image/*" class="ad-rveh-input">
                </div>
            </div>
            
            <div class="ad-rveh-modal-actions">
                <button type="submit" class="ad-rveh-btn ad-rveh-btn-primary ad-rveh-btn-grow ad-rveh-btn-lg">
                    Add Vehicle
                </button>
                <button type="button" onclick="document.getElementById('addVehicleModal').classList.add('ad-hidden')" 
                        class="ad-rveh-btn ad-rveh-btn-ghost ad-rveh-btn-lg">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Vehicle Modal -->
<div id="editVehicleModal" class="ad-rveh-modal-overlay ad-hidden">
    <div class="ad-rveh-modal ad-rveh-modal-sm">
        <div class="ad-rveh-modal-head">
            <h2 class="ad-rveh-modal-title">Edit Vehicle</h2>
            <button onclick="document.getElementById('editVehicleModal').classList.add('ad-hidden')" class="ad-rveh-modal-close">
                <svg class="ad-rveh-modal-close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <form id="editVehicleForm" method="POST" class="ad-rveh-modal-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="ad-rveh-edit-stack">
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Vehicle Name *</label>
                    <input type="text" id="edit_vehicle_name" name="vehicle_name" required class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Daily Rate (Rs.) *</label>
                    <input type="number" id="edit_daily_rate" name="daily_rate" required min="0" step="0.01" class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-label">Security Deposit (Rs.)</label>
                    <input type="number" id="edit_security_deposit" name="security_deposit" min="0" step="0.01" class="ad-rveh-input">
                </div>
                
                <div class="ad-rveh-field">
                    <label class="ad-rveh-checkbox-label">
                        <input type="checkbox" id="edit_is_listed" name="is_listed_for_rent" value="1" class="ad-rveh-checkbox">
                        <span class="ad-rveh-checkbox-text">Available for Rent</span>
                    </label>
                </div>
            </div>
            
            <div class="ad-rveh-modal-actions">
                <button type="submit" class="ad-rveh-btn ad-rveh-btn-primary ad-rveh-btn-grow ad-rveh-btn-lg">
                    Update Vehicle
                </button>
                <button type="button" onclick="document.getElementById('editVehicleModal').classList.add('ad-hidden')" 
                        class="ad-rveh-btn ad-rveh-btn-ghost ad-rveh-btn-lg">
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
    document.getElementById('editVehicleModal').classList.remove('ad-hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/rentals/vehicles.blade.php ENDPATH**/ ?>