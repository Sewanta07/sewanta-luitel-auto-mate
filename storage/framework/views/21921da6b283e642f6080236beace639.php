

<?php $__env->startSection('title', 'Staff Messages'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.staff-navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Messages</h1>
            <p class="text-gray-600 mt-2">Connect with your customers</p>
        </div>

        <?php if(session('success')): ?>
            <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center text-green-700 font-medium">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white">
                        <h2 class="text-xl font-bold text-white">Conversations</h2>
                    </div>

                    <div class="divide-y max-h-96 overflow-y-auto bg-white">
                        <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e(route('staff.customers.messages', $c->id)); ?>" class="conversation-link block p-4 transition-all border-l-4 text-gray-900 <?php echo e($customer->id === $c->id ? 'border-[#ff5a1f] bg-orange-50 shadow-md' : 'border-transparent hover:bg-gray-50'); ?>">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-full bg-[#ff5a1f] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        <?php echo e(strtoupper(substr($c->name ?? $c->email ?? 'C', 0, 1))); ?>

                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 truncate"><?php echo e($c->name ?? 'Customer'); ?></p>
                                        <p class="text-xs text-gray-700 truncate mt-0.5"><?php echo e($c->email); ?></p>
                                    </div>
                                    <?php if(isset($c->unread_count) && $c->unread_count > 0): ?>
                                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full flex-shrink-0"><?php echo e($c->unread_count); ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="p-8 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <p class="font-medium">No conversations yet</p>
                                <p class="text-xs mt-1">Messages from customers will appear here</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col h-full" style="max-height: 650px;">
                    <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center text-white font-bold text-lg">
                                <?php echo e(strtoupper(substr($customer->name ?? 'C', 0, 1))); ?>

                            </div>
                            <div>
                                <h3 class="font-bold text-lg"><?php echo e($customer->name); ?></h3>
                                <p class="text-orange-100 text-sm"><?php echo e($customer->email); ?></p>
                            </div>
                        </div>
                    </div>

                    <?php if($bookings->count() > 0): ?>
                        <div class="p-4 bg-gray-50 border-b border-gray-100">
                        <p class="text-xs uppercase tracking-wide text-gray-700 font-bold mb-2">Related Bookings</p>
                            <div class="flex gap-2 flex-wrap">
                                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('staff.services.show', $booking->id)); ?>" class="booking-link inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-gray-900 bg-white border border-gray-200 hover:border-[#ff5a1f] hover:text-[#ff5a1f] transition">
                                        <?php echo e($booking->booking_code); ?> - <?php echo e($booking->service_type); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="flex-1 p-6 overflow-y-auto bg-gray-50" id="messages-container">
                        <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $isSender = $message->sender_id == Auth::id() && $message->sender_type == get_class(Auth::user());
                            ?>
                            <div class="mb-4 flex <?php echo e($isSender ? 'justify-end' : 'justify-start'); ?>">
                                <div class="max-w-xs lg:max-w-md">
                                    <p class="text-xs font-semibold mb-1.5 <?php echo e($isSender ? 'text-[#ff5a1f] text-right' : 'text-gray-900'); ?>">
                                        <?php echo e($isSender ? 'You' : $customer->name); ?>

                                    </p>
                                    <div class="px-4 py-3 rounded-2xl <?php echo e($isSender ? 'bg-[#ff5a1f] text-white rounded-br-none' : 'bg-gray-200 text-gray-900 rounded-bl-none'); ?>">
                                        <p class="break-words"><?php echo e($message->message); ?></p>
                                        <p class="text-xs mt-2 <?php echo e($isSender ? 'text-orange-50' : 'text-gray-700'); ?>">
                                            <?php echo e($message->created_at->format('M d, g:i A')); ?>

                                            <?php if($message->booking): ?>
                                                • <?php echo e($message->booking->booking_code); ?>

                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="h-full flex items-center justify-center text-gray-500">
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="p-6 border-t bg-white">
                        <form action="<?php echo e(route('staff.customers.sendMessage', $customer->id)); ?>" method="POST" class="flex gap-3">
                            <?php echo csrf_field(); ?>
                            <div class="w-48">
                                <select name="service_booking_id" class="w-full px-3 py-3 bg-white border-2 border-gray-300 rounded-xl text-sm font-bold text-gray-900 focus:border-[#ff5a1f] focus:ring focus:ring-orange-100">
                                    <option value="" class="text-gray-900">General</option>
                                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($booking->id); ?>" class="text-gray-900"><?php echo e($booking->booking_code); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="flex-1">
                                <textarea name="message" rows="2" required placeholder="Type your message..." class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl text-gray-900 placeholder-gray-600 font-medium focus:border-[#ff5a1f] focus:ring focus:ring-orange-100 resize-none focus:outline-none transition-all"></textarea>
                            </div>
                            <button type="submit" class="px-6 py-3 bg-[#ff5a1f] text-white font-bold rounded-xl hover:bg-[#e44d18] transition-all flex items-center gap-2 self-end">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"/>
                                </svg>
                                Send
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const container = document.getElementById('messages-container');
    if (container) {
        container.scrollTop = container.scrollHeight;
    }
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .conversation-link {
        color: #111827 !important;
        text-decoration: none !important;
    }
    
    .conversation-link:visited {
        color: #111827 !important;
    }
    
    .conversation-link:hover {
        color: #111827 !important;
    }
    
    .booking-link {
        color: #111827 !important;
        text-decoration: none !important;
    }
    
    .booking-link:hover {
        color: #ff5a1f !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\staff\messages.blade.php ENDPATH**/ ?>