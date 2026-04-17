@extends('layouts.app')

@section('page_title', 'Tambah User')

@section('content')
<div class="space-y-8 max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('user.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-espresso-900 border border-slate-200 dark:border-espresso-800 text-slate-500 hover:text-primary transition-all shadow-sm">
                <i class="bi bi-chevron-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Tambah Pengguna</h1>
                <p class="text-slate-500 dark:text-espresso-400 text-[10px] font-bold uppercase tracking-widest mt-1">Administrative / New Account</p>
            </div>
        </div>
    </div>

    <form action="{{ route('storeuser') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Basic Info -->
            <div class="lg:col-span-2 space-y-8">
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-sm font-bold uppercase tracking-wider flex items-center">
                            <i class="bi bi-person-badge-fill mr-3 text-primary"></i>
                            Identitas Pengguna
                        </h3>
                    </x-slot>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input label="Nama Lengkap" name="name" :value="old('name')" required placeholder="Contoh: Budi Santoso" />
                            <x-input label="E-mail" name="email" type="email" :value="old('email')" required placeholder="budi@example.com" />
                        </div>
                        
                        <x-input label="Alamat Lengkap" name="address" :value="old('address')" required placeholder="Jl. Sudirman No. 123, Jakarta" />
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input label="Nomor Telepon" name="No_Telp" :value="old('No_Telp')" required placeholder="0812xxxxxxxx" />
                            <x-input label="Role Pengguna" name="role" type="select" required>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                <option value="barista" {{ old('role') == 'barista' ? 'selected' : '' }}>Barista</option>
                            </x-input>
                        </div>
                    </div>
                </x-card>

                <!-- Security -->
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-sm font-bold uppercase tracking-wider flex items-center">
                            <i class="bi bi-shield-lock-fill mr-3 text-primary"></i>
                            Keamanan Akun
                        </h3>
                    </x-slot>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-input label="Password" name="password" type="password" required placeholder="••••••••" />
                        <x-input label="Konfirmasi Password" name="password_confirmation" type="password" required placeholder="••••••••" />
                    </div>
                </x-card>
            </div>

            <!-- Right Side: Status & Save -->
            <div class="space-y-8">
                <x-card class="bg-indigo-500/5 dark:bg-indigo-500/10 border-indigo-500/20">
                    <div class="space-y-6">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-indigo-500/20 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-4">
                                <i class="bi bi-info-square"></i>
                            </div>
                            <h4 class="font-bold text-slate-900 dark:text-white">Informasi Role</h4>
                            <div class="text-left space-y-4 mt-4">
                                <div class="bg-white/50 dark:bg-espresso-950/50 p-3 rounded-lg">
                                    <p class="text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase">Admin</p>
                                    <p class="text-[11px] text-slate-500 dark:text-espresso-400 mt-1">Akses penuh ke semua menu manajemen dan pengaturan sistem.</p>
                                </div>
                                <div class="bg-white/50 dark:bg-espresso-950/50 p-3 rounded-lg">
                                    <p class="text-[10px] font-bold text-emerald-600 dark:text-emerald-400 uppercase">Barista</p>
                                    <p class="text-[11px] text-slate-500 dark:text-espresso-400 mt-1">Akses operasional: Monitoring pesanan dan laporan penjualan saja.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>

                <div class="p-2">
                    <x-button type="submit" variant="primary" class="w-full !py-5 shadow-2xl shadow-primary/30">
                        <i class="bi bi-person-check-fill mr-2 text-xl"></i>
                        Daftarkan Pengguna
                    </x-button>
                    <a href="{{ route('user.index') }}" class="block text-center mt-6 text-sm font-bold text-slate-400 hover:text-red-500 transition-colors">
                        Batalkan Perubahan
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
