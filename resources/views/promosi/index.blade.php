@extends('layouts.app')

@section('content')


    <div class="relative overflow-x-auto shadow-md px-4 sm:rounded-lg mt-[92px]">
    <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-black">Data Menu Promosi</h1>
                <a href="{{ route('addpromosi') }}" class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-600">
                    Add Promosi
                </a>
            </div>

                <table class="w-full text-sm text-left rtl:text-right text-black bg-slate-200">
                    <thead class="text-xs text-black uppercase bg-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3 ">
                                Promotion ID
                            </th>
                            <th scope="col" class="px-6 py-3 ">
                                Nama Produk
                            </th>
                            <th scope="col" class="px-6 py-3 ">
                                Persentase Diskon
                            </th>
                            <th scope="col" class="px-6 py-3 ">
                                Harga
                            </th>
                            <th scope="col" class="px-6 py-3 ">
                                After Diskon
                            </th>
                            <th scope="col" class="px-6 py-3 ">
                                Operasi
                            </th>
                            <th scope="col" class="px-6 py-3 ">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($promotions as $promotion)
                        <tr class="hover:bg-gray-50">
                            <td class="bg-slate-100 border-b hover:bg-slate-300">
                                {{ 'PRM-' . str_pad($promotion->promotion_id, 3, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $promotion->product->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $promotion->discount }}%
                            </td>
                            <td class="px-6 py-4">
                                Rp. {{ number_format($promotion->product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                Rp. {{ number_format($promotion->product->price - ($promotion->product->price * $promotion->discount / 100), 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
    <!-- Edit Button -->
    <a href="{{ route('promosi.edit', $promotion->promotion_id) }}" class="text-blue-500 hover:text-blue-700 inline-flex items-center">
        <i class="bi bi-pencil me-1"></i> Edit
    </a>
    
</td>
<td>
<form action="{{ route('promosi.destroy', $promotion->promotion_id) }}" method="POST" >
    @csrf
    @method('DELETE')
     <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded">
        Hapus
    </button>
</form>

</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    

@endsection
