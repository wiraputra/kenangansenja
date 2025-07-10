<?php
// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',          // Nama produk
        'description',   // Deskripsi produk
        'price',         // Harga produk
        'image',         // Path gambar
        'is_promoted',
        'category',
        'stok'
    ];


    protected $primaryKey = 'product_id';

    public function promotion()
    {
        return $this->hasOne(Promotion::class, 'product_id', 'product_id');
    }
}
