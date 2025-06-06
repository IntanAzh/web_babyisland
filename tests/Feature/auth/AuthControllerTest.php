<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'username' => 'iftitah',
            'email' => 'iftitah@example.com',
            'password' => 'password123',
            'phonenumber' => '08123456789',
        ]);

        $response->assertRedirect(route('user.dashboard'));
        $this->assertDatabaseHas('users', [
            'username' => 'iftitah',
            'email' => 'iftitah@example.com'
        ]);
    }

    /** @test */
    public function user_cannot_register_with_invalid_email()
    {
        $response = $this->post('/register', [
            'username' => 'testuser',
            'email' => 'invalid-email',
            'password' => 'password123',
            'phonenumber' => '08123456789',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        $user = User::create([
            'username' => 'iftitah',
            'email' => 'iftitah@example.com',
            'password' => Hash::make('password123'),
            'phonenumber' => '08123456789',
            'role' => 'user'
        ]);

        $response = $this->post('/login', [
            'username' => 'iftitah',
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('user.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_cannot_login_with_wrong_password()
    {
        $user = User::create([
            'username' => 'iftitah',
            'email' => 'iftitah@example.com',
            'password' => Hash::make('password123'),
            'phonenumber' => '08123456789',
            'role' => 'user'
        ]);

        $response = $this->post('/login', [
            'username' => 'iftitah',
            'password' => 'wrongpassword'
        ]);

        $response->assertRedirect(); // back to login
        $this->assertGuest();
    }

    /** @test */
    public function user_can_logout_successfully()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->post('/logout')
             ->assertRedirect('/');

        $this->assertGuest();
    }
}
