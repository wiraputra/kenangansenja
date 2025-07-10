@extends('layouts.app')

@section('title', 'Rekap Penjualan')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Rekap Penjualan</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="p-4 bg-green-100 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-green-700">Total Penjualan</h3>
                <p class="text-2xl font-bold text-green-800">Rp {{ number_format($total_sales, 2, ',', '.') }}</p>
            </div>
            <div class="p-4 bg-blue-100 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-blue-700">Total Pesanan</h3>
                <p class="text-2xl font-bold text-blue-800">{{ $total_orders }}</p>
            </div>
        </div>

        <h4 class="text-lg font-semibold text-gray-700 mb-3">Rangkuman Status Pesanan</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-center">Jumlah Pesanan</th>
                        <th class="py-3 px-6 text-right">Total Penjualan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($status_summary as $summary)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $summary->status }}</td>
                            <td class="py-3 px-6 text-center">{{ $summary->count }}</td>
                            <td class="py-3 px-6 text-right">Rp {{ number_format($summary->total, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
