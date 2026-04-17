@extends('layouts.app')

@section('page_title', 'Dashboard Overview')

@section('content')
<div class="space-y-10">
    <!-- Welcome Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-header font-bold">Halo, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-slate-500 dark:text-espresso-400 mt-1">
                @if(auth()->user()->role === 'admin')
                    Pantau performa toko dan kelola operasional Kenangan Senja Anda hari ini.
                @else
                    Mari kita seduh kopi terbaik dan layani pelanggan dengan sepenuh hati.
                @endif
            </p>
        </div>
        <div class="flex items-center space-x-3 text-sm font-medium" x-data="{ 
            time: new Date().toLocaleTimeString('id-ID'),
            init() {
                setInterval(() => {
                    this.time = new Date().toLocaleTimeString('id-ID');
                }, 1000);
            }
        }">
            <span class="px-4 py-2 bg-white dark:bg-espresso-900 rounded-xl shadow-sm border border-slate-200 dark:border-espresso-800 flex items-center">
                <i class="bi bi-calendar3 mr-2 text-primary"></i>
                {{ now()->format('d M, Y') }}
                <span class="mx-2 text-slate-300 dark:text-espresso-700">|</span>
                <i class="bi bi-clock mr-2 text-primary"></i>
                <span x-text="time"></span>
            </span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @if(auth()->user()->role === 'admin')
        <!-- Revenue Card (Admin Only) -->
        <div class="glass-card p-6 rounded-3xl group hover:border-primary/50 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-500/10 dark:bg-emerald-500/20 text-emerald-500 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <span class="text-[10px] uppercase tracking-tighter font-bold bg-emerald-500/10 text-emerald-500 px-2 py-1 rounded-lg">Financial</span>
            </div>
            <p class="text-slate-400 dark:text-espresso-500 text-sm font-medium">Total Pendapatan</p>
            <h3 class="text-2xl font-bold mt-1">Rp {{ number_format($stats['totalRevenue'], 0, ',', '.') }}</h3>
        </div>
        @else
        <!-- Completed Orders Today (Barista focus) -->
        <div class="glass-card p-6 rounded-3xl group hover:border-primary/50 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center text-2xl font-bold">
                    <i class="bi bi-check-all"></i>
                </div>
                <span class="text-[10px] uppercase tracking-tighter font-bold bg-primary/10 text-primary px-2 py-1 rounded-lg">Performance</span>
            </div>
            <p class="text-slate-400 dark:text-espresso-500 text-sm font-medium">Pesanan Selesai Hari Ini</p>
            <h3 class="text-3xl font-bold mt-1">{{ $stats['completedToday'] }}</h3>
        </div>
        @endif

        <!-- Pending Orders -->
        <div class="glass-card p-6 rounded-3xl hover:border-orange-500/50 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-orange-500/10 text-orange-500 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <span class="text-[10px] uppercase tracking-tighter font-bold bg-orange-500/10 text-orange-500 px-2 py-1 rounded-lg">Queue</span>
            </div>
            <p class="text-slate-400 dark:text-espresso-500 text-sm font-medium">Pesanan Pending</p>
            <h3 class="text-3xl font-bold mt-1">{{ $stats['pendingOrders'] }}</h3>
        </div>

        <!-- Processing Orders -->
        <div class="glass-card p-6 rounded-3xl hover:border-blue-500/50 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-500/10 text-blue-500 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="bi bi-cup-hot-fill"></i>
                </div>
                <span class="text-[10px] uppercase tracking-tighter font-bold bg-blue-500/10 text-blue-500 px-2 py-1 rounded-lg">Process</span>
            </div>
            <p class="text-slate-400 dark:text-espresso-500 text-sm font-medium">Sedang Dibuat</p>
            <h3 class="text-3xl font-bold mt-1">{{ $stats['processingOrders'] }}</h3>
        </div>

        @if(auth()->user()->role === 'admin')
        <!-- Total Users (Admin Only) -->
        <div class="glass-card p-6 rounded-3xl hover:border-indigo-500/50 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-500/10 text-indigo-500 rounded-2xl flex items-center justify-center text-2xl">
                    <i class="bi bi-people-fill"></i>
                </div>
                <span class="text-[10px] uppercase tracking-tighter font-bold bg-indigo-500/10 text-indigo-500 px-2 py-1 rounded-lg">Database</span>
            </div>
            <p class="text-slate-400 dark:text-espresso-500 text-sm font-medium">Total Pelanggan</p>
            <h3 class="text-3xl font-bold mt-1">{{ $stats['totalUsers'] }}</h3>
        </div>
        @else
        <!-- Total Inventory (Barista secondary focus) -->
        <div class="glass-card p-6 rounded-3xl hover:border-slate-500/50 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-slate-500/10 text-slate-500 rounded-2xl flex items-center justify-center text-2xl text-bold">
                   <i class="bi bi-box-fill"></i>
                </div>
                <span class="text-[10px] uppercase tracking-tighter font-bold bg-slate-500/10 text-slate-500 px-2 py-1 rounded-lg">Inventory</span>
            </div>
            <p class="text-slate-400 dark:text-espresso-500 text-sm font-medium">Total Menu Item</p>
            <h3 class="text-3xl font-bold mt-1">{{ $stats['totalProducts'] }}</h3>
        </div>
        @endif
    </div>

    <!-- Main Grid: Recent Orders & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Orders Table -->
        <div class="lg:col-span-2 glass-card rounded-[2.5rem] overflow-hidden">
            <div class="p-8 pb-0 flex items-center justify-between">
                <h3 class="text-xl font-bold">Pesanan Terakhir</h3>
                <a href="{{ route('orders.index') }}" class="text-sm font-bold text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="p-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[11px] uppercase tracking-widest text-slate-400 dark:text-espresso-500 border-b border-slate-100 dark:border-espresso-800">
                                <th class="pb-4 font-bold">Customer</th>
                                <th class="pb-4 font-bold">Status</th>
                                <th class="pb-4 font-bold">Total</th>
                                <th class="pb-4 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-espresso-800">
                            @foreach($stats['recentOrders'] as $order)
                            <tr>
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                        </div>
                                        <span class="ml-3 font-semibold text-sm">{{ $order->user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-4">
                                    @php
                                        $statusClass = [
                                            'Pending' => 'bg-orange-500/10 text-orange-500',
                                            'Processing' => 'bg-blue-500/10 text-blue-500',
                                            'Completed' => 'bg-emerald-500/10 text-emerald-500',
                                            'Cancelled' => 'bg-red-500/10 text-red-500',
                                        ][$order->status] ?? 'bg-slate-500/10 text-slate-500';
                                    @endphp
                                    <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase {{ $statusClass }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="py-4 font-medium text-sm">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="py-4 text-right">
                                    <a href="{{ route('orders.show', $order->order_id) }}" class="p-2 text-slate-400 hover:text-primary transition-colors">
                                        <i class="bi bi-arrow-right-short text-xl"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions / Stock Info -->
        <div class="space-y-6">
            <div class="glass-card p-8 rounded-[2.5rem]">
                <h3 class="text-xl font-bold mb-6 text-header">Aksi Cepat</h3>
                <div class="space-y-3">
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('addproduct') }}" class="flex items-center p-4 rounded-2xl bg-slate-100 dark:bg-espresso-800 hover:bg-primary hover:text-white transition-all group">
                        <i class="bi bi-plus-circle-fill text-xl mr-4 group-hover:text-white transition-colors"></i>
                        <span class="font-bold text-sm">Tambah Produk Baru</span>
                    </a>
                    <a href="{{ route('user.add') }}" class="flex items-center p-4 rounded-2xl bg-slate-100 dark:bg-espresso-800 hover:bg-primary hover:text-white transition-all group">
                        <i class="bi bi-person-plus-fill text-xl mr-4 group-hover:text-white transition-colors"></i>
                        <span class="font-bold text-sm">Tambah User/Barista</span>
                    </a>
                    @endif
                    <a href="{{ route('orders.index') }}" class="flex items-center p-4 rounded-2xl bg-slate-100 dark:bg-espresso-800 hover:bg-primary hover:text-white transition-all group">
                        <i class="bi bi-cart-check-fill text-xl mr-4 group-hover:text-white transition-colors"></i>
                        <span class="font-bold text-sm">Kelola Pesanan Masuk</span>
                    </a>
                </div>
            </div>

            <!-- Promotion Banner (Glassmorphic) -->
            <div class="relative p-8 rounded-[2.5rem] bg-primary text-white overflow-hidden shadow-2xl shadow-primary/20">
                <div class="relative z-10">
                    <h3 class="text-lg font-header font-bold leading-tight">Mulai Hari Dengan Segar</h3>
                    <p class="text-white/80 text-xs mt-2 font-medium">Jangan lupa untuk memeriksa stok bahan baku sebelum jam sibuk dimulai.</p>
                </div>
                <div class="absolute -right-6 -bottom-6 opacity-20 transform -rotate-12">
                    <i class="bi bi-cup-hot-fill text-[120px]"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
