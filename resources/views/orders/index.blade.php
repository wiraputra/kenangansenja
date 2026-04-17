@extends('layouts.app')

@section('page_title', 'Manajemen Pesanan')

@section('content')
<meta http-equiv="refresh" content="30">

<div class="space-y-8">
    <!-- Action Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Daftar Pesanan</h1>
            <p class="text-slate-500 dark:text-espresso-400 mt-1 uppercase text-[10px] font-bold tracking-[0.2em]">Live Order Monitoring</p>
        </div>
        
        <!-- Filter Form -->
        <form action="{{ route('orders.index') }}" method="GET" class="flex items-center gap-3">
            <div class="relative min-w-[200px]">
                <select name="status" onchange="this.form.submit()" 
                    class="w-full bg-white dark:bg-espresso-900 border border-slate-200 dark:border-espresso-800 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary/20 appearance-none outline-none transition-all">
                    <option value="">Semua Status</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>⌛ Pending</option>
                    <option value="Processing" {{ request('status') == 'Processing' ? 'selected' : '' }}>☕ Processing</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>✅ Completed</option>
                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                </select>
                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                    <i class="bi bi-chevron-down text-xs"></i>
                </div>
            </div>
            <x-button type="submit" variant="secondary" class="!py-2.5">
                Filter
            </x-button>
        </form>
    </div>

    <!-- Table Card -->
    <x-card class="!p-0 border-none shadow-xl shadow-slate-200/50 dark:shadow-none">
        <x-table>
            <x-slot name="head">
                <th class="px-8 py-5 font-bold text-left">Order Information</th>
                <th class="px-6 py-5 font-bold text-left">Customer</th>
                <th class="px-6 py-5 font-bold text-left">Total Amount</th>
                <th class="px-6 py-5 font-bold text-center">Current Status</th>
                <th class="px-8 py-5 font-bold text-right">Actions</th>
            </x-slot>
            
            <x-slot name="body">
                @foreach($orders as $order)
                <tr class="group hover:bg-slate-50/80 dark:hover:bg-espresso-800/30 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-espresso-810 flex items-center justify-center border border-slate-200 dark:border-espresso-700">
                                <i class="bi bi-hash text-slate-400"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-slate-900 dark:text-white leading-tight">ORD-{{ str_pad($order->order_id, 3, '0', STR_PAD_LEFT) }}</p>
                                <p class="text-[10px] text-slate-500 dark:text-espresso-500 mt-1 uppercase tracking-widest font-semibold">{{ $order->order_date->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 font-medium text-slate-700 dark:text-espresso-300">
                        {{ $order->user->name }}
                    </td>
                    <td class="px-6 py-5">
                        <div class="text-sm">
                            <p class="font-bold text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            <p class="text-[10px] text-slate-400 dark:text-espresso-600 font-bold uppercase tracking-tighter">Billed Amount</p>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <form action="{{ route('orders.updateStatus', $order->order_id) }}" method="POST" class="flex flex-col items-center gap-2">
                            @csrf
                            <select name="status" onchange="this.form.submit()" 
                                class="text-[10px] font-bold uppercase tracking-wider px-3 py-1.5 rounded-lg border-none bg-slate-100 dark:bg-espresso-800 focus:ring-2 focus:ring-primary/20 appearance-none cursor-pointer text-center"
                                {{ $order->status == 'Completed' ? 'disabled' : '' }}>
                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            
                            @php
                                $statusDot = [
                                    'Pending' => 'bg-orange-500',
                                    'Processing' => 'bg-blue-500',
                                    'Completed' => 'bg-emerald-500',
                                    'Cancelled' => 'bg-red-500',
                                ][$order->status] ?? 'bg-slate-500';
                            @endphp
                            <div class="flex items-center text-[9px] font-bold uppercase tracking-widest text-slate-400 group-hover:text-slate-500 transition-colors">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }} mr-1.5 {{ $order->status == 'Processing' ? 'animate-pulse' : '' }}"></span>
                                {{ $order->status }}
                            </div>
                        </form>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('orders.show', $order->order_id) }}" 
                               class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary/10 text-primary hover:bg-primary hover:text-white transition-all shadow-sm" title="Detail Pesanan">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <button onclick="deleteOrder({{ $order->order_id }})" 
                                class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Hapus">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                            <form id="delete-form-{{ $order->order_id }}" action="{{ route('orders.destroy', $order->order_id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </x-slot>
        </x-table>
    </x-card>
</div>

<script>
    function deleteOrder(id) {
        Swal.fire({
            title: 'Hapus Pesanan?',
            text: "Data pesanan akan dihapus permanen dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            background: document.documentElement.classList.contains('dark') ? '#1a1816' : '#ffffff',
            color: document.documentElement.classList.contains('dark') ? '#f5f5f5' : '#1e293b',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
