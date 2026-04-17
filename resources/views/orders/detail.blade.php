@extends('layouts.store')

@section('title', 'Kenangan Senja - Detail Pesanan #' . $order->order_id)

@section('content')
    <div class="pt-32 pb-24 container mx-auto px-6 max-w-5xl">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-6">
            <div class="space-y-4">
                <a href="{{ route('orders.status') }}" class="text-[10px] font-bold uppercase tracking-widest text-slate-500 hover:text-white transition-colors flex items-center gap-2 mb-4">
                    <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
                </a>
                <h1 class="text-4xl md:text-5xl font-header font-bold text-white italic">
                    Ringkasan <span class="text-primary non-italic">Transaksi.</span>
                </h1>
                <p class="text-slate-500 font-light">Detail autentik pesanan senja Anda di bawah ini.</p>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="px-6 py-3 bg-white/5 border border-white/5 rounded-2xl flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Order ID</p>
                        <p class="text-sm font-bold text-white italic">#{{ $order->order_id }}</p>
                    </div>
                    <div class="h-8 w-px bg-white/10"></div>
                     <div class="px-4 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest border border-white/5
                        {{ $order->status === 'Pending' ? 'bg-yellow-500/10 text-yellow-500' : '' }}
                        {{ $order->status === 'Selesai' || $order->status === 'Completed' ? 'bg-green-500/10 text-green-500' : '' }}
                        {{ !in_array($order->status, ['Pending', 'Completed', 'Selesai']) ? 'bg-primary/10 text-primary' : '' }}
                    ">
                        {{ $order->status }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Receipt Card -->
        <div class="glass-dark rounded-[3rem] p-10 md:p-16 border border-white/5 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary to-orange-400"></div>
            
            <!-- Branding/Info -->
            <div class="flex flex-col md:flex-row justify-between gap-12 mb-16 border-b border-white/5 pb-12">
                <div class="space-y-6">
                    <h2 class="text-2xl font-header font-bold text-white">Kenangan<span class="text-primary italic">Senja</span>.</h2>
                    <div class="space-y-1">
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Dikirim ke:</p>
                        <p class="text-lg text-white font-light italic">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-slate-400 font-light max-w-xs">{{ auth()->user()->address ?? 'Alamat belum diatur.' }}</p>
                    </div>
                </div>

                <div class="space-y-6 md:text-right">
                    <div class="space-y-1">
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Tanggal Pesanan</p>
                        <p class="text-lg text-white font-light italic">{{ $order->created_at->format('d F Y') }}</p>
                        <p class="text-xs text-slate-400 font-light">{{ $order->created_at->format('H:i T') }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold uppercase tracking-widest text-slate-500">Metode Pembayaran</p>
                        <p class="text-lg text-white font-light italic">Store Balance / QRIS</p>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="space-y-8 mb-16">
                <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-primary italic">Detail Item</h3>
                <div class="space-y-4">
                    @foreach($order->orderDetails as $detail)
                        <div class="flex items-center justify-between py-4 border-b border-white/5 group hover:bg-white/5 px-4 rounded-xl transition-all">
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 rounded-lg overflow-hidden border border-white/10 group-hover:scale-110 transition-transform">
                                    <img src="{{ $detail->product->image ? asset('storage/' . $detail->product->image) : asset('img/espresso_remastered.png') }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="text-white font-bold">{{ $detail->product->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $detail->quantity }} x Rp {{ number_format($detail->product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <p class="text-white font-bold italic">IDR {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Billing -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                     @if($order->promotion_id)
                        <div class="p-6 bg-primary/10 rounded-2xl border border-primary/20 space-y-2">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-primary">Aplied Promotion</p>
                            <h4 class="text-white font-bold italic">{{ $order->promotion->name }}</h4>
                            <p class="text-xs text-slate-400 font-light">Anda telah menikmati penghematan spesial senja.</p>
                        </div>
                    @endif
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Subtotal Item</span>
                        <span class="text-white font-bold">IDR {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Pajak (Included)</span>
                        <span class="text-white font-bold">Rp 0</span>
                    </div>
                    <div class="pt-6 border-t border-white/10 flex justify-between items-end">
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-primary italic opacity-70">Total Pembayaran</p>
                            <p class="text-4xl font-header font-black text-white italic tracking-tighter">IDR {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-green-500 bg-green-500/10 px-3 py-1 rounded-full border border-green-500/20">
                            Verified Pain
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer Note -->
            <div class="mt-20 pt-8 border-t border-dashed border-white/10 text-center">
                <p class="text-[10px] text-slate-600 font-bold uppercase tracking-[0.4em]">Nikmati Setiap Tegukannya. Kenangan Senja @ {{ date('Y') }}</p>
            </div>
        </div>
    </div>
@endsection
