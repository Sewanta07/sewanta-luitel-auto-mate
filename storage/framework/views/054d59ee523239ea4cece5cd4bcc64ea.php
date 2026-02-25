

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
  <aside class="w-64 flex-shrink-0 z-30">
    <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </aside>

  <div class="flex-1 flex flex-col overflow-y-auto sm:ml-64 bg-gray-50">
    <main class="max-w-7xl w-full mx-auto p-6">
      <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Assign Service</h1>
        <p class="text-gray-500 mt-1">Assign service request #SR-2026-002 to a mechanic</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Service Details -->
        <div class="lg:col-span-2">
          <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Service Request Details</h2>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <p class="text-sm text-gray-500">Request ID</p>
                <p class="font-semibold">#SR-2026-002</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Service Type</p>
                <p class="font-semibold">Oil Change</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Customer</p>
                <p class="font-semibold">Sita Sharma</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Vehicle</p>
                <p class="font-semibold">Honda City 2022</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Scheduled Date</p>
                <p class="font-semibold">Jan 22, 2026</p>
              </div>
              <div>
                <p class="text-sm text-gray-500">Priority</p>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Medium</span>
              </div>
            </div>
          </div>

          <!-- Available Staff -->
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Available Staff</h2>
            <div class="space-y-4">
              <!-- Staff Member 1 -->
              <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-orange-500 transition">
                <input type="radio" name="staff" value="1" class="mr-4">
                <div class="flex items-center flex-1">
                  <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold mr-4">JD</div>
                  <div class="flex-1">
                    <div class="flex items-center justify-between">
                      <div>
                        <p class="font-bold text-gray-900">John Doe</p>
                        <p class="text-sm text-gray-500">Senior Mechanic</p>
                      </div>
                      <div class="text-right">
                        <p class="text-sm font-semibold text-green-600">Available</p>
                        <p class="text-xs text-gray-500">3 active tasks</p>
                      </div>
                    </div>
                    <div class="mt-2 flex gap-2">
                      <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">Engine Specialist</span>
                      <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">5 years exp</span>
                    </div>
                  </div>
                </div>
              </label>

              <!-- Staff Member 2 -->
              <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-orange-500 transition">
                <input type="radio" name="staff" value="2" class="mr-4">
                <div class="flex items-center flex-1">
                  <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold mr-4">JS</div>
                  <div class="flex-1">
                    <div class="flex items-center justify-between">
                      <div>
                        <p class="font-bold text-gray-900">Jane Smith</p>
                        <p class="text-sm text-gray-500">Mechanic</p>
                      </div>
                      <div class="text-right">
                        <p class="text-sm font-semibold text-green-600">Available</p>
                        <p class="text-xs text-gray-500">2 active tasks</p>
                      </div>
                    </div>
                    <div class="mt-2 flex gap-2">
                      <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">General Service</span>
                      <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">3 years exp</span>
                    </div>
                  </div>
                </div>
              </label>

              <!-- Staff Member 3 (Busy) -->
              <label class="flex items-center p-4 border-2 border-gray-200 rounded-xl opacity-60">
                <input type="radio" name="staff" value="3" class="mr-4" disabled>
                <div class="flex items-center flex-1">
                  <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-bold mr-4">RK</div>
                  <div class="flex-1">
                    <div class="flex items-center justify-between">
                      <div>
                        <p class="font-bold text-gray-900">Ram Kumar</p>
                        <p class="text-sm text-gray-500">Junior Mechanic</p>
                      </div>
                      <div class="text-right">
                        <p class="text-sm font-semibold text-red-600">Busy</p>
                        <p class="text-xs text-gray-500">5 active tasks</p>
                      </div>
                    </div>
                  </div>
                </div>
              </label>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
          <div class="bg-white rounded-2xl shadow-sm p-6">
            <h3 class="font-bold text-gray-900 mb-4">Assignment Details</h3>
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Priority Level</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                  <option>Low</option>
                  <option selected>Medium</option>
                  <option>High</option>
                  <option>Urgent</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estimated Duration</label>
                <select class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                  <option>< 1 hour</option>
                  <option selected>1-2 hours</option>
                  <option>2-4 hours</option>
                  <option>Half day</option>
                  <option>Full day</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Special Instructions</label>
                <textarea rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Add any special notes..."></textarea>
              </div>
            </div>
          </div>

          <button class="w-full px-6 py-3 bg-orange-500 text-white rounded-xl font-bold hover:bg-orange-600 shadow-lg">
            Assign Service
          </button>

          <button class="w-full px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200">
            Cancel
          </button>
        </div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views\admin\services\assign.blade.php ENDPATH**/ ?>