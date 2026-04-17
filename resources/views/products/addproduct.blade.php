@extends('layouts.app')

@section('page_title', 'Tambah Produk')

@section('content')
<div class="space-y-8 max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-espresso-900 border border-slate-200 dark:border-espresso-800 text-slate-500 hover:text-primary transition-all shadow-sm">
                <i class="bi bi-chevron-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-header font-bold text-slate-900 dark:text-white">Tambah Produk Baru</h1>
                <p class="text-slate-500 dark:text-espresso-400 text-[10px] font-bold uppercase tracking-widest mt-1">Management / New Item</p>
            </div>
        </div>
    </div>

    <form action="{{ route('storeproduct') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side: Basic Info -->
            <div class="lg:col-span-2 space-y-8">
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-sm font-bold uppercase tracking-wider flex items-center">
                            <i class="bi bi-info-circle-fill mr-3 text-primary"></i>
                            Informasi Dasar Produk
                        </h3>
                    </x-slot>

                    <div class="space-y-6">
                        <x-input label="Nama Produk" name="product_name" required placeholder="Contoh: Espresso Macchiato" />
                        
                        <x-input label="Deskripsi Produk" name="description" type="textarea" required placeholder="Jelaskan detail rasa, aroma, atau bahan-bahan unik produk ini..." />
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-input label="Kategori" name="category" type="select" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="coffee">Coffee</option>
                                <option value="snack">Snack</option>
                                <option value="non_coffee">Non Coffee</option>
                            </x-input>

                            <div class="pt-8 flex items-center px-2">
                                <label class="relative inline-flex items-center cursor-pointer group">
                                    <input type="checkbox" name="is_promoted" value="1" class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-200 dark:bg-espresso-800 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                    <span class="ml-3 text-sm font-bold text-slate-500 dark:text-espresso-400 group-hover:text-primary transition-colors">Aktifkan Status Promosi?</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </x-card>

                <!-- Pricing & Stock -->
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-sm font-bold uppercase tracking-wider flex items-center">
                            <i class="bi bi-tag-fill mr-3 text-primary"></i>
                            Harga & Stok Produk
                        </h3>
                    </x-slot>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <x-input label="Harga Jual (IDR)" name="price" type="number" required placeholder="0" min="0" />
                        <x-input label="Stok Inventori" name="stok" type="number" required placeholder="0" min="0" />
                    </div>
                </x-card>
            </div>

            <!-- Right Side: Media & Save -->
            <div class="space-y-8">
                <x-card>
                    <x-slot name="header">
                        <h3 class="text-sm font-bold uppercase tracking-wider flex items-center">
                            <i class="bi bi-image-fill mr-3 text-primary"></i>
                            Gambar Produk
                        </h3>
                    </x-slot>

                    <div class="space-y-6">
                        <div class="relative group">
                            <div class="w-full h-56 rounded-[2rem] border-2 border-dashed border-slate-200 dark:border-espresso-700 bg-slate-50/50 dark:bg-espresso-800/30 flex flex-col items-center justify-center transition-all group-hover:border-primary/50 overflow-hidden">
                                <div id="preview-placeholder" class="flex flex-col items-center justify-center">
                                    <i class="bi bi-cloud-arrow-up-fill text-4xl text-slate-300 dark:text-espresso-600 mb-2"></i>
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Klik untuk Upload</p>
                                </div>
                                <img id="image-preview" class="hidden w-full h-full object-cover">
                            </div>
                            <input type="file" name="image" id="image-upload" required class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(this)">
                        </div>
                        <p class="text-[10px] text-slate-400 text-center leading-relaxed">Format yang didukung: JPG, PNG, WEBP. <br> Ukuran maksimal 2MB dengan aspek rasio 1:1 disarankan.</p>
                    </div>
                </x-card>

                <div class="p-2">
                    <x-button type="submit" variant="primary" class="w-full !py-5 shadow-2xl shadow-primary/30">
                        <i class="bi bi-check2-circle mr-2 text-xl"></i>
                        Simpan Produk
                    </x-button>
                    <a href="{{ route('products.index') }}" class="block text-center mt-6 text-sm font-bold text-slate-400 hover:text-red-500 transition-colors">
                        Batalkan Perubahan
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('preview-placeholder');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
