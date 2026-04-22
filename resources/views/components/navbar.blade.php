@php
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

$activeOrdersCount = Auth::check() ? count(Order::where('user_id', Auth::id())->where('status', '!=', 'Completed')->get()) : 0;
@endphp

<nav x-data="{ mobileMenuOpen: false, userDropdownOpen: false }" 
     class="sticky top-0 z-50 w-full transition-all duration-300 bg-espresso-950/80 backdrop-blur-lg border-b border-white/5 shadow-2xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo Section -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center group">
                   <span class="text-2xl font-header font-extrabold text-white tracking-tight">Kenangan<span class="text-primary group-hover:text-primary-light transition-colors">Senja</span>.</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-10">
                <a href="{{ route('home') }}" class="text-sm font-bold uppercase tracking-widest {{ Request::is('/') ? 'text-primary' : 'text-slate-300 hover:text-white' }} transition-colors">Home</a>
                <a href="{{ route('aboutus') }}" class="text-sm font-bold uppercase tracking-widest {{ Request::is('aboutus') ? 'text-primary' : 'text-slate-300 hover:text-white' }} transition-colors">Tentang Kami</a>
                <a href="{{ route('categories.index') }}" class="text-sm font-bold uppercase tracking-widest {{ Request::is('categories*') || Request::is('category*') || Request::is('pembeli/categories*') ? 'text-primary' : 'text-slate-300 hover:text-white' }} transition-colors">Menu</a>
            </div>

            <!-- Right Actions -->
            <div class="flex items-center space-x-6">
                @auth
                    <!-- Shopping Cart -->
                    <a href="{{ route('cart') }}" class="relative p-2 text-slate-300 hover:text-primary transition-all">
                        <i class="bi bi-bag-heart-fill text-xl"></i>
                    </a>

                    <!-- User Profile Dropdown -->
                    <div class="relative">
                        <button @click="userDropdownOpen = !userDropdownOpen" 
                                @click.away="userDropdownOpen = false"
                                class="flex items-center gap-2 p-1 rounded-full border-2 border-transparent hover:border-primary/50 transition-all focus:outline-none">
                            @if(auth()->user()->image)
                                <img src="{{ Storage::url(auth()->user()->image) }}" alt="User" class="w-9 h-9 rounded-full object-cover shadow-lg shadow-black/20">
                            @else
                                <img src="{{ asset('img/default-avatar.png') }}" alt="User" class="w-9 h-9 rounded-full object-cover border border-white/10 shadow-lg shadow-black/20">
                            @endif
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="userDropdownOpen" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             class="absolute right-0 mt-3 w-56 origin-top-right bg-espresso-900 border border-white/5 rounded-2xl shadow-2xl py-2 z-50 overflow-hidden"
                             style="display: none;">
                            
                            <div class="px-4 py-3 border-b border-white/5 mb-1">
                                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Akun Aktif</p>
                                <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
                            </div>

                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'barista')
                                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-primary transition-colors">
                                    <i class="bi bi-speedometer2 mr-3"></i> Admin Dashboard
                                </a>
                            @endif

                            <a href="{{ auth()->user()->role == 'admin' ? route('user.edit') : route('akun') }}" class="flex items-center px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-primary transition-colors">
                                <i class="bi bi-person-circle mr-3"></i> Pengaturan Akun
                            </a>

                            <a href="{{ route('orders.status') }}" class="flex items-center px-4 py-3 text-sm text-slate-300 hover:bg-white/5 hover:text-primary transition-colors justify-between">
                                <div class="flex items-center">
                                    <i class="bi bi-receipt mr-3"></i> Pesanan Saya
                                </div>
                                @if($activeOrdersCount > 0)
                                    <span class="bg-primary text-white text-[10px] px-2 py-0.5 rounded-full font-bold">{{ $activeOrdersCount }}</span>
                                @endif
                            </a>

                            <div class="border-t border-white/5 mt-1 pt-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-400 hover:bg-red-500/10 transition-colors text-left">
                                        <i class="bi bi-box-arrow-right mr-3"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-white hover:text-primary transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="px-6 py-2 bg-primary hover:bg-primary-light text-white text-sm font-bold rounded-xl transition-all shadow-lg shadow-primary/20">Daftar</a>
                    </div>
                @endauth


                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-slate-300 hover:text-white transition-colors">
                    <i class="bi text-2xl" :class="mobileMenuOpen ? 'bi-x-lg' : 'bi-list'"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="md:hidden bg-espresso-950/95 backdrop-blur-xl border-t border-white/5"
         style="display: none;">
        <div class="px-4 pt-4 pb-6 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-slate-300 hover:bg-white/5 hover:text-primary">Home</a>
            <a href="{{ route('aboutus') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-slate-300 hover:bg-white/5 hover:text-primary">Tentang Kami</a>
            <a href="{{ route('categories.index') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-slate-300 hover:bg-white/5 hover:text-primary">Menu</a>
            
            @auth
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'barista')
                    <hr class="border-white/5 my-2">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-primary bg-primary/10">Dashboard Admin</a>
                @endif
                <a href="{{ route('orders.status') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-slate-300 hover:bg-white/5 hover:text-primary">Pesanan Saya</a>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-base font-bold text-red-400 hover:bg-red-500/10 transition-colors">
                        Logout
                    </button>
                </form>
            @else
                <hr class="border-white/5 my-2">
                <a href="{{ route('login') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-white hover:text-primary">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-primary">Daftar</a>
            @endauth
        </div>
    </div>
</nav>
