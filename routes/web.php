<?php
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PenjualanController;






Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');

// Route untuk memproses form login
Route::post('login', [AuthController::class, 'login']);

// Route untuk logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Menambahkan route dashboard admin dan pembeli
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');


Route::get('/pembeli/dashboard', function () {
    if (!Auth::check()) {
        // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }
    return view('pembeli.dashboard'); // Pastikan view ini ada
})->name('pembeli.dashboard');
    

Route::get('/register', function () {
    return view('register');
});
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/homelogin', function () {
    return view('homelogin');
});
Route::get('/homelogin', [AuthController::class, 'showHomelogForm'])->name('homelogin');

Route::get('/promotepage', function () {
    return view('promotepage');
});
Route::get('/promotepage', [AuthController::class, 'showPromoteForm'])->name('promotepage');

Route::get('/cart', function () {
    return view('cart');
});
Route::get('/cart', [AuthController::class, 'showCartForm'])->name('cart');

Route::get('/pesanpage', function () {
    return view('pesanpage');
});
Route::get('/pesanpage', [AuthController::class, 'showPesanForm'])->name('pesanpage');

Route::get('/order', function () {
    return view('order');
});
Route::get('/detailproduk', function () {
    return view('detailproduk');
});
Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

Route::get('/app', function () {
    return view('layouts.app');
});


Route::get('/produk', function () {
    return view('products.index');
})->name('produk');
Route::get('/promosi', function () {
    return view('promosi.index');
})->name('promosi');
Route::get('/orders', function () {
    return view('orders.index');
})->name('orders');
Route::get('/penjualan', function () {
    return view('penjualanadmin');
})->name('penjualan');
Route::get('/user', function () {
    return view('user.index');
})->name('user');
Route::get('/barista', function () {
    return view('baristaadmin');
})->name('barista');

// Route::get('/products/add', function () {
//     return view('products.addproduct');
// });


Route::get('/products/add', [ProductController::class, 'showproductform'])->name('addproduct');
Route::get('/promosi/add', [PromotionController::class, 'create'])->name('addpromosi');
//route post product
Route::post('/products/store', [ProductController::class, 'store'])->name('storeproduct');
Route::post('/promosi', [PromotionController::class, 'store'])->name('promotions.store');
Route::get('/produk', [ProductController::class, 'showProducts'])->name('products.index');
Route::delete('/produk/{product_id}', [ProductController::class, 'deleteProduct'])->name('deleteproduct');
Route::get('/pesanpage', [ProductController::class, 'showPesanPage'])->name('pesanpage');
Route::get('/produk/{product_id}', [ProductController::class, 'show'])->name('products.detail');
Route::get('/promotion/{promotion_id}', [PromotionController::class, 'show'])->name('promosi.detail');

// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// routes/web.php
Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('add.to.cart');
// routes/web.php
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');


Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::middleware(['auth'])->group(function () {
    Route::get('/akun', [ProfileController::class, 'edit'])->name('akun');
    Route::put('/akun', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Halaman Pembelian (Untuk Barista dan Admin)
   // Route::get('/pembelian', [PembelianController::class, 'index'])->name('pembelian');
});



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

Route::get('/order', function () {
    return view('order');
})->name('order');
// routes/web.php
//Route::get('/promosi', [PromotionController::class, 'showPromotions'])->name('promotion');

Route::get('/promosi', [PromotionController::class, 'index'])->name('promosi.index');

Route::get('/promotepage', [PromotionController::class, 'showPromotions'])->name('promotepage');

Route::delete('/cart/remove/{product_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::put('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');

Route::post('/user/store', [UserController::class, 'store'])->name('storeuser');
Route::get('users/add', [UserController::class, 'add'])->name('user.add');
// Menampilkan form edit produk
Route::get('/products/{product_id}/edit', [ProductController::class, 'editProductForm'])->name('products.edit');
// Mengupdate produk
Route::put('/products/{product_id}', [ProductController::class, 'update'])->name('products.update');
//Route::get('/promosi', [PromotionController::class, 'index'])->name('promotions.index');
Route::get('/promosi/{promotion_id}/edit', [PromotionController::class, 'edit'])->name('promosi.edit');
Route::put('/promosi/{promotion_id}', [PromotionController::class, 'update'])->name('promosi.update');

// Menampilkan status pesanan pengguna
Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
//Route::get('/orders/status/{orderId}', [OrderController::class, 'Status'])->name('orders.status');
Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::middleware('auth')->group(function () {
    Route::get('/orders/status', [OrderController::class, 'Status'])->name('orders.status');
    Route::get('/orders/{orderId}/detail', [OrderController::class, 'Detail'])->name('orders.detail');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');
});
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/categories', function () {
    if (!Auth::check()) {
        // Pengguna tidak login, kirimkan pesan error atau redirect ke halaman lain
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman ini.');
    }
    $nonCoffee = Product::where('category', 'Non_Coffee')->get();
    $coffee = Product::where('category', 'Coffee')->get();
    $snack = Product::where('category', 'Snack')->get();
    
    return view('categories.index', compact('nonCoffee', 'coffee', 'snack'));
})->name('categories.index');

Route::get('/category/{category}', [ProductController::class, 'showByCategory'])->name('category.show');
Route::delete('/promosi/{promotion_id}', [PromotionController::class, 'destroy'])->name('promosi.destroy');
Route::middleware('auth')->group(function () {
    Route::get('/pesan', [ProductController::class, 'showPesanPage'])->name('pesan.page');
    Route::post('/pesan', [ProductController::class, 'placeOrder'])->name('pesan.order');
});

Route::get('/penjualan', [PenjualanController::class, 'salesRecap'])->name('admin.penjualan');
