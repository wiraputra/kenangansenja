@extends('layouts.app')

@section('content')
<div class=" mt-24 mb-16">
    <h2 class="text-2xl font-bold mb-4">Edit Profil</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-600 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Foto Profil -->
        <div class="mb-2 text-left">
            @if (Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Foto Profil" class="w-24 h-24 rounded-full  mb-2">
            @else
                <img src="{{ asset('img/admin.jpg') }}" alt="Default Foto" class="w-24 h-24 rounded-full mx-auto mb-2">
            @endif
            <input type="file" name="image" class="mt-2">
        </div>
        <small class="text-gray-500">Format: jpg, jpeg, png, gif. Max: 2MB</small>

        <!-- Nama -->
        <div class="mb-4">
            <label for="name" class="block">Nama</label>
            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block">Email</label>
            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- No Telepon -->
        <div class="mb-4">
            <label for="No_Telp" class="block">No Telepon</label>
            <input type="text" name="No_Telp" value="{{ old('No_Telp', Auth::user()->No_Telp) }}" class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Alamat -->
        <div class="mb-4">
            <label for="address" class="block">Alamat</label>
            <textarea name="address" class="w-full border rounded px-3 py-2">{{ old('address', Auth::user()->address) }}</textarea>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update Profil</button>
        <a href="{{ route('orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
    </form>
</div>
@endsection
