@extends('layouts.admin')

@section('title', 'Conversation Monitoring')

@section('content')
<main class="ad-msgc-main">
            <div class="ad-msgc-head">
                <h1 class="ad-msgc-title">Conversation Monitoring</h1>
                <p class="ad-msgc-subtitle">Read-only view of customer and staff chat</p>
            </div>

            <div class="ad-msgc-filter-card">
                <form method="GET" action="{{ route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id]) }}" class="ad-msgc-filter-form">
                    <div class="ad-msgc-field">
                        <label class="ad-msgc-label">From Date</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="ad-msgc-input" />
                    </div>
                    <div class="ad-msgc-field">
                        <label class="ad-msgc-label">To Date</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="ad-msgc-input" />
                    </div>
                    <button type="submit" class="ad-msgc-btn ad-msgc-btn-primary">Filter</button>
                    <a href="{{ route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id]) }}" class="ad-msgc-btn ad-msgc-btn-muted">Reset</a>
                    <a href="{{ route('admin.messages') }}" class="ad-msgc-btn ad-msgc-btn-muted">Back</a>
                </form>
            </div>

            <div class="ad-msgc-grid">
                <div class="ad-msgc-list-col">
                    <div class="ad-msgc-list-card">
                        <div class="ad-msgc-list-head">
                            <h2 class="ad-msgc-list-title">Conversations</h2>
                        </div>

                        <div class="ad-msgc-list-body">
                            @forelse($conversationList as $conversation)
                                @php
                                    $listCustomer = $users[$conversation->customer_id] ?? null;
                                    $listStaff = $users[$conversation->staff_id] ?? null;
                                    $pair = [(int) $conversation->customer_id, (int) $conversation->staff_id];
                                    sort($pair);
                                    $lastMessage = $lastMessages->get(implode('-', $pair));
                                    $isActive = (int) $conversation->customer_id === (int) $customer->id && (int) $conversation->staff_id === (int) $staff->id;
                                @endphp
                                @if($listCustomer && $listStaff)
                                    <a href="{{ route('admin.messages.conversation', ['customer' => $listCustomer->id, 'staff' => $listStaff->id]) }}" class="ad-msgc-list-item {{ $isActive ? 'is-active' : '' }}">
                                        <div class="ad-msgc-list-row">
                                            <div class="ad-msgc-avatar ad-msgc-avatar-small">
                                                {{ strtoupper(substr($listCustomer->name ?? 'C', 0, 1)) }}
                                            </div>
                                            <div class="ad-msgc-list-content">
                                                <p class="ad-msgc-name">{{ $listCustomer->name }}</p>
                                                <p class="ad-msgc-with">with {{ $listStaff->name }}</p>
                                                <p class="ad-msgc-snippet">{{ $lastMessage?->message ?? 'No message preview' }}</p>
                                            </div>
                                            @if((int) $conversation->unread_count > 0)
                                                <span class="ad-msgc-unread">{{ (int) $conversation->unread_count }}</span>
                                            @endif
                                        </div>
                                    </a>
                                @endif
                            @empty
                                <div class="ad-msgc-empty">
                                    <p class="ad-msgc-empty-text">No conversations yet</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="ad-msgc-thread-col">
                    <div class="ad-msgc-thread-card">
                        <div class="ad-msgc-thread-head">
                            <div class="ad-msgc-thread-head-row">
                                <div class="ad-msgc-avatar ad-msgc-avatar-large ad-msgc-avatar-soft">
                                    {{ strtoupper(substr($customer->name ?? 'C', 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="ad-msgc-thread-title">{{ $customer->name }}</h3>
                                    <p class="ad-msgc-thread-subtitle">Customer ↔ {{ $staff->name }} (Staff)</p>
                                </div>
                            </div>
                        </div>

                        <div class="ad-msgc-thread-body" id="adminConversationContainer">
                            @forelse($messages as $message)
                                @php
                                    $isCustomer = (int) $message->sender_id === (int) $customer->id;
                                @endphp
                                <div class="ad-msgc-message-row {{ $isCustomer ? 'is-customer' : 'is-staff' }}" data-message-id="{{ (int) $message->id }}">
                                    <div class="ad-msgc-message-inner">
                                        <p class="ad-msgc-message-author {{ $isCustomer ? 'is-customer' : 'is-staff' }}">
                                            {{ $isCustomer ? $customer->name : $staff->name }}
                                        </p>
                                        <div class="ad-msgc-bubble {{ $isCustomer ? 'is-customer' : 'is-staff' }}">
                                            <p class="ad-msgc-message-text">{{ $message->message }}</p>
                                            <p class="ad-msgc-message-time {{ $isCustomer ? 'is-customer' : 'is-staff' }}">
                                                {{ $message->created_at->format('M d, g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="ad-msgc-thread-empty">
                                    <p>No messages found for this conversation</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="ad-msgc-thread-foot">
                            Monitoring mode: Admin can view messages only.
                        </div>
                    </div>
                </div>
            </div>

            @if($messages->hasPages())
                <div class="ad-msgc-pagination">
                    {{ $messages->links() }}
                </div>
            @endif
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('adminConversationContainer');
        const conversationId = @json($conversationId);
        const customerId = @json((int) $customer->id);
        const staffId = @json((int) $staff->id);
        const customerName = @json($customer->name);
        const staffName = @json($staff->name);

        const formatDate = (value) => {
            if (!value) {
                return '';
            }

            const date = new Date(value);
            if (Number.isNaN(date.getTime())) {
                return '';
            }

            return {
                day: date.toLocaleDateString(undefined, { month: 'short', day: '2-digit', year: 'numeric' }),
                time: date.toLocaleTimeString(undefined, { hour: '2-digit', minute: '2-digit', hour12: true }),
            };
        };

        const appendMessage = (payload) => {
            if (!container || !payload || !payload.id) {
                return;
            }

            if (document.querySelector(`[data-message-id="${payload.id}"]`)) {
                return;
            }

            const isCustomer = Number(payload.sender_id) === Number(customerId);
            const senderName = isCustomer ? customerName : staffName;
            const wrapperClass = isCustomer ? 'is-customer' : 'is-staff';
            const dateParts = formatDate(payload.created_at);

            const wrapper = document.createElement('div');
            wrapper.className = `ad-msgc-message-row ${wrapperClass}`;
            wrapper.dataset.messageId = String(payload.id);
            wrapper.innerHTML = `
                <div class="ad-msgc-message-inner">
                    <p class="ad-msgc-message-author ${wrapperClass}">${senderName}</p>
                    <div class="ad-msgc-bubble ${wrapperClass}">
                        <p class="ad-msgc-message-text"></p>
                        <p class="ad-msgc-message-time ${wrapperClass}">${dateParts.day ?? ''} ${dateParts.time ?? ''}</p>
                    </div>
                </div>
            `;

            const textNode = wrapper.querySelector('.ad-msgc-message-text');
            if (textNode) {
                textNode.textContent = payload.message ?? '';
            }

            container.appendChild(wrapper);
            container.scrollTop = container.scrollHeight;
        };

        if (window.realtime && conversationId) {
            window.realtime.subscribeChat(conversationId, {
                message: appendMessage,
            });
        }

        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    });
</script>
@endsection
