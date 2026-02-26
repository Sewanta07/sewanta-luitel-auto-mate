<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Events\MessageReadUpdated;
use App\Events\MessageSent;
use App\Models\CustomerUser;
use App\Models\Message;
use App\Models\ServiceBooking;
use App\Support\Realtime\ConversationChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $staff = Auth::user();
        
        // Get all customers who have bookings assigned to this staff
        $customers = CustomerUser::whereHas('bookings', function($query) use ($staff) {
            $query->where('staff_id', $staff->id);
        })->with(['bookings' => function($query) use ($staff) {
            $query->where('staff_id', $staff->id)
                  ->orderBy('created_at', 'desc');
        }])->get();

        // Get unread message counts for each customer
        foreach ($customers as $customer) {
            $customer->unread_count = Message::where('sender_id', $customer->id)
                ->where('sender_type', get_class($customer))
                ->where('receiver_id', $staff->id)
                ->where('receiver_type', get_class($staff))
                ->where('is_read', false)
                ->count();
        }

        return view('staff.customers', compact('customers'));
    }

    public function messages($customerId)
    {
        $staff = Auth::user();
        
        // Get customers who either have bookings with this staff OR have exchanged messages
        $customers = CustomerUser::where(function($query) use ($staff) {
            $query->whereHas('bookings', function($q) use ($staff) {
                $q->where('staff_id', $staff->id);
            })->orWhereHas('sentMessages', function($q) use ($staff) {
                $q->where('receiver_id', $staff->id)
                  ->where('receiver_type', get_class($staff));
            })->orWhereHas('receivedMessages', function($q) use ($staff) {
                $q->where('sender_id', $staff->id)
                  ->where('sender_type', get_class($staff));
            });
        })->get();

        foreach ($customers as $c) {
            $c->unread_count = Message::where('sender_id', $c->id)
                ->where('sender_type', get_class($c))
                ->where('receiver_id', $staff->id)
                ->where('receiver_type', get_class($staff))
                ->where('is_read', false)
                ->count();
        }
        $customer = CustomerUser::findOrFail($customerId);
        $conversationId = ConversationChannel::fromParticipants(
            get_class($staff),
            (int) $staff->id,
            CustomerUser::class,
            (int) $customer->id
        );
        
        // Get bookings for context
        $bookings = ServiceBooking::where('customer_id', $customerId)
            ->where('staff_id', $staff->id)
            ->get();

        // Get all messages between staff and customer
        $messages = Message::where(function($query) use ($staff, $customer) {
            $query->where('sender_id', $staff->id)
                  ->where('sender_type', get_class($staff))
                  ->where('receiver_id', $customer->id)
                  ->where('receiver_type', get_class($customer));
        })->orWhere(function($query) use ($staff, $customer) {
            $query->where('sender_id', $customer->id)
                  ->where('sender_type', get_class($customer))
                  ->where('receiver_id', $staff->id)
                  ->where('receiver_type', get_class($staff));
        })->orderBy('created_at', 'asc')->get();

        // Mark messages from customer as read
        $messageIdsMarkedRead = Message::where('sender_id', $customer->id)
            ->where('sender_type', get_class($customer))
            ->where('receiver_id', $staff->id)
            ->where('receiver_type', get_class($staff))
            ->where('is_read', false)
            ->pluck('id')
            ->all();

        if (!empty($messageIdsMarkedRead)) {
            Message::whereIn('id', $messageIdsMarkedRead)
                ->update(['is_read' => true, 'read_at' => now()]);

            event(new MessageReadUpdated(
                $conversationId,
                array_map('intval', $messageIdsMarkedRead),
                get_class($staff),
                (int) $staff->id,
                now()->toISOString()
            ));
        }

        return view('staff.messages', compact('customer', 'messages', 'bookings', 'customers'));
    }

    public function sendMessage(Request $request, $customerId)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'service_booking_id' => 'nullable|exists:service_bookings,id',
        ]);

        $staff = Auth::user();
        $customer = CustomerUser::findOrFail($customerId);

        $message = Message::create([
            'sender_id' => $staff->id,
            'sender_type' => get_class($staff),
            'receiver_id' => $customer->id,
            'receiver_type' => get_class($customer),
            'service_booking_id' => $request->service_booking_id,
            'message' => $request->message,
        ]);

        $conversationId = ConversationChannel::fromParticipants(
            get_class($staff),
            (int) $staff->id,
            get_class($customer),
            (int) $customer->id
        );

        event(new MessageSent($message, $conversationId));

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
