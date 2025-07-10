@extends('layouts.app')

@section('content')

<div class="max-w-full p-6 bg-white rounded shadow-md">
    <h2 class="text-2xl font-bold mb-6">Detail Pesanan</h2>

    <!-- Order Info -->
    <div class="mb-4">
        <strong class="text-gray-700">Order ID:</strong> ORD-{{ str_pad($order->order_id, 3, '0', STR_PAD_LEFT) }}
    </div>

    <div class="mb-4">
        <strong class="text-gray-700">Nama Pengguna:</strong> {{ $order->user->name }}
    </div>

    <div class="mb-4">
        <strong class="text-gray-700">Alamat Pengguna:</strong> {{ $order->user->address }}
    </div>

    <div class="mb-4">
        <strong class="text-gray-700">No Telepon:</strong> {{ $order->user->No_Telp }}
    </div>

    <div class="mb-4">
        <strong class="text-gray-700">Tanggal Pesanan:</strong> {{ $order->order_date->format('d-m-Y') }}
    </div>

    <div class="mb-4">
        <strong class="text-gray-700">Total Harga:</strong> {{ number_format($order->total_price, 0, ',', '.') }} IDR
    </div>

    <div class="mb-4">
        <strong class="text-gray-700">Status:</strong> <span class="font-semibold">{{ $order->status }}</span>
    </div>

    <!-- Table of Ordered Products -->
    <div class="overflow-x-auto mb-6">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border text-left">Nama Produk</th>
                    <th class="px-4 py-2 border text-left">Harga</th>
                    <th class="px-4 py-2 border text-left">Jumlah</th>
                    <th class="px-4 py-2 border text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $detail)
                    <tr class="bg-gray-100 hover:bg-gray-200">
                        <td class="px-4 py-2 border">{{ $detail->product->name }}</td>
                        <td class="px-4 py-2 border">{{ number_format($detail->product->price, 2, ',', '.') }} IDR</td>
                        <td class="px-4 py-2 border">{{ $detail->quantity }}</td>
                        <td class="px-4 py-2 border">{{ number_format($detail->subtotal, 2, ',', '.') }} IDR</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Back Button -->
    <div class="mt-4 text-right">
        <a href="{{ route('orders.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-600 transition duration-300">Kembali</a>
    </div>
</div>

@endsection
