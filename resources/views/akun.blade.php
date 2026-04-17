@extends('layouts.store')

@section('title', 'Kenangan Senja - Pengaturan Akun')

@section('content')
    <div class="pt-32 pb-24 container mx-auto px-6 max-w-7xl">
        <!-- Header -->
        <div class="mb-16">
            <h1 class="text-5xl md:text-6xl font-header font-bold text-white italic">
                Pengaturan <span class="text-primary non-italic">Akun.</span>
            </h1>
            <p class="text-slate-500 font-light mt-4">Kelola identitas digital dan keamanan akses Anda di Kenangan Senja.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Profile Identity Card -->
            <div class="lg:col-span-8">
                <div class="glass-dark rounded-[3rem] p-10 border border-white/5 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-primary/10 blur-[100px] -z-10"></div>
                    
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" x-data="{ 
                        imgPreview: '{{ $user->image ? Storage::url($user->image) : asset('img/default-avatar.png') }}' 
                    }">
                        @csrf
                        @method('PUT')
                        
                        <div class="flex flex-col md:flex-row gap-12">
                            <!-- Avatar Section -->
                            <div class="flex-shrink-0 flex flex-col items-center gap-6">
                                <div class="relative group">
                                    <div class="absolute -inset-1 bg-gradient-to-tr from-primary to-orange-400 rounded-full blur opacity-25 group-hover:opacity-50 transition-opacity"></div>
                                    <img :src="imgPreview" class="relative w-40 h-40 rounded-full object-cover border-4 border-espresso-950 shadow-2xl">
                                    <label class="absolute inset-0 flex items-center justify-center bg-black/40 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                        <i class="bi bi-camera text-2xl"></i>
                                        <input type="file" name="image" @change="
                                            const file = $event.target.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => imgPreview = e.target.result;
                                                reader.readAsDataURL(file);
                                            }
                                        " class="hidden">
                                    </label>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-1">Status Keanggotaan</p>
                                    <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase rounded-full border border-primary/20 italic">
                                        {{ auth()->user()->role }} Member
                                    </span>
                                </div>
                            </div>

                            <!-- Inputs Section -->
                            <div class="flex-grow grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold uppercase tracking-widest text-slate-500 ml-1">Nama Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                           class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white focus:ring-primary focus:border-primary transition-all font-light" required>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold uppercase tracking-widest text-slate-500 ml-1">Alamat Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                           class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white focus:ring-primary focus:border-primary transition-all font-light" required>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-bold uppercase tracking-widest text-slate-500 ml-1">Nomor Telepon</label>
                                    <input type="text" name="No_Telp" value="{{ old('No_Telp', $user->No_Telp) }}" 
                                           class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white focus:ring-primary focus:border-primary transition-all font-light" required>
                                </div>

                                <div class="space-y-2 md:col-span-2">
                                    <label class="text-[10px] font-bold uppercase tracking-widest text-slate-500 ml-1">Alamat Pengiriman</label>
                                    <textarea name="address" rows="3" 
                                              class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-white focus:ring-primary focus:border-primary transition-all font-light">{{ old('address', $user->address) }}</textarea>
                                </div>

                                <div class="md:col-span-2 pt-4">
                                    <button type="submit" class="px-8 py-4 bg-primary hover:bg-primary-light text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary/20 flex items-center gap-3">
                                        <i class="bi bi-person-check-fill"></i> Simpan Perubahan Profil
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Check Card -->
            <div class="lg:col-span-4 space-y-8">
                <div class="glass-dark rounded-[3rem] p-10 border border-white/5">
                    <h2 class="text-2xl font-header font-bold text-white mb-8 italic">Keamanan <span class="text-primary non-italic">Akun.</span></h2>
                    
                    <form action="{{ route('profile.changePassword') }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase tracking-widest text-slate-500 ml-1">Password Lama</label>
                            <input type="password" name="current_password" 
                                   class="w-full bg-black/40 border border-white/5 rounded-2xl p-4 text-white focus:ring-primary focus:border-primary transition-all font-light" required>
                        </div>

                        <div class="space-y-4 pt-4">
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold uppercase tracking-widest text-slate-500 ml-1">Password Baru</label>
                                <input type="password" name="new_password" 
                                       class="w-full bg-black/40 border border-white/5 rounded-2xl p-4 text-white focus:ring-primary focus:border-primary transition-all font-light" required>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-bold uppercase tracking-widest text-slate-500 ml-1">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" 
                                       class="w-full bg-black/40 border border-white/5 rounded-2xl p-4 text-white focus:ring-primary focus:border-primary transition-all font-light" required>
                            </div>
                        </div>

                        <button type="submit" class="w-full px-8 py-4 bg-white/5 hover:bg-white/10 text-white font-bold rounded-2xl transition-all border border-white/5 flex items-center justify-center gap-3">
                            <i class="bi bi-key-fill text-primary"></i> Perbarui Password
                        </button>
                    </form>
                </div>

                <!-- Info Card -->
                <div class="bg-primary/10 rounded-[2rem] p-8 border border-primary/20 space-y-4">
                    <div class="flex items-center gap-3 text-primary">
                        <i class="bi bi-info-circle-fill text-xl"></i>
                        <h4 class="font-bold text-sm uppercase tracking-widest">Informasi Privasi</h4>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed font-light">
                        Data profil Anda hanya digunakan untuk kepentingan pengiriman dan layanan personalisasi di Kenangan Senja. Kami menjamin keamanan informasi Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
