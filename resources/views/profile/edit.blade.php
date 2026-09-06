<x-app-layout>
    @section('title', 'Edit Profile')

    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('profile.show') }}" class="text-xs text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                Profile
            </a>
            <span class="text-zinc-400">/</span>
            <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Edit Details</span>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <x-card
            title="Profile Information"
            description="Update your account's profile name and email address."
        >
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('PATCH')

                <!-- Name -->
                <x-input
                    label="Full Name"
                    name="name"
                    type="text"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name"
                />

                <!-- Email -->
                <x-input
                    label="Email Address"
                    name="email"
                    type="email"
                    :value="old('email', $user->email)"
                    required
                    autocomplete="username"
                />

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-zinc-100 dark:border-zinc-800">
                    <a href="{{ route('profile.show') }}" class="rounded-xl border border-zinc-300 dark:border-zinc-700 px-4 py-2 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                        Cancel
                    </a>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-2xs hover:bg-indigo-500 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
