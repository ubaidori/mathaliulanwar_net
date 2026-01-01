@props(['name', 'title'])

<div
    x-data="{ show: false }"
    x-on:open-modal.window="if ($event.detail.name === '{{ $name }}') show = true"
    x-on:close-modal.window="if ($event.detail.name === '{{ $name }}') show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    class="relative z-50"
    style="display: none;"
>
    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-zinc-800/75 dark:bg-black/80 backdrop-blur-sm"></div>

    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div 
            x-show="show" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="w-full max-w-md bg-white dark:bg-zinc-900 rounded-xl shadow-xl border border-zinc-200 dark:border-zinc-800"
            @click.away="show = false"
        >
            <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                    {{ $title }}
                </h3>
                <button @click="show = false" class="text-zinc-400 hover:text-zinc-500">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"/></svg>
                </button>
            </div>

            <div class="px-6 py-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>