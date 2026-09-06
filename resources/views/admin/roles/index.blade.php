<x-app-layout>
    @section('title', 'Roles Management')

    <x-slot name="header">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">Role Management</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400">Configure permission sets and assignable role templates</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Top Action Bar -->
        <div class="flex items-center justify-between">
            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                Found <span class="font-bold text-zinc-900 dark:text-zinc-100">{{ $roles->count() }}</span> configured roles.
            </p>

            @can('roles.create')
                <a
                    href="{{ route('admin.roles.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-semibold text-white shadow-2xs hover:bg-indigo-500 transition active:scale-[0.99]"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Create New Role</span>
                </a>
            @endcan
        </div>

        <!-- Roles Table -->
        <x-table :headers="['Role Name', 'Users Assigned', 'Permissions Count', 'Assigned Permissions Preview', 'Actions']">
            @forelse ($roles as $role)
                <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition">
                    <!-- Role Name -->
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <x-badge :role="$role->name" size="md">
                                {{ $role->name }}
                            </x-badge>
                            @if ($role->name === 'Super Admin')
                                <span class="text-[10px] font-semibold text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-950/60 px-1.5 py-0.5 rounded-md border border-purple-200 dark:border-purple-800/50">
                                    System Root
                                </span>
                            @endif
                        </div>
                    </td>

                    <!-- Users count -->
                    <td class="px-6 py-4 text-xs font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ $role->users_count }} user(s)
                    </td>

                    <!-- Permissions count -->
                    <td class="px-6 py-4 text-xs text-zinc-600 dark:text-zinc-400">
                        <span class="font-bold text-zinc-900 dark:text-zinc-100">{{ $role->permissions_count }}</span> active
                    </td>

                    <!-- Assigned Permissions Preview -->
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1 max-w-md">
                            @if ($role->name === 'Super Admin')
                                <span class="inline-flex items-center text-[11px] font-medium text-purple-700 dark:text-purple-300 bg-purple-50 dark:bg-purple-950/40 px-2 py-0.5 rounded-md">
                                    ★ Full Access to All Abilities
                                </span>
                            @else
                                @forelse ($role->permissions->take(4) as $permission)
                                    <span class="inline-flex items-center text-[11px] font-mono text-zinc-600 dark:text-zinc-300 bg-zinc-100 dark:bg-zinc-800 px-1.5 py-0.5 rounded-md">
                                        {{ $permission->name }}
                                    </span>
                                @empty
                                    <span class="text-xs text-zinc-400">No permissions</span>
                                @endforelse

                                @if ($role->permissions->count() > 4)
                                    <span class="inline-flex items-center text-[10px] font-semibold text-zinc-400 bg-zinc-100 dark:bg-zinc-800 px-1.5 py-0.5 rounded-md">
                                        +{{ $role->permissions->count() - 4 }} more
                                    </span>
                                @endif
                            @endif
                        </div>
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            @can('roles.edit')
                                <a
                                    href="{{ route('admin.roles.edit', $role) }}"
                                    class="p-1.5 rounded-lg text-zinc-500 hover:text-indigo-600 hover:bg-indigo-50 dark:text-zinc-400 dark:hover:text-indigo-400 dark:hover:bg-indigo-950/50 transition"
                                    title="Edit Role"
                                >
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            @endcan

                            @can('roles.delete')
                                @if ($role->name !== 'Super Admin')
                                    <form
                                        method="POST"
                                        action="{{ route('admin.roles.destroy', $role) }}"
                                        onsubmit="return confirm('Are you sure you want to delete role \'{{ $role->name }}\'?');"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="p-1.5 rounded-lg text-zinc-500 hover:text-rose-600 hover:bg-rose-50 dark:text-zinc-400 dark:hover:text-rose-400 dark:hover:bg-rose-950/50 transition"
                                            title="Delete Role"
                                        >
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <x-empty-state
                            title="No roles found"
                            description="Create a new role to get started."
                        />
                    </td>
                </tr>
            @endforelse
        </x-table>
    </div>
</x-app-layout>
