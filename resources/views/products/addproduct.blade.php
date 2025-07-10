@extends('layouts.app')
@section('content')
<div class="container mx-auto mt-24 mb-16">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto">
        <h2 class="text-2xl font-semibold text-center mb-6">Tambah Produk Baru</h2>
        
        <form action="{{ route('storeproduct') }}" method="POST" enctype="multipart/form-data">
            @csrf  

            <!-- Product Name -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nama Produk:</label>
                <input type="text" name="product_name" required 
                    class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-300" 
                    placeholder="Masukkan nama produk">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Deskripsi:</label>
                <textarea name="description" rows="3" required
                    class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-300" 
                    placeholder="Deskripsi produk"></textarea>
            </div>

            <!-- Category -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Kategori:</label>
                <select name="category" required 
                    class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-300">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="coffee">Coffee</option>
                    <option value="snack">Snack</option>
                    <option value="non_coffee">Non Coffee</option>
                </select>
            </div>

            <!-- Promoted Product -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="is_promoted" id="is_promoted" value="1"
                    class="mr-2 h-4 w-4 text-blue-600 focus:ring focus:ring-blue-300">
                <label for="is_promoted" class="text-gray-700 font-medium">Produk dalam Promosi?</label>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Harga (IDR):</label>
                <input type="number" name="price" required min="0"
                    class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-300" 
                    placeholder="Masukkan harga produk">
            </div>

            <!-- stok -->
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Stok Produk:</label>
                <input type="number" name="stok" id="stok" required min="0"
                    class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-300" 
                    placeholder="Masukkan stok produk">
            </div>

            <!-- Image Upload -->
            <div class="mb-6">
                <label class="block text-gray-700 font-medium">Upload Gambar:</label>
                <input type="file" name="image" required 
                    class="w-full mt-2 p-2 border rounded focus:ring focus:ring-blue-300">
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" 
                    class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600 transition">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
