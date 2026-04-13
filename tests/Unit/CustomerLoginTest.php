<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\CustomerUser;
use Illuminate\Support\Facades\Hash;

class CustomerLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_valid_credentials()
    {
        $user = CustomerUser::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password'),
        ]);
        $response = $this->post('/login', [
            'email' => 'testuser@example.com',
            'password' => 'password',
        ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_with_wrong_password()
    {
        CustomerUser::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password'),
        ]);
        $response = $this->post('/login', [
            'email' => 'testuser@example.com',
            'password' => 'wrongpassword',
        ]);
        $response->assertSessionHasErrors('email');
    }

    public function test_login_with_unregistered_email()
    {
        $response = $this->post('/login', [
            'email' => 'nouser@example.com',
            'password' => 'password',
        ]);
        $response->assertSessionHasErrors('email');
    }

    public function test_login_with_empty_fields()
    {
        $response = $this->post('/login', []);
        $response->assertSessionHasErrors(['email', 'password']);
    }
}
