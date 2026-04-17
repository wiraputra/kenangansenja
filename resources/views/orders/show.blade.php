@extends('layouts.app')

@section('page_title', 'Detail Pesanan')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Header with Breadcrumbs -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('orders.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-espresso-900 border border-slate-200 dark:border-espresso-800 text-slate-500 hover:text-primary transition-all shadow-sm">
                <i class="bi bi-chevron-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">ORD-{{ str_pad($order->order_id, 3, '0', STR_PAD_LEFT) }}</h1>
                <p class="text-slate-500 dark:text-espresso-400 text-[10px] font-bold uppercase tracking-widest mt-1">Transaction Information</p>
            </div>
        </div>
        
        <div class="flex items-center gap-2">
            @php
                $statusClass = [
                    'Pending' => 'bg-orange-500/10 text-orange-500',
                    'Processing' => 'bg-blue-500/10 text-blue-500',
                    'Completed' => 'bg-emerald-500/10 text-emerald-500',
                    'Cancelled' => 'bg-red-500/10 text-red-500',
                ][$order->status] ?? 'bg-slate-500/10 text-slate-500';
            @endphp
            <span class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-widest shadow-sm {{ $statusClass }}">
                {{ $order->status }}
            </span>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Customer Info -->
        <x-card class="md:col-span-1">
            <x-slot name="header">
                <h3 class="text-xs font-bold uppercase tracking-wider flex items-center">
                    <i class="bi bi-person-fill mr-3 text-primary"></i>
                    Customer Info
                </h3>
            </x-slot>
            
            <div class="space-y-6 text-sm">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 dark:text-espresso-600 uppercase tracking-widest mb-1">Full Name</p>
                    <p class="font-bold text-slate-900 dark:text-white">{{ $order->user->name }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 dark:text-espresso-600 uppercase tracking-widest mb-1">Contact</p>
                    <p class="text-slate-600 dark:text-espresso-300">{{ $order->user->No_Telp }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 dark:text-espresso-600 uppercase tracking-widest mb-1">Shipping Address</p>
                    <p class="text-slate-600 dark:text-espresso-300 leading-relaxed">{{ $order->user->address }}</p>
                </div>
            </div>
        </x-card>

        <!-- Order Items -->
        <x-card class="md:col-span-2 !p-0 overflow-hidden">
            <x-slot name="header">
                <h3 class="text-xs font-bold uppercase tracking-wider flex items-center">
                    <i class="bi bi-list-check mr-3 text-primary"></i>
                    Ordered Items
                </h3>
            </x-slot>

            <x-table>
                <x-slot name="head">
                    <th class="px-8 py-5 font-bold">Item</th>
                    <th class="px-6 py-5 font-bold text-center">Qty</th>
                    <th class="px-8 py-5 font-bold text-right">Subtotal</th>
                </x-slot>
                
                <x-slot name="body">
                    @foreach($order->orderDetails as $detail)
                    <tr>
                        <td class="px-8 py-4">
                            <p class="font-bold text-slate-900 dark:text-white">{{ $detail->product->name }}</p>
                            <p class="text-[10px] text-slate-400 dark:text-espresso-600">Rp {{ number_format($detail->product->price, 0, ',', '.') }} / unit</p>
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-slate-600 dark:text-espresso-400">
                            {{ $detail->quantity }}
                        </td>
                        <td class="px-8 py-4 text-right font-bold text-slate-900 dark:text-white">
                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </x-slot>
            </x-table>

            <x-slot name="footer">
                <div class="flex items-center justify-between">
                    <p class="text-xs font-bold text-slate-400 dark:text-espresso-600 uppercase tracking-widest">Total Bill</p>
                    <h2 class="text-2xl font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h2>
                </div>
            </x-slot>
        </x-card>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between pt-6 border-t border-slate-100 dark:border-espresso-900">
        <p class="text-[10px] text-slate-400 dark:text-espresso-600 font-bold uppercase tracking-widest">
            Ordered on {{ $order->order_date->format('F d, Y \a\t H:i') }}
        </p>
        <div class="flex items-center gap-3">
            <x-button onclick="window.print()" variant="secondary" class="gap-2">
                <i class="bi bi-printer"></i>
                Cetak Invoice
            </x-button>
            <x-button onclick="window.location.href='{{ route('orders.index') }}'" variant="primary">
                Selesai
            </x-button>
        </div>
    </div>
</div>
@endsection
