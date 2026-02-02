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
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $filter = $request->get('filter', 'all');

        $query = Notification::where('customer_id', $user->id);

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
        $unreadCount = Notification::where('customer_id', $user->id)->where('is_read', false)->count();

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

    /**
     * Create a notification for a customer.
     */
    public static function create($customerId, $type, $title, $message, $iconType = 'info', $actionUrl = null, $actionText = null, $relatedId = null, $relatedType = null)
    {
        return Notification::create([
            'customer_id' => $customerId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'icon_type' => $iconType,
            'action_url' => $actionUrl,
            'action_text' => $actionText,
            'related_id' => $relatedId,
            'related_type' => $relatedType,
        ]);
    }
}
