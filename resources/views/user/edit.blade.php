@extends('layouts.app')

@section('page_title', 'Pengaturan Profil')

@section('content')
<div class="space-y-8 max-w-5xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Edit Profil</h1>
            <p class="text-slate-500 dark:text-espresso-400 text-[10px] font-bold uppercase tracking-widest mt-1">Personal Settings & Account Information</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-500/10 border border-red-500/20 text-red-500 p-4 rounded-2xl flex items-center gap-4">
            <i class="bi bi-exclamation-triangle-fill text-xl"></i>
            <div class="text-xs font-bold uppercase tracking-wider">
                Mohon perbaiki kesalahan pengisian form di bawah ini.
            </div>
        </div>
    @endif

    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Avatar & Bio Quick Info -->
            <div class="lg:col-span-1 space-y-8">
                <x-card class="text-center">
                    <div class="relative group w-32 h-32 mx-auto mb-6">
                        <div class="w-full h-full rounded-full overflow-hidden border-4 border-white dark:border-espresso-800 shadow-xl bg-slate-100 dark:bg-espresso-800 ring-2 ring-primary/20">
                            @if (Auth::user()->image)
                                <img id="preview-avatar" src="{{ asset('storage/' . Auth::user()->image) }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                <img id="preview-avatar" src="{{ asset('img/default-avatar.png') }}" alt="Default Avatar" class="w-full h-full object-cover">
                            @endif
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                <i class="bi bi-camera-fill text-white text-2xl"></i>
                            </div>
                        </div>
                        <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(this)">
                    </div>
                    
                    <h3 class="font-bold text-lg leading-tight">{{ Auth::user()->name }}</h3>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-primary mt-1">{{ Auth::user()->role }}</p>
                    
                    <div class="mt-8 pt-6 border-t border-slate-100 dark:border-espresso-800 text-left">
                        <p class="text-[10px] font-bold text-slate-400 dark:text-espresso-600 uppercase tracking-widest mb-3">Panduan Foto</p>
                        <div class="space-y-2">
                            <p class="text-[11px] text-slate-500 dark:text-espresso-400 flex items-start">
                                <i class="bi bi-check2 text-primary mr-2"></i> Gunakan foto wajah yang jelas
                            </p>
                            <p class="text-[11px] text-slate-500 dark:text-espresso-400 flex items-start">
                                <i class="bi bi-check2 text-primary mr-2"></i> Maksimal ukuran file 2MB
                            </p>
                        </div>
                    </div>
                </x-card>
            </div>

            <!-- Right: Detailed Settings -->
            <div class="lg:col-span-2 space-y-8">
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-sm font-bold uppercase tracking-wider flex items-center">
                            <i class="bi bi-person-fill mr-3 text-primary"></i>
                            Informasi Profil
                        </h3>
                    </x-slot>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input label="Nama Lengkap" name="name" :value="old('name', Auth::user()->name)" required />
                            <x-input label="Alamat Email" name="email" type="email" :value="old('email', Auth::user()->email)" required />
                        </div>
                        
                        <x-input label="Nomor Telepon" name="No_Telp" :value="old('No_Telp', Auth::user()->No_Telp)" required />
                        
                        <x-input label="Alamat Lengkap" name="address" type="textarea" :value="old('address', Auth::user()->address)" required />
                    </div>
                </x-card>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <x-button onclick="window.location.href='{{ route('dashboard') }}'" variant="ghost">
                        Batal
                    </x-button>
                    <x-button type="submit" variant="primary" class="!px-10">
                        <i class="bi bi-check2-circle mr-2"></i>
                        Simpan Perubahan
                    </x-button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview-avatar');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
