<?php

namespace App\Http\Controllers;

use App\Events\MessageReadUpdated;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\StaffMember;
use App\Support\Realtime\ConversationChannel;
use Illuminate\Http\Request;
use Auth;

class CustomerMessageController extends Controller
{
    /**
     * Show customer messaging page
     */
    public function index()
    {
        $customer = Auth::user();
        
        // Get list of staff members customer has chatted with
        $staffMembers = StaffMember::with(['messages' => function ($query) use ($customer) {
            $query->where(function ($q) use ($customer) {
                $q->where('sender_type', 'App\Models\CustomerUser')
                  ->where('sender_id', $customer->id)
                  ->where('receiver_type', 'App\Models\StaffMember');
            })->orWhere(function ($q) use ($customer) {
                $q->where('receiver_type', 'App\Models\CustomerUser')
                  ->where('receiver_id', $customer->id)
                  ->where('sender_type', 'App\Models\StaffMember');
            });
        }])->whereHas('messages', function ($query) use ($customer) {
            $query->where(function ($q) use ($customer) {
                $q->where('sender_type', 'App\Models\CustomerUser')
                  ->where('sender_id', $customer->id);
            })->orWhere(function ($q) use ($customer) {
                $q->where('receiver_type', 'App\Models\CustomerUser')
                  ->where('receiver_id', $customer->id);
            });
        })->latest()->get();

        return view('customer.messages', [
            'staffMembers' => $staffMembers,
            'selectedStaff' => null,
            'customer' => $customer,
        ]);
    }

    /**
     * Show messages with specific staff member
     */
    public function show(StaffMember $staff)
    {
        $customer = Auth::user();
        $conversationId = ConversationChannel::fromParticipants(
            get_class($customer),
            (int) $customer->id,
            StaffMember::class,
            (int) $staff->id
        );
        
        // Get all messages between customer and this staff member
        $messages = Message::with('sender')->where(function ($query) use ($customer, $staff) {
            $query->where('sender_type', 'App\Models\CustomerUser')
                  ->where('sender_id', $customer->id)
                  ->where('receiver_type', 'App\Models\StaffMember')
                  ->where('receiver_id', $staff->id);
        })->orWhere(function ($query) use ($customer, $staff) {
            $query->where('sender_type', 'App\Models\StaffMember')
                  ->where('sender_id', $staff->id)
                  ->where('receiver_type', 'App\Models\CustomerUser')
                  ->where('receiver_id', $customer->id);
        })->orderBy('created_at')->get();

        // Mark messages as read
        $messageIdsMarkedRead = Message::where('receiver_type', 'App\Models\CustomerUser')
            ->where('receiver_id', $customer->id)
            ->where('sender_type', 'App\Models\StaffMember')
            ->where('sender_id', $staff->id)
            ->where('is_read', false)
            ->pluck('id')
            ->all();

        if (!empty($messageIdsMarkedRead)) {
            Message::whereIn('id', $messageIdsMarkedRead)
                ->update(['is_read' => true, 'read_at' => now()]);

            event(new MessageReadUpdated(
                $conversationId,
                array_map('intval', $messageIdsMarkedRead),
                get_class($customer),
                (int) $customer->id,
                now()->toISOString()
            ));
        }

        // Get list of all staff members customer has chatted with
        $staffMembers = StaffMember::with(['messages' => function ($query) use ($customer) {
            $query->where(function ($q) use ($customer) {
                $q->where('sender_type', 'App\Models\CustomerUser')
                  ->where('sender_id', $customer->id);
            })->orWhere(function ($q) use ($customer) {
                $q->where('receiver_type', 'App\Models\CustomerUser')
                  ->where('receiver_id', $customer->id);
            });
        }])->whereHas('messages', function ($query) use ($customer) {
            $query->where(function ($q) use ($customer) {
                $q->where('sender_type', 'App\Models\CustomerUser')
                  ->where('sender_id', $customer->id);
            })->orWhere(function ($q) use ($customer) {
                $q->where('receiver_type', 'App\Models\CustomerUser')
                  ->where('receiver_id', $customer->id);
            });
        })->latest()->get();

        return view('customer.messages', [
            'staffMembers' => $staffMembers,
            'selectedStaff' => $staff,
            'messages' => $messages,
            'customer' => $customer,
        ]);
    }

    /**
     * Send message to staff
     */
    public function send(StaffMember $staff, Request $request)
    {
        $customer = Auth::user();
        
        $validated = $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $message = Message::create([
            'sender_type' => 'App\Models\CustomerUser',
            'sender_id' => $customer->id,
            'receiver_type' => 'App\Models\StaffMember',
            'receiver_id' => $staff->id,
            'message' => $validated['message'],
            'is_read' => false
        ]);

        $conversationId = ConversationChannel::fromParticipants(
            get_class($customer),
            (int) $customer->id,
            StaffMember::class,
            (int) $staff->id
        );

        event(new MessageSent($message, $conversationId));

        return back()->with('success', 'Message sent successfully');
    }
}
