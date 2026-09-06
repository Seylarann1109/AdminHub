<x-guest-layout>
    @section('title', 'Forgot Password')

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">
            Forgot password?
        </h1>
        <p class="mt-1.5 text-sm text-zinc-500 dark:text-zinc-400">
            No worries. Enter your registered email address and we will send you a password reset link.
        </p>
    </div>

    <form method="POST" action="{{ route('password.email') }}" class="mt-6 space-y-4">
        @csrf

        <!-- Email Address -->
        <x-input
            label="Email address"
            name="email"
            type="email"
            placeholder="you@company.com"
            :value="old('email')"
            required
            autofocus
            autocomplete="username"
        />

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition active:scale-[0.99] dark:bg-indigo-500 dark:hover:bg-indigo-400 cursor-pointer"
        >
            <span>Send Reset Link</span>
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
        </button>

        <p class="text-center text-xs text-zinc-500 dark:text-zinc-400 pt-2">
            Remembered your password?
            <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                Back to sign in
            </a>
        </p>
    </form>
</x-guest-layout>
