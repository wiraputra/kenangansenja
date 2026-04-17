<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | Kenangan Senja</title>
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @vite(['resources/css/register.css', 'resources/css/app.css'])
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
            <p>Bergabunglah dengan komunitas kami dan nikmati penawaran eksklusif serta kemudahan memesan kopi favorit Anda.</p>
        </div>

        <!-- Form Side -->
        <div class="auth-content">
            <div class="auth-card" style="max-width: 50rem;">
                <div class="auth-header">
                    <h2>Buat Akun Baru</h2>
                    <p>Lengkapi data di bawah ini untuk memulai.</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
                    <div class="grid-2">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <div class="input-container">
                                <input type="text" id="name" name="name" placeholder="Nama Anda" value="{{ old('name') }}" required />
                            </div>
                            @error('name')
                                <span style="display:block; color:#ef4444; font-size:1.1rem; margin-top:0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-container">
                                <input type="email" id="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required />
                            </div>
                            @error('email')
                                <span style="display:block; color:#ef4444; font-size:1.1rem; margin-top:0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <div class="input-container">
                            <input type="text" id="address" name="address" placeholder="Alamat lengkap" value="{{ old('address') }}" required />
                        </div>
                        @error('address')
                            <span style="display:block; color:#ef4444; font-size:1.1rem; margin-top:0.5rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="No_Telp">Nomor Telepon</label>
                        <div class="input-container">
                            <input type="text" id="No_Telp" name="No_Telp" placeholder="08123456789" value="{{ old('No_Telp') }}" required />
                        </div>
                        @error('No_Telp')
                            <span style="display:block; color:#ef4444; font-size:1.1rem; margin-top:0.5rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid-2">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-container">
                                <input type="password" id="password" name="password" placeholder="••••••••" required />
                                <i data-feather="eye" class="password-toggle" onclick="togglePassword('password')"></i>
                            </div>
                            @error('password')
                                <span style="display:block; color:#ef4444; font-size:1.1rem; margin-top:0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi</label>
                            <div class="input-container">
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth">DAFTAR SEKARANG</button>

                    <div class="auth-footer">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
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
</body>
</html>
