<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
        ]);
    }

    public function test_user_can_view_profile(): void
    {
        $user = User::where('email', 'user@example.com')->first();

        $response = $this->actingAs($user)->get('/profile');

        $response->assertStatus(200);
        $response->assertSee($user->name);
    }

    public function test_user_can_update_profile_info(): void
    {
        $user = User::where('email', 'user@example.com')->first();

        $response = $this->actingAs($user)->patch('/profile', [
            'name' => 'New Profile Name',
            'email' => 'new_email@example.com',
        ]);

        $response->assertRedirect('/profile');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'New Profile Name',
            'email' => 'new_email@example.com',
        ]);
    }

    public function test_user_can_update_password(): void
    {
        $user = User::where('email', 'user@example.com')->first();

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'password',
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ]);

        $response->assertRedirect('/profile/password');
        $this->assertTrue(Hash::check('new-secure-password', $user->fresh()->password));
    }

    public function test_password_cannot_be_updated_with_wrong_current_password(): void
    {
        $user = User::where('email', 'user@example.com')->first();

        $response = $this->actingAs($user)->put('/profile/password', [
            'current_password' => 'incorrect-pwd',
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ]);

        $response->assertSessionHasErrors('current_password');
        $this->assertFalse(Hash::check('new-secure-password', $user->fresh()->password));
    }
}
