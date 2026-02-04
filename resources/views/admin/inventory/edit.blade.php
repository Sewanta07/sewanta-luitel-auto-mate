@extends('layouts.app')

@section('title', 'Edit Inventory Item')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
    {{-- Sidebar --}}
    <aside class="w-64 flex-shrink-0 z-30">
        @include('components.admin-sidebar')
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-4xl w-full mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Inventory Item</h1>

    <form action="{{ route('admin.inventory.update', $item->id) }}" method="POST" class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
      @csrf
      @method('PUT')
      <div>
        <label class="block text-sm font-semibold text-gray-700">Part Name</label>
        <input type="text" name="part_name" value="{{ $item->part_name }}" required class="mt-1 w-full rounded-lg border-gray-200" />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700">Category</label>
        <input type="text" name="category" value="{{ $item->category }}" required class="mt-1 w-full rounded-lg border-gray-200" />
      </div>
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-semibold text-gray-700">Unit Price</label>
          <input type="number" step="0.01" name="unit_price" value="{{ $item->unit_price }}" required class="mt-1 w-full rounded-lg border-gray-200" />
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700">Quantity</label>
          <input type="number" name="quantity" value="{{ $item->quantity }}" required class="mt-1 w-full rounded-lg border-gray-200" />
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700">Minimum Stock</label>
          <input type="number" name="minimum_stock" value="{{ $item->minimum_stock }}" required class="mt-1 w-full rounded-lg border-gray-200" />
        </div>
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700">Supplier (optional)</label>
        <input type="text" name="supplier" value="{{ $item->supplier }}" class="mt-1 w-full rounded-lg border-gray-200" />
      </div>
      <div>
        <label class="block text-sm font-semibold text-gray-700">Status</label>
        <select name="status" class="mt-1 w-full rounded-lg border-gray-200">
          <option value="active" {{ $item->status === 'active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ $item->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>
      <div class="flex gap-3">
        <a href="{{ route('admin.inventory.index') }}" class="px-4 py-2 rounded-lg border border-gray-200">Cancel</a>
        <button type="submit" class="px-4 py-2 rounded-lg bg-[#ff5a1f] text-white">Update</button>
      </div>
    </form>
        </main>
    </div>
</div>
@endsection
