
<?php if(session('success')): ?>
    <div class="cs-vehicle-alert cs-vehicle-alert-success col-span-full mb-6 p-4 rounded-2xl bg-green-50 border border-green-100 text-green-800 flex items-center animate-fade-in">
        <svg class="cs-vehicle-alert-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="cs-vehicle-alert cs-vehicle-alert-error col-span-full mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 flex items-center animate-fade-in">
        <svg class="cs-vehicle-alert-icon w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div class="cs-vehicle-alert cs-vehicle-alert-error col-span-full mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 text-red-800 animate-fade-in">
        <p class="cs-vehicle-alert-title font-semibold mb-2">Could not save vehicle:</p>
        <ul class="cs-vehicle-alert-list list-disc pl-5 space-y-1 text-sm">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="cs-vehicle-alert-item"><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if($vehicles->count() > 0): ?>
    <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $status = $vehicle->currentStatus();
            $statusToneMap = [
                'blue' => 'cs-vehicle-tone-blue',
                'green' => 'cs-vehicle-tone-green',
                'purple' => 'cs-vehicle-tone-purple',
                'red' => 'cs-vehicle-tone-red',
            ];
            $statusToneClass = $statusToneMap[$status['badge_color']] ?? 'cs-vehicle-tone-green';
        ?>
        
        
        <div class="cs-vehicle-card bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300 flex flex-col">
            <div class="cs-vehicle-card-media relative h-44 bg-gray-100">
                <?php if($vehicle->image_path): ?>
                    <img src="<?php echo e(asset('storage/' . $vehicle->image_path)); ?>" alt="<?php echo e($vehicle->vehicle_name ?? $vehicle->brand); ?>" class="cs-vehicle-card-image w-full h-full object-cover">
                <?php else: ?>
                    <div class="cs-vehicle-card-image-empty w-full h-full flex items-center justify-center text-gray-400">
                        <svg class="cs-vehicle-card-image-empty-icon w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1"/></svg>
                    </div>
                <?php endif; ?>
                <span class="cs-vehicle-status-chip absolute top-3 right-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold <?php echo e($status['badge_bg']); ?> <?php echo e($status['badge_text']); ?> shadow-sm">
                    <span class="cs-vehicle-status-chip-dot w-1.5 h-1.5 rounded-full <?php echo e($status['dot_color']); ?> mr-2"></span>
                    <?php echo e($status['status']); ?>

                </span>
                <?php if($vehicle->is_listed_for_rent): ?>
                    <span class="cs-vehicle-rent-chip absolute top-3 left-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-800 shadow-sm">
                        <svg class="cs-vehicle-rent-chip-icon w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        For Rent
                    </span>
                <?php endif; ?>
            </div>
            <div class="cs-vehicle-card-body p-6 flex-1">
                <div class="cs-vehicle-card-summary flex items-start justify-between mb-4">
                    <div class="cs-vehicle-card-icon-wrap <?php echo e($statusToneClass); ?> p-3 rounded-2xl">
                        <svg class="cs-vehicle-card-icon w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0 a2 2 0 114 0"></path>
                        </svg>
                    </div>
                    <div class="cs-vehicle-card-type text-right">
                        <p class="cs-vehicle-card-type-main text-xs text-gray-500"><?php echo e($vehicle->vehicle_type ?? 'Vehicle'); ?></p>
                        <p class="cs-vehicle-card-type-sub text-xs text-gray-400"><?php echo e($vehicle->fuel_type ?? 'Fuel N/A'); ?> • <?php echo e($vehicle->transmission_type ?? 'Transmission N/A'); ?></p>
                    </div>
                </div>
                <h3 class="cs-vehicle-card-title text-xl font-bold text-gray-900 mb-1">
                    <?php echo e($vehicle->vehicle_name ?: ($vehicle->brand . ' ' . $vehicle->model)); ?>

                </h3>
                <p class="cs-vehicle-card-subtitle text-sm text-gray-500 mb-2"><?php echo e($vehicle->brand); ?> <?php echo e($vehicle->model); ?> • <?php echo e($vehicle->year); ?></p>
                
                <?php if($vehicle->daily_rate): ?>
                    <p class="cs-vehicle-card-rate text-sm text-[#ff5a1f] font-semibold mb-3">Rs. <?php echo e(number_format($vehicle->daily_rate, 2)); ?> / day</p>
                <?php endif; ?>
                
                <div class="cs-vehicle-card-plate flex items-center text-xs font-mono bg-gray-50 text-gray-600 px-3 py-1.5 rounded-lg w-fit">
                    <svg class="cs-vehicle-card-plate-icon w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"></path>
                    </svg>
                    <?php echo e($vehicle->plate_number); ?>

                </div>
            </div>
            
            <div class="cs-vehicle-card-actions px-6 py-4 bg-gray-50/50 border-t border-gray-50 space-y-3">
                <div class="cs-vehicle-card-actions-row flex items-center justify-between">
                    <div class="cs-vehicle-card-actions-left flex items-center space-x-3">
                        <a href="<?php echo e(route('vehicles.edit', $vehicle->id)); ?>" class="cs-vehicle-action-link cs-vehicle-action-edit text-gray-400 hover:text-blue-600 transition" title="Edit Vehicle">
                            <svg class="cs-vehicle-action-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="<?php echo e(route('vehicles.destroy', $vehicle->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to remove this vehicle?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="cs-vehicle-action-link cs-vehicle-action-remove text-gray-400 hover:text-red-500 transition" title="Remove Vehicle" <?php echo e($vehicle->rented_by_user_id ? 'disabled' : ''); ?>>
                                <svg class="cs-vehicle-action-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                    <a href="<?php echo e(route('bookings.create', ['vehicle_id' => $vehicle->id])); ?>" class="cs-vehicle-service-link text-sm font-bold text-[#ff5a1f] hover:text-[#e64b15] transition flex items-center">
                        Request Service
                        <svg class="cs-vehicle-service-link-icon w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
                <?php if($vehicle->rentalRequests && $vehicle->rentalRequests->count() > 0): ?>
                    <div class="cs-vehicle-pending-box bg-white rounded-xl border border-gray-100 p-3">
                        <p class="cs-vehicle-pending-title text-xs font-bold text-gray-600 mb-2">Pending Rent Requests</p>
                        <div class="cs-vehicle-pending-list space-y-2">
                            <?php $__currentLoopData = $vehicle->rentalRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="cs-vehicle-pending-item flex items-center justify-between">
                                    <span class="cs-vehicle-pending-id text-xs text-gray-600">Request #<?php echo e($request->id); ?></span>
                                    <div class="cs-vehicle-pending-actions flex items-center gap-2">
                                        <form action="<?php echo e(route('rentals.approve', $request->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="cs-vehicle-pending-btn cs-vehicle-pending-btn-approve px-2.5 py-1 text-xs font-bold rounded-lg bg-green-100 text-green-700 hover:bg-green-200">Approve</button>
                                        </form>
                                        <form action="<?php echo e(route('rentals.reject', $request->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="cs-vehicle-pending-btn cs-vehicle-pending-btn-reject px-2.5 py-1 text-xs font-bold rounded-lg bg-red-100 text-red-700 hover:bg-red-200">Reject</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <form action="<?php echo e(route('vehicles.toggle-rent', $vehicle->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="cs-vehicle-toggle-rent w-full px-4 py-2 rounded-xl text-sm font-bold transition <?php echo e($vehicle->is_listed_for_rent ? 'bg-purple-100 text-purple-700 hover:bg-purple-200' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'); ?>" <?php echo e($vehicle->rented_by_user_id ? 'disabled' : ''); ?>>
                        <?php echo e($vehicle->is_listed_for_rent ? 'Unlist from Rent' : 'List for Rent'); ?>

                    </button>
                </form>
                <?php if(!$vehicle->rented_by_user_id && $vehicle->daily_rate): ?>
                    <form action="<?php echo e(route('owner-vehicles.list')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="vehicle_id" value="<?php echo e($vehicle->id); ?>">
                        <input type="hidden" name="daily_rate" value="<?php echo e($vehicle->daily_rate); ?>">
                        <button type="submit" class="cs-vehicle-marketplace-btn w-full px-4 py-2 rounded-xl text-sm font-bold bg-orange-100 text-orange-700 hover:bg-orange-200 transition">
                            Submit to Marketplace Approval
                        </button>
                    </form>
                <?php endif; ?>
                <?php if($vehicle->rented_by_user_id && $vehicle->approvedRental): ?>
                    <form action="<?php echo e(route('rentals.return', $vehicle->approvedRental->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="cs-vehicle-return-btn w-full px-4 py-2 rounded-xl text-sm font-bold bg-red-100 text-red-700 hover:bg-red-200">
                            Mark as Returned
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <div class="cs-vehicle-empty col-span-full py-20 bg-white rounded-3xl border border-dashed border-gray-200 flex flex-col items-center justify-center text-center px-4">
        <div class="cs-vehicle-empty-icon-wrap p-6 bg-orange-50 rounded-full mb-6">
            <svg class="cs-vehicle-empty-icon w-20 h-20 text-[#ff5a1f] opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
            </svg>
        </div>
        <h3 class="cs-vehicle-empty-title text-2xl font-bold text-gray-900 mb-2"><?php echo e($showAll ? "You haven't added any vehicles yet" : "You haven't listed any vehicles for rent yet"); ?></h3>
        <p class="cs-vehicle-empty-text text-gray-500 mb-8 max-w-sm">
            <?php echo e($showAll ? "Register your cars here to enable fast service booking and track maintenance history." : "List your vehicles to earn money by renting them to other users."); ?>

        </p>
        <?php if($showAll): ?>
            <button onclick="openVehicleModal()" class="cs-vehicle-empty-cta px-8 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold shadow-lg shadow-orange-100 hover:bg-[#e64b15] transition">
                Add Your First Vehicle
            </button>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\vehicles\partials\vehicle-cards.blade.php ENDPATH**/ ?>