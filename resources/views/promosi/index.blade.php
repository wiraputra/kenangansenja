@extends('layouts.app')

@section('page_title', 'Data Promosi')

@section('content')
<div class="space-y-8">
    <!-- Action Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Kelola Promosi</h1>
            <p class="text-slate-500 dark:text-espresso-400 mt-1 uppercase text-[10px] font-bold tracking-[0.2em]">Marketing & Campaigns</p>
        </div>
        <x-button onclick="window.location.href='{{ route('addpromosi') }}'" variant="primary" class="gap-2">
            <i class="bi bi-plus-lg"></i>
            Tambah Promosi
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
                    <input type="text" placeholder="Cari nama promosi..." 
                        class="pl-11 pr-4 py-2.5 w-full bg-slate-100 dark:bg-espresso-800 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
            </div>
        </x-slot>

        <x-table>
            <x-slot name="head">
                <th class="px-8 py-5 font-bold text-left">Campaign</th>
                <th class="px-6 py-5 font-bold text-left">Diskon</th>
                <th class="px-6 py-5 font-bold text-left">Masa Berlaku</th>
                <th class="px-6 py-5 font-bold text-left">Status</th>
                <th class="px-8 py-5 font-bold text-right">Aksi</th>
            </x-slot>
            
            <x-slot name="body">
                @foreach ($promotions as $promo)
                <tr class="group hover:bg-slate-50/80 dark:hover:bg-espresso-800/30 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-xl">
                                <i class="bi bi-megaphone-fill"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-slate-900 dark:text-white leading-tight">{{ $promo->promotion_name }}</p>
                                <p class="text-[11px] text-slate-500 dark:text-espresso-500 mt-1 truncate max-w-[200px]">{{ $promo->description }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 text-[11px] font-bold text-emerald-700 dark:text-emerald-400">
                            {{ $promo->discount_percent }}% OFF
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="text-xs space-y-1">
                            <p class="flex items-center text-slate-600 dark:text-espresso-400 font-medium">
                                <i class="bi bi-calendar-check mr-2 text-[10px]"></i>
                                {{ \Carbon\Carbon::parse($promo->start_date)->format('d M') }}
                            </p>
                            <p class="flex items-center text-slate-400 dark:text-espresso-600">
                                <i class="bi bi-calendar-x mr-2 text-[10px]"></i>
                                {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}
                            </p>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        @php
                            $today = now();
                            $start = \Carbon\Carbon::parse($promo->start_date);
                            $end = \Carbon\Carbon::parse($promo->end_date);
                            $isActive = $today->between($start, $end);
                        @endphp
                        
                        @if($isActive)
                            <span class="flex items-center text-[10px] font-bold text-emerald-500 uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                Active
                            </span>
                        @else
                            <span class="flex items-center text-[10px] font-bold text-slate-400 dark:text-espresso-600 uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 rounded-full bg-slate-300 dark:bg-espresso-700 mr-2"></span>
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('promosi.edit', $promo->promotion_id) }}" 
                               class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-600 hover:text-white transition-all">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form id="delete-form-{{ $promo->promotion_id }}" action="{{ route('promosi.destroy', $promo->promotion_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $promo->promotion_id }})" 
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
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Promosi?',
            text: "Promosi yang dihapus tidak dapat dipulihkan!",
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
