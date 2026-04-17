@extends('layouts.app')

@section('page_title', 'Laporan Penjualan')

@section('content')
<div class="space-y-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Rekap Penjualan</h1>
            <p class="text-slate-500 dark:text-espresso-400 mt-1 uppercase text-[10px] font-bold tracking-[0.2em]">Business Analytics & Performance</p>
        </div>
        
        <div class="flex items-center gap-3">
            <x-button variant="secondary" class="gap-2">
                <i class="bi bi-download"></i>
                Export PDF
            </x-button>
            <x-button variant="primary" class="gap-2">
                <i class="bi bi-printer"></i>
                Cetak Laporan
            </x-button>
        </div>
    </div>

    <!-- Analytics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Total Revenue -->
        <x-card class="relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[10px] font-bold text-emerald-500 uppercase tracking-widest mb-2">Total Gross Sales</p>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Rp {{ number_format($total_sales, 0, ',', '.') }}</h2>
                <div class="mt-4 flex items-center text-xs font-semibold text-emerald-500 bg-emerald-500/10 rounded-full px-3 py-1 w-fit">
                    <i class="bi bi-graph-up-arrow mr-2"></i>
                    All Time Revenue
                </div>
            </div>
            <div class="absolute -right-4 -bottom-4 text-emerald-500/10 group-hover:scale-110 transition-transform duration-500">
                <i class="bi bi-piggy-bank-fill text-[120px]"></i>
            </div>
        </x-card>

        <!-- Total Orders -->
        <x-card class="relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-2">Total Transactions</p>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">{{ $total_orders }}</h2>
                <p class="text-xs text-slate-400 dark:text-espresso-600 mt-4 leading-tight">Total pesanan sukses dan diproses hingga saat ini.</p>
            </div>
            <div class="absolute -right-4 -bottom-4 text-blue-500/10 group-hover:scale-110 transition-transform duration-500">
                <i class="bi bi-cart-check-fill text-[120px]"></i>
            </div>
        </x-card>

        <!-- Dynamic Tip -->
        <x-card class="bg-primary/5 dark:bg-primary/10 border-primary/20 flex flex-col justify-center">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-primary/20 text-primary flex items-center justify-center text-2xl shrink-0">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-slate-900 dark:text-white">Wawasan Bisnis</h4>
                    <p class="text-[11px] text-slate-500 dark:text-espresso-400 mt-1 leading-relaxed">Gunakan data ini untuk merencanakan stok bahan baku dan promosi di periode berikutnya.</p>
                </div>
            </div>
        </x-card>
    </div>

    <!-- Details Section -->
    <div class="space-y-6">
        <h3 class="text-sm font-bold uppercase tracking-[0.3em] text-slate-400 dark:text-espresso-600 flex items-center ml-2">
            <i class="bi bi-pie-chart-fill mr-4"></i>
            Rangkuman Berdasarkan Status
        </h3>
        
        <x-card class="!p-0 overflow-hidden shadow-2xl shadow-slate-200/40 dark:shadow-none">
            <x-table>
                <x-slot name="head">
                    <th class="px-8 py-5 font-bold">Status Pesanan</th>
                    <th class="px-6 py-5 font-bold text-center">Jumlah Transaksi</th>
                    <th class="px-8 py-5 font-bold text-right">Total Nominal</th>
                </x-slot>
                
                <x-slot name="body">
                    @foreach($status_summary as $summary)
                    <tr class="group hover:bg-slate-50/80 dark:hover:bg-espresso-800/30 transition-colors">
                        <td class="px-8 py-5">
                            <div class="flex items-center">
                                @php
                                    $statusIcon = [
                                        'Pending' => 'bi-hourglass-split text-orange-500',
                                        'Processing' => 'bi-cup-hot-fill text-blue-500',
                                        'Completed' => 'bi-check-circle-fill text-emerald-500',
                                        'Cancelled' => 'bi-x-circle-fill text-red-500',
                                    ][$summary->status] ?? 'bi-circle text-slate-400';
                                @endphp
                                <i class="bi {{ $statusIcon }} text-xl mr-4"></i>
                                <span class="font-bold text-slate-700 dark:text-espresso-300">{{ $summary->status }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-center font-bold text-slate-500 dark:text-espresso-500">
                            {{ $summary->count }}
                        </td>
                        <td class="px-8 py-5 text-right font-bold text-slate-900 dark:text-white">
                            Rp {{ number_format($summary->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </x-card>
    </div>
</div>
@endsection
