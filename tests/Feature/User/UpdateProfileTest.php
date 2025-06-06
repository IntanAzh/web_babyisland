<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_update_profile_successfully()
    {
        $user = User::factory()->create([
            'username' => 'iftitah',
            'email' => 'iftitah@example.com',
            'phonenumber' => '08123456789',
        ]);

        $response = $this->actingAs($user)->put('/edit-profile', [
            'username' => 'iftitah_updated',
            'email' => 'iftitah_new@example.com',
            'phonenumber' => '089999999999',
        ]);

        $response->assertRedirect(route('user.profile'));
        $response->assertSessionHas('success', 'Profile updated successfully');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'username' => 'iftitah_updated',
            'email' => 'iftitah_new@example.com',
            'phonenumber' => '089999999999',
        ]);
    }

    /** @test */
    public function user_cannot_use_existing_email_of_another_user()
    {
        $user1 = User::factory()->create([
            'email' => 'used@example.com',
        ]);

        $user2 = User::factory()->create([
            'email' => 'current@example.com',
        ]);

        $response = $this->actingAs($user2)->from('/edit-profile')->put('/edit-profile', [
            'username' => 'userbaru',
            'email' => 'used@example.com', // email yang sudah dipakai user1
            'phonenumber' => '0812121212',
        ]);

        $response->assertRedirect('/edit-profile');
        $response->assertSessionHasErrors('email');
        $this->assertDatabaseMissing('users', [
            'id' => $user2->id,
            'email' => 'used@example.com'
        ]);
    }

    /** @test */
    public function guest_cannot_access_update_profile()
    {
        $response = $this->put('/edit-profile', [
            'username' => 'test',
            'email' => 'test@example.com',
            'phonenumber' => '0800000000',
        ]);

        $response->assertRedirect('/login'); // Laravel default redirect if guest access protected route
    }
}
