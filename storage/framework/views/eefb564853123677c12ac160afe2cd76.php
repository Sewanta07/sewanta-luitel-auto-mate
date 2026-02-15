

<?php $__env->startSection('title', 'Edit Vehicle - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-3xl mx-auto p-4 sm:p-6 lg:p-8">
        <a href="<?php echo e(route('customer.vehicles')); ?>" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-[#ff5a1f] transition-colors mb-6">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Back to My Vehicles
        </a>

        <div class="bg-white rounded-[2rem] shadow-lg p-8 border border-gray-100">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Vehicle</h1>

            <form action="<?php echo e(route('vehicles.update', $vehicle->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Name (Optional)</label>
                        <input type="text" name="vehicle_name" value="<?php echo e(old('vehicle_name', $vehicle->vehicle_name)); ?>" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Brand <span class="text-red-500">*</span></label>
                        <input type="text" name="brand" value="<?php echo e(old('brand', $vehicle->brand)); ?>" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Model <span class="text-red-500">*</span></label>
                        <input type="text" name="model" value="<?php echo e(old('model', $vehicle->model)); ?>" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Mfg. Year <span class="text-red-500">*</span></label>
                        <input type="number" name="year" value="<?php echo e(old('year', $vehicle->year)); ?>" required min="1900" max="<?php echo e(date('Y')); ?>" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Type <span class="text-red-500">*</span></label>
                        <select name="vehicle_type" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="Car" <?php echo e(old('vehicle_type', $vehicle->vehicle_type) === 'Car' ? 'selected' : ''); ?>>Car</option>
                            <option value="SUV" <?php echo e(old('vehicle_type', $vehicle->vehicle_type) === 'SUV' ? 'selected' : ''); ?>>SUV</option>
                            <option value="Bike" <?php echo e(old('vehicle_type', $vehicle->vehicle_type) === 'Bike' ? 'selected' : ''); ?>>Bike</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Fuel Type <span class="text-red-500">*</span></label>
                        <select name="fuel_type" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="Petrol" <?php echo e(old('fuel_type', $vehicle->fuel_type) === 'Petrol' ? 'selected' : ''); ?>>Petrol</option>
                            <option value="Diesel" <?php echo e(old('fuel_type', $vehicle->fuel_type) === 'Diesel' ? 'selected' : ''); ?>>Diesel</option>
                            <option value="Electric" <?php echo e(old('fuel_type', $vehicle->fuel_type) === 'Electric' ? 'selected' : ''); ?>>Electric</option>
                            <option value="Hybrid" <?php echo e(old('fuel_type', $vehicle->fuel_type) === 'Hybrid' ? 'selected' : ''); ?>>Hybrid</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">License Plate Number <span class="text-red-500">*</span></label>
                        <input type="text" name="plate_number" value="<?php echo e(old('plate_number', $vehicle->plate_number)); ?>" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] font-mono transition duration-200 uppercase">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Transmission <span class="text-red-500">*</span></label>
                        <select name="transmission_type" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="Automatic" <?php echo e(old('transmission_type', $vehicle->transmission_type) === 'Automatic' ? 'selected' : ''); ?>>Automatic</option>
                            <option value="Manual" <?php echo e(old('transmission_type', $vehicle->transmission_type) === 'Manual' ? 'selected' : ''); ?>>Manual</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Image (Optional)</label>
                        <input type="file" name="vehicle_image" accept="image/*" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                        <?php if($vehicle->image_path): ?>
                            <p class="text-xs text-gray-500 mt-2">Current image is saved. Upload to replace.</p>
                        <?php endif; ?>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Daily Rate (Optional)</label>
                        <input type="number" name="daily_rate" step="0.01" min="0" value="<?php echo e(old('daily_rate', $vehicle->daily_rate)); ?>" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6">
                    <a href="<?php echo e(route('customer.vehicles')); ?>" class="w-full sm:w-auto px-6 py-3 rounded-xl border border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition text-center">
                        Cancel
                    </a>
                    <button type="submit" class="w-full sm:w-auto px-10 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/vehicles/edit.blade.php ENDPATH**/ ?>