<x-app-layout>
    @section('title', 'Edit Role - ' . $role->name)

    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.roles.index') }}" class="text-xs text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                Roles
            </a>
            <span class="text-zinc-400">/</span>
            <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Edit Role</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <x-card
            title="Edit Role: {{ $role->name }}"
            description="Modify permissions and role configuration."
        >
            <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Role Name -->
                <div class="max-w-md">
                    <x-input
                        label="Role Name"
                        name="name"
                        type="text"
                        :value="old('name', $role->name)"
                        :disabled="$role->name === 'Super Admin'"
                        required
                        autofocus
                        :help="$role->name === 'Super Admin' ? 'System Super Admin name cannot be modified.' : 'Unique name for this role.'"
                    />
                </div>

                <!-- Grouped Permissions Matrix -->
                <div class="space-y-4 pt-2">
                    <div>
                        <h3 class="text-sm font-bold text-zinc-900 dark:text-zinc-100">Assign Permissions</h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Select the specific abilities granted to users holding this role.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @foreach ($groupedPermissions as $group => $permissions)
                            <div
                                x-data="{
                                    allSelected: false,
                                    toggleAll() {
                                        this.allSelected = !this.allSelected;
                                        $el.querySelectorAll('input[type=checkbox]').forEach(cb => cb.checked = this.allSelected);
                                    }
                                }"
                                class="rounded-2xl border border-zinc-200/80 bg-zinc-50/50 p-4.5 dark:border-zinc-800/80 dark:bg-zinc-850/30 flex flex-col justify-between"
                            >
                                <div>
                                    <div class="flex items-center justify-between pb-3 mb-3 border-b border-zinc-200/80 dark:border-zinc-800">
                                        <div class="flex items-center gap-2">
                                            <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
                                            <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-800 dark:text-zinc-200">
                                                {{ $group }} Module
                                            </h4>
                                        </div>
                                        <button
                                            type="button"
                                            @click="toggleAll()"
                                            class="text-[11px] font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 cursor-pointer"
                                        >
                                            Toggle All
                                        </button>
                                    </div>

                                    <div class="space-y-2.5">
                                        @foreach ($permissions as $permission)
                                            <label class="flex items-center gap-2.5 cursor-pointer text-xs group">
                                                <input
                                                    type="checkbox"
                                                    name="permissions[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}
                                                    class="h-4 w-4 rounded-md border-zinc-300 text-indigo-600 focus:ring-indigo-500/20 dark:border-zinc-700 dark:bg-zinc-800"
                                                >
                                                <span class="font-mono text-zinc-700 dark:text-zinc-300 group-hover:text-zinc-900 dark:group-hover:text-white">
                                                    {{ $permission->name }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('permissions')
                        <p class="text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-zinc-100 dark:border-zinc-800">
                    <a href="{{ route('admin.roles.index') }}" class="rounded-xl border border-zinc-300 dark:border-zinc-700 px-4 py-2 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                        Cancel
                    </a>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-2xs hover:bg-indigo-500 transition cursor-pointer">
                        Update Role
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
