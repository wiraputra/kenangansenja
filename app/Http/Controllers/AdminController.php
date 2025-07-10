<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{ public function index()
    {
        // Cek apakah pengguna memiliki role 'admin'
        if (auth()->user()->role == 'pembeli') {
            // Jika bukan admin, alihkan dengan pesan error
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Tampilkan dashboard admin jika pengguna adalah admin
        return view('dashboard');
    }
    public function showUser()
    {
        $users = User::all(); // Mengambil semua data user
        return view('user.index', compact('users')); // Kirim data ke view
    }
    
}
