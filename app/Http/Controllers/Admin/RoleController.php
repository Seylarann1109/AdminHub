<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index(): View
    {
        Gate::authorize('viewAny', Role::class);

        $roles = Role::withCount(['users', 'permissions'])
            ->with('permissions')
            ->orderBy('id')
            ->get();

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create(): View
    {
        Gate::authorize('create', Role::class);

        $permissions = Permission::all();
        $groupedPermissions = $this->groupPermissions($permissions);

        return view('admin.roles.create', compact('groupedPermissions'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('admin.roles.index')->with('success', "Role '{$role->name}' created successfully.");
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role): View
    {
        Gate::authorize('update', $role);

        $permissions = Permission::all();
        $groupedPermissions = $this->groupPermissions($permissions);
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('admin.roles.edit', compact('role', 'groupedPermissions', 'rolePermissions'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        Gate::authorize('update', $role);

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('roles', 'name')->ignore($role->id),
            ],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ]);

        if ($role->name === 'Super Admin' && $request->name !== 'Super Admin') {
            return back()->with('error', "Cannot rename the 'Super Admin' role.");
        }

        $role->name = $request->name;
        $role->save();

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('admin.roles.index')->with('success', "Role '{$role->name}' updated successfully.");
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role): RedirectResponse
    {
        Gate::authorize('delete', $role);

        if ($role->name === 'Super Admin') {
            return redirect()->route('admin.roles.index')->with('error', "Cannot delete the 'Super Admin' role.");
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('admin.roles.index')->with('error', "Cannot delete role '{$role->name}' because it is assigned to {$role->users()->count()} user(s).");
        }

        $roleName = $role->name;
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', "Role '{$roleName}' deleted successfully.");
    }

    /**
     * Helper to group permissions by module name based on delimiter (e.g. 'users.view' => 'Users')
     */
    private function groupPermissions($permissions)
    {
        return $permissions->groupBy(function ($perm) {
            $parts = explode('.', $perm->name);
            return ucfirst($parts[0]);
        });
    }
}
