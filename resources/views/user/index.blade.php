@extends('layouts.app')
@section('content')
    <div class="flex items-center justify-between mt-[92px] mb-4">
        <h1 class="text-2xl font-bold text-black">Data User</h1>
        <a href="{{ route('user.add') }}" class=" bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
            Add User
        </a>
    </div>
    <div>
            <table class="w-full text-sm text-left text-black bg-slate-200">
                <thead class="text-xs text-black uppercase bg-gray-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">User ID</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">E-mail</th>
                        <th scope="col" class="px-6 py-3">Role</th>
                        <th scope="col" class="px-6 py-3">Address</th>
                        <th scope="col" class="px-6 py-3">No_telp</th>
                        <th scope="col" class="px-6 py-3">Actions</th> <!-- Kolom untuk tombol aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-slate-100 border-b hover:bg-slate-300">
                            <td class="px-6 py-4 font-bold">{{ $user->user_id }}</td>
                            <td class="px-6 py-4 font-bold">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->role }}</td>
                            <td class="px-6 py-4">{{ $user->address }}</td>
                            <td class="px-6 py-4">{{ $user->No_Telp }}</td>
                            <td class="px-6 py-4">
                                
                                <form action="{{ route('user.destroy', $user->user_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Hapus</button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection

