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

    <!-- Form Container -->
    <div class="container mx-auto flex justify-center items-center mt-28">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl w-full">
            <!-- Edit Profile Section -->
            <div class="bg-gray-200 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Edit <span class="text-yellow-500">Profil</span></h2>

                @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-2">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md" value="{{ old('name', $user->name) }}" required>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md" value="{{ old('email', $user->email) }}" required>
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- No Telp Field -->
                        <div>
                            <label for="No_Telp" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                            <input type="text" name="No_Telp" id="No_Telp" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md" value="{{ old('No_Telp', $user->No_Telp) }}" required>
                            @error('No_Telp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Address Field -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="address" id="address" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md">{{ old('address', $user->address) }}</textarea>
                            @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Image Field -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Gambar Profil</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md">
                            @if ($user->image && $user->image !== 'img/admin.jpg')
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="mt-2" width="100">
                            @endif
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 focus:outline-none">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <!-- Change Password Section -->
            <div class="bg-gray-200 p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Ubah <span class="text-yellow-500">Password</span></h2>

                <form action="{{ route('profile.changePassword') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Old Password Field -->
                    <div class="mb-4">
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Password Lama</label>
                        <input type="password" name="current_password" id="current_password" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md" required>
                        @error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- New Password Field -->
                    <div class="mb-4">
                        <label for="new_password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                        <input type="password" name="new_password" id="new_password" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md" required>
                        @error('new_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="mb-4">
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md" required>
                        @error('new_password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 focus:outline-none">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer />

    <script>
        feather.replace();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
</html>
