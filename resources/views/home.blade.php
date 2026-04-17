@extends('layouts.store')

@section('title', 'Kenangan Senja | Premium Coffee House')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- background -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/homelogin.jpg') }}" alt="Hero Background" class="w-full h-full object-cover scale-105">
            <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/60 to-espresso-950"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)" x-show="show" x-transition.duration.1000ms class="max-w-4xl mx-auto space-y-8">
                <h1 class="text-6xl md:text-9xl font-header font-black text-white leading-[1] tracking-tight">
                    Mari Nikmati <br />Secangkir <span class="text-primary italic">Kopi.</span>
                </h1>
                
                <p class="text-xl md:text-2xl text-slate-300 font-light max-w-2xl mx-auto leading-relaxed">
                    Nikmati kehangatan secangkir kopi terbaik yang kami sajikan khusus untuk Anda. Setiap tegukan membawa kenangan, setiap aroma membuat hari Anda lebih baik.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-10">
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-12 py-5 bg-primary hover:bg-primary-light text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary/20 hover:shadow-primary/40 flex items-center justify-center gap-3 group">
                        Beli Sekarang!
                        <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="#about" class="w-full sm:w-auto px-12 py-5 border border-white/20 text-white font-bold rounded-2xl transition-all hover:bg-white/10">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-32 bg-espresso-950">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-primary/20 blur-3xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <img src="{{ asset('img/tentangkami.jpg') }}" alt="About" class="rounded-[3rem] shadow-2xl relative z-10 border border-white/5 grayscale hover:grayscale-0 transition-all duration-700">
                    <div class="absolute -bottom-10 -right-10 w-48 h-48 glass-dark rounded-full flex items-center justify-center z-20 border border-primary/20 hidden md:flex">
                        <div class="text-center">
                            <p class="text-primary font-header text-4xl font-bold italic">100%</p>
                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Pure Arabica</p>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-8">
                    <div class="inline-block px-4 py-2 glass-dark rounded-full text-primary text-xs font-bold uppercase tracking-[0.3em]">
                        Kenapa memilih kami?
                    </div>
                    <h2 class="text-5xl md:text-6xl font-header font-bold text-white leading-tight">
                        Cita Rasa Kopi <span class="text-primary italic">Lokal</span> Standar Internasional.
                    </h2>
                    <p class="text-lg text-slate-400 font-light leading-relaxed">
                        Di Kenangan Senja, kami hanya menggunakan biji kopi berkualitas tinggi yang dipilih secara teliti dari petani lokal terbaik. Kami percaya bahwa kopi bukan sekadar minuman, tetapi sebuah pengalaman sensorik.
                    </p>
                    <p class="text-lg text-slate-400 font-light leading-relaxed">
                        Dengan beragam pilihan profil sangrai dari berbagai daerah di Indonesia, Anda dapat menemukan karakter rasa yang paling sesuai dengan kepribadian Anda.
                    </p>
                    <div class="grid grid-cols-2 gap-8 pt-6">
                        <div class="space-y-2">
                            <p class="text-white font-bold text-lg italic">Premium Selection</p>
                            <p class="text-sm text-slate-500">Biji kopi pilihan dari Java hingga Toraja.</p>
                        </div>
                        <div class="space-y-2">
                            <p class="text-white font-bold text-lg italic">Expert Barista</p>
                            <p class="text-sm text-slate-500">Diseduh dengan seni dan presisi tinggi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Signature Menu Section -->
    <section id="menu" class="py-32 bg-espresso-900/30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20 space-y-4">
                <h2 class="text-5xl md:text-6xl font-header font-bold text-white italic"><span class="text-primary non-italic">Signature</span> Menu</h2>
                <p class="text-slate-500 max-w-xl mx-auto">Dikurasi secara khusus oleh barista ahli kami untuk memberikan pengalaman rasa yang tak terlupakan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Card 1 -->
                <div class="glass-dark p-8 rounded-[3rem] transition-all hover-card text-center group border border-white/5 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 blur-3xl rounded-full"></div>
                    <div class="relative w-48 h-48 mx-auto mb-8">
                        <img src="{{ asset('img/espresso_remastered.png') }}" class="w-full h-full object-contain relative z-10 drop-shadow-2xl">
                    </div>
                    <h3 class="text-2xl font-header font-bold text-white mb-2">Pure Espresso</h3>
                    <p class="text-slate-500 text-sm font-light mb-6">Pahit yang balance dengan aftertaste fruity yang segar.</p>
                    <p class="text-primary font-bold text-2xl group-hover:scale-110 transition-transform italic">IDR 15K</p>
                </div>

                <!-- Card 2 -->
                <div class="glass-dark p-8 rounded-[3rem] transition-all hover-card text-center group border border-white/5 relative overflow-hidden lg:translate-y-12">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 blur-3xl rounded-full"></div>
                    <div class="relative w-48 h-48 mx-auto mb-8">
                        <img src="{{ asset('img/latte_remastered.png') }}" class="w-full h-full object-contain relative z-10 drop-shadow-2xl">
                    </div>
                    <h3 class="text-2xl font-header font-bold text-white mb-2">Velvet Latte</h3>
                    <p class="text-slate-500 text-sm font-light mb-6">Creamy susu dipadukan dengan robusta house-blend.</p>
                    <p class="text-primary font-bold text-2xl group-hover:scale-110 transition-transform italic">IDR 25K</p>
                </div>

                <!-- Card 3 -->
                <div class="glass-dark p-8 rounded-[3rem] transition-all hover-card text-center group border border-white/5 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 blur-3xl rounded-full"></div>
                    <div class="relative w-48 h-48 mx-auto mb-8">
                        <img src="{{ asset('img/hero_remastered.png') }}" class="w-full h-full object-cover rounded-full relative z-10 drop-shadow-2xl scale-75 border-4 border-primary/20">
                    </div>
                    <h3 class="text-2xl font-header font-bold text-white mb-2">Classic Cappuccino</h3>
                    <p class="text-slate-500 text-sm font-light mb-6">Americano dengan sentuhan busa lembut yang hangat.</p>
                    <p class="text-primary font-bold text-2xl group-hover:scale-110 transition-transform italic">IDR 22K</p>
                </div>
            </div>

            <div class="text-center mt-24">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-4 text-white font-bold hover:text-primary transition-colors group tracking-widest uppercase text-xs">
                    Jelajahi Menu Lengkap 
                    <span class="w-12 h-12 rounded-full glass-dark flex items-center justify-center group-hover:bg-primary transition-all">
                        <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <!-- Social Proof Section -->
    <section class="py-24 border-y border-white/5">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-[10px] font-bold uppercase tracking-[0.5em] text-slate-500 mb-12 italic">Join our community</p>
            <div class="flex flex-wrap justify-center gap-12 md:gap-24 opacity-30 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                <span class="text-4xl font-header font-bold">JAVA COFFEE</span>
                <span class="text-4xl font-header font-bold italic text-primary">BARISTA HUB</span>
                <span class="text-4xl font-header font-bold uppercase">Espresso Lab</span>
                <span class="text-4xl font-header font-bold italic">Senja Vibe</span>
            </div>
        </div>
    </section>
@endsection
