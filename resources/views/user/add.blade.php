@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="mt-16 mb-16">
    <div class="pt-4">
        <h1 class="text-3xl font-semibold">Tambah User</h1>

        <form action="{{ route('storeuser') }}" method="POST" class="mt-6">
            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" id="name" placeholder="Nama Lengkap"
                    value="{{ old('name') }}" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" 
                    value="{{ old('email') }}" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" name="address" id="address" placeholder="Alamat"
                    value="{{ old('address') }}" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('address')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- No Telp -->
            <div class="mb-4">
                <label for="No_Telp" class="block text-sm font-medium text-gray-700">No Telp</label>
                <input type="text" name="No_Telp" id="No_Telp" placeholder="Nomor Telepon"
                    value="{{ old('No_Telp') }}" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('No_Telp')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required
                    class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role" class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    <option value="barista" {{ old('role') == 'barista' ? 'selected' : '' }}>Barista</option>
    <!-- Tidak perlu menambahkan opsi untuk 'pembeli' karena itu default di database -->
</select>

            </div>

            <button type="submit" class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 mt-4">
                Tambah User
            </button>
        </form>
    </div>
</div>
@endsection
