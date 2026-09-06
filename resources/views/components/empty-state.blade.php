@props([
    'title' => 'No records found',
    'description' => 'Try adjusting your search or create a new entry.',
    'icon' => null,
])

<div class="flex flex-col items-center justify-center py-12 px-4 text-center">
    <div class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-100 dark:bg-zinc-800 text-zinc-500 dark:text-zinc-400">
        @if ($icon)
            {!! $icon !!}
        @else
            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>
        @endif
    </div>
    <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ $title }}</h3>
    <p class="mt-1 max-w-sm text-sm text-zinc-500 dark:text-zinc-400">{{ $description }}</p>

    @if ($slot->isNotEmpty())
        <div class="mt-6 flex items-center justify-center gap-3">
            {{ $slot }}
        </div>
    @endif
</div>
