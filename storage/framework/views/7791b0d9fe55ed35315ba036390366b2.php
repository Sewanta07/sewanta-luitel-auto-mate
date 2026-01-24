

<?php $__env->startSection('title', 'Customer Dashboard - AutoMate'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50" x-data="{ supportModalOpen: false }">
    <main class="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-4 gap-6">
        
        <section class="lg:col-span-3 space-y-6">
            
            <div class="p-6 rounded-2xl bg-white shadow-sm flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900">Welcome back 👋</h2>
                    <p class="text-sm text-gray-500 mt-1">Let's get your vehicle running smoothly — request a service when you're ready.</p>
                </div>
                <div class="hidden sm:flex items-center space-x-4">
                    <div class="text-sm text-gray-500">Member since</div>
                    <div class="text-sm font-medium text-gray-900">Jan 2026</div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <?php echo $__env->make('customer.components.status-card', [
                    'title' => 'Pending Requests',
                    'count' => '0',
                    'bgColor' => '#fff7ed',
                    'textColor' => '#ff5a1f',
                    'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v3a2 2 0 002 2h2"></path></svg>'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php echo $__env->make('customer.components.status-card', [
                    'title' => 'In Progress',
                    'count' => '0',
                    'bgColor' => '#dbeafe',
                    'textColor' => '#2563eb',
                    'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l1-6h16l1 6M5 13v4a1 1 0 001 1h1a1 1 0 001-1v-1h8v1a1 1 0 001 1h1a1 1 0 001-1v-4"></path></svg>'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php echo $__env->make('customer.components.status-card', [
                    'title' => 'Completed Services',
                    'count' => '0',
                    'bgColor' => '#f0fdf4',
                    'textColor' => '#10b981',
                    'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div>
                    <?php $__env->startComponent('customer.components.quick-action-card', ['title' => 'Request a Service', 'subtitle' => 'Book a new service for your vehicle', 'bgColor' => '#fff7ed', 'textColor' => '#ff5a1f']); ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a4 4 0 11-5.6 5.6L3 18l3 1 5.1-5.1a4 4 0 001.6-4.6l-2-4.1z"></path></svg>
                    <?php echo $__env->renderComponent(); ?>
                </div>

                <div>
                    <?php $__env->startComponent('customer.components.quick-action-card', ['title' => 'Rent a Car', 'subtitle' => 'Browse and book available vehicles', 'bgColor' => '#f0fdf4', 'textColor' => '#10b981']); ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l1-6h16l1 6M5 13v4a1 1 0 001 1h1a1 1 0 001-1v-1h8v1a1 1 0 001 1h1a1 1 0 001-1v-4"></path></svg>
                    <?php echo $__env->renderComponent(); ?>
                </div>

                <div>
                    <?php $__env->startComponent('customer.components.quick-action-card', ['title' => 'Payments', 'subtitle' => 'Pay for your service requests securely', 'bgColor' => '#eff6ff', 'textColor' => '#2563eb']); ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    <?php echo $__env->renderComponent(); ?>
                </div>

                <div>
                    <?php $__env->startComponent('customer.components.quick-action-card', ['title' => 'View My Requests', 'subtitle' => 'Check status of existing requests', 'bgColor' => '#f5f3ff', 'textColor' => '#7c3aed']); ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v3a2 2 0 002 2h2"></path></svg>
                    <?php echo $__env->renderComponent(); ?>
                </div>

                <div>
                    <?php $__env->startComponent('customer.components.quick-action-card', ['title' => 'Manage My Vehicles', 'subtitle' => 'Add or edit your vehicles', 'bgColor' => '#ecfeff', 'textColor' => '#0891b2']); ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                    <?php echo $__env->renderComponent(); ?>
                </div>

                <div>
                    <?php $__env->startComponent('customer.components.quick-action-card', ['title' => 'Service History', 'subtitle' => 'View previous services and payments', 'bgColor' => '#fff1f2', 'textColor' => '#e11d48']); ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M12 6a6 6 0 100 12 6 6 0 000-12z"></path></svg>
                    <?php echo $__env->renderComponent(); ?>
                </div>
            </div>

            
            <div>
                <?php echo $__env->make('customer.components.progress-tracker', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>

            
            <div>
                <?php echo $__env->make('customer.components.empty-state', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </section>

        
        <aside class="space-y-4">
            
            <div class="p-6 rounded-2xl bg-gradient-to-br from-[#ff5a1f] to-[#e44d18] shadow-xl text-white">
                <h3 class="text-xl font-black mb-6 flex items-center">
                    <span class="mr-2">🚀</span> Quick Access
                </h3>
                <div class="space-y-4">
                    <a href="<?php echo e(route('customer.payments')); ?>" class="flex items-center p-4 bg-white hover:bg-orange-50 rounded-2xl transition-all duration-300 group shadow-sm">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-black text-gray-900 text-lg leading-tight group-hover:text-[#ff5a1f] transition-colors">Payments</p>
                            <p class="text-sm text-gray-500 font-medium">Pay for services</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-[#ff5a1f] transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    
                    <a href="<?php echo e(route('customer.rentals')); ?>" class="flex items-center p-4 bg-white hover:bg-orange-50 rounded-2xl transition-all duration-300 group shadow-sm">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l1-6h16l1 6M5 13v4a1 1 0 001 1h1a1 1 0 001-1v-1h8v1a1 1 0 001 1h1a1 1 0 001-1v-4"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-black text-gray-900 text-lg leading-tight group-hover:text-[#ff5a1f] transition-colors">Rent a Car</p>
                            <p class="text-sm text-gray-500 font-medium">Browse vehicles</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-[#ff5a1f] transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    
                    <a href="<?php echo e(route('customer.payment-history')); ?>" class="flex items-center p-4 bg-white hover:bg-orange-50 rounded-2xl transition-all duration-300 group shadow-sm">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M12 6a6 6 0 100 12 6 6 0 000-12z"/></svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-black text-gray-900 text-lg leading-tight group-hover:text-[#ff5a1f] transition-colors">History</p>
                            <p class="text-sm text-gray-500 font-medium">View transactions</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-300 group-hover:text-[#ff5a1f] transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            
            <div class="p-4 rounded-2xl bg-gradient-to-br from-teal-50 to-blue-50 border border-teal-200 shadow-sm">
                <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-teal-500 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900">Need Help?</h4>
                        <p class="text-sm text-gray-600 mt-1">Contact our support center</p>
                        <button @click="supportModalOpen = true" class="mt-3 text-sm text-teal-600 font-semibold hover:text-teal-700">Contact Support →</button>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    
    <div x-show="supportModalOpen" 
         class="fixed inset-0 z-[100] overflow-y-auto" 
         x-cloak
         @keydown.escape.window="supportModalOpen = false">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="supportModalOpen" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="fixed inset-0 transition-opacity bg-gray-900/40 backdrop-blur-sm" 
                 @click="supportModalOpen = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="supportModalOpen" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-[2.5rem] shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-10">
                
                <div class="absolute top-0 right-0 pt-8 pr-8">
                    <button @click="supportModalOpen = false" class="p-2 rounded-xl bg-gray-50 text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="sm:flex sm:items-start">
                    <div class="w-full text-center sm:text-left">
                        <div class="w-16 h-16 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600 mb-6 mx-auto sm:mx-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <h3 class="text-3xl font-black text-gray-900 mb-2 leading-tight">Need Support?</h3>
                        <p class="text-gray-500 font-medium mb-8">Send us a direct message and our admin team will review it immediately.</p>

                        <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="space-y-6">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="name" value="<?php echo e(auth()->user()->name); ?>">
                            <input type="hidden" name="email" value="<?php echo e(auth()->user()->email); ?>">
                            
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">How can we help?</label>
                                <select name="subject" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none" required>
                                    <option value="Service Inquiry">Service Inquiry</option>
                                    <option value="Technical Issue">Technical Issue</option>
                                    <option value="Billing Question">Billing Question</option>
                                    <option value="General Feedback">General Feedback</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3 ml-1">Message Details</label>
                                <textarea name="message" rows="4" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-medium focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all resize-none" placeholder="Explain your request in detail..." required></textarea>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="w-full flex items-center justify-center px-8 py-5 bg-[#ff5a1f] text-white font-black rounded-2xl shadow-xl shadow-orange-100 hover:bg-[#e44d18] transform hover:-translate-y-1 transition-all">
                                    Send Message
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </button>
                                <p class="text-center text-[11px] text-gray-400 font-bold mt-4 tracking-tighter uppercase">Messages are logged and monitored by AutoMate Admin</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/dashboard/customer.blade.php ENDPATH**/ ?>