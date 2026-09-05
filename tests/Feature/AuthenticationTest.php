<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the landing page renders successfully for public visitors.
     */
    public function test_landing_page_can_be_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Master');
        $response->assertSee('Machine Learning');
    }

    /**
     * Test that login screen can be rendered for guest users.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Welcome Back');
    }

    /**
     * Test that registration screen can be rendered for guest users.
     */
    public function test_register_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Create Account');
    }

    /**
     * Test that unauthenticated users cannot access the home page.
     */
    public function test_unauthenticated_user_cannot_access_home_page(): void
    {
        $response = $this->get('/home');

        $response->assertRedirect('/login');
    }

    /**
     * Test that users can register an account and get redirected to home.
     */
    public function test_user_can_register_and_be_authenticated(): void
    {
        $response = $this->post('/register', [
            'name' => 'Data Scientist User',
            'email' => 'datascientist@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('users', [
            'email' => 'datascientist@example.com',
        ]);
    }

    /**
     * Test that users can login with valid credentials.
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'learner@example.com',
            'password' => Hash::make('securepassword'),
        ]);

        $response = $this->post('/login', [
            'email' => 'learner@example.com',
            'password' => 'securepassword',
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('home'));
    }

    /**
     * Test that users cannot login with an incorrect password.
     */
    public function test_user_cannot_login_with_invalid_password(): void
    {
        User::factory()->create([
            'email' => 'learner@example.com',
            'password' => Hash::make('correctpassword'),
        ]);

        $response = $this->post('/login', [
            'email' => 'learner@example.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test that authenticated users can access the home page and see the welcome message.
     */
    public function test_authenticated_user_can_access_home_page(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
        ]);

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
        $response->assertSee('Welcome to Home, John Doe!');
    }

    /**
     * Test that authenticated users can logout safely.
     */
    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
