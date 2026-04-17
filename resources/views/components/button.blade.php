@props([
    'variant' => 'primary',
    'type' => 'button',
])

@php
    $variants = [
        'primary' => 'bg-primary text-espresso-950 hover:bg-primary-light shadow-lg shadow-primary/20',
        'secondary' => 'bg-slate-100 dark:bg-espresso-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-espresso-700',
        'danger' => 'bg-red-500 text-white hover:bg-red-600 shadow-lg shadow-red-500/20',
        'ghost' => 'bg-transparent text-slate-500 hover:bg-slate-100 dark:hover:bg-espresso-800',
    ];

    $classes = "inline-flex items-center justify-center px-6 py-3 rounded-xl font-bold text-sm transition-all duration-300 transform active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed " . ($variants[$variant] ?? $variants['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
