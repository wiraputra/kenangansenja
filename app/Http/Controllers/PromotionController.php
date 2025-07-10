<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use Carbon\Carbon;

class PromotionController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            // Jika bukan admin, alihkan dengan pesan error
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        // Ambil semua data promosi beserta relasi produk
        $promotions = Promotion::with('product')->get();

        // Kirim data ke view
        return view('promosi.index', compact('promotions'));
    }
    public function edit($promotion_id)
    {
        if (auth()->user()->role !== 'admin') {
            // Jika bukan admin, alihkan dengan pesan error
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        $promotion = Promotion::where('promotion_id', $promotion_id)
        ->with('product') // Pastikan relasi dengan produk dimuat
        ->firstOrFail();

        $promotion->start_date = Carbon::parse($promotion->start_date);
        $promotion->end_date = Carbon::parse($promotion->end_date);

        return view('promosi.edit', compact('promotion'));
    }

    public function showPromotions()
{
    $promotions = Promotion::with('product')->get(); // Anda bisa menyesuaikan query ini dengan kebutuhan

    // Kirim data ke view
    return view('promotepage', compact('promotions'));
}   


    public function create()
    {
        // Ambil semua produk untuk ditampilkan di dropdown
        $products = Product::where('is_promoted', true)->get();
        return view('promosi.add', compact('products'));
    }



    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'discount' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        // Ambil harga produk terkait
        $product = Product::findOrFail($validated['product_id']);

        // Hitung harga setelah diskon
        $priceAfterDiscount = $product->price - ($product->price * $validated['discount'] / 100);

        // Menyimpan promosi baru
        Promotion::create([
            'product_id' => $validated['product_id'],
            'discount' => $validated['discount'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'price_after_discount' => $priceAfterDiscount,
        ]);

        return redirect()->route('promosi.index')->with('success', 'Promosi berhasil ditambahkan!');
    }

    public function update(Request $request, $promotion_id)
{
    // Validasi input untuk promosi
    $validated = $request->validate([
        'discount' => 'required|numeric|min:0|max:100', // Diskon dalam persentase
        'start_date' => 'required|date|before_or_equal:end_date', // Tanggal mulai
        'end_date' => 'required|date|after_or_equal:start_date', // Tanggal akhir
    ]);

    // Temukan promosi berdasarkan promotion_id (bukan product_id)
    $promotion = Promotion::where('promotion_id', $promotion_id)->firstOrFail();

    // Update data promosi
    $promotion->discount = $validated['discount'];
    $promotion->start_date = $validated['start_date'];
    $promotion->end_date = $validated['end_date'];

    // Simpan perubahan ke database
    $promotion->save();

    // Redirect ke halaman promotions.index dengan pesan sukses
    return redirect()
        ->route('promosi.index')
        ->with('success', 'Data promosi berhasil diperbarui!');
}

public function show($promotion_id)
{
    $promotion = Promotion::with('product')->findOrFail($promotion_id);
    return view('promosi.detail', compact('promotion'));
}

public function destroy($promotion_id)
{
    $promotion = Promotion::where('promotion_id', $promotion_id)->firstOrFail();
    $promotion->delete();

    return redirect()->route('promosi.index')->with('success', 'Promosi berhasil dihapus!');
}



}

