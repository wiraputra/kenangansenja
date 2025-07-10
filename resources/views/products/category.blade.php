<!DOCTYPE html>
<html lang="en">
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
    @vite(['resources/css/category.css', 'resources/css/app.css'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        #user-dropdown {
            z-index: 9999;
        }
        body {
            background-image: url('{{ asset('storage/img/a1.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }
        h1, h5, p {
            color: #FFD700;
        }
        .product-card {
            background-color: rgba(255, 140, 0, 0.8);
            border: 1px solid #FF8C00;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
        }
        .btn-detail {
            background-color: #FF4500;
            color: #fff;
        }
        .btn-detail:hover {
            background-color: #FF6347;
        }
        .btn-promote {
            background-color: #FFA500;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-align: center;
            display: inline-block;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }
        .btn-promote:hover {
            background-color: #FF8C00;
        }
        .stok-habis {
            background-color: #A9A9A9;
            color: #fff;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

    <x-navbar />
    <div class="container mx-auto px-4 py-6 mt-24">
        <h1 class="text-4xl text-center font-semibold tracking-wide">
            KATEGORI: <span class="text-orange-400">{{ $category }}</span>
        </h1>

    @if($products->isEmpty())
        <p class="text-center text-gray-300 mt-8">Belum ada produk di kategori ini.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
            @foreach ($products as $product)
                @if (!$product->is_promoted)
                    <div class="product-card rounded-xl overflow-hidden hover:scale-105 transition">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : '/img/default.jpg' }}" 
                             class="w-full h-48 object-cover" alt="{{ $product->name }}">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold">{{ $product->name }}</h5>
                            <p class="text-gray-200">{{ Str::words($product->description, 10) }}</p>
                            <span class="text-yellow-300 font-bold">{{ number_format($product->price, 0, ',', '.') }} IDR</span>
                            
                            <!-- Informasi Stok -->
                            @if($product->stok > 0)
                                <p class="mt-2 text-green-400 font-medium">Stok: {{ $product->stok }}</p>
                            @else
                                <p class="mt-2 text-red-500 font-medium">Stok Habis</p>
                            @endif

                            <!-- Tombol Detail (Nonaktif jika stok habis) -->
                            @if($product->stok > 0)
                                <a href="{{ route('products.detail', ['product_id' => $product->product_id]) }}" 
                                   class="btn-detail block mt-2 py-1 px-4 rounded-full text-center">
                                    Lihat Detail
                                </a>
                            @else
                                <button class="btn-detail stok-habis block mt-2 py-1 px-4 rounded-full text-center" disabled>
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>

<div class="flex justify-center mt-6">
    <a href="{{ route('promotepage') }}" class="btn-promote">
        Menu Promosi
    </a>
</div>
<div class="main-content">

</div>
<x-footer />

</body>
</html>
