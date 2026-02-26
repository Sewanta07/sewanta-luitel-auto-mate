<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Events\InventoryUpdated;
use App\Events\ServiceStatusUpdated;
use App\Models\InventoryItem;
use App\Models\InventoryMovement;
use App\Models\ServiceBooking;
use App\Models\ServiceLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ServiceBookingController extends Controller
{
    public function index()
    {
        $bookings = ServiceBooking::where('staff_id', Auth::id())
            ->with('customer')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate stats for current staff
        $stats = [
            'total' => $bookings->count(),
            'in_progress' => $bookings->where('status', 'In Progress')->count(),
            'completed_today' => $bookings->where('status', 'Completed')->where('updated_at', '>=', now()->startOfDay())->count(),
            'pending' => $bookings->where('status', 'Pending')->count(),
        ];

        return view('staff.bookings', compact('bookings', 'stats'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Customer Accepted,In Progress,Waiting for Parts,Completed',
            'notes' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $booking = ServiceBooking::where('id', $id)->where('staff_id', Auth::id())->firstOrFail();
        
        // Staff can only progress if customer accepted
        if ($booking->status === 'Assigned' && $request->status !== 'Customer Accepted') {
            return redirect()->back()->with('error', 'Please wait for customer acceptance before starting work.');
        }

        $booking->update(['status' => $request->status]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('service-logs', 'public');
        }

        // Create log entry with polymorphic relationship
        \App\Models\ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'status' => $request->status,
            'notes' => $request->notes ?? "Status updated to {$request->status}",
            'attachment_path' => $attachmentPath,
        ]);

        // Notify customer
        try {
            if ($booking->customer && $booking->customer->email) {
                Mail::raw(
                    "Your service booking {$booking->booking_code} status is now '{$booking->status}'." . ($request->notes ? "\n\nUpdate: {$request->notes}" : ''),
                    function ($message) use ($booking) {
                        $message->to($booking->customer->email)
                            ->subject('Service Update - AutoMate');
                    }
                );
            }
        } catch (\Throwable $e) {
            // Suppress mail failures to avoid breaking workflow
        }

        event(new ServiceStatusUpdated($booking->fresh()));

        return redirect()->back()->with('success', 'Booking status updated successfully!');
    }

    public function show($id)
    {
        $booking = ServiceBooking::where('id', $id)
            ->where('staff_id', Auth::id())
            ->with(['customer', 'parts'])
            ->firstOrFail();

        $inventoryItems = InventoryItem::where('status', 'active')
            ->orderBy('part_name')
            ->get();

        return view('staff.services.show', compact('booking', 'inventoryItems'));
    }

    public function addPart(Request $request, $id)
    {
        $request->validate([
            'inventory_item_id' => 'required|exists:inventory_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $booking = ServiceBooking::where('id', $id)
            ->where('staff_id', Auth::id())
            ->firstOrFail();

        $item = InventoryItem::findOrFail($request->inventory_item_id);

        if ($item->status !== 'active') {
            return redirect()->back()->with('error', 'This item is inactive.');
        }

        if ($item->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'Insufficient stock for the selected part.');
        }

        $unitPrice = $item->unit_price;
        $totalCost = $unitPrice * $request->quantity;

        $existing = $booking->parts()->where('inventory_item_id', $item->id)->first();

        if ($existing) {
            $newQty = $existing->pivot->quantity + $request->quantity;
            $booking->parts()->updateExistingPivot($item->id, [
                'quantity' => $newQty,
                'unit_price' => $unitPrice,
                'total_cost' => $newQty * $unitPrice,
            ]);
        } else {
            $booking->parts()->attach($item->id, [
                'quantity' => $request->quantity,
                'unit_price' => $unitPrice,
                'total_cost' => $totalCost,
            ]);
        }

        $item->decrement('quantity', $request->quantity);

        InventoryMovement::create([
            'inventory_item_id' => $item->id,
            'service_booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'change_type' => 'consume',
            'quantity_change' => -1 * $request->quantity,
            'unit_price' => $unitPrice,
            'notes' => "Used in booking {$booking->booking_code}",
        ]);

        ServiceLog::create([
            'service_booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'status' => 'Parts Used',
            'notes' => "Parts used: {$item->part_name} x{$request->quantity}",
        ]);

        if ($booking->status !== 'Parts Added') {
            $booking->update(['status' => 'Parts Added']);
        }

        event(new InventoryUpdated($item->fresh()));
        event(new ServiceStatusUpdated($booking->fresh()));

        return redirect()->back()->with('success', 'Part added to service and inventory updated.');
    }
}
