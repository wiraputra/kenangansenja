<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Menampilkan halaman formulir registrasi
    public function showRegistrationForm()
    {
        return view('auth.register'); // Mengarahkan ke halaman form registrasi
    }

    // Menangani proses registrasi
    public function register(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'email' => 'required|email|unique:users,email', // Pastikan email unik
            'address' => 'required|string|max:255', // Validasi address
            'No_Telp' => 'required|numeric', // Validasi nomor telepon
            'password' => 'required|min:8|confirmed', // Validasi password
        ]);

        // Membuat user baru dengan data yang diinput
        $user = new User();
        $user->email = $request->email;
        $user->address = $request->address; // Menyimpan address
        $user->No_Telp = $request->No_Telp; // Menyimpan nomor telepon
        $user->password = Hash::make($request->password);  // Hash password menggunakan bcrypt
        $user->save();  // Menyimpan data ke database

        // Melakukan login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard setelah berhasil registrasi
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.'); // Ganti dengan rute yang sesuai
    }
}
