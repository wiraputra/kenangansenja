<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2">
    <title>Kenangan Senja - Keranjang Saya</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    @vite(['resources/css/homelogin.css', 'resources/css/app.css'])
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body style=" background-image: url(storage/img/a1.jpg)" class = "flex flex-col">


    <!-- Navbar Start -->
    <x-navbar />

    <div class="flex-grow">

        <div class="pt-16 container mx-auto px-4 py-8 mt-20">
        <h1 class="text-5xl text-center md:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-red-500 to-yellow-700 drop-shadow-lg tracking-widest">
        KERANJANG SAYA
        </div>
    </h1>
        <!-- Daftar Pesanan -->
        <div class="container mx-auto py-6">
            @if(session('cart') && count(session('cart')) > 0)
            <div class="bg-white p-6 rounded-md shadow-lg">
                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 text-gray-700">Produk</th>
                            <th class="py-3 px-4 text-gray-700">Harga</th>
                            <th class="py-3 px-4 text-gray-700">Jumlah</th>
                            <th class="py-3 px-4 text-gray-700">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(session('cart') as $productId => $details)
                        <tr class="border-t border-b">
                            <td class="py-4 px-4">
                                <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" class="w-16 h-16 object-cover inline-block mr-4">
                                {{ $details['name'] }}
                            </td>
                            <td class="py-4 px-4">
                                @if(isset($details['price_after_discount']))
                                <span class="line-through text-gray-500">{{ number_format($details['price'], 0, ',', '.') }} IDR</span>
                                <span class="text-yellow-500">{{ number_format($details['price_after_discount'], 0, ',', '.') }} IDR</span>
                                @else
                                {{ number_format($details['price'], 0, ',', '.') }} IDR
                                @endif
                            </td>
                            <td class="py-4 px-4">{{ $details['quantity'] }}</td>
                            <td class="py-4 px-4">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }} IDR</td>
                            <td class="py-4 px-4">
                                <form action="{{ route('cart.remove', $productId) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i data-feather="trash-2"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-white text-center mt-8 mb-5">Keranjang Anda kosong.</p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">

          <a href="{{ route('pesanpage') }}" class="inline-flex justify-center hover:text-white items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-yellow-600 focus:ring-4 bg-yellow-500">
              Beli Sekarang!
          </a>  
      </div>
            @endif
        </div>
        
        <!-- Total Harga dan Tombol Checkout -->
        @if(session('cart') && count(session('cart')) > 0)
            <div class="flex justify-between mt-2 pt-8 border-t border-gray-600">
                <div class="text-center md:text-left">
                    <!-- Tombol Menu Lainnya -->
                    <div class="text-center mt-4 mb-12 ml-20">
                        <a href="{{ route('pesanpage') }}" class="bg-yellow-500  px-8 py-4 text-white rounded-sm hover:bg-yellow-400 transition-colors duration-300">
                            Menu Lainnya
                        </a>
                    </div>
                    <p class="text-black-600 ml-24 font-semibold text-white">TOTAL HARGA:</p>
                    @php
                    $totalPrice = 0;
                    foreach(session('cart') as $product) {
                            $totalPrice += $product['price'] * $product['quantity'];
                        }
                        @endphp
                        <p class="text-lg font-bold ml-20 px-12 py-4 bg-gray-300">{{ number_format($totalPrice, 0, ',', '.') }} IDR</p>
                    </div>
                    <!-- // Tombol Checkout -->
                    <div>
                    <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-yellow-500 mr-20 px-10 py-4 text-white rounded-sm hover:bg-yellow-400">
                    BELI SEKARANG
                    </button>
                    </form>

            </div>
        @endif
        
    </div>
</div>
    
    <x-footer />

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>
</body>
</html>
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