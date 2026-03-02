<?php $__env->startSection('title', 'Owner Earnings Dashboard - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="cs-page cs-owner-earnings-page min-h-screen bg-gray-50 pb-12">
    <main class="cs-owner-earnings-main max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="cs-owner-earnings-head flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6 mt-4">
            <div class="cs-owner-earnings-head-copy">
                <h1 class="cs-owner-earnings-title text-3xl font-bold text-gray-900">Owner Earnings Dashboard</h1>
                <p class="cs-owner-earnings-subtitle mt-2 text-lg text-gray-600">Track your rental income and request withdrawals.</p>
            </div>
        </div>

        
        <div class="cs-owner-stat-grid grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="cs-owner-stat-card cs-owner-stat-card-total bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl shadow-lg p-6">
                <div class="cs-owner-stat-head flex items-center justify-between mb-2">
                    <p class="cs-owner-stat-label text-sm font-medium opacity-90">Total Earned</p>
                    <svg class="cs-owner-stat-icon w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <p class="cs-owner-stat-value text-3xl font-bold">Rs. <?php echo e(number_format($summary->total_earned ?? 0, 2)); ?></p>
            </div>
            
            <div class="cs-owner-stat-card cs-owner-stat-card-commission bg-gradient-to-br from-orange-500 to-orange-600 text-white rounded-2xl shadow-lg p-6">
                <div class="cs-owner-stat-head flex items-center justify-between mb-2">
                    <p class="cs-owner-stat-label text-sm font-medium opacity-90">Commission Deducted</p>
                    <svg class="cs-owner-stat-icon w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                </div>
                <p class="cs-owner-stat-value text-3xl font-bold">Rs. <?php echo e(number_format($summary->commission_deducted ?? 0, 2)); ?></p>
            </div>
            
            <div class="cs-owner-stat-card cs-owner-stat-card-balance bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl shadow-lg p-6">
                <div class="cs-owner-stat-head flex items-center justify-between mb-2">
                    <p class="cs-owner-stat-label text-sm font-medium opacity-90">Withdrawable Balance</p>
                    <svg class="cs-owner-stat-icon w-8 h-8 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <p class="cs-owner-stat-value text-3xl font-bold">Rs. <?php echo e(number_format($summary->withdrawable_balance ?? 0, 2)); ?></p>
                <?php if(($summary->withdrawable_balance ?? 0) > 0): ?>
                    <button onclick="openWithdrawalModal()" class="cs-owner-withdraw-cta mt-4 w-full bg-white text-green-600 px-4 py-2 rounded-xl font-bold hover:bg-green-50 transition-all">
                        Request Withdrawal
                    </button>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="mb-6">
            <div class="cs-owner-tabs flex space-x-1 bg-white rounded-2xl p-2 shadow-sm border border-gray-100 w-fit">
                <button type="button" data-tab="earnings" class="cs-owner-tab-btn is-active px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Earnings History
                </button>
                <button type="button" data-tab="withdrawals" class="cs-owner-tab-btn text-gray-600 hover:text-gray-900 px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Withdrawal Requests
                </button>
                <button type="button" data-tab="rentals" class="cs-owner-tab-btn text-gray-600 hover:text-gray-900 px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-200">
                    Rental History
                </button>
            </div>

            
            <div class="cs-owner-tab-panel is-active mt-6" data-panel="earnings">
                <div class="cs-owner-table-card bg-white rounded-2xl shadow-sm overflow-hidden">
                    <table class="cs-owner-table min-w-full divide-y divide-gray-200">
                        <thead class="cs-owner-table-head bg-gray-50">
                            <tr>
                                <th class="cs-owner-table-th px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rental ID</th>
                                <th class="cs-owner-table-th px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner Amount</th>
                                <th class="cs-owner-table-th px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Commission</th>
                                <th class="cs-owner-table-th px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payout Status</th>
                            </tr>
                        </thead>
                        <tbody class="cs-owner-table-body bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $earnings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $earning): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="cs-owner-table-row hover:bg-gray-50">
                                    <td class="cs-owner-table-cell px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?php echo e($earning->rental_id); ?></td>
                                    <td class="cs-owner-table-cell cs-owner-table-cell-amount px-6 py-4 whitespace-nowrap text-sm text-green-600 font-bold">Rs. <?php echo e(number_format($earning->owner_amount, 2)); ?></td>
                                    <td class="cs-owner-table-cell cs-owner-table-cell-commission px-6 py-4 whitespace-nowrap text-sm text-orange-600">Rs. <?php echo e(number_format($earning->commission, 2)); ?></td>
                                    <td class="cs-owner-table-cell px-6 py-4 whitespace-nowrap">
                                        <span class="cs-owner-chip inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                            <?php echo e($earning->payout_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                                            <?php echo e(ucfirst($earning->payout_status)); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="cs-owner-empty px-6 py-12 text-center text-gray-500">
                                        <svg class="cs-owner-empty-icon mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
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

            
            <div class="cs-owner-tab-panel mt-6" data-panel="withdrawals">
                <div class="cs-owner-table-card bg-white rounded-2xl shadow-sm overflow-hidden">
                    <table class="cs-owner-table min-w-full divide-y divide-gray-200">
                        <thead class="cs-owner-table-head bg-gray-50">
                            <tr>
                                <th class="cs-owner-table-th px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request ID</th>
                                <th class="cs-owner-table-th px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="cs-owner-table-th px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="cs-owner-table-th px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requested</th>
                                <th class="cs-owner-table-th px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Processed</th>
                            </tr>
                        </thead>
                        <tbody class="cs-owner-table-body bg-white divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $withdrawalRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="cs-owner-table-row hover:bg-gray-50">
                                    <td class="cs-owner-table-cell px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?php echo e($request->id); ?></td>
                                    <td class="cs-owner-table-cell px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">Rs. <?php echo e(number_format($request->amount, 2)); ?></td>
                                    <td class="cs-owner-table-cell px-6 py-4 whitespace-nowrap">
                                        <span class="cs-owner-chip inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                            <?php if($request->status === 'paid'): ?> bg-green-100 text-green-800
                                            <?php elseif($request->status === 'approved'): ?> bg-blue-100 text-blue-800
                                            <?php elseif($request->status === 'rejected'): ?> bg-red-100 text-red-800
                                            <?php else: ?> bg-yellow-100 text-yellow-800
                                            <?php endif; ?>">
                                            <?php echo e(ucfirst($request->status)); ?>

                                        </span>
                                    </td>
                                    <td class="cs-owner-table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($request->requested_at->format('M d, Y')); ?></td>
                                    <td class="cs-owner-table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($request->processed_at ? $request->processed_at->format('M d, Y') : '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="cs-owner-empty px-6 py-12 text-center text-gray-500">
                                        <svg class="cs-owner-empty-icon mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                        No withdrawal requests yet.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <div class="cs-owner-tab-panel mt-6" data-panel="rentals">
                <div class="cs-owner-rentals-stack space-y-6">
                    
                    <?php if(isset($recentRentalRequests) && $recentRentalRequests->count() > 0): ?>
                        <div class="cs-owner-rentals-section">
                            <h3 class="cs-owner-rentals-title text-lg font-bold text-gray-800 mb-3">Recent Rental Requests</h3>
                            <div class="cs-owner-rentals-list space-y-3">
                                <?php $__currentLoopData = $recentRentalRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="cs-owner-rental-item bg-white rounded-xl border border-gray-100 p-4 hover:shadow-md transition">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="cs-owner-rental-item-head flex items-center gap-2 mb-2">
                                                    <h4 class="cs-owner-rental-item-title font-bold text-gray-900"><?php echo e($request->vehicle?->vehicle_name ?: ($request->vehicle?->brand . ' ' . $request->vehicle?->model)); ?></h4>
                                                    <span class="cs-owner-chip px-2 py-1 rounded-full text-xs font-bold
                                                        <?php if($request->status === 'Completed'): ?> bg-gray-200 text-gray-700
                                                        <?php elseif($request->status === 'In Use'): ?> bg-green-100 text-green-700
                                                        <?php else: ?> bg-blue-100 text-blue-700 <?php endif; ?>">
                                                        <?php echo e($request->status); ?>

                                                    </span>
                                                </div>
                                                <div class="cs-owner-rental-item-grid grid grid-cols-3 gap-3 text-sm">
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
                        <div class="cs-owner-rentals-section">
                            <h3 class="cs-owner-rentals-title text-lg font-bold text-gray-800 mb-3">Recent Marketplace Rentals</h3>
                            <div class="cs-owner-rentals-list space-y-3">
                                <?php $__currentLoopData = $recentMarketplaceRentals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="cs-owner-rental-item bg-white rounded-xl border border-gray-100 p-4 hover:shadow-md transition">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="cs-owner-rental-item-head flex items-center gap-2 mb-2">
                                                    <h4 class="cs-owner-rental-item-title font-bold text-gray-900"><?php echo e($rental->vehicle?->vehicle_name ?: ($rental->vehicle?->brand . ' ' . $rental->vehicle?->model)); ?></h4>
                                                    <span class="cs-owner-chip px-2 py-1 rounded-full text-xs font-bold
                                                        <?php if($rental->status === 'completed'): ?> bg-gray-200 text-gray-700
                                                        <?php elseif($rental->status === 'confirmed'): ?> bg-green-100 text-green-700
                                                        <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>">
                                                        <?php echo e(ucfirst($rental->status)); ?>

                                                    </span>
                                                </div>
                                                <div class="cs-owner-rental-item-grid cs-owner-rental-item-grid-marketplace grid grid-cols-4 gap-3 text-sm">
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
                        <div class="cs-owner-empty bg-white rounded-2xl border border-dashed border-gray-200 p-10 text-center">
                            <svg class="cs-owner-empty-icon mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            <h3 class="cs-owner-empty-title text-xl font-semibold text-gray-900">No rental history yet</h3>
                            <p class="cs-owner-empty-text text-gray-500 mt-2">Rental activity for your listed vehicles will appear here.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
</div>


<div id="withdrawal-modal-backdrop" class="cs-owner-modal-backdrop fixed inset-0 bg-black/50 z-[60] items-center justify-center p-4" style="display: none;">
    <div id="withdrawal-modal" class="cs-owner-modal bg-white rounded-3xl shadow-2xl max-w-md w-full transform scale-95 opacity-0 transition-all duration-300">
        <div class="cs-owner-modal-body p-8">
            <div class="cs-owner-modal-head flex items-center justify-between mb-6">
                <h2 class="cs-owner-modal-title text-2xl font-bold text-gray-900">Request Withdrawal</h2>
                <button onclick="closeWithdrawalModal()" class="cs-owner-modal-close p-2 rounded-lg hover:bg-gray-100 transition">
                    <svg class="cs-owner-modal-close-icon w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form action="<?php echo e(route('owner.withdrawals.request')); ?>" method="POST" class="cs-owner-modal-form space-y-6">
                <?php echo csrf_field(); ?>
                <div class="cs-owner-modal-section">
                    <label class="cs-owner-modal-label block text-sm font-bold text-gray-700 mb-2">Available Balance</label>
                    <div class="cs-owner-modal-balance bg-green-50 border border-green-200 rounded-xl p-4">
                        <p class="cs-owner-modal-balance-value text-2xl font-bold text-green-600">Rs. <?php echo e(number_format($summary->withdrawable_balance ?? 0, 2)); ?></p>
                    </div>
                </div>

                <div class="cs-owner-modal-section">
                    <label class="cs-owner-modal-label block text-sm font-bold text-gray-700 mb-2">Withdrawal Amount <span class="text-red-500">*</span></label>
                    <input type="number" name="amount" step="0.01" min="1" max="<?php echo e($summary->withdrawable_balance ?? 0); ?>" required 
                           class="cs-owner-modal-input block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200"
                           placeholder="Enter amount">
                    <p class="cs-owner-modal-help mt-1 text-xs text-gray-500">Maximum: Rs. <?php echo e(number_format($summary->withdrawable_balance ?? 0, 2)); ?></p>
                </div>

                <div class="cs-owner-modal-section">
                    <label class="cs-owner-modal-label block text-sm font-bold text-gray-700 mb-2">Note (Optional)</label>
                    <textarea name="note" rows="3" 
                              class="cs-owner-modal-input cs-owner-modal-textarea block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] transition duration-200"
                              placeholder="Add any note..."></textarea>
                </div>

                <div class="cs-owner-modal-actions flex gap-3">
                    <button type="button" onclick="closeWithdrawalModal()" 
                            class="cs-owner-modal-cancel flex-1 px-6 py-3 rounded-xl border border-gray-200 text-gray-700 font-bold hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="cs-owner-modal-submit flex-1 px-6 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition">
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
    backdrop.style.display = 'flex';
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
        backdrop.style.display = 'none';
    }, 300);
}

document.addEventListener('DOMContentLoaded', () => {
    const tabButtons = Array.from(document.querySelectorAll('.cs-owner-tab-btn'));
    const tabPanels = Array.from(document.querySelectorAll('.cs-owner-tab-panel'));

    const activateTab = (tab) => {
        tabButtons.forEach((button) => {
            const active = button.dataset.tab === tab;
            button.classList.toggle('is-active', active);
            button.classList.toggle('text-gray-600', !active);
            button.classList.toggle('hover:text-gray-900', !active);
        });

        tabPanels.forEach((panel) => {
            panel.classList.toggle('is-active', panel.dataset.panel === tab);
        });
    };

    tabButtons.forEach((button) => {
        button.addEventListener('click', () => activateTab(button.dataset.tab));
    });

    const activeDefault = tabButtons.find((button) => button.classList.contains('is-active'));
    activateTab(activeDefault?.dataset.tab ?? 'earnings');
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer-core', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\customer\owner-earnings-dashboard.blade.php ENDPATH**/ ?>