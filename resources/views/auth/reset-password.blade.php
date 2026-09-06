<x-guest-layout>
    @section('title', 'Reset Password')

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">
            Reset password
        </h1>
        <p class="mt-1.5 text-sm text-zinc-500 dark:text-zinc-400">
            Please enter your new password below.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="mt-6 space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <x-input
            label="Email address"
            name="email"
            type="email"
            placeholder="you@company.com"
            :value="old('email', $request->email)"
            required
            autofocus
            autocomplete="username"
        />

        <!-- Password -->
        <x-input
            label="New password"
            name="password"
            type="password"
            placeholder="••••••••"
            required
            autocomplete="new-password"
            help="Must be at least 8 characters."
        />

        <!-- Confirm Password -->
        <x-input
            label="Confirm password"
            name="password_confirmation"
            type="password"
            placeholder="••••••••"
            required
            autocomplete="new-password"
        />

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition active:scale-[0.99] dark:bg-indigo-500 dark:hover:bg-indigo-400 cursor-pointer"
        >
            <span>Reset Password</span>
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </button>
    </form>
</x-guest-layout>
