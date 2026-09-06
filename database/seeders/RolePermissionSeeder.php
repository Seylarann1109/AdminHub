<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions list
        $permissions = [
            // Dashboard
            'dashboard.view',

            // User Management
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // Role Management
            'roles.view',
            'roles.create',
            'roles.edit',
            'roles.delete',

            // Permission Management
            'permissions.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles definition
        // 1. Super Admin
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $superAdminRole->syncPermissions(Permission::all());

        // 2. Admin
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions(Permission::all());

        // 3. Manager
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $managerRole->syncPermissions([
            'dashboard.view',
            'users.view',
            'users.create',
            'users.edit',
            'roles.view',
            'permissions.view',
        ]);

        // 4. User
        $userRole = Role::firstOrCreate(['name' => 'User']);
        $userRole->syncPermissions([
            'dashboard.view',
        ]);
    }
}
