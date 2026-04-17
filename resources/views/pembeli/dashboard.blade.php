@extends('layouts.store')

@section('title', 'Kenangan Senja | Premium Coffee Experience')

@section('content')
    <!-- Hero Section -->
    <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden">
        <!-- background -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/hero_remastered.png') }}" alt="Hero Background" class="w-full h-full object-cover scale-110">
            <div class="absolute inset-0 hero-overlay"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)" x-show="show" x-transition.duration.1000ms class="max-w-4xl mx-auto space-y-8">
                <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full glass-dark text-primary text-xs font-bold uppercase tracking-[0.3em] mb-4 border-primary/10">
                    <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                    Premium Coffee House
                </div>
                
                <h1 class="text-5xl md:text-8xl font-header font-black text-white leading-[1.1] tracking-tight">
                    @if(auth()->user()->role === 'admin')
                        Selamat Datang, <span class="text-primary italic">Admin.</span>
                    @else
                        Selamat Datang, <span class="text-primary italic">{{ Str::before(auth()->user()->name, ' ') }}</span>
                    @endif
                </h1>
                
                <p class="text-lg md:text-xl text-slate-300 font-light max-w-2xl mx-auto leading-relaxed">
                    Nikmati perpaduan biji kopi pilihan dengan suasana senja yang tak terlupakan. Kami menghadirkan seni dalam setiap cangkir untuk menemani momen berharga Anda.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 pt-8">
                    <a href="{{ route('categories.index') }}" class="w-full sm:w-auto px-12 py-5 bg-primary hover:bg-primary-light text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary/20 hover:shadow-primary/40 flex items-center justify-center gap-3 group">
                        Mulai Jelajahi Menu
                        <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="{{ route('promotepage') }}" class="w-full sm:w-auto px-12 py-5 glass-dark text-white font-bold rounded-2xl transition-all hover:bg-white/10 flex items-center justify-center gap-3">
                        Lihat Promo
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 text-white/30 animate-bounce">
            <i class="bi bi-mouse text-3xl"></i>
        </div>
    </section>

    <!-- Content Sections -->
    <div class="bg-espresso-950 py-24 space-y-32">
        
        <!-- Promotions Carousel (Remastered) -->
        <section class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-header font-bold text-white">Promo <span class="text-primary">Eksklusif</span></h2>
                    <p class="text-slate-500 mt-2 text-sm">Penawaran terbatas untuk hari ini.</p>
                </div>
                <a href="{{ route('promotepage') }}" class="text-primary font-bold text-sm flex items-center gap-2 hover:gap-3 transition-all">Lihat Semua <i class="bi bi-chevron-right"></i></a>
            </div>

            <div x-data="{ current: 0, slides: [
                { id: 1, img: '{{ asset('/img/slide1.jpg') }}', title: 'Senja Classic Combo', desc: 'Diskon 20% untuk paket sarapan.' },
                { id: 2, img: '{{ asset('/img/slide2.jpg') }}', title: 'Latte Art Series', desc: 'Beli 1 gratis 1 setiap jam 5 sore.' },
                { id: 3, img: '{{ asset('/img/slide3.jpg') }}', title: 'Weekend Vibes', desc: 'Gratis pastry untuk setiap pembelian V60.' }
            ] }" class="relative group">
                <div class="overflow-hidden rounded-[2.5rem] shadow-2xl">
                    <div class="flex transition-transform duration-700 ease-out" :style="'transform: translateX(-' + (current * 100) + '%)'">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div class="w-full flex-shrink-0 relative h-[400px] md:h-[500px]">
                                <img :src="slide.img" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent flex flex-col justify-end p-12">
                                    <h3 x-text="slide.title" class="text-3xl md:text-5xl font-header font-bold text-white"></h3>
                                    <p x-text="slide.desc" class="text-slate-300 mt-4 text-lg font-light"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                
                <!-- Controls -->
                <button @click="current = (current > 0) ? current - 1 : slides.length - 1" class="absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 glass-dark rounded-full text-white opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center hover:bg-primary border-none">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button @click="current = (current < slides.length - 1) ? current + 1 : 0" class="absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 glass-dark rounded-full text-white opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center hover:bg-primary border-none">
                    <i class="bi bi-chevron-right"></i>
                </button>

                <!-- Dots -->
                <div class="flex justify-center gap-3 mt-8">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="current = index" class="h-1.5 transition-all rounded-full" :class="current === index ? 'bg-primary w-12' : 'bg-slate-700 w-4'"></button>
                    </template>
                </div>
            </div>
        </section>

        <!-- Featured Categories -->
        <section class="max-w-7xl mx-auto px-6">
             <div class="text-center mb-16">
                <h2 class="text-5xl font-header font-bold text-white mb-4">Menu <span class="text-primary italic">Signature</span></h2>
                <p class="text-slate-500 max-w-md mx-auto">Kami menyajikan kopi terbaik dari seluruh nusantara dengan metode brewing modern.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Product Card Template -->
                <div class="glass-dark p-8 rounded-[2.5rem] transition-all hover-card text-center group">
                    <div class="relative w-48 h-48 mx-auto mb-8">
                        <div class="absolute inset-0 bg-primary/20 blur-3xl rounded-full group-hover:bg-primary/40 transition-colors"></div>
                        <img src="{{ asset('img/espresso_remastered.png') }}" class="w-full h-full object-contain relative z-10 drop-shadow-2xl translate-y-[-10px]">
                    </div>
                    <h3 class="text-2xl font-header font-bold text-white mb-2">Original Espresso</h3>
                    <p class="text-slate-400 text-sm font-light mb-6 leading-relaxed">Pahit yang balance dengan aftertaste fruity yang segar.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-primary font-bold text-xl">IDR 15K</span>
                        <a href="{{ route('categories.index') }}" class="w-10 h-10 bg-white/5 hover:bg-primary text-white rounded-xl flex items-center justify-center transition-all">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    </div>
                </div>

                <div class="glass-dark p-8 rounded-[2.5rem] transition-all hover-card text-center group lg:translate-y-12">
                    <div class="relative w-48 h-48 mx-auto mb-8">
                        <div class="absolute inset-0 bg-primary/20 blur-3xl rounded-full group-hover:bg-primary/40 transition-colors"></div>
                        <img src="{{ asset('img/latte_remastered.png') }}" class="w-full h-full object-contain relative z-10 drop-shadow-2xl translate-y-[-10px]">
                    </div>
                    <h3 class="text-2xl font-header font-bold text-white mb-2">Signature Latte</h3>
                    <p class="text-slate-400 text-sm font-light mb-6 leading-relaxed">Creamy susu dipadukan dengan robusta house-blend.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-primary font-bold text-xl">IDR 19K</span>
                        <a href="{{ route('categories.index') }}" class="w-10 h-10 bg-white/5 hover:bg-primary text-white rounded-xl flex items-center justify-center transition-all">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    </div>
                </div>

                <div class="glass-dark p-8 rounded-[2.5rem] transition-all hover-card text-center group">
                    <div class="relative w-48 h-48 mx-auto mb-8">
                        <div class="absolute inset-0 bg-primary/20 blur-3xl rounded-full group-hover:bg-primary/40 transition-colors"></div>
                        <img src="{{ asset('img/espresso_remastered.png') }}" class="w-full h-full object-contain relative z-10 drop-shadow-2xl translate-y-[-10px] saturate-0 opacity-50">
                    </div>
                    <h3 class="text-2xl font-header font-bold text-white mb-2">Special Americano</h3>
                    <p class="text-slate-400 text-sm font-light mb-6 leading-relaxed">Single origin Arabica Aceh Gayo yang otentik.</p>
                    <div class="flex items-center justify-between">
                        <span class="text-primary font-bold text-xl">IDR 12K</span>
                        <a href="{{ route('categories.index') }}" class="w-10 h-10 bg-white/5 hover:bg-primary text-white rounded-xl flex items-center justify-center transition-all">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection