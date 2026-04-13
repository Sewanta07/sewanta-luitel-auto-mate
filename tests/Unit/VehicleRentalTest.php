<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\CustomerUser;
use App\Models\Vehicle;
use App\Models\Rental;
use Carbon\Carbon;

class VehicleRentalTest extends TestCase
{
    use RefreshDatabase;

    public function test_rental_with_valid_data()
    {
        $user = CustomerUser::factory()->create();
        $vehicle = Vehicle::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/rental/book', [
            'vehicle_id' => $vehicle->id,
            'start_date' => Carbon::now()->addDay()->toDateString(),
            'end_date' => Carbon::now()->addDays(2)->toDateString(),
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('rentals', [
            'vehicle_id' => $vehicle->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_rental_with_empty_fields()
    {
        $user = CustomerUser::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/rental/book', []);
        $response->assertSessionHasErrors(['vehicle_id', 'start_date', 'end_date']);
    }

    public function test_rental_with_invalid_dates()
    {
        $user = CustomerUser::factory()->create();
        $vehicle = Vehicle::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/rental/book', [
            'vehicle_id' => $vehicle->id,
            'start_date' => Carbon::now()->addDays(2)->toDateString(),
            'end_date' => Carbon::now()->addDay()->toDateString(),
        ]);
        $response->assertSessionHasErrors('end_date');
    }

    public function test_view_rentals()
    {
        $user = CustomerUser::factory()->create();
        Rental::factory()->count(2)->create(['user_id' => $user->id]);
        $this->actingAs($user);
        $response = $this->get('/rental/list');
        $response->assertStatus(200);
        $response->assertViewHas('rentals');
    }
}
