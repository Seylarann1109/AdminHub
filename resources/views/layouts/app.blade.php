<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-zinc-50 antialiased dark:bg-zinc-950">
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
<body class="h-full text-zinc-900 dark:text-zinc-100 flex overflow-hidden" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop & Drawer -->
    <div
        x-show="sidebarOpen"
        x-cloak
        class="fixed inset-0 z-40 lg:hidden"
        role="dialog"
        aria-modal="true"
    >
        <!-- Backdrop -->
        <div
            x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 bg-zinc-900/60 backdrop-blur-xs"
        ></div>

        <!-- Slide-over Panel -->
        <div
            x-show="sidebarOpen"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="relative flex w-full max-w-xs flex-1 flex-col h-full bg-white dark:bg-zinc-900 shadow-2xl"
        >
            <div class="absolute right-0 top-0 -mr-12 pt-4">
                <button
                    type="button"
                    @click="sidebarOpen = false"
                    class="ml-1 flex h-10 w-10 items-center justify-center rounded-full text-white hover:text-zinc-200 focus:outline-hidden"
                    aria-label="Close sidebar"
                >
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            @include('partials.sidebar')
        </div>
    </div>

    <!-- Desktop Static Sidebar -->
    <div class="hidden lg:flex lg:w-64 lg:flex-col shrink-0 h-full">
        @include('partials.sidebar')
    </div>

    <!-- Main Content Shell -->
    <div class="flex flex-1 flex-col overflow-hidden min-w-0">
        <!-- Topbar -->
        @include('partials.topbar')

        <!-- Scrollable Main Container -->
        <main class="flex-1 overflow-y-auto px-4 py-8 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <!-- Flash Notification Banner -->
                @include('partials.flash')

                {{ $slot }}
            </div>
        </main>
    </div>

</body>
</html>
