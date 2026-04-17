<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category');
        
        $query = Product::query();
        
        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->get();

        return view('pos.index', compact('products', 'category'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:Cash,Transfer',
            'cart' => 'required|string', // JSON string from frontend
        ]);

        $cart = json_decode($request->cart, true);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        try {
            DB::beginTransaction();

            $totalPrice = 0;

            // Verifikasi stok dan hitung total
            foreach ($cart as $item) {
                $product = Product::findOrFail($item['product_id']);
                if ($product->stok < $item['quantity']) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi.");
                }
                $totalPrice += $product->price * $item['quantity'];
            }

            // Buat order untuk Barista/Admin (sebagai penanda siapa yang menangani transaksi ini)
            $order = Order::create([
                'user_id' => auth()->id(), // user_id dari kasir/barista
                'order_date' => now(),
                'total_price' => $totalPrice,
                'status' => 'Completed', // Langsung selesai jika dari POS
            ]);

            // Buat order detail dan kurangi stok
            foreach ($cart as $item) {
                $product = Product::findOrFail($item['product_id']);
                $subtotal = $product->price * $item['quantity'];

                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'product_id' => $product->product_id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $product->stok -= $item['quantity'];
                $product->save();
            }

            DB::commit();

            return redirect()->route('pos.index')->with('success', 'Transaksi berhasil! Kembalian (jika ada) silakan berikan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }
}
