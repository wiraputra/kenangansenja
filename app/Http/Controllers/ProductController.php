<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Tampilkan form tambah produk
    public function showProductForm()
    {
        if (!Auth::check()) {
            // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }
            if (auth()->user()->role !== 'admin') {
                // Jika bukan admin, alihkan dengan pesan error
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
            
            return view('products.addproduct');
    }

    // Menyimpan produk baru
    // Menyimpan produk baru
public function store(Request $request)
{
    try {
        // Validasi input form
        $validated = $request->validate([
            'product_name' => 'required|string|unique:products,name',
            'description' => 'nullable|string',
            'is_promoted' => 'nullable|boolean',
            'price' => 'required|numeric',
            'stok' => 'required|integer|min:0', // Validasi stok
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:coffee,snack,non_coffee',
        ]);

        // Menyimpan gambar jika ada
        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('products', 'public') 
            : null;

        // Menentukan status promosi
        $isPromoted = $request->has('is_promoted');

        // Membuat produk baru
        Product::create([
            'name' => $validated['product_name'],
            'description' => $validated['description'],
            'is_promoted' => $isPromoted,
            'price' => $validated['price'],
            'stok' => $validated['stok'], // Simpan stok
            'image' => $imagePath,
            'category' => $request->category,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    } catch (\Exception $e) {
        return redirect()->route('products.index')
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
            ->withInput();
    }
}

    

    // Menampilkan daftar produk
    public function showProducts()
{
    if (auth()->user()->role !== 'admin') {
        // Jika bukan admin, alihkan dengan pesan error
        abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }

    // Mengambil produk yang tidak sedang dalam masa promosi
    $products = Product::all();

    // Mengirim data produk ke tampilan 'products.index'
    return view('products.index', compact('products'));
}


    // Menghapus produk berdasarkan ID
    public function deleteProduct($product_id)
    {
        // Cari produk berdasarkan ID
        $product = Product::find($product_id);

        if ($product) {
            // Hapus gambar jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Hapus produk dari database
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
        }

        return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan');
    }
    public function showPesanPage()
{
    if (!Auth::check()) {
        // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }
    $products = Product::where('is_promoted', false)->get();

    // Kirim data ke tampilan
    return view('pesanpage', compact('products'));
}

public function show($id)
{
    if (!Auth::check()) {
        // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }
    $product = Product::findOrFail($id);
    return view('products.detail', compact('product'));
}

// Menampilkan form untuk mengedit produk
public function editProductForm($product_id)
{
    if (!Auth::check()) {
        // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }
    // Cari produk berdasarkan ID
    $product = Product::find($product_id);

    // Jika produk tidak ditemukan, redirect ke halaman produk dengan pesan error
    if (!$product) {
        return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan');
    }

    // Menampilkan form edit produk dengan membawa data produk yang ditemukan
    return view('products.editproduct', compact('product'));
}
// Mengupdate produk


public function update(Request $request, $product_id)
{
    $validated = $request->validate([
        'product_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stok' => 'required|integer|min:0', // Validasi stok
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_promoted' => 'required|boolean',
    ]);

    $product = Product::where('product_id', $product_id)->firstOrFail();

    $product->name = $validated['product_name'];
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->stok = $validated['stok']; // Update stok
    $product->is_promoted = $request->input('is_promoted');

    if ($request->hasFile('image')) {
        if ($product->image) {
            \Storage::delete($product->image);
        }
        $product->image = $request->file('image')->store('products', 'public');
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
}


public function showByCategory($category)
{
    $products = Product::where('category', $category)->get();
    return view('products.category', compact('products', 'category'));
}

public function placeOrder(Request $request)
{
    $request->validate([
        'products' => 'required|array',
        'products.*.product_id' => 'required|exists:products,product_id',
        'products.*.quantity' => 'required|integer|min:1',
    ]);

    $totalPrice = 0;

    // Cek apakah stok cukup sebelum lanjut ke proses pemesanan
    foreach ($request->products as $item) {
        $product = Product::find($item['product_id']);
        if ($item['quantity'] > $product->stok) {
            // Menampilkan pesan error dan menghentikan proses pemesanan
            return back()->with('error', "Stok produk {$product->name} tidak mencukupi.");
        }
    }

    // Membuat pesanan baru
    $order = Order::create([
        'user_id' => auth()->id(),
        'order_date' => now(),
        'total_price' => 0,
        'status' => 'Pending',
    ]);

    // Proses pembaruan stok dan pembuatan detail pesanan
    foreach ($request->products as $item) {
        $product = Product::find($item['product_id']);
        $product->stok -= $item['quantity']; // Kurangi stok produk
        $product->save();

        $subtotal = $product->price * $item['quantity'];

        // Menambahkan detail pesanan
        OrderDetail::create([
            'order_id' => $order->order_id,
            'product_id' => $product->product_id,
            'quantity' => $item['quantity'],
            'price' => $product->price,
            'subtotal' => $subtotal,
        ]);

        $totalPrice += $subtotal;
    }

    // Update total harga pesanan
    $order->update(['total_price' => $totalPrice]);

    return redirect()->route('products.detail')->with('success', 'Pesanan berhasil dibuat!');
}

}




