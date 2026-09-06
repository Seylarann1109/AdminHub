@props([
    'disabled' => false,
    'name',
    'label' => null,
    'type' => 'text',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'help' => null,
    'autocomplete' => null,
])

<div class="space-y-1.5">
    @if ($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
            {{ $label }}
            @if ($required)
                <span class="text-rose-500">*</span>
            @endif
        </label>
    @endif

    <div class="relative">
        <input
            {{ $disabled ? 'disabled' : '' }}
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            {{ $attributes->class([
                'block w-full rounded-xl border px-3.5 py-2.5 text-sm text-zinc-900 shadow-2xs transition placeholder:text-zinc-400 focus:outline-none focus:ring-2 focus:ring-offset-0 disabled:bg-zinc-50 disabled:text-zinc-500 dark:bg-zinc-800/60 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:disabled:bg-zinc-800/30',
                'border-zinc-300 focus:border-indigo-500 focus:ring-indigo-500/20 dark:border-zinc-700 dark:focus:border-indigo-400' => ! $errors->has($name),
                'border-rose-300 text-rose-900 focus:border-rose-500 focus:ring-rose-500/20 dark:border-rose-800 dark:text-rose-200' => $errors->has($name),
            ]) }}
        >
    </div>

    @if ($help && ! $errors->has($name))
        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $help }}</p>
    @endif

    @error($name)
        <p class="text-xs font-medium text-rose-600 dark:text-rose-400 flex items-center gap-1">
            <svg class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>
