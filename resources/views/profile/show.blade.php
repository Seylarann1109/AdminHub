<x-app-layout>
    @section('title', 'My Profile')

    <x-slot name="header">
        <div>
            <h1 class="text-xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">Profile Overview</h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400">View personal information and active access entitlements</p>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
        <!-- User Info Card (1 col) -->
        <div class="space-y-6">
            <x-card>
                <div class="flex flex-col items-center text-center pb-6 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="h-20 w-20 rounded-full bg-linear-to-tr from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-2xl uppercase shadow-md shadow-indigo-500/20 mb-4">
                        {{ substr($user->name, 0, 2) }}
                    </div>
                    <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100">{{ $user->name }}</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $user->email }}</p>
                    <div class="mt-3 flex flex-wrap justify-center gap-1.5">
                        @forelse ($user->roles as $role)
                            <x-badge :role="$role->name" size="sm">
                                {{ $role->name }}
                            </x-badge>
                        @empty
                            <x-badge color="zinc" size="sm">User</x-badge>
                        @endforelse
                    </div>
                </div>

                <div class="pt-6 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">Member Since</span>
                        <span class="font-medium text-zinc-900 dark:text-zinc-200">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">Email Status</span>
                        <span class="font-medium text-emerald-600 dark:text-emerald-400 flex items-center gap-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Verified
                        </span>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-zinc-100 dark:border-zinc-800 flex flex-col gap-2">
                    <a href="{{ route('profile.edit') }}" class="w-full text-center rounded-xl bg-indigo-600 px-4 py-2.5 text-xs font-semibold text-white shadow-2xs hover:bg-indigo-500 transition">
                        Edit Profile Details
                    </a>
                    <a href="{{ route('profile.password') }}" class="w-full text-center rounded-xl border border-zinc-300 dark:border-zinc-700 px-4 py-2.5 text-xs font-semibold text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition">
                        Change Password
                    </a>
                </div>
            </x-card>
        </div>

        <!-- Assigned Permissions (2 cols) -->
        <div class="lg:col-span-2">
            <x-card
                title="Active Permissions"
                description="Abilities granted directly or inherited via your assigned role(s)"
            >
                @php
                    $allPermissions = $user->getAllPermissions();
                @endphp

                @if ($user->hasRole('Super Admin'))
                    <div class="mb-5 rounded-xl border border-purple-200 bg-purple-50/70 p-4 text-purple-900 dark:border-purple-900/40 dark:bg-purple-950/30 dark:text-purple-300">
                        <div class="flex items-center gap-2 font-semibold text-sm">
                            <svg class="h-5 w-5 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                            <span>Super Admin Global Gate Access</span>
                        </div>
                        <p class="mt-1 text-xs text-purple-800 dark:text-purple-300/80">
                            As a Super Admin, you implicitly possess root privileges across all current and future authorization abilities via the global gate.
                        </p>
                    </div>
                @endif

                @if ($allPermissions->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach ($allPermissions as $permission)
                            <div class="flex items-center gap-2.5 p-3 rounded-xl border border-zinc-100 dark:border-zinc-800/80 bg-zinc-50/50 dark:bg-zinc-800/30">
                                <div class="flex h-6 w-6 items-center justify-center rounded-lg bg-emerald-100 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400 shrink-0">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <span class="font-mono text-xs font-semibold text-zinc-800 dark:text-zinc-200 block truncate">
                                        {{ $permission->name }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <x-empty-state
                        title="No explicit permissions assigned"
                        description="You currently have basic member privileges."
                    />
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>
