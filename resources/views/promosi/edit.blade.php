@extends('layouts.app')

@section('page_title', 'Edit Promosi')

@section('content')
<div class="space-y-8 max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('promosi.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-espresso-900 border border-slate-200 dark:border-espresso-800 text-slate-500 hover:text-primary transition-all shadow-sm">
                <i class="bi bi-chevron-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Edit Promosi</h1>
                <p class="text-slate-500 dark:text-espresso-400 text-[10px] font-bold uppercase tracking-widest mt-1">Marketing / Update Campaign</p>
            </div>
        </div>
    </div>

    <form action="{{ route('promosi.update', $promotion->promotion_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Basic Info -->
            <div class="lg:col-span-2 space-y-8">
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-sm font-bold uppercase tracking-wider flex items-center">
                            <i class="bi bi-megaphone-fill mr-3 text-primary"></i>
                            Informasi Promosi
                        </h3>
                    </x-slot>

                    <div class="space-y-6">
                        <x-input label="Nama Promosi" name="promotion_name" :value="$promotion->promotion_name" required placeholder="Contoh: Promo Akhir Pekan 2025" />
                        
                        <x-input label="Deskripsi Campaign" name="description" type="textarea" :value="$promotion->description" required placeholder="Jelaskan detail promosi ini untuk menarik minat pelanggan..." />
                    </div>
                </x-card>

                <!-- Duration & Discounts -->
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-sm font-bold uppercase tracking-wider flex items-center">
                            <i class="bi bi-calendar-range-fill mr-3 text-primary"></i>
                            Masa Berlaku & Diskon
                        </h3>
                    </x-slot>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-input label="Persentase Diskon (%)" name="discount_percent" type="number" :value="$promotion->discount_percent" required placeholder="0" min="0" max="100" />
                        <div class="hidden md:block"></div> <!-- Spacer -->
                        
                        <x-input label="Tanggal Mulai" name="start_date" type="date" :value="\Carbon\Carbon::parse($promotion->start_date)->format('Y-m-d')" required />
                        <x-input label="Tanggal Berakhir" name="end_date" type="date" :value="\Carbon\Carbon::parse($promotion->end_date)->format('Y-m-d')" required />
                    </div>
                </x-card>
            </div>

            <!-- Right Side: Status & Save -->
            <div class="space-y-8">
                <x-card class="bg-primary/5 dark:bg-primary/10 border-primary/20 text-center">
                    <div class="space-y-4">
                        @php
                            $today = now();
                            $start = \Carbon\Carbon::parse($promotion->start_date);
                            $end = \Carbon\Carbon::parse($promotion->end_date);
                            $isActive = $today->between($start, $end);
                        @endphp
                        
                        <div class="w-16 h-16 {{ $isActive ? 'bg-emerald-500/20 text-emerald-500' : 'bg-slate-500/20 text-slate-500' }} rounded-2xl flex items-center justify-center text-3xl mx-auto mb-2">
                            <i class="bi {{ $isActive ? 'bi-check-circle-fill' : 'bi-slash-circle-fill' }}"></i>
                        </div>
                        <h4 class="font-bold text-slate-900 dark:text-white">Status Campaign</h4>
                        <p class="text-xs uppercase tracking-widest font-bold {{ $isActive ? 'text-emerald-500' : 'text-slate-500' }}">
                            {{ $isActive ? 'Campaign Aktif' : 'Campaign Nonaktif' }}
                        </p>
                    </div>
                </x-card>

                <div class="p-2">
                    <x-button type="submit" variant="primary" class="w-full !py-5 shadow-2xl shadow-primary/30">
                        <i class="bi bi-cloud-arrow-up-fill mr-2 text-xl"></i>
                        Perbarui Promosi
                    </x-button>
                    <a href="{{ route('promosi.index') }}" class="block text-center mt-6 text-sm font-bold text-slate-400 hover:text-red-500 transition-colors">
                        Batalkan Perubahan
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
