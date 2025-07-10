<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan - Kenangan Senja</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ mix('resources/css/order.css') }}">
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">
    <style>
        body {
            background-image: url('/img/menu2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <x-navbar />

    <!-- Main Content -->
    <div class="pt-24 container mx-auto px-4 py-8">
        <div class="bg-gray-200">
            <h1 class="text-3xl text-center font-semibold">STATUS <span class="text-yellow-500">PESANAN</span></h1>
            <div class="status-box mt-6 p-6 border border-yellow-500 rounded-lg text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp Logo" class="whatsapp-logo mx-auto mb-4">
                <p class="text-lg">DETAIL STATUS PESANAN AKAN DIKIRIMKAN LEWAT WHATSAPP ANDA!</p>
                <h2 class="mt-4 text-xl font-semibold">Periksa WhatsApp Anda!</h2>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-yellow-800 text-white py-6 mt-8">
        <div class="container mx-auto text-center">
            <!-- Social Media Links -->
            <div class="flex justify-center space-x-6 mb-4">
                <a href="#" class="text-gray-300 hover:text-white text-xl"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-300 hover:text-white text-xl"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-300 hover:text-white text-xl"><i class="fab fa-facebook"></i></a>
            </div>
            <!-- Navigation Links -->
            <nav class="flex justify-center space-x-6 text-sm mb-2">
                <a href="#" class="hover:text-white">Home</a>
                <a href="#" class="hover:text-white">Tentang Kami</a>
                <a href="#" class="hover:text-white">Menu</a>
                <a href="#" class="hover:text-white">Kontak</a>
            </nav>
            <!-- Copyright -->
            <div class="text-xs">
                &copy;2024 CopyRight | Kenangan <span class="text-yellow-400">Senja</span>
            </div>
        </div>
    </footer>
</body>
</html>
