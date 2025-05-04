<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(200);  // Check for successful registration
        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
        ]);
    }

    /** @test */
    public function a_user_can_login()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');  // Assuming the user is redirected to dashboard after login
    }

    /** @test */
    public function a_user_can_upload_company_logo()
    {
        // Simulate a logged-in user (employer)
        $user = User::factory()->create(['role' => 'employer']);
        $this->actingAs($user);

        // Simulate uploading a logo
        $response = $this->post('/company-profile', [
            'logo' => new \Illuminate\Http\UploadedFile(storage_path('app/public/logo.jpg'), 'logo.jpg'),
            'tagline' => 'Best Company Ever',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('company_profiles', [
            'logo_path' => 'storage/logo.jpg',  // Check that logo path is stored
        ]);
    }
}
