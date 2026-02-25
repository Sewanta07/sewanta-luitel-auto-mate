<!-- Approve/Reject Booking Section for Admin -->
<div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 mb-6" x-data="{ showApprove: false, showReject: false }">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-black text-gray-900">Booking Actions</h3>
            <p class="text-sm text-gray-500 mt-1">Approve or reject this booking request</p>
        </div>
        <div class="flex gap-3">
            <button @click="showApprove = true" class="px-6 py-3 bg-green-500 text-white font-bold rounded-xl shadow-md hover:bg-green-600 transition">
                Approve Booking
            </button>
            <button @click="showReject = true" class="px-6 py-3 bg-red-500 text-white font-bold rounded-xl shadow-md hover:bg-red-600 transition">
                Reject Booking
            </button>
        </div>
    </div>

    <!-- Approve Modal -->
    <div x-show="showApprove" @click.away="showApprove = false" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div @click.stop class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 shadow-2xl">
            <h3 class="text-2xl font-black text-gray-900 mb-4">Approve Booking</h3>
            <form action="<?php echo e(route('admin.services.approve', $booking->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Assign Mechanic</label>
                    <select name="staff_id" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl text-sm font-bold focus:ring-2 focus:ring-green-100 outline-none" required>
                        <option value="">Select Mechanic</option>
                        <?php $__currentLoopData = $staffMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($staff->id); ?>"><?php echo e($staff->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-2">Estimated Cost (Rs.)</label>
                    <input type="number" name="estimated_cost" step="0.01" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl text-sm font-bold placeholder-gray-500 focus:ring-2 focus:ring-green-100 outline-none" placeholder="e.g. 5000">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-black text-gray-600 uppercase tracking-widest mb-2">Expected Completion Date</label>
                    <input type="date" name="expected_completion_date" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl text-sm font-bold text-gray-900 focus:ring-2 focus:ring-green-100 outline-none">
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="button" @click="showApprove = false" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Cancel</button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-green-500 text-white font-bold rounded-xl hover:bg-green-600 transition">Approve</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reject Modal -->
    <div x-show="showReject" @click.away="showReject = false" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div @click.stop class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 shadow-2xl">
            <h3 class="text-2xl font-black text-gray-900 mb-4">Reject Booking</h3>
            <form action="<?php echo e(route('admin.services.reject', $booking->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Rejection Reason</label>
                    <textarea name="rejection_reason" rows="4" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl text-sm font-medium focus:ring-2 focus:ring-red-100 outline-none resize-none" placeholder="Explain why this booking is rejected..." required></textarea>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="button" @click="showReject = false" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition">Cancel</button>
                    <button type="submit" class="flex-1 px-4 py-3 bg-red-500 text-white font-bold rounded-xl hover:bg-red-600 transition">Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\components\booking-actions.blade.php ENDPATH**/ ?>