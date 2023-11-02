<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanLogin()
    {
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('user.login'), [
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/profile');
        $this->assertAuthenticatedAs($user);
    }

    public function testUserCannotLoginWithInvalidCredentials()
    {
        $response = $this->post(route('user.login'), [
            'email' => 'nonexistent@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
