<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RbacTest extends TestCase
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

    public function test_super_admin_can_access_admin_dashboard_and_users(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        $response = $this->actingAs($admin)->get('/admin/users');

        $response->assertStatus(200);
        $response->assertSee('User Management');
    }

    public function test_super_admin_can_access_roles_and_permissions(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        $responseRoles = $this->actingAs($admin)->get('/admin/roles');
        $responseRoles->assertStatus(200);
        $responseRoles->assertSee('Role Management');

        $responsePerms = $this->actingAs($admin)->get('/admin/permissions');
        $responsePerms->assertStatus(200);
        $responsePerms->assertSee('Permissions Matrix');
    }

    public function test_standard_user_cannot_access_admin_users(): void
    {
        $user = User::where('email', 'user@example.com')->first();

        $response = $this->actingAs($user)->get('/admin/users');

        $response->assertStatus(403);
    }

    public function test_super_admin_cannot_delete_themselves(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        $response = $this->actingAs($admin)->delete("/admin/users/{$admin->id}");

        $response->assertRedirect('/admin/users');
        $response->assertSessionHas('error', 'You cannot delete your own account.');
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }

    public function test_super_admin_role_cannot_be_deleted(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $superAdminRole = Role::where('name', 'Super Admin')->first();

        $response = $this->actingAs($admin)->delete("/admin/roles/{$superAdminRole->id}");

        $response->assertRedirect('/admin/roles');
        $response->assertSessionHas('error', "Cannot delete the 'Super Admin' role.");
        $this->assertDatabaseHas('roles', ['name' => 'Super Admin']);
    }
}
