<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ServiceBooking;
use App\Models\StaffMember;

class ServiceStatusUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_status_to_in_progress()
    {
        $staff = StaffMember::factory()->create(['role' => 'admin']);
        $booking = ServiceBooking::factory()->create(['status' => 'pending']);
        $this->actingAs($staff);
        $response = $this->post('/service/update-status', [
            'booking_id' => $booking->id,
            'status' => 'in_progress',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('service_bookings', [
            'id' => $booking->id,
            'status' => 'in_progress',
        ]);
    }

    public function test_update_status_to_completed()
    {
        $staff = StaffMember::factory()->create(['role' => 'admin']);
        $booking = ServiceBooking::factory()->create(['status' => 'in_progress']);
        $this->actingAs($staff);
        $response = $this->post('/service/update-status', [
            'booking_id' => $booking->id,
            'status' => 'completed',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('service_bookings', [
            'id' => $booking->id,
            'status' => 'completed',
        ]);
    }

    public function test_update_status_with_invalid_status()
    {
        $staff = StaffMember::factory()->create(['role' => 'admin']);
        $booking = ServiceBooking::factory()->create(['status' => 'pending']);
        $this->actingAs($staff);
        $response = $this->post('/service/update-status', [
            'booking_id' => $booking->id,
            'status' => 'invalid_status',
        ]);
        $response->assertSessionHasErrors('status');
    }

    public function test_view_service_tasks()
    {
        $staff = StaffMember::factory()->create(['role' => 'admin']);
        ServiceBooking::factory()->count(2)->create(['status' => 'pending']);
        $this->actingAs($staff);
        $response = $this->get('/service/tasks');
        $response->assertStatus(200);
        $response->assertViewHas('tasks');
    }
}
