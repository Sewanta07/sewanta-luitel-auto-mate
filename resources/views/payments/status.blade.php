<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment {{ $status === 'success' ? 'Successful' : 'Failed' }} - AutoMate</title>
    @vite(['resources/css/app.css', 'resources/css/customer-core.css', 'resources/js/app.js', 'resources/js/customer-core.js'])
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center p-4">
    @php
        $redirectUrl = route('index');
        $redirectLabel = 'Back to Home';

        if (isset($payment) && $payment) {
            $parts = explode(':', (string) $payment->order_id);
            $prefix = (string) ($parts[0] ?? '');
            $entityId = (int) ($parts[1] ?? 0);

            if ($prefix === 'service_booking' && $entityId > 0) {
                $redirectUrl = route('bookings.show', $entityId);
                $redirectLabel = 'View Booking';
            } elseif (in_array($prefix, ['rental_request', 'admin_rental', 'marketplace_rental', 'rental_damage'], true)) {
                $redirectUrl = route('customer.rentals');
                $redirectLabel = 'View Rentals';
            }
        }
    @endphp

    <div class="max-w-2xl w-full">
        <!-- Company Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">AutoMate</h1>
            <p class="text-gray-600">Vehicle Service & Rental Management</p>
        </div>

        <!-- Status Card -->
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
            <!-- Status Header -->
            @if($status === 'success')
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-8 py-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Payment Successful!</h2>
                    <p class="text-green-50 text-lg">{{ $message }}</p>
                </div>
            @else
                <div class="bg-gradient-to-r from-red-500 to-red-600 px-8 py-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                    <h2 class="text-3xl font-bold text-white mb-2">Payment Failed</h2>
                    <p class="text-red-50 text-lg">{{ $message }}</p>
                </div>
            @endif

            @if($payment)
                <!-- Payment Details -->
                <div class="px-8 py-10">
                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-[#ff5a1f] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14h6m-6 4h6M7 3h10a2 2 0 012 2v14l-2-1-2 1-2-1-2 1-2-1-2 1V5a2 2 0 012-2z"></path></svg>
                            Transaction Details
                        </h3>
                    </div>

                    <div class="space-y-5">
                        <!-- Order ID -->
                        <div class="flex justify-between items-start py-3 border-b border-gray-100">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 9h16M4 15h16M10 3L8 21M16 3l-2 18"></path></svg>
                                <span class="text-sm font-medium text-gray-600">Order ID</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 text-right ml-4">{{ $payment->order_id }}</span>
                        </div>

                        <!-- Amount -->
                        <div class="flex justify-between items-start py-3 border-b border-gray-100">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path></svg>
                                <span class="text-sm font-medium text-gray-600">Amount Paid</span>
                            </div>
                            <span class="text-xl font-bold text-[#ff5a1f] text-right ml-4">Rs. {{ number_format($payment->amount, 2) }}</span>
                        </div>

                        <!-- Status -->
                        <div class="flex justify-between items-start py-3 border-b border-gray-100">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-sm font-medium text-gray-600">Payment Status</span>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $payment->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </div>

                        <!-- Transaction ID -->
                        @if($payment->transaction_id)
                            <div class="flex justify-between items-start py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v14M7 5v14M11 5v14M16 5v14M21 5v14"></path></svg>
                                    <span class="text-sm font-medium text-gray-600">Transaction ID</span>
                                </div>
                                <span class="text-sm font-mono text-gray-900 text-right ml-4">{{ $payment->transaction_id }}</span>
                            </div>
                        @endif

                        <!-- Payment Type -->
                        <div class="flex justify-between items-start py-3 border-b border-gray-100">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M3 11l8.586 8.586a2 2 0 002.828 0l6.172-6.172a2 2 0 000-2.828L12 2H5a2 2 0 00-2 2v7z"></path></svg>
                                <span class="text-sm font-medium text-gray-600">Payment Type</span>
                            </div>
                            <span class="text-sm font-bold text-gray-900 text-right ml-4">{{ ucfirst(str_replace('_', ' ', $payment->type)) }}</span>
                        </div>

                        <!-- Payment Gateway -->
                        @if($payment->gateway)
                            <div class="flex justify-between items-start py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-9 4h16a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm font-medium text-gray-600">Payment Gateway</span>
                                </div>
                                <span class="text-sm font-bold text-gray-900 text-right ml-4 uppercase">{{ $payment->gateway }}</span>
                            </div>
                        @endif

                        <!-- Date & Time -->
                        @if($payment->paid_at)
                            <div class="flex justify-between items-start py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="text-sm font-medium text-gray-600">Transaction Date</span>
                                </div>
                                <div class="text-right ml-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $payment->paid_at->format('F j, Y') }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $payment->paid_at->format('g:i A') }}</div>
                                </div>
                            </div>
                        @elseif($payment->created_at)
                            <div class="flex justify-between items-start py-3 border-b border-gray-100">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="text-sm font-medium text-gray-600">Transaction Date</span>
                                </div>
                                <div class="text-right ml-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $payment->created_at->format('F j, Y') }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $payment->created_at->format('g:i A') }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($status === 'success')
                        <!-- Success Message Box -->
                        <div class="mt-8 bg-green-50 border border-green-200 rounded-xl p-6">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-green-500 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <h4 class="font-bold text-green-900 mb-1">Payment Confirmed</h4>
                                    <p class="text-sm text-green-700">Your payment has been processed successfully. A confirmation email will be sent shortly.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Failure Message Box -->
                        <div class="mt-8 bg-red-50 border border-red-200 rounded-xl p-6">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 text-red-500 mt-1 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86l-7.1 12.3A1 1 0 004.05 18h15.9a1 1 0 00.86-1.84l-7.1-12.3a1 1 0 00-1.72 0z"></path></svg>
                                <div>
                                    <h4 class="font-bold text-red-900 mb-1">Payment Failed</h4>
                                    <p class="text-sm text-red-700">If the amount was deducted from your account,  contact support.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ $redirectUrl }}" class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-[#ff5a1f] text-white font-bold hover:bg-[#e64b15] transition-all shadow-lg hover:shadow-xl">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M9 21V9h6v12"></path></svg>
                    {{ $redirectLabel }}
                </a>
                @if($status === 'failed')
                    <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center px-8 py-3 rounded-xl bg-white text-gray-700 font-bold hover:bg-gray-50 transition-all border-2 border-gray-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v6h6M20 20v-6h-6M20 10a8 8 0 00-14.9-3M4 14a8 8 0 0014.9 3"></path></svg>
                        Try Again
                    </a>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} AutoMate. All rights reserved.</p>
            <p class="mt-1">Need help? Contact our support team</p>
        </div>
    </div>

</body>
</html>
