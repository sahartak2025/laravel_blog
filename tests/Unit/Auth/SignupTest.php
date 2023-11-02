<?php

namespace Tests\Unit\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class SignupTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_signup()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'secret_password',
        ];

        $response = $this->post(route('user.signup'), $userData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);
    }
}
