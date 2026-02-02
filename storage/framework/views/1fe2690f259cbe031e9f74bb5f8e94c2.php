

<?php $__env->startSection('content'); ?>
<div class="flex h-screen bg-gray-50 overflow-hidden">
  <aside class="w-64 flex-shrink-0 z-30">
    <?php echo $__env->make('components.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </aside>

  <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50/50">
    <main class="max-w-7xl w-full mx-auto p-6">
      
      
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-4">
        <div>
          <h1 class="text-5xl font-black text-gray-900 tracking-tight leading-none">Service <span class="text-[#ff5a1f]">Management</span></h1>
          <p class="text-gray-400 font-bold mt-4 flex items-center tracking-tight">
            <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span>
            System online • Active monitoring enabled
          </p>
        </div>
        <div class="flex gap-3">
          <button class="px-6 py-3 bg-white border border-gray-100 rounded-2xl text-sm font-black text-gray-900 shadow-sm hover:shadow-md transition-all flex items-center">
            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Export All
          </button>
        </div>
      </div>

      
      <?php if(session('success')): ?>
        <div class="mb-10 p-5 bg-green-500 text-white rounded-[2rem] font-black text-sm shadow-xl shadow-green-100 flex items-center animate-bounce-in">
          <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <?php echo e(session('success')); ?>

        </div>
      <?php endif; ?>

      <!-- Stats Grid - Compact One Line Layout -->
      <div class="grid grid-cols-5 gap-2 mb-6">
        <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-50 group hover:shadow-md transition-all">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-gray-900 group-hover:text-white transition-all flex-shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-[8px] font-black text-gray-400 uppercase tracking-wider truncate">Total Active</p>
              <p class="text-xl font-black text-gray-900"><?php echo e($stats['total']); ?></p>
            </div>
          </div>
        </div>
        
        <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-50 group hover:shadow-md transition-all">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-orange-50 flex items-center justify-center text-[#ff5a1f] group-hover:bg-[#ff5a1f] group-hover:text-white transition-all flex-shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-[8px] font-black text-gray-400 uppercase tracking-wider truncate">Pending</p>
              <p class="text-xl font-black text-[#ff5a1f]"><?php echo e($stats['pending']); ?></p>
            </div>
          </div>
        </div>

        <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-50 group hover:shadow-md transition-all">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-all flex-shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-[8px] font-black text-gray-400 uppercase tracking-wider truncate">In Progress</p>
              <p class="text-xl font-black text-blue-500"><?php echo e($stats['in_progress']); ?></p>
            </div>
          </div>
        </div>

        <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-50 group hover:shadow-md transition-all">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-green-50 flex items-center justify-center text-green-500 group-hover:bg-green-500 group-hover:text-white transition-all flex-shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-[8px] font-black text-gray-400 uppercase tracking-wider truncate">Completed</p>
              <p class="text-xl font-black text-green-500"><?php echo e($stats['completed']); ?></p>
            </div>
          </div>
        </div>

        <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-50 group hover:shadow-md transition-all">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-red-50 flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-all flex-shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-[8px] font-black text-gray-400 uppercase tracking-wider truncate">Unassigned</p>
              <p class="text-xl font-black text-red-500"><?php echo e($stats['unassigned']); ?></p>
            </div>
          </div>
        </div>
      </div>

      <!-- Advanced Filters -->
      <div class="flex flex-wrap items-center gap-4 mb-8">
          <div class="flex-1 min-w-[300px] relative group">
              <input type="text" placeholder="Search by name, vehicle or request ID..." 
                     class="w-full bg-white border border-gray-100 rounded-3xl pl-14 pr-8 py-5 text-sm font-bold shadow-sm focus:ring-4 focus:ring-orange-100 focus:border-[#ff5a1f] transition-all outline-none">
              <svg class="absolute left-6 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-300 group-hover:text-[#ff5a1f] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
          </div>
          <div class="flex gap-4">
              <select class="px-8 py-5 bg-white border border-gray-100 rounded-3xl text-sm font-black tracking-tight shadow-sm hover:shadow-md transition-all appearance-none cursor-pointer outline-none min-w-[160px]">
                  <option>All Status</option>
                  <option>Pending</option>
                  <option>In Progress</option>
                  <option>Completed</option>
              </select>
          </div>
      </div>

      <!-- Main Database Area -->
      <div class="bg-white rounded-[3rem] shadow-2xl shadow-gray-100/50 border border-gray-50 overflow-hidden relative">
        <div class="overflow-x-auto">
          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-50/30">
                <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-50">Identity</th>
                <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-50">Service Details</th>
                <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-50">Ownership</th>
                <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-50">Technician</th>
                <th class="px-10 py-6 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] border-b border-gray-50 text-right">Status</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
              <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr class="group hover:bg-orange-50/10 transition-colors" x-data="{ openAssign: false, openLogs: false, openReject: false }">
                <td class="px-10 py-8">
                  <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gray-900 text-white font-black text-[10px] shadow-lg shadow-gray-200 mb-3 tracking-tighter">
                    <?php echo e($booking->booking_code ?? ('BK-' . str_pad($booking->id, 3, '0', STR_PAD_LEFT))); ?>

                  </div>
                  <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest"><?php echo e(\Carbon\Carbon::parse($booking->created_at)->format('d M, Y')); ?></div>
                </td>
                <td class="px-10 py-8">
                  <div class="text-lg font-black text-gray-900 tracking-tight group-hover:text-[#ff5a1f] transition-colors"><?php echo e($booking->service_type); ?></div>
                  <div class="text-xs font-bold text-gray-400 mt-1 flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <?php echo e($booking->location); ?>

                  </div>
                </td>
                <td class="px-10 py-8">
                  <div class="flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center text-[#ff5a1f] font-black text-sm mr-4">
                      <?php echo e(substr($booking->customer->name ?? '?', 0, 1)); ?>

                    </div>
                    <div>
                      <div class="text-sm font-black text-gray-900 leading-none"><?php echo e($booking->customer->name ?? 'Unknown User'); ?></div>
                      <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-2"><?php echo e($booking->vehicle_model); ?></div>
                    </div>
                  </div>
                </td>
                <td class="px-10 py-8 text-sm">
                    <?php if($booking->staff): ?>
                        <button @click="openAssign = true" class="flex items-center group/staff bg-green-50/50 hover:bg-green-500 hover:text-white transition-all px-4 py-2 rounded-xl border border-green-100">
                            <span class="text-sm font-black tracking-tight mr-2"><?php echo e($booking->staff->name); ?></span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    <?php else: ?>
                        <button @click="openAssign = true" class="px-5 py-2.5 bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-red-500 hover:text-white transform transition-all active:scale-95 shadow-sm">
                            Assign Personnel
                        </button>
                    <?php endif; ?>

                    <!-- Approval & Assignment Portal -->
                    <div x-show="openAssign" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-md" x-cloak>
                        <div @click.away="openAssign = false" class="bg-white rounded-[3rem] p-12 max-w-lg w-full shadow-2xl scale-in relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
                            
                        <h3 class="text-4xl font-black text-gray-900 tracking-tight mb-4">Approve <span class="text-[#ff5a1f]">Booking</span></h3>
                        <p class="text-gray-500 font-bold mb-10 leading-relaxed">Approve this booking, assign a technician, and set expectations.</p>
                            
                        <form action="<?php echo e(route('admin.services.approve', $booking->id)); ?>" method="POST" class="space-y-8">
                                <?php echo csrf_field(); ?>
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1">Approved Personnel</label>
                                    <div class="relative">
                                        <select name="staff_id" class="w-full px-8 py-5 bg-gray-50 border-none rounded-3xl text-sm font-black focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all appearance-none outline-none" required>
                                            <option value="">Search technicians...</option>
                                            <?php $__currentLoopData = $staffMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($staff->id); ?>" <?php echo e($booking->staff_id == $staff->id ? 'selected' : ''); ?>>
                                                    <?php echo e($staff->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-gray-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                                        </div>
                                    </div>
                                </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                      <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 mb-2">Estimated Cost (रू)</label>
                                        <input type="number" name="estimated_cost" step="0.01" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-black focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all outline-none" placeholder="e.g. 5000">
                                      </div>
                                      <div>
                                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 mb-2">Completion Date</label>
                                        <input type="date" name="expected_completion_date" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-black focus:ring-4 focus:ring-orange-100 focus:bg-white transition-all outline-none">
                                      </div>
                                    </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <button type="button" @click="openAssign = false" class="px-8 py-5 bg-gray-100 text-gray-400 font-black rounded-3xl hover:bg-gray-200 transition-all uppercase text-xs tracking-widest">Abort</button>
                                      <button type="submit" class="px-8 py-5 bg-[#ff5a1f] text-white font-black rounded-3xl shadow-2xl shadow-orange-200 hover:bg-[#e44d18] transform hover:-translate-y-1 transition-all uppercase text-xs tracking-widest">Approve & Assign</button>
                                </div>
                            </form>
                        </div>
                    </div>

                              <!-- Reject Portal -->
                              <div x-show="openReject" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-md" x-cloak>
                                <div @click.away="openReject = false" class="bg-white rounded-[3rem] p-12 max-w-lg w-full shadow-2xl scale-in relative overflow-hidden">
                                  <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
                                  <h3 class="text-4xl font-black text-gray-900 tracking-tight mb-4">Reject <span class="text-red-500">Booking</span></h3>
                                  <p class="text-gray-500 font-bold mb-10 leading-relaxed">Provide a reason for rejection to notify the customer.</p>
                                  <form action="<?php echo e(route('admin.services.reject', $booking->id)); ?>" method="POST" class="space-y-6">
                                    <?php echo csrf_field(); ?>
                                    <div>
                                      <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-1 mb-2">Rejection Reason</label>
                                      <textarea name="rejection_reason" rows="4" class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-red-100 focus:bg-white transition-all outline-none resize-none" required></textarea>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                      <button type="button" @click="openReject = false" class="px-8 py-5 bg-gray-100 text-gray-400 font-black rounded-3xl hover:bg-gray-200 transition-all uppercase text-xs tracking-widest">Abort</button>
                                      <button type="submit" class="px-8 py-5 bg-red-500 text-white font-black rounded-3xl shadow-2xl shadow-red-200 hover:bg-red-600 transform hover:-translate-y-1 transition-all uppercase text-xs tracking-widest">Reject</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                </td>
                <td class="px-10 py-8 text-right">
                    <div class="flex items-center justify-end gap-4">
                        <button @click="openLogs = true" class="text-[10px] font-black text-gray-400 hover:text-[#ff5a1f] uppercase tracking-widest transition-colors flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            History
                        </button>

                          <button @click="openReject = true" class="text-[10px] font-black text-red-500 uppercase tracking-widest hover:text-red-600 transition-colors">Reject</button>
                        
                        <form action="<?php echo e(route('admin.services.status', $booking->id)); ?>" method="POST" class="inline-block">
                            <?php echo csrf_field(); ?>
                            <select name="status" onchange="this.form.submit()" class="text-xs font-black border-none rounded-2xl px-6 py-3 tracking-tighter uppercase focus:ring-0 cursor-pointer transition-all
                                <?php echo e($booking->status == 'Pending' ? 'bg-orange-50 text-orange-500 hover:bg-orange-100' : 
                                   ($booking->status == 'In Progress' ? 'bg-blue-50 text-blue-500 hover:bg-blue-100' : 'bg-green-50 text-green-500 hover:bg-green-100')); ?>">
                                <option value="Pending" <?php echo e($booking->status == 'Pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="Approved" <?php echo e($booking->status == 'Approved' ? 'selected' : ''); ?>>Approved</option>
                                <option value="Assigned" <?php echo e($booking->status == 'Assigned' ? 'selected' : ''); ?>>Assigned</option>
                                <option value="In Progress" <?php echo e($booking->status == 'In Progress' ? 'selected' : ''); ?>>In Progress</option>
                                <option value="Waiting for Parts" <?php echo e($booking->status == 'Waiting for Parts' ? 'selected' : ''); ?>>Waiting for Parts</option>
                                <option value="Completed" <?php echo e($booking->status == 'Completed' ? 'selected' : ''); ?>>Completed</option>
                                <option value="Cancelled" <?php echo e($booking->status == 'Cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                                <option value="Rejected" <?php echo e($booking->status == 'Rejected' ? 'selected' : ''); ?>>Rejected</option>
                            </select>
                        </form>
                    </div>

                    <!-- History Log Modal -->
                    <div x-show="openLogs" class="fixed inset-0 z-[110] flex items-center justify-center p-4 bg-gray-900/60 backdrop-blur-md" x-cloak>
                        <div @click.away="openLogs = false" class="bg-white rounded-[3rem] p-12 max-w-2xl w-full shadow-2xl scale-in relative overflow-hidden flex flex-col max-h-[80vh]">
                            <h3 class="text-4xl font-black text-gray-900 tracking-tight mb-8">Service <span class="text-[#ff5a1f]">Timeline</span></h3>
                            
                            <div class="overflow-y-auto pr-4 -mr-4 flex-1 space-y-8">
                                <?php $__empty_2 = true; $__currentLoopData = $booking->logs()->with('user')->latest()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <div class="flex gap-6 relative">
                                        <?php if(!$loop->last): ?>
                                            <div class="absolute left-6 top-12 bottom-0 w-1 bg-gray-50 rounded-full"></div>
                                        <?php endif; ?>
                                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl <?php echo e($log->status == 'Completed' ? 'bg-green-100 text-green-600' : ($log->status == 'Assigned' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-[#ff5a1f]')); ?> flex items-center justify-center font-black text-sm z-10 shadow-lg shadow-white">
                                            <?php echo e(substr($log->status, 0, 1)); ?>

                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-lg font-black text-gray-900"><?php echo e($log->status); ?></span>
                                                <span class="text-xs font-black text-gray-400 uppercase tracking-widest"><?php echo e($log->created_at->diffForHumans()); ?></span>
                                            </div>
                                            <div class="bg-gray-50/50 p-5 rounded-[1.5rem] border border-gray-50 text-gray-600 font-bold text-sm leading-relaxed">
                                                <?php echo e($log->notes); ?>

                                            </div>
                                            <div class="mt-3 flex items-center text-[10px] font-black text-gray-300 uppercase tracking-tighter">
                                                <span class="w-1 h-1 rounded-full bg-gray-200 mr-2"></span>
                                                Updated by <?php echo e($log->user->name); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <div class="text-center py-20">
                                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-200">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <p class="text-gray-400 font-black tracking-tight">No events recorded for this request yet.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <button @click="openLogs = false" class="mt-10 w-full px-8 py-5 bg-gray-900 text-white font-black rounded-3xl hover:bg-gray-800 transition-all uppercase text-xs tracking-widest">Close Timeline</button>
                        </div>
                    </div>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="5" class="px-10 py-32 text-center">
                  <div class="w-24 h-24 bg-gray-50 rounded-[3rem] flex items-center justify-center mx-auto mb-8 text-gray-200">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                  </div>
                  <h3 class="text-2xl font-black text-gray-900 mb-2">No active requests</h3>
                  <p class="text-gray-400 font-bold max-w-sm mx-auto">All systems clear. Check back later for new service bookings from customers.</p>
                </td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>

<style>
@keyframes scaleIn { from { opacity: 0; transform: scale(0.9) translateY(20px); } to { opacity: 1; transform: scale(1) translateY(0); } }
@keyframes bounceIn { 0% { opacity: 0; transform: scale(0.3); } 50% { opacity: 0.9; transform: scale(1.1); } 70% { opacity: 1; transform: scale(0.9); } 100% { opacity: 1; transform: scale(1); } }
.scale-in { animation: scaleIn 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
.animate-bounce-in { animation: bounceIn 0.5s ease-out; }

/* Hide scrollbar for Chrome, Safari and Opera */
.overflow-y-auto::-webkit-scrollbar {
  display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.overflow-y-auto {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\AutoMate\resources\views/admin/services.blade.php ENDPATH**/ ?>