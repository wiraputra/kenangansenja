@extends('layouts.app')
@section('content')
<div class="mt-16">
    <div class="pt-4 mt-16">
    <div class="relative overflow-x-auto shadow-md px-4 sm:rounded-lg">
    <div class="flex items-center justify-between mb-6 mt-16">
        <h1 class="text-2xl font-bold text-black">Data produk</h1>
        <a href="{{ route('addproduct') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
            Add Produk
        </a>
    </div>
    
    <table class="w-full text-sm text-left rtl:text-right text-black bg-slate-200 mb-20">
        <thead class="text-xs text-black uppercase bg-gray-300">
            <tr>
                <th scope="col" class="px-6 py-3">ID Produk</th>
                <th scope="col" class="px-6 py-3">Nama Produk</th>
                <th scope="col" class="px-6 py-3">Harga</th>
                <th scope="col" class="px-6 py-3">Gambar</th>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Stok</th>
                <th scope="col" class="px-6 py-3">Berpromosi?</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="bg-slate-100 border-b hover:bg-slate-300">
                <td class="px-6 py-4 text-black">{{ 'BRG'. str_pad($product->product_id, 3, '0', STR_PAD_LEFT) }}</td>
                <td class="px-6 py-4 text-black">{{ $product->name }}</td>
                <td class="px-6 py-4 text-black">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-black">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16">
                    @else
                        No image
                    @endif
                </td>
                <td class="px-6 py-4 text-black">{{ $product->category }}</td>
                <td class="px-6 py-4 text-black">{{ $product->stok }}</td>
                <td class="px-6 py-4 text-black">{{ $product->is_promoted ? 'Yes' : 'No' }}</td>
                <td class="px-6 py-4 text-black">
                    <form id="delete-form-{{ $product->product_id }}" action="{{ route('deleteproduct', $product->product_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete({{ $product->product_id }})" class="bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-600 inline-flex items-center">
                            <i class="bi bi-trash me-1"></i> Hapus
                        </button>
                    </form>
                    <a href="{{ route('products.edit', $product->product_id) }}" class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600 inline-flex items-center">
                        <i class="bi bi-pencil me-1"></i> Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection

<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(productId) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus produk ini?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika konfirmasi kedua disetujui, kirim form
                        document.getElementById('delete-form-' + productId).submit();
                    }
                });
            }
        
    
</script>

