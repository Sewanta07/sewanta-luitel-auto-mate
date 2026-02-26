@extends('layouts.app')

@section('title', 'Staff Messages')

@section('content')
@include('components.staff-navbar')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Messages</h1>
            <p class="text-gray-600 mt-2">Connect with your customers</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center text-green-700 font-medium">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white">
                        <h2 class="text-xl font-bold text-white">Conversations</h2>
                    </div>

                    <div class="divide-y max-h-96 overflow-y-auto bg-white">
                        @forelse($customers as $c)
                            <a href="{{ route('staff.customers.messages', $c->id) }}" class="conversation-link block p-4 transition-all border-l-4 text-gray-900 {{ $customer->id === $c->id ? 'border-[#ff5a1f] bg-orange-50 shadow-md' : 'border-transparent hover:bg-gray-50' }}">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-full bg-[#ff5a1f] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($c->name ?? $c->email ?? 'C', 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-gray-900 truncate">{{ $c->name ?? 'Customer' }}</p>
                                        <p class="text-xs text-gray-700 truncate mt-0.5">{{ $c->email }}</p>
                                    </div>
                                    @if(isset($c->unread_count) && $c->unread_count > 0)
                                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full flex-shrink-0">{{ $c->unread_count }}</span>
                                    @endif
                                </div>
                            </a>
                        @empty
                            <div class="p-8 text-center text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <p class="font-medium">No conversations yet</p>
                                <p class="text-xs mt-1">Messages from customers will appear here</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col h-full" style="max-height: 650px;">
                    <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white border-b">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($customer->name ?? 'C', 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">{{ $customer->name }}</h3>
                                <p class="text-orange-100 text-sm">{{ $customer->email }}</p>
                            </div>
                        </div>
                    </div>

                    @if($bookings->count() > 0)
                        <div class="p-4 bg-gray-50 border-b border-gray-100">
                        <p class="text-xs uppercase tracking-wide text-gray-700 font-bold mb-2">Related Bookings</p>
                            <div class="flex gap-2 flex-wrap">
                                @foreach($bookings as $booking)
                                    <a href="{{ route('staff.services.show', $booking->id) }}" class="booking-link inline-flex items-center px-3 py-1 rounded-full text-xs font-medium text-gray-900 bg-white border border-gray-200 hover:border-[#ff5a1f] hover:text-[#ff5a1f] transition">
                                        {{ $booking->booking_code }} - {{ $booking->service_type }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex-1 p-6 overflow-y-auto bg-gray-50" id="messages-container">
                        @forelse($messages as $message)
                            @php
                                $isSender = (int) $message->sender_id === (int) $staffChatUserId;
                            @endphp
                            <div class="mb-4 flex {{ $isSender ? 'justify-end' : 'justify-start' }}" data-message-id="{{ (int) $message->id }}">
                                <div class="max-w-xs lg:max-w-md">
                                    <p class="text-xs font-semibold mb-1.5 {{ $isSender ? 'text-[#ff5a1f] text-right' : 'text-gray-900' }}">
                                        {{ $isSender ? 'You' : $customer->name }}
                                    </p>
                                    <div class="px-4 py-3 rounded-2xl {{ $isSender ? 'bg-[#ff5a1f] text-white rounded-br-none' : 'bg-gray-200 text-gray-900 rounded-bl-none' }}">
                                        <p class="break-words">{{ $message->message }}</p>
                                        <p class="text-xs mt-2 {{ $isSender ? 'text-orange-50' : 'text-gray-700' }}">
                                            {{ $message->created_at->format('M d, g:i A') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="h-full flex items-center justify-center text-gray-500">
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="p-6 border-t bg-white">
                        <form id="staffMessageForm" action="{{ route('staff.customers.sendMessage', $customer->id) }}" method="POST" class="flex gap-3">
                            @csrf
                            <div class="flex-1">
                                <textarea id="staffMessageInput" name="message" rows="2" required placeholder="Type your message..." class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl text-gray-900 placeholder-gray-600 font-medium focus:border-[#ff5a1f] focus:ring focus:ring-orange-100 resize-none focus:outline-none transition-all"></textarea>
                            </div>
                            <button type="submit" class="px-6 py-3 bg-[#ff5a1f] text-white font-bold rounded-xl hover:bg-[#e44d18] transition-all flex items-center gap-2 self-end">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"/>
                                </svg>
                                Send
                            </button>
                        </form>
                    </div>
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
        const receiverId = @json((int) $customerChatUserId);
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
            wrapper.className = `mb-4 flex ${isSender ? 'justify-end' : 'justify-start'}`;
            wrapper.dataset.messageId = String(payload.id);

            const senderLabel = isSender ? currentUserName : otherUserName;
            const bubbleClass = isSender
                ? 'bg-[#ff5a1f] text-white rounded-br-none'
                : 'bg-gray-200 text-gray-900 rounded-bl-none';
            const timeClass = isSender ? 'text-orange-50' : 'text-gray-700';
            const nameClass = isSender ? 'text-[#ff5a1f] text-right' : 'text-gray-900';

            wrapper.innerHTML = `
                <div class="max-w-xs lg:max-w-md">
                    <p class="text-xs font-semibold mb-1.5 ${nameClass}">${senderLabel}</p>
                    <div class="px-4 py-3 rounded-2xl ${bubbleClass}">
                        <p class="break-words"></p>
                        <p class="text-xs mt-2 ${timeClass}">${formatDate(payload.created_at)}</p>
                    </div>
                </div>
            `;

            wrapper.querySelector('.break-words').textContent = payload.message ?? '';
            container.appendChild(wrapper);
            container.scrollTop = container.scrollHeight;
        };

        if (window.realtime) {
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

@push('styles')
<style>
    .conversation-link {
        color: #111827 !important;
        text-decoration: none !important;
    }
    
    .conversation-link:visited {
        color: #111827 !important;
    }
    
    .conversation-link:hover {
        color: #111827 !important;
    }
    
    .booking-link {
        color: #111827 !important;
        text-decoration: none !important;
    }
    
    .booking-link:hover {
        color: #ff5a1f !important;
    }
</style>
@endpush
