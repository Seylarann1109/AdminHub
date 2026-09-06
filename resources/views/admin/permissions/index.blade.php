<x-app-layout>
    @section('title', 'Permissions Matrix')

    <x-slot name="header">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">Permissions Matrix</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400">Comprehensive overview of system abilities and assigned roles</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Info Banner -->
        <div class="flex items-center justify-between p-4 rounded-2xl bg-indigo-50/70 border border-indigo-100 text-indigo-950 dark:bg-indigo-950/30 dark:border-indigo-900/40 dark:text-indigo-200">
            <div class="flex items-center gap-3 text-xs">
                <div class="p-2 bg-indigo-600 rounded-xl text-white">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                </div>
                <div>
                    <span class="font-bold">Total Permissions: {{ $totalPermissions }}</span>
                    <span class="block text-indigo-700 dark:text-indigo-300/80">Permissions are bound to roles. Modify assignments in the Roles manager.</span>
                </div>
            </div>

            @can('roles.view')
                <a href="{{ route('admin.roles.index') }}" class="rounded-xl bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white shadow-2xs hover:bg-indigo-500 transition">
                    Configure Roles
                </a>
            @endcan
        </div>

        <!-- Modules Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($groupedPermissions as $group => $permissions)
                <x-card
                    :title="$group . ' Abilities'"
                    :description="$permissions->count() . ' permissions registered under this module'"
                >
                    <div class="space-y-3">
                        @foreach ($permissions as $permission)
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 p-3 rounded-xl border border-zinc-100 dark:border-zinc-800/80 bg-zinc-50/50 dark:bg-zinc-850/40">
                                <div>
                                    <span class="font-mono text-xs font-bold text-zinc-900 dark:text-zinc-100 block">
                                        {{ $permission->name }}
                                    </span>
                                </div>
                                <div class="flex flex-wrap items-center gap-1.5">
                                    @forelse ($permission->roles as $role)
                                        <x-badge :role="$role->name" size="sm">
                                            {{ $role->name }}
                                        </x-badge>
                                    @empty
                                        <span class="text-[11px] text-zinc-400 italic">No roles directly attached</span>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            @endforeach
        </div>
    </div>
</x-app-layout>
