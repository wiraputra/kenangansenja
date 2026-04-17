@extends('layouts.store')

@section('title', 'Kenangan Senja - ' . $product->name)

@section('content')
    <div class="pt-32 pb-24 container mx-auto px-6">
        <!-- Breadcrumbs -->
        <nav class="flex mb-12" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-[10px] font-bold uppercase tracking-widest">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-slate-500 hover:text-white transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center gap-2">
                        <i class="bi bi-chevron-right text-[8px] text-slate-700"></i>
                        <a href="{{ route('categories.index') }}" class="text-slate-500 hover:text-white transition-colors">Menu</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-chevron-right text-[8px] text-slate-700"></i>
                        <span class="text-primary">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <!-- Product Image Section -->
            <div class="relative group">
                <div class="absolute -inset-4 bg-primary/10 blur-3xl rounded-full opacity-50"></div>
                <div class="relative glass-dark p-4 rounded-[4rem] border border-white/5 shadow-2xl overflow-hidden aspect-square">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('img/espresso_remastered.png') }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover rounded-[3rem] shadow-2xl transition-transform duration-700 hover:scale-105">
                    
                    @if($product->stok <= 0)
                        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center">
                            <span class="px-8 py-3 bg-red-500/80 text-white text-sm font-bold uppercase tracking-widest rounded-2xl">Stok Habis</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Info Section -->
            <div class="space-y-10">
                <div class="space-y-4">
                    <div class="inline-block px-4 py-2 bg-primary/10 rounded-full text-primary text-[10px] font-bold uppercase tracking-widest border border-primary/20">
                        {{ $product->role ?? 'Premium Product' }}
                    </div>
                    <h1 class="text-5xl md:text-7xl font-header font-bold text-white tracking-tight leading-tight">
                        {{ $product->name }}
                    </h1>
                    <div class="flex items-center gap-6">
                        <p class="text-3xl font-bold text-primary italic">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="h-6 w-px bg-white/10"></div>
                        <div class="flex items-center gap-2 text-slate-500">
                            <i class="bi bi-box-seam"></i>
                            <span class="text-sm font-light">Stok: {{ $product->stok }} pax</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400">Deskripsi Produk</h3>
                    <p class="text-lg text-slate-400 font-light leading-relaxed">
                        {{ $product->description ?? 'Nikmati cita rasa khas Kenangan Senja yang autentik dalam setiap sajian. Dibuat dengan bahan-bahan pilihan terbaik untuk memastikan kepuasan Anda.' }}
                    </p>
                </div>

                <!-- Control Section -->
                @if($product->stok > 0)
                    <form action="{{ route('add.to.cart', $product->product_id) }}" method="POST" class="space-y-8 pt-6 border-t border-white/5">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-6 items-center">
                            <div x-data="{ count: 1 }" class="flex items-center glass-dark rounded-2xl p-1 border border-white/5 w-full sm:w-auto">
                                <button type="button" @click="count > 1 ? count-- : 1" class="w-12 h-12 flex items-center justify-center text-slate-400 hover:text-white transition-colors">
                                    <i class="bi bi-dash-lg"></i>
                                </button>
                                <input type="number" name="quantity" x-model="count" class="w-16 bg-transparent border-none text-center text-white font-bold focus:ring-0 appearance-none" min="1" max="{{ $product->stok }}">
                                <button type="button" @click="count < {{ $product->stok }} ? count++ : count" class="w-12 h-12 flex items-center justify-center text-slate-400 hover:text-white transition-colors">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>

                            <button type="submit" class="w-full sm:flex-1 py-4 bg-primary hover:bg-primary-light text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary/20 hover:shadow-primary/40 flex items-center justify-center gap-3 group">
                                <i class="bi bi-bag-plus"></i>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                @else
                    <div class="pt-6 border-t border-white/5">
                        <button disabled class="w-full py-4 bg-slate-800 text-slate-500 font-bold rounded-2xl cursor-not-allowed flex items-center justify-center gap-3">
                            <i class="bi bi-slash-circle"></i>
                            Stok Tidak Tersedia
                        </button>
                    </div>
                @endif

                <!-- Tags / Info -->
                <div class="grid grid-cols-2 gap-6 pt-6 italic text-[10px] text-slate-500 uppercase tracking-widest">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-truck text-primary text-lg non-italic"></i> Local Delivery
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="bi bi-patch-check text-primary text-lg non-italic"></i> Quality Approved
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
