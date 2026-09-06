@props([
    'title',
    'value',
    'subtext' => null,
    'color' => 'indigo',
    'icon' => null,
])

@php
$colorStyles = [
    'indigo' => [
        'bg' => 'bg-indigo-50 dark:bg-indigo-950/40',
        'text' => 'text-indigo-600 dark:text-indigo-400',
        'border' => 'border-indigo-100 dark:border-indigo-900/30',
        'badge' => 'bg-indigo-100/60 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300',
    ],
    'purple' => [
        'bg' => 'bg-purple-50 dark:bg-purple-950/40',
        'text' => 'text-purple-600 dark:text-purple-400',
        'border' => 'border-purple-100 dark:border-purple-900/30',
        'badge' => 'bg-purple-100/60 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300',
    ],
    'emerald' => [
        'bg' => 'bg-emerald-50 dark:bg-emerald-950/40',
        'text' => 'text-emerald-600 dark:text-emerald-400',
        'border' => 'border-emerald-100 dark:border-emerald-900/30',
        'badge' => 'bg-emerald-100/60 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-300',
    ],
    'amber' => [
        'bg' => 'bg-amber-50 dark:bg-amber-950/40',
        'text' => 'text-amber-600 dark:text-amber-400',
        'border' => 'border-amber-100 dark:border-amber-900/30',
        'badge' => 'bg-amber-100/60 text-amber-700 dark:bg-amber-900/40 dark:text-amber-300',
    ],
];
$style = $colorStyles[$color] ?? $colorStyles['indigo'];
@endphp

<div class="relative overflow-hidden rounded-2xl border border-zinc-200/80 bg-white p-6 shadow-xs transition hover:shadow-md dark:border-zinc-800/80 dark:bg-zinc-900">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium tracking-tight text-zinc-500 dark:text-zinc-400">{{ $title }}</p>
            <p class="mt-2 text-3xl font-bold tracking-tight text-zinc-900 dark:text-zinc-50">{{ $value }}</p>
        </div>
        <div class="rounded-2xl p-3 {{ $style['bg'] }} {{ $style['text'] }}">
            @if (isset($iconSlot))
                {{ $iconSlot }}
            @elseif ($icon)
                {!! $icon !!}
            @else
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                </svg>
            @endif
        </div>
    </div>
    @if ($subtext)
        <div class="mt-4 flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400">
            <span class="inline-flex items-center rounded-md px-1.5 py-0.5 font-medium {{ $style['badge'] }}">
                Active
            </span>
            <span>{{ $subtext }}</span>
        </div>
    @endif
</div>
