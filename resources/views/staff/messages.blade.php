@extends('layouts.app')

@section('title', 'Staff Messages')

@section('content')
@include('components.staff-navbar')

<div class="sf-msg-page">
    <div class="sf-msg-main">
        <div class="sf-msg-head">
            <h1 class="sf-msg-title">Messages</h1>
            <p class="sf-msg-subtitle">Connect with your customers</p>
        </div>

        @if(session('success'))
            <div class="sf-msg-flash-success">
                <svg class="sf-msg-flash-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="sf-msg-layout">
            <div class="sf-msg-sidebar-col">
                <div class="sf-msg-sidebar">
                    <div class="sf-msg-sidebar-head">
                        <h2 class="sf-msg-sidebar-title">Conversations</h2>
                    </div>

                    <div class="sf-msg-conversation-list">
                        @forelse($customers as $c)
                            <a href="{{ route('staff.customers.messages', ['customer' => $c->id, 'open' => 1]) }}" class="sf-msg-conversation-item {{ $customer && $customer->id === $c->id ? 'sf-msg-conversation-active' : '' }}">
                                <div class="sf-msg-conversation-row">
                                    <div class="sf-msg-conversation-avatar">
                                        {{ strtoupper(substr($c->name ?? $c->email ?? 'C', 0, 1)) }}
                                    </div>
                                    <div class="sf-msg-conversation-meta">
                                        <p class="sf-msg-conversation-name">{{ $c->name ?? 'Customer' }}</p>
                                        <p class="sf-msg-conversation-email">{{ $c->email }}</p>
                                    </div>
                                    @if(isset($c->unread_count) && $c->unread_count > 0)
                                        <span class="sf-msg-unread-badge">{{ $c->unread_count }}</span>
                                    @endif
                                </div>
                            </a>
                        @empty
                            <div class="sf-msg-conversation-empty">
                                <svg class="sf-msg-empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <p class="sf-msg-empty-title">No conversations yet</p>
                                <p class="sf-msg-empty-copy">Messages from customers will appear here</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="sf-msg-chat-col">
                <div class="sf-msg-chat-shell">
                    <div class="sf-msg-chat-head">
                        @if($customer)
                            <div class="sf-msg-chat-customer">
                                <div class="sf-msg-chat-avatar">
                                    {{ strtoupper(substr($customer->name ?? 'C', 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="sf-msg-chat-name">{{ $customer->name }}</h3>
                                    <p class="sf-msg-chat-email">{{ $customer->email }}</p>
                                </div>
                            </div>
                        @else
                            <div>
                                <h3 class="sf-msg-chat-name">Messages</h3>
                                <p class="sf-msg-chat-email">No customer conversations available yet.</p>
                            </div>
                        @endif
                    </div>
                    @if($customer && $bookings->count() > 0)
                        <div class="sf-msg-bookings-strip">
                        <p class="sf-msg-bookings-title">Related Bookings</p>
                            <div class="sf-msg-bookings-list">
                                @foreach($bookings as $booking)
                                    <a href="{{ route('staff.services.show', $booking->id) }}" class="sf-msg-booking-chip">
                                        {{ $booking->booking_code }} - {{ $booking->service_type }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($customer)
                        <div class="sf-msg-messages" id="messages-container">
                            @forelse($messages as $message)
                                @php
                                    $isSender = (int) $message->sender_id === (int) $staffChatUserId;
                                @endphp
                                <div class="sf-msg-row {{ $isSender ? 'sf-msg-row-sender' : 'sf-msg-row-receiver' }}" data-message-id="{{ (int) $message->id }}">
                                    <div class="sf-msg-bubble-wrap">
                                        <p class="sf-msg-sender {{ $isSender ? 'sf-msg-sender-self' : 'sf-msg-sender-other' }}">
                                            {{ $isSender ? 'You' : $customer->name }}
                                        </p>
                                        <div class="sf-msg-bubble {{ $isSender ? 'sf-msg-bubble-self' : 'sf-msg-bubble-other' }}">
                                            <p class="sf-msg-bubble-text">{{ $message->message }}</p>
                                            <p class="sf-msg-time {{ $isSender ? 'sf-msg-time-self' : 'sf-msg-time-other' }}">
                                                {{ $message->created_at->format('M d, g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="sf-msg-empty-chat">
                                    <p>No messages yet. Start the conversation!</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="sf-msg-compose">
                            <form id="staffMessageForm" action="{{ route('staff.customers.sendMessage', $customer->id) }}" method="POST" class="sf-msg-compose-form">
                                @csrf
                                <div class="sf-msg-compose-input-wrap">
                                    <textarea id="staffMessageInput" name="message" rows="2" required placeholder="Type your message..." class="sf-msg-compose-input"></textarea>
                                </div>
                                <button type="submit" class="sf-msg-send-btn">
                                    <svg class="sf-msg-send-icon" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"/>
                                    </svg>
                                    Send
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="sf-msg-messages">
                            <div class="sf-msg-empty-chat">
                                <p>No assigned customers yet. Conversations will appear here once bookings are assigned.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('messages-container');
        if (container) {
            container.scrollTop = container.scrollHeight;
        }

        const conversationId = @json($conversationId);
        const currentUserId = @json((int) $staffChatUserId);
        const receiverId = @json($customerChatUserId ? (int) $customerChatUserId : null);
        const currentUserName = 'You';
        const otherUserName = @json($customer->name ?? 'Customer');
        const form = document.getElementById('staffMessageForm');
        const messageInput = document.getElementById('staffMessageInput');

        const formatDate = (value) => {
            if (!value) {
                return '';
            }

            const date = new Date(value);
            if (Number.isNaN(date.getTime())) {
                return '';
            }

            return date.toLocaleString(undefined, {
                month: 'short',
                day: '2-digit',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true,
                timeZone: 'Asia/Kathmandu',
            });
        };

        const appendMessage = (payload) => {
            if (!container || !payload || !payload.id) {
                return;
            }

            if (document.querySelector(`[data-message-id="${payload.id}"]`)) {
                return;
            }

            const isSender = Number(payload.sender_id) === Number(currentUserId);

            const wrapper = document.createElement('div');
            wrapper.className = `sf-msg-row ${isSender ? 'sf-msg-row-sender' : 'sf-msg-row-receiver'}`;
            wrapper.dataset.messageId = String(payload.id);

            const senderLabel = isSender ? currentUserName : otherUserName;
            const bubbleClass = isSender ? 'sf-msg-bubble sf-msg-bubble-self' : 'sf-msg-bubble sf-msg-bubble-other';
            const timeClass = isSender ? 'sf-msg-time sf-msg-time-self' : 'sf-msg-time sf-msg-time-other';
            const nameClass = isSender ? 'sf-msg-sender sf-msg-sender-self' : 'sf-msg-sender sf-msg-sender-other';

            wrapper.innerHTML = `
                <div class="sf-msg-bubble-wrap">
                    <p class="${nameClass}">${senderLabel}</p>
                    <div class="${bubbleClass}">
                        <p class="sf-msg-bubble-text"></p>
                        <p class="${timeClass}">${formatDate(payload.created_at)}</p>
                    </div>
                </div>
            `;

            wrapper.querySelector('.sf-msg-bubble-text').textContent = payload.message ?? '';
            container.appendChild(wrapper);
            container.scrollTop = container.scrollHeight;
        };

        if (conversationId && window.realtime) {
            window.realtime.subscribeChat(conversationId, {
                message: (payload) => {
                    if (!payload) {
                        return;
                    }

                    if (Number(payload.sender_id) === Number(currentUserId)) {
                        return;
                    }

                    appendMessage(payload);
                },
            });
        }

        if (form) {
            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                const messageText = (messageInput?.value ?? '').trim();
                if (!messageText) {
                    return;
                }

                if (messageInput) {
                    messageInput.value = '';
                }

                try {
                    const response = await window.axios.post(form.action, {
                        message: messageText,
                    });

                    appendMessage(response.data?.message);
                } catch (error) {
                    console.error(error);
                }
            });
        }
    });
</script>
@endsection
