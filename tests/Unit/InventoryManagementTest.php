<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\InventoryItem;
use App\Models\StaffMember;

class InventoryManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_inventory_item()
    {
        $staff = StaffMember::factory()->create(['role' => 'admin']);
        $this->actingAs($staff);
        $response = $this->post('/inventory/add', [
            'name' => 'Item 1',
            'quantity' => 10,
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('inventory_items', [
            'name' => 'Item 1',
        ]);
    }

    public function test_add_inventory_item_with_empty_fields()
    {
        $staff = StaffMember::factory()->create(['role' => 'admin']);
        $this->actingAs($staff);
        $response = $this->post('/inventory/add', []);
        $response->assertSessionHasErrors(['name', 'quantity']);
    }

    public function test_update_inventory_quantity()
    {
        $staff = StaffMember::factory()->create(['role' => 'admin']);
        $item = InventoryItem::factory()->create(['quantity' => 5]);
        $this->actingAs($staff);
        $response = $this->post('/inventory/update', [
            'item_id' => $item->id,
            'quantity' => 15,
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('inventory_items', [
            'id' => $item->id,
            'quantity' => 15,
        ]);
    }

    public function test_inventory_access_control()
    {
        $staff = StaffMember::factory()->create(['role' => 'user']);
        $this->actingAs($staff);
        $response = $this->post('/inventory/add', [
            'name' => 'Item 2',
            'quantity' => 5,
        ]);
        $response->assertStatus(403);
    }
}
