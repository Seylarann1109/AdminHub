<x-app-layout>
    @section('title', 'Change Password')

    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('profile.show') }}" class="text-xs text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                Profile
            </a>
            <span class="text-zinc-400">/</span>
            <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Change Password</span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <x-card
            title="Update Password"
            description="Ensure your account is using a long, random password to stay secure."
        >
            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Current Password -->
                <x-input
                    label="Current Password"
                    name="current_password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                />

                <!-- New Password -->
                <x-input
                    label="New Password"
                    name="password"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    help="Must be at least 8 characters."
                />

                <!-- Confirm Password -->
                <x-input
                    label="Confirm New Password"
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                />

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-zinc-100 dark:border-zinc-800">
                    <a href="{{ route('profile.show') }}" class="rounded-xl border border-zinc-300 dark:border-zinc-700 px-4 py-2 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                        Cancel
                    </a>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-2xs hover:bg-indigo-500 transition">
                        Update Password
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
