

<?php $__env->startSection('title', 'Customer Dashboard - AutoMate'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('components.customer-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gray-50">
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

            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <?php $__env->startComponent('customer.components.quick-action-card', ['title' => 'Request a Service', 'subtitle' => 'Book a new service for your vehicle', 'bgColor' => '#fff7ed', 'textColor' => '#ff5a1f']); ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a4 4 0 11-5.6 5.6L3 18l3 1 5.1-5.1a4 4 0 001.6-4.6l-2-4.1z"></path></svg>
                    <?php echo $__env->renderComponent(); ?>
                </div>

                <div>
                    <?php $__env->startComponent('customer.components.quick-action-card', ['title' => 'View My Requests', 'subtitle' => 'Check the status of existing requests', 'bgColor' => '#dbeafe', 'textColor' => '#2563eb']); ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 002-2V7a2 2 0 00-2-2h-3.5a1.5 1.5 0 01-3 0H7a2 2 0 00-2 2v3a2 2 0 002 2h2"></path></svg>
                    <?php echo $__env->renderComponent(); ?>
                </div>

                <div>
                    <?php $__env->startComponent('customer.components.quick-action-card', ['title' => 'Manage My Vehicles', 'subtitle' => 'Add or edit your vehicles', 'bgColor' => '#dbeafe', 'textColor' => '#2563eb']); ?>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l1-6h16l1 6M5 13v4a1 1 0 001 1h1a1 1 0 001-1v-1h8v1a1 1 0 001 1h1a1 1 0 001-1v-4"></path></svg>
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
            <div class="p-4 rounded-2xl bg-white shadow-sm">
                <div class="text-sm text-gray-500">Quick Links</div>
                <div class="mt-3 grid gap-2">
                    <a href="#" class="text-sm px-3 py-2 rounded-md hover:bg-gray-50">Request Service</a>
                    <a href="#" class="text-sm px-3 py-2 rounded-md hover:bg-gray-50">My Requests</a>
                    <a href="#" class="text-sm px-3 py-2 rounded-md hover:bg-gray-50">My Vehicles</a>
                </div>
            </div>

            <div class="p-4 rounded-2xl bg-white shadow-sm text-center">
                <div class="text-sm text-gray-500">Tips</div>
                <div class="mt-2 text-sm text-gray-700">Keep your vehicle documents up to date for faster processing.</div>
            </div>
        </aside>
    </main>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/dashboard/customer.blade.php ENDPATH**/ ?>