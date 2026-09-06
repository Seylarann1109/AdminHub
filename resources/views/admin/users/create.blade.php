<x-app-layout>
    @section('title', 'Create User')

    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.users.index') }}" class="text-xs text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                Users
            </a>
            <span class="text-zinc-400">/</span>
            <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Create User</span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <x-card
            title="Create New User"
            description="Provision a new user account with dedicated role assignments."
        >
            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <x-input
                    label="Full Name"
                    name="name"
                    type="text"
                    placeholder="Jane Doe"
                    :value="old('name')"
                    required
                    autofocus
                />

                <!-- Email -->
                <x-input
                    label="Email Address"
                    name="email"
                    type="email"
                    placeholder="jane@company.com"
                    :value="old('email')"
                    required
                />

                <!-- Password -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-input
                        label="Password"
                        name="password"
                        type="password"
                        placeholder="••••••••"
                        required
                        help="Min. 8 characters"
                    />

                    <x-input
                        label="Confirm Password"
                        name="password_confirmation"
                        type="password"
                        placeholder="••••••••"
                        required
                    />
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
                                        {{ in_array($role->name, old('roles', ['User'])) ? 'checked' : '' }}
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
                        Create User
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
