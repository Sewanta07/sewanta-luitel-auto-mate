<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\CustomerUser;
use App\Models\ServiceBooking;
use Carbon\Carbon;

class ServiceBookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_booking_with_valid_data()
    {
        $user = CustomerUser::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/service/book', [
            'service_id' => 1,
            'date' => Carbon::now()->addDay()->toDateString(),
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('service_bookings', [
            'service_id' => 1,
            'user_id' => $user->id,
        ]);
    }

    public function test_booking_with_empty_fields()
    {
        $user = CustomerUser::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/service/book', []);
        $response->assertSessionHasErrors(['service_id', 'date']);
    }

    public function test_booking_with_past_date()
    {
        $user = CustomerUser::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/service/book', [
            'service_id' => 1,
            'date' => Carbon::now()->subDay()->toDateString(),
        ]);
        $response->assertSessionHasErrors('date');
    }

    public function test_view_bookings()
    {
        $user = CustomerUser::factory()->create();
        ServiceBooking::factory()->count(2)->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->get('/service/bookings');
        $response->assertStatus(200);
        $response->assertViewHas('bookings');
    }
}
