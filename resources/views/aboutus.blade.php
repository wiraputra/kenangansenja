@extends('layouts.store')

@section('title', 'Kenangan Senja - Tentang Kami')

@section('content')
    <!-- Hero Brand Story -->
    <section class="relative min-h-[60vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('img/tentangkami.jpg') }}" alt="Our Story" class="w-full h-full object-cover grayscale opacity-50">
            <div class="absolute inset-0 bg-gradient-to-r from-espresso-950 via-espresso-950/80 to-transparent"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl space-y-8">
                <div class="inline-block px-4 py-2 glass-dark rounded-full text-primary text-[10px] font-bold uppercase tracking-[0.3em] border border-primary/20">
                    Our Essence
                </div>
                <h1 class="text-6xl md:text-8xl font-header font-black text-white leading-none">
                    #Tentang<span class="text-primary italic">Kami.</span>
                </h1>
                <p class="text-xl text-slate-300 font-light leading-relaxed indent-12 text-justify">
                    Kami adalah pecinta kopi yang percaya bahwa setiap tegukan memiliki cerita. Berdiri dari passion untuk menyajikan cita rasa kopi terbaik, kami berkomitmen menghadirkan biji kopi pilihan dari petani lokal terbaik di Indonesia. Setiap proses, mulai dari pemilihan biji kopi, roasting, hingga penyeduhan, dilakukan dengan sepenuh hati untuk memberikan pengalaman kopi yang autentik dan tak terlupakan.
                </p>
                <div class="flex items-center gap-8 pt-4">
                    <div class="flex -space-x-4">
                        <img src="/img/wira.jpg" class="w-12 h-12 rounded-full border-2 border-espresso-950 object-cover">
                        <img src="/img/fiky.jpg" class="w-12 h-12 rounded-full border-2 border-espresso-950 object-cover">
                        <img src="/img/yuven.jpg" class="w-12 h-12 rounded-full border-2 border-espresso-950 object-cover">
                        <div class="w-12 h-12 rounded-full border-2 border-espresso-950 bg-primary flex items-center justify-center text-[10px] font-bold">+2</div>
                    </div>
                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest italic">Meet the minds behind the beans</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visionary Founders -->
    <section class="py-32 bg-espresso-950">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-24 space-y-4">
                <h2 class="text-5xl md:text-6xl font-header font-bold text-white italic">#WeAre<span class="text-primary non-italic">Founder.</span></h2>
                <p class="text-slate-500 max-w-xl mx-auto font-light">Para penggerak di balik setiap cangkir kenangan yang Anda nikmati.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8">
                <!-- Founder 1 -->
                <div class="glass-dark rounded-[2.5rem] overflow-hidden border border-white/5 transition-all hover-card group">
                    <div class="relative h-[300px] overflow-hidden">
                        <img src="/img/espresso_remastered.png" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-espresso-950 to-transparent opacity-60"></div>
                    </div>
                    <div class="p-8 space-y-2">
                        <h4 class="text-white font-bold text-sm tracking-tight leading-tight group-hover:text-primary transition-colors italic">Marseliano Varlan Yisrel</h4>
                        <p class="text-slate-500 text-[10px] leading-relaxed line-clamp-3">Founder utama Kenangan Senja. Menjamin setiap operasional berjalan sesuai visi.</p>
                    </div>
                </div>

                <!-- Founder 2 -->
                <div class="glass-dark rounded-[2.5rem] overflow-hidden border border-white/5 transition-all hover-card group lg:translate-y-8">
                    <div class="relative h-[300px] overflow-hidden">
                        <img src="/img/fiky.jpg" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-espresso-950 to-transparent opacity-60"></div>
                    </div>
                    <div class="p-8 space-y-2">
                        <h4 class="text-white font-bold text-sm tracking-tight leading-tight group-hover:text-primary transition-colors italic">Moh Fiky Ardiansyah</h4>
                        <p class="text-slate-500 text-[10px] leading-relaxed line-clamp-3">Ahli kurasi kopi Signature Sauce Tiram yang melegenda di Kenangan Senja.</p>
                    </div>
                </div>

                <!-- Founder 3 -->
                <div class="glass-dark rounded-[2.5rem] overflow-hidden border border-white/5 transition-all hover-card group">
                    <div class="relative h-[300px] overflow-hidden">
                        <img src="/img/yuven.jpg" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-espresso-950 to-transparent opacity-60"></div>
                    </div>
                    <div class="p-8 space-y-2">
                        <h4 class="text-white font-bold text-sm tracking-tight leading-tight group-hover:text-primary transition-colors italic">Yuventinus Pantas</h4>
                        <p class="text-slate-500 text-[10px] leading-relaxed line-clamp-3">Menjaga kualitas pelayanan agar tetap hangat seperti secangkir kopi pagi.</p>
                    </div>
                </div>

                <!-- Founder 4 -->
                <div class="glass-dark rounded-[2.5rem] overflow-hidden border border-white/5 transition-all hover-card group lg:translate-y-8">
                    <div class="relative h-[300px] overflow-hidden">
                        <img src="/img/rizqi.jpg" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-espresso-950 to-transparent opacity-60"></div>
                    </div>
                    <div class="p-8 space-y-2">
                        <h4 class="text-white font-bold text-sm tracking-tight leading-tight group-hover:text-primary transition-colors italic">Rizqi Raditya L.</h4>
                        <p class="text-slate-500 text-[10px] leading-relaxed line-clamp-3">Kreatif di balik estetika digital dan desain yang Anda nikmati saat ini.</p>
                    </div>
                </div>

                <!-- Founder 5 -->
                <div class="glass-dark rounded-[2.5rem] overflow-hidden border border-white/5 transition-all hover-card group">
                    <div class="relative h-[300px] overflow-hidden">
                        <img src="/img/wira.jpg" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-espresso-950 to-transparent opacity-60"></div>
                    </div>
                    <div class="p-8 space-y-2">
                        <h4 class="text-white font-bold text-sm tracking-tight leading-tight group-hover:text-primary transition-colors italic">I Gede Wirawan</h4>
                        <p class="text-slate-500 text-[10px] leading-relaxed line-clamp-3">Penggerak teknis yang memastikan setiap instruksi diseduh dengan sempurna.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Connect Suite -->
    <section class="py-32 bg-espresso-900/20 border-t border-white/5 relative overflow-hidden">
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-primary/10 blur-[120px]"></div>
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div class="space-y-8">
                <div class="inline-block px-4 py-2 glass-dark rounded-full text-primary text-[10px] font-bold uppercase tracking-[0.3em]">
                    Collaboration
                </div>
                <h2 class="text-5xl md:text-7xl font-header font-bold text-white tracking-tight">Hubungi <br/><span class="text-primary italic">Kami!</span></h2>
                <p class="text-xl text-slate-400 font-light leading-relaxed">
                    Tertarik untuk bekerja sama atau sekadar menyapa? Tim kami siap melayani Anda dengan hangat.
                </p>
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 glass-dark rounded-2xl flex items-center justify-center text-primary text-2xl border border-white/5">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Fast Response</p>
                        <p class="text-lg text-white font-header font-bold tracking-tight">+62 823-3934-0351</p>
                    </div>
                </div>
            </div>

            <div class="glass-dark p-12 rounded-[4rem] border border-white/5 space-y-8">
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center text-primary text-sm font-bold italic">1</div>
                        <p class="text-slate-300 font-light">Ketua Sekte (Marsel)</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center text-primary text-sm font-bold italic">2</div>
                        <p class="text-slate-300 font-light">Admin Utama (Fiky)</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center text-primary text-sm font-bold italic">3</div>
                        <p class="text-slate-300 font-light">Asisten Admin (Wirawan)</p>
                    </div>
                </div>
                <hr class="border-white/5">
                <p class="text-[10px] text-center font-bold uppercase tracking-[0.5em] text-slate-600">Terima Kasih Atas Dukungan Anda!</p>
            </div>
        </div>
    </section>
@endsection