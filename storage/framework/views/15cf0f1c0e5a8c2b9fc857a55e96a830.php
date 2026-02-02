

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <main class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Payment</h1>
      <p class="text-gray-500 mt-1">Complete your service payment securely</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Payment Form -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm p-6 space-y-6">
          <!-- Payment Method Selection -->
          <div>
            <h2 class="text-xl font-bold text-gray-900 mb-4">Select Payment Method</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <!-- eSewa -->
              <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-orange-500 transition">
                <input type="radio" name="payment_method" value="esewa" class="mr-3" checked>
                <div class="flex items-center space-x-3">
                  <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <span class="text-green-600 font-bold text-xs">eSewa</span>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">eSewa</p>
                    <p class="text-xs text-gray-500">Digital Wallet</p>
                  </div>
                </div>
              </label>

              <!-- Khalti -->
              <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-orange-500 transition">
                <input type="radio" name="payment_method" value="khalti" class="mr-3">
                <div class="flex items-center space-x-3">
                  <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <span class="text-purple-600 font-bold text-xs">Khalti</span>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Khalti</p>
                    <p class="text-xs text-gray-500">Digital Wallet</p>
                  </div>
                </div>
              </label>

              <!-- Credit/Debit Card -->
              <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-orange-500 transition">
                <input type="radio" name="payment_method" value="card" class="mr-3">
                <div class="flex items-center space-x-3">
                  <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Credit/Debit Card</p>
                    <p class="text-xs text-gray-500">Visa, MasterCard</p>
                  </div>
                </div>
              </label>

              <!-- Bank Transfer -->
              <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-orange-500 transition">
                <input type="radio" name="payment_method" value="bank" class="mr-3">
                <div class="flex items-center space-x-3">
                  <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900">Bank Transfer</p>
                    <p class="text-xs text-gray-500">Direct Transfer</p>
                  </div>
                </div>
              </label>
            </div>
          </div>

          <!-- Card Details Form (shown when card is selected) -->
          <div id="card-form" class="pt-6 border-t">
            <h3 class="font-bold text-gray-900 mb-4">Card Details</h3>
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Card Number</label>
                <input type="text" placeholder="1234 5678 9012 3456" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
              </div>
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                  <input type="text" placeholder="MM/YY" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">CVV</label>
                  <input type="text" placeholder="123" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cardholder Name</label>
                <input type="text" placeholder="JOHN DOE" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
              </div>
            </div>
          </div>

          <!-- Terms & Conditions -->
          <div class="pt-6 border-t">
            <label class="flex items-start">
              <input type="checkbox" class="mt-1 mr-3">
              <span class="text-sm text-gray-600">I agree to the <a href="#" class="text-orange-500 hover:underline">Terms & Conditions</a> and <a href="#" class="text-orange-500 hover:underline">Privacy Policy</a></span>
            </label>
          </div>
        </div>
      </div>

      <!-- Payment Summary -->
      <div class="space-y-6">
        <!-- Order Summary -->
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <h3 class="font-bold text-gray-900 mb-4">Payment Summary</h3>
          <div class="space-y-3">
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Service Request</span>
              <span class="font-medium">#SR-2026-001</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Service Type</span>
              <span class="font-medium">Engine Repair</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Vehicle</span>
              <span class="font-medium">Toyota Camry 2020</span>
            </div>
            <hr class="my-4">
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Labor Charges</span>
              <span class="font-medium">Rs. 3,500</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Parts</span>
              <span class="font-medium">Rs. 5,200</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Service Fee</span>
              <span class="font-medium">Rs. 800</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-600">Tax (13%)</span>
              <span class="font-medium">Rs. 1,235</span>
            </div>
            <hr class="my-4">
            <div class="flex justify-between">
              <span class="font-bold text-gray-900 text-lg">Total</span>
              <span class="font-bold text-orange-600 text-xl">Rs. 10,735</span>
            </div>
          </div>
        </div>

        <!-- Security Badge -->
        <div class="bg-green-50 rounded-2xl p-6 border border-green-200">
          <div class="flex items-start space-x-3">
            <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
              <h4 class="font-semibold text-green-900">Secure Payment</h4>
              <p class="text-sm text-green-700 mt-1">Your payment information is encrypted and secure</p>
            </div>
          </div>
        </div>

        <!-- Pay Button -->
        <button class="w-full bg-orange-500 text-white py-4 rounded-xl font-bold hover:bg-orange-600 transition shadow-lg">
          Pay Rs. 10,735
        </button>

        <div class="text-center text-sm text-gray-500">
          Payment secured by 256-bit SSL encryption
        </div>
      </div>
    </div>
  </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/payments.blade.php ENDPATH**/ ?>