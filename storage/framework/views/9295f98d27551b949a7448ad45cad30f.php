

<?php $__env->startSection('title', 'My Vehicles - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.customer-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 mt-4">
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

        
        <?php if(session('success')): ?>
            <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center animate-fade-in">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col">
                <div class="p-6 flex-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-orange-50 rounded-2xl">
                            <svg class="w-8 h-8 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-2"></span>
                            Active
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Toyota Corolla</h3>
                    <p class="text-sm text-gray-500 mb-4">Executive • 2018</p>
                    
                    <div class="flex items-center text-xs font-mono bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg w-fit">
                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path>
                        </svg>
                        BA 2 PA 1234
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-50 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <button class="text-gray-400 hover:text-blue-600 transition" title="Edit Vehicle">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <button class="text-gray-400 hover:text-red-500 transition" title="Remove Vehicle">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                    <a href="<?php echo e(route('customer.requests.create')); ?>" class="text-sm font-bold text-[#ff5a1f] hover:text-[#e64b15] transition flex items-center">
                        Request Service
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>

            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col">
                <div class="p-6 flex-1">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-blue-50 rounded-2xl">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2"></span>
                            Under Service
                        </span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">Honda CR-V</h3>
                    <p class="text-sm text-gray-500 mb-4">Touring • 2021</p>
                    
                    <div class="flex items-center text-xs font-mono bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg w-fit">
                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path>
                        </svg>
                        BAG 5 CHA 5678
                    </div>
                </div>
                
                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-50 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <button class="text-gray-400 hover:text-blue-600 transition" title="Edit Vehicle">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <button class="text-gray-400 hover:text-red-500 transition" title="Remove Vehicle">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                    <span class="text-sm font-semibold text-blue-600 flex items-center">
                        <svg class="w-4 h-4 mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        In Progress
                    </span>
                </div>
            </div>

            
            <div id="empty-state" class="hidden col-span-full py-20 bg-white rounded-3xl border border-dashed border-gray-200 flex flex-col items-center justify-center text-center px-4">
                <div class="p-6 bg-orange-50 rounded-full mb-6">
                    <svg class="w-20 h-20 text-[#ff5a1f] opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">You haven’t added any vehicles yet</h3>
                <p class="text-gray-500 mb-8 max-w-sm">Register your cars here to enable fast service booking and track maintenance history.</p>
                <button onclick="openVehicleModal()" class="px-8 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition">
                    Add Your First Vehicle
                </button>
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

            <form action="#" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Brand / Name <span class="text-red-500">*</span></label>
                        <input type="text" name="brand" placeholder="e.g. Toyota Corolla" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
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
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Plate Number <span class="text-red-500">*</span></label>
                        <input type="text" name="plate" placeholder="e.g. BA 2 PA 1234" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] font-mono transition duration-200 uppercase">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Vehicle Type</label>
                        <select name="type" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="hatchback">Hatchback</option>
                            <option value="van">Van / Minibus</option>
                            <option value="bike">Motorbike</option>
                        </select>
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