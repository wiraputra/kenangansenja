

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kenangan Senja</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/login.css', 'resources/css/app.css'])
</head>
<body>
    <div class="login-container">
        <h1 class="text-center text-3xl font-bold mb-5">Kenangan<span class="text-blue-600">Senja</span></h1>

        <!-- Tempatkan alert di luar form -->
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg shadow-md mb-5 w-full">
                <p class="font-semibold">{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ url('login') }}" method="POST" class="max-w-sm mx-auto flex flex-col mb-5">
            @csrf  <!-- Token CSRF untuk keamanan -->
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail</label>
                <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@gmail.com" required />
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password" required />
            </div>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

        <div class="flex items-center justify-between">
            <a href="{{ route('register') }}" class="text-sm text-blue-600 hover:text-blue-700">Register</a>
        </div>
    </div>
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

</body>
</html>
