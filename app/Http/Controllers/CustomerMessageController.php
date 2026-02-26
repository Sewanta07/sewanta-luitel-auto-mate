<?php

namespace App\Http\Controllers;

use App\Events\MessageReadUpdated;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\StaffMember;
use App\Support\Realtime\ChatUserResolver;
use App\Support\Realtime\ConversationChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerMessageController extends Controller
{
    public function index()
    {
        $customer = Auth::user();
        $customerUser = ChatUserResolver::forAuthenticated();

        abort_unless((bool) $customerUser, 401);

        $staffMembers = StaffMember::where('status', 'active')->orderBy('name')->get();

        return view('customer.messages', [
            'staffMembers' => $staffMembers,
            'selectedStaff' => null,
            'messages' => collect(),
            'customer' => $customer,
            'customerChatUserId' => $customerUser->id,
        ]);
    }

    public function show(StaffMember $staff)
    {
        $customer = Auth::user();
        $customerUser = ChatUserResolver::forAuthenticated();
        abort_unless((bool) $customerUser, 401);

        $staffUser = ChatUserResolver::fromAuthenticatable($staff);
        $conversationId = ConversationChannel::fromUserIds($customerUser->id, $staffUser->id);

        $messages = Message::query()
            ->where(function ($query) use ($customerUser, $staffUser) {
                $query->where('sender_id', $customerUser->id)
                    ->where('receiver_id', $staffUser->id);
            })
            ->orWhere(function ($query) use ($customerUser, $staffUser) {
                $query->where('sender_id', $staffUser->id)
                    ->where('receiver_id', $customerUser->id);
            })
            ->orderBy('created_at')
            ->get();

        $messageIdsMarkedRead = Message::query()
            ->where('sender_id', $staffUser->id)
            ->where('receiver_id', $customerUser->id)
            ->where('is_read', false)
            ->pluck('id')
            ->all();

        if (!empty($messageIdsMarkedRead)) {
            Message::query()->whereIn('id', $messageIdsMarkedRead)->update(['is_read' => true]);

            try {
                event(new MessageReadUpdated(
                    $conversationId,
                    array_map('intval', $messageIdsMarkedRead),
                    $customerUser->id,
                    now()->toISOString()
                ));
            } catch (\Throwable $exception) {
                Log::warning('Message read broadcast skipped', [
                    'conversation_id' => $conversationId,
                    'reader_id' => $customerUser->id,
                    'error' => $exception->getMessage(),
                ]);
            }
        }

        $staffMembers = StaffMember::where('status', 'active')->orderBy('name')->get();

        return view('customer.messages', [
            'staffMembers' => $staffMembers,
            'selectedStaff' => $staff,
            'messages' => $messages,
            'customer' => $customer,
            'customerChatUserId' => $customerUser->id,
            'selectedStaffChatUserId' => $staffUser->id,
            'conversationId' => $conversationId,
        ]);
    }

    public function send(StaffMember $staff, Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $sender = ChatUserResolver::forAuthenticated();
        abort_unless((bool) $sender, 401);

        $receiver = ChatUserResolver::fromAuthenticatable($staff);

        $message = Message::create([
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'message' => $validated['message'],
            'is_read' => false
        ]);

        $conversationId = ConversationChannel::fromUserIds($sender->id, $receiver->id);

        try {
            event(new MessageSent($message, $conversationId));
        } catch (\Throwable $exception) {
            Log::warning('Message sent broadcast skipped', [
                'conversation_id' => $conversationId,
                'message_id' => (int) $message->id,
                'error' => $exception->getMessage(),
            ]);
        }

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'ok' => true,
                'message' => [
                    'id' => (int) $message->id,
                    'sender_id' => (int) $message->sender_id,
                    'receiver_id' => (int) $message->receiver_id,
                    'message' => $message->message,
                    'is_read' => (bool) $message->is_read,
                    'created_at' => optional($message->created_at)?->toISOString(),
                ],
            ]);
        }

        return redirect()->route('customer.messages.show', $staff->id)->with('success', 'Message sent successfully');
    }
}
