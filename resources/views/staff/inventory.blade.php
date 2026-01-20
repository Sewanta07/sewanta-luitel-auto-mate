@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#f8fafc]">
  @include('components.staff-navbar')
  
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
      <div>
        <h1 class="text-4xl font-black text-gray-900 tracking-tight">Inventory Control</h1>
        <p class="text-gray-500 font-medium mt-1 text-lg">Manage parts, track stock levels, and stay supplied.</p>
      </div>
      <button class="flex items-center px-8 py-3.5 rounded-2xl bg-[#ff5a1f] text-white font-black shadow-lg shadow-orange-100 hover:bg-[#e44d18] hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
        Register New Part
      </button>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
      <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-4">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        </div>
        <p class="text-sm font-black text-gray-400 uppercase tracking-widest">Total SKU Count</p>
        <p class="text-3xl font-black text-gray-900 mt-1">142</p>
      </div>

      <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-red-600 mb-4 animate-pulse">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <p class="text-sm font-black text-gray-400 uppercase tracking-widest">Low Stock Items</p>
        <p class="text-3xl font-black text-red-600 mt-1">8</p>
      </div>

      <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-4">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
        <p class="text-sm font-black text-gray-400 uppercase tracking-widest">Out of Stock</p>
        <p class="text-3xl font-black text-orange-600 mt-1">3</p>
      </div>

      <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
        <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mb-4">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="text-sm font-black text-gray-400 uppercase tracking-widest">Inventory Value</p>
        <p class="text-3xl font-black text-gray-900 mt-1">रू 2.4M</p>
      </div>
    </div>

    {{-- Table / Card View --}}
    <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
      <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/30">
        <h2 class="text-xl font-black text-gray-900">Current Stock List</h2>
        <div class="flex items-center space-x-3">
            <div class="relative">
                <input type="text" placeholder="Search SKU or Part Name..." class="pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-2xl text-sm focus:border-[#ff5a1f] focus:ring-4 focus:ring-orange-50 transition-all w-64">
                <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <select class="px-6 py-3 bg-white border border-gray-200 rounded-2xl text-sm font-bold text-gray-600 focus:border-[#ff5a1f] transition-all">
                <option>All Systems</option>
                <option>Engine</option>
                <option>Drivetrain</option>
                <option>Suspension</option>
            </select>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="text-gray-400 text-[11px] font-black uppercase tracking-[0.2em] border-b border-gray-50">
              <th class="px-8 py-5">Part Information</th>
              <th class="px-8 py-5">System Category</th>
              <th class="px-8 py-5">Stock Level / Min</th>
              <th class="px-8 py-5">Unit Price</th>
              <th class="px-8 py-5">Health</th>
              <th class="px-8 py-5 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-50">
            {{-- Part 1 --}}
            <tr class="group hover:bg-orange-50/30 transition-colors">
              <td class="px-8 py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-white transition-colors border border-transparent group-hover:border-orange-100">
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                    </div>
                    <div>
                        <p class="font-black text-gray-900">High-Viscosity Engine Oil</p>
                        <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mt-0.5">SKU: OIL-HV-1024</p>
                    </div>
                </div>
              </td>
              <td class="px-8 py-6">
                <span class="px-3 py-1 rounded-lg bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-wider">Engine System</span>
              </td>
              <td class="px-8 py-6">
                <div class="flex items-center space-x-2">
                    <span class="text-lg font-black text-gray-900">45</span>
                    <span class="text-xs text-gray-400 font-bold">/ 20</span>
                </div>
              </td>
              <td class="px-8 py-6 font-black text-gray-900">रू 450</td>
              <td class="px-8 py-6">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span> Healthy
                </span>
              </td>
              <td class="px-8 py-6 text-right">
                <button class="px-4 py-2 text-sm font-black text-[#ff5a1f] hover:bg-orange-50 rounded-xl transition-colors">Edit</button>
              </td>
            </tr>

            {{-- Part 2 --}}
            <tr class="group hover:bg-red-50/30 transition-colors">
              <td class="px-8 py-6">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-white transition-colors border border-transparent group-hover:border-red-100">
                        <svg class="w-6 h-6 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-black text-gray-900">Ceramic Brake Pads</p>
                        <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase mt-0.5">SKU: BRK-CRM-992</p>
                    </div>
                </div>
              </td>
              <td class="px-8 py-6">
                <span class="px-3 py-1 rounded-lg bg-orange-50 text-orange-600 text-[10px] font-black uppercase tracking-wider">Brake System</span>
              </td>
              <td class="px-8 py-6">
                <div class="flex items-center space-x-2">
                    <span class="text-lg font-black text-red-600 animate-pulse">8</span>
                    <span class="text-xs text-gray-400 font-bold">/ 15</span>
                </div>
              </td>
              <td class="px-8 py-6 font-black text-gray-900">रू 2,800</td>
              <td class="px-8 py-6">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span> Low Stock
                </span>
              </td>
              <td class="px-8 py-6 text-right">
                <button class="px-5 py-2 text-sm font-black bg-red-600 text-white hover:bg-red-700 rounded-xl transition-all shadow-lg shadow-red-100">Order Now</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <div class="p-8 bg-gray-50/50 border-t border-gray-50 text-center">
        <button class="text-sm font-black text-gray-400 hover:text-gray-600 transition-colors">Load more components...</button>
      </div>
    </div>
  </main>
</div>
@endsection
