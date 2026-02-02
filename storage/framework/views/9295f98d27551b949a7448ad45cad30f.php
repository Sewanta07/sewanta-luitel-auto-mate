

<?php $__env->startSection('title', 'My Vehicles - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6 mt-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Vehicles</h1>
                <p class="mt-2 text-lg text-gray-600">Manage your registered vehicles for service and maintenance.</p>
            </div>
            <button onclick="openVehicleModal()" class="inline-flex items-center px-6 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Vehicle
            </button>
        </div>

        
        <div class="mb-6" x-data="{ activeTab: 'all' }">
            <div class="flex space-x-1 bg-white rounded-2xl p-2 shadow-sm border border-gray-100 w-fit">
                <button @click="activeTab = 'all'" 
                        :class="activeTab === 'all' ? 'bg-[#ff5a1f] text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    All Vehicles (<?php echo e($vehicles->count()); ?>)
                </button>
                <button @click="activeTab = 'listed'" 
                        :class="activeTab === 'listed' ? 'bg-[#ff5a1f] text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Listed for Rent (<?php echo e($vehicles->where('is_listed_for_rent', true)->count()); ?>)
                </button>
            </div>

            
            <div x-show="activeTab === 'all'" x-transition class="mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="all-vehicles-grid">
                    <?php echo $__env->make('customer.vehicles.partials.vehicle-cards', ['vehicles' => $vehicles, 'showAll' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            
            <div x-show="activeTab === 'listed'" x-transition class="mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php echo $__env->make('customer.vehicles.partials.vehicle-cards', ['vehicles' => $vehicles->where('is_listed_for_rent', true), 'showAll' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
    </main>
</div>


<div id="vehicle-modal-backdrop" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden flex items-center justify-center p-4">
    <div id="vehicle-modal" class="bg-white rounded-3xl shadow-2xl max-w-lg w-full transform scale-95 opacity-0 transition-all duration-300">
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between mb-8">
                <h2 id="modal-title" class="text-2xl font-bold text-gray-900">Add New Vehicle</h2>
                <button onclick="closeVehicleModal()" class="p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="<?php echo e(route('vehicles.store')); ?>" method="POST" class="space-y-6" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Name (Optional)</label>
                        <input type="text" name="vehicle_name" placeholder="e.g. Family Car" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Brand <span class="text-red-500">*</span></label>
                        <input type="text" name="brand" placeholder="e.g. Toyota" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Model <span class="text-red-500">*</span></label>
                        <input type="text" name="model" placeholder="e.g. Executive" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Mfg. Year <span class="text-red-500">*</span></label>
                        <input type="number" name="year" placeholder="2018" required min="1900" max="<?php echo e(date('Y')); ?>" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">License Plate Number <span class="text-red-500">*</span></label>
                        <input type="text" name="plate_number" placeholder="e.g. BA 2 PA 1234" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] font-mono transition duration-200 uppercase">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Type <span class="text-red-500">*</span></label>
                        <select name="vehicle_type" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="Car">Car</option>
                            <option value="SUV">SUV</option>
                            <option value="Bike">Bike</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Fuel Type <span class="text-red-500">*</span></label>
                        <select name="fuel_type" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electric">Electric</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Transmission <span class="text-red-500">*</span></label>
                        <select name="transmission_type" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Image (Optional)</label>
                        <input type="file" name="vehicle_image" accept="image/*" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Daily Rate (Optional)</label>
                        <input type="number" name="daily_rate" step="0.01" min="0" placeholder="e.g. 2500" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6">
                    <button type="button" onclick="closeVehicleModal()" class="w-full sm:w-auto px-6 py-3 rounded-xl border border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit" class="w-full sm:w-auto px-10 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition">
                        Save Vehicle
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openVehicleModal() {
        const backdrop = document.getElementById('vehicle-modal-backdrop');
        const modal = document.getElementById('vehicle-modal');
        
        backdrop.classList.remove('hidden');
        backdrop.classList.add('flex');
        
        setTimeout(() => {
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeVehicleModal() {
        const backdrop = document.getElementById('vehicle-modal-backdrop');
        const modal = document.getElementById('vehicle-modal');
        
        modal.classList.remove('scale-100', 'opacity-100');
        modal.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
        }, 300);
    }

    // Close on backdrop click
    document.getElementById('vehicle-modal-backdrop').addEventListener('click', function(e) {
        if (e.target === this) closeVehicleModal();
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/vehicles/index.blade.php ENDPATH**/ ?>