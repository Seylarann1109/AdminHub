<header class="h-16 border-b border-zinc-200/80 bg-white dark:border-zinc-800/80 dark:bg-zinc-900 sticky top-0 z-20 flex items-center justify-between px-4 sm:px-6 lg:px-8">
    <!-- Left: Mobile Menu Toggle & Title -->
    <div class="flex items-center gap-4">
        <button
            type="button"
            @click="sidebarOpen = true"
            class="inline-flex lg:hidden p-2 rounded-xl text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100 focus:outline-hidden"
            aria-label="Open sidebar"
        >
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        @if (isset($header))
            <div>{{ $header }}</div>
        @else
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('dashboard') }}" class="font-semibold text-zinc-900 dark:text-zinc-100 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    Dashboard
                </a>
            </div>
        @endif
    </div>

    <!-- Right: Role Badges & User Profile Dropdown -->
    <div class="flex items-center gap-3">
        <!-- Role Badge -->
        @if (Auth::user()->roles->isNotEmpty())
            <div class="hidden sm:flex items-center gap-1.5">
                @foreach (Auth::user()->roles as $role)
                    <x-badge :role="$role->name" size="sm">
                        {{ $role->name }}
                    </x-badge>
                @endforeach
            </div>
        @endif

        <!-- User Dropdown (Alpine.js) -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
            <button
                type="button"
                @click="open = !open"
                class="flex items-center gap-2.5 rounded-full p-1 text-sm focus:outline-hidden hover:ring-2 hover:ring-zinc-300 dark:hover:ring-zinc-700 transition"
                aria-expanded="false"
                :aria-expanded="open.toString()"
            >
                <div class="h-8 w-8 rounded-full bg-linear-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-xs uppercase shadow-xs">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <span class="hidden md:inline-block font-medium text-zinc-700 dark:text-zinc-200">
                    {{ Auth::user()->name }}
                </span>
                <svg class="hidden md:inline-block h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                style="display: none;"
                class="absolute right-0 mt-2 w-56 origin-top-right rounded-2xl border border-zinc-200/80 bg-white py-1.5 shadow-lg dark:border-zinc-800/80 dark:bg-zinc-900 z-50 divide-y divide-zinc-100 dark:divide-zinc-800"
            >
                <div class="px-4 py-2.5">
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Signed in as</p>
                    <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 truncate">{{ Auth::user()->email }}</p>
                </div>

                <div class="py-1">
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800/60 dark:hover:text-zinc-100">
                        <svg class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        Profile Overview
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800/60 dark:hover:text-zinc-100">
                        <svg class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Edit Profile
                    </a>
                    <a href="{{ route('profile.password') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800/60 dark:hover:text-zinc-100">
                        <svg class="h-4 w-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        Change Password
                    </a>
                </div>

                <div class="py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2.5 px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-950/40">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
