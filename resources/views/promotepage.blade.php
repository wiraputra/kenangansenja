<?php
use Illuminate\Support\Str;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenangan Senja</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

    <!-- Icons & Libraries -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Styles -->
    @vite(['resources/css/homelogin.css', 'resources/css/app.css'])

    <style>
        #user-dropdown {
            z-index: 9999;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body class="bg-stone-950">
    <!-- Navigation Bar -->
    <x-navbar />

    <!-- Promo Section -->
    <div class="pt-24 container mx-auto px-4 py-8">
        <h1 class="text-5xl text-center font-semibold text-white">
            PRO<span class="text-yellow-500">MOSI</span>
        </h1>
        <p class="text-xl text-center pt-6 text-gray-200">
            Nikmati Promo Menarik Dari Kami Spesial Natal 2024!
        </p>

        <!-- Grid Produk Promosi -->
        <div class="mt-20 mb-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 px-4">
            @foreach($promotions as $promotion)
                <div class="flex flex-col bg-gray-200 relative rounded-lg overflow-hidden shadow-lg">

                    <!-- Label Diskon -->
                    <div class="absolute top-2 right-2 bg-yellow-500 h-[40px] w-[100px] flex justify-center items-center text-white px-2 py-1 text-sm rounded-lg">
                        -{{ $promotion->discount }}%
                    </div>

                    <!-- Gambar Produk -->
                    <img class="h-[150px] object-cover" src="{{ asset('storage/'.$promotion->product->image) }}" alt="{{ $promotion->product->name }}">

                    <!-- Detail Produk -->
                    <div class="p-4 flex flex-col justify-between h-full">
                        <h5 class="text-2xl font-semibold text-gray-800">{{ $promotion->product->name }}</h5>
                        <p class="text-gray-600 text-sm mt-2">
                            {{ Str::words($promotion->product->description, 5, '...') }}
                        </p>

                        <!-- Harga -->
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-lg font-bold text-gray-500 line-through">
                                Rp {{ number_format($promotion->product->price, 0, ',', '.') }}
                            </span>
                            <span class="text-lg font-bold text-yellow-500">
                                Rp {{ number_format($promotion->price_after_discount, 0, ',', '.') }}
                            </span>
                        </div>

                        <!-- Informasi Stok -->
                        <p class="text-sm text-gray-600 mt-2">
                            Stok Tersisa: 
                            @if($promotion->product->stok > 0)
                                <span class="text-green-600 font-semibold">{{ $promotion->product->stok }}</span>
                            @else
                                <span class="text-red-600 font-semibold">Habis</span>
                            @endif
                        </p>

                        <!-- Tombol Lihat Detail -->
                        <a href="{{ route('promosi.detail', ['promotion_id' => $promotion->promotion_id]) }}" 
                           class="mt-4 px-4 py-2 text-white bg-yellow-500 rounded text-sm font-medium hover:bg-yellow-400 transition duration-300 ease-out">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>
</body>
</html>
