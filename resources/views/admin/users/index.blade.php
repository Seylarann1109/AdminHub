<x-app-layout>
    @section('title', 'Users Management')

    <x-slot name="header">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">User Management</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400">View, create, and manage system users and role assignments</p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Filter & Search Bar -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-1 flex-col sm:flex-row items-center gap-3">
                <!-- Search Input -->
                <div class="relative w-full sm:w-72">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-zinc-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by name or email..."
                        class="block w-full rounded-xl border border-zinc-300 bg-white py-2 pl-9 pr-3 text-xs text-zinc-900 shadow-2xs placeholder:text-zinc-400 focus:border-indigo-500 focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 dark:border-zinc-700 dark:bg-zinc-800/60 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                    >
                </div>

                <!-- Role Filter -->
                <div class="w-full sm:w-48">
                    <select
                        name="role"
                        onchange="this.form.submit()"
                        class="block w-full rounded-xl border border-zinc-300 bg-white py-2 px-3 text-xs text-zinc-900 shadow-2xs focus:border-indigo-500 focus:outline-hidden focus:ring-2 focus:ring-indigo-500/20 dark:border-zinc-700 dark:bg-zinc-800/60 dark:text-zinc-100"
                    >
                        <option value="">All Roles</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @if (request('search') || request('role'))
                    <a href="{{ route('admin.users.index') }}" class="text-xs font-semibold text-zinc-500 hover:text-zinc-800 dark:hover:text-zinc-300">
                        Clear Filters
                    </a>
                @endif
            </form>

            @can('users.create')
                <a
                    href="{{ route('admin.users.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-semibold text-white shadow-2xs hover:bg-indigo-500 transition active:scale-[0.99]"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    <span>Add New User</span>
                </a>
            @endcan
        </div>

        <!-- Users Table -->
        <x-table :headers="['User', 'Email', 'Assigned Roles', 'Created', 'Actions']">
            @forelse ($users as $user)
                <tr class="hover:bg-zinc-50/50 dark:hover:bg-zinc-800/30 transition">
                    <!-- User details -->
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-linear-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-xs uppercase shrink-0">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                            <div>
                                <span class="font-semibold text-zinc-900 dark:text-zinc-100 block">
                                    {{ $user->name }}
                                </span>
                                @if ($user->id === Auth::id())
                                    <span class="inline-flex items-center text-[10px] font-bold text-indigo-600 dark:text-indigo-400">
                                        (You)
                                    </span>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Email -->
                    <td class="px-6 py-4 text-zinc-600 dark:text-zinc-400">
                        {{ $user->email }}
                    </td>

                    <!-- Roles -->
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1.5">
                            @forelse ($user->roles as $role)
                                <x-badge :role="$role->name" size="sm">
                                    {{ $role->name }}
                                </x-badge>
                            @empty
                                <span class="text-xs text-zinc-400">No role</span>
                            @endforelse
                        </div>
                    </td>

                    <!-- Created -->
                    <td class="px-6 py-4 text-xs text-zinc-500 dark:text-zinc-400">
                        {{ $user->created_at->format('M d, Y') }}
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            @can('users.edit')
                                <a
                                    href="{{ route('admin.users.edit', $user) }}"
                                    class="p-1.5 rounded-lg text-zinc-500 hover:text-indigo-600 hover:bg-indigo-50 dark:text-zinc-400 dark:hover:text-indigo-400 dark:hover:bg-indigo-950/50 transition"
                                    title="Edit User"
                                >
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                            @endcan

                            @can('users.delete')
                                @if ($user->id !== Auth::id())
                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.destroy', $user) }}"
                                        onsubmit="return confirm('Are you sure you want to permanently delete user \'{{ $user->name }}\'?');"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="p-1.5 rounded-lg text-zinc-500 hover:text-rose-600 hover:bg-rose-50 dark:text-zinc-400 dark:hover:text-rose-400 dark:hover:bg-rose-950/50 transition"
                                            title="Delete User"
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
                            title="No users match your criteria"
                            description="Try adjusting your search terms or filter to find who you're looking for."
                        />
                    </td>
                </tr>
            @endforelse

            <x-slot name="pagination">
                {{ $users->links() }}
            </x-slot>
        </x-table>
    </div>
</x-app-layout>
