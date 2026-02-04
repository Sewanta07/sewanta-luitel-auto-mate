@extends('layouts.app')

@section('title', 'Message Monitoring')

@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
    {{-- Sidebar --}}
    <aside class="w-64 flex-shrink-0 z-30">
        @include('components.admin-sidebar')
    </aside>

    {{-- Main Content --}}
    <div class="flex-1 flex flex-col overflow-y-auto bg-gray-50 h-full w-full">
        <main class="max-w-7xl w-full mx-auto p-6">
            <div class="flex items-center justify-between mb-6 mt-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Message Monitoring</h1>
                    <p class="text-gray-500 mt-1">Monitor all staff-customer communications</p>
                </div>
            </div>

            {{-- Filters --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-6">
                <form method="GET" action="{{ route('admin.messages') }}" class="flex gap-4 items-end">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Booking</label>
                        <select name="booking_id" class="w-full rounded-lg border-gray-200">
                            <option value="">All bookings</option>
                            @foreach($bookings as $booking)
                                <option value="{{ $booking->id }}" {{ request('booking_id') == $booking->id ? 'selected' : '' }}>
                                    {{ $booking->booking_code }} - {{ $booking->service_type }}
                                </option>
                            @endforeach
                        </select>
                    </div>
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
                    <a href="{{ route('admin.messages') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200">
                        Reset
                    </a>
                </form>
            </div>

            {{-- Messages Table --}}
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-xs uppercase tracking-widest text-gray-400">
                            <tr>
                                <th class="px-6 py-3">Date/Time</th>
                                <th class="px-6 py-3">From</th>
                                <th class="px-6 py-3">To</th>
                                <th class="px-6 py-3">Message</th>
                                <th class="px-6 py-3">Booking</th>
                                <th class="px-6 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($messages as $message)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $message->created_at->format('M d, Y') }}<br/>
                                        <span class="text-xs text-gray-400">{{ $message->created_at->format('h:i A') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs mr-2">
                                                {{ strtoupper(substr($message->sender->name ?? 'U', 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $message->sender->name ?? 'Unknown' }}</p>
                                                <p class="text-xs text-gray-500">{{ class_basename($message->sender_type) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-orange-100 flex items-center justify-center text-orange-600 font-bold text-xs mr-2">
                                                {{ strtoupper(substr($message->receiver->name ?? 'U', 0, 2)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $message->receiver->name ?? 'Unknown' }}</p>
                                                <p class="text-xs text-gray-500">{{ class_basename($message->receiver_type) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 max-w-md">
                                        <p class="text-sm text-gray-900 truncate">{{ $message->message }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        @if($message->booking)
                                            <a href="{{ route('bookings.show', $message->booking->id) }}" class="text-[#ff5a1f] hover:underline">
                                                {{ $message->booking->booking_code }}
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($message->is_read)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Read
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Unread
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                        No messages found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
@endsection
