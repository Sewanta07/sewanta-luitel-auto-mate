@extends('layouts.staff')

@section('title', 'Staff Dashboard - AutoMate')

@section('content')
<div class="sf-page">
    <main class="sf-main">
        {{-- Page Header --}}
        <div class="sf-head">
            <div>
                <h1 class="sf-title">Staff Portal</h1>
                <p class="sf-subtitle">Manage your service queue and update repair status.</p>
            </div>
            <div>
                <span class="sf-badge">
                    <span class="sf-dot"></span>
                    System Online
                </span>
            </div>
        </div>

        {{-- Dashboard Cards Grid --}}
        <div class="sf-cards">
            {{-- Card 1: Total Assigned --}}
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <h3 class="sf-card-value">{{ $stats['total'] }}</h3>
                <p class="sf-card-label">Total Assigned</p>
            </div>

            {{-- Card 2: Awaiting Acceptance --}}
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-yellow">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="sf-card-value">{{ $stats['assigned'] }}</h3>
                <p class="sf-card-label">Awaiting Acceptance</p>
            </div>

            {{-- Card 3: In Progress --}}
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <h3 class="sf-card-value">{{ $stats['in_progress'] }}</h3>
                <p class="sf-card-label">Active Jobs</p>
            </div>

            {{-- Card 4: Assigned Rentals --}}
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="sf-card-value">{{ $stats['assigned_rentals'] }}</h3>
                <p class="sf-card-label">Assigned Rentals</p>
            </div>

            {{-- Card 5: Ready for Pickup Rentals --}}
            <div class="sf-card">
                <div class="sf-card-icon sf-icon-green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="sf-card-value">{{ $stats['ready_pickup_rentals'] }}</h3>
                <p class="sf-card-label">Rentals Ready for Pickup</p>
            </div>
        </div>

        {{-- Recent Work (Bookings + Rentals) --}}
        <div class="sf-work">
            <div class="sf-work-head">
                <h2 class="sf-work-title">Recent Work</h2>
                <span class="sf-work-date">{{ date('l, F j, Y') }}</span>
            </div>
            <div>
                @forelse($recentWork as $item)
                    <div class="sf-work-item">
                        <div class="sf-work-left">
                            <div class="sf-chip {{ $item['type'] === 'rental' ? 'sf-chip-rental' : 'sf-chip-booking' }}">
                                <span class="sf-chip-date">
                                    {{ $item['date_label'] }}
                                </span>
                                <span class="sf-chip-time">
                                    {{ $item['time_label'] }}
                                </span>
                            </div>
                            <div>
                                <h3 class="sf-item-title">
                                    {{ $item['title'] }}
                                    <span class="sf-item-type {{ $item['type'] === 'rental' ? 'sf-type-rental' : 'sf-type-booking' }}">({{ $item['type'] }})</span>
                                </h3>
                                <p class="sf-item-subtitle">{{ $item['subtitle'] }}</p>
                            </div>
                        </div>
                        <div class="sf-work-right">
                            @php
                                $statusClasses = [
                                    'Assigned' => 'sf-status-warning',
                                    'Customer Accepted' => 'sf-status-cyan',
                                    'In Progress' => 'sf-status-info',
                                    'Waiting for Parts' => 'sf-status-purple',
                                    'Completed' => 'sf-status-success',
                                    'Ready for Pickup' => 'sf-status-warning',
                                    'Picked Up' => 'sf-status-info',
                                    'In Use' => 'sf-status-indigo',
                                    'Returned' => 'sf-status-success',
                                ];
                                $statusClass = $statusClasses[$item['status']] ?? 'sf-status-neutral';
                            @endphp
                            <span class="sf-status {{ $statusClass }}">
                                {{ $item['status'] }}
                            </span>
                            <a href="{{ $item['action_url'] }}" class="sf-action">
                                {{ $item['action_label'] }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="sf-work-empty">
                        <h3>No Assigned Work Yet</h3>
                        <p>You don't have any bookings or rentals assigned right now.</p>
                    </div>
                @endforelse
            </div>
            <div class="sf-work-footer">
                <a href="{{ route('staff.bookings') }}" class="sf-link">View All Bookings &rarr;</a>
                <a href="{{ route('staff.rentals.index') }}" class="sf-link">View All Rentals &rarr;</a>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const userId = @json((int) $user->id);
        let reloadTimer = null;

        const scheduleReload = () => {
            if (reloadTimer) {
                return;
            }

            reloadTimer = setTimeout(() => {
                window.location.reload();
            }, 1200);
        };

        if (window.realtime) {
            window.realtime.subscribeDashboard('staff', userId, {
                serviceStatus: scheduleReload,
                rentalStatus: scheduleReload,
            });
        }
    });
</script>
@endpush
