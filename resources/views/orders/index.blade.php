@extends('layouts.app')

@section('content')
<meta http-equiv="refresh" content="10">
<div class="mt-16">
    <div class="pt-4 mt-16">
        <div class="relative overflow-x-auto shadow-lg bg-white p-6 sm:rounded-lg border border-gray-200">
            <div class="flex items-center justify-between mb-6 mt-10">
                <h1 class="text-3xl font-semibold text-black">Data Pesanan</h1>

                <!-- Sortir berdasarkan status -->
                <form action="{{ route('orders.index') }}" method="GET" class="flex items-center">
                    <label for="status" class="mr-2 text-lg">Sortir berdasarkan status:</label>
                    <select name="status" id="status" class="border rounded-lg px-3 py-2 text-sm bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Pilih Status</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Processing" {{ request('status') == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 ml-4">Sortir</button>
                </form>
            </div>

            <table class="w-full text-sm text-left rtl:text-right text-gray-800 bg-gray-50 mb-20">
                <thead class="text-xs text-gray-500 uppercase bg-gradient-to-r from-gray-300 via-gray-200 to-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3">Order ID</th>
                        <th scope="col" class="px-6 py-3">User Name</th>
                        <th scope="col" class="px-6 py-3">Order Date</th>
                        <th scope="col" class="px-6 py-3">Total Price</th>
                        <th scope="col" class="px-6 py-3 text-center">Status</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="bg-white border-b hover:bg-gray-100 transition duration-300">
                        <td class="px-6 py-4 font-semibold">ORD-{{ str_pad($order->order_id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4">{{ $order->user->name }}</td>
                        <td class="px-6 py-4">{{ $order->order_date->format('d-m-Y') }}</td>
                        <td class="px-6 py-4 font-medium text-green-600">{{ number_format($order->total_price, 0, ',', '.') }} IDR</td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('orders.updateStatus', $order->order_id) }}" method="POST">
                                @csrf
                                <!-- Disable jika status sudah Completed -->
                                <select name="status" class="border rounded-lg px-3 py-2 text-sm bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" {{ $order->status == 'Completed' ? 'disabled' : '' }}>
                                    <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <!-- Tombol Update dinonaktifkan jika Completed -->
                                <button type="submit" class="{{ $order->status == 'Completed' ? 'bg-gray-400 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-2 rounded-lg transition duration-300 mt-2" {{ $order->status == 'Completed' ? 'disabled' : '' }}>
                                    Update
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('orders.show', $order->order_id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Detail</a>
                            <button onclick="deleteOrder({{ $order->order_id }})" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300 mt-2">Delete</button>
                            <form id="delete-form-{{ $order->order_id }}" action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- SweetAlert Script -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        position: 'center',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

<script>
    function deleteOrder(orderId) {
        Swal.fire({
            title: 'Yakin ingin menghapus pesanan ini?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + orderId).submit();
            }
        })
    }
</script>
@endsection
