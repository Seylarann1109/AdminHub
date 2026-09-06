<x-guest-layout>
    @section('title', 'Create Account')

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">
            Create an account
        </h1>
        <p class="mt-1.5 text-sm text-zinc-500 dark:text-zinc-400">
            Get started with your new account and access dashboard features.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
        @csrf

        <!-- Name -->
        <x-input
            label="Full name"
            name="name"
            type="text"
            placeholder="John Doe"
            :value="old('name')"
            required
            autofocus
            autocomplete="name"
        />

        <!-- Email Address -->
        <x-input
            label="Email address"
            name="email"
            type="email"
            placeholder="you@company.com"
            :value="old('email')"
            required
            autocomplete="username"
        />

        <!-- Password -->
        <x-input
            label="Password"
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
            <span>Create Account</span>
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </button>

        <p class="text-center text-xs text-zinc-500 dark:text-zinc-400 pt-2">
            Already have an account?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                Sign in
            </a>
        </p>
    </form>
</x-guest-layout>
