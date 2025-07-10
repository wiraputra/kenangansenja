<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function checkout(Request $request)
{
    try {
        $cart = session('cart'); // Ambil data keranjang

        // Membuat order baru
        $order = Order::create([
            'user_id' => auth()->id(),
            'order_date' => now(),
            'total_price' => $this->calculateTotalPrice($cart), // Hitung total harga
            'status' => 'Pending',  // Status awal pesanan
        ]);

        // Simpan detail pesanan dan cek promosi
        foreach ($cart as $productId => $details) {
            $promotion_id = $details['promotion_id'] ?? null;

            // Simpan detail pesanan
            $order->orderDetails()->create([
                'product_id' => $productId,
                'promotion_id' => $promotion_id,
                'quantity' => $details['quantity'],
                'subtotal' => ($details['price_after_discount'] ?? $details['price']) * $details['quantity'],
            ]);

            // Ambil produk untuk mengurangi stok
            $product = Product::find($productId);
            if ($product) {
                // Mengurangi stok produk berdasarkan jumlah yang dipesan
                $product->stok -= $details['quantity'];
                $product->save();
            }
        }

        // Kosongkan keranjang setelah checkout
        session()->forget('cart');

        // Redirect ke halaman status pesanan dengan membawa ID pesanan
        return redirect()->route('orders.status', ['orderId' => $order->order_id])->with('success', 'Pesanan berhasil dibuat!');
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => 'Terjadi kesalahan saat memproses pesanan.']);
    }
}


// Menampilkan status pesanan
public function Status()
{
    // Ambil semua pesanan pengguna yang sedang login
    // $orders = auth()->user()->orders()->with('orderDetails.product', 'orderDetails.promotion')->get();
    $orders = Order::where('user_id', Auth::id())->get();


    // Jika tidak ada pesanan, redirect dengan pesan error
    // if ($orders->isEmpty()) {
    //     return redirect()->route('pembeli.dashboard')->with('error', 'Anda belum memiliki pesanan.');
    // }

    // Kirim data pesanan ke view
    return view('orders.status', compact('orders'));
}

// Kirim data pesanan ke view
    
        

// Kirim data ke view jika valid


public function calculateTotalPrice($cart)
{
    $total = 0;
    
    foreach ($cart as $productId => $details) {
        // Jika ada harga setelah diskon, gunakan harga setelah diskon
        $price = isset($details['price_after_discount']) ? $details['price_after_discount'] : $details['price'];
        
        // Hitung subtotal untuk setiap produk
        $total += $price * $details['quantity'];
    }

    return $total;
}

public function index(Request $request)
{
    // Periksa apakah user yang login adalah admin
    if (auth()->user()->role == 'pembeli') {
        // Jika bukan admin, alihkan dengan pesan error
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    // Ambil parameter status dari query string (jika ada)
    $status = $request->get('status');

    // Query untuk mendapatkan semua pesanan
    $orders = Order::with('user');

    // Jika ada status yang dipilih, filter berdasarkan status tersebut
    if ($status) {
        $orders->where('status', $status);
    }

    // Ambil data pesanan dengan status yang dipilih (atau semua pesanan jika tidak ada filter)
    $orders = $orders->get();

    // Kirim data ke view
    return view('orders.index', compact('orders'));
}

public function updateStatus(Request $request, $orderId)
{
    
    try {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Completed,Cancelled',
        ]);

        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();

        // Menampilkan SweetAlert hanya jika status pesanan adalah "Completed"
        if ($request->status === 'Completed') {
            return redirect()->back()->with('completedStatus', 'Pesanan Anda telah selesai!');
        }

        // Redirect dengan pesan lainnya jika status tidak "Completed"
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui status pesanan.']);
    }
    
}

public function destroy($id)
{
    $order = Order::findOrFail($id);
    $order->delete();

    return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus.');
}

public function Detail($orderId)
{
    // Temukan pesanan berdasarkan order_id
    $order = Order::with('orderDetails.product', 'orderDetails.promotion')->findOrFail($orderId);

    // Pastikan pesanan ini milik pengguna yang sedang login
    if ($order->user_id !== auth()->id()) {
        return redirect()->route('orders.status')->with('error', 'Anda tidak memiliki akses ke pesanan ini.');
    }

    // Kirim data pesanan dan detail pesanan ke view
    return view('orders.detail', compact('order'));
}


public function show($id)
{
    $order = Order::with('user')->findOrFail($id);

    return view('orders.show', compact('order'));
}


}
