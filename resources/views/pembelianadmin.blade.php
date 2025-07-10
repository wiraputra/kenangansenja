@extends('layouts.app')
@section('content')
<div class=" mt-16">
<div class="pt-4  mt-16">
<div class="relative overflow-x-auto shadow-md px-4 sm:rounded-lg">
    <div class="flex items-center justify-between mb-6 mt-10">
        <h1 class="text-2xl font-bold text-black">Data Product</h1>
    </div>

    <table class="w-full text-sm text-left rtl:text-right text-black bg-slate-200">
        <thead class="text-xs text-black uppercase bg-gray-300">
            <tr>
                <th scope="col" class="px-6 py-3">Order ID</th>
                <th scope="col" class="px-6 py-3">User ID</th>
                <th scope="col" class="px-6 py-3">Order Date</th>
                <th scope="col" class="px-6 py-3">Total Price</th>
                <th scope="col" class="px-6 py-3 text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data Baris 1 -->
            <tr class="bg-slate-100 border-b hover:bg-slate-300">
                <td class="px-6 py-4 font-bold">ORD-001</td>
                <td class="px-6 py-4 font-bold">USR-031</td>
                <td class="px-6 py-4">12-12-2024</td>
                <td class="px-6 py-4">Kopi Cihuy</td>
                <td class="px-6 py-4 text-center flex justify-center space-x-2">
                    <a href="#" class="bg-yellow-400 text-black px-3 py-2 rounded-md hover:bg-yellow-500 inline-flex items-center">
                        <i class="bi bi-arrow-clockwise me-1"></i>
                    </a>
                    <a href="#" class="bg-green-600 text-white px-3 py-2 rounded-md hover:bg-green-700 inline-flex items-center">
                        <i class="bi bi-check-lg"></i>
                    </a>
                </td>
            </tr>
            <!-- Data Baris 2 -->
            <tr class="bg-slate-100 border-b hover:bg-slate-300">
                <td class="px-6 py-4 font-bold">ORD-002</td>
                <td class="px-6 py-4 font-bold">USR-071</td>
                <td class="px-6 py-4">12-12-2024</td>
                <td class="px-6 py-4">Kopi Anjay</td>
                <td class="px-6 py-4 text-center flex justify-center space-x-2">
                    <a href="#" class="bg-yellow-400 text-black px-3 py-2 rounded-md hover:bg-yellow-500 inline-flex items-center">
                        <i class="bi bi-arrow-clockwise me-1"></i>
                    </a>
                    <a href="#" class="bg-green-600 text-white px-3 py-2 rounded-md hover:bg-green-700 inline-flex items-center">
                        <i class="bi bi-check-lg"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
