@extends('layouts.store')

@section('title', 'Kenangan Senja - Promosi Eksklusif')

@section('content')
    <div class="pt-32 pb-24 container mx-auto px-6 max-w-7xl">
        <!-- Header -->
        <div class="text-center mb-20 space-y-6">
            <div class="inline-block px-4 py-2 glass-dark rounded-full text-primary text-[10px] font-bold uppercase tracking-[0.3em] border border-primary/20">
                Special Holiday Offers
            </div>
            <h1 class="text-5xl md:text-8xl font-header font-bold text-white tracking-tight leading-none italic">
                PRO<span class="text-primary non-italic">MOSI.</span>
            </h1>
            <p class="text-xl text-slate-300 font-light max-w-2xl mx-auto leading-relaxed">
                Nikmati penawaran menarik dari kami spesial musim ini. Rasakan kemewahan citarasa dengan harga yang lebih bersahabat.
            </p>
        </div>

        @if($promotions->isEmpty())
            <div class="text-center py-24 glass-dark rounded-[3rem] border border-white/5 space-y-8">
                <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mx-auto transition-transform hover:scale-110">
                    <i class="bi bi-gift text-5xl text-slate-600"></i>
                </div>
                <div class="space-y-2">
                    <h2 class="text-3xl font-header font-bold text-white italic">Nantikan Momen Spesial Berikutnya!</h2>
                    <p class="text-slate-500 font-light max-w-xs mx-auto text-sm leading-relaxed">Saat ini belum ada promo aktif. Ikuti terus media sosial kami untuk update terbaru.</p>
                </div>
                <div class="pt-4">
                    <a href="{{ route('categories.index') }}" class="px-12 py-5 bg-primary hover:bg-primary-light text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary/20">
                        Cek Menu Regular
                    </a>
                </div>
            </div>
        @else
            <!-- Grid Produk Promosi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
                @foreach($promotions as $promotion)
                    <div class="flex flex-col glass-dark rounded-[2.5rem] overflow-hidden border border-white/5 transition-all hover-card group relative">
                        
                        <!-- Premium Discount Label -->
                        <div class="absolute top-6 right-6 z-20">
                            <div class="bg-primary px-4 py-2 rounded-xl text-white font-black text-xs shadow-2xl flex flex-col items-center">
                                <span class="text-[8px] uppercase tracking-tighter opacity-70">Disc.</span>
                                {{ $promotion->discount }}%
                            </div>
                        </div>

                        <!-- Product Image Container -->
                        <div class="relative h-[240px] overflow-hidden">
                             <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                  src="{{ asset('storage/'.$promotion->product->image) }}" 
                                  alt="{{ $promotion->product->name }}">
                             <div class="absolute inset-0 bg-gradient-to-t from-espresso-950 to-transparent opacity-60"></div>
                        </div>

                        <!-- Details Section -->
                        <div class="p-8 flex flex-col flex-grow space-y-4">
                            <div class="flex justify-between items-start">
                                <h5 class="text-2xl font-header font-bold text-white group-hover:text-primary transition-colors leading-tight italic">{{ $promotion->product->name }}</h5>
                            </div>
                            
                            <p class="text-slate-500 text-xs font-light leading-relaxed line-clamp-2">
                                {{ Str::words($promotion->product->description, 10, '...') }}
                            </p>

                            <!-- Pricing -->
                            <div class="flex items-center justify-between pt-4">
                                <span class="text-xs font-bold text-slate-600 line-through tracking-tighter">
                                    IDR {{ number_format($promotion->product->price, 0, ',', '.') }}
                                </span>
                                <span class="text-xl font-header font-bold text-primary italic">
                                    IDR {{ number_format($promotion->price_after_discount, 0, ',', '.') }}
                                </span>
                            </div>

                            <!-- Footer Actions -->
                            <div class="pt-6 mt-auto border-t border-white/5 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $promotion->product->stok > 0 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                    <span class="text-[9px] font-bold uppercase tracking-widest text-slate-500">
                                        Stok: {{ $promotion->product->stok > 0 ? $promotion->product->stok : 'Habis' }}
                                    </span>
                                </div>
                                
                                <a href="{{ route('promosi.detail', ['promotion_id' => $promotion->promotion_id]) }}" 
                                   class="text-[9px] font-black uppercase tracking-[0.2em] text-white hover:text-primary transition-colors flex items-center gap-2">
                                    Pesan Sekarang <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
