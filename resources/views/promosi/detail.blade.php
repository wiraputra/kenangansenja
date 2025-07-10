<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenangan Senja - Detail Promosi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- Icons and Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- Custom Styles -->
    @vite(['resources/css/detailproduk.css', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body class="bg-stone-950 flex flex-col min-h-screen">

    <!-- Navigation Menu -->
    <x-navbar />

    <!-- Main Content -->
    <div class="pt-20 container mx-auto px-8 py-20 flex-grow">
    <div class="flex flex-col lg:flex-row gap-12 items-start bg-gray-800 p-8 rounded-lg shadow-md">
            <!-- Product Image -->
            <div class="flex-shrink-0 h-auto mt-8">
                <div class= "flex flex-col lg:flex-row gap-12 items-start bg-gray-800 p-8 rounded-lg shadow-md">

                    <img 
                    src="{{ $promotion->product->image ? asset('storage/' . $promotion->product->image) : '/img/default.jpg' }}" 
                    alt="{{ $promotion->product->name }}" 
                    class="w-full h-80 max-w-md rounded-xl transition-transform duration-300 hover:scale-105 shadow-lg"
                    >
                </div>
            </div>
            
            <!-- Product Description -->
            <div class="flex-1 mt-8 max-w-lg">
                <h1 class="text-4xl font-semibold text-white mb-4">{{ $promotion->product->name }}</h1>
                <p class="text-lg text-gray-300 mb-4">{{ $promotion->product->description }}</p>
                <div class="mb-6">
                    <span class="text-xl text-gray-400 line-through mr-3">Rp {{ number_format($promotion->product->price, 0, ',', '.') }}</span>
                    <span class="text-2xl font-bold text-yellow-400">Rp {{ number_format($promotion->price_after_discount, 0, ',', '.') }}</span>
                </div>
                <div class="text-sm text-red-400 mb-6">Promo berlaku hingga {{ $promotion->end_date }}</div>

                <!-- Quantity and Add to Cart -->
                <form action="{{ route('add.to.cart', $promotion->product->product_id) }}" method="POST" class="bg-gray-800 p-4 rounded-lg shadow-md w-72">
                    @csrf
                    <div class="flex items-center justify-between mb-4">
                        <button type="button" class="text-xl font-bold text-white bg-yellow-500 rounded-full w-8 h-8 flex items-center justify-center" id="decrement">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-12 text-center text-lg font-semibold text-gray-800 border rounded-md">
                        <button type="button" class="text-xl font-bold text-white bg-yellow-500 rounded-full w-8 h-8 flex items-center justify-center" id="increment">+</button>
                    </div>
                    <button type="submit" class="w-full bg-yellow-500 text-white py-2 rounded-lg font-semibold hover:bg-yellow-400 transition-all">Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-yellow-800 text-white py-6">
        <div class="container mx-auto text-center">
            <div class="flex justify-center space-x-8 mb-4">
                <a href="#" class="hover:text-white text-2xl"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-white text-2xl"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-white text-2xl"><i class="fab fa-facebook"></i></a>
            </div>
            <p class="text-xs">&copy;2024 Kenangan <span class="text-yellow-400">Senja</span>. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Quantity Button Script -->
    <script>
        const incrementBtn = document.querySelector('#increment');
        const decrementBtn = document.querySelector('#decrement');
        const quantityInput = document.querySelector('#quantity');

        incrementBtn.addEventListener('click', () => {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });

        decrementBtn.addEventListener('click', () => {
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });

        feather.replace();
    </script>

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false,
            });
        </script>
    @endif
</body>
</html>
