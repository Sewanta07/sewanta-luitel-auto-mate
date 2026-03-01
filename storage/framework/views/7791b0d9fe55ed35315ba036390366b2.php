

<?php $__env->startSection('title', 'Customer Dashboard - AutoMate'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50" x-data="{ supportModalOpen: false }">
    <main class="max-w-7xl mx-auto p-6 grid grid-cols-1 lg:grid-cols-4 gap-6">
        
        <section class="lg:col-span-3 space-y-6">
            
            <div class="p-6 rounded-2xl bg-white shadow-sm flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900">Welcome back 👋</h2>
                    <p class="text-sm text-gray-600 mt-1">Let's get your vehicle running smoothly — request a service when you're ready.</p>
                </div>
                <div class="hidden sm:flex items-center space-x-4">
                    <div class="text-sm text-gray-500">Member since</div>
                    <div class="text-sm font-medium text-gray-900"><?php echo e(\Carbon\Carbon::parse($user->created_at)->format('M Y')); ?></div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <?php echo $__env->make('customer.components.status-card', [
                    'title' => 'Pending Requests',
                    'count' => $stats['pending'],
                    'accent' => 'orange',
                    'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v3a2 2 0 002 2h2"></path></svg>'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php echo $__env->make('customer.components.status-card', [
                    'title' => 'In Progress',
                    'count' => $stats['in_progress'],
                    'accent' => 'blue',
                    'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l1-6h16l1 6M5 13v4a1 1 0 001 1h1a1 1 0 001-1v-1h8v1a1 1 0 001 1h1a1 1 0 001-1v-4"></path></svg>'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php echo $__env->make('customer.components.status-card', [
                    'title' => 'Completed Services',
                    'count' => $stats['completed'],
                    'accent' => 'green',
                    'icon' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>'
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>



            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="<?php echo e(route('bookings.create')); ?>" class="p-4 rounded-xl bg-white shadow-sm hover:shadow-md transition border-l-4 border-l-orange-500">
                    <div class="w-10 h-10 rounded-full mb-3 flex items-center justify-center bg-orange-50">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <p class="font-semibold text-gray-900 text-sm">Request Service</p>
                    <p class="text-xs text-gray-500 mt-1">Book a new appointment</p>
                </a>

                <a href="<?php echo e(route('bookings.index')); ?>" class="p-4 rounded-xl bg-white shadow-sm hover:shadow-md transition border-l-4 border-l-blue-600">
                    <div class="w-10 h-10 rounded-full mb-3 flex items-center justify-center bg-blue-50">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="font-semibold text-gray-900 text-sm">View Bookings</p>
                    <p class="text-xs text-gray-500 mt-1">All your service requests</p>
                </a>

                <a href="<?php echo e(route('bookings.index')); ?>" class="p-4 rounded-xl bg-white shadow-sm hover:shadow-md transition border-l-4 border-l-green-500">
                    <div class="w-10 h-10 rounded-full mb-3 flex items-center justify-center bg-green-50">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </div>
                    <p class="font-semibold text-gray-900 text-sm">Make Payment</p>
                    <p class="text-xs text-gray-500 mt-1">Pay outstanding invoices</p>
                </a>

                <a href="<?php echo e(route('customer.profile')); ?>" class="p-4 rounded-xl bg-white shadow-sm hover:shadow-md transition border-l-4 border-l-purple-600">
                    <div class="w-10 h-10 rounded-full mb-3 flex items-center justify-center bg-purple-50">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M12 15a3 3 0 100-6 3 3 0 000 6z"/></svg>
                    </div>
                    <p class="font-semibold text-gray-900 text-sm">My Profile</p>
                    <p class="text-xs text-gray-500 mt-1">Manage your account</p>
                </a>
            </div>

            
            <div class="p-6 rounded-2xl bg-white shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Service Progress</h3>
                
                <?php
                    // Get the most recent in-progress or pending booking
                    $activeBooking = $bookings->whereIn('status', ['Pending', 'Approved', 'Assigned', 'Customer Accepted', 'In Progress', 'Waiting for Parts'])->first();
                    
                    // Define progress stages
                    $stages = [
                        'Submitted' => ['Pending', 'Approved'],
                        'Assigned' => ['Assigned', 'Customer Accepted'],
                        'In Progress' => ['In Progress', 'Waiting for Parts'],
                        'Completed' => ['Completed']
                    ];
                    
                    // Determine current stage
                    $currentStage = 0;
                    if ($activeBooking) {
                        foreach ($stages as $index => $statuses) {
                            if (in_array($activeBooking->status, $statuses)) {
                                $currentStage = array_search($index, array_keys($stages)) + 1;
                                break;
                            }
                        }
                    }
                ?>
                
                <?php if($activeBooking): ?>
                    <div class="space-y-4">
                        
                        <div class="flex items-center justify-between">
                            <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage => $statuses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $stageIndex = array_search($stage, array_keys($stages)) + 1; ?>
                                <div class="flex flex-col items-center flex-1">
                                    
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center mb-2 transition-all font-bold text-sm
                                        <?php if($stageIndex <= $currentStage): ?>
                                            bg-[#ff5a1f] text-white shadow-lg
                                        <?php else: ?>
                                            bg-gray-200 text-gray-500
                                        <?php endif; ?>
                                    ">
                                        <?php if($stageIndex < $currentStage): ?>
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                        <?php else: ?>
                                            <?php echo e($stageIndex); ?>

                                        <?php endif; ?>
                                    </div>
                                    
                                    <p class="text-xs font-semibold text-center text-gray-900"><?php echo e($stage); ?></p>
                                </div>
                                
                                
                                <?php if($stageIndex < count($stages)): ?>
                                    <div class="flex-1 h-1 mx-2 mb-8 rounded-full transition-all
                                        <?php if($stageIndex < $currentStage): ?>
                                            bg-[#ff5a1f]
                                        <?php else: ?>
                                            bg-gray-200
                                        <?php endif; ?>
                                    "></div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        
                        <div class="mt-6 p-4 rounded-lg border-l-4 border-l-orange-500 bg-orange-50">
                            <p class="text-sm text-gray-600 font-medium">Current Status</p>
                            <p class="text-lg font-bold text-gray-900 mt-1"><?php echo e($activeBooking->status); ?></p>
                            <p class="text-xs text-gray-500 mt-2">Request <?php echo e($activeBooking->created_at->diffForHumans()); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <div class="w-16 h-16 rounded-full bg-gray-100 mx-auto mb-3 flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-gray-600 font-medium">No active services</p>
                        <p class="text-sm text-gray-500 mt-1">Your completed services will show here</p>
                        <a href="<?php echo e(route('bookings.create')); ?>" class="mt-4 inline-flex items-center px-4 py-2 text-white rounded-lg text-sm font-medium bg-[#ff5a1f] hover:bg-[#e64b15] transition-colors">Request a Service</a>
                    </div>
                <?php endif; ?>
            </div>

            
            <div>
                <?php if($recentBookings->count() > 0): ?>
                    <div class="p-6 rounded-2xl bg-white shadow-sm">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Bookings</h3>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $bookingToneMap = [
                                        'Completed' => ['icon' => 'bg-green-100 text-green-700', 'chip' => 'bg-green-100 text-green-700'],
                                        'In Progress' => ['icon' => 'bg-blue-100 text-blue-800', 'chip' => 'bg-blue-100 text-blue-800'],
                                    ];
                                    $bookingTone = $bookingToneMap[$booking->status] ?? ['icon' => 'bg-amber-100 text-amber-800', 'chip' => 'bg-amber-100 text-amber-800'];
                                ?>
                                <a href="<?php echo e(route('bookings.show', $booking->id)); ?>" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition-colors">
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold <?php echo e($bookingTone['icon']); ?>">
                                            <?php if($booking->status === 'Completed'): ?>
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                            <?php elseif($booking->status === 'In Progress'): ?>
                                                <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <?php else: ?>
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-gray-900 truncate"><?php echo e($booking->service_type ?? 'Service Request'); ?></p>
                                            <p class="text-xs text-gray-500"><?php echo e($booking->created_at->format('M d, Y')); ?></p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full <?php echo e($bookingTone['chip']); ?>">
                                        <?php echo e($booking->status); ?>

                                    </span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <a href="<?php echo e(route('bookings.index')); ?>" class="mt-4 text-sm text-[#ff5a1f] font-semibold hover:text-[#e44d18] block text-center">View All Bookings →</a>
                    </div>
                <?php else: ?>
                    <div class="p-10 rounded-2xl bg-white shadow-sm text-center">
                        <div class="mx-auto w-32 h-32 flex items-center justify-center rounded-full text-white mb-6 bg-[#ff5a1f]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a4 4 0 11-5.6 5.6L3 18l3 1 5.1-5.1a4 4 0 001.6-4.6l-2-4.1z"></path></svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">No service requests yet</h3>
                        <p class="text-sm text-gray-500 mt-2">You don't have any active service requests. When you need help, we are just a click away.</p>
                        <div class="mt-6">
                            <a href="<?php echo e(route('bookings.create')); ?>" class="inline-flex items-center px-4 py-2 text-white rounded-lg shadow transition bg-[#ff5a1f] hover:bg-[#e64b15]">Request Service</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        
        <aside class="space-y-4">
            
            <div class="p-6 rounded-2xl bg-gradient-to-br from-teal-500 to-teal-600 shadow-xl">
                <div class="flex items-start space-x-4">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-7 h-7 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-bold text-lg leading-tight mb-2 text-gray-900">Need Help?</h4>
                        <p class="text-sm text-gray-800 mb-4">Having issues or questions? Our support team is here to help.</p>
                        <button type="button" @click="supportModalOpen = true" class="w-full bg-white text-teal-600 font-bold py-3 px-4 rounded-xl hover:bg-teal-50 transition-all duration-300 flex items-center justify-center cursor-pointer">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Contact Support
                        </button>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    
    <template x-if="supportModalOpen">
        <div class="fixed inset-0 z-[9999] overflow-y-auto" @keydown.escape.window="supportModalOpen = false">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0" 
                     x-transition:enter-end="opacity-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100" 
                     x-transition:leave-end="opacity-0" 
                     class="fixed inset-0 transition-opacity bg-gray-900/40 cursor-pointer" 
                     @click.self="supportModalOpen = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-[2.5rem] shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-10 relative z-50">
                    
                    <div class="absolute top-0 right-0 pt-8 pr-8">
                        <button type="button" @click="supportModalOpen = false" class="p-2 rounded-xl bg-gray-100 text-gray-600 hover:text-gray-700 hover:bg-gray-200 transition-all cursor-pointer">
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
                                    <textarea name="message" rows="4" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-medium placeholder-gray-500 focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all resize-none" placeholder="Explain your request in detail..." required></textarea>
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
    </template>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const userId = <?php echo json_encode((int) $user->id, 15, 512) ?>;
        let reloadTimer = null;

        const scheduleReload = () => {
            if (reloadTimer) {
                return;
            }

            reloadTimer = setTimeout(() => {
                window.location.reload();
            }, 1200);
        };

        if (window.realtime) {
            window.realtime.subscribeDashboard('customer', userId, {
                serviceStatus: scheduleReload,
                rentalStatus: scheduleReload,
                paymentStatus: scheduleReload,
                earningsUpdated: scheduleReload,
                withdrawalUpdated: scheduleReload,
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/dashboard/customer.blade.php ENDPATH**/ ?>