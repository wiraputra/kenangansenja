<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        // Jika pengguna adalah barista, arahkan ke halaman pembelian
        if (auth()->user()->role === 'barista') {
            return redirect()->route('pembelian');  // Arahkan ke halaman pembelian
        }
        $productCount = Product::count();
        $userCount = User::count();
        $orderCount = Order::count();
    
        // Jika pengguna adalah admin, tampilkan halaman dashboard admin
        return view('dashboard', compact('productCount', 'userCount', 'orderCount'));
    }
}
