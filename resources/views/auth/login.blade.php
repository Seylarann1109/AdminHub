<x-guest-layout>
    @section('title', 'Sign In')

    <div>
        <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">
            Welcome back
        </h1>
        <p class="mt-1.5 text-sm text-zinc-500 dark:text-zinc-400">
            Sign in to access your administrative dashboard and roles.
        </p>
    </div>

    <!-- Quick Demo Credentials Callout -->
    <div x-data class="mt-5 rounded-xl border border-indigo-100 bg-indigo-50/60 p-3.5 text-xs text-indigo-900 dark:border-indigo-900/40 dark:bg-indigo-950/30 dark:text-indigo-300">
        <div class="font-semibold flex items-center gap-1.5 mb-1 text-indigo-700 dark:text-indigo-300">
            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
            </svg>
            <span>Demo Super Admin Account:</span>
        </div>
        <div class="flex items-center justify-between font-mono bg-white/70 dark:bg-zinc-900/60 px-2.5 py-1.5 rounded-lg border border-indigo-200/60 dark:border-indigo-800/40">
            <span>admin@example.com / password</span>
            <button
                type="button"
                @click="document.getElementById('email').value='admin@example.com'; document.getElementById('password').value='password';"
                class="text-indigo-600 dark:text-indigo-400 font-sans font-semibold hover:underline"
            >
                Auto-fill
            </button>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
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

        <!-- Password -->
        <div class="space-y-1.5">
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    Password <span class="text-rose-500">*</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative" x-data="{ show: false }">
                <input
                    :type="show ? 'text' : 'password'"
                    name="password"
                    id="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="block w-full rounded-xl border border-zinc-300 px-3.5 py-2.5 pr-10 text-sm text-zinc-900 shadow-2xs transition placeholder:text-zinc-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 dark:border-zinc-700 dark:bg-zinc-800/60 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-indigo-400"
                >
                <button
                    type="button"
                    @click="show = !show"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300"
                    aria-label="Toggle password visibility"
                >
                    <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <svg x-show="show" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="text-xs font-medium text-rose-600 dark:text-rose-400 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label class="flex items-center gap-2 cursor-pointer">
                <input
                    type="checkbox"
                    name="remember"
                    id="remember"
                    class="h-4 w-4 rounded-md border-zinc-300 text-indigo-600 focus:ring-indigo-500/30 dark:border-zinc-700 dark:bg-zinc-800"
                >
                <span class="text-xs text-zinc-600 dark:text-zinc-400">Remember this device</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 transition active:scale-[0.99] dark:bg-indigo-500 dark:hover:bg-indigo-400 cursor-pointer"
        >
            <span>Sign In</span>
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </button>

        @if (Route::has('register'))
            <p class="text-center text-xs text-zinc-500 dark:text-zinc-400 pt-2">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                    Create an account
                </a>
            </p>
        @endif
    </form>
</x-guest-layout>
