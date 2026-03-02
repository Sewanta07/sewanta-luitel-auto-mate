@extends('layouts.admin')

@section('title', 'Add Inventory Item')

@section('content')
<div class="ad-invc-page">
    <div class="ad-invc-container">
        <main class="ad-invc-main">
    <h1 class="ad-invc-title">Add Inventory Item</h1>

    <form action="{{ route('admin.inventory.store') }}" method="POST" class="ad-invc-form">
      @csrf
      <div class="ad-invc-field">
        <label class="ad-invc-label">Part Name</label>
        <input type="text" name="part_name" required class="ad-invc-input" />
      </div>
      <div class="ad-invc-field">
        <label class="ad-invc-label">Category</label>
        <input type="text" name="category" required class="ad-invc-input" />
      </div>
      <div class="ad-invc-grid-3">
        <div class="ad-invc-field">
          <label class="ad-invc-label">Unit Price</label>
          <input type="number" step="0.01" name="unit_price" required class="ad-invc-input" />
        </div>
        <div class="ad-invc-field">
          <label class="ad-invc-label">Quantity</label>
          <input type="number" name="quantity" required class="ad-invc-input" />
        </div>
        <div class="ad-invc-field">
          <label class="ad-invc-label">Minimum Stock</label>
          <input type="number" name="minimum_stock" required class="ad-invc-input" />
        </div>
      </div>
      <div class="ad-invc-field">
        <label class="ad-invc-label">Supplier (optional)</label>
        <input type="text" name="supplier" class="ad-invc-input" />
      </div>
      <div class="ad-invc-field">
        <label class="ad-invc-label">Status</label>
        <select name="status" class="ad-invc-input">
          <option value="active" selected>Active</option>
          <option value="inactive">Inactive</option>
        </select>
      </div>
      <div class="ad-invc-actions">
        <a href="{{ route('admin.inventory.index') }}" class="ad-invc-btn ad-invc-btn-ghost">Cancel</a>
        <button type="submit" class="ad-invc-btn ad-invc-btn-primary">Save</button>
      </div>
    </form>
        </main>
    </div>
@endsection
