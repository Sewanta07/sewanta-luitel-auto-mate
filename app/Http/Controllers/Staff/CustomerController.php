<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Events\MessageReadUpdated;
use App\Events\MessageSent;
use App\Models\CustomerUser;
use App\Models\Message;
use App\Models\User;
use App\Models\ServiceBooking;
use App\Support\Realtime\ChatUserResolver;
use App\Support\Realtime\ConversationChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index()
    {
        $staff = Auth::guard('staff')->user() ?? getAuthenticatedUser();
        abort_unless((bool) $staff, 401);
        $staffUser = ChatUserResolver::forAuthenticated();
        abort_unless((bool) $staffUser, 401);
        
        // Get all customers who have bookings assigned to this staff
        $customers = CustomerUser::whereHas('bookings', function($query) use ($staff) {
            $query->where('staff_id', $staff->id);
        })->with(['bookings' => function($query) use ($staff) {
            $query->where('staff_id', $staff->id)
                  ->orderBy('created_at', 'desc');
        }])->get();

        // Get unread message counts for each customer
        foreach ($customers as $customer) {
            $customerChatUser = User::where('email', $customer->email)->first();

            $customer->unread_count = ($staffUser && $customerChatUser)
                ? Message::where('sender_id', $customerChatUser->id)
                    ->where('receiver_id', $staffUser->id)
                    ->where('is_read', false)
                    ->count()
                : 0;
        }

        $firstCustomer = $customers->first();

        if ($firstCustomer) {
            return redirect()->route('staff.customers.messages', $firstCustomer->id);
        }

        return view('staff.messages', [
            'customer' => null,
            'customers' => $customers,
            'messages' => collect(),
            'bookings' => collect(),
            'staffChatUserId' => $staffUser->id,
            'customerChatUserId' => null,
            'conversationId' => null,
        ]);
    }

    public function messages(Request $request, $customerId)
    {
        $staff = Auth::guard('staff')->user() ?? getAuthenticatedUser();
        abort_unless((bool) $staff, 401);
        $staffUser = ChatUserResolver::forAuthenticated();
        abort_unless((bool) $staffUser, 401);
        $openConversation = $request->boolean('open');

        $customers = CustomerUser::where(function ($query) use ($staff) {
            $query->whereHas('bookings', function ($q) use ($staff) {
                $q->where('staff_id', $staff->id);
            });
        })->get();

        foreach ($customers as $c) {
            $customerChatUser = User::where('email', $c->email)->first();

            $c->unread_count = $customerChatUser
                ? Message::where('sender_id', $customerChatUser->id)
                    ->where('receiver_id', $staffUser->id)
                    ->where('is_read', false)
                    ->count()
                : 0;
        }

        if (!$openConversation) {
            return view('staff.messages', [
                'customer' => null,
                'customers' => $customers,
                'messages' => collect(),
                'bookings' => collect(),
                'staffChatUserId' => $staffUser->id,
                'customerChatUserId' => null,
                'conversationId' => null,
            ]);
        }

        $customer = CustomerUser::findOrFail($customerId);
        $customerUser = ChatUserResolver::fromAuthenticatable($customer);
        $conversationId = ConversationChannel::fromUserIds($staffUser->id, $customerUser->id);

        $bookings = ServiceBooking::where('customer_id', $customerId)
            ->where('staff_id', $staff->id)
            ->get();

        $messages = Message::query()
            ->where(function ($query) use ($staffUser, $customerUser) {
                $query->where('sender_id', $staffUser->id)
                    ->where('receiver_id', $customerUser->id);
            })
            ->orWhere(function ($query) use ($staffUser, $customerUser) {
                $query->where('sender_id', $customerUser->id)
                    ->where('receiver_id', $staffUser->id);
            })
            ->orderBy('created_at')
            ->get();

        $messageIdsMarkedRead = Message::query()
            ->where('sender_id', $customerUser->id)
            ->where('receiver_id', $staffUser->id)
            ->where('is_read', false)
            ->pluck('id')
            ->all();

        if (!empty($messageIdsMarkedRead)) {
            Message::query()->whereIn('id', $messageIdsMarkedRead)->update(['is_read' => true]);

            try {
                event(new MessageReadUpdated(
                    $conversationId,
                    array_map('intval', $messageIdsMarkedRead),
                    $staffUser->id,
                    now()->toISOString()
                ));
            } catch (\Throwable $exception) {
                Log::warning('Message read broadcast skipped', [
                    'conversation_id' => $conversationId,
                    'reader_id' => $staffUser->id,
                    'error' => $exception->getMessage(),
                ]);
            }
        }

        return view('staff.messages', [
            'customer' => $customer,
            'customers' => $customers,
            'messages' => $messages,
            'bookings' => $bookings,
            'staffChatUserId' => $staffUser->id,
            'customerChatUserId' => $customerUser->id,
            'conversationId' => $conversationId,
        ]);
    }

    public function sendMessage(Request $request, $customerId)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'service_booking_id' => 'nullable|exists:service_bookings,id',
        ]);

        $staff = ChatUserResolver::forAuthenticated();
        abort_unless((bool) $staff, 401);

        $customer = CustomerUser::findOrFail($customerId);
        $customerUser = ChatUserResolver::fromAuthenticatable($customer);

        $message = Message::create([
            'sender_id' => $staff->id,
            'receiver_id' => $customerUser->id,
            'message' => $request->message,
        ]);

        $conversationId = ConversationChannel::fromUserIds($staff->id, $customerUser->id);

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

        return redirect()->route('staff.customers.messages', ['customer' => $customerId, 'open' => 1])->with('success', 'Message sent successfully!');
    }
}
