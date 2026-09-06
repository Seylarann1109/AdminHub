<x-app-layout>
    @section('title', 'Edit User - ' . $user->name)

    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.users.index') }}" class="text-xs text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                Users
            </a>
            <span class="text-zinc-400">/</span>
            <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Edit User</span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <x-card
            title="Edit User Details"
            description="Modify personal info, passwords, and assigned permissions/roles."
        >
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <x-input
                    label="Full Name"
                    name="name"
                    type="text"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                />

                <!-- Email -->
                <x-input
                    label="Email Address"
                    name="email"
                    type="email"
                    :value="old('email', $user->email)"
                    required
                />

                <!-- Optional Password Change -->
                <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4 bg-zinc-50/50 dark:bg-zinc-850/30 space-y-4">
                    <div>
                        <h4 class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">Password Update</h4>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Leave both fields empty if you do not wish to change the password.</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-input
                            label="New Password"
                            name="password"
                            type="password"
                            placeholder="••••••••"
                        />

                        <x-input
                            label="Confirm Password"
                            name="password_confirmation"
                            type="password"
                            placeholder="••••••••"
                        />
                    </div>
                </div>

                <!-- Roles Assignment -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Assign Roles
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                        @foreach ($roles as $role)
                            <label class="relative flex items-start gap-3 p-3 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-850/40 cursor-pointer hover:border-indigo-300 dark:hover:border-indigo-700 transition">
                                <div class="flex items-center h-5">
                                    <input
                                        type="checkbox"
                                        name="roles[]"
                                        value="{{ $role->name }}"
                                        {{ in_array($role->name, old('roles', $userRoleNames)) ? 'checked' : '' }}
                                        class="h-4 w-4 rounded-md border-zinc-300 text-indigo-600 focus:ring-indigo-500/20 dark:border-zinc-700 dark:bg-zinc-800"
                                    >
                                </div>
                                <div class="text-xs">
                                    <span class="font-semibold text-zinc-900 dark:text-zinc-100 block">
                                        {{ $role->name }}
                                    </span>
                                    <span class="text-zinc-500 dark:text-zinc-400">
                                        {{ $role->permissions->count() }} permissions
                                    </span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('roles')
                        <p class="text-xs text-rose-600 dark:text-rose-400 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-zinc-100 dark:border-zinc-800">
                    <a href="{{ route('admin.users.index') }}" class="rounded-xl border border-zinc-300 dark:border-zinc-700 px-4 py-2 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                        Cancel
                    </a>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-2xs hover:bg-indigo-500 transition cursor-pointer">
                        Update User
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
