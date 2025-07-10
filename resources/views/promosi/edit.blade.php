@extends('layouts.app')

@section('content')
<div class="mt-16 pt-4">
    <h1 class="text-2xl font-bold text-black mb-6">Edit Promosi untuk Produk: {{ $promotion->product->name }}</h1>

    <form action="{{ route('promosi.update', $promotion->promotion_id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT') <!-- Menandakan ini adalah request PUT -->

        <!-- Diskon -->
        <div>
            <label for="discount" class="block text-sm font-semibold text-black">Diskon (%)</label>
            <input type="number" name="discount" id="discount" value="{{ old('discount', $promotion->discount) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required min="0" max="100">
            @error('discount')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal Mulai -->
        <div>
            <label for="start_date" class="block text-sm font-semibold text-black">Tanggal Mulai</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $promotion->start_date->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            @error('start_date')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal Akhir -->
        <div>
            <label for="end_date" class="block text-sm font-semibold text-black">Tanggal Akhir</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $promotion->end_date->format('Y-m-d')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            @error('end_date')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 w-full mt-4">
            Update Promosi
        </button>
    </form>
</div>
@endsection
