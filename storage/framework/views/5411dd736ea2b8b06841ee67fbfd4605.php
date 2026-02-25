

<?php $__env->startSection('title', 'Rental Requests'); ?>

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
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Rental Requests Management</h1>
        <p class="text-gray-600">Approve requests and assign staff for vehicle handover</p>
    </div>

    <?php if(session('success')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <?php echo e(session('error')); ?>

    </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Renter</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dates</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Cost</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Damage</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Damage Payment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Staff</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?php echo e($rental->id); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <?php echo e($rental->vehicle->vehicle_name ?: ($rental->vehicle->brand . ' ' . $rental->vehicle->model)); ?>

                            <br>
                            <span class="text-xs text-gray-500"><?php echo e($rental->vehicle->plate_number); ?></span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <?php echo e($rental->renter->name); ?>

                            <br>
                            <span class="text-xs text-gray-500"><?php echo e($rental->renter->email); ?></span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?php if($rental->vehicle->is_service_center_vehicle): ?>
                                <span class="font-semibold text-blue-600">Service Center</span>
                            <?php else: ?>
                                <?php echo e($rental->owner->name ?? 'Customer'); ?>

                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <?php echo e(\Carbon\Carbon::parse($rental->start_date)->format('M d, Y')); ?>

                            <br>
                            <?php echo e(\Carbon\Carbon::parse($rental->end_date)->format('M d, Y')); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                            Rs. <?php echo e(number_format($rental->total_cost, 2)); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?php if($rental->has_damage): ?>
                                Rs. <?php echo e(number_format($rental->damage_charge ?? 0, 2)); ?>

                                <?php if($rental->damage_description): ?>
                                    <div class="text-xs text-gray-500 mt-1"><?php echo e($rental->damage_description); ?></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-gray-400">None</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                <?php if(($rental->damage_payment_status ?? 'Unpaid') === 'Paid'): ?> bg-green-100 text-green-800
                                <?php elseif(($rental->damage_payment_status ?? 'Unpaid') === 'Not Required'): ?> bg-gray-100 text-gray-700
                                <?php else: ?> bg-yellow-100 text-yellow-800 <?php endif; ?>">
                                <?php echo e($rental->damage_payment_status ?? 'Unpaid'); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php
                                $statusColors = [
                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                    'Approved' => 'bg-green-100 text-green-800',
                                    'Ready for Pickup' => 'bg-blue-100 text-blue-800',
                                    'Picked Up' => 'bg-indigo-100 text-indigo-800',
                                    'In Use' => 'bg-purple-100 text-purple-800',
                                    'Returned' => 'bg-gray-100 text-gray-800',
                                    'Completed' => 'bg-green-100 text-green-800',
                                    'Rejected' => 'bg-red-100 text-red-800',
                                ];
                            ?>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full <?php echo e($statusColors[$rental->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                <?php echo e($rental->status); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <?php if($rental->assignedStaff): ?>
                                <span class="text-gray-900"><?php echo e($rental->assignedStaff->name); ?></span>
                            <?php else: ?>
                                <button onclick="assignStaff(<?php echo e($rental->id); ?>)" 
                                        class="text-blue-600 hover:text-blue-800 text-xs font-semibold">
                                    Assign Staff
                                </button>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <?php if($rental->status === 'Pending'): ?>
                            <div class="flex gap-2">
                                <form action="<?php echo e(route('admin.rentals.requests.approve', $rental)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-semibold">
                                        Approve
                                    </button>
                                </form>
                                <button onclick="rejectRequest(<?php echo e($rental->id); ?>)" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold">
                                    Reject
                                </button>
                            </div>
                            <?php else: ?>
                                <span class="text-gray-400 text-xs"><?php echo e($rental->status); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="11" class="px-6 py-8 text-center text-gray-500">No rental requests found</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Assign Staff Modal -->
<div id="assignStaffModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg max-w-md w-full">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Assign Staff</h2>
        </div>
        
        <form id="assignStaffForm" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Select Staff Member *</label>
                <select name="staff_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Choose Staff --</option>
                    <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($member->id); ?>"><?php echo e($member->name); ?> - <?php echo e($member->position ?? 'Staff'); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Assign Staff
                </button>
                <button type="button" onclick="document.getElementById('assignStaffModal').classList.add('hidden')" 
                        class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg max-w-md w-full">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Reject Rental Request</h2>
        </div>
        
        <form id="rejectForm" method="POST" class="p-6">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Rejection Reason *</label>
                <textarea name="rejection_reason" required rows="4" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                          placeholder="Explain why this rental request is rejected..."></textarea>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Reject Request
                </button>
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" 
                        class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function assignStaff(rentalId) {
    document.getElementById('assignStaffForm').action = `/admin/rentals/requests/${rentalId}/assign-staff`;
    document.getElementById('assignStaffModal').classList.remove('hidden');
}

function rejectRequest(rentalId) {
    document.getElementById('rejectForm').action = `/admin/rentals/requests/${rentalId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\rentals\requests.blade.php ENDPATH**/ ?>