

<?php $__env->startSection('title', 'Customer Interaction - AutoMate'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50 pb-12">
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        
        <div class="sm:flex sm:items-center sm:justify-between mb-8 mt-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Customers</h1>
                <p class="mt-2 text-lg text-gray-600">Customers with bookings assigned to you (<?php echo e($customers->count()); ?> total)</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <div class="relative rounded-xl shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
                    </div>
                    <input type="text" name="search" id="customer-search" class="block w-full rounded-xl border border-gray-300 pl-10 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] sm:text-sm p-3" placeholder="Search customers...">
                </div>
            </div>
        </div>

        <?php if($customers->isEmpty()): ?>
            <div class="bg-white rounded-3xl border border-gray-100 p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">No customers yet</h3>
                <p class="text-gray-500">You'll see customers here once bookings are assigned to you.</p>
            </div>
        <?php else: ?>
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 xl:grid-cols-3" id="customer-list">
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $latestBooking = $customer->bookings->first();
                    $initials = strtoupper(substr($customer->name, 0, 2));
                    $colors = ['orange', 'purple', 'blue', 'green', 'pink', 'indigo'];
                    $color = $colors[ord($customer->name[0]) % count($colors)];
                ?>
                <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100 hover:shadow-md transition-shadow customer-card" data-customer-name="<?php echo e(strtolower($customer->name)); ?>">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-full bg-<?php echo e($color); ?>-100 flex items-center justify-center text-<?php echo e($color); ?>-600 font-bold text-lg">
                                    <?php echo e($initials); ?>

                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900"><?php echo e($customer->name); ?></h3>
                                    <?php if($latestBooking): ?>
                                        <p class="text-sm text-gray-500"><?php echo e($latestBooking->vehicle_model); ?> (<?php echo e($latestBooking->vehicle_number); ?>)</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if($latestBooking): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    <?php if($latestBooking->status == 'In Progress'): ?> bg-blue-100 text-blue-800
                                    <?php elseif($latestBooking->status == 'Completed'): ?> bg-green-100 text-green-800
                                    <?php elseif($latestBooking->status == 'Pending'): ?> bg-yellow-100 text-yellow-800
                                    <?php else: ?> bg-gray-100 text-gray-800
                                    <?php endif; ?>">
                                    <?php echo e($latestBooking->status); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase tracking-wide">Phone</span>
                                    <span class="block text-gray-900 font-medium"><?php echo e($customer->phone ?? 'N/A'); ?></span>
                                </div>
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase tracking-wide">Email</span>
                                    <span class="block text-gray-900 font-medium truncate" title="<?php echo e($customer->email); ?>"><?php echo e($customer->email); ?></span>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="block text-gray-500 text-xs uppercase tracking-wide mb-1">Bookings</span>
                                <span class="block text-gray-900 font-medium"><?php echo e($customer->bookings->count()); ?> service(s)</span>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="<?php echo e(route('staff.customers.messages', $customer->id)); ?>" class="w-full inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition-colors relative">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" /></svg>
                                Message
                                <?php if($customer->unread_count > 0): ?>
                                    <span class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"><?php echo e($customer->unread_count); ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </main>
</div>

<script>
    // Search functionality
    document.getElementById('customer-search')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const cards = document.querySelectorAll('.customer-card');
        
        cards.forEach(card => {
            const customerName = card.getAttribute('data-customer-name');
            if (customerName.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-full bg-orange-100 flex items-center justify-center text-[#ff5a1f] font-bold text-lg">
                                    JD
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">John Doe</h3>
                                    <p class="text-sm text-gray-500">Toyota Camry (ABC-1234)</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                In Service
                            </span>
                        </div>
                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase tracking-wide">Phone</span>
                                    <span class="block text-gray-900 font-medium">+1 (555) 123-4567</span>
                                </div>
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase tracking-wide">Email</span>
                                    <span class="block text-gray-900 font-medium truncate">john.doe@example.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex space-x-3">
                            <button type="button" class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-[#ff5a1f] hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                                Call
                            </button>
                            <button type="button" class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" /></svg>
                                Message
                            </button>
                        </div>
                    </div>
                </div>

                
                <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold text-lg">
                                    AS
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Alice Smith</h3>
                                    <p class="text-sm text-gray-500">Honda Civic (XYZ-9876)</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        </div>
                        <div class="mt-4 border-t border-gray-100 pt-4">
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase tracking-wide">Phone</span>
                                    <span class="block text-gray-900 font-medium">+1 (555) 987-6543</span>
                                </div>
                                <div>
                                    <span class="block text-gray-500 text-xs uppercase tracking-wide">Email</span>
                                    <span class="block text-gray-900 font-medium truncate">alice.smith@example.com</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex space-x-3">
                            <button type="button" class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-[#ff5a1f] hover:bg-[#e64b15] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" /></svg>
                                Call
                            </button>
                            <button type="button" class="flex-1 inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#ff5a1f] transition-colors">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" /></svg>
                                Message
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Interactions Panel -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden h-fit">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Recent Interactions</h3>
                </div>
                <div class="divide-y divide-gray-100">
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-green-100">
                                    <svg class="h-4 w-4 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">Called John Doe</p>
                                <p class="text-sm text-gray-500">Discussed additional brake repairs.</p>
                                <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 hover:bg-gray-50 transition-colors">
                        <div class="flex space-x-3">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100">
                                    <svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                                </span>
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900">SMS to Alice Smith</p>
                                <p class="text-sm text-gray-500">Service started notification sent.</p>
                                <p class="text-xs text-gray-400 mt-1">4 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <button class="w-full inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-[#ff5a1f] hover:text-[#e64b15] transition-colors">
                         View All History
                         <svg class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/staff/customers.blade.php ENDPATH**/ ?>