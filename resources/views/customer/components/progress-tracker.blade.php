<div class="p-4 rounded-2xl bg-white shadow-sm">
  <div class="text-sm font-medium text-gray-600 mb-4">Service Progress</div>
  <div class="flex items-center space-x-4">
    {{-- Step 1: Submitted --}}
    <div class="flex-1">
      <div class="flex items-center">
        <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center">1</div>
        <div class="ml-3 text-sm text-gray-500">Submitted</div>
      </div>
      <div class="h-1 bg-gray-100 rounded mt-3"></div>
    </div>

    {{-- Step 2: Assigned (current) --}}
    <div class="flex-1">
      <div class="flex items-center">
        <div class="w-8 h-8 rounded-full text-white flex items-center justify-center ring-2" style="background-color: #2563eb; border-color: #dbeafe;">2</div>
        <div class="ml-3 text-sm text-gray-700 font-medium">Assigned</div>
      </div>
      <div class="h-1 rounded mt-3" style="background-color: #dbeafe;"></div>
    </div>

    {{-- Step 3: In Progress --}}
    <div class="flex-1">
      <div class="flex items-center">
        <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center">3</div>
        <div class="ml-3 text-sm text-gray-500">In Progress</div>
      </div>
      <div class="h-1 bg-gray-100 rounded mt-3"></div>
    </div>

    {{-- Step 4: Completed --}}
    <div class="flex-1">
      <div class="flex items-center">
        <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center">4</div>
        <div class="ml-3 text-sm text-gray-500">Completed</div>
      </div>
      <div class="h-1 bg-gray-100 rounded mt-3"></div>
    </div>
  </div>
</div>
