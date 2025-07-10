<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenangan Senja - Detail Produk</title>

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
            <div class="flex-shrink-0 lg:w-1/3 h-auto my-auto">
                <div class="overflow-hidden rounded-xl  h-80 shadow-lg">
                    <img 
                        src="{{ $product->image ? asset('storage/' . $product->image) : '/img/default.jpg' }}" 
                        alt="{{ $product->name }}" 
                        class="w-full h-full object-cover  transition-transform duration-300 hover:scale-105"
                    >
                </div>
            </div>
            
            <!-- Product Description -->
            <div class="flex-1 space-y-6">
                <!-- Product Name -->
                <div>
                    <label class="block font-bold text-lg text-gray-400">Nama Produk:</label>
                    <h1 class="text-4xl  text-white">{{ $product->name }}</h1>
                </div>

                <!-- Product Description -->
                <div>
                    <label class="block text-lg font-bold text-gray-400">Deskripsi:</label>
                    <p class="text-lg text-gray-300">{{ $product->description }}</p>
                </div>

                <!-- Product Price -->
                <div>
                    <label class="block text-lg font-bold text-gray-400">Harga:</label>
                    <p class="text-2xl font-bold text-yellow-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                

                <!-- Quantity and Add to Cart -->
                <form action="{{ route('add.to.cart', $product->product_id) }}" method="POST" class="bg-stone-700 p-6 rounded-lg shadow-inner">
                    @csrf
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="block text-sm text-gray-400">Jumlah</label>
                        <button type="button" class="text-xl font-bold text-white bg-yellow-500 rounded-full w-10 h-10 flex items-center justify-center" id="decrement">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 text-center text-lg font-semibold text-gray-800 border rounded-md">
                        <button type="button" class="text-xl font-bold text-white bg-yellow-500 rounded-full w-10 h-10 flex items-center justify-center" id="increment">+</button>
                    </div>
                    <button type="submit" class="w-full bg-yellow-500 text-white py-3 rounded-lg font-semibold hover:bg-yellow-400 transition-all">Tambah ke Keranjang</button>
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
