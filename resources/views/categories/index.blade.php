<?php
use Illuminate\Support\Str;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenangan Senja - Kategori</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

    <!-- Font Awesome & Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Vite CSS -->
    @vite(['resources/css/categories.css', 'resources/css/app.css'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        #user-dropdown {
            z-index: 9999;
        }
    </style>
</head>
<body style="background-image: url(storage/img/a1.jpg) " class="bg-cover">

    <!-- Navigation Menu -->
    <x-navbar />
    <div class="container mx-auto px-6 py-10 mt-20 flex flex-col items-center justify-center">
    <h1 class="text-5xl md:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-yellow-200 via-red-500 to-orange-900 drop-shadow-lg tracking-widest">
        PRODUK KAMI
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12 ">
        <!-- Non Coffee -->
        <a href="{{ route('category.show', 'Non_Coffee') }}" 
           class="relative group rounded-xl shadow-lg transform transition hover:scale-105">
           <div class="absolute inset-0 bg-opacity-60 group-hover:bg-opacity-60 rounded-xl flex items-center justify-center">
               <h2 class="text-4xl font-bold text-white">Non Coffee</h2>
           </div>
            <img src="{{ asset('storage/img/non.jpg') }}" alt="Coffee" 
                 class="w-fit h-fit object-cover rounded-xl opacity-100 group-hover:opacity-100">
        </a>

        <!-- Coffee -->
        <a href="{{ route('category.show', 'Coffee') }}" 
           class="relative group rounded-xl shadow-lg transform transition hover:scale-105">
           <div class="absolute inset-0  bg-opacity-40 group-hover:bg-opacity-60 rounded-xl flex items-center justify-center">
               <h2 class="text-4xl font-bold text-white">Coffee</h2>
           </div>
            <img src="{{ asset('storage/img/kopi1.jpg') }}" alt="Coffee" 
                 class="w-fit h-fit object-cover rounded-xl opacity-50 group-hover:opacity-50">
        </a>

        <!-- Snack -->
        <a href="{{ route('category.show', 'Snack') }}" 
           class="relative group rounded-xl shadow-lg transform transition hover:scale-105">
           <div class="absolute inset-0  bg-opacity-40 group-hover:bg-opacity-60 rounded-xl flex items-center justify-center">
               <h2 class="text-4xl font-bold text-white">Snack</h2>
           </div>
            <img src="{{ asset('storage/img/snak.jpg') }}" alt="Coffee" 
                 class="w-fit h-fit object-cover rounded-xl opacity-50 group-hover:opacity-50">
        </a>
    </div>
</div>


<div class="main-content">

</div>
    <x-footer />

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

</body>
</html>
