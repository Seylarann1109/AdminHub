<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white antialiased dark:bg-zinc-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @hasSection('title') - @yield('title') @endif</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        [x-cloak] { display: none !important; }
    </style>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full text-zinc-900 dark:text-zinc-100 flex flex-col">

    <div class="flex min-h-full flex-1">
        <!-- Left Side: Showcase / Brand Billboard (Desktop) -->
        <div class="relative hidden w-0 flex-1 lg:block bg-zinc-900 overflow-hidden">
            <!-- Ambient Gradient Orbs -->
            <div class="absolute -top-24 -left-24 h-96 w-96 rounded-full bg-indigo-600/30 blur-3xl"></div>
            <div class="absolute top-1/2 -right-24 h-96 w-96 rounded-full bg-violet-600/30 blur-3xl"></div>
            <div class="absolute -bottom-24 left-1/3 h-96 w-96 rounded-full bg-purple-600/20 blur-3xl"></div>

            <!-- Content Overlay -->
            <div class="relative z-10 flex h-full flex-col justify-between p-12 lg:p-16">
                <!-- Top Brand -->
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-linear-to-tr from-indigo-500 to-violet-500 text-white shadow-lg shadow-indigo-500/30">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-xl font-bold tracking-tight text-white">AdminHub</span>
                        <span class="block text-[11px] font-semibold uppercase tracking-widest text-indigo-400">Security & RBAC</span>
                    </div>
                </div>

                <!-- Center Highlight -->
                <div class="max-w-lg space-y-6">
                    <div class="inline-flex items-center gap-2 rounded-full border border-indigo-500/30 bg-indigo-500/10 px-3.5 py-1 text-xs font-medium text-indigo-300">
                        <span class="h-2 w-2 rounded-full bg-indigo-400 animate-pulse"></span>
                        Enterprise Role-Based Access Control
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-extrabold tracking-tight text-white leading-tight">
                        Scalable authentication with granular permissions.
                    </h2>
                    <p class="text-base text-zinc-400 leading-relaxed">
                        Seamlessly manage users, customizable roles, and detailed permission matrices with full policy enforcement and instant auditability.
                    </p>

                    <!-- Features bullets -->
                    <div class="grid grid-cols-2 gap-4 pt-4 text-sm text-zinc-300">
                        <div class="flex items-center gap-2.5">
                            <svg class="h-5 w-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            <span>Multi-Role Support</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="h-5 w-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            <span>Super Admin Bypass</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="h-5 w-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            <span>Modular Permissions</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <svg class="h-5 w-5 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            <span>Self-Deletion Guards</span>
                        </div>
                    </div>
                </div>

                <!-- Footer / Tagline -->
                <div class="text-xs text-zinc-500">
                    &copy; {{ date('Y') }} AdminHub. Powered by Laravel 12 & Spatie Permission.
                </div>
            </div>
        </div>

        <!-- Right Side: Form Shell -->
        <div class="flex flex-1 flex-col justify-center px-6 py-12 sm:px-10 lg:flex-none lg:px-20 xl:px-24 bg-white dark:bg-zinc-950 w-full lg:w-[520px] xl:w-[580px]">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <!-- Mobile Brand Header -->
                <div class="lg:hidden flex items-center gap-3 mb-8">
                    <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-linear-to-tr from-indigo-500 to-violet-500 text-white shadow-lg shadow-indigo-500/20">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-lg font-bold tracking-tight text-zinc-900 dark:text-white">AdminHub</span>
                        <span class="block text-[10px] font-semibold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">RBAC</span>
                    </div>
                </div>

                <!-- Flash Notification Banner -->
                @include('partials.flash')

                <!-- Page Content Slot -->
                {{ $slot }}
            </div>
        </div>
    </div>

</body>
</html>
