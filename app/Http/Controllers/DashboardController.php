<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(): View
    {
        $stats = [
            'total_users' => User::count(),
            'total_roles' => Role::count(),
            'total_permissions' => Permission::count(),
            'new_users_month' => User::where('created_at', '>=', now()->startOfMonth())->count(),
        ];

        $recentUsers = User::with('roles')
            ->latest()
            ->take(5)
            ->get();

        $roles = Role::withCount(['users', 'permissions'])
            ->get();

        return view('dashboard', compact('stats', 'recentUsers', 'roles'));
    }
}
