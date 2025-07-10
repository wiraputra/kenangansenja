<?php
// app/Models/Promotion.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'discount',
        'start_date',
        'end_date',
        'price_after_discount',
    ];
    protected $primaryKey = 'promotion_id';

    public function product()
    {
        
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
