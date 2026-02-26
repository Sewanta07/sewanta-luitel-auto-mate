@extends('layouts.app')

@section('title', 'Conversation Monitoring')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
    <aside class="w-64 flex-shrink-0 z-30">
        @include('components.admin-sidebar')
    </aside>

    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-7xl w-full mx-auto p-6">
            <div class="flex items-center justify-between mb-6 mt-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Conversation Details</h1>
                    <p class="text-gray-500 mt-1">{{ $customer->name }} (Customer) ↔ {{ $staff->name }} (Staff)</p>
                </div>
                <a href="{{ route('admin.messages') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200">
                    Back to Conversations
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
                <form method="GET" action="{{ route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id]) }}" class="flex gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="rounded-lg border-gray-200" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="rounded-lg border-gray-200" />
                    </div>
                    <button type="submit" class="px-6 py-2 bg-[#ff5a1f] text-white rounded-lg font-medium hover:bg-[#e64b15]">
                        Filter
                    </button>
                    <a href="{{ route('admin.messages.conversation', ['customer' => $customer->id, 'staff' => $staff->id]) }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200">
                        Reset
                    </a>
                </form>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div id="adminConversationContainer" class="divide-y divide-gray-100 max-h-[65vh] overflow-y-auto">
                    @forelse($messages as $message)
                        @php
                            $isCustomer = (int) $message->sender_id === (int) $customer->id;
                        @endphp
                        <div class="p-4 {{ $isCustomer ? 'bg-blue-50/30' : 'bg-orange-50/30' }}">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $isCustomer ? $customer->name : $staff->name }}
                                        <span class="text-xs text-gray-500 font-medium">({{ $isCustomer ? 'Customer' : 'Staff' }})</span>
                                    </p>
                                    <p class="text-sm text-gray-700 mt-1 break-words">{{ $message->message }}</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="text-xs text-gray-500">{{ $message->created_at->format('M d, Y') }}</p>
                                    <p class="text-xs text-gray-400">{{ $message->created_at->format('h:i A') }}</p>
                                    <span class="inline-flex mt-2 items-center px-2 py-1 rounded-full text-xs font-medium {{ $message->is_read ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $message->is_read ? 'Read' : 'Unread' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center text-gray-500">
                            No messages found for this conversation
                        </div>
                    @endforelse
                </div>

                @if($messages->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $messages->links() }}
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>

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

        const prependMessage = (payload) => {
            if (!container || !payload || !payload.id) {
                return;
            }

            if (document.querySelector(`[data-message-id="${payload.id}"]`)) {
                return;
            }

            const isCustomer = Number(payload.sender_id) === Number(customerId);
            const senderName = isCustomer ? customerName : staffName;
            const senderRole = isCustomer ? 'Customer' : 'Staff';
            const itemClass = isCustomer ? 'bg-blue-50/30' : 'bg-orange-50/30';
            const badgeClass = payload.is_read ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700';
            const dateParts = formatDate(payload.created_at);

            const wrapper = document.createElement('div');
            wrapper.className = `p-4 ${itemClass}`;
            wrapper.dataset.messageId = String(payload.id);
            wrapper.innerHTML = `
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">
                            ${senderName}
                            <span class="text-xs text-gray-500 font-medium">(${senderRole})</span>
                        </p>
                        <p class="text-sm text-gray-700 mt-1 break-words"></p>
                    </div>
                    <div class="text-right shrink-0">
                        <p class="text-xs text-gray-500">${dateParts.day ?? ''}</p>
                        <p class="text-xs text-gray-400">${dateParts.time ?? ''}</p>
                        <span class="inline-flex mt-2 items-center px-2 py-1 rounded-full text-xs font-medium ${badgeClass}">${payload.is_read ? 'Read' : 'Unread'}</span>
                    </div>
                </div>
            `;

            const textNode = wrapper.querySelector('.break-words');
            if (textNode) {
                textNode.textContent = payload.message ?? '';
            }

            container.prepend(wrapper);
        };

        if (window.realtime && conversationId) {
            window.realtime.subscribeChat(conversationId, {
                message: prependMessage,
            });
        }
    });
</script>
@endsection
