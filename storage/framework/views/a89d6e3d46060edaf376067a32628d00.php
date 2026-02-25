<div class="hidden md:flex flex-col w-64 bg-white border-r border-gray-200 h-full fixed left-0 top-0 z-30">
    
    <div class="flex items-center justify-center h-16 border-b border-gray-100">
        <a href="<?php echo e(route('dashboard.admin')); ?>" class="flex items-center gap-2">
            <span class="text-2xl font-bold tracking-tight text-[#ff5a1f]">AutoMate</span>
            <span class="px-2 py-0.5 rounded text-xs font-bold bg-gray-900 text-white uppercase tracking-wider">Admin</span>
        </a>
    </div>

    
    <div class="flex-1 overflow-y-auto py-6 flex flex-col justify-between">
        <nav class="space-y-1 px-4">
            
            <a href="<?php echo e(route('dashboard.admin')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('dashboard.admin') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('dashboard.admin') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Overview
            </a>

            
            <a href="<?php echo e(route('admin.users')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('admin.users*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('admin.users*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Manage Users
            </a>

            
            <a href="<?php echo e(route('admin.staff-applications.index')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('admin.staff-applications*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('admin.staff-applications*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Staff Applications
            </a>

            
            <a href="<?php echo e(route('admin.analytics')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('admin.analytics*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('admin.analytics*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Analytics
            </a>

            
            <a href="<?php echo e(route('admin.contact-messages.index')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('admin.contact-messages*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('admin.contact-messages*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Contact Messages
                <?php
                    $newMessagesCount = \App\Models\ContactMessage::where('status', 'new')->count();
                ?>
                <?php if($newMessagesCount > 0): ?>
                    <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-[#ff5a1f] rounded-full">
                        <?php echo e($newMessagesCount); ?>

                    </span>
                <?php endif; ?>
            </a>

            
            <a href="<?php echo e(route('admin.services')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('admin.services*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('admin.services*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Services
            </a>

            
            <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('admin.rentals*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('admin.rentals*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Rentals
                <?php
                    $pendingRentalListings = \App\Models\Vehicle::where('listing_status', 'pending')->count();
                    $pendingRentalRequests = \App\Models\RentalRequest::where('status', 'Pending')->count();
                ?>
                <?php if($pendingRentalListings > 0 || $pendingRentalRequests > 0): ?>
                    <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-[#ff5a1f] rounded-full">
                        <?php echo e($pendingRentalListings + $pendingRentalRequests); ?>

                    </span>
                <?php endif; ?>
            </a>

            
            <?php if(request()->routeIs('admin.rentals*')): ?>
                <div class="ml-4 space-y-1 mt-1">
                    <a href="<?php echo e(route('admin.rentals.quick-approval')); ?>" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo e(request()->routeIs('admin.rentals.quick-approval') ? 'bg-orange-100 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-100'); ?> transition">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Quick Approval
                    </a>
                    <a href="<?php echo e(route('admin.rentals.dashboard')); ?>" class="flex items-center px-3 py-2 text-sm font-medium rounded-lg <?php echo e(request()->routeIs('admin.rentals.dashboard') ? 'bg-orange-100 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-100'); ?> transition">
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 16l4-4m0 0l4 4m-4-4v4"></path></svg>
                        Dashboard
                    </a>
                </div>
            <?php endif; ?>

            
            <a href="<?php echo e(route('admin.inventory.index')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('admin.inventory*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('admin.inventory*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Inventory
            </a>

            
            <a href="<?php echo e(route('admin.messages')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('admin.messages*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('admin.messages*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                Messages
            </a>


             
            <a href="<?php echo e(route('admin.settings')); ?>" class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition <?php echo e(request()->routeIs('admin.settings*') ? 'bg-orange-50 text-[#ff5a1f]' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'); ?>">
                <svg class="mr-3 h-5 w-5 <?php echo e(request()->routeIs('admin.settings*') ? 'text-[#ff5a1f]' : 'text-gray-400 group-hover:text-gray-500'); ?> transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Settings
            </a>
        </nav>

        
        <div class="p-4 border-t border-gray-100">
            <a href="<?php echo e(route('admin.profile')); ?>" class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 transition w-full">
                <div class="h-8 w-8 rounded-full bg-gray-900 text-white flex items-center justify-center font-bold text-xs ring-2 ring-gray-100">
                    A
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-900 truncate"><?php echo e(auth()->user()->name ?? 'Administrator'); ?></p>
                    <p class="text-xs text-gray-500 truncate">View Profile</p>
                </div>
            </a>
            
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-2">
                <?php echo csrf_field(); ?>
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>



<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\components\admin-sidebar.blade.php ENDPATH**/ ?>