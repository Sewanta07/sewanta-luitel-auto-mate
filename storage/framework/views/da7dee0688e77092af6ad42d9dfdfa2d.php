

<?php $__env->startSection('title', 'Book a Service - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        
        <a href="<?php echo e(route('bookings.index')); ?>" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-[#ff5a1f] transition-colors mb-6 group">
            <svg class="w-5 h-5 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            Back to My Bookings
        </a>

        
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Book <span class="text-[#ff5a1f]">Service</span></h1>
            <p class="text-gray-500 font-medium mt-2">Professional care for your vehicle.</p>
        </div>

        
        <div class="bg-white rounded-3xl shadow-xl p-6 sm:p-10 border border-gray-100">
            <form action="<?php echo e(route('bookings.store')); ?>" method="POST" class="space-y-8">
                <?php echo csrf_field(); ?>

                
                <div>
                    <label for="saved_vehicle" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Saved Vehicles (Optional)</label>
                    <select id="saved_vehicle" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none">
                        <option value="">Select from your saved vehicles</option>
                        <?php $__currentLoopData = $savedVehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($vehicle->vehicle_number); ?>">
                                <?php echo e($vehicle->vehicle_name ? $vehicle->vehicle_name . ' • ' : ''); ?><?php echo e($vehicle->vehicle_model); ?> (<?php echo e($vehicle->vehicle_number); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="mt-2 text-[10px] font-bold text-gray-400 ml-1 uppercase tracking-widest">You can also fill details below</p>
                </div>

                
                <?php if($preFilledVehicle): ?>
                    <div class="p-4 rounded-2xl bg-blue-50 border border-blue-100 flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-bold text-blue-900">Vehicle pre-filled</p>
                            <p class="text-xs text-blue-700 mt-1">The information for <strong><?php echo e($preFilledVehicle->brand); ?> <?php echo e($preFilledVehicle->model); ?></strong> (<?php echo e($preFilledVehicle->plate_number); ?>) has been automatically filled in the form below.</p>
                        </div>
                    </div>
                <?php endif; ?>
                
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label for="vehicle_model" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Vehicle Model</label>
                        <input type="text" name="vehicle_model" id="vehicle_model" list="nepal-vehicles" value="<?php echo e($preFilledVehicle ? $preFilledVehicle->model : old('vehicle_model')); ?>" 
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
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="vehicle_year" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Year <span class="text-red-500">*</span></label>
                        <input type="number" name="vehicle_year" id="vehicle_year" value="<?php echo e($preFilledVehicle ? $preFilledVehicle->year : old('vehicle_year')); ?>" min="1980" max="<?php echo e(now()->year); ?>"
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all <?php $__errorArgs = ['vehicle_year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="e.g. 2022" required>
                        <?php $__errorArgs = ['vehicle_year'];
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
                        <label for="vehicle_number" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">License Plate Number</label>
                        <input type="text" name="vehicle_number" id="vehicle_number" value="<?php echo e($preFilledVehicle ? $preFilledVehicle->plate_number : old('vehicle_number')); ?>" 
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
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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
                            <option value="Car" <?php echo e($preFilledVehicle && $preFilledVehicle->vehicle_type == 'Car' || old('vehicle_type') == 'Car' ? 'selected' : ''); ?>>Car</option>
                            <option value="SUV" <?php echo e($preFilledVehicle && $preFilledVehicle->vehicle_type == 'SUV' || old('vehicle_type') == 'SUV' ? 'selected' : ''); ?>>SUV</option>
                            <option value="Bike" <?php echo e($preFilledVehicle && $preFilledVehicle->vehicle_type == 'Bike' || old('vehicle_type') == 'Bike' ? 'selected' : ''); ?>>Bike</option>
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
                            <option value="Engine Repair" <?php echo e(old('service_type') == 'Engine Repair' ? 'selected' : ''); ?>>Engine Repair</option>
                            <option value="Brake Service" <?php echo e(old('service_type') == 'Brake Service' ? 'selected' : ''); ?>>Brake Service</option>
                            <option value="Oil Change" <?php echo e(old('service_type') == 'Oil Change' ? 'selected' : ''); ?>>Oil Change</option>
                            <option value="Electrical Repair" <?php echo e(old('service_type') == 'Electrical Repair' ? 'selected' : ''); ?>>Electrical Repair</option>
                            <option value="Inspection" <?php echo e(old('service_type') == 'Inspection' ? 'selected' : ''); ?>>Inspection</option>
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
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="preferred_date" class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Preferred Date</label>
                        <input type="date" name="preferred_date" id="preferred_date" value="<?php echo e(old('preferred_date', date('Y-m-d'))); ?>" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all <?php $__errorArgs = ['preferred_date'];
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
                        <label for="preferred_time_slot" class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Preferred Time Slot</label>
                        <select name="preferred_time_slot" id="preferred_time_slot" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-900 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none <?php $__errorArgs = ['preferred_time_slot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Select Slot</option>
                            <option value="Morning" <?php echo e(old('preferred_time_slot') == 'Morning' ? 'selected' : ''); ?>>Morning</option>
                            <option value="Afternoon" <?php echo e(old('preferred_time_slot') == 'Afternoon' ? 'selected' : ''); ?>>Afternoon</option>
                            <option value="Evening" <?php echo e(old('preferred_time_slot') == 'Evening' ? 'selected' : ''); ?>>Evening</option>
                        </select>
                        <?php $__errorArgs = ['preferred_time_slot'];
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
                        <label for="service_priority" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Priority</label>
                        <select name="service_priority" id="service_priority" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none <?php $__errorArgs = ['service_priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="Normal" <?php echo e(old('service_priority', 'Normal') == 'Normal' ? 'selected' : ''); ?>>Normal</option>
                            <option value="Urgent" <?php echo e(old('service_priority') == 'Urgent' ? 'selected' : ''); ?>>Urgent</option>
                        </select>
                        <?php $__errorArgs = ['service_priority'];
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
                        <label for="service_location_type" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Service Location</label>
                        <select name="service_location_type" id="service_location_type" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none <?php $__errorArgs = ['service_location_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Select Location</option>
                            <option value="Customer Address" <?php echo e(old('service_location_type') == 'Customer Address' ? 'selected' : ''); ?>>Customer Address</option>
                            <option value="Service Center Pickup" <?php echo e(old('service_location_type') == 'Service Center Pickup' ? 'selected' : ''); ?>>Service Center Pickup</option>
                        </select>
                        <?php $__errorArgs = ['service_location_type'];
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
                        <label for="location" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Customer Address</label>
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

                    <div>
                        <label for="phone_number" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Contact Phone</label>
                        <input type="text" name="phone_number" id="phone_number" value="<?php echo e(old('phone_number', auth()->user()->phone ?? '')); ?>" 
                               class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               placeholder="e.g. 98XXXXXXXX" required>
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="problem_description" class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-3 ml-1">Problem Description</label>
                        <textarea name="problem_description" id="problem_description" rows="4" 
                                  class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-medium placeholder-gray-500 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all resize-none <?php $__errorArgs = ['problem_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  placeholder="Describe any specific issues you've been having..." required><?php echo e(old('problem_description')); ?></textarea>
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

                    <div>
                        <label for="pickup_drop" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Pickup & Drop Service?</label>
                        <select name="pickup_drop" id="pickup_drop" 
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none <?php $__errorArgs = ['pickup_drop'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> ring-2 ring-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="0" <?php echo e(old('pickup_drop') == '0' ? 'selected' : ''); ?>>No</option>
                            <option value="1" <?php echo e(old('pickup_drop') == '1' ? 'selected' : ''); ?>>Yes</option>
                        </select>
                        <?php $__errorArgs = ['pickup_drop'];
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