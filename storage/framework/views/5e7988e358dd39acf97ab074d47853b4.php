

<?php $__env->startSection('title', 'Staff Dashboard - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 mt-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Staff Portal</h1>
                <p class="mt-2 text-lg text-gray-600">Manage your service queue and update repair status.</p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 animate-pulse">
                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                    System Online
                </span>
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Service Queue</h3>
                <p class="text-sm text-gray-500 mb-6">12 Pending requests</p>
                <a href="<?php echo e(route('staff.bookings')); ?>" class="mt-auto text-sm font-bold text-[#ff5a1f] hover:text-[#e64b15] flex items-center transition">
                    View Queue <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Active Jobs</h3>
                <p class="text-sm text-gray-500 mb-6">4 Vehicles in bay</p>
                <a href="#" class="mt-auto text-sm font-bold text-[#ff5a1f] hover:text-[#e64b15] flex items-center transition">
                    Manage Active <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Inventory</h3>
                <p class="text-sm text-gray-500 mb-6">Check stock levels</p>
                <a href="<?php echo e(route('staff.inventory')); ?>" class="mt-auto text-sm font-bold text-[#ff5a1f] hover:text-[#e64b15] flex items-center transition">
                    View Inventory <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Reports</h3>
                <p class="text-sm text-gray-500 mb-6">Daily logs & stats</p>
                <a href="<?php echo e(route('staff.service.logs')); ?>" class="mt-auto text-sm font-bold text-[#ff5a1f] hover:text-[#e64b15] flex items-center transition">
                    View Reports <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>

        
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-900">Today's Schedule</h2>
                <span class="text-sm text-gray-500"><?php echo e(date('l, F j, Y')); ?></span>
            </div>
            <div class="divide-y divide-gray-100">
                
                <div class="p-6 hover:bg-gray-50 transition flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-start md:items-center gap-4">
                        <div class="px-4 py-2 bg-gray-100 rounded-xl text-center min-w-[5rem]">
                            <span class="block text-sm font-bold text-gray-900">09:00</span>
                            <span class="block text-xs text-gray-500 uppercase">AM</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Oil Change - Toyota Corolla</h3>
                            <p class="text-sm text-gray-500">Owner: John Doe • <span class="font-mono text-gray-400">#1234</span></p>
                        </div>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                            Pending
                        </span>
                    </div>
                </div>

                
                <div class="p-6 hover:bg-gray-50 transition flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-start md:items-center gap-4">
                        <div class="px-4 py-2 bg-blue-50 rounded-xl text-center min-w-[5rem]">
                            <span class="block text-sm font-bold text-blue-900">11:30</span>
                            <span class="block text-xs text-blue-500 uppercase">AM</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Brake Inspection - Honda CR-V</h3>
                            <p class="text-sm text-gray-500">Owner: Jane Smith • <span class="font-mono text-gray-400">#5678</span></p>
                        </div>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-2 animate-pulse"></span>
                            In Progress
                        </span>
                    </div>
                </div>

                
                 <div class="p-6 hover:bg-gray-50 transition flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-start md:items-center gap-4">
                        <div class="px-4 py-2 bg-gray-100 rounded-xl text-center min-w-[5rem]">
                            <span class="block text-sm font-bold text-gray-900">02:00</span>
                            <span class="block text-xs text-gray-500 uppercase">PM</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Tire Replacement - Ford F-150</h3>
                            <p class="text-sm text-gray-500">Owner: Bob Johnson • <span class="font-mono text-gray-400">#9012</span></p>
                        </div>
                    </div>
                    <div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600">
                            Scheduled
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 text-center">
                <a href="<?php echo e(route('staff.bookings')); ?>" class="text-sm font-bold text-gray-600 hover:text-[#ff5a1f] transition">View Full Schedule &rarr;</a>
            </div>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/dashboard/staff.blade.php ENDPATH**/ ?>