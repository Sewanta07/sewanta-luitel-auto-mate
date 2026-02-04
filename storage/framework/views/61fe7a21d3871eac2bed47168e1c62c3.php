

<?php $__env->startSection('title', 'Service History - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="mb-8 mt-4">
            <h1 class="text-3xl font-bold text-gray-900">Service History</h1>
            <p class="mt-2 text-lg text-gray-600">View details of all your completed vehicle services.</p>
        </div>

        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                
                <div>
                    <label for="vehicle_filter" class="sr-only">Filter by Vehicle</label>
                    <select id="vehicle_filter" class="block w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition cursor-pointer">
                        <option value="all">All Vehicles</option>
                        <option value="1">Toyota Corolla (2018)</option>
                        <option value="2">Honda CR-V (2021)</option>
                    </select>
                </div>

                
                <div>
                    <label for="service_filter" class="sr-only">Filter by Service Type</label>
                    <select id="service_filter" class="block w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition cursor-pointer">
                        <option value="all">All Service Types</option>
                        <option value="general">General Service</option>
                        <option value="oil">Oil Change</option>
                        <option value="repair">Repair</option>
                    </select>
                </div>

                
                <div class="md:col-span-2 relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" placeholder="Search by details, mechanic, or invoice ID..." class="block w-full pl-10 pr-4 py-2.5 rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm transition">
                </div>
            </div>
        </div>

        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Service ID</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Vehicle</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Service Type</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Dates</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Mechanic</th>
                            <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-900">#SVC-9021</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Toyota Corolla</p>
                                    <p class="text-xs text-gray-500 font-mono">BA 2 PA 1234</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                    General Service
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-xs text-gray-500">Started: <span class="text-gray-700">Jan 10, 2026</span></p>
                                    <p class="text-xs text-gray-500">Ended: <span class="text-gray-900 font-medium">Jan 12, 2026</span></p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-6 w-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 mr-2">
                                        JD
                                    </div>
                                    <span class="text-sm text-gray-700">John Doe</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button class="text-gray-400 hover:text-gray-600 transition" title="View Invoice">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-11a4 4 0 00-4-4H7a4 4 0 00-4 4v12a4 4 0 004 4h6a4 4 0 004-4V5z"></path></svg>
                                </button>
                                <button onclick="openHistoryModal('modal-9021')" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-[#ff5a1f] text-[#ff5a1f] text-xs font-bold hover:bg-orange-50 transition">
                                    View Details
                                </button>
                            </td>
                        </tr>

                        
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-gray-900">#SVC-8842</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Honda CR-V</p>
                                    <p class="text-xs text-gray-500 font-mono">BAG 5 CHA 5678</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-50 text-purple-700">
                                    Brake Repair
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-xs text-gray-500">Started: <span class="text-gray-700">Dec 15, 2025</span></p>
                                    <p class="text-xs text-gray-500">Ended: <span class="text-gray-900 font-medium">Dec 15, 2025</span></p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-6 w-6 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-600 mr-2">
                                        MS
                                    </div>
                                    <span class="text-sm text-gray-700">Mike Smith</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button class="text-gray-400 hover:text-gray-600 transition" title="View Invoice">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-11a4 4 0 00-4-4H7a4 4 0 00-4 4v12a4 4 0 004 4h6a4 4 0 004-4V5z"></path></svg>
                                </button>
                                <button onclick="openHistoryModal('modal-8842')" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-[#ff5a1f] text-[#ff5a1f] text-xs font-bold hover:bg-orange-50 transition">
                                    View Details
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
            <div id="empty-history" class="hidden flex flex-col items-center justify-center py-20 px-4 text-center">
                <div class="p-4 bg-gray-50 rounded-full mb-4">
                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2-11a4 4 0 00-4-4H7a4 4 0 00-4 4v12a4 4 0 004 4h6a4 4 0 004-4V5z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">No service history available yet</h3>
                <p class="text-gray-500 mb-6">Completed services will appear here.</p>
                <a href="<?php echo e(route('customer.requests.create')); ?>" class="px-6 py-2 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition">
                    Request a Service
                </a>
            </div>
        </div>
    </main>
</div>


<div id="history-modal-backdrop" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[60] hidden flex items-center justify-center p-4">
    <div id="history-modal" class="bg-white rounded-3xl shadow-2xl max-w-3xl w-full max-h-[90vh] overflow-y-auto transform scale-95 opacity-0 transition-all duration-300">
        <div class="flex flex-col h-full">
            
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-gray-50 rounded-t-3xl">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Service #SVC-9021</h2>
                    <p class="text-sm text-gray-500">Completed on Jan 12, 2026</p>
                </div>
                <button onclick="closeHistoryModal()" class="p-2 rounded-lg hover:bg-gray-200 transition">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-6 sm:p-8 space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Vehicle</span>
                        <p class="text-lg font-bold text-gray-900">Toyota Corolla</p>
                        <p class="text-sm text-gray-600 font-mono">BA 2 PA 1234</p>
                        <p class="text-sm text-gray-500 mt-1">2018 Model</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-4">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Mechanic</span>
                        <div class="flex items-center mt-1">
                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=ff5a1f&color=fff" alt="Mechanic" class="w-10 h-10 rounded-full mr-3">
                            <div>
                                <p class="text-sm font-bold text-gray-900">John Doe</p>
                                <p class="text-xs text-gray-500">Senior Mechanic</p>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div>
                    <h3 class="text-sm font-bold text-gray-900 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Mechanic Notes
                    </h3>
                    <div class="bg-orange-50/50 border border-orange-100 rounded-xl p-4 text-sm text-gray-700 italic">
                        "Performed general service. Replaced engine oil and oil filter. Checked brake pads - rear pads have about 30% life remaining, suggest replacement next service. Topped up coolant and washer fluid."
                    </div>
                </div>

                
                <div>
                    <h3 class="text-sm font-bold text-gray-900 mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Service Breakdown & Parts
                    </h3>
                    <div class="border border-gray-100 rounded-xl overflow-hidden">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-50 text-gray-500 font-semibold border-b border-gray-100">
                                <tr>
                                    <th class="px-4 py-3">Description</th>
                                    <th class="px-4 py-3 text-center">Qty</th>
                                    <th class="px-4 py-3 text-right">Unit Price</th>
                                    <th class="px-4 py-3 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="px-4 py-3 text-gray-900">General Service Labor</td>
                                    <td class="px-4 py-3 text-center text-gray-500">2 hrs</td>
                                    <td class="px-4 py-3 text-right text-gray-500">$50.00</td>
                                    <td class="px-4 py-3 text-right text-gray-900 font-medium">$100.00</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 text-gray-900">Synthetic Engine Oil (5L)</td>
                                    <td class="px-4 py-3 text-center text-gray-500">1</td>
                                    <td class="px-4 py-3 text-right text-gray-500">$45.00</td>
                                    <td class="px-4 py-3 text-right text-gray-900 font-medium">$45.00</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 text-gray-900">Oil Filter</td>
                                    <td class="px-4 py-3 text-center text-gray-500">1</td>
                                    <td class="px-4 py-3 text-right text-gray-500">$12.00</td>
                                    <td class="px-4 py-3 text-right text-gray-900 font-medium">$12.00</td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-gray-50 font-bold text-gray-900">
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-right">Total Amount</td>
                                    <td class="px-4 py-3 text-right text-[#ff5a1f] text-lg">$157.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                
                <div class="bg-green-50 rounded-xl p-4 flex items-center justify-between border border-green-100">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-lg text-green-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-green-800">Payment Completed</p>
                            <p class="text-xs text-green-600">Paid via Credit Card on Jan 12</p>
                        </div>
                    </div>
                    <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition shadow-sm flex items-center">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Download Invoice
                    </button>
                </div>
            </div>
            
            <div class="p-4 bg-gray-50 border-t border-gray-100 rounded-b-3xl">
                <button onclick="closeHistoryModal()" class="w-full py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-gray-800 transition">
                    Close Details
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openHistoryModal(id) {
        const backdrop = document.getElementById('history-modal-backdrop');
        const modal = document.getElementById('history-modal');
        
        backdrop.classList.remove('hidden');
        backdrop.classList.add('flex');
        
        setTimeout(() => {
            modal.classList.remove('scale-95', 'opacity-0');
            modal.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeHistoryModal() {
        const backdrop = document.getElementById('history-modal-backdrop');
        const modal = document.getElementById('history-modal');
        
        modal.classList.remove('scale-100', 'opacity-100');
        modal.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            backdrop.classList.add('hidden');
            backdrop.classList.remove('flex');
        }, 300);
    }

    document.getElementById('history-modal-backdrop').addEventListener('click', function(e) {
        if (e.target === this) closeHistoryModal();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/history.blade.php ENDPATH**/ ?>