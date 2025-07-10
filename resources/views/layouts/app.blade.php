<?php
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css'])
</head>

<body class="bg-white font-[Poppins]" x-data="{ sidebarOpen: false }" onload="feather.replace()">


<!-- Sidebar -->
<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed top-0 bottom-0 left-0 w-[300px] bg-gray-900 text-white h-screen transition-transform duration-300 z-40 lg:translate-x-0 lg:block">
    <div class="p-6">
        <div class="flex items-center mb-6">
            <img src="{{ asset('img/code.jpeg') }}" alt="Admin Icon" class="w-12 h-12 rounded-md">
            <h1 class="ml-3 text-xl font-bold">{{ auth()->user()->name }}</h1>
        </div>
        <hr class="border-gray-700 mb-6">
        <nav>
            <!-- Sidebar Links -->
            <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-md hover:bg-blue-600" @if(auth()->user()->role === 'barista') style="display:none;" @endif>
                <i class="bi bi-house-door-fill"></i>
                <span class="ml-4">Dashboard</span>
            </a>
            <a href="{{ route('products.index') }}" class="flex items-center p-3 rounded-md hover:bg-blue-600" @if(auth()->user()->role === 'barista') style="display:none;" @endif>
                <i class="bi bi-box-seam"></i>
                <span class="ml-4">Product</span>
            </a>
            <a href="{{route('promosi.index')}}" class="flex items-center p-3 rounded-md hover:bg-blue-600" @if(auth()->user()->role === 'barista') style="display:none;" @endif>
                <i class="bi bi-megaphone-fill"></i>
                <span class="ml-4">Promotion</span>
            </a>
            <a href="{{route('orders.index')}}" class="flex items-center p-3 rounded-md hover:bg-blue-600">
                <i class="bi bi-cart-plus-fill"></i>
                <span class="ml-4">Pembelian</span>
            </a>
            <a href="{{route('admin.penjualan')}}" class="flex items-center p-3 rounded-md hover:bg-blue-600">
                <i class="bi bi-cart-plus-fill"></i>
                <span class="ml-4">Penjualan</span>
            </a>
            <a href="{{route('user.index')}}" class="flex items-center p-3 rounded-md hover:bg-blue-600" @if(auth()->user()->role === 'barista') style="display:none;" @endif>
                <i class="bi bi-people-fill"></i>
                <span class="ml-4">User</span>
            </a>
        </nav>
    </div>
</div>

<!-- Navbar -->
<nav class="fixed top-0 w-full bg-transparent text-black z-50">
    <div class="flex ml-0 lg:ml-[300px] bg-slate-300 items-center justify-between p-4 border-b border-gray-300">
        <div class="flex items-center space-x-3">
            <i class="bi bi-filter-left text-2xl cursor-pointer" @click="sidebarOpen = !sidebarOpen"></i>
            <span class="capitalize text-xl font-semibold">{{ basename(url()->current()) }}</span>
        </div>
        <!-- Logout Button -->
        <!-- Dropdown dengan Gambar User -->
<div x-data="{ open: false }" class="relative inline-block text-left">
    <!-- Gambar User sebagai Tombol -->
    <button @click="open = !open" class="flex items-center">
        <img src="{{ Storage::url(auth()->user()->image ) }}" alt="User" class="w-10 h-10 rounded-full border-2 border-white">
        <span class="ml-2 text-white"></span>
    </button>

    <!-- Dropdown Menu --> 
    <div x-show="open" @click.outside="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
    <div class="bg-white mt-2 divide-y divide-gray-100 rounded-lg shadow-lg">
            <ul class="py-2" aria-labelledby="user-menu-button">
                @if(auth()->user()->role == 'admin')
                <li>
                    <a href="{{route('pembeli.dashboard')}}"
                       class="block px-4 py-2 text-sm font-medium text-primary hover:bg-gray-100">Dashboard</a>
                </li>
                @endif
                <li>
                    <a href="{{ route('user.edit') }}"
                       class="block px-4 py-2 text-sm font-medium text-primary hover:bg-gray-100">Akun</a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium w-full text-start text-primary hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

        
        </div>
        
</nav>


<!-- Main Content -->
<div :class="sidebarOpen ? 'ml-[300px]' : 'ml-0'" class="transition-all duration-300 lg:ml-[300px] mt-[64px] px-4">
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            position: 'center',
            timer: 2000,  // Waktu tampil SweetAlert dalam milidetik (3000ms = 3 detik)
        showConfirmButton: false,  // Menghilangkan tombol konfirmasi
        willClose: () => {
            // Optional: Anda bisa menambahkan tindakan lain ketika SweetAlert ditutup
        }
        });
        </script>
        @endif
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: '{{ session('error') }}',
            timer: 2000,  // Waktu tampil SweetAlert dalam milidetik (3000ms = 3 detik)
        showConfirmButton: false,  // Menghilangkan tombol konfirmasi
        willClose: () => {
            // Optional: Anda bisa menambahkan tindakan lain ketika SweetAlert ditutup
        }
        });
    </script>
@endif

    @yield('content')
</div>

<!-- Footer -->
<footer class="bg-white text-black fixed bottom-0 w-full lg:ml-[300px] z-40 border-t border-gray-300">
    <div class="max-w-screen-xl mx-auto p-4 flex items-center justify-between">
        <span class="text-sm text-gray-600">© 2024 
            <a href="https://instagram.com/" class="hover:underline text-blue-500">KenanganSenja™</a>. All Rights Reserved.
        </span>
    </div>
</footer>

</body>

</html>
