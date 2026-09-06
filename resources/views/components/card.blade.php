@props([
    'title' => null,
    'description' => null,
    'actions' => null,
    'footer' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800/80 rounded-2xl shadow-xs transition duration-200 overflow-hidden']) }}>
    @if ($title || $description || $actions || isset($header))
        <div class="px-6 py-5 border-b border-zinc-100 dark:border-zinc-800/80 flex flex-wrap items-center justify-between gap-4">
            @if (isset($header))
                {{ $header }}
            @else
                <div>
                    @if ($title)
                        <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
                            {{ $title }}
                        </h3>
                    @endif
                    @if ($description)
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            {{ $description }}
                        </p>
                    @endif
                </div>
                @if ($actions)
                    <div class="flex items-center gap-3">
                        {{ $actions }}
                    </div>
                @endif
            @endif
        </div>
    @endif

    <div class="p-6">
        {{ $slot }}
    </div>

    @if ($footer || isset($footerSlot))
        <div class="px-6 py-4 bg-zinc-50/50 dark:bg-zinc-900/50 border-t border-zinc-100 dark:border-zinc-800/80">
            {{ $footerSlot ?? $footer }}
        </div>
    @endif
</div>
