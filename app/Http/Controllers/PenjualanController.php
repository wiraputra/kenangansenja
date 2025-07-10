<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function salesRecap()
    {
        // Total penjualan dari pesanan yang sudah selesai
        $totalSales = Order::where('status', 'Completed')->sum('total_price');

        // Jumlah total pesanan
        $totalOrders = Order::count();

        // Rekap berdasarkan status pesanan
        $statusSummary = Order::select('status', DB::raw('COUNT(*) as count'), DB::raw('SUM(total_price) as total'))
            ->groupBy('status')
            ->get();

        // Return ke view penjualanadmin.blade.php
        return view('penjualanadmin', [
            'total_sales' => $totalSales,
            'total_orders' => $totalOrders,
            'status_summary' => $statusSummary
        ]);
    }
}
