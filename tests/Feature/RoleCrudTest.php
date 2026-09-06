<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleCrudTest extends TestCase
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

    public function test_super_admin_can_create_role_with_permissions(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        $response = $this->actingAs($admin)->post('/admin/roles', [
            'name' => 'Support Agent',
            'permissions' => ['dashboard.view', 'users.view'],
        ]);

        $response->assertRedirect('/admin/roles');
        $this->assertDatabaseHas('roles', ['name' => 'Support Agent']);

        $role = Role::where('name', 'Support Agent')->first();
        $this->assertTrue($role->hasPermissionTo('dashboard.view'));
        $this->assertTrue($role->hasPermissionTo('users.view'));
    }

    public function test_super_admin_can_update_role_permissions(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $role = Role::create(['name' => 'Editor']);

        $response = $this->actingAs($admin)->put("/admin/roles/{$role->id}", [
            'name' => 'Senior Editor',
            'permissions' => ['dashboard.view'],
        ]);

        $response->assertRedirect('/admin/roles');
        $this->assertDatabaseHas('roles', ['id' => $role->id, 'name' => 'Senior Editor']);
        $this->assertTrue($role->fresh()->hasPermissionTo('dashboard.view'));
    }

    public function test_super_admin_can_delete_unassigned_role(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $role = Role::create(['name' => 'Temporary Role']);

        $response = $this->actingAs($admin)->delete("/admin/roles/{$role->id}");

        $response->assertRedirect('/admin/roles');
        $this->assertDatabaseMissing('roles', ['id' => $role->id]);
    }

    public function test_role_with_users_cannot_be_deleted(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $userRole = Role::where('name', 'User')->first();

        $response = $this->actingAs($admin)->delete("/admin/roles/{$userRole->id}");

        $response->assertRedirect('/admin/roles');
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('roles', ['name' => 'User']);
    }
}
