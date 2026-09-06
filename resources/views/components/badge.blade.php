@props([
    'color' => null,
    'role' => null,
    'size' => 'md',
])

@php
if ($role && ! $color) {
    $color = match ($role) {
        'Super Admin' => 'purple',
        'Admin' => 'indigo',
        'Manager' => 'amber',
        'User' => 'emerald',
        default => 'zinc',
    };
}

$color = $color ?? 'zinc';

$colors = [
    'purple' => 'bg-purple-50 text-purple-700 border-purple-200/80 dark:bg-purple-950/40 dark:text-purple-300 dark:border-purple-800/50',
    'indigo' => 'bg-indigo-50 text-indigo-700 border-indigo-200/80 dark:bg-indigo-950/40 dark:text-indigo-300 dark:border-indigo-800/50',
    'blue' => 'bg-blue-50 text-blue-700 border-blue-200/80 dark:bg-blue-950/40 dark:text-blue-300 dark:border-blue-800/50',
    'emerald' => 'bg-emerald-50 text-emerald-700 border-emerald-200/80 dark:bg-emerald-950/40 dark:text-emerald-300 dark:border-emerald-800/50',
    'amber' => 'bg-amber-50 text-amber-700 border-amber-200/80 dark:bg-amber-950/40 dark:text-amber-300 dark:border-amber-800/50',
    'rose' => 'bg-rose-50 text-rose-700 border-rose-200/80 dark:bg-rose-950/40 dark:text-rose-300 dark:border-rose-800/50',
    'zinc' => 'bg-zinc-100 text-zinc-700 border-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700',
];

$sizes = [
    'sm' => 'px-2 py-0.5 text-xs font-medium',
    'md' => 'px-2.5 py-1 text-xs font-semibold',
    'lg' => 'px-3 py-1.5 text-sm font-semibold',
];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 rounded-full border tracking-wide {$colors[$color]} {$sizes[$size]}"]) }}>
    <span class="h-1.5 w-1.5 rounded-full bg-current opacity-70"></span>
    {{ $slot }}
</span>
