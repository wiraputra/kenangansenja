@extends('layouts.store')

@section('title', 'Kenangan Senja - Keranjang Saya')

@section('content')
    <div class="pt-32 pb-24 container mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-16 space-y-4">
            <h1 class="text-5xl md:text-6xl font-header font-bold text-white italic">
                Keranjang <span class="text-primary non-italic">Saya.</span>
            </h1>
            <p class="text-slate-500 font-light italic">Pesanan Anda yang sedang disiapkan.</p>
        </div>

        @if(session('cart') && count(session('cart')) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 max-w-7xl mx-auto">
                <!-- Cart Items List -->
                <div class="lg:col-span-2 space-y-6">
                    @foreach(session('cart') as $productId => $details)
                        <div class="glass-dark p-6 rounded-[2rem] border border-white/5 flex flex-col sm:flex-row items-center gap-8 transition-all hover:bg-white/5">
                            <!-- Image -->
                            <div class="w-24 h-24 rounded-2xl overflow-hidden border border-white/10 flex-shrink-0">
                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-cover">
                            </div>

                            <!-- Info -->
                            <div class="flex-grow text-center sm:text-left space-y-1">
                                <h3 class="text-xl font-header font-bold text-white">{{ $details['name'] }}</h3>
                                <p class="text-xs text-slate-500 uppercase tracking-widest font-bold">Premium Select</p>
                                <div class="flex items-center justify-center sm:justify-start gap-4 mt-2">
                                    @if(isset($details['price_after_discount']))
                                        <span class="text-xs line-through text-slate-600">IDR {{ number_format($details['price'], 0, ',', '.') }}</span>
                                        <span class="text-sm font-bold text-primary">IDR {{ number_format($details['price_after_discount'], 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-sm font-bold text-primary">IDR {{ number_format($details['price'], 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div class="px-6 py-2 glass-dark rounded-xl border border-white/5 text-sm font-bold text-white min-w-[80px] text-center">
                                x{{ $details['quantity'] }}
                            </div>

                            <!-- Subtotal -->
                            <div class="min-w-[120px] text-center sm:text-right">
                                <p class="text-[10px] uppercase tracking-[0.2em] text-slate-500 mb-1">Subtotal</p>
                                <p class="text-lg font-bold text-white italic">IDR {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                            </div>

                            <!-- Remove -->
                            <form action="{{ route('cart.remove', $productId) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-3 text-red-400 hover:text-red-500 hover:bg-red-500/10 rounded-xl transition-all">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach

                    <div class="pt-8 flex justify-between items-center px-6">
                         <a href="{{ route('categories.index') }}" class="text-xs font-bold uppercase tracking-widest text-slate-500 hover:text-white transition-colors flex items-center gap-3">
                            <i class="bi bi-arrow-left"></i> Kembali Berbelanja
                        </a>
                        <p class="text-[10px] text-slate-600 font-bold uppercase tracking-[0.3em]">Kenangan Senja Collection</p>
                    </div>
                </div>

                <!-- Order Summary Sidebar -->
                <div class="lg:col-span-1">
                    <div class="glass-dark p-10 rounded-[3rem] border border-white/5 space-y-8 sticky top-32">
                        <h2 class="text-2xl font-header font-bold text-white mb-6">Ringkasan <span class="text-primary italic">Belanja.</span></h2>
                        
                        <div class="space-y-4 pt-6 border-t border-white/5">
                            <div class="flex justify-between text-sm text-slate-400">
                                <span>Total Item</span>
                                <span class="text-white font-bold">{{ count(session('cart')) }} Produk</span>
                            </div>
                            <div class="flex justify-between text-sm text-slate-400">
                                <span>Estimasi Pajak</span>
                                <span class="text-white font-bold italic">Included</span>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-primary/20">
                            <div class="flex flex-col gap-2">
                                <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-primary">Grand Total</p>
                                @php
                                $totalPrice = 0;
                                foreach(session('cart') as $product) {
                                    $totalPrice += $product['price'] * $product['quantity'];
                                }
                                @endphp
                                <p class="text-4xl font-header font-black text-white italic tracking-tighter">IDR {{ number_format($totalPrice, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <form action="{{ route('checkout') }}" method="POST" class="pt-6">
                            @csrf
                            <button type="submit" class="w-full py-5 bg-primary hover:bg-primary-light text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary/20 hover:shadow-primary/40 flex items-center justify-center gap-3 group">
                                <i class="bi bi-cart-check-fill text-xl"></i>
                                CHEKOUT SEKARANG!
                            </button>
                        </form>
                        
                        <div class="pt-6 text-center">
                            <p class="text-[10px] text-slate-500 font-light flex items-center justify-center gap-2">
                                <i class="bi bi-shield-check text-primary"></i> Secure Transaction Guarantee
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="max-w-xl mx-auto text-center py-24 glass-dark rounded-[3rem] border border-white/5 space-y-8">
                <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mx-auto">
                    <i class="bi bi-bag-x text-5xl text-slate-600"></i>
                </div>
                <div class="space-y-2">
                    <h2 class="text-3xl font-header font-bold text-white italic">Wah, Keranjang Masih Kosong!</h2>
                    <p class="text-slate-500 font-light">Sepertinya Anda belum menemukan momen senja yang pas untuk dinikmati.</p>
                </div>
                <div class="pt-6">
                    <a href="{{ route('categories.index') }}" class="px-12 py-5 bg-primary hover:bg-primary-light text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary/20">
                        Ayo Cari Kopi Sekarang
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection