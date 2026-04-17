<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index()
{
    if (auth()->user()->role !== 'admin') {
        // Jika bukan admin, alihkan dengan pesan error
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
    $users = User::all(); // Mengambil semua data user
    return view('user.index', compact('users')); // Kirim data ke view
}

public function add()
{
    if (auth()->user()->role !== 'admin') {
        // Jika bukan admin, alihkan dengan pesan error
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
    return view('user.add'); // Ganti 'users.add' dengan nama view untuk form tambah user
}


public function destroy(User $user)
{
    $user->delete(); // Menghapus data user

    // Redirect kembali ke halaman daftar user dengan pesan sukses
    return redirect()->route('user.index')->with('success', 'User berhasil dihapus');
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'address' => 'required|string|max:255',
        'No_Telp' => 'required|string|max:15',
        'role' => 'required|in:barista,admin', // Validasi role
        'password' => 'required|confirmed|min:8',
    ]);
    // Simpan data pengguna dengan role yang dipilih
    User::create([
        
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'No_Telp' => $request->No_Telp,
        'role' => $request->role, // Role dipilih dari dropdown
        'password' => bcrypt($request->password),
    ]);

    return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
}
public function edit()
    {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    // Proses update user yang sedang login
    public function update(Request $request)
    {
         // pastikan $userId adalah user_id, bukan id

        // Validasi data
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . Auth::user()->user_id . ',user_id',
            'No_Telp' => 'required|string|max:12',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        $user = Auth::user();  // Ambil data pengguna yang sedang login
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->No_Telp = $validated['No_Telp'];
        $user->address = $validated['address'];

        // Jika ada gambar yang diunggah, proses gambar tersebut
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($user->image && $user->image !== 'img/admin.jpg') {
                Storage::delete('public/' . $user->image);
            }

            // Mengunggah gambar baru
            $path = $request->file('image')->store('profile_pictures', 'public');
            $user->image = $path; // Menyimpan nama file gambar
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect ke halaman edit dengan pesan sukses
        return redirect()->route('orders.index')->with('success', 'Profil berhasil diperbarui.');
    }

}