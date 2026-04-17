@extends('layouts.store')

@section('title', 'Kenangan Senja - Kategori Produk')

@section('content')
    <div class="pt-32 pb-24 container mx-auto px-6">
        <div class="text-center mb-20 space-y-4">
            <div class="inline-block px-4 py-2 glass-dark rounded-full text-primary text-xs font-bold uppercase tracking-[0.3em]">
                Explore Our Collection
            </div>
            <h1 class="text-5xl md:text-7xl font-header font-bold text-white tracking-tight">
                Pilih <span class="text-primary italic">Kategori</span> Favorit Anda.
            </h1>
            <p class="text-slate-500 max-w-xl mx-auto font-light">Mulai dari biji kopi pilihan hingga camilan artisanal, temukan pelengkap momen senja Anda di sini.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
            <!-- Non Coffee -->
            <a href="{{ route('category.show', 'Non_Coffee') }}" class="group relative block aspect-[4/5] overflow-hidden rounded-[3rem] shadow-2xl transition-all hover-card border border-white/5">
                <img src="{{ asset('storage/img/non.jpg') }}" alt="Non Coffee" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                <div class="absolute inset-0 p-10 flex flex-col justify-end">
                    <p class="text-primary font-bold text-xs uppercase tracking-widest mb-2 opacity-0 group-hover:opacity-100 transition-all translate-y-4 group-hover:translate-y-0">Fresh & Natural</p>
                    <h2 class="text-4xl font-header font-bold text-white italic">Non Coffee</h2>
                    <div class="mt-4 h-1 w-12 bg-primary transition-all group-hover:w-full"></div>
                </div>
            </a>

            <!-- Coffee -->
            <a href="{{ route('category.show', 'Coffee') }}" class="group relative block aspect-[4/5] overflow-hidden rounded-[3rem] shadow-2xl transition-all hover-card border border-white/5 lg:translate-y-12">
                <img src="{{ asset('storage/img/kopi1.jpg') }}" alt="Coffee" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                <div class="absolute inset-0 p-10 flex flex-col justify-end">
                    <p class="text-primary font-bold text-xs uppercase tracking-widest mb-2 opacity-0 group-hover:opacity-100 transition-all translate-y-4 group-hover:translate-y-0">Signature Aroma</p>
                    <h2 class="text-4xl font-header font-bold text-white italic">Coffee</h2>
                    <div class="mt-4 h-1 w-12 bg-primary transition-all group-hover:w-full"></div>
                </div>
            </a>

            <!-- Snack -->
            <a href="{{ route('category.show', 'Snack') }}" class="group relative block aspect-[4/5] overflow-hidden rounded-[3rem] shadow-2xl transition-all hover-card border border-white/5">
                <img src="{{ asset('storage/img/snak.jpg') }}" alt="Snack" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                <div class="absolute inset-0 p-10 flex flex-col justify-end">
                    <p class="text-primary font-bold text-xs uppercase tracking-widest mb-2 opacity-0 group-hover:opacity-100 transition-all translate-y-4 group-hover:translate-y-0">Sweet & Savory</p>
                    <h2 class="text-4xl font-header font-bold text-white italic">Snack</h2>
                    <div class="mt-4 h-1 w-12 bg-primary transition-all group-hover:w-full"></div>
                </div>
            </a>
        </div>
    </div>
@endsection
