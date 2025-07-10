<!-- resources/views/components/navbar.blade.php -->

@php
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

$orders = count(Order::where('user_id', Auth::id())->where('status', '!=', 'Completed')->get());
@endphp

<nav class="navbar bg-stone-950 opacity-80 relative sticky">
    <a href="#" class="navbar-logo text-white text-2xl">Kenangan<span class="text-yellow-400">Senja</span>.</a>

    <!-- Navbar Menu for larger screens -->
    <div class="navbar-nav hidden lg:flex space-x-8">
        <a href="{{ route('pembeli.dashboard') }}" class="text-white">Home</a>
        <a href="{{ route('aboutus') }}" class="text-white">Tentang Kami</a>
        <a href="{{ route('categories.index') }}" class="text-white">Menu</a>
    </div>

    <!-- Cart and User Menu -->
    <div class="flex items-center space-x-4">
        <!-- Cart Logo -->
        <a href="{{ route('cart') }}" class="flex items-center text-white">
            <i class="fas fa-shopping-cart text-xl"></i>
        </a>

        <!-- User Menu Button -->
        <button type="button" class="text-white" id="user-menu-button">
            <img class="w-8 h-8 rounded-full object-cover border" src="{{ Storage::url(auth()->user()->image) }}" alt="user photo">
        </button>

        <!-- Dropdown Menu (Positioned absolutely so it won't affect the navbar size) -->
        <div class="z-50 hidden text-base w-44 list-none absolute top-10 right-0" id="user-dropdown">
            <div class="bg-white divide-gray-100 rounded-lg shadow-lg">
                <ul class="py-2" aria-labelledby="user-menu-button">
                    <li>
                        <a href="{{ Auth::user()->role == 'admin' || Auth::user()->role == 'barista' ? route('dashboard') : route('pembeli.dashboard') }}" class="block px-4 py-2 text-sm text-primary hover:bg-gray-100">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ Auth::user()->role == 'admin' ? route('user.edit') : route('akun') }}" class="block px-4 py-2 text-sm text-primary hover:bg-gray-100">Akun</a>
                    </li>
                    <li>
                        @if($orders)
                            <a href="{{ route('orders.status') }}" class="block px-4 py-2 text-sm text-primary hover:bg-gray-100">Pesanan ({{ $orders }})</a>
                        @else
                        <a href="{{ route('orders.status') }}" class="block px-4 py-2 text-sm text-primary hover:bg-gray-100">Pesanan kosong</a>
                        @endif
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="block w-full px-4 py-2 text-sm text-primary hover:bg-gray-100">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Button -->
    <div class="lg:hidden flex items-center">
        <button class="text-white" id="mobile-menu-button">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>

    <!-- Mobile Dropdown Menu (hidden by default) -->
    <div class="lg:hidden hidden absolute w-full top-full p-2 left-0 bg-stone-950 z-50" id="mobile-menu">
        <div class="bg-white divide-y divide-gray-100 rounded-lg shadow-lg">
            <ul class="py-2">
                <li>
                    <a href="{{ route('pembeli.dashboard') }}" class="block px-4 py-2 text-sm text-primary hover:bg-gray-100">Home</a>
                </li>
                <li>
                    <a href="{{ route('aboutus') }}" class="block px-4 py-2 text-sm text-primary hover:bg-gray-100">Tentang Kami</a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-sm text-primary hover:bg-gray-100">Menu</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Toggle user dropdown visibility on button click (both mobile and desktop)
    document.getElementById('user-menu-button').addEventListener('click', function() {
        const dropdownMenu = document.getElementById('user-dropdown');
        dropdownMenu.classList.toggle('hidden');
    });

    // Toggle mobile menu visibility
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>
