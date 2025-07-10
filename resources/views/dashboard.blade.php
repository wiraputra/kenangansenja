@extends('layouts.app')

@section('content')
<div class="mt-16">
    <div class="p-6 pt-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Product Box -->
            <div class="bg-teal-500 rounded-lg p-6 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-gray-200">
                <div class="text-white text-6xl font-semibold">{{ App\Models\Product::count() }}</div>
                <div class="text-white mt-2 text-xl font-light">Produk</div>
                <div class="mt-4 bg-teal-700 text-white p-2 rounded-md text-center cursor-pointer transition-colors hover:bg-teal-800">
                    <a href="{{ route('products.index') }}">More info</a>
                </div>
            </div>

            <!-- User Box -->
            <div class="bg-indigo-500 rounded-lg p-6 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-gray-200">
                <div class="text-white text-6xl font-semibold">{{ App\Models\User::count() }}</div>
                <div class="text-white mt-2 text-xl font-light">User</div>
                <div class="mt-4 bg-indigo-700 text-white p-2 rounded-md text-center cursor-pointer transition-colors hover:bg-indigo-800">
                    <a href="{{ route('user.index') }}">More info</a>
                </div>
            </div>

            <!-- Order Box -->
            <div class="bg-orange-500 rounded-lg p-6 shadow-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 border border-gray-200">
                <div class="text-white text-6xl font-semibold">{{ App\Models\Order::count() }}</div>
                <div class="text-white mt-2 text-xl font-light">Pesanan</div>
                <div class="mt-4 bg-orange-700 text-white p-2 rounded-md text-center cursor-pointer transition-colors hover:bg-orange-800">
                    <a href="{{ route('orders.index') }}">More info</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
