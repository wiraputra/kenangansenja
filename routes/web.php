<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PenjualanController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Buyer Routes (Protected by Auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/pembeli', function () {
        return view('pembeli.dashboard');
    })->name('pembeli.dashboard');

    Route::get('/categories', function () {
        $nonCoffee = Product::where('category', 'Non_Coffee')->get();
        $coffee = Product::where('category', 'Coffee')->get();
        $snack = Product::where('category', 'Snack')->get();
        return view('categories.index', compact('nonCoffee', 'coffee', 'snack'));
    })->name('categories.index');

    Route::get('/category/{category}', [ProductController::class, 'showByCategory'])->name('category.show');
    Route::get('/produk/{product_id}', [ProductController::class, 'show'])->name('products.detail');

    // Cart
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
    Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::delete('/cart/remove/{product_id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Orders & Profile
    Route::get('/akun', [ProfileController::class, 'edit'])->name('akun');
    Route::put('/akun', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders/status', [OrderController::class, 'Status'])->name('orders.status');
    Route::get('/orders/{orderId}/detail', [OrderController::class, 'Detail'])->name('orders.detail');
    
    // User Self-edit
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/profile/update', [UserController::class, 'update'])->name('user.update');
    // Promotions Page
    Route::get('/promotepage', [PromotionController::class, 'showPromotions'])->name('promotepage');
});

/*
|--------------------------------------------------------------------------
| Management Routes (Admin & Barista)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin,barista'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Orders Management
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // Sales Recap
    Route::get('/penjualan', [PenjualanController::class, 'salesRecap'])->name('admin.penjualan');
});

/*
|--------------------------------------------------------------------------
| Owner/Admin Routes (Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Product Management
    Route::get('/products/add', [ProductController::class, 'showproductform'])->name('addproduct');
    Route::post('/products/store', [ProductController::class, 'store'])->name('storeproduct');
    Route::get('/produk', [ProductController::class, 'showProducts'])->name('products.index');
    Route::get('/products/{product_id}/edit', [ProductController::class, 'editProductForm'])->name('products.edit');
    Route::put('/products/{product_id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/produk/{product_id}', [ProductController::class, 'deleteProduct'])->name('deleteproduct');

    // Promotion Management
    Route::get('/promosi', [PromotionController::class, 'index'])->name('promosi.index');
    Route::get('/promosi/add', [PromotionController::class, 'create'])->name('addpromosi');
    Route::post('/promosi', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('/promosi/{promotion_id}/edit', [PromotionController::class, 'edit'])->name('promosi.edit');
    Route::put('/promosi/{promotion_id}', [PromotionController::class, 'update'])->name('promosi.update');
    Route::delete('/promosi/{promotion_id}', [PromotionController::class, 'destroy'])->name('promosi.destroy');

    // User Management
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('users/add', [UserController::class, 'add'])->name('user.add');
    Route::post('/user/store', [UserController::class, 'store'])->name('storeuser');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
});
