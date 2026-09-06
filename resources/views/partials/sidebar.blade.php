<aside class="flex flex-col h-full bg-white dark:bg-zinc-900 border-r border-zinc-200/80 dark:border-zinc-800/80">
    <!-- Brand Header -->
    <div class="flex items-center gap-3 px-6 h-16 border-b border-zinc-200/80 dark:border-zinc-800/80 shrink-0">
        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-linear-to-tr from-indigo-600 to-violet-600 text-white shadow-md shadow-indigo-500/20">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </div>
        <div class="leading-none">
            <span class="text-base font-bold tracking-tight text-zinc-900 dark:text-white">AdminHub</span>
            <span class="block text-[10px] font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400 mt-0.5">RBAC & Auth</span>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto px-4 py-6 space-y-6">
        <!-- Main Section -->
        <div>
            <div class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                Main
            </div>
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950/50 dark:text-indigo-300' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/60 dark:hover:text-zinc-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition {{ request()->routeIs('dashboard') ? 'text-indigo-600 dark:text-indigo-400' : 'text-zinc-400 group-hover:text-zinc-600 dark:text-zinc-500 dark:group-hover:text-zinc-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('profile.show') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950/50 dark:text-indigo-300' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/60 dark:hover:text-zinc-200' }}">
                    <svg class="h-5 w-5 shrink-0 transition {{ request()->routeIs('profile.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-zinc-400 group-hover:text-zinc-600 dark:text-zinc-500 dark:group-hover:text-zinc-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <span>My Profile</span>
                </a>
            </nav>
        </div>

        <!-- Administration Section -->
        @canany(['users.view', 'roles.view', 'permissions.view'])
            <div>
                <div class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                    Access Control (RBAC)
                </div>
                <nav class="space-y-1">
                    @can('users.view')
                        <a href="{{ route('admin.users.index') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.users.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950/50 dark:text-indigo-300' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/60 dark:hover:text-zinc-200' }}">
                            <svg class="h-5 w-5 shrink-0 transition {{ request()->routeIs('admin.users.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-zinc-400 group-hover:text-zinc-600 dark:text-zinc-500 dark:group-hover:text-zinc-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            <span>Users</span>
                        </a>
                    @endcan

                    @can('roles.view')
                        <a href="{{ route('admin.roles.index') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.roles.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950/50 dark:text-indigo-300' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/60 dark:hover:text-zinc-200' }}">
                            <svg class="h-5 w-5 shrink-0 transition {{ request()->routeIs('admin.roles.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-zinc-400 group-hover:text-zinc-600 dark:text-zinc-500 dark:group-hover:text-zinc-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                            <span>Roles</span>
                        </a>
                    @endcan

                    @can('permissions.view')
                        <a href="{{ route('admin.permissions.index') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium transition {{ request()->routeIs('admin.permissions.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-950/50 dark:text-indigo-300' : 'text-zinc-600 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/60 dark:hover:text-zinc-200' }}">
                            <svg class="h-5 w-5 shrink-0 transition {{ request()->routeIs('admin.permissions.*') ? 'text-indigo-600 dark:text-indigo-400' : 'text-zinc-400 group-hover:text-zinc-600 dark:text-zinc-500 dark:group-hover:text-zinc-300' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                            </svg>
                            <span>Permissions</span>
                        </a>
                    @endcan
                </nav>
            </div>
        @endcanany
    </div>

    <!-- Bottom User Status & Logout -->
    <div class="p-4 border-t border-zinc-200/80 dark:border-zinc-800/80 shrink-0 bg-zinc-50/50 dark:bg-zinc-900/50">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <div class="h-9 w-9 rounded-full bg-linear-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-xs uppercase shrink-0">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-zinc-900 dark:text-white truncate">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate">
                        {{ Auth::user()->roles->first()?->name ?? 'User' }}
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-2 rounded-xl text-zinc-400 hover:text-rose-600 hover:bg-rose-50 dark:text-zinc-500 dark:hover:text-rose-400 dark:hover:bg-rose-950/40 transition" title="Sign out" aria-label="Sign out">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>
