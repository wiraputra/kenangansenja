@extends('layouts.store')

@section('title', 'Kenangan Senja - Riwayat Pesanan')

@section('content')
    <div class="pt-32 pb-24 container mx-auto px-6 max-w-7xl">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8 text-center md:text-left">
            <div class="space-y-4">
                <div class="inline-block px-4 py-2 glass-dark rounded-full text-primary text-[10px] font-bold uppercase tracking-[0.3em] border border-primary/20">
                    Track Your Moments
                </div>
                <h1 class="text-5xl md:text-7xl font-header font-bold text-white tracking-tight leading-tight">
                    Pesanan <span class="text-primary italic">Saya.</span>
                </h1>
                <p class="text-slate-500 max-w-xl font-light">Status dan riwayat transaksi pkenikmatan kopi Anda.</p>
            </div>
            
            <div class="flex items-center justify-center md:justify-end gap-12">
                <div class="text-center">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-1 italic">Total Pesanan</p>
                    <p class="text-3xl font-header font-bold text-white italic">{{ count($orders) }}</p>
                </div>
            </div>
        </div>

        @if($orders->isEmpty())
            <div class="text-center py-24 glass-dark rounded-[3rem] border border-white/5 space-y-8">
                <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mx-auto transition-transform hover:rotate-12">
                    <i class="bi bi-journal-x text-5xl text-slate-600"></i>
                </div>
                <div class="space-y-2">
                    <h2 class="text-3xl font-header font-bold text-white italic">Wah, Belum Ada Jejak Kopi!</h2>
                    <p class="text-slate-500 font-light max-w-xs mx-auto text-sm leading-relaxed">Sepertinya Anda belum memesan kesegaran senja. Mari buat pesanan pertama Anda sekarang.</p>
                </div>
                <div class="pt-4">
                    <a href="{{ route('categories.index') }}" class="px-12 py-5 bg-primary hover:bg-primary-light text-white font-bold rounded-2xl transition-all shadow-xl shadow-primary/20">
                        Pesan Kopi Sekarang
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($orders as $order)
                    <div class="glass-dark rounded-[2.5rem] p-8 border border-white/5 transition-all hover-card group flex flex-col h-full relative overflow-hidden">
                        <!-- Decorative shadow -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 blur-[60px] -z-10 group-hover:bg-primary/20 transition-all"></div>
                        
                        <div class="flex justify-between items-start mb-10">
                            <div>
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-1">Order Transaction</p>
                                <h3 class="text-xl font-header font-bold text-white italic">#{{ $order->order_id }}</h3>
                            </div>
                            <!-- Status Badge -->
                            <div class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border border-white/5
                                {{ $order->status === 'Pending' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : '' }}
                                {{ $order->status === 'Selesai' || $order->status === 'Completed' ? 'bg-green-500/10 text-green-500 border-green-500/20' : '' }}
                                {{ $order->status === 'Batal' || $order->status === 'Cancelled' ? 'bg-red-500/10 text-red-500 border-red-500/20' : '' }}
                                {{ !in_array($order->status, ['Pending', 'Completed', 'Selesai', 'Batal', 'Cancelled']) ? 'bg-primary/10 text-primary border-primary/20' : '' }}
                            ">
                                {{ $order->status }}
                            </div>
                        </div>

                        <div class="space-y-6 flex-grow">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">Tanggal Transaksi</span>
                                <span class="text-white font-bold italic">{{ $order->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500 text-sm">Total Pembayaran</span>
                                <span class="text-2xl font-header font-bold text-primary italic">IDR {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="pt-8 mt-8 border-t border-white/5 flex flex-col gap-4">
                            <a href="{{ route('orders.detail', $order->order_id) }}" class="w-full py-4 bg-white/5 hover:bg-white/10 text-white font-bold rounded-2xl transition-all border border-white/5 text-center flex items-center justify-center gap-3 text-xs tracking-widest uppercase">
                                <i class="bi bi-eye-fill text-primary"></i> Detail Transaksi
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
