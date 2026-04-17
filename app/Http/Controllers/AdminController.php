<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{ 
    public function index()
    {
        // General Stats
        $stats = [
            'totalProducts' => Product::count(),
            'totalUsers' => User::where('role', 'pembeli')->count(),
            'totalOrders' => Order::count(),
            'totalRevenue' => Order::where('status', 'Completed')->sum('total_price'),
            
            // Operational Stats for Barista/Admin
            'pendingOrders' => Order::where('status', 'Pending')->count(),
            'processingOrders' => Order::where('status', 'Processing')->count(),
            'completedToday' => Order::where('status', 'Completed')
                                    ->whereDate('updated_at', now()->toDateString())
                                    ->count(),
            
            // Recent Orders for the table
            'recentOrders' => Order::with('user')->latest()->take(5)->get(),
        ];

        return view('dashboard', compact('stats'));
    }

    public function showUser()
    {
        // Strictly allow only admin to see user list
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki wewenang untuk melihat daftar pengguna.');
        }

        $users = User::all(); // Mengambil semua data user
        return view('user.index', compact('users')); // Kirim data ke view
    }
}
