<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of all system permissions.
     */
    public function index(): View
    {
        Gate::authorize('permissions.view');

        $permissions = Permission::with('roles')
            ->orderBy('name')
            ->get();

        $groupedPermissions = $permissions->groupBy(function ($permission) {
            $parts = explode('.', $permission->name);
            return ucfirst($parts[0]);
        });

        return view('admin.permissions.index', [
            'groupedPermissions' => $groupedPermissions,
            'totalPermissions' => $permissions->count(),
        ]);
    }
}
