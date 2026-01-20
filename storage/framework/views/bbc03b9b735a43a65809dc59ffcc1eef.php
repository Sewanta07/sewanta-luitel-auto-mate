

<?php $__env->startSection('content'); ?>
  <div class="min-h-screen bg-gray-50">
    <!-- Header -->
    <div class="bg-white border-b border-gray-200">
      <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
          <h1 class="text-2xl font-bold text-gray-900">Notifications</h1>
          <div class="flex gap-4">
            <button class="text-sm text-blue-600 hover:text-blue-800 font-semibold">Mark all as read</button>
            <button class="text-sm text-gray-600 hover:text-gray-800 font-semibold">Settings</button>
          </div>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto p-6">
      <!-- Filter Tabs -->
      <div class="flex gap-4 mb-6">
        <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold">All</button>
        <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100">Unread</button>
        <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100">Services</button>
        <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100">Payments</button>
        <button class="px-4 py-2 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100">System</button>
      </div>

      <!-- Notifications List -->
      <div class="space-y-3">
        <!-- Notification 1 (Unread) -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 hover:shadow-md transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white flex-shrink-0 mr-4">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
              </svg>
            </div>
            <div class="flex-1">
              <div class="flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Service Request Updated</h3>
                <span class="text-xs text-gray-500">2 minutes ago</span>
              </div>
              <p class="text-sm text-gray-700 mt-1">Your service request #SR-2026-001 is now in progress. Mechanic John Doe has been assigned.</p>
              <div class="mt-3 flex gap-2">
                <button class="text-sm text-blue-600 hover:text-blue-800 font-semibold">View Request</button>
                <button class="text-sm text-gray-600 hover:text-gray-800">Dismiss</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Notification 2 (Unread) -->
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 hover:shadow-md transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-white flex-shrink-0 mr-4">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="flex-1">
              <div class="flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Payment Successful</h3>
                <span class="text-xs text-gray-500">1 hour ago</span>
              </div>
              <p class="text-sm text-gray-700 mt-1">Payment of रू 10,735 for service #SR-2026-001 has been processed successfully.</p>
              <div class="mt-3 flex gap-2">
                <button class="text-sm text-green-600 hover:text-green-800 font-semibold">View Invoice</button>
                <button class="text-sm text-gray-600 hover:text-gray-800">Dismiss</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Notification 3 (Read) -->
        <div class="bg-white border-l-4 border-gray-300 rounded-lg p-4 hover:shadow-md transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center text-white flex-shrink-0 mr-4">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="flex-1 opacity-75">
              <div class="flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Appointment Reminder</h3>
                <span class="text-xs text-gray-500">5 hours ago</span>
              </div>
              <p class="text-sm text-gray-700 mt-1">Your vehicle service is scheduled for tomorrow at 10:00 AM. Please arrive 10 minutes early.</p>
            </div>
          </div>
        </div>

        <!-- Notification 4 (Unread - Warning) -->
        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4 hover:shadow-md transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-white flex-shrink-0 mr-4">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="flex-1">
              <div class="flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Service Delay Notice</h3>
                <span class="text-xs text-gray-500">Yesterday</span>
              </div>
              <p class="text-sm text-gray-700 mt-1">Due to parts availability, your service completion may be delayed by 1-2 days. We apologize for the inconvenience.</p>
              <div class="mt-3 flex gap-2">
                <button class="text-sm text-yellow-600 hover:text-yellow-800 font-semibold">Contact Support</button>
                <button class="text-sm text-gray-600 hover:text-gray-800">Dismiss</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Notification 5 (System) -->
        <div class="bg-purple-50 border-l-4 border-purple-500 rounded-lg p-4 hover:shadow-md transition">
          <div class="flex items-start">
            <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white flex-shrink-0 mr-4">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="flex-1">
              <div class="flex items-center justify-between">
                <h3 class="font-bold text-gray-900">New Feature Available</h3>
                <span class="text-xs text-gray-500">2 days ago</span>
              </div>
              <p class="text-sm text-gray-700 mt-1">We've added car rental service! Rent a vehicle while yours is being serviced.</p>
              <div class="mt-3 flex gap-2">
                <button class="text-sm text-purple-600 hover:text-purple-800 font-semibold">Learn More</button>
                <button class="text-sm text-gray-600 hover:text-gray-800">Dismiss</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Load More -->
      <div class="mt-6 text-center">
        <button class="px-6 py-3 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100 shadow-sm">Load More Notifications</button>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/notifications/index.blade.php ENDPATH**/ ?>