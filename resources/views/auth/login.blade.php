<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Kenangan Senja</title>
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @vite(['resources/css/login.css', 'resources/css/app.css'])
    
    <style>
        .auth-side-image {
            background-image: linear-gradient(to right, rgba(13, 12, 11, 0.6), rgba(13, 12, 11, 0.9)), url("{{ asset('img/auth_bg_remastered.png') }}") !important;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <!-- Visual Side -->
        <div class="auth-side-image">
            <h1>Kenangan<span>Senja</span>.</h1>
            <p>Setiap tegukan membawa kenangan, setiap aroma membuat hari Anda lebih baik. Selamat datang kembali.</p>
        </div>

        <!-- Form Side -->
        <div class="auth-content">
            <div class="auth-card">
                <div class="auth-header">
                    <h2>Selamat Datang</h2>
                    <p>Silakan masuk ke akun Anda untuk melanjutkan.</p>
                </div>

                <form action="{{ url('login') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="input-container">
                            <input type="email" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required autofocus />
                        </div>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-container">
                            <input type="password" id="password" name="password" placeholder="••••••••" required />
                            <i data-feather="eye" class="password-toggle" onclick="togglePassword('password')"></i>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-800 bg-gray-900 text-primary focus:ring-primary">
                            <span class="text-xs text-gray-500">Ingat Saya</span>
                        </label>
                        <a href="#" class="text-xs text-primary hover:underline">Lupa Password?</a>
                    </div>

                    <button type="submit" class="btn-auth">MASUK</button>

                    <div class="social-auth">
                        <div class="social-title">Atau lanjutkan dengan</div>
                        <div class="social-btns">
                            <button type="button" class="btn-social">
                                <img src="https://www.svgrepo.com/show/355037/google.svg" width="18" alt="Google">
                                Google
                            </button>
                            <button type="button" class="btn-social">
                                <img src="https://www.svgrepo.com/show/330401/facebook.svg" width="18" alt="FB">
                                Facebook
                            </button>
                        </div>
                    </div>

                    <div class="auth-footer">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        feather.replace();

        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = input.nextElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = feather.icons['eye-off'].toSvg();
            } else {
                input.type = 'password';
                icon.innerHTML = feather.icons['eye'].toSvg();
            }
        }
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            background: '#0d0c0b',
            color: '#f5f5f5',
            confirmButtonColor: '#c69466',
            timer: 3000
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            background: '#0d0c0b',
            color: '#f5f5f5',
            confirmButtonColor: '#c69466'
        });
    </script>
    @endif
</body>
</html>
