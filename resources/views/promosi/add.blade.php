@extends('layouts.app')

@section('content')
<div class="  mt-16">
<div class="pt-4  mt-16">

        <div class="relative overflow-x-auto shadow-md px-4 sm:rounded-lg">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-black">Tambah Promosi</h1>
            </div>

            <!-- Formulir Tambah Promosi -->
            <form action="{{ route('promotions.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div class="mb-4">
                        <label for="product_id" class="block text-sm font-medium text-gray-700">Pilih Produk</label>
                        <select id="product_id" name="product_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Pilih Produk</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->product_id}}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="discount" class="block text-sm font-medium text-gray-700">Diskon (%)</label>
                        <input type="number" name="discount" id="discount" min="0" max="100" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('discount') }}">
                        @error('discount')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('start_date') }}">
                        @error('start_date')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Berakhir</label>
                        <input type="date" name="end_date" id="end_date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('end_date') }}">
                        @error('end_date')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan Promosi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
