<footer class="bg-espresso-950 border-t border-white/5 py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <!-- Brand Section -->
            <div class="col-span-1 md:col-span-2 space-y-6">
                <a href="{{ route('home') }}" class="text-2xl font-header font-bold text-white">Kenangan<span class="text-primary italic">Senja</span>.</a>
                <p class="text-slate-500 text-sm leading-relaxed max-w-sm">
                    Menghubungkan Anda dengan cita rasa kopi terbaik nusantara dalam suasana yang tenang dan berkesan. Setiap biji adalah cerita, setiap tegukan adalah kenangan.
                </p>
                <div class="flex items-center gap-4">
                    <a href="#" class="w-10 h-10 bg-white/5 hover:bg-primary text-white rounded-full flex items-center justify-center transition-all">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/5 hover:bg-primary text-white rounded-full flex items-center justify-center transition-all">
                        <i class="bi bi-tiktok"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/5 hover:bg-primary text-white rounded-full flex items-center justify-center transition-all">
                        <i class="bi bi-facebook"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-6">
                <h4 class="text-white font-bold text-sm uppercase tracking-widest">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('pembeli.dashboard') }}" class="text-slate-500 hover:text-primary text-sm transition-colors">Home</a></li>
                    <li><a href="{{ route('aboutus') }}" class="text-slate-500 hover:text-primary text-sm transition-colors">Tentang Kami</a></li>
                    <li><a href="{{ route('categories.index') }}" class="text-slate-500 hover:text-primary text-sm transition-colors">Menu Pilihan</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="space-y-6">
                <h4 class="text-white font-bold text-sm uppercase tracking-widest">Kontak Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <i class="bi bi-geo-alt text-primary"></i>
                        <span class="text-slate-500 text-sm">Jl. Espresso No. 123, Indonesia.</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="bi bi-envelope text-primary"></i>
                        <span class="text-slate-500 text-sm">hello@kenangansenja.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-[11px] text-slate-600 font-bold uppercase tracking-widest">
                &copy; {{ date('Y') }} KENANGAN SENJA. ALL RIGHTS RESERVED.
            </p>
            <div class="flex items-center gap-8">
                <a href="#" class="text-[11px] text-slate-600 hover:text-slate-400 font-bold uppercase tracking-widest transition-colors">Privacy Policy</a>
                <a href="#" class="text-[11px] text-slate-600 hover:text-slate-400 font-bold uppercase tracking-widest transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>