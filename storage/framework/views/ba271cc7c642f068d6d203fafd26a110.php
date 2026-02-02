

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('customer.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <main class="max-w-7xl mx-auto p-6">
    <div class="mb-6">
      <h1 class="text-3xl font-bold text-gray-900">Payment History</h1>
      <p class="text-gray-500 mt-1">View all your past transactions and invoices</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-sm text-gray-500">Total Spent</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">Rs. 45,320</p>
      </div>
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-sm text-gray-500">This Month</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">Rs. 10,735</p>
      </div>
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-sm text-gray-500">Last Payment</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">Rs. 8,500</p>
      </div>
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <p class="text-sm text-gray-500">Total Transactions</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">12</p>
      </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
      <div class="flex flex-wrap gap-4 items-center">
        <div class="flex-1 min-w-[200px]">
          <input type="text" placeholder="Search..." class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        </div>
        <select class="px-4 py-2 border border-gray-300 rounded-lg">
          <option>All Time</option>
          <option>This Month</option>
        </select>
      </div>
    </div>

    <!-- Payment History Table -->
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Invoice</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Date</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Service</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Amount</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 text-sm font-medium">#INV-2026-012</td>
            <td class="px-6 py-4 text-sm text-gray-500">Jan 18, 2026</td>
            <td class="px-6 py-4 text-sm">Engine Repair</td>
            <td class="px-6 py-4 text-sm font-semibold">Rs. 10,735</td>
            <td class="px-6 py-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Completed</span></td>
            <td class="px-6 py-4 text-right text-sm"><button class="text-orange-600 font-semibold">View</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/customer/payment-history.blade.php ENDPATH**/ ?>