<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCrudTest extends TestCase
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

    public function test_super_admin_can_create_new_user(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        $response = $this->actingAs($admin)->post('/admin/users', [
            'name' => 'Alice Worker',
            'email' => 'alice@example.com',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
            'roles' => ['Manager'],
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', ['email' => 'alice@example.com']);

        $alice = User::where('email', 'alice@example.com')->first();
        $this->assertTrue($alice->hasRole('Manager'));
    }

    public function test_super_admin_can_update_user(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $user = User::where('email', 'user@example.com')->first();

        $response = $this->actingAs($admin)->put("/admin/users/{$user->id}", [
            'name' => 'Updated User Name',
            'email' => 'user_updated@example.com',
            'roles' => ['Manager'],
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated User Name',
            'email' => 'user_updated@example.com',
        ]);
        $this->assertTrue($user->fresh()->hasRole('Manager'));
    }

    public function test_super_admin_can_delete_standard_user(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $user = User::where('email', 'user@example.com')->first();

        $response = $this->actingAs($admin)->delete("/admin/users/{$user->id}");

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
