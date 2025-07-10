<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user ditemukan dan kredensial login benar
        if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Cek role dan arahkan ke dashboard yang sesuai
            if ($user->role === 'admin' || $user->role === 'barista') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('pembeli.dashboard')->with('success', 'login berhasil selamat datang' );
            }
        }

        // Jika login gagal, kembali ke form login dengan pesan error
        return back()->with('error', 'Email atau password salah!');
    }

    // Logout dan kembalikan ke halaman login
    public function logout(Request $request)
    {
        
        Auth::logout(); // Mengeluarkan pengguna
        $request->session()->invalidate(); // Menghapus sesi
        $request->session()->regenerateToken(); // Menghasilkan token CSRF baru

        return redirect()->route('home'); // Arahkan pengguna setelah logout
    }



    public function showRegisterForm()
    {
        if (!Auth::check()) {
            // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
        return view('auth.register'); 
    }
    public function showPromoteForm()
    {
        if (!Auth::check()) {
            // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
        return view('promotepage'); 
    }

    public function showPesanForm()
    {
        if (!Auth::check()) {
            // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        return view('pesanpage'); 
    }
    public function showCartForm()
    {
        if (!Auth::check()) {
            // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
        return view('cart'); 
    }
    

    public function register(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Pastikan email unik
            'address' => 'required|string|max:255', // Validasi address
            'No_Telp' => 'required|numeric', // Validasi nomor telepon
            'password' => 'required|min:8|confirmed', // Validasi password 
        ]);

        // Membuat user baru dengan data yang diinput
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address; // Menyimpan address
        $user->No_Telp = $request->No_Telp; // Menyimpan nomor telepon
        $user->password = Hash::make($request->password);  // Hash password menggunakan bcrypt
        $user->save();  // Menyimpan data ke database

        // Melakukan login otomatis setelah registrasi
        Auth::login($user);

        // Redirect ke halaman dashboard setelah berhasil registrasi
        return redirect()->route('login')->with('success', 'registrasi berhasil silahkan login'); // Ganti dengan rute yang sesuai
    }


}

