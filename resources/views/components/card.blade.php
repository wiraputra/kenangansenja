<div {{ $attributes->merge(['class' => 'bg-white dark:bg-espresso-900 border border-slate-200 dark:border-espresso-800 rounded-[2rem] shadow-sm overflow-hidden']) }}>
    @if(isset($header))
        <div class="px-8 py-6 border-b border-slate-100 dark:border-espresso-800 bg-slate-50/50 dark:bg-espresso-900/50">
            {{ $header }}
        </div>
    @endif
    
    <div class="p-8">
        {{ $slot }}
    </div>

    @if(isset($footer))
        <div class="px-8 py-4 border-t border-slate-100 dark:border-espresso-800 bg-slate-50/30 dark:bg-espresso-950/30">
            {{ $footer }}
        </div>
    @endif
</div>
