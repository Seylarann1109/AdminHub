@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50/90 p-4 text-emerald-800 shadow-xs dark:border-emerald-900/40 dark:bg-emerald-950/30 dark:text-emerald-300">
        <svg class="h-5 w-5 shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        <div class="flex-1 text-sm font-medium leading-relaxed">
            {{ session('success') }}
        </div>
        <button type="button" @click="show = false" class="inline-flex rounded-md p-1 text-emerald-600 transition hover:bg-emerald-100 dark:text-emerald-400 dark:hover:bg-emerald-900/50" aria-label="Dismiss">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms class="mb-5 flex items-start gap-3 rounded-xl border border-rose-200 bg-rose-50/90 p-4 text-rose-800 shadow-xs dark:border-rose-900/40 dark:bg-rose-950/30 dark:text-rose-300">
        <svg class="h-5 w-5 shrink-0 text-rose-600 dark:text-rose-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        <div class="flex-1 text-sm font-medium leading-relaxed">
            {{ session('error') }}
        </div>
        <button type="button" @click="show = false" class="inline-flex rounded-md p-1 text-rose-600 transition hover:bg-rose-100 dark:text-rose-400 dark:hover:bg-rose-900/50" aria-label="Dismiss">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

@if (session('status'))
    <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.300ms class="mb-5 flex items-start gap-3 rounded-xl border border-blue-200 bg-blue-50/90 p-4 text-blue-800 shadow-xs dark:border-blue-900/40 dark:bg-blue-950/30 dark:text-blue-300">
        <svg class="h-5 w-5 shrink-0 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
        </svg>
        <div class="flex-1 text-sm font-medium leading-relaxed">
            {{ session('status') }}
        </div>
        <button type="button" @click="show = false" class="inline-flex rounded-md p-1 text-blue-600 transition hover:bg-blue-100 dark:text-blue-400 dark:hover:bg-blue-900/50" aria-label="Dismiss">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
@endif

@if ($errors->any())
    <div x-data="{ show: true }" x-show="show" class="mb-5 rounded-xl border border-rose-200 bg-rose-50/90 p-4 text-rose-900 shadow-xs dark:border-rose-900/40 dark:bg-rose-950/30 dark:text-rose-200">
        <div class="flex items-center gap-2 font-semibold text-sm text-rose-700 dark:text-rose-400 mb-2">
            <svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <span>There were some problems with your submission:</span>
        </div>
        <ul class="list-disc pl-5 text-sm space-y-1 text-rose-700 dark:text-rose-300">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
