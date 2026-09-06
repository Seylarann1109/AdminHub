<x-app-layout>
    @section('title', 'Dashboard')

    <x-slot name="header">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">Dashboard Overview</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400">Real-time authentication and permission metrics</p>
        </div>
    </x-slot>

    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-2xl bg-linear-to-r from-indigo-600 via-indigo-700 to-purple-800 p-6 sm:p-8 text-white shadow-lg shadow-indigo-600/10 mb-8">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/15 px-3 py-0.5 text-xs font-semibold tracking-wide text-indigo-100 backdrop-blur-xs">
                Active Session
            </span>
            <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold tracking-tight">
                Hello, {{ Auth::user()->name }}! 👋
            </h2>
            <p class="mt-2 text-sm text-indigo-100/90 leading-relaxed">
                You are authenticated as 
                <span class="font-semibold text-white underline decoration-indigo-300 underline-offset-4">
                    {{ Auth::user()->roles->pluck('name')->join(', ') ?: 'Standard User' }}
                </span>.
                Manage your system access, users, and roles seamlessly from this panel.
            </p>
        </div>
        <!-- Decorative subtle pattern -->
        <div class="absolute -right-10 -bottom-10 h-64 w-64 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
    </div>

    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <x-stat-card
            title="Total Users"
            :value="$stats['total_users']"
            subtext="Registered accounts"
            color="indigo"
        >
            <x-slot name="iconSlot">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </x-slot>
        </x-stat-card>

        <x-stat-card
            title="Configured Roles"
            :value="$stats['total_roles']"
            subtext="Defined permission tiers"
            color="purple"
        >
            <x-slot name="iconSlot">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                </svg>
            </x-slot>
        </x-stat-card>

        <x-stat-card
            title="System Permissions"
            :value="$stats['total_permissions']"
            subtext="Granular access abilities"
            color="emerald"
        >
            <x-slot name="iconSlot">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                </svg>
            </x-slot>
        </x-stat-card>

        <x-stat-card
            title="New This Month"
            :value="$stats['new_users_month']"
            subtext="Recent signups"
            color="amber"
        >
            <x-slot name="iconSlot">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.999-3.199a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
            </x-slot>
        </x-stat-card>
    </div>

    <!-- Quick Actions & Recent Users -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- Recent Users Table (2 cols) -->
        <div class="lg:col-span-2">
            <x-card
                title="Recent Users"
                description="Latest registered accounts in the system"
            >
                <x-slot name="actions">
                    @can('users.create')
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white shadow-2xs hover:bg-indigo-500 transition">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Add User</span>
                        </a>
                    @endcan
                </x-slot>

                <x-table :headers="['User', 'Email', 'Role', 'Joined']">
                    @forelse ($recentUsers as $user)
                        <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition">
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-full bg-linear-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-xs shrink-0">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <span class="font-medium text-zinc-900 dark:text-zinc-100">
                                        {{ $user->name }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-3.5 text-zinc-500 dark:text-zinc-400">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-3.5">
                                @forelse ($user->roles as $role)
                                    <x-badge :role="$role->name" size="sm">
                                        {{ $role->name }}
                                    </x-badge>
                                @empty
                                    <span class="text-xs text-zinc-400">No role</span>
                                @endforelse
                            </td>
                            <td class="px-6 py-3.5 text-xs text-zinc-500 dark:text-zinc-400">
                                {{ $user->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <x-empty-state title="No users registered yet" description="New users will appear here." />
                            </td>
                        </tr>
                    @endforelse
                </x-table>
            </x-card>
        </div>

        <!-- Roles Summary (1 col) -->
        <div class="space-y-6">
            <x-card
                title="Configured Roles"
                description="User distribution by role"
            >
                <div class="space-y-3">
                    @foreach ($roles as $role)
                        <div class="flex items-center justify-between p-3 rounded-xl border border-zinc-100 dark:border-zinc-800/80 bg-zinc-50/50 dark:bg-zinc-800/30">
                            <div class="flex items-center gap-2.5">
                                <x-badge :role="$role->name" size="sm">
                                    {{ $role->name }}
                                </x-badge>
                            </div>
                            <div class="text-right text-xs">
                                <span class="font-bold text-zinc-900 dark:text-zinc-100">{{ $role->users_count }}</span>
                                <span class="text-zinc-500 dark:text-zinc-400">users</span>
                                <span class="mx-1 text-zinc-300">·</span>
                                <span class="font-medium text-zinc-600 dark:text-zinc-400">{{ $role->permissions_count }}</span>
                                <span class="text-zinc-500 dark:text-zinc-400">perms</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                @can('roles.create')
                    <div class="mt-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                        <a href="{{ route('admin.roles.create') }}" class="block w-full text-center rounded-xl border border-zinc-300 dark:border-zinc-700 py-2 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                            + Create New Role
                        </a>
                    </div>
                @endcan
            </x-card>
        </div>
    </div>
</x-app-layout>
