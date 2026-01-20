

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
  <aside class="w-64 flex-shrink-0 z-30">
    <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </aside>

  <div class="flex-1 flex flex-col overflow-y-auto sm:ml-64 bg-gray-50">
    <main class="max-w-7xl w-full mx-auto p-6">
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Rental Management</h1>
        <p class="text-gray-500 mt-1">Manage vehicle rentals and bookings</p>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <p class="text-sm text-gray-500">Total Vehicles</p>
          <p class="text-2xl font-bold text-gray-900 mt-1">12</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <p class="text-sm text-gray-500">Active Rentals</p>
          <p class="text-2xl font-bold text-blue-600 mt-1">7</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <p class="text-sm text-gray-500">Available</p>
          <p class="text-2xl font-bold text-green-600 mt-1">5</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm p-6">
          <p class="text-sm text-gray-500">Revenue (Month)</p>
          <p class="text-2xl font-bold text-orange-600 mt-1">रू 125K</p>
        </div>
      </div>

      <!-- Tabs -->
      <div class="flex gap-4 mb-6">
        <button class="px-6 py-3 bg-orange-500 text-white rounded-lg font-semibold">Active Bookings</button>
        <button class="px-6 py-3 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100">Rental Fleet</button>
        <button class="px-6 py-3 bg-white text-gray-700 rounded-lg font-semibold hover:bg-gray-100">History</button>
      </div>

      <!-- Active Rentals -->
      <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-6">
        <div class="p-6 border-b border-gray-200">
          <h2 class="text-xl font-bold text-gray-900">Active Rental Bookings</h2>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Booking ID</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Customer</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Vehicle</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Start Date</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">End Date</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Amount</th>
              <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
              <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm font-medium">#RB-2026-001</td>
              <td class="px-6 py-4">
                <div class="text-sm font-medium">Rajesh Kumar</div>
                <div class="text-xs text-gray-500">+977 9841234567</div>
              </td>
              <td class="px-6 py-4">
                <div class="text-sm font-medium">Honda Civic 2022</div>
                <div class="text-xs text-gray-500">BA-05-RN-1001</div>
              </td>
              <td class="px-6 py-4 text-sm">Jan 18, 2026</td>
              <td class="px-6 py-4 text-sm">Jan 25, 2026</td>
              <td class="px-6 py-4 text-sm font-semibold">रू 17,500</td>
              <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Active</span></td>
              <td class="px-6 py-4 text-right">
                <button class="text-orange-600 hover:text-orange-900 font-semibold mr-3">View</button>
                <button class="text-green-600 hover:text-green-900 font-semibold">Extend</button>
              </td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-4 text-sm font-medium">#RB-2026-002</td>
              <td class="px-6 py-4">
                <div class="text-sm font-medium">Sita Sharma</div>
                <div class="text-xs text-gray-500">+977 9851234567</div>
              </td>
              <td class="px-6 py-4">
                <div class="text-sm font-medium">Toyota Corolla 2023</div>
                <div class="text-xs text-gray-500">BA-05-RN-1002</div>
              </td>
              <td class="px-6 py-4 text-sm">Jan 20, 2026</td>
              <td class="px-6 py-4 text-sm">Jan 22, 2026</td>
              <td class="px-6 py-4 text-sm font-semibold">रू 5,000</td>
              <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending Payment</span></td>
              <td class="px-6 py-4 text-right">
                <button class="text-orange-600 hover:text-orange-900 font-semibold mr-3">View</button>
                <button class="text-blue-600 hover:text-blue-900 font-semibold">Approve</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Rental Fleet -->
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-xl font-bold text-gray-900">Rental Fleet</h2>
          <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">+ Add Vehicle</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Vehicle Card 1 -->
          <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition">
            <div class="h-40 bg-gray-200"></div>
            <div class="p-4">
              <h3 class="font-bold text-gray-900">Honda Civic 2022</h3>
              <p class="text-sm text-gray-500">BA-05-RN-1001 • Automatic</p>
              <div class="mt-4 flex items-center justify-between">
                <div>
                  <p class="text-xs text-gray-500">Rate/Day</p>
                  <p class="font-bold text-orange-600">रू 2,500</p>
                </div>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Rented</span>
              </div>
            </div>
          </div>

          <!-- Vehicle Card 2 -->
          <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition">
            <div class="h-40 bg-gray-200"></div>
            <div class="p-4">
              <h3 class="font-bold text-gray-900">Toyota Corolla 2023</h3>
              <p class="text-sm text-gray-500">BA-05-RN-1002 • Automatic</p>
              <div class="mt-4 flex items-center justify-between">
                <div>
                  <p class="text-xs text-gray-500">Rate/Day</p>
                  <p class="font-bold text-orange-600">रू 2,500</p>
                </div>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/rentals.blade.php ENDPATH**/ ?>