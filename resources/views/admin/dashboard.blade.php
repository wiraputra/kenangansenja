<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>

<body class="bg-white-600 font-[Poppins]" x-data="{ activePage: 'dashboard' }">
    <span class="absolute text-white text-4xl top-7 left-4 cursor-pointer" onclick="Openbar()">
        <i class="bi bi-filter-left px-2 bg-gray-900 rounded-md"></i>
    </span>

    <!-- Sidebar -->
    <div class="sidebar fixed top-0 bottom-0 lg:left-0 left-[-300px] duration-1000
        p-2 w-[300px] overflow-y-auto text-center bg-gray-900 shadow h-screen">
        <div class="text-gray-100 text-xl">
            <div class="p-2.5 mt-1 flex items-center rounded-md">
                <img src="{{ asset('img/code.jpeg') }}" alt="Admin Icon" class="w-10 h-10 rounded-md">
                <h1 class="text-[15px] ml-3 text-xl text-gray-200 font-bold">KenanganSenja POS</h1>
                <i class="bi bi-x ml-20 cursor-pointer lg:hidden" onclick="Openbar()"></i>
            </div>
            <hr class="my-2 text-gray-600">
            <div class="p-2.5 mt-1 flex items-center rounded-md">
                <img src="{{ asset('img/admin.jpg') }}" alt="Admin Icon" class="w-10 h-10 rounded-md">
                <h1 class="text-[15px] ml-3 text-xl text-gray-200 font-bold">Admin</h1>
            </div>
            <hr class="my-2 text-gray-600">


            <!-- Sidebar Menu -->
            <div>
                <div @click="activePage = 'dashboard'" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                    <i class="bi bi-house-door-fill"></i>
                    <span class="text-[15px] ml-4 text-gray-200">Dashboard</span>
                </div>
                <div @click="activePage = 'productsadmin'" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                    <i class="bi bi-box-seam"></i>
                    <span class="text-[15px] ml-4 text-gray-200">Product</span>
                </div>
                <div @click="activePage = 'promotionsadmin'" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                    <i class="bi bi-megaphone-fill"></i>
                    <span class="text-[15px] ml-4 text-gray-200">Promotion</span>
                </div>
                <div @click="activePage = 'pembelianadmin'" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                    <i class="bi bi-cart-plus-fill"></i>
                    <span class="text-[15px] ml-4 text-gray-200">Pembelian</span>
                </div>
                <div @click="activePage = 'penjualanadmin'" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                    <i class="bi bi-receipt-cutoff"></i>
                    <span class="text-[15px] ml-4 text-gray-200">Penjualan</span>
                </div>
                <div @click="activePage = 'usersadmin'" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                    <i class="bi bi-people-fill"></i>
                    <span class="text-[15px] ml-4 text-gray-200">User</span>
                </div>
                <div @click="activePage = 'baristaadmin'" class="p-2.5 mt-2 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600">
                    <i class="bi bi-cup-hot-fill"></i>
                    <span class="text-[15px] ml-4 text-gray-200">Barista</span>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="p-4 lg:ml-[300px] mt-16">
        <!-- Halaman Dinamis -->
        <div x-show="activePage === 'dashboard'">
            @include('dashboard')
        </div>
        <div x-show="activePage === 'productsadmin'">
            @include('productsadmin')
        </div>
        <div x-show="activePage === 'promotionsadmin'">
            @include('promotionsadmin')
        </div>
        <div x-show="activePage === 'pembelianadmin'">
            @include('pembelianadmin')
        </div>
        <div x-show="activePage === 'penjualanadmin'">
            @include('penjualanadmin')
        </div>
        <div x-show="activePage === 'usersadmin'">
            @include('usersadmin')
        </div>
        <div x-show="activePage === 'baristaadmin'">
            @include('baristaadmin')
        </div>
    </div>

    <script>
        function Openbar() {
            document.querySelector('.sidebar').classList.toggle('left-[-300px]');
        }
    </script>

</body>

</html>
