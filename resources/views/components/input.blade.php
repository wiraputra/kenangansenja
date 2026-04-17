@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'value' => ''
])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="block text-xs font-bold uppercase tracking-widest text-slate-400 dark:text-espresso-500 ml-1">
            {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
        </label>
    @endif
    
    <div class="relative group">
        @if($type === 'textarea')
            <textarea 
                id="{{ $name }}" 
                name="{{ $name }}" 
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $attributes->merge(['class' => 'w-full bg-slate-50 dark:bg-espresso-950 border border-slate-200 dark:border-espresso-800 rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all min-h-[120px]']) }}
            >{{ $value ?? $slot }}</textarea>
        @elseif($type === 'select')
            <select 
                id="{{ $name }}" 
                name="{{ $name }}"
                {{ $required ? 'required' : '' }}
                {{ $attributes->merge(['class' => 'w-full bg-slate-50 dark:bg-espresso-950 border border-slate-200 dark:border-espresso-800 rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none appearance-none transition-all']) }}
            >
                {{ $slot }}
            </select>
            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                <i class="bi bi-chevron-down"></i>
            </div>
        @else
            <input 
                type="{{ $type }}" 
                id="{{ $name }}" 
                name="{{ $name }}" 
                value="{{ $value }}"
                placeholder="{{ $placeholder }}"
                {{ $required ? 'required' : '' }}
                {{ $attributes->merge(['class' => 'w-full bg-slate-50 dark:bg-espresso-950 border border-slate-200 dark:border-espresso-800 rounded-2xl px-5 py-4 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all']) }}
            >
        @endif
    </div>
</div>
