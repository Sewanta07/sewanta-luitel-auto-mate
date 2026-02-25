

<?php $__env->startSection('title', 'Owner Earnings Dashboard - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6 mt-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Owner Earnings Dashboard</h1>
                <p class="mt-2 text-lg text-gray-600">Track your rental income and request withdrawals.</p>
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Total Earned</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="text-3xl font-bold">Rs. <?php echo e(number_format($summary->total_earned ?? 0, 2)); ?></p>
            </div>
            
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Commission Deducted</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <p class="text-3xl font-bold">Rs. <?php echo e(number_format($summary->commission_deducted ?? 0, 2)); ?></p>
            </div>
            
            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-sm font-medium opacity-90">Withdrawable Balance</p>
                    <svg class="w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <p class="text-3xl font-bold">Rs. <?php echo e(number_format($summary->withdrawable_balance ?? 0, 2)); ?></p>
                <?php if(($summary->withdrawable_balance ?? 0) > 0): ?>
                    <button onclick="openWithdrawalModal()" class="mt-4 w-full bg-white text-green-600 px-4 py-2 rounded-xl font-bold hover:bg-green-50 transition-all">
                        Request Withdrawal
                    </button>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="mb-6" x-data="{ activeTab: 'earnings' }">
            <div class="flex space-x-1 bg-white rounded-2xl p-2 shadow-sm border border-gray-100 w-fit">
                <button @click="activeTab = 'earnings'" 
                        :class="activeTab === 'earnings' ? 'bg-[#ff5a1f] text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Earnings History
                </button>
                <button @click="activeTab = 'withdrawals'" 
                        :class="activeTab === 'withdrawals' ? 'bg-[#ff5a1f] text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Withdrawal Requests
                </button>
                <button @click="activeTab = 'rentals'" 
                        :class="activeTab === 'rentals' ? 'bg-[#ff5a1f] text-white shadow-md' : 'text-gray-600 hover:text-gray-900'"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Rental History
                </button>
            </div>

            
            <div x-show="activeTab === 'earnings'" x-transition class="mt-6">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rental ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commission</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payout Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $earnings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $earning): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?php echo e($earning->rental_id); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-bold">Rs. <?php echo e(number_format($earning->owner_amount, 2)); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-orange-600">Rs. <?php echo e(number_format($earning->commission, 2)); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                            <?php echo e($earning->payout_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                            <?php echo e(ucfirst($earning->payout_status)); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        No earnings available.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php if($earnings->hasPages()): ?>
                        <div class="px-6 py-4 border-t border-gray-200">
                            <?php echo e($earnings->links()); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div x-show="activeTab === 'withdrawals'" x-transition class="mt-6">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Processed</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $withdrawalRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?php echo e($request->id); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">Rs. <?php echo e(number_format($request->amount, 2)); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                            <?php if($request->status === 'paid'): ?> bg-green-100 text-green-800
                                            <?php elseif($request->status === 'approved'): ?> bg-blue-100 text-blue-800
                                            <?php elseif($request->status === 'rejected'): ?> bg-red-100 text-red-800
                                            <?php else: ?> bg-yellow-100 text-yellow-800
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($request->status)); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($request->requested_at->format('M d, Y')); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($request->processed_at ? $request->processed_at->format('M d, Y') : '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        No withdrawal requests yet.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <div x-show="activeTab === 'rentals'" x-transition class="mt-6">
                <div class="space-y-6">
                    
                    <?php if(isset($recentRentalRequests) && $recentRentalRequests->count() > 0): ?>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-3">Recent Rental Requests</h3>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $recentRentalRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bg-white rounded-xl border border-gray-100 p-4 hover:shadow-md transition">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <h4 class="font-bold text-gray-900"><?php echo e($request->vehicle?->vehicle_name ?: ($request->vehicle?->brand . ' ' . $request->vehicle?->model)); ?></h4>
                                                    <span class="px-2 py-1 rounded-full text-xs font-bold
                                                        <?php if($request->status === 'Completed'): ?> bg-gray-200 text-gray-700
                                                        <?php elseif($request->status === 'In Use'): ?> bg-green-100 text-green-700
                                                        <?php else: ?> bg-blue-100 text-blue-700 <?php endif; ?>">
                                                        <?php echo e($request->status); ?>

                                                    </span>
                                                </div>
                                                <div class="grid grid-cols-3 gap-3 text-sm">
                                                    <div>
                                                        <p class="text-xs text-gray-500">Renter</p>
                                                        <p class="font-bold text-gray-900"><?php echo e($request->renter?->name ?? 'N/A'); ?></p>
                                                    </div>
                                                    <div>
                                                        <p class="text-xs text-gray-500">Duration</p>
                                                        <p class="font-bold text-gray-900"><?php echo e($request->number_of_days ?? 0); ?> days</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-xs text-gray-500">Amount</p>
                                                        <p class="font-bold text-orange-600">Rs. <?php echo e(number_format($request->total_cost ?? 0, 2)); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    
                    <?php if(isset($recentMarketplaceRentals) && $recentMarketplaceRentals->count() > 0): ?>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-3">Recent Marketplace Rentals</h3>
                            <div class="space-y-3">
                                <?php $__currentLoopData = $recentMarketplaceRentals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bg-white rounded-xl border border-gray-100 p-4 hover:shadow-md transition">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <h4 class="font-bold text-gray-900"><?php echo e($rental->vehicle?->vehicle_name ?: ($rental->vehicle?->brand . ' ' . $rental->vehicle?->model)); ?></h4>
                                                    <span class="px-2 py-1 rounded-full text-xs font-bold
                                                        <?php if($rental->status === 'completed'): ?> bg-gray-200 text-gray-700
                                                        <?php elseif($rental->status === 'confirmed'): ?> bg-green-100 text-green-700
                                                        <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>">
                                                        <?php echo e(ucfirst($rental->status)); ?>

                                                    </span>
                                                </div>
                                                <div class="grid grid-cols-4 gap-3 text-sm">
                                                    <div>
                                                        <p class="text-xs text-gray-500">Renter</p>
                                                        <p class="font-bold text-gray-900"><?php echo e($rental->renter?->name ?? 'N/A'); ?></p>
                                                    </div>
                                                    <div>
                                                        <p class="text-xs text-gray-500">Duration</p>
                                                        <p class="font-bold text-gray-900"><?php echo e($rental->number_of_days ?? 0); ?> days</p>
                                                    </div>
                                                    <div>
                                                        <p class="text-xs text-gray-500">Owner Earning</p>
                                                        <p class="font-bold text-green-600">Rs. <?php echo e(number_format($rental->owner_earning ?? 0, 2)); ?></p>
                                                    </div>
                                                    <div>
                                                        <p class="text-xs text-gray-500">Commission</p>
                                                        <p class="font-bold text-orange-600">Rs. <?php echo e(number_format($rental->commission_amount ?? 0, 2)); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if((!isset($recentRentalRequests) || $recentRentalRequests->count() === 0) && (!isset($recentMarketplaceRentals) || $recentMarketplaceRentals->count() === 0)): ?>
                        <div class="bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            <h3 class="text-xl font-semibold text-gray-900">No rental history yet</h3>
                            <p class="text-gray-500 mt-2">Rental activity for your listed vehicles will appear here.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>


<div id="withdrawal-modal-backdrop" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden flex items-center justify-center p-4">
    <div id="withdrawal-modal" class="bg-white rounded-3xl shadow-2xl max-w-md w-full transform scale-95 opacity-0 transition-all duration-300">
        <div class="p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Request Withdrawal</h2>
                <button onclick="closeWithdrawalModal()" class="p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="<?php echo e(route('owner.withdrawals.request')); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Available Balance</label>
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                        <p class="text-2xl font-bold text-green-600">Rs. <?php echo e(number_format($summary->withdrawable_balance ?? 0, 2)); ?></p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Withdrawal Amount <span class="text-red-500">*</span></label>
                    <input type="number" name="amount" step="0.01" min="1" max="<?php echo e($summary->withdrawable_balance ?? 0); ?>" required 
                           class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200"
                           placeholder="Enter amount">
                    <p class="mt-1 text-xs text-gray-500">Maximum: Rs. <?php echo e(number_format($summary->withdrawable_balance ?? 0, 2)); ?></p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Note (Optional)</label>
                    <textarea name="note" rows="3" 
                              class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200"
                              placeholder="Add any note..."></textarea>
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeWithdrawalModal()" 
                            class="flex-1 px-6 py-3 rounded-xl border border-gray-200 text-gray-700 font-bold hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openWithdrawalModal() {
    const backdrop = document.getElementById('withdrawal-modal-backdrop');
    const modal = document.getElementById('withdrawal-modal');
    backdrop.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.remove('scale-95', 'opacity-0');
        modal.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeWithdrawalModal() {
    const backdrop = document.getElementById('withdrawal-modal-backdrop');
    const modal = document.getElementById('withdrawal-modal');
    modal.classList.remove('scale-100', 'opacity-100');
    modal.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        backdrop.classList.add('hidden');
    }, 300);
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\owner-earnings-dashboard.blade.php ENDPATH**/ ?>