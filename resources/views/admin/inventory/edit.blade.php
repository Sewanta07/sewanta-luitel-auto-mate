@extends('layouts.admin')

@section('title', 'Edit Inventory Item')

@section('content')
<div class="ad-inve-page">
    <div class="ad-inve-container">
        <main class="ad-inve-main">
    <h1 class="ad-inve-title">Edit Inventory Item</h1>

    <form action="{{ route('admin.inventory.update', $item->id) }}" method="POST" class="ad-inve-form">
      @csrf
      @method('PUT')
      <div class="ad-inve-field">
        <label class="ad-inve-label">Part Name</label>
        <input type="text" name="part_name" value="{{ $item->part_name }}" required class="ad-inve-input" />
      </div>
      <div class="ad-inve-field">
        <label class="ad-inve-label">Category</label>
        <input type="text" name="category" value="{{ $item->category }}" required class="ad-inve-input" />
      </div>
      <div class="ad-inve-grid-3">
        <div class="ad-inve-field">
          <label class="ad-inve-label">Unit Price</label>
          <input type="number" step="0.01" name="unit_price" value="{{ $item->unit_price }}" required class="ad-inve-input" />
        </div>
        <div class="ad-inve-field">
          <label class="ad-inve-label">Quantity</label>
          <input type="number" name="quantity" value="{{ $item->quantity }}" required class="ad-inve-input" />
        </div>
        <div class="ad-inve-field">
          <label class="ad-inve-label">Minimum Stock</label>
          <input type="number" name="minimum_stock" value="{{ $item->minimum_stock }}" required class="ad-inve-input" />
        </div>
      </div>
      <div class="ad-inve-field">
        <label class="ad-inve-label">Supplier (optional)</label>
        <input type="text" name="supplier" value="{{ $item->supplier }}" class="ad-inve-input" />
      </div>
      <div class="ad-inve-field">
        <label class="ad-inve-label">Status</label>
        <select name="status" class="ad-inve-input">
          <option value="active" {{ $item->status === 'active' ? 'selected' : '' }}>Active</option>
          <option value="inactive" {{ $item->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>
      <div class="ad-inve-actions">
        <a href="{{ route('admin.inventory.index') }}" class="ad-inve-btn ad-inve-btn-ghost">Cancel</a>
        <button type="submit" class="ad-inve-btn ad-inve-btn-primary">Update</button>
      </div>
    </form>
        </main>
    </div>
@endsection
