@props(['label' => null, 'error' => null])

<div class="space-y-1">
    @if($label)
        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
            {{ $label }}
        </label>
    @endif

    <input {{ $attributes->merge(['class' => 'block w-full rounded-lg border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-2 px-3']) }}>

    @if($error)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $error }}</p>
    @endif
</div>