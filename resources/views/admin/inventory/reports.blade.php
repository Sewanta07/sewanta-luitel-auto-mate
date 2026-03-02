@extends('layouts.admin')

@section('title', 'Inventory Reports')

@section('content')
<div class="ad-invr-page">
    <div class="ad-invr-container">
        <main class="ad-invr-main">
    <div class="ad-invr-head">
      <h1 class="ad-invr-title">Inventory Reports</h1>
      <a href="{{ route('admin.inventory.index') }}" class="ad-invr-btn ad-invr-btn-ghost">Back</a>
    </div>

    <div class="ad-invr-panel">
      <div class="ad-invr-table-wrap">
        <table class="ad-invr-table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Part</th>
              <th>Type</th>
              <th>Qty Change</th>
              <th>Booking</th>
              <th>Notes</th>
            </tr>
          </thead>
          <tbody>
            @forelse($movements as $move)
              <tr>
                <td class="ad-invr-muted">{{ $move->created_at->format('M d, Y H:i') }}</td>
                <td class="ad-invr-strong">{{ $move->item->part_name ?? 'Unknown' }}</td>
                <td class="ad-invr-muted">{{ ucfirst($move->change_type) }}</td>
                <td class="{{ $move->quantity_change < 0 ? 'ad-invr-text-red' : 'ad-invr-text-green' }}">{{ $move->quantity_change }}</td>
                <td class="ad-invr-muted">{{ $move->booking->booking_code ?? '-' }}</td>
                <td class="ad-invr-muted">{{ $move->notes }}</td>
              </tr>
            @empty
              <tr><td colspan="6" class="ad-invr-empty">No movements found.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
        </main>
    </div>
@endsection
