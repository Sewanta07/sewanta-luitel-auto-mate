

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
  <aside class="w-64 flex-shrink-0 z-30">
    <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </aside>

  <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50">
    <main class="max-w-7xl w-full mx-auto p-6">
      <div class="mb-3">
        <h1 class="text-3xl font-bold text-gray-900">Issues & Feedback</h1>
        <p class="text-gray-500 mt-1">Manage customer complaints and feedback</p>
      </div>

      <!-- Stats -->
      <div class="grid grid-cols-4 gap-4 mb-4">
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Total Issues</p>
              <p class="text-2xl font-bold text-gray-900">48</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Open</p>
              <p class="text-2xl font-bold text-red-600">12</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">In Progress</p>
              <p class="text-2xl font-bold text-yellow-600">8</p>
            </div>
          </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-sm p-4 border border-gray-100 hover:shadow-md transition">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
              <p class="text-gray-500 text-sm">Resolved</p>
              <p class="text-2xl font-bold text-green-600">28</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters -->
      <div class="bg-white rounded-2xl shadow-sm p-4 mb-6">
        <div class="flex flex-wrap gap-4">
          <input type="search" placeholder="Search issues..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg">
          <select class="px-4 py-2 border border-gray-300 rounded-lg">
            <option>All Status</option>
            <option>Open</option>
            <option>In Progress</option>
            <option>Resolved</option>
          </select>
          <select class="px-4 py-2 border border-gray-300 rounded-lg">
            <option>All Priority</option>
            <option>High</option>
            <option>Medium</option>
            <option>Low</option>
          </select>
        </div>
      </div>

      <!-- Issues List -->
      <div class="space-y-4">
        <!-- Issue 1 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition">
          <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <h3 class="text-lg font-bold text-gray-900">Service Delay Complaint</h3>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">High Priority</span>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">In Progress</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">Issue #ISS-2026-001 • Submitted Jan 18, 2026</p>
              <p class="text-gray-900">Customer complaining about delayed service completion. Expected 2 days, took 5 days.</p>
            </div>
          </div>
          
          <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <div class="flex items-center space-x-4">
              <div class="flex items-center text-sm text-gray-600">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold mr-2">RK</div>
                <span>Rajesh Kumar</span>
              </div>
              <div class="flex items-center text-sm text-gray-600">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Assigned to: John Doe</span>
              </div>
            </div>
            <div class="flex gap-2">
              <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">View Details</button>
              <button class="px-4 py-2 bg-green-500 text-white rounded-lg font-semibold hover:bg-green-600">Mark Resolved</button>
            </div>
          </div>
        </div>

        <!-- Issue 2 -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition">
          <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <h3 class="text-lg font-bold text-gray-900">Billing Discrepancy</h3>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Medium Priority</span>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Open</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">Issue #ISS-2026-002 • Submitted Jan 19, 2026</p>
              <p class="text-gray-900">Customer reporting incorrect charge on invoice. Claims parts were overcharged.</p>
            </div>
          </div>
          
          <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <div class="flex items-center space-x-4">
              <div class="flex items-center text-sm text-gray-600">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold mr-2">SS</div>
                <span>Sita Sharma</span>
              </div>
              <div class="flex items-center text-sm text-red-600 font-semibold">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Unassigned</span>
              </div>
            </div>
            <div class="flex gap-2">
              <button class="px-4 py-2 bg-blue-500 text-white rounded-lg font-semibold hover:bg-blue-600">Assign Staff</button>
              <button class="px-4 py-2 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600">View Details</button>
            </div>
          </div>
        </div>

        <!-- Issue 3 (Resolved) -->
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition opacity-75">
          <div class="flex items-start justify-between mb-4">
            <div class="flex-1">
              <div class="flex items-center gap-3 mb-2">
                <h3 class="text-lg font-bold text-gray-900">Poor Customer Service</h3>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Low Priority</span>
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Resolved</span>
              </div>
              <p class="text-sm text-gray-600 mb-2">Issue #ISS-2026-003 • Submitted Jan 10, 2026 • Resolved Jan 15, 2026</p>
              <p class="text-gray-900">Customer feedback about staff behavior. Resolved with staff training.</p>
            </div>
          </div>
          
          <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <div class="flex items-center space-x-4">
              <div class="flex items-center text-sm text-gray-600">
                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold mr-2">RP</div>
                <span>Ram Prasad</span>
              </div>
              <div class="flex items-center text-sm text-gray-600">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Resolved by: Jane Smith</span>
              </div>
            </div>
            <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300">View Details</button>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/issues.blade.php ENDPATH**/ ?>