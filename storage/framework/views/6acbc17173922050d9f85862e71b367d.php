

<?php $__env->startSection('title', 'Request a Service - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Request a Service</h1>
            <p class="mt-2 text-lg text-gray-600">Fill in the details below and we’ll get back to you with available service slots.</p>
        </div>

        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="#" method="POST" class="p-6 sm:p-8 space-y-8">
                <?php echo csrf_field(); ?>

                
                <section>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-orange-50 rounded-lg">
                            <svg class="w-6 h-6 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Vehicle Information</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                        <div class="space-y-2">
                            <label for="vehicle_id" class="block text-sm font-medium text-gray-700">Select Vehicle <span class="text-red-500">*</span></label>
                            <select id="vehicle_id" name="vehicle_id" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                                <option value="" disabled selected>Choose your vehicle</option>
                                <option value="1">Toyota Corolla (2018) - BA 2 PA 1234</option>
                                <option value="2">Honda CR-V (2021) - BAG 5 CHA 5678</option>
                            </select>
                        </div>
                        <div class="pb-1">
                            <a href="<?php echo e(route('customer.vehicles')); ?>" class="inline-flex items-center text-sm font-medium text-[#ff5a1f] hover:text-[#e64b15] transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add New Vehicle
                            </a>
                        </div>
                    </div>
                </section>

                <hr class="border-gray-100">

                
                <section>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Service Details</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label for="service_type" class="block text-sm font-medium text-gray-700">Service Type <span class="text-red-500">*</span></label>
                            <select id="service_type" name="service_type" required class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                                <option value="" disabled selected>Select service</option>
                                <option value="general">General Service</option>
                                <option value="oil_change">Oil Change</option>
                                <option value="engine">Engine Repair</option>
                                <option value="brake">Brake Service</option>
                                <option value="battery">Battery Replacement</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="preferred_date" class="block text-sm font-medium text-gray-700">Preferred Date <span class="text-red-500">*</span></label>
                            <input type="date" id="preferred_date" name="preferred_date" required min="<?php echo e(date('Y-m-d')); ?>" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                        </div>
                        <div class="space-y-2">
                            <label for="time_slot" class="block text-sm font-medium text-gray-700">Time Slot</label>
                            <select id="time_slot" name="time_slot" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200">
                                <option value="morning">Morning (9 AM - 12 PM)</option>
                                <option value="afternoon">Afternoon (12 PM - 3 PM)</option>
                                <option value="evening">Evening (3 PM - 6 PM)</option>
                            </select>
                        </div>
                    </div>
                </section>

                <hr class="border-gray-100">

                
                <section>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="p-2 bg-green-50 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Pick-Up Required?</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="pickup_required" value="0" checked onclick="togglePickup(false)" class="w-4 h-4 text-[#ff5a1f] border-gray-300 focus:ring-[#ff5a1f]">
                                <span class="ml-2 text-gray-700 font-medium">No, I'll drop it off</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="pickup_required" value="1" onclick="togglePickup(true)" class="w-4 h-4 text-[#ff5a1f] border-gray-300 focus:ring-[#ff5a1f]">
                                <span class="ml-2 text-gray-700 font-medium">Yes, please pick it up</span>
                            </label>
                        </div>

                        <div id="pickup_address_container" class="hidden animate-fade-in">
                            <label for="pickup_address" class="block text-sm font-medium text-gray-700 mb-2">Pickup Address <span class="text-red-500">*</span></label>
                            <textarea id="pickup_address" name="pickup_address" rows="2" placeholder="Enter the full address for vehicle pickup" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200"></textarea>
                        </div>
                    </div>
                </section>

                <hr class="border-gray-100">

                
                <section class="space-y-4">
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="p-2 bg-purple-50 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900">Additional Notes</h2>
                    </div>
                    <textarea name="notes" rows="4" placeholder="Briefly describe any issues or special instructions (e.g., 'Squeaky brakes', 'Check tire pressure')" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200"></textarea>
                </section>

                <hr class="border-gray-100">

                
                <section class="bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-200">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Contact Confirmation</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-xs font-medium text-gray-400 block mb-1">Customer Name</label>
                            <p class="text-gray-900 font-medium"><?php echo e(auth()->user()->name ?? 'Alex Rider'); ?></p>
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-400 block mb-1">Phone Number</label>
                            <p class="text-gray-900 font-medium"><?php echo e(auth()->user()->phone ?? '+977 9800000000'); ?></p>
                        </div>
                    </div>
                    <p class="mt-4 text-xs text-gray-500 italic">We will use these details to contact you regarding your booking.</p>
                </section>

                
                <div class="flex flex-col sm:flex-row items-center justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-4">
                    <a href="<?php echo e(route('dashboard.customer')); ?>" class="w-full sm:w-auto px-6 py-3 rounded-xl border border-gray-200 text-gray-700 font-semibold hover:bg-gray-50 transition text-center">
                        Cancel
                    </a>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-200 hover:bg-[#e64b15] hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200">
                        Submit Service Request
                    </button>
                </div>
            </form>
        </div>

        
        <div id="success-mockup" class="hidden mt-8 p-6 bg-green-50 border border-green-100 rounded-2xl flex items-start space-x-4 animate-bounce-in">
            <div class="flex-shrink-0 w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-green-900">Request Submitted Successfully!</h3>
                <p class="text-green-700 mt-1">Your service request has been received. You can track your request status from <a href="<?php echo e(route('customer.requests.index')); ?>" class="font-semibold underline">My Requests</a>.</p>
            </div>
        </div>
    </main>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }
    .animate-bounce-in {
        animation: bounceIn 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards;
    }
    @keyframes bounceIn {
        0% { opacity: 0; transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }
</style>

<script>
    function togglePickup(show) {
        const container = document.getElementById('pickup_address_container');
        const addressInput = document.getElementById('pickup_address');
        
        if (show) {
            container.classList.remove('hidden');
            addressInput.setAttribute('required', 'required');
        } else {
            container.classList.add('hidden');
            addressInput.removeAttribute('required');
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/requests/create.blade.php ENDPATH**/ ?>