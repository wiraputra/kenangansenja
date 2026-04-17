@extends('layouts.app')

@section('title', 'Point of Sale (POS)')
@section('page_title', 'Point of Sale')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-140px)]" x-data="posSystem()">
    
    <!-- Bagian Kiri: List Produk -->
    <div class="lg:col-span-2 flex flex-col h-full bg-white dark:bg-espresso-950 rounded-2xl shadow-sm border border-slate-100 dark:border-espresso-800 overflow-hidden">
        <!-- Filter Kategori -->
        <div class="p-4 border-b border-slate-100 dark:border-espresso-800 flex space-x-2 overflow-x-auto">
            <a href="{{ route('pos.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all whitespace-nowrap {{ !request('category') ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-espresso-800 text-slate-500 hover:bg-slate-200' }}">Semua</a>
            <a href="{{ route('pos.index', ['category' => 'Coffee']) }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all whitespace-nowrap {{ request('category') == 'Coffee' ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-espresso-800 text-slate-500 hover:bg-slate-200' }}">Coffee</a>
            <a href="{{ route('pos.index', ['category' => 'Non_Coffee']) }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all whitespace-nowrap {{ request('category') == 'Non_Coffee' ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-espresso-800 text-slate-500 hover:bg-slate-200' }}">Non Coffee</a>
            <a href="{{ route('pos.index', ['category' => 'Snack']) }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition-all whitespace-nowrap {{ request('category') == 'Snack' ? 'bg-primary text-white' : 'bg-slate-100 dark:bg-espresso-800 text-slate-500 hover:bg-slate-200' }}">Snack</a>
        </div>

        <!-- Grid Produk -->
        <div class="p-4 flex-1 overflow-y-auto">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($products as $product)
                <div class="bg-slate-50 dark:bg-espresso-900 rounded-2xl p-3 border border-slate-100 dark:border-espresso-800 cursor-pointer hover:shadow-lg hover:border-primary/50 transition-all select-none flex flex-col h-full"
                     @click="addToCart({{ $product->product_id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, {{ $product->stok }})">
                    <div class="aspect-square rounded-xl bg-white dark:bg-espresso-800 mb-3 overflow-hidden flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <i class="bi bi-image text-3xl text-slate-300"></i>
                        @endif
                    </div>
                    <div class="mt-auto">
                        <h4 class="font-bold text-sm line-clamp-2 mb-1">{{ $product->name }}</h4>
                        <p class="text-primary font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-xs text-slate-400 mt-1">Stok: {{ $product->stok }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @if($products->isEmpty())
                <div class="flex flex-col items-center justify-center h-full text-slate-400">
                    <i class="bi bi-box-seam text-4xl mb-3"></i>
                    <p>Tidak ada produk di kategori ini.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Bagian Kanan: Keranjang & Checkout -->
    <div class="bg-white dark:bg-espresso-950 rounded-2xl shadow-sm border border-slate-100 dark:border-espresso-800 flex flex-col h-full overflow-hidden">
        <div class="p-4 border-b border-slate-100 dark:border-espresso-800 bg-slate-50/50 dark:bg-espresso-900/50">
            <h3 class="font-header font-bold text-lg">Pesanan Saat Ini</h3>
            <p class="text-xs text-slate-500">Order Walk-in</p>
        </div>

        <!-- List Keranjang -->
        <div class="flex-1 p-4 overflow-y-auto space-y-3">
            <template x-for="(item, index) in cart" :key="index">
                <div class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-espresso-800 bg-slate-50 dark:bg-espresso-900 group">
                    <div class="flex-1 pr-3">
                        <h4 class="font-bold text-sm line-clamp-1" x-text="item.name"></h4>
                        <p class="text-primary text-sm font-semibold" x-text="'Rp ' + formatPrice(item.price)"></p>
                    </div>
                    <div class="flex items-center space-x-2 bg-white dark:bg-espresso-800 rounded-lg p-1 border border-slate-200 dark:border-espresso-700">
                        <button @click="decreaseQty(index)" class="w-7 h-7 flex items-center justify-center rounded-md hover:bg-slate-100 dark:hover:bg-espresso-700 text-slate-500 transition-colors">
                            <i class="bi bi-dash"></i>
                        </button>
                        <span class="w-6 text-center text-sm font-bold" x-text="item.quantity"></span>
                        <button @click="increaseQty(index)" class="w-7 h-7 flex items-center justify-center rounded-md hover:bg-slate-100 dark:hover:bg-espresso-700 text-slate-500 transition-colors">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                </div>
            </template>
            
            <div x-show="cart.length === 0" class="flex flex-col items-center justify-center h-full text-slate-400 py-10">
                <i class="bi bi-cart4 text-4xl mb-3 text-slate-300"></i>
                <p class="text-sm">Silakan pilih produk</p>
            </div>
        </div>

        <!-- Checkout Section -->
        <div class="p-4 border-t border-slate-100 dark:border-espresso-800 bg-slate-50 dark:bg-espresso-950/80">
            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Subtotal</span>
                    <span class="font-bold" x-text="'Rp ' + formatPrice(total)"></span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-slate-500">Pajak (0%)</span>
                    <span class="font-bold">Rp 0</span>
                </div>
                <hr class="border-slate-200 dark:border-espresso-800 my-2">
                <div class="flex justify-between text-lg">
                    <span class="font-header font-bold text-slate-900 dark:text-white">Total</span>
                    <span class="font-bold text-primary" x-text="'Rp ' + formatPrice(total)"></span>
                </div>
            </div>

            <form action="{{ route('pos.checkout') }}" method="POST">
                @csrf
                <input type="hidden" name="cart" x-model="JSON.stringify(cart)">
                
                <div class="grid grid-cols-2 gap-2 mb-4">
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="Cash" class="peer sr-only" required checked>
                        <div class="p-3 text-center rounded-xl border border-slate-200 dark:border-espresso-700 peer-checked:border-primary peer-checked:bg-primary/10 peer-checked:text-primary transition-all font-semibold text-sm hover:bg-slate-100 dark:hover:bg-espresso-800">
                            <i class="bi bi-cash-coin block text-lg mb-1"></i> Cash
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="payment_method" value="Transfer" class="peer sr-only" required>
                        <div class="p-3 text-center rounded-xl border border-slate-200 dark:border-espresso-700 peer-checked:border-primary peer-checked:bg-primary/10 peer-checked:text-primary transition-all font-semibold text-sm hover:bg-slate-100 dark:hover:bg-espresso-800">
                            <i class="bi bi-qr-code-scan block text-lg mb-1"></i> QRIS/Transfer
                        </div>
                    </label>
                </div>

                <button type="submit" 
                        class="w-full py-4 bg-primary text-white rounded-xl font-bold hover:bg-primary-dark transition-colors shadow-lg shadow-primary/30 flex items-center justify-center gap-2"
                        :disabled="cart.length === 0"
                        :class="{'opacity-50 cursor-not-allowed': cart.length === 0}">
                    <i class="bi bi-check-circle-fill"></i> Proses Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function posSystem() {
        return {
            cart: [],
            
            get total() {
                return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            },
            
            formatPrice(price) {
                return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            },
            
            addToCart(id, name, price, stock) {
                if (stock <= 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Stok produk ini habis!',
                        background: localStorage.getItem('theme') === 'dark' ? '#0d0c0b' : '#ffffff',
                        color: localStorage.getItem('theme') === 'dark' ? '#f5f5f5' : '#0d0c0b',
                    });
                    return;
                }

                let existing = this.cart.find(item => item.product_id === id);
                if (existing) {
                    if (existing.quantity < stock) {
                        existing.quantity++;
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Maksimal Stok',
                            text: 'Pemesanan melebihi stok yang tersedia.',
                            toast: true,
                            position: 'top-end',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            background: localStorage.getItem('theme') === 'dark' ? '#0d0c0b' : '#ffffff',
                            color: localStorage.getItem('theme') === 'dark' ? '#f5f5f5' : '#0d0c0b',
                        });
                    }
                } else {
                    this.cart.push({
                        product_id: id,
                        name: name,
                        price: price,
                        quantity: 1,
                        stock: stock
                    });
                }
            },
            
            increaseQty(index) {
                if (this.cart[index].quantity < this.cart[index].stock) {
                    this.cart[index].quantity++;
                }
            },
            
            decreaseQty(index) {
                if (this.cart[index].quantity > 1) {
                    this.cart[index].quantity--;
                } else {
                    this.cart.splice(index, 1);
                }
            }
        }
    }
</script>
@endsection
