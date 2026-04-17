@extends('layouts.store')

@section('title', 'Kenangan Senja - Detail Promosi')

@section('content')
    <div class="pt-32 pb-24 container mx-auto px-6 max-w-7xl">
        <!-- Breadcrumbs -->
        <nav class="flex mb-12" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-[10px] font-bold uppercase tracking-widest">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-slate-500 hover:text-white transition-colors">Home</a>
                </li>
                <li>
                    <div class="flex items-center gap-2">
                        <i class="bi bi-chevron-right text-[8px] text-slate-700"></i>
                        <a href="{{ route('promotepage') }}" class="text-slate-500 hover:text-white transition-colors">Promosi</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center gap-2">
                        <i class="bi bi-chevron-right text-[8px] text-slate-700"></i>
                        <span class="text-primary">{{ $promotion->product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <!-- Product Image Section -->
            <div class="relative group">
                <div class="absolute -inset-4 bg-primary/10 blur-3xl rounded-full opacity-50"></div>
                <div class="relative glass-dark p-4 rounded-[4rem] border border-white/5 shadow-2xl overflow-hidden aspect-square">
                    <img src="{{ $promotion->product->image ? asset('storage/' . $promotion->product->image) : asset('img/espresso_remastered.png') }}" 
                         alt="{{ $promotion->product->name }}" 
                         class="w-full h-full object-cover rounded-[3rem] shadow-2xl transition-transform duration-700 hover:scale-105">
                    
                    <!-- Promo Label -->
                    <div class="absolute top-10 left-10 z-20">
                        <div class="bg-primary px-6 py-3 rounded-2xl text-white font-black text-sm shadow-2xl flex flex-col items-center">
                            <span class="text-[10px] uppercase tracking-tighter opacity-70 italic">Special Offer</span>
                            -{{ $promotion->discount }}%
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promotion Info Section -->
            <div class="space-y-10">
                <div class="space-y-4">
                    <div class="inline-block px-4 py-2 bg-yellow-500/10 rounded-full text-yellow-500 text-[10px] font-bold uppercase tracking-widest border border-yellow-500/20">
                        Limited Time Promotion
                    </div>
                    <h1 class="text-5xl md:text-7xl font-header font-bold text-white tracking-tight leading-tight italic">
                        {{ $promotion->product->name }}
                    </h1>
                    
                    <div class="flex items-center gap-6">
                        <div class="space-y-1">
                            <p class="text-xs line-through text-slate-600 font-bold tracking-tighter">IDR {{ number_format($promotion->product->price, 0, ',', '.') }}</p>
                            <p class="text-4xl font-header font-black text-primary italic">IDR {{ number_format($promotion->price_after_discount, 0, ',', '.') }}</p>
                        </div>
                        <div class="h-10 w-px bg-white/10 mx-4"></div>
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-2 text-slate-500">
                                <i class="bi bi-box-seam"></i>
                                <span class="text-[10px] font-bold uppercase tracking-widest">Tersedia: {{ $promotion->product->stok }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-red-400">
                                <i class="bi bi-clock-history"></i>
                                <span class="text-[10px] font-bold uppercase tracking-widest">Hingga {{ \Carbon\Carbon::parse($promotion->end_date)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400">Deskripsi Penawaran</h3>
                    <p class="text-lg text-slate-400 font-light leading-relaxed">
                        {{ $promotion->product->description }}
                    </p>
                </div>

                <!-- Control Section -->
                @if($promotion->product->stok > 0)
                    <form action="{{ route('add.to.cart', $promotion->product->product_id) }}" method="POST" class="space-y-8 pt-6 border-t border-white/5" x-data="{ count: 1 }">
                        @csrf
                        <div class="flex flex-col sm:flex-row gap-6 items-center">
                            <div class="flex items-center glass-dark rounded-2xl p-1 border border-white/5 w-full sm:w-auto">
                                <button type="button" @click="count > 1 ? count-- : 1" class="w-12 h-12 flex items-center justify-center text-slate-400 hover:text-white transition-colors">
                                    <i class="bi bi-dash-lg"></i>
                                </button>
                                <input type="number" name="quantity" x-model="count" class="w-16 bg-transparent border-none text-center text-white font-bold focus:ring-0 appearance-none" min="1" max="{{ $promotion->product->stok }}">
                                <button type="button" @click="count < {{ $promotion->product->stok }} ? count++ : count" class="w-12 h-12 flex items-center justify-center text-slate-400 hover:text-white transition-colors">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>

                            <button type="submit" class="w-full sm:flex-1 py-4 bg-primary hover:bg-primary-light text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary/20 hover:shadow-primary/40 flex items-center justify-center gap-3 group">
                                <i class="bi bi-cart-check"></i>
                                Klaim Promo Sekarang!
                            </button>
                        </div>
                    </form>
                @else
                    <div class="pt-6 border-t border-white/5">
                        <button disabled class="w-full py-4 bg-slate-800 text-slate-500 font-bold rounded-2xl cursor-not-allowed flex items-center justify-center gap-3">
                            <i class="bi bi-slash-circle"></i>
                            Stok Promo Habis
                        </button>
                    </div>
                @endif

                <!-- Info Cards -->
                <div class="bg-primary/5 rounded-[2rem] p-6 border border-primary/10 flex items-center gap-6">
                    <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center text-primary">
                        <i class="bi bi-shield-lock text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-primary mb-1">Authentic Guarantee</p>
                        <p class="text-xs text-slate-400 font-light">Setiap pesanan diproses langsung oleh barista kami untuk menjaga kualitas.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
