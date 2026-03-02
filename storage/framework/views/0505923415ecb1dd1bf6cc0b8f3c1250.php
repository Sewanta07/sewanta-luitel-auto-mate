<?php $__env->startSection('title', 'View Message - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
    
    <aside class="w-64 flex-shrink-0 z-30">
        <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </aside>

    
    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50">
        <main class="flex-1 max-w-4xl w-full mx-auto p-4 sm:p-6 lg:p-8">
            
            <div class="mb-8 mt-4">
                <div class="flex items-center text-sm text-gray-500 mb-2">
                    <a href="<?php echo e(route('admin.contact-messages.index')); ?>" class="hover:text-[#ff5a1f] transition-colors">Contact Messages</a>
                    <svg class="h-4 w-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
                    <span>Message Details</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900"><?php echo e($message->subject); ?></h1>
            </div>

            
            <?php if(session('success')): ?>
                <div class="mb-6 rounded-xl bg-green-50 p-4 border border-green-100">
                    <div class="flex">
                        <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="ml-3 text-sm font-medium text-green-800"><?php echo e(session('success')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 rounded-full bg-[#ff5a1f] flex items-center justify-center text-white text-lg font-bold">
                                <?php echo e(strtoupper(substr($message->name, 0, 1))); ?>

                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900"><?php echo e($message->name); ?></h3>
                                <p class="text-sm text-gray-500"><?php echo e($message->email); ?></p>
                            </div>
                        </div>
                        <div class="text-right">
                            <?php if($message->status === 'new'): ?>
                                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-sm font-medium text-orange-800">
                                    New
                                </span>
                            <?php elseif($message->status === 'read'): ?>
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-800">
                                    Read
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800">
                                    Replied
                                </span>
                            <?php endif; ?>
                            <p class="text-xs text-gray-500 mt-1"><?php echo e($message->created_at->format('M d, Y h:i A')); ?></p>
                        </div>
                    </div>
                </div>

                
                <div class="px-6 py-8">
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Subject</h4>
                        <p class="text-lg font-medium text-gray-900"><?php echo e($message->subject); ?></p>
                    </div>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Message</h4>
                        <div class="prose max-w-none">
                            <p class="text-gray-700 whitespace-pre-wrap"><?php echo e($message->message); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
                <div class="flex flex-wrap gap-3">
                    
                    <form action="<?php echo e(route('admin.contact-messages.updateStatus', $message->id)); ?>" method="POST" class="inline-flex">
                        <?php echo csrf_field(); ?>
                        <select name="status" onchange="this.form.submit()" class="rounded-xl border-gray-200 focus:border-[#ff5a1f] focus:ring-[#ff5a1f] text-sm">
                            <option value="new" <?php echo e($message->status === 'new' ? 'selected' : ''); ?>>Mark as New</option>
                            <option value="read" <?php echo e($message->status === 'read' ? 'selected' : ''); ?>>Mark as Read</option>
                            <option value="replied" <?php echo e($message->status === 'replied' ? 'selected' : ''); ?>>Mark as Replied</option>
                        </select>
                    </form>

                    
                    <a href="mailto:<?php echo e($message->email); ?>?subject=Re: <?php echo e($message->subject); ?>" class="inline-flex items-center px-4 py-2 rounded-xl bg-[#ff5a1f] text-white font-semibold hover:bg-[#e64b15] transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Reply via Email
                    </a>

                    
                    <form action="<?php echo e(route('admin.contact-messages.destroy', $message->id)); ?>" method="POST" class="inline-flex" onsubmit="return confirm('Are you sure you want to delete this message?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-xl bg-red-50 text-red-700 font-semibold hover:bg-red-100 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Message
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\contact-messages\show.blade.php ENDPATH**/ ?>