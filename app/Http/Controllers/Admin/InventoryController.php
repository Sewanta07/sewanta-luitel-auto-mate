<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $items = InventoryItem::orderBy('part_name')->get();

        $stats = [
            'total' => $items->count(),
            'low_stock' => $items->filter(function ($item) {
                return $item->quantity > 0 && $item->quantity <= $item->minimum_stock;
            })->count(),
            'out_of_stock' => $items->filter(function ($item) {
                return $item->quantity <= 0;
            })->count(),
        ];

        return view('admin.inventory.index', compact('items', 'stats'));
    }

    public function create()
    {
        return view('admin.inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'part_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'status' => 'required|string|in:active,inactive',
            'supplier' => 'nullable|string|max:255',
        ]);

        $item = InventoryItem::create($validated);

        InventoryMovement::create([
            'inventory_item_id' => $item->id,
            'service_booking_id' => null,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'change_type' => 'add',
            'quantity_change' => $item->quantity,
            'unit_price' => $item->unit_price,
            'notes' => 'Initial stock added',
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item created successfully.');
    }

    public function edit($id)
    {
        $item = InventoryItem::findOrFail($id);
        return view('admin.inventory.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);

        $validated = $request->validate([
            'part_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'minimum_stock' => 'required|integer|min:0',
            'status' => 'required|string|in:active,inactive',
            'supplier' => 'nullable|string|max:255',
        ]);

        $quantityChange = $validated['quantity'] - $item->quantity;

        $item->update($validated);

        if ($quantityChange !== 0) {
            InventoryMovement::create([
                'inventory_item_id' => $item->id,
                'service_booking_id' => null,
                'user_id' => Auth::id(),
                'user_type' => get_class(Auth::user()),
                'change_type' => $quantityChange > 0 ? 'restock' : 'adjust',
                'quantity_change' => $quantityChange,
                'unit_price' => $item->unit_price,
                'notes' => 'Stock adjusted from admin panel',
            ]);
        }

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item updated successfully.');
    }

    public function destroy($id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->update(['status' => 'inactive']);

        InventoryMovement::create([
            'inventory_item_id' => $item->id,
            'service_booking_id' => null,
            'user_id' => Auth::id(),
            'user_type' => get_class(Auth::user()),
            'change_type' => 'deactivate',
            'quantity_change' => 0,
            'unit_price' => $item->unit_price,
            'notes' => 'Item deactivated',
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item deactivated successfully.');
    }

    public function reports()
    {
        $movements = InventoryMovement::with(['item', 'booking'])
            ->orderByDesc('created_at')
            ->limit(200)
            ->get();

        return view('admin.inventory.reports', compact('movements'));
    }
}
