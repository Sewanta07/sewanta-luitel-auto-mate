

<?php $__env->startSection('title', 'Analytics'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
    
    <aside class="w-64 flex-shrink-0 z-30">
        <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    
    <div class="flex-1 flex flex-col overflow-y-auto sm:ml-64 bg-gray-50 h-full w-full">
        <main class="flex-1 max-w-7xl w-full mx-auto p-4 sm:p-6 lg:p-8">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 mt-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Analytics</h1>
                    <p class="mt-2 text-lg text-gray-600">Key metrics and trends across the platform.</p>
                </div>
                <div class="flex space-x-2 bg-white p-1 rounded-xl shadow-sm border border-gray-200">
                    <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition">7 Days</button>
                    <button class="px-4 py-2 text-sm font-bold text-[#ff5a1f] bg-orange-50 rounded-lg shadow-sm">30 Days</button>
                    <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition">90 Days</button>
                </div>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                 <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 min-h-[300px] flex flex-col items-center justify-center text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Revenue Growth</h3>
                    <p class="text-gray-500 text-sm mb-4">Monthly Revenue vs Expenses</p>
                    <div class="w-full h-40 bg-gradient-to-t from-orange-50 to-white border-b border-gray-200 flex items-end justify-around pb-2 px-4 gap-2">
                        <div class="w-1/6 bg-orange-200 rounded-t-lg h-[40%]"></div>
                        <div class="w-1/6 bg-orange-300 rounded-t-lg h-[60%]"></div>
                        <div class="w-1/6 bg-orange-400 rounded-t-lg h-[50%]"></div>
                        <div class="w-1/6 bg-orange-500 rounded-t-lg h-[75%]"></div>
                        <div class="w-1/6 bg-[#ff5a1f] rounded-t-lg h-[90%] shadow-lg shadow-orange-200"></div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 min-h-[300px] flex flex-col items-center justify-center text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Service Requests</h3>
                    <p class="text-gray-500 text-sm mb-4">Status Distribution</p>
                     <div class="relative w-40 h-40 rounded-full border-[12px] border-orange-100 flex items-center justify-center">
                        <div class="absolute inset-0 rounded-full border-[12px] border-[#ff5a1f] border-t-transparent border-l-transparent rotate-45"></div>
                         <div class="text-3xl font-bold text-gray-900">85%</div>
                     </div>
                     <p class="mt-4 text-sm text-gray-500">Completed on Time</p>
                </div>
            </div>

             <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 min-h-[200px] flex flex-col items-center justify-center text-center">
                <div class="text-gray-400 mb-4">
                    <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Advanced Reports</h3>
                <p class="text-gray-500">More detailed analytics report generation coming soon.</p>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/analytics.blade.php ENDPATH**/ ?>