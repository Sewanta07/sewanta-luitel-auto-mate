@extends('layouts.app')

@section('content')
@include('components.staff-navbar')

<div class="sf-svcshow-page">
  <main class="sf-svcshow-main">
    @php($isCompleted = $booking->status === 'Completed')

    @if(session('success'))
      <div class="sf-svcshow-flash sf-svcshow-flash-success">
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="sf-svcshow-flash sf-svcshow-flash-error">
        {{ session('error') }}
      </div>
    @endif

    @if($errors->any())
      <div class="sf-svcshow-flash sf-svcshow-flash-error">
        {{ $errors->first() }}
      </div>
    @endif

    <div class="sf-svcshow-hero">
      <div class="sf-svcshow-hero-row">
        <div>
          <p class="sf-svcshow-kicker">Service Details</p>
          <h1 class="sf-svcshow-title">Booking {{ $booking->booking_code }}</h1>
          <p class="sf-svcshow-subtitle">Track service progress and customer info at a glance.</p>
        </div>
        <div class="sf-svcshow-hero-status-wrap">
          <span class="sf-svcshow-status
            @if($booking->status == 'Pending') sf-svcshow-status-pending
            @elseif($booking->status == 'Assigned') sf-svcshow-status-assigned
            @elseif($booking->status == 'Customer Accepted') sf-svcshow-status-accepted
            @elseif($booking->status == 'In Progress') sf-svcshow-status-progress
            @elseif($booking->status == 'Waiting for Parts') sf-svcshow-status-parts
            @elseif($booking->status == 'Completed') sf-svcshow-status-completed
            @else sf-svcshow-status-default
            @endif">
            {{ $booking->status }}
          </span>
        </div>
      </div>
    </div>

      <div class="sf-svcshow-quick-grid">
        <div class="sf-svcshow-quick-card">
          <div class="sf-svcshow-quick-head">
            <div class="sf-svcshow-quick-icon sf-svcshow-quick-icon-orange">
              <svg class="sf-svcshow-quick-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <p class="sf-svcshow-quick-label">Service Type</p>
          </div>
          <p class="sf-svcshow-quick-value">{{ $booking->service_type }}</p>
        </div>
        <div class="sf-svcshow-quick-card">
          <div class="sf-svcshow-quick-head">
            <div class="sf-svcshow-quick-icon sf-svcshow-quick-icon-blue">
              <svg class="sf-svcshow-quick-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="sf-svcshow-quick-label">Priority</p>
          </div>
          <p class="sf-svcshow-quick-value">{{ $booking->service_priority ?? 'Standard' }}</p>
        </div>
        <div class="sf-svcshow-quick-card">
          <div class="sf-svcshow-quick-head">
            <div class="sf-svcshow-quick-icon sf-svcshow-quick-icon-green">
              <svg class="sf-svcshow-quick-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10V6m0 12v-2m6-6a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="sf-svcshow-quick-label">Estimated Cost</p>
          </div>
          <p class="sf-svcshow-quick-value">Rs. {{ $booking->estimated_cost ?? 'TBD' }}</p>
        </div>
        <div class="sf-svcshow-quick-card">
          <div class="sf-svcshow-quick-head">
            <div class="sf-svcshow-quick-icon sf-svcshow-quick-icon-purple">
              <svg class="sf-svcshow-quick-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <p class="sf-svcshow-quick-label">Booked Date</p>
          </div>
          <p class="sf-svcshow-quick-value">{{ $booking->preferred_date }}</p>
        </div>
      </div>

      <div class="sf-svcshow-sections">
        <div class="sf-svcshow-info-grid">
          <div class="sf-svcshow-card sf-svcshow-card-customer">
            <div class="sf-svcshow-card-head">
              <div class="sf-svcshow-card-icon sf-svcshow-card-icon-orange">
                <svg class="sf-svcshow-card-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
              </div>
              <h2 class="sf-svcshow-card-title">Customer Details</h2>
            </div>
            <div class="sf-svcshow-detail-grid">
              <div class="sf-svcshow-detail-box">
                <p class="sf-svcshow-detail-label">Full Name</p>
                <p class="sf-svcshow-detail-value">{{ $booking->customer->name ?? 'Unknown' }}</p>
              </div>
              <div class="sf-svcshow-detail-box">
                <p class="sf-svcshow-detail-label">Contact Number</p>
                <p class="sf-svcshow-detail-value">{{ $booking->phone_number ?? ($booking->customer->phone ?? 'N/A') }}</p>
              </div>
              <div class="sf-svcshow-detail-box sf-svcshow-detail-box-wide">
                <p class="sf-svcshow-detail-label">Email Address</p>
                <p class="sf-svcshow-detail-value sf-svcshow-break-all">{{ $booking->customer->email ?? 'N/A' }}</p>
              </div>
              <div class="sf-svcshow-detail-box sf-svcshow-detail-box-wide">
                <p class="sf-svcshow-detail-label">Service Location</p>
                <p class="sf-svcshow-detail-value">{{ $booking->location }}</p>
              </div>
            </div>
          </div>

          <div class="sf-svcshow-card sf-svcshow-card-vehicle">
            <div class="sf-svcshow-card-head">
              <div class="sf-svcshow-card-icon sf-svcshow-card-icon-blue">
                <svg class="sf-svcshow-card-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              </div>
              <h2 class="sf-svcshow-card-title">Vehicle Details</h2>
            </div>
            <div class="sf-svcshow-detail-stack">
              <div class="sf-svcshow-detail-box">
                <p class="sf-svcshow-detail-label">Make & Model</p>
                <p class="sf-svcshow-detail-value">{{ $booking->vehicle_model }}</p>
              </div>
              <div class="sf-svcshow-registration-box">
                <p class="sf-svcshow-registration-label">Registration Number</p>
                <p class="sf-svcshow-registration-value">{{ $booking->vehicle_number }}</p>
              </div>
              <div class="sf-svcshow-detail-grid">
                <div class="sf-svcshow-detail-box">
                  <p class="sf-svcshow-detail-label">Vehicle Type</p>
                  <p class="sf-svcshow-detail-value">{{ $booking->vehicle_type }}</p>
                </div>
                <div class="sf-svcshow-detail-box">
                  <p class="sf-svcshow-detail-label">Year of Manufacture</p>
                  <p class="sf-svcshow-detail-value">{{ $booking->vehicle_year ?? 'N/A' }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="sf-svcshow-card sf-svcshow-card-update sticky-form-container">
          <div class="sf-svcshow-card-head">
            <div class="sf-svcshow-card-icon sf-svcshow-card-icon-orange">
              <svg class="sf-svcshow-card-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h3 class="sf-svcshow-card-title">Update Service Progress</h3>
          </div>
          @if($isCompleted)
            <div class="sf-svcshow-completed-note">
              This booking is completed. You can view details and history, but editing is disabled.
            </div>
          @else
          <form action="{{ route('staff.bookings.status', $booking->id) }}" method="POST" class="sf-svcshow-form" enctype="multipart/form-data">
              @csrf
              
              <div>
                  <label class="sf-svcshow-label">Select Status</label>
                  <select name="status" class="sf-svcshow-input">
                    @if($booking->status === 'Assigned')
                      <option value="Assigned" selected disabled>Assigned (Waiting for Customer)</option>
                    @else
                      <option value="Customer Accepted" {{ $booking->status == 'Customer Accepted' ? 'selected' : '' }}>Customer Accepted</option>
                      <option value="In Progress" {{ $booking->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                      <option value="Waiting for Parts" {{ $booking->status == 'Waiting for Parts' ? 'selected' : '' }}>Waiting for Parts</option>
                      <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    @endif
                  </select>
                  @if($booking->status === 'Assigned')
                    <p class="sf-svcshow-inline-help">
                      <svg class="sf-svcshow-inline-help-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                      Waiting for customer to accept your assignment
                    </p>
                  @endif
              </div>

              <div>
                  <label class="sf-svcshow-label">Work Notes</label>
                  <textarea name="notes" rows="4" class="sf-svcshow-input sf-svcshow-textarea" placeholder="Describe what you've completed..."></textarea>
              </div>

              <div>
                <label class="sf-svcshow-label">Attach Evidence</label>
                <div class="sf-svcshow-file-wrap">
                  <input type="file" name="attachment" accept=".jpg,.jpeg,.png,.pdf" class="sf-svcshow-file-input">
                  <p class="sf-svcshow-file-help">JPG, PNG, or PDF • Max 5MB</p>
                </div>
              </div>

              <div class="sf-svcshow-sticky-submit">
                <button type="submit" class="sf-svcshow-submit-btn">
                  <svg class="sf-svcshow-submit-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                  Post Update
                </button>
              </div>
          </form>
          @endif
        </div>

        <div class="sf-svcshow-card sf-svcshow-card-parts">
          <h2 class="sf-svcshow-section-title">
              <svg class="sf-svcshow-section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H8a2 2 0 00-2 2v2H4a2 2 0 00-2 2v6a2 2 0 002 2h4"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
              Parts Used
          </h2>

          @if($isCompleted)
            <div class="sf-svcshow-completed-note">
              Parts cannot be modified after completion.
            </div>
          @else
          <form action="{{ route('staff.services.parts.add', $booking->id) }}" method="POST" class="sf-svcshow-parts-form">
            @csrf
            <div>
              <label class="sf-svcshow-label">Part</label>
              <select name="inventory_item_id" required class="sf-svcshow-input">
                <option value="" disabled selected>Select part</option>
                @foreach($inventoryItems as $item)
                  <option value="{{ $item->id }}" {{ $item->status !== 'active' || $item->quantity <= 0 ? 'disabled' : '' }}>
                    {{ $item->part_name }} ({{ $item->quantity }}) - {{ ucfirst($item->status) }}{{ $item->quantity <= 0 ? ' - Out of stock' : '' }}
                  </option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="sf-svcshow-label">Quantity</label>
              <input type="number" name="quantity" min="1" required class="sf-svcshow-input">
            </div>
            <div class="sf-svcshow-parts-action">
              <button type="submit" class="sf-svcshow-btn-primary">Add Part</button>
            </div>
          </form>
          @endif

          <div class="sf-svcshow-table-shell">
            <table class="sf-svcshow-table">
              <thead class="sf-svcshow-table-head">
                <tr>
                  <th class="sf-svcshow-th">Part</th>
                  <th class="sf-svcshow-th sf-svcshow-th-center">Qty</th>
                  <th class="sf-svcshow-th sf-svcshow-th-right">Unit Price</th>
                  <th class="sf-svcshow-th sf-svcshow-th-right">Total</th>
                </tr>
              </thead>
              <tbody class="sf-svcshow-tbody">
                @forelse($booking->parts as $part)
                  <tr>
                    <td class="sf-svcshow-td">{{ $part->part_name }}</td>
                    <td class="sf-svcshow-td sf-svcshow-td-center">{{ $part->pivot->quantity }}</td>
                    <td class="sf-svcshow-td sf-svcshow-td-right">Rs. {{ number_format($part->pivot->unit_price, 2) }}</td>
                    <td class="sf-svcshow-td sf-svcshow-td-right sf-svcshow-td-strong">Rs. {{ number_format($part->pivot->total_cost, 2) }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="sf-svcshow-empty-cell">No parts added yet.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <div class="sf-svcshow-card sf-svcshow-card-history">
          <h2 class="sf-svcshow-history-title">
              <svg class="sf-svcshow-section-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
              Service History & Updates
          </h2>
          <div class="sf-svcshow-timeline">
              @forelse($booking->logs()->with('user')->latest()->get() as $log)
                  <div class="sf-svcshow-log-item">
                      @if(!$loop->last)
                          <div class="sf-svcshow-log-line"></div>
                      @endif
                      
                      <div class="sf-svcshow-log-dot {{ $log->status == 'Completed' ? 'sf-svcshow-log-dot-completed' : 'sf-svcshow-log-dot-active' }}">
                          @if($log->status == 'Completed')
                            <svg class="sf-svcshow-log-dot-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                          @else
                            {{ substr($log->status, 0, 1) }}
                          @endif
                      </div>

                      <div class="sf-svcshow-log-content">
                          <div class="sf-svcshow-log-head">
                              <span class="sf-svcshow-log-status">{{ $log->status }}</span>
                              <span class="sf-svcshow-log-date">{{ $log->created_at->format('M d, Y') }} • <span class="sf-svcshow-log-time">{{ $log->created_at->format('H:i') }}</span></span>
                          </div>
                          
                          @if($log->notes)
                            <div class="sf-svcshow-log-notes-box">
                              <p class="sf-svcshow-log-notes">{{ $log->notes }}</p>
                            </div>
                          @endif

                          @if($log->attachment_path)
                            <div class="sf-svcshow-log-attachment-wrap">
                              <a href="{{ asset('storage/' . $log->attachment_path) }}" target="_blank" class="sf-svcshow-log-attachment">
                                <svg class="sf-svcshow-log-attachment-icon" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"/></svg>
                                <span class="sf-svcshow-log-attachment-text">View Attachment</span>
                                <svg class="sf-svcshow-log-attachment-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                              </a>
                            </div>
                          @endif

                          <p class="sf-svcshow-log-author">By <span class="sf-svcshow-log-author-name">{{ $log->user->name ?? 'System' }}</span></p>
                      </div>
                  </div>
              @empty
                  <div class="sf-svcshow-history-empty">
                      <svg class="sf-svcshow-history-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                      <p class="sf-svcshow-history-empty-title">No updates yet</p>
                      <p class="sf-svcshow-history-empty-copy">Start by updating the status above</p>
                  </div>
              @endforelse
          </div>
        </div>
      </div>
    </main>
</div>
@endsection
