<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kenangan Senja</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    
    @vite(['resources/css/register.css', 'resources/css/app.css'])
</head>

<body>

    <div class="register-container">
        <div class="register-card">
            <h1>Kenangan<span>Senja</span></h1>
            <h2>REGISTER</h2>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <!-- Email Field -->
                <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <!-- Email Field -->
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror

                <!-- address Field -->
                <input type="text" name="address" placeholder="address" value="{{ old('address') }}" required>
                @error('address')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror

                <!-- No Telp Field -->
                <input type="text" name="No_Telp" placeholder="No Telp" value="{{ old('No_Telp') }}" required>
                @error('No_Telp')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror

                <!-- Password Field -->
                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror

                <!-- Confirm Password Field -->
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                <button type="submit">REGISTER</button>
            </form>

            <p>Sudah Punya Akun? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>

    <footer class="bg-yellow-800 text-white py-6">
        <div class="container mx-auto text-center space-y-4">
            <!-- Social Media Links -->
            <div class="flex justify-center space-x-6">
                <a href="#" class="text-gray-300 hover:text-white text-xl">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-gray-300 hover:text-white text-xl">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-gray-300 hover:text-white text-xl">
                    <i class="fab fa-facebook"></i>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex justify-center space-x-6 text-sm">
                <a href="#" class="hover:text-white">Home</a>
                <a href="#" class="hover:text-white">Tentang Kami</a>
                <a href="#" class="hover:text-white">Menu</a>
                <a href="#" class="hover:text-white">Kontak</a>
            </nav>

            <!-- Copyright -->
            <div class="text-xs">
                &copy;2024 CopyRight | Kenangan <span class="text-yellow-400">Senja</span>
            </div>
        </div>
    </footer>

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>
</body>

</html>
