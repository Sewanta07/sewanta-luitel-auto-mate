<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Support\Realtime\ConversationChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageMonitorController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('messages as m')
            ->join('users as sender', 'sender.id', '=', 'm.sender_id')
            ->join('users as receiver', 'receiver.id', '=', 'm.receiver_id')
            ->where(function ($q) {
                $q->where(function ($qq) {
                    $qq->where('sender.role', 'customer')->where('receiver.role', 'staff');
                })->orWhere(function ($qq) {
                    $qq->where('sender.role', 'staff')->where('receiver.role', 'customer');
                });
            })
            ->selectRaw("\n                CASE WHEN sender.role = 'customer' THEN m.sender_id ELSE m.receiver_id END as customer_id,\n                CASE WHEN sender.role = 'staff' THEN m.sender_id ELSE m.receiver_id END as staff_id,\n                MAX(m.created_at) as last_message_at,\n                COUNT(*) as total_messages,\n                SUM(CASE WHEN m.is_read = 0 THEN 1 ELSE 0 END) as unread_count\n            ")
            ->groupByRaw("\n                CASE WHEN sender.role = 'customer' THEN m.sender_id ELSE m.receiver_id END,\n                CASE WHEN sender.role = 'staff' THEN m.sender_id ELSE m.receiver_id END\n            ")
            ->orderByDesc('last_message_at');

        if ($request->filled('date_from')) {
            $query->whereDate('m.created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('m.created_at', '<=', $request->date_to);
        }

        $conversations = $query->paginate(20)->withQueryString();

        $customerIds = $conversations->pluck('customer_id')->unique()->values();
        $staffIds = $conversations->pluck('staff_id')->unique()->values();

        $users = User::query()
            ->whereIn('id', $customerIds->merge($staffIds)->unique()->values())
            ->get()
            ->keyBy('id');

        $lastMessages = collect();
        if ($conversations->isNotEmpty()) {
            $lastMessages = Message::query()
                ->where(function ($q) use ($conversations) {
                    foreach ($conversations as $conversation) {
                        $q->orWhere(function ($qq) use ($conversation) {
                            $qq->where('sender_id', $conversation->customer_id)
                                ->where('receiver_id', $conversation->staff_id);
                        })->orWhere(function ($qq) use ($conversation) {
                            $qq->where('sender_id', $conversation->staff_id)
                                ->where('receiver_id', $conversation->customer_id);
                        });
                    }
                })
                ->orderByDesc('created_at')
                ->get()
                ->groupBy(function ($message) {
                    $pair = [(int) $message->sender_id, (int) $message->receiver_id];
                    sort($pair);

                    return implode('-', $pair);
                })
                ->map(fn ($items) => $items->first());
        }

        return view('admin.messages', [
            'conversations' => $conversations,
            'users' => $users,
            'lastMessages' => $lastMessages,
        ]);
    }

    public function show(User $customer, User $staff, Request $request)
    {
        abort_if($customer->role !== 'customer' || $staff->role !== 'staff', 404);

        $conversationList = DB::table('messages as m')
            ->join('users as sender', 'sender.id', '=', 'm.sender_id')
            ->join('users as receiver', 'receiver.id', '=', 'm.receiver_id')
            ->where(function ($q) {
                $q->where(function ($qq) {
                    $qq->where('sender.role', 'customer')->where('receiver.role', 'staff');
                })->orWhere(function ($qq) {
                    $qq->where('sender.role', 'staff')->where('receiver.role', 'customer');
                });
            })
            ->selectRaw("\n                CASE WHEN sender.role = 'customer' THEN m.sender_id ELSE m.receiver_id END as customer_id,\n                CASE WHEN sender.role = 'staff' THEN m.sender_id ELSE m.receiver_id END as staff_id,\n                MAX(m.created_at) as last_message_at,\n                COUNT(*) as total_messages,\n                SUM(CASE WHEN m.is_read = 0 THEN 1 ELSE 0 END) as unread_count\n            ")
            ->groupByRaw("\n                CASE WHEN sender.role = 'customer' THEN m.sender_id ELSE m.receiver_id END,\n                CASE WHEN sender.role = 'staff' THEN m.sender_id ELSE m.receiver_id END\n            ")
            ->orderByDesc('last_message_at')
            ->limit(100)
            ->get();

        $customerIds = $conversationList->pluck('customer_id')->unique()->values();
        $staffIds = $conversationList->pluck('staff_id')->unique()->values();

        $users = User::query()
            ->whereIn('id', $customerIds->merge($staffIds)->unique()->values())
            ->get()
            ->keyBy('id');

        $lastMessages = collect();
        if ($conversationList->isNotEmpty()) {
            $lastMessages = Message::query()
                ->where(function ($q) use ($conversationList) {
                    foreach ($conversationList as $conversation) {
                        $q->orWhere(function ($qq) use ($conversation) {
                            $qq->where('sender_id', $conversation->customer_id)
                                ->where('receiver_id', $conversation->staff_id);
                        })->orWhere(function ($qq) use ($conversation) {
                            $qq->where('sender_id', $conversation->staff_id)
                                ->where('receiver_id', $conversation->customer_id);
                        });
                    }
                })
                ->orderByDesc('created_at')
                ->get()
                ->groupBy(function ($message) {
                    $pair = [(int) $message->sender_id, (int) $message->receiver_id];
                    sort($pair);

                    return implode('-', $pair);
                })
                ->map(fn ($items) => $items->first());
        }

        $messages = Message::query()
            ->with(['sender', 'receiver'])
            ->where(function ($q) use ($customer, $staff) {
                $q->where('sender_id', $customer->id)
                    ->where('receiver_id', $staff->id);
            })
            ->orWhere(function ($q) use ($customer, $staff) {
                $q->where('sender_id', $staff->id)
                    ->where('receiver_id', $customer->id);
            })
            ->when($request->filled('date_from'), function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->filled('date_to'), function ($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->date_to);
            })
            ->orderByDesc('created_at')
            ->paginate(100)
            ->withQueryString();

        $conversationId = ConversationChannel::fromUserIds((int) $customer->id, (int) $staff->id);

        return view('admin.messages-conversation', [
            'customer' => $customer,
            'staff' => $staff,
            'conversationList' => $conversationList,
            'users' => $users,
            'lastMessages' => $lastMessages,
            'messages' => $messages,
            'conversationId' => $conversationId,
        ]);
    }
}
