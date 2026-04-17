@extends('layouts.app')

@section('page_title', 'Data Produk')

@section('content')
<div class="space-y-8">
    <!-- Action Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Katalog Produk</h1>
            <p class="text-slate-500 dark:text-espresso-400 mt-1 uppercase text-[10px] font-bold tracking-[0.2em]">Management & Inventory</p>
        </div>
        <x-button onclick="window.location.href='{{ route('addproduct') }}'" variant="primary" class="gap-2">
            <i class="bi bi-plus-lg"></i>
            Tambah Produk
        </x-button>
    </div>

    <!-- Table Card -->
    <x-card class="!p-0 border-none shadow-xl shadow-slate-200/50 dark:shadow-none">
        <x-slot name="header">
            <div class="flex items-center justify-between">
                <div class="relative max-w-xs w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" placeholder="Cari nama atau ID produk..." 
                        class="pl-11 pr-4 py-2.5 w-full bg-slate-100 dark:bg-espresso-800 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
                <div class="flex items-center gap-3">
                    <x-button variant="secondary" class="!px-4 !py-2.5 text-xs">
                        <i class="bi bi-filter mr-2"></i> Filter
                    </x-button>
                </div>
            </div>
        </x-slot>

        <x-table>
            <x-slot name="head">
                <th class="px-8 py-5 font-bold">Produk</th>
                <th class="px-6 py-5 font-bold">Kategori</th>
                <th class="px-6 py-5 font-bold">Harga</th>
                <th class="px-6 py-5 font-bold">Stok</th>
                <th class="px-6 py-5 font-bold">Status</th>
                <th class="px-8 py-5 font-bold text-right">Aksi</th>
            </x-slot>
            
            <x-slot name="body">
                @foreach ($products as $product)
                <tr class="group hover:bg-slate-50/80 dark:hover:bg-espresso-800/30 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center">
                            <div class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-100 dark:bg-espresso-800 border border-slate-200 dark:border-espresso-700">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-slate-900 dark:text-white">{{ $product->name }}</p>
                                <p class="text-[10px] font-mono text-slate-400 dark:text-espresso-500 mt-0.5">{{ 'BRG'. str_pad($product->product_id, 3, '0', STR_PAD_LEFT) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1 rounded-lg bg-slate-100 dark:bg-espresso-800 text-[10px] font-bold uppercase tracking-wider text-slate-600 dark:text-espresso-400">
                            {{ $product->category }}
                        </span>
                    </td>
                    <td class="px-6 py-5 font-bold text-slate-700 dark:text-espresso-300">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center">
                            @if($product->stok <= 5)
                                <div class="w-2 h-2 rounded-full bg-red-500 mr-2 animate-pulse"></div>
                                <span class="font-bold text-red-500">{{ $product->stok }}</span>
                            @else
                                <span class="font-semibold text-slate-600 dark:text-espresso-400">{{ $product->stok }}</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        @if($product->is_promoted)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-400 ring-1 ring-inset ring-amber-600/20">
                                <i class="bi bi-lightning-fill mr-1"></i> PROMO
                            </span>
                        @else
                            <span class="text-[10px] font-bold text-slate-400 dark:text-espresso-600">REGULAR</span>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('products.edit', $product->product_id) }}" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-600 hover:text-white transition-all">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form id="delete-form-{{ $product->product_id }}" action="{{ route('deleteproduct', $product->product_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $product->product_id }})" 
                                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 hover:bg-red-600 hover:text-white transition-all">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
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
    function confirmDelete(productId) {
        Swal.fire({
            title: 'Hapus Produk?',
            text: "Data produk yang dihapus tidak dapat dipulihkan!",
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
                document.getElementById('delete-form-' + productId).submit();
            }
        });
    }
</script>
@endsection
