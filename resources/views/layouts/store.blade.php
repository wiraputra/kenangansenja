<!DOCTYPE html>
<html lang="id" x-data="{ userDropdownOpen: false, mobileMenuOpen: false }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kenangan Senja | Premium Coffee')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Playfair+Display:ital,wght@0,700;0,900;1,700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/css/homelogins.css'])

    <style>
        [x-cloak] { display: none !important; }
        .font-header { font-family: 'Playfair Display', serif; }
        .font-body { font-family: 'Outfit', sans-serif; }
        
        .glass-dark {
            background: rgba(26, 24, 22, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .hero-overlay {
            background: linear-gradient(to bottom, rgba(1, 1, 1, 0.4) 0%, rgba(1, 1, 1, 0.8) 100%);
        }

        .hover-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }
        
        body {
            background-color: #0c0a09; /* espresso-950 */
        }
    </style>
    @yield('styles')
</head>
<body class="font-body text-slate-200 selection:bg-primary selection:text-white flex flex-col min-h-screen">
    
    <!-- Admin Indicator (Floating) -->
    @auth
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'barista')
        <div class="fixed bottom-8 right-8 z-[100]">
            <div class="glass-dark px-6 py-4 rounded-3xl shadow-2xl flex items-center gap-4 border border-primary/20 hover:border-primary/40 transition-all group">
                <div class="w-10 h-10 bg-primary/20 text-primary rounded-xl flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all">
                    <i class="bi bi-shield-lock-fill text-xl"></i>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-primary">Admin Preview Mode</p>
                    <a href="{{ route('dashboard') }}" class="text-sm font-bold text-white hover:underline decoration-primary underline-offset-4 flex items-center gap-2">
                        Back to Dashboard <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif
    @endauth

    <!-- Navbar -->
    <x-navbar />

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />
    
    <!-- Scripts -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            background: '#1a1816',
            color: '#ffffff',
            confirmButtonColor: '#c69466',
            customClass: {
                popup: 'rounded-[2rem] border border-white/5 shadow-2xl'
            }
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Kesalahan',
            text: '{{ session('error') }}',
            background: '#1a1816',
            color: '#f87171',
            confirmButtonColor: '#ef4444',
            customClass: {
                popup: 'rounded-[2rem] border border-white/5 shadow-2xl'
            }
        });
    </script>
    @endif

    @yield('scripts')
</body>
</html>
