@props([
    'headers' => [],
])

<div class="overflow-hidden rounded-2xl border border-zinc-200/80 dark:border-zinc-800/80 bg-white dark:bg-zinc-900 shadow-xs">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-zinc-600 dark:text-zinc-400">
            <thead class="border-b border-zinc-200/80 bg-zinc-50/75 dark:border-zinc-800/80 dark:bg-zinc-800/40 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                <tr>
                    @if (isset($headerSlot))
                        {{ $headerSlot }}
                    @else
                        @foreach ($headers as $header)
                            <th scope="col" class="px-6 py-3.5">
                                {{ $header }}
                            </th>
                        @endforeach
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800/60 font-normal">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    @if (isset($pagination))
        <div class="border-t border-zinc-200/80 bg-zinc-50/50 px-6 py-4 dark:border-zinc-800/80 dark:bg-zinc-900/50">
            {{ $pagination }}
        </div>
    @endif
</div>
