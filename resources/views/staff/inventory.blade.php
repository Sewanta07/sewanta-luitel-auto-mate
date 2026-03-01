@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 pb-12">
  @include('components.staff-navbar')

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-6">
      <div>
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">Inventory Management</h1>
        <p class="text-gray-600 font-medium mt-2 text-base">Monitor available parts and stock status</p>
      </div>
      <div class="flex gap-3">
        <input type="text" id="searchInput" placeholder="Search parts..." class="px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 w-full md:w-64 text-sm font-medium outline-none transition">
      </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow border border-gray-100 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Total Parts</p>
            <p class="text-3xl font-black text-gray-900 mt-2">{{ $stats['total'] }}</p>
          </div>
          <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path></svg>
          </div>
        </div>
      </div>
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow border border-gray-100 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Low Stock Alert</p>
            <p class="text-3xl font-black text-orange-600 mt-2">{{ $stats['low_stock'] }}</p>
          </div>
          <div class="w-14 h-14 bg-orange-50 rounded-xl flex items-center justify-center">
            <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
        </div>
      </div>
      <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow border border-gray-100 transform hover:-translate-y-1">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Out of Stock</p>
            <p class="text-3xl font-black text-red-600 mt-2">{{ $stats['out_of_stock'] }}</p>
          </div>
          <div class="w-14 h-14 bg-red-50 rounded-xl flex items-center justify-center">
            <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Inventory Table -->
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
      <div class="p-6 border-b border-gray-100 bg-gray-50">
        <h2 class="text-lg font-black text-gray-900 flex items-center">
          <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Stock Status Summary
        </h2>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left">
          <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
              <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Part Name</th>
              <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Category</th>
              <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Stock Level</th>
              <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Unit Price</th>
              <th class="px-6 py-4 text-xs font-black text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @forelse($items as $item)
              @php
                $stockPercent = $item->minimum_stock > 0 ? min(($item->quantity / $item->minimum_stock) * 100, 100) : 100;
                $stockWidthClass = match (true) {
                  $stockPercent <= 0 => 'w-0',
                  $stockPercent <= 10 => 'w-1/12',
                  $stockPercent <= 20 => 'w-2/12',
                  $stockPercent <= 30 => 'w-3/12',
                  $stockPercent <= 40 => 'w-4/12',
                  $stockPercent <= 50 => 'w-6/12',
                  $stockPercent <= 60 => 'w-7/12',
                  $stockPercent <= 70 => 'w-8/12',
                  $stockPercent <= 80 => 'w-9/12',
                  $stockPercent <= 90 => 'w-10/12',
                  default => 'w-full',
                };
              @endphp
              <tr class="hover:bg-gray-50 transition-colors group">
                <td class="px-6 py-4">
                  <p class="font-bold text-gray-900 group-hover:text-orange-600 transition">{{ $item->part_name }}</p>
                </td>
                <td class="px-6 py-4">
                  <span class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold">{{ $item->category }}</span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex items-center gap-3">
                    <div class="w-24 bg-gray-200 rounded-full h-2">
                      <div class="bg-gradient-to-r {{ $item->stock_status === 'out_of_stock' ? 'from-red-500 to-red-600' : ($item->stock_status === 'low_stock' ? 'from-orange-500 to-orange-600' : 'from-green-500 to-green-600') }} h-2 rounded-full {{ $stockWidthClass }}"></div>
                    </div>
                    <span class="text-sm font-black text-gray-900 whitespace-nowrap">{{ $item->quantity }}/{{ $item->minimum_stock }}</span>
                  </div>
                </td>
                <td class="px-6 py-4">
                  <p class="font-bold text-gray-900">Rs. {{ number_format($item->unit_price, 2) }}</p>
                </td>
                <td class="px-6 py-4">
                  @if($item->status !== 'active')
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-gray-100 border border-gray-300">
                      <span class="w-2.5 h-2.5 bg-gray-500 rounded-full"></span>
                      <span class="text-xs font-black text-gray-700 uppercase tracking-wider">Inactive</span>
                    </div>
                  @elseif($item->stock_status === 'out_of_stock')
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-red-50 border border-red-200">
                      <span class="w-2.5 h-2.5 bg-red-600 rounded-full"></span>
                      <span class="text-xs font-black text-red-700 uppercase tracking-wider">Out</span>
                    </div>
                  @elseif($item->stock_status === 'low_stock')
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-orange-50 border border-orange-200">
                      <span class="w-2.5 h-2.5 bg-orange-600 rounded-full animate-pulse"></span>
                      <span class="text-xs font-black text-orange-700 uppercase tracking-wider">Low</span>
                    </div>
                  @else
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-green-50 border border-green-200">
                      <span class="w-2.5 h-2.5 bg-green-600 rounded-full"></span>
                      <span class="text-xs font-black text-green-700 uppercase tracking-wider">Good</span>
                    </div>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-12 text-center">
                  <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path></svg>
                  <p class="text-gray-500 font-bold text-lg">No inventory items found</p>
                  <p class="text-gray-400 text-sm mt-1">Check back later for available parts</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</div>

<script>
document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
  const searchTerm = e.target.value.toLowerCase();
  const rows = document.querySelectorAll('tbody tr');
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    row.style.display = text.includes(searchTerm) ? '' : 'none';
  });
});
</script>
@endsection
