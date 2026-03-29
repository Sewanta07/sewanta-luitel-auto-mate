<?php $__env->startSection('title', 'Vehicle Inspection'); ?>

<?php $__env->startSection('content'); ?>
<div class="sf-rins-page">
    <div class="sf-rins-main">
        <div class="sf-rins-head">
            <h1 class="sf-rins-title">Vehicle Inspection</h1>
            <p class="sf-rins-subtitle"><?php echo e($rental->status === 'Approved' ? 'Pre-Rental' : 'Post-Return'); ?> Inspection</p>
        </div>

    <div class="sf-rins-vehicle-card">
        <h2 class="sf-rins-card-title">Vehicle Information</h2>
        <div class="sf-rins-vehicle-grid">
            <div>
                <p class="sf-rins-kv-label">Vehicle</p>
                <p class="sf-rins-kv-value">
                    <?php echo e($rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model)); ?>

                </p>
            </div>
            <div>
                <p class="sf-rins-kv-label">Plate Number</p>
                <p class="sf-rins-kv-value"><?php echo e($rental->vehicle->plate_number); ?></p>
            </div>
            <div>
                <p class="sf-rins-kv-label">Renter</p>
                <p class="sf-rins-kv-value"><?php echo e($rental->renter->name); ?></p>
            </div>
            <div>
                <p class="sf-rins-kv-label">Rental Period</p>
                <p class="sf-rins-kv-value">
                    <?php echo e(\Carbon\Carbon::parse($rental->start_date)->format('M d')); ?> - 
                    <?php echo e(\Carbon\Carbon::parse($rental->end_date)->format('M d, Y')); ?>

                </p>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
    <div class="sf-rins-flash sf-rins-flash-success">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="sf-rins-flash sf-rins-flash-error">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <div class="sf-rins-form-card">
        <?php if($rental->status === 'Approved'): ?>
            <h2 class="sf-rins-card-title">Pre-Rental Inspection Checklist</h2>
            <form action="<?php echo e(route('staff.rentals.pre-inspection', $rental)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="sf-rins-form-stack">
                    <div>
                        <label class="sf-rins-label">Inspection Notes *</label>
                        <textarea name="pre_inspection_notes" required rows="6" 
                                  class="sf-rins-input sf-rins-textarea"
                                  placeholder="Document vehicle condition:&#10;- Body condition (scratches, dents)&#10;- Tire condition&#10;- Fluid levels&#10;- Interior condition&#10;- Cleanliness&#10;- Fuel level&#10;- Documents (registration, insurance)"></textarea>
                    </div>

                    <div>
                        <label class="sf-rins-label">Inspection Photos</label>
                        <input type="file" name="pre_inspection_images[]" multiple accept="image/*" 
                               class="sf-rins-input sf-rins-file-input">
                        <p class="sf-rins-help">Upload photos of vehicle condition (multiple files allowed)</p>
                    </div>

                    <div class="sf-rins-note sf-rins-note-blue">
                        <p class="sf-rins-note-text">
                            ✓ After submission, the vehicle will be marked as "Ready for Pickup" and the renter will be notified.
                        </p>
                    </div>

                    <div class="sf-rins-actions">
                        <button type="submit" class="sf-rins-btn sf-rins-btn-primary-blue">
                            Submit Pre-Inspection
                        </button>
                        <a href="<?php echo e(route('staff.rentals.index')); ?>" 
                           class="sf-rins-btn sf-rins-btn-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        <?php elseif($rental->status === 'In Use'): ?>
            <h2 class="sf-rins-card-title">Post-Return Inspection</h2>
            
            <?php if($rental->pre_inspection_notes): ?>
            <div class="sf-rins-precheck-box">
                <h3 class="sf-rins-precheck-title">Pre-Inspection Reference</h3>
                <p class="sf-rins-precheck-copy"><?php echo e($rental->pre_inspection_notes); ?></p>
            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('staff.rentals.post-inspection', $rental)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="sf-rins-form-stack">
                    <div>
                        <label class="sf-rins-label">Return Inspection Notes *</label>
                        <textarea name="post_inspection_notes" required rows="6" 
                                  class="sf-rins-input sf-rins-textarea"
                                  placeholder="Document vehicle condition on return:&#10;- Compare with pre-inspection condition&#10;- Note any new damage&#10;- Fuel level&#10;- Cleanliness&#10;- Mileage (if applicable)"></textarea>
                    </div>

                    <div>
                        <label class="sf-rins-check-label">
                            <input type="checkbox" name="has_damage" value="1" 
                                   onchange="document.getElementById('damageSection').classList.toggle('sf-hidden')"
                                   class="sf-rins-check-input">
                            <span class="sf-rins-check-text">Vehicle has damage</span>
                        </label>

                        <div id="damageSection" class="sf-hidden sf-rins-damage-section">
                            <div>
                                <label class="sf-rins-label">Damage Description *</label>
                                <textarea name="damage_description" rows="4" 
                                          class="sf-rins-input sf-rins-textarea sf-rins-textarea-danger"
                                          placeholder="Describe the damage in detail..."></textarea>
                            </div>
                            <div>
                                <label class="sf-rins-label">Estimated Damage Charge (Rs.)</label>
                                <input type="number" name="damage_charge" min="0" step="0.01" 
                                       class="sf-rins-input sf-rins-input-danger"
                                       placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="sf-rins-label">Return Inspection Photos</label>
                        <input type="file" name="post_inspection_images[]" multiple accept="image/*" 
                               class="sf-rins-input sf-rins-file-input">
                        <p class="sf-rins-help">Upload photos of vehicle condition on return</p>
                    </div>

                    <div class="sf-rins-note sf-rins-note-green">
                        <p class="sf-rins-note-text">
                            ✓ After submission, the rental will be marked as "Returned" and the renter will be notified.
                        </p>
                    </div>

                    <div class="sf-rins-actions">
                        <button type="submit" class="sf-rins-btn sf-rins-btn-primary-green">
                            Submit Return Inspection
                        </button>
                        <a href="<?php echo e(route('staff.rentals.index')); ?>" 
                           class="sf-rins-btn sf-rins-btn-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <p class="sf-rins-unavailable">Inspection not available for current status</p>
        <?php endif; ?>
    </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.staff', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/staff/rentals/inspection.blade.php ENDPATH**/ ?>