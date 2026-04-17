@extends('layouts.app')

@section('page_title', 'User Management')

@section('content')
<div class="space-y-8">
    <!-- Action Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Daftar Pengguna</h1>
            <p class="text-slate-500 dark:text-espresso-400 mt-1 uppercase text-[10px] font-bold tracking-[0.2em]">Access Control & Roles</p>
        </div>
        <x-button onclick="window.location.href='{{ route('user.add') }}'" variant="primary" class="gap-2">
            <i class="bi bi-person-plus-fill"></i>
            Tambah User
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
                    <input type="text" placeholder="Cari nama atau email..." 
                        class="pl-11 pr-4 py-2.5 w-full bg-slate-100 dark:bg-espresso-800 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                </div>
            </div>
        </x-slot>

        <x-table>
            <x-slot name="head">
                <th class="px-8 py-5 font-bold text-left">User</th>
                <th class="px-6 py-5 font-bold text-left">Role</th>
                <th class="px-6 py-5 font-bold text-left">Contact & Location</th>
                <th class="px-8 py-5 font-bold text-right">Actions</th>
            </x-slot>
            
            <x-slot name="body">
                @foreach ($users as $user)
                <tr class="group hover:bg-slate-50/80 dark:hover:bg-espresso-800/30 transition-colors">
                    <td class="px-8 py-5">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-espresso-800 overflow-hidden border border-slate-200 dark:border-espresso-700">
                                @if($user->image)
                                    <img src="{{ Storage::url($user->image) }}" alt="Avatar" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <i class="bi bi-person-fill text-xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4">
                                <p class="font-bold text-slate-900 dark:text-white leading-tight">{{ $user->name }}</p>
                                <p class="text-[11px] text-slate-500 dark:text-espresso-500 mt-1">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        @php
                            $roleClass = [
                                'admin' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-400 ring-indigo-600/20',
                                'barista' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400 ring-emerald-600/20',
                                'pembeli' => 'bg-slate-100 text-slate-600 dark:bg-espresso-800 dark:text-espresso-400 ring-slate-600/20',
                            ][$user->role] ?? 'bg-slate-100 text-slate-600';
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-bold uppercase tracking-widest ring-1 ring-inset {{ $roleClass }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="text-xs space-y-1">
                            <p class="flex items-center text-slate-700 dark:text-espresso-300 font-medium">
                                <i class="bi bi-telephone-fill mr-2 text-[10px] text-slate-400"></i>
                                {{ $user->No_Telp ?? '-' }}
                            </p>
                            <p class="flex items-center text-slate-400 dark:text-espresso-600">
                                <i class="bi bi-geo-alt-fill mr-2 text-[10px]"></i>
                                {{ Str::limit($user->address, 30) ?: '-' }}
                            </p>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-right">
                        <div class="flex items-center justify-end space-x-2">
                            {{-- Prevent admin from deleting themselves --}}
                            @if(auth()->id() !== $user->user_id)
                            <form id="delete-form-{{ $user->user_id }}" action="{{ route('user.destroy', $user->user_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $user->user_id }})" 
                                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                    <i class="bi bi-person-x-fill text-lg"></i>
                                </button>
                            </form>
                            @else
                            <span class="text-[10px] font-bold text-slate-300 dark:text-espresso-700 uppercase tracking-widest italic">Current User</span>
                            @endif
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
            title: 'Hapus User?',
            text: "Akses user ini akan dicabut secara permanen!",
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
