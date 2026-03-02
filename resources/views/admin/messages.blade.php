@extends('layouts.admin')

@section('title', 'Message Monitoring')

@section('content')
<main class="ad-msg-main">
            <div class="ad-msg-head">
                <h1 class="ad-msg-title">Message Monitoring</h1>
                <p class="ad-msg-subtitle">Customer-staff conversations (read-only)</p>
            </div>

            <div class="ad-msg-filter-card">
                <form method="GET" action="{{ route('admin.messages') }}" class="ad-msg-filter-form">
                    <div class="ad-msg-field">
                        <label class="ad-msg-label">From Date</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="ad-msg-input" />
                    </div>
                    <div class="ad-msg-field">
                        <label class="ad-msg-label">To Date</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="ad-msg-input" />
                    </div>
                    <button type="submit" class="ad-msg-btn ad-msg-btn-primary">Filter</button>
                    <a href="{{ route('admin.messages') }}" class="ad-msg-btn ad-msg-btn-muted">Reset</a>
                </form>
            </div>

            <div class="ad-msg-grid">
                <div class="ad-msg-conversations-col">
                    <div class="ad-msg-conversations-card">
                        <div class="ad-msg-conversations-head">
                            <h2 class="ad-msg-conversations-title">Conversations</h2>
                        </div>

                        <div class="ad-msg-conversations-list">
                            @forelse($conversations as $conversation)
                                @php
                                    $customer = $users[$conversation->customer_id] ?? null;
                                    $staff = $users[$conversation->staff_id] ?? null;
                                    $pair = [(int) $conversation->customer_id, (int) $conversation->staff_id];
                                    sort($pair);
                                    $lastMessage = $lastMessages->get(implode('-', $pair));
                                @endphp
                                @if($customer && $staff)
                                    <a href="{{ route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id]) }}" class="ad-msg-conversation-item">
                                        <div class="ad-msg-conversation-row">
                                            <div class="ad-msg-avatar">
                                                {{ strtoupper(substr($customer->name ?? 'C', 0, 1)) }}
                                            </div>
                                            <div class="ad-msg-conversation-content">
                                                <p class="ad-msg-customer-name">{{ $customer->name }}</p>
                                                <p class="ad-msg-staff-ref">with {{ $staff->name }}</p>
                                                <p class="ad-msg-preview">{{ $lastMessage?->message ?? 'No message preview' }}</p>
                                            </div>
                                            @if((int) $conversation->unread_count > 0)
                                                <span class="ad-msg-unread">{{ (int) $conversation->unread_count }}</span>
                                            @endif
                                        </div>
                                    </a>
                                @endif
                            @empty
                                <div class="ad-msg-empty">
                                    <p class="ad-msg-empty-text">No conversations yet</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="ad-msg-preview-col">
                    <div class="ad-msg-preview-card">
                        <div class="ad-msg-preview-inner">
                            <div class="ad-msg-preview-icon-wrap">
                                <svg class="ad-msg-preview-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <h3 class="ad-msg-preview-title">Select a Conversation</h3>
                            <p class="ad-msg-preview-note">Choose a thread from the left to monitor messages</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($conversations->hasPages())
                <div class="ad-msg-pagination">
                    {{ $conversations->links() }}
                </div>
            @endif
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let reloadTimer = null;

        const scheduleReload = () => {
            if (reloadTimer) {
                return;
            }

            reloadTimer = setTimeout(() => {
                window.location.reload();
            }, 700);
        };

        if (window.realtime) {
            window.realtime.subscribeDashboard('admin', null, {
                chatMessage: scheduleReload,
            });
        }
    });
</script>
@endsection
