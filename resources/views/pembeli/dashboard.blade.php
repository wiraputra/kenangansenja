<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kenangan Senja</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />


    <!-- Flowbite JS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!-- Custom CSS -->
    @vite(['resources/css/homelogins.css', 'resources/css/app.css'])
    

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</head>
<body>
    <!-- Navbar Start -->
    <x-navbar />
    <!-- Navbar End -->

   

<section class="bg-no-repeat bg-center bg-blend-multiply" style="background-image: url('/img/kopi.jpg')">
  <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
      <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none pb-8 text-white md:text-5xl lg:text-6xl mix-blend-difference capitalize">Selamat Datang! {{ (auth()->user()->name) }} </h1>
      <p class="mb-8 text-lg font-normal text-white lg:text-xl sm:px-16 pb-8 lg:px-48 mix-blend-difference">Disini banyak menu kopi yang bervariasi dan enak tentunya, dan jangan lupa lihat promo kami di bawah ini</p>
      <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">

          <a href="{{ route('categories.index') }}" class="inline-flex justify-center hover:text-white items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-yellow-600 focus:ring-4 bg-yellow-500">
              Beli Sekarang!
          </a>  
      </div>
  </div>
</section>
  

<!-- Promo Section -->
<section class="promo">
    <h2 class="text-white">Promo <span class="">Terbaru</span></h2>
</section>

<!-- Carousel Section -->
<div x-data="{ current: 1, total: 3 }" 
     x-init="setInterval(() => current = current === total ? 1 : current + 1, 5000)" 
     class="relative w-full max-w-6xl mx-auto overflow-hidden rounded-lg shadow-lg">

    <!-- Slides -->
    <div class="flex transition-transform duration-700 ease-in-out" 
         :style="'transform: translateX(-' + (current - 1) * 100 + '%)'">
        <div class="w-full flex-shrink-0">
            <a href="{{ route('promotepage', ['slide' => 1]) }}">
                <img src="{{ asset('/img/slide1.jpg') }}" class="w-full object-cover" alt="Slide 1">
            </a>
        </div>
        <div class="w-full flex-shrink-0">
            <a href="{{ route('promotepage', ['slide' => 2]) }}">
                <img src="{{ asset('/img/slide2.jpg') }}" class="w-full object-cover" alt="Slide 2">
            </a>
        </div>
        <div class="w-full flex-shrink-0">
            <a href="{{ route('promotepage', ['slide' => 3]) }}">
                <img src="{{ asset('/img/slide3.jpg') }}" class="w-full object-cover" alt="Slide 3">
            </a>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <button @click="current = current > 1 ? current - 1 : total"
            class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-900 text-white px-3 py-2 rounded-full shadow-md hover:bg-gray-700 transition">
        &#10094;
    </button>
    <button @click="current = current < total ? current + 1 : 1"
            class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-900 text-white px-3 py-2 rounded-full shadow-md hover:bg-gray-700 transition">
        &#10095;
    </button>

    <!-- Dots Indicator -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="i in total">
            <span :class="current === i ? 'bg-white' : 'bg-gray-400'" 
                  class="block w-3 h-3 rounded-full border border-gray-700"></span>
        </template>
    </div>
</div>


    
    <!-- Menu Section start -->
    <section id="menu" class="menu px-[98.5px]">
        <h2 class="mb-6 text-5xl text-white">Menu <span class="text-yellow-600">Senja</span></h2>
        <p class="font-light max-w-md mx-auto">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente
          nostrum veniam quasi assumenda ratione aliquam.
        </p>
  
        <div class="row mt-20 flex flex-wrap gap-10 justify-center">
          <div class="flex flex-col items-center">
            <img src="/img/menu1.jpg" alt="espresso" class="menu-card-image w-56 rounded-[50px] mb-5 object-cover object-center" />
            <h3 class="menu-card-title mb-2">- Espresso</h3>
            <p class="menu-card-price">Price: 15K</p>
          </div>
          <div class=" flex flex-col items-center">
            <img src="/img/menu2.jpg" alt="espresso" class="menu-card-image w-56 rounded-[50px] mb-5 object-cover object-center" />
            <h3 class="menu-card-title mb-2">- Americano</h3>
            <p class="menu-card-price">Price: 11K</p>
          </div>
          <div class=" flex flex-col items-center">
            <img src="/img/menu3.jpg" alt="espresso" class="menu-card-image w-56 rounded-[50px] mb-5 object-cover object-center" />
            <h3 class="menu-card-title mb-2">- Saus Tiram</h3>
            <p class="menu-card-price">Price: 12K</p>
          </div>
          <div class=" flex flex-col items-center">
            <img src="/img/menu4.jpg" alt="espresso" class="menu-card-image w-56 rounded-[50px] mb-5 object-cover object-center" />
            <h3 class="menu-card-title mb-2">- Latte</h3>
            <p class="menu-card-price">Price: 19K</p>
          </div>
          <div class=" flex flex-col items-center">
            <img src="/img/menu5.jpg" alt="espresso" class="menu-card-image w-56 rounded-[50px] mb-5 object-cover object-center" />
            <h3 class="menu-card-title mb-2">- Luwak</h3>
            <p class="menu-card-price">Price: 18K</p>
          </div>
          
        </div>
      </section>
      <!-- Menu Section end -->
  

    <!-- Produk Unggulan -->
    <section class="featured">
      <h2 class="mb-6 text-5xl">Produk <span class="text-yellow-600">Unggulan</span> Kami</h2>
        <p class="pb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <div class="featured-items">
            <div class="product">
                <div class="tombol">
                    <a href="{{route('cart')}}"  class="cart"><i data-feather="shopping-cart"></i></a>
                    <a href="#"  class="view"><i data-feather="eye"></i></a>
                </div>
                <img src="/img/kopiunggulan.jpg" class="mx-auto" alt="Produk">
                <p>CoffeeBeans 1</p>
                <span>IDR 30K</span>
            </div>
            <div class="product">
                <div class="tombol">
                    <a href="{{ route('cart') }}" class="cart"><i data-feather="shopping-cart"></i></a>
                    <a href="#" class="view"><i data-feather="eye"></i></a>
                </div>
                <img src="/img/kopiunggulan.jpg" class="mx-auto" alt="Produk">
                <p>CoffeeBeans 2</p>
                <span>IDR 50K</span>
            </div>
        </div>
    </section>

    <!-- Footer start -->
    <x-footer />
</body>
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
        feather.replace();
        
        function goToPromote(){
            header('Location: ./php/Promotepage.php');
        }
        </script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

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

</html>