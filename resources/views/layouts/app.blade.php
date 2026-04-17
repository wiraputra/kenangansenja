<!DOCTYPE html>
<html lang="en" x-data="{ 
    darkMode: localStorage.getItem('theme') === 'dark',
    sidebarOpen: window.innerWidth >= 1024,
    sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
    },
    toggleSidebar() {
        this.sidebarCollapsed = !this.sidebarCollapsed;
        localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
    }
}" :class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kenangan Senja Management')</title>
    
    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .dark .glass-card {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .sidebar-transition { transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .content-transition { transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>

<body class="font-['Inter'] transition-colors duration-300 bg-slate-50 dark:bg-espresso-950 text-slate-900 dark:text-slate-100">

    <!-- Sidebar Overlay -->
    <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden"></div>

    <!-- Sidebar -->
    <aside 
        class="fixed top-0 bottom-0 left-0 z-50 flex flex-col bg-white dark:bg-espresso-900 border-r border-slate-200 dark:border-espresso-800 sidebar-transition"
        :class="[
            sidebarOpen ? 'translate-x-0' : '-translate-x-full',
            sidebarCollapsed && window.innerWidth >= 1024 ? 'w-24' : 'w-72',
            'lg:translate-x-0'
        ]"
    >
        <!-- Brand -->
        <div class="h-20 flex items-center px-6 overflow-hidden border-b border-slate-100 dark:border-espresso-800">
            <template x-if="!sidebarCollapsed">
                <a href="#" class="text-xl font-header font-extrabold tracking-tighter whitespace-nowrap overflow-hidden">
                    Kenangan<span class="text-primary">Senja</span>.
                </a>
            </template>
            <template x-if="sidebarCollapsed">
                <a href="#" class="text-xl font-header font-extrabold text-primary mx-auto">K.S.</a>
            </template>
        </div>

        <!-- Scrollable Navigation -->
        <div class="flex-1 px-4 space-y-1 overflow-y-auto mt-6">
            <p x-show="!sidebarCollapsed" class="px-3 mb-2 text-[10px] font-bold text-slate-400 dark:text-espresso-500 uppercase tracking-[0.2em]">Main Menu</p>
            
            <div class="space-y-1">
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'barista')
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center p-3 rounded-xl transition-all group {{ Request::is('dashboard*') ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'hover:bg-slate-100 dark:hover:bg-espresso-800 text-slate-500 dark:text-espresso-400' }}">
                    <i class="bi bi-grid-fill text-xl min-w-[24px]"></i>
                    <span x-show="!sidebarCollapsed" class="ml-4 font-semibold whitespace-nowrap transition-opacity duration-300">Dashboard</span>
                </a>
                @endif

                @if(auth()->user()->role === 'admin')
                <a href="{{ route('products.index') }}" 
                   class="flex items-center p-3 rounded-xl transition-all group {{ Request::is('produk*') ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'hover:bg-slate-100 dark:hover:bg-espresso-800 text-slate-500 dark:text-espresso-400' }}">
                    <i class="bi bi-box-seam-fill text-xl min-w-[24px]"></i>
                    <span x-show="!sidebarCollapsed" class="ml-4 font-semibold whitespace-nowrap transition-opacity duration-300">Produk</span>
                </a>
                <a href="{{ route('promosi.index') }}" 
                   class="flex items-center p-3 rounded-xl transition-all group {{ Request::is('promosi*') ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'hover:bg-slate-100 dark:hover:bg-espresso-800 text-slate-500 dark:text-espresso-400' }}">
                    <i class="bi bi-megaphone-fill text-xl min-w-[24px]"></i>
                    <span x-show="!sidebarCollapsed" class="ml-4 font-semibold whitespace-nowrap transition-opacity duration-300">Promosi</span>
                </a>
                @endif

                <a href="{{ route('orders.index') }}" 
                   class="flex items-center p-3 rounded-xl transition-all group {{ Request::is('orders*') ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'hover:bg-slate-100 dark:hover:bg-espresso-800 text-slate-500 dark:text-espresso-400' }}">
                    <i class="bi bi-receipt-cutoff text-xl min-w-[24px]"></i>
                    <span x-show="!sidebarCollapsed" class="ml-4 font-semibold whitespace-nowrap transition-opacity duration-300">Pesanan</span>
                </a>

                <a href="{{ route('admin.penjualan') }}" 
                   class="flex items-center p-3 rounded-xl transition-all group {{ Request::is('penjualan*') ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'hover:bg-slate-100 dark:hover:bg-espresso-800 text-slate-500 dark:text-espresso-400' }}">
                    <i class="bi bi-bar-chart-fill text-xl min-w-[24px]"></i>
                    <span x-show="!sidebarCollapsed" class="ml-4 font-semibold whitespace-nowrap transition-opacity duration-300">Laporan</span>
                </a>

                @if(auth()->user()->role === 'admin')
                <div class="pt-6">
                    <p x-show="!sidebarCollapsed" class="px-3 mb-2 text-[10px] font-bold text-slate-400 dark:text-espresso-500 uppercase tracking-[0.2em]">Administrative</p>
                    <a href="{{ route('user.index') }}" 
                       class="flex items-center p-3 rounded-xl transition-all group {{ Request::is('user*') ? 'bg-primary text-white shadow-lg shadow-primary/30' : 'hover:bg-slate-100 dark:hover:bg-espresso-800 text-slate-500 dark:text-espresso-400' }}">
                        <i class="bi bi-people-fill text-xl min-w-[24px]"></i>
                        <span x-show="!sidebarCollapsed" class="ml-4 font-semibold whitespace-nowrap transition-opacity duration-300">User Management</span>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar Footer Actions -->
        <div class="p-4 border-t border-slate-200 dark:border-espresso-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center w-full p-3 text-red-500 rounded-xl hover:bg-red-50 dark:hover:bg-red-500/10 transition-all font-semibold">
                    <i class="bi bi-power text-xl min-w-[24px]"></i>
                    <span x-show="!sidebarCollapsed" class="ml-4 whitespace-nowrap transition-opacity duration-300">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Header & Main Content -->
    <div 
        class="flex flex-col min-h-screen content-transition" 
        :class="sidebarCollapsed && window.innerWidth >= 1024 ? 'lg:ml-24' : 'lg:ml-72'"
    >
        <!-- Header -->
        <header class="sticky top-0 z-30 flex items-center justify-between h-20 px-8 bg-white/80 dark:bg-espresso-950/80 backdrop-blur-md border-b border-slate-200 dark:border-espresso-800">
            <div class="flex items-center">
                <!-- Toggle Button for Desktop -->
                <button @click="toggleSidebar()" class="hidden lg:flex p-2 mr-4 text-slate-500 hover:text-primary transition-colors text-2xl">
                    <i class="bi" :class="sidebarCollapsed ? 'bi-text-indent-left' : 'bi-text-indent-right'"></i>
                </button>
                <!-- Toggle Button for Mobile -->
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 mr-4 text-slate-500 hover:text-primary transition-colors text-2xl">
                    <i class="bi bi-list"></i>
                </button>
                <h2 class="text-lg font-header font-bold capitalize">@yield('page_title', 'Dashboard Overview')</h2>
            </div>

            <div class="flex items-center space-x-3">
                <!-- Theme Toggle -->
                <button @click="toggleTheme()" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 dark:bg-espresso-800 text-slate-500 dark:text-slate-400 hover:text-primary transition-all">
                    <i x-show="!darkMode" class="bi bi-moon-fill" x-cloak></i>
                    <i x-show="darkMode" class="bi bi-sun-fill" x-cloak></i>
                </button>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center p-1 rounded-xl bg-slate-100 dark:bg-espresso-800 hover:ring-2 ring-primary transition-all">
                        @if(auth()->user()->image)
                            <img src="{{ Storage::url(auth()->user()->image) }}" alt="User" class="w-8 h-8 rounded-lg object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=c69466&color=fff" alt="User" class="w-8 h-8 rounded-lg object-cover">
                        @endif
                    </button>
                    <div x-show="open" @click.outside="open = false" x-transition.origin.top.right class="absolute right-0 mt-3 w-48 bg-white dark:bg-espresso-800 rounded-2xl shadow-xl border border-slate-200 dark:border-espresso-700 py-2 z-50 overflow-hidden text-sm">
                        <a href="{{ route('pembeli.dashboard') }}" class="flex items-center px-4 py-3 hover:bg-slate-100 dark:hover:bg-espresso-700 transition-colors">
                            <i class="bi bi-shop mr-3"></i> Lihat Toko
                        </a>
                        <a href="{{ route('user.edit') }}" class="flex items-center px-4 py-3 hover:bg-slate-100 dark:hover:bg-espresso-700 transition-colors">
                            <i class="bi bi-person-gear mr-3"></i> Pengaturan Akun
                        </a>
                        <hr class="my-1 border-slate-200 dark:border-espresso-700">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors text-left">
                                <i class="bi bi-power mr-3"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dynamic Content -->
        <main class="flex-1 p-8 pb-12">
            @yield('content')
        </main>
    </div>

    <!-- Sweet Alerts -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            background: localStorage.getItem('theme') === 'dark' ? '#0d0c0b' : '#ffffff',
            color: localStorage.getItem('theme') === 'dark' ? '#f5f5f5' : '#0d0c0b',
            confirmButtonColor: '#c69466',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
    @endif

    <script>
        feather.replace();
    </script>
</body>

</html>
