@extends('layouts.app')

@section('page_title', 'Tambah Promosi')

@section('content')
<div class="space-y-8 max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('promosi.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-espresso-900 border border-slate-200 dark:border-espresso-800 text-slate-500 hover:text-primary transition-all shadow-sm">
                <i class="bi bi-chevron-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Tambah Promosi Baru</h1>
                <p class="text-slate-500 dark:text-espresso-400 text-[10px] font-bold uppercase tracking-widest mt-1">Marketing / New Campaign</p>
            </div>
        </div>
    </div>

    <form action="{{ route('promotions.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Basic Info -->
            <div class="lg:col-span-2 space-y-8">
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-sm font-bold uppercase tracking-wider flex items-center">
                            <i class="bi bi- megaphone-fill mr-3 text-primary"></i>
                            Informasi Promosi
                        </h3>
                    </x-slot>

                    <div class="space-y-6">
                        <x-input label="Nama Promosi" name="promotion_name" required placeholder="Contoh: Promo Akhir Pekan 2025" />
                        
                        <x-input label="Deskripsi Campaign" name="description" type="textarea" required placeholder="Jelaskan detail promosi ini untuk menarik minat pelanggan..." />
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
                        <x-input label="Persentase Diskon (%)" name="discount_percent" type="number" required placeholder="0" min="0" max="100" />
                        <div class="hidden md:block"></div> <!-- Spacer -->
                        
                        <x-input label="Tanggal Mulai" name="start_date" type="date" required />
                        <x-input label="Tanggal Berakhir" name="end_date" type="date" required />
                    </div>
                </x-card>
            </div>

            <!-- Right Side: Summary & Save -->
            <div class="space-y-8">
                <x-card class="bg-primary/5 dark:bg-primary/10 border-primary/20">
                    <div class="space-y-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-primary/20 text-primary rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">
                                <i class="bi bi-stars"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 dark:text-white">Tips Promosi</h4>
                            <p class="text-xs text-slate-500 dark:text-espresso-400 mt-2 leading-relaxed">
                                Promosi yang efektif biasanya berlangsung antara 7 hingga 14 hari. Pastikan persentase diskon tidak melebihi margin keuntungan Anda.
                            </p>
                        </div>
                    </div>
                </x-card>

                <div class="p-2">
                    <x-button type="submit" variant="primary" class="w-full !py-5 shadow-2xl shadow-primary/30">
                        <i class="bi bi-check2-circle mr-2 text-xl"></i>
                        Simpan Promosi
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
