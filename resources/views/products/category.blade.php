@extends('layouts.store')

@section('title', 'Kenangan Senja - ' . $category)

@section('content')
    <div class="pt-32 pb-24 container mx-auto px-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
            <div class="space-y-4">
                <div class="inline-block px-4 py-2 glass-dark rounded-full text-primary text-xs font-bold uppercase tracking-[0.3em]">
                    Collection / {{ $category }}
                </div>
                <h1 class="text-5xl md:text-7xl font-header font-bold text-white tracking-tight">
                    Menu <span class="text-primary italic">{{ $category }}</span>
                </h1>
                <p class="text-slate-500 max-w-xl font-light">Pilihan terbaik dari koleksi {{ Str::lower($category) }} kami, disiapkan dengan penuh ketelitian.</p>
            </div>
            
            <a href="{{ route('promotepage') }}" class="group flex items-center gap-4 bg-primary/10 hover:bg-primary px-8 py-4 rounded-2xl transition-all border border-primary/20">
                <div class="text-right">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-primary group-hover:text-white">Special Offers</p>
                    <p class="text-sm font-bold text-white">Cek Menu Promo</p>
                </div>
                <i class="bi bi-percent text-xl text-primary group-hover:text-white transition-colors"></i>
            </a>
        </div>

        @if($products->isEmpty())
            <div class="text-center py-24 glass-dark rounded-[3rem] border border-white/5">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="bi bi-box-seam text-4xl text-slate-600"></i>
                </div>
                <h2 class="text-2xl font-header font-bold text-white mb-2">Maaf, Menu Kosong</h2>
                <p class="text-slate-500">Belum ada produk di kategori ini untuk saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($products as $product)
                    @if (!$product->is_promoted)
                        <div class="glass-dark rounded-[2.5rem] overflow-hidden transition-all hover-card group border border-white/5 flex flex-col">
                            <!-- Image Container -->
                            <div class="relative aspect-square overflow-hidden">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('img/hero_remastered.png') }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                
                                <!-- Stock Overlay if low -->
                                @if($product->stok <= 0)
                                    <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px] flex items-center justify-center">
                                        <span class="px-6 py-2 bg-red-500/80 text-white text-xs font-bold uppercase tracking-widest rounded-full">Habis Terjual</span>
                                    </div>
                                @elseif($product->stok < 5)
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3 py-1 bg-yellow-500/80 text-black text-[10px] font-black uppercase tracking-widest rounded-full">Stok Tipis!</span>
                                    </div>
                                @endif
                                
                                <!-- Actions Overlay -->
                                <div class="absolute bottom-4 right-4 flex flex-col gap-2 translate-y-20 group-hover:translate-y-0 transition-transform duration-500">
                                    <a href="{{ route('products.detail', ['product_id' => $product->product_id]) }}" 
                                       class="w-12 h-12 bg-primary hover:bg-primary-light text-white rounded-xl flex items-center justify-center shadow-xl shadow-primary/20">
                                        <i class="bi bi-bag-plus-fill"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-8 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-header font-bold text-white leading-tight">{{ $product->name }}</h3>
                                    <span class="text-primary font-bold">Rp{{ number_format($product->price/1000, 0) }}K</span>
                                </div>
                                <p class="text-slate-500 text-xs font-light mb-6 line-clamp-2 leading-relaxed">
                                    {{ $product->description }}
                                </p>
                                
                                <div class="mt-auto flex items-center justify-between border-t border-white/5 pt-6">
                                    <div class="flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $product->stok > 0 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                        <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                                            {{ $product->stok > 0 ? 'Tersedia: ' . $product->stok : 'Kosong' }}
                                        </span>
                                    </div>
                                    <a href="{{ route('products.detail', ['product_id' => $product->product_id]) }}" class="text-[10px] font-bold uppercase tracking-widest text-white hover:text-primary transition-colors">
                                        Detail Produk <i class="bi bi-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
@endsection
