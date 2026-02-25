<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment <?php echo e($status === 'success' ? 'Successful' : 'Failed'); ?> - AutoMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-2xl w-full">
        <!-- Company Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">AutoMate</h1>
            <p class="text-gray-600">Vehicle Service & Rental Management</p>
        </div>

        <!-- Status Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Status Header -->
            <?php if($status === 'success'): ?>
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-8 py-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg">
                        <i class="fas fa-check text-4xl text-green-500"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Payment Successful!</h2>
                    <p class="text-green-50 text-lg"><?php echo e($message); ?></p>
                </div>
            <?php else: ?>
                <div class="bg-gradient-to-r from-red-500 to-red-600 px-8 py-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg">
                        <i class="fas fa-times text-4xl text-red-500"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Payment Failed</h2>
                    <p class="text-red-50 text-lg"><?php echo e($message); ?></p>
                </div>
            <?php endif; ?>

            <?php if($payment): ?>
                <!-- Payment Details -->
                <div class="px-8 py-10">
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-receipt text-[#ff5a1f] mr-3"></i>
                            Transaction Details
                        </h3>
                    </div>

                    <div class="space-y-5">
                        <!-- Order ID -->
                        <div class="flex justify-between items-start py-3 border-b border-gray-100">
                            <div class="flex items-center">
                                <i class="fas fa-hashtag text-gray-400 w-6 mr-3"></i>
                                <span class="text-sm font-medium text-gray-600">Order ID</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 text-right ml-4"><?php echo e($payment->order_id); ?></span>
                        </div>

                        <!-- Amount -->
                        <div class="flex justify-between items-start py-3 border-b border-gray-100">
                            <div class="flex items-center">
                                <i class="fas fa-dollar-sign text-gray-400 w-6 mr-3"></i>
                                <span class="text-sm font-medium text-gray-600">Amount Paid</span>
                            </div>
                            <span class="text-xl font-bold text-[#ff5a1f] text-right ml-4">Rs. <?php echo e(number_format($payment->amount, 2)); ?></span>
                        </div>

                        <!-- Status -->
                        <div class="flex justify-between items-start py-3 border-b border-gray-100">
                            <div class="flex items-center">
                                <i class="fas fa-info-circle text-gray-400 w-6 mr-3"></i>
                                <span class="text-sm font-medium text-gray-600">Payment Status</span>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold <?php echo e($payment->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                <?php echo e(ucfirst($payment->status)); ?>

                            </span>
                        </div>

                        <!-- Transaction ID -->
                        <?php if($payment->transaction_id): ?>
                            <div class="flex justify-between items-start py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <i class="fas fa-barcode text-gray-400 w-6 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-600">Transaction ID</span>
                                </div>
                                <span class="text-sm font-mono text-gray-900 text-right ml-4"><?php echo e($payment->transaction_id); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Payment Type -->
                        <div class="flex justify-between items-start py-3 border-b border-gray-100">
                            <div class="flex items-center">
                                <i class="fas fa-tag text-gray-400 w-6 mr-3"></i>
                                <span class="text-sm font-medium text-gray-600">Payment Type</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 text-right ml-4"><?php echo e(ucfirst(str_replace('_', ' ', $payment->type))); ?></span>
                        </div>

                        <!-- Payment Gateway -->
                        <?php if($payment->gateway): ?>
                            <div class="flex justify-between items-start py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <i class="fas fa-credit-card text-gray-400 w-6 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-600">Payment Gateway</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900 text-right ml-4 uppercase"><?php echo e($payment->gateway); ?></span>
                            </div>
                        <?php endif; ?>

                        <!-- Date & Time -->
                        <?php if($payment->paid_at): ?>
                            <div class="flex justify-between items-start py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-gray-400 w-6 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-600">Transaction Date</span>
                                </div>
                                <div class="text-right ml-4">
                                    <div class="text-sm font-bold text-gray-900"><?php echo e($payment->paid_at->format('F j, Y')); ?></div>
                                    <div class="text-xs text-gray-500 mt-1"><?php echo e($payment->paid_at->format('g:i A')); ?></div>
                                </div>
                            </div>
                        <?php elseif($payment->created_at): ?>
                            <div class="flex justify-between items-start py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-gray-400 w-6 mr-3"></i>
                                    <span class="text-sm font-medium text-gray-600">Transaction Date</span>
                                </div>
                                <div class="text-right ml-4">
                                    <div class="text-sm font-bold text-gray-900"><?php echo e($payment->created_at->format('F j, Y')); ?></div>
                                    <div class="text-xs text-gray-500 mt-1"><?php echo e($payment->created_at->format('g:i A')); ?></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if($status === 'success'): ?>
                        <!-- Success Message Box -->
                        <div class="mt-8 bg-green-50 border border-green-200 rounded-xl p-6">
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-500 text-xl mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-bold text-green-900 mb-1">Payment Confirmed</h4>
                                    <p class="text-sm text-green-700">Your payment has been processed successfully. A confirmation email will be sent shortly.</p>
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Failure Message Box -->
                        <div class="mt-8 bg-red-50 border border-red-200 rounded-xl p-6">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-red-500 text-xl mt-1 mr-3"></i>
                                <div>
                                    <h4 class="font-bold text-red-900 mb-1">Payment Failed</h4>
                                    <p class="text-sm text-red-700">If the amount was deducted from your account, it will be refunded within 5-7 business days. Please try again or contact support.</p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="<?php echo e(route('index')); ?>" class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-home mr-2"></i>
                    Back to Home
                </a>
                <?php if($status === 'failed'): ?>
                    <a href="<?php echo e(url()->previous()); ?>" class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-white text-gray-700 font-bold hover:bg-gray-50 transition-all border-2 border-gray-200">
                        <i class="fas fa-redo mr-2"></i>
                        Try Again
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-500 text-sm">
            <p>&copy; <?php echo e(date('Y')); ?> AutoMate. All rights reserved.</p>
            <p class="mt-1">Need help? Contact our support team</p>
        </div>
    </div>

    <?php if($status === 'success'): ?>
        <script>
            // Confetti animation for success
            setTimeout(() => {
                document.body.insertAdjacentHTML('beforeend', '<style>@keyframes fadeOut{to{opacity:0;transform:translateY(20px)}}</style>');
            }, 2000);
        </script>
    <?php endif; ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\payments\status.blade.php ENDPATH**/ ?>