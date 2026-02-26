@extends('layouts.app')

@section('content')
@include('customer.navbar')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Messages</h1>
            <p class="text-gray-600 mt-2">Connect with our staff members</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Staff List Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500">
                        <h2 class="text-xl font-bold text-white">Conversations</h2>
                    </div>
                    
                    <div class="divide-y max-h-96 overflow-y-auto">
                        @forelse($staffMembers as $staff)
                            <a href="{{ route('customer.messages.show', $staff->id) }}" 
                               class="block p-4 hover:bg-orange-50 transition-colors border-l-4 {{ isset($selectedStaff) && $selectedStaff->id === $staff->id ? 'border-[#ff5a1f] bg-orange-50' : 'border-transparent' }}">
                          
                               <div class="flex items-start gap-3">
                                    @if($staff->profile_image)
                                        <img src="{{ asset('storage/' . $staff->profile_image) }}" 
                                             alt="{{ $staff->name }}"
                                             class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-[#ff5a1f] flex items-center justify-center text-white font-bold">
                                            {{ substr($staff->name, 0, 1) }}
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-gray-900 truncate">{{ $staff->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $staff->specialization ?? 'Staff Member' }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="p-6 text-center text-gray-500">
                                <p>No conversations yet</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Messages Display Area -->
            <div class="lg:col-span-2">
                @if(isset($selectedStaff))
                    @php
                        $conversationId = \App\Support\Realtime\ConversationChannel::fromParticipants(
                            get_class($customer),
                            (int) $customer->id,
                            \App\Models\StaffMember::class,
                            (int) $selectedStaff->id
                        );
                    @endphp
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col h-full" style="max-height: 600px;">
                        <!-- Header -->
                        <div class="p-6 bg-gradient-to-r from-[#ff5a1f] to-orange-500 text-white border-b">
                            <div class="flex items-center gap-3">
                                @if($selectedStaff->profile_image)
                                    <img src="{{ asset('storage/' . $selectedStaff->profile_image) }}" 
                                         alt="{{ $selectedStaff->name }}"
                                         class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center text-white font-bold text-lg">
                                        {{ substr($selectedStaff->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-bold text-lg">{{ $selectedStaff->name }}</h3>
                                    <p class="text-orange-100 text-sm">{{ $selectedStaff->specialization ?? 'Staff Member' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Messages Container -->
                        <div class="flex-1 p-6 overflow-y-auto bg-gray-50" id="messagesContainer">
                            @forelse($messages as $message)
                                <div class="mb-4 flex {{ $message->isSentByCustomer() ? 'justify-end' : 'justify-start' }}" data-message-id="{{ (int) $message->id }}">
                                    <div class="max-w-xs lg:max-w-md">
                                        <p class="text-[10px] font-black uppercase tracking-widest mb-1 {{ $message->isSentByCustomer() ? 'text-orange-400 text-right' : 'text-gray-400' }}">
                                            {{ $message->isSentByCustomer() ? ($customer->name ?? 'You') : ($selectedStaff->name ?? 'Staff') }}
                                        </p>
                                        <div class="px-4 py-3 rounded-2xl {{ $message->isSentByCustomer() ? 'bg-[#ff5a1f] text-white rounded-br-none' : 'bg-gray-200 text-gray-900 rounded-bl-none' }}">
                                            <p class="break-words">{{ $message->message ?? $message->content }}</p>
                                            <p class="text-xs mt-2 {{ $message->isSentByCustomer() ? 'text-orange-100' : 'text-gray-600' }}">
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

                        <!-- Message Input Form -->
                        <div class="p-6 border-t bg-white">
                            <form action="{{ route('customer.messages.send', $selectedStaff->id) }}" method="POST" class="flex gap-3">
                                @csrf
                                <div class="flex-1">
                                    <textarea name="message" 
                                              rows="2"
                                              placeholder="Type your message..." 
                                              class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#ff5a1f] focus:ring focus:ring-orange-100 resize-none focus:outline-none transition-all"
                                              required></textarea>
                                </div>
                                <button type="submit" 
                                        class="px-6 py-3 bg-[#ff5a1f] text-white font-bold rounded-xl hover:bg-[#e44d18] transition-all flex items-center gap-2 self-end">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5.951-1.429 5.951 1.429a1 1 0 001.169-1.409l-7-14z"/>
                                    </svg>
                                    Send
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-2xl shadow-lg p-12 flex items-center justify-center h-full">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-[#ff5a1f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No Conversation Selected</h3>
                            <p class="text-gray-600">Select a staff member from the left to start messaging</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const messagesContainer = document.getElementById('messagesContainer');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        @if(isset($selectedStaff))
        const conversationId = @json($conversationId);
        const currentUserId = @json((int) $customer->id);
        const currentUserType = @json(get_class($customer));
        const currentUserName = @json($customer->name ?? 'You');
        const otherUserName = @json($selectedStaff->name ?? 'Staff');

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
            });
        };

        const appendMessage = (payload) => {
            if (!messagesContainer || !payload || !payload.id) {
                return;
            }

            if (document.querySelector(`[data-message-id="${payload.id}"]`)) {
                return;
            }

            const isSentByCurrent = Number(payload.sender_id) === Number(currentUserId)
                && payload.sender_type === currentUserType;

            const wrapper = document.createElement('div');
            wrapper.className = `mb-4 flex ${isSentByCurrent ? 'justify-end' : 'justify-start'}`;
            wrapper.dataset.messageId = String(payload.id);

            const senderLabel = isSentByCurrent ? currentUserName : otherUserName;
            const bubbleClass = isSentByCurrent
                ? 'bg-[#ff5a1f] text-white rounded-br-none'
                : 'bg-gray-200 text-gray-900 rounded-bl-none';
            const timeClass = isSentByCurrent ? 'text-orange-100' : 'text-gray-600';
            const nameClass = isSentByCurrent ? 'text-orange-400 text-right' : 'text-gray-400';

            wrapper.innerHTML = `
                <div class="max-w-xs lg:max-w-md">
                    <p class="text-[10px] font-black uppercase tracking-widest mb-1 ${nameClass}">${senderLabel}</p>
                    <div class="px-4 py-3 rounded-2xl ${bubbleClass}">
                        <p class="break-words"></p>
                        <p class="text-xs mt-2 ${timeClass}">${formatDate(payload.created_at)}</p>
                    </div>
                </div>
            `;

            wrapper.querySelector('.break-words').textContent = payload.message ?? '';
            messagesContainer.appendChild(wrapper);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        };

        if (window.realtime) {
            window.realtime.subscribeChat(conversationId, {
                message: appendMessage,
            });
        }
        @endif
    });
</script>
@endsection
