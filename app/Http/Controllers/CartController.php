<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function index()
    {

        // Ambil jumlah barang di keranjang (sesuaikan dengan model atau session Anda)
        $cartCount = auth()->user()->cartItems()->count(); // Contoh jika menggunakan relasi cartItems

        // Jika menggunakan session
        // $cartCount = session('cart', collect())->count();

        return view('cart', compact('cartCount'));
    }

    public function addToCart(Request $request, $productId)
{
    // Validasi input
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    // Ambil produk berdasarkan ID
    $product = Product::with('promotion')->findOrFail($productId);

    // Tentukan harga yang akan digunakan (diskon jika dipromosikan)
    $price = $product->is_promoted && $product->promotion 
        ? $product->promotion->price_after_discount 
        : $product->price;

    // Ambil jumlah yang dipilih dari form
    $quantity = $request->input('quantity');

    if ($quantity > $product->stok) {
        // Jika jumlah pesanan melebihi stok, kembalikan ke halaman produk dengan pesan error
        return redirect()->route('products.detail', $product->product_id)
                         ->with('error', 'Jumlah yang diminta melebihi stok yang tersedia. Stok tersedia: ' . $product->stok);
    }

    // Ambil keranjang dari session
    $cart = session()->get('cart', []);

    // Jika produk sudah ada di keranjang, update jumlahnya
    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] += $quantity;
    } else {
        // Jika produk belum ada, tambahkan produk baru ke keranjang
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $price,
            'quantity' => $quantity,
            'image' => $product->image,
        ];
    }

    // Simpan keranjang ke session
    session()->put('cart', $cart);

    // Redirect ke halaman keranjang dengan pesan sukses
    return redirect()->route('cart')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}



    public function showCart()
    {
        if (!Auth::check()) {
            // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
        //dd(Order::where('user_id', Auth::id())->get());
        // Tampilkan keranjang
        $cart = Session::get('cart', []);
        return view('cart', compact('cart'));
    }
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart')->with('success', 'Item telah dihapus dari keranjang.');
        }
        
        return redirect()->route('cart')->with('error', 'Item tidak ditemukan di keranjang.');
    }
}
