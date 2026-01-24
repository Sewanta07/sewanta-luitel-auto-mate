

<?php $__env->startSection('title', 'Book a Service - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        
        <a href="<?php echo e(route('bookings.index')); ?>" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-[#ff5a1f] transition-colors mb-6 group">
            <svg class="w-5 h-5 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Back to My Bookings
        </a>

        
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Book <span class="text-[#ff5a1f]">Service</span></h1>
            <p class="text-gray-500 font-medium mt-2">Professional care for your vehicle.</p>
        </div>

        
        <div class="bg-white rounded-[2.5rem] shadow-2xl p-8 sm:p-12 border border-gray-100">
            <form action="<?php echo e(route('bookings.store')); ?>" method="POST" class="space-y-8">
                <?php echo csrf_field(); ?>
                
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="vehicle_number" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Number</label>
                        <input type="text" name="vehicle_number" id="vehicle_number" value="<?php echo e(old('vehicle_number')); ?>" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all <?php $__errorArgs = ['vehicle_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="e.g. BA 1 PA 1234" required>
                        <?php $__errorArgs = ['vehicle_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="vehicle_type" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Type</label>
                        <select name="vehicle_type" id="vehicle_type" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none <?php $__errorArgs = ['vehicle_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Select Type</option>
                            <option value="Car" <?php echo e(old('vehicle_type') == 'Car' ? 'selected' : ''); ?>>Car</option>
                            <option value="Bike" <?php echo e(old('vehicle_type') == 'Bike' ? 'selected' : ''); ?>>Bike</option>
                        </select>
                        <?php $__errorArgs = ['vehicle_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="vehicle_model" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Model</label>
                        <input type="text" name="vehicle_model" id="vehicle_model" list="nepal-vehicles" value="<?php echo e(old('vehicle_model')); ?>" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all <?php $__errorArgs = ['vehicle_model'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="e.g. Scorpio, Pulsar" required>
                        <datalist id="nepal-vehicles">
                            <option value="Mahindra Scorpio">
                            <option value="Toyota Hilux">
                            <option value="Suzuki Swift">
                            <option value="Hyundai Creta">
                            <option value="Bajaj Pulsar 220">
                            <option value="TVS Apache RTR">
                            <option value="Yamaha FZ-S">
                            <option value="Honda Shine">
                            <option value="Royal Enfield Classic 350">
                            <option value="Kia Seltos">
                            <option value="Tata Nexon">
                        </datalist>
                        <?php $__errorArgs = ['vehicle_model'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="location" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Pick-up Location</label>
                        <input type="text" name="location" id="location" value="<?php echo e(old('location')); ?>" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="e.g. Kathmandu, Pokhara" required>
                        <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="service_type" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Type</label>
                        <select name="service_type" id="service_type" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none <?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Select Service</option>
                            <option value="General Service" <?php echo e(old('service_type') == 'General Service' ? 'selected' : ''); ?>>General Service</option>
                            <option value="Full Wash" <?php echo e(old('service_type') == 'Full Wash' ? 'selected' : ''); ?>>Full Wash & Shine</option>
                            <option value="Oil Change" <?php echo e(old('service_type') == 'Oil Change' ? 'selected' : ''); ?>>Oil Change</option>
                            <option value="Engine Tuning" <?php echo e(old('service_type') == 'Engine Tuning' ? 'selected' : ''); ?>>Engine Tuning</option>
                            <option value="Brake Inspection" <?php echo e(old('service_type') == 'Brake Inspection' ? 'selected' : ''); ?>>Brake Inspection & Repair</option>
                            <option value="Battery Check" <?php echo e(old('service_type') == 'Battery Check' ? 'selected' : ''); ?>>Battery Check & Replacement</option>
                            <option value="AC Service" <?php echo e(old('service_type') == 'AC Service' ? 'selected' : ''); ?>>AC Service & Gas Top-up</option>
                            <option value="Repair" <?php echo e(old('service_type') == 'Repair' ? 'selected' : ''); ?>>Other Repair</option>
                        </select>
                        <?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="phone_number" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Contact Phone (Optional)</label>
                        <input type="text" name="phone_number" id="phone_number" value="<?php echo e(old('phone_number', auth()->user()->phone ?? '')); ?>" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="e.g. 98XXXXXXXX">
                        <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-2 text-xs font-bold text-red-500 ml-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div>
                    <label for="preferred_date" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Preferred Date</label>
                    <input type="date" name="preferred_date" id="preferred_date" value="<?php echo e(old('preferred_date', date('Y-m-d'))); ?>" 
                           class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all <?php $__errorArgs = ['preferred_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <?php $__errorArgs = ['preferred_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-xs font-bold text-red-500 ml-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="problem_description" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Problem Description (Optional)</label>
                    <textarea name="problem_description" id="problem_description" rows="4" 
                              class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-medium focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all resize-none <?php $__errorArgs = ['problem_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                              placeholder="Describe any specific issues you've been having..."><?php echo e(old('problem_description')); ?></textarea>
                    <?php $__errorArgs = ['problem_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-xs font-bold text-red-500 ml-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full flex items-center justify-center px-8 py-5 bg-[#ff5a1f] text-white font-black rounded-2xl shadow-xl shadow-orange-100 hover:bg-[#e44d18] transform hover:-translate-y-1 transition-all duration-300">
                        Confirm Booking
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                    <p class="text-center text-[10px] text-gray-400 font-bold mt-6 tracking-widest uppercase">By booking, you agree to our terms of service</p>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/bookings/create.blade.php ENDPATH**/ ?>