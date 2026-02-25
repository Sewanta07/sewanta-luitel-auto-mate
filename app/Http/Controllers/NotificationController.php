<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     */
    public function index(Request $request)
    {
        $user = getAuthenticatedUser();

        if (!$user) {
            return redirect()->route('login');
        }

        $filter = $request->get('filter', 'all');

        $customerId = (int) ($user->id ?? 0);
        $query = Notification::where('customer_id', $customerId);

        switch ($filter) {
            case 'unread':
                $query->where('is_read', false);
                break;
            case 'service':
                $query->where('type', 'service_update');
                break;
            case 'payment':
                $query->where('type', 'payment');
                break;
            case 'rental':
                $query->where('type', 'rental_update');
                break;
        }

        $notifications = $query->orderBy('created_at', 'desc')->paginate(20);
        $unreadCount = Notification::where('customer_id', $customerId)->where('is_read', false)->count();

        return view('notifications.index', compact('notifications', 'unreadCount', 'filter'));
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Ensure the notification belongs to the authenticated user
        if ($notification->customer_id !== Auth::id()) {
            abort(403);
        }

        $notification->markAsRead();

        return back()->with('success', 'Notification marked as read');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Notification::where('customer_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return back()->with('success', 'All notifications marked as read');
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        
        // Ensure the notification belongs to the authenticated user
        if ($notification->customer_id !== Auth::id()) {
            abort(403);
        }

        $notification->delete();

        return back()->with('success', 'Notification deleted');
    }

}
