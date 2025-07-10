<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Jika menggunakan tabel 'users', Anda tidak perlu mendefinisikan nama tabel secara eksplisit
    // protected $table = 'users'; 

    // Tentukan kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'name', 
        'email', 
        'address', 
        'No_Telp', 
        'password',
        'role'
    ];

    // Tentukan kolom yang tidak boleh diisi secara mass-assignment
    // Jika Anda menggunakan $fillable, Anda tidak perlu mendefinisikan $guarded
    // protected $guarded = ['id'];

    // Tentukan kolom yang harus di-hash secara otomatis, seperti password
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Tentukan tipe data untuk kolom tertentu
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Jika menggunakan kolom primary key selain 'id'
    protected $primaryKey = 'user_id'; // Ganti dengan nama kolom primary key jika diperlukan
    public $incrementing = true;
    // Jika Anda tidak ingin Laravel mengelola timestamps (created_at, updated_at)
    // public $timestamps = false;
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
