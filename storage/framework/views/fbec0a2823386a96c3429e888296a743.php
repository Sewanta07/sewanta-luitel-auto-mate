

<?php $__env->startSection('title', 'My Bookings - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 space-y-4 md:space-y-0">
            <div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tight">My <span class="text-[#ff5a1f]">Bookings</span></h1>
                <p class="text-gray-500 font-medium mt-2">Manage and track your vehicle service requests.</p>
            </div>
            <a href="<?php echo e(route('bookings.create')); ?>" class="inline-flex items-center px-8 py-4 bg-[#ff5a1f] text-white font-black rounded-2xl shadow-xl shadow-orange-100 hover:bg-[#e44d18] transform hover:-translate-y-1 transition-all duration-300 group">
                <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Book New Service
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="mb-8 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center text-green-700 font-bold animate-fade-in-down">
                <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <?php if($bookings->isEmpty()): ?>
                <div class="p-20 text-center">
                    <div class="w-24 h-24 bg-orange-50 rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v3a2 2 0 002 2h2"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-2">No bookings found</h3>
                    <p class="text-gray-500 font-medium mb-8">You haven't made any service bookings yet.</p>
                    <a href="<?php echo e(route('bookings.create')); ?>" class="text-[#ff5a1f] font-black hover:underline px-6 py-3 bg-orange-50 rounded-xl transition-all">Start by booking your first service →</a>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-50">
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Vehicle Details</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Service Type</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Preferred Date</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-2xl bg-gray-100 flex items-center justify-center mr-4 group-hover:bg-orange-100 group-hover:text-[#ff5a1f] transition-all">
                                                <?php if($booking->vehicle_type == 'Car'): ?>
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                                                <?php else: ?>
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h18M7 16h10a2 2 0 012 2v2a2 2 0 01-2 2H7a2 2 0 01-2-2v-2a2 2 0 012-2zM4 10h16M10 10V4h4v6"></path></svg>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <p class="font-black text-gray-900"><?php echo e($booking->vehicle_model); ?></p>
                                                <p class="text-xs font-bold text-gray-400 uppercase tracking-tighter"><?php echo e($booking->vehicle_number); ?> • <?php echo e($booking->vehicle_type); ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <p class="font-bold text-gray-700"><?php echo e($booking->service_type); ?></p>
                                    </td>
                                    <td class="px-8 py-6 text-gray-500 font-medium">
                                        <?php echo e(\Carbon\Carbon::parse($booking->preferred_date)->format('M d, Y')); ?>

                                    </td>
                                    <td class="px-8 py-6">
                                        <?php
                                            $statusColors = [
                                                'Pending' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
                                                'Assigned' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
                                                'In Progress' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
                                                'Completed' => ['bg' => 'bg-green-50', 'text' => 'text-green-600'],
                                            ];
                                            $colors = $statusColors[$booking->status] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-600'];
                                        ?>
                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest <?php echo e($colors['bg']); ?> <?php echo e($colors['text']); ?>">
                                            <span class="w-1.5 h-1.5 rounded-full mr-2 <?php echo e(str_replace('text', 'bg', $colors['text'])); ?>"></span>
                                            <?php echo e($booking->status); ?>

                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <button class="p-2 rounded-xl bg-gray-50 text-gray-400 hover:text-[#ff5a1f] hover:bg-orange-50 transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
@keyframes fade-in-down {
    0% { opacity: 0; transform: translateY(-10px); }
    100% { opacity: 1; transform: translateY(0); }
}
.animate-fade-in-down {
    animation: fade-in-down 0.5s ease-out;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/bookings/index.blade.php ENDPATH**/ ?>