<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userType = get_class($user);

        // Get all conversations (unique senders/receivers)
        $conversations = Message::where(function($query) use ($user, $userType) {
            $query->where('sender_id', $user->id)
                  ->where('sender_type', $userType);
        })->orWhere(function($query) use ($user, $userType) {
            $query->where('receiver_id', $user->id)
                  ->where('receiver_type', $userType);
        })->with(['sender', 'receiver', 'booking'])
          ->orderBy('created_at', 'desc')
          ->get()
          ->groupBy(function($message) use ($user, $userType) {
              if ($message->sender_id == $user->id && $message->sender_type == $userType) {
                  return $message->receiver_type . '_' . $message->receiver_id;
              } else {
                  return $message->sender_type . '_' . $message->sender_id;
              }
          })
          ->map(function($group) {
              return $group->first();
          });

        return view('messages.index', compact('conversations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|integer',
            'receiver_type' => 'required|string',
            'message' => 'required|string|max:2000',
            'service_booking_id' => 'nullable|exists:service_bookings,id',
        ]);

        $user = Auth::user();

        Message::create([
            'sender_id' => $user->id,
            'sender_type' => get_class($user),
            'receiver_id' => $request->receiver_id,
            'receiver_type' => $request->receiver_type,
            'service_booking_id' => $request->service_booking_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent!');
    }
}
