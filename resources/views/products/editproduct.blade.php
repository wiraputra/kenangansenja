@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="flex items-center justify-center mb-16 min-h-screen bg-gray-100">
    <div class="w-full max-w-2xl bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-16">Edit Produk</h1>

        <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div>
                <label for="product_name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Produk</label>
                <input type="text" name="product_name" id="product_name" placeholder="Nama Produk"
                    value="{{ old('product_name', $product->name) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('product_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi Produk -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Produk</label>
                <textarea name="description" id="description" placeholder="Deskripsi"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Harga Produk -->
            <div>
                <label for="price" class="block text-sm font-semibold text-gray-700 mb-1">Harga Produk</label>
                <input type="number" name="price" id="price" placeholder="Harga Produk"
                    value="{{ old('price', $product->price) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Stok Produk -->
            <div>
                <label for="stok" class="block text-sm font-semibold text-gray-700 mb-1">Stok Produk</label>
                <input type="number" name="stok" id="stok" placeholder="Stok Produk" min="0"
                    value="{{ old('stok', $product->stok) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Gambar Produk -->
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-1">Gambar Produk</label>
                <input type="file" name="image" id="image"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if ($product->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                            class="w-32 h-32 object-cover rounded-lg shadow-md">
                    </div>
                @endif
            </div>

            <!-- Status Promosi -->
            <div class="flex items-center">
                <input type="hidden" name="is_promoted" value="0">
                <input type="checkbox" name="is_promoted" id="is_promoted" value="1"
                    class="mr-2 w-5 h-5 text-blue-600 rounded focus:ring-blue-500"
                    {{ old('is_promoted', $product->is_promoted) ? 'checked' : '' }}>
                <label for="is_promoted" class="text-sm font-semibold text-gray-700">Promosikan Produk</label>
            </div>

            <!-- Tombol Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-semibold py-3 rounded-lg shadow-lg hover:from-blue-600 hover:to-indigo-600 transition-transform transform hover:scale-105">
                Update Produk
            </button>
        </form>
    </div>
</div>
@endsection
