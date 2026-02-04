<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;

class InventoryController extends Controller
{
    public function index()
    {
        $items = InventoryItem::where('status', 'active')->orderBy('part_name')->get();

        $stats = [
            'total' => $items->count(),
            'low_stock' => $items->filter(function ($item) {
                return $item->quantity > 0 && $item->quantity <= $item->minimum_stock;
            })->count(),
            'out_of_stock' => $items->filter(function ($item) {
                return $item->quantity <= 0;
            })->count(),
        ];

        return view('staff.inventory', compact('items', 'stats'));
    }
}
