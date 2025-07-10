<?php
// app/Http/Controllers/ProfileController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{
    
    /**
     * Menampilkan halaman edit profil pengguna
     */
    public function edit()
    {
        return view('akun', ['user' => Auth::user()]);
    }

    /**
     * Memperbarui profil pengguna
     */
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
        return redirect()->route('pembeli.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }
    // ProfileController.php

public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required|current_password',
        'new_password' => 'required|confirmed|min:8',
    ]);

    $user = auth()->user();
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Password lama tidak cocok']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    return back()->with('success', 'Password berhasil diperbarui');
}

}

