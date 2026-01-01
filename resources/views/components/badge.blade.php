@props(['color' => 'gray'])

@php
    $colors = [
        'gray' => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
        'red' => 'bg-red-50 text-red-700 dark:bg-red-900/30 dark:text-red-300',
        'yellow' => 'bg-yellow-50 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300',
        'green' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300',
        'blue' => 'bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
        'purple' => 'bg-violet-50 text-violet-700 dark:bg-violet-900/30 dark:text-violet-300',
    ];
    $classes = $colors[$color] ?? $colors['gray'];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border border-transparent " . $classes]) }}>
    {{ $slot }}
</span>